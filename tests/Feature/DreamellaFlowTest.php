<?php

namespace Tests\Feature;

use App\Mail\TicketConfirmedMail;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DreamellaFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_and_login_work(): void
    {
        $this->post(route('register'), [
            'name' => 'Pembeli Baru',
            'email' => 'baru@dreamella.test',
            'phone' => '081299999999',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect(route('home'));

        $this->post(route('logout'));

        $this->post(route('login'), [
            'email' => 'baru@dreamella.test',
            'password' => 'password',
        ])->assertRedirect(route('home'));

        $this->post(route('logout'));

        $this->post(route('login'), [
            'email' => 'baru@dreamella.test',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');
    }

    public function test_customer_can_view_events_and_guest_checkout_redirects_to_login(): void
    {
        $this->seed();
        $event = Event::with('tickets')->first();
        $ticket = $event->tickets->first();

        $this->get(route('events.index'))->assertOk()->assertSee($event->title);
        $this->get(route('events.show', $event))->assertOk()->assertSee($ticket->name);

        $this->get(route('checkout.show', ['event' => $event, 'ticket_id' => $ticket->id, 'quantity' => 1]))
            ->assertRedirect(route('login'));
    }

    public function test_customer_can_create_transaction_and_stock_is_validated(): void
    {
        $this->seed();
        $customer = User::where('role', 'customer')->first();
        $ticket = Ticket::with('event')->first();

        $this->actingAs($customer)->post(route('checkout.store'), [
            'ticket_id' => $ticket->id,
            'quantity' => $ticket->quota + 1,
        ])->assertSessionHasErrors('quantity');

        $this->actingAs($customer)->post(route('checkout.store'), [
            'ticket_id' => $ticket->id,
            'quantity' => 2,
        ])->assertRedirect();

        $this->assertDatabaseHas('transactions', [
            'user_id' => $customer->id,
            'status' => 'pending_payment',
        ]);
    }

    public function test_customer_can_upload_payment_proof(): void
    {
        Storage::fake('local');
        $this->seed();
        $customer = User::where('role', 'customer')->first();
        $ticket = Ticket::first();

        $this->actingAs($customer)->post(route('checkout.store'), [
            'ticket_id' => $ticket->id,
            'quantity' => 1,
        ]);

        $transaction = $customer->transactions()->first();

        $this->actingAs($customer)->post(route('transactions.payment.upload', $transaction), [
            'payment_method_id' => \App\Models\PaymentMethod::first()->id,
            'payer_name' => $customer->name,
            'proof_file' => UploadedFile::fake()->image('bukti.jpg'),
        ])->assertRedirect(route('transactions.show', $transaction));

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id, 'status' => 'waiting_verification']);
        $this->assertDatabaseHas('payments', ['transaction_id' => $transaction->id, 'status' => 'uploaded']);
    }

    public function test_admin_can_verify_payment_and_issue_tickets_and_send_mail(): void
    {
        Storage::fake('local');
        Mail::fake();
        $this->seed();
        $customer = User::where('role', 'customer')->first();
        $admin = User::where('role', 'admin')->first();
        $ticket = Ticket::first();

        $this->actingAs($customer)->post(route('checkout.store'), [
            'ticket_id' => $ticket->id,
            'quantity' => 3,
        ]);

        $transaction = $customer->transactions()->first();

        $this->actingAs($customer)->post(route('transactions.payment.upload', $transaction), [
            'payment_method_id' => \App\Models\PaymentMethod::first()->id,
            'payer_name' => $customer->name,
            'proof_file' => UploadedFile::fake()->image('bukti.jpg'),
        ]);

        $payment = Payment::where('transaction_id', $transaction->id)->first();

        $this->actingAs($admin)->post(route('admin.payments.verify', $payment))->assertRedirect(route('admin.payments.index'));

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id, 'status' => 'paid']);
        $this->assertDatabaseCount('issued_tickets', 3);
        Mail::assertSent(TicketConfirmedMail::class);
    }

    public function test_customer_cannot_view_other_customers_ticket(): void
    {
        Storage::fake('local');
        Mail::fake();
        $this->seed();
        $customer = User::where('role', 'customer')->first();
        $other = User::create([
            'name' => 'Other Customer',
            'email' => 'other@dreamella.test',
            'phone' => '081233344455',
            'password' => 'password',
            'role' => 'customer',
        ]);
        $admin = User::where('role', 'admin')->first();
        $ticket = Ticket::first();

        $this->actingAs($customer)->post(route('checkout.store'), ['ticket_id' => $ticket->id, 'quantity' => 1]);
        $transaction = $customer->transactions()->first();
        $this->actingAs($customer)->post(route('transactions.payment.upload', $transaction), [
            'payment_method_id' => \App\Models\PaymentMethod::first()->id,
            'payer_name' => $customer->name,
            'proof_file' => UploadedFile::fake()->image('bukti.jpg'),
        ]);

        $this->actingAs($admin)->post(route('admin.payments.verify', Payment::first()));
        $issuedTicket = $transaction->fresh()->issuedTickets()->first();

        $this->actingAs($other)->get(route('my-tickets.show', $issuedTicket->ticket_code))->assertForbidden();
    }
}
