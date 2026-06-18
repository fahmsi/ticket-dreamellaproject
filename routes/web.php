<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/events', [PublicController::class, 'events'])->name('events.index');
Route::get('/events/{event}', [PublicController::class, 'show'])->name('events.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:customer,admin'])->group(function () {
    Route::get('/checkout/{event}', [CustomerController::class, 'checkout'])->name('checkout.show');
    Route::post('/checkout', [CustomerController::class, 'storeCheckout'])->name('checkout.store');
    Route::get('/transactions', [CustomerController::class, 'transactions'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [CustomerController::class, 'showTransaction'])->name('transactions.show');
    Route::get('/transactions/{transaction}/payment', [CustomerController::class, 'payment'])->name('transactions.payment');
    Route::post('/transactions/{transaction}/payment/upload', [CustomerController::class, 'uploadPayment'])->name('transactions.payment.upload');
    Route::get('/payment-proofs/{payment}', [CustomerController::class, 'paymentProof'])->name('payments.proof');
    Route::get('/my-tickets', [CustomerController::class, 'myTickets'])->name('my-tickets.index');
    Route::get('/my-tickets/{ticketCode}', [CustomerController::class, 'showTicket'])->name('my-tickets.show');
    Route::get('/my-tickets/{ticketCode}/qr', [CustomerController::class, 'ticketQr'])->name('my-tickets.qr');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/events', [AdminController::class, 'events'])->name('events.index');
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{event}', [AdminController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{event}', [AdminController::class, 'destroyEvent'])->name('events.destroy');

    Route::get('/events/{event}/tickets', [AdminController::class, 'eventTickets'])->name('events.tickets');
    Route::post('/events/{event}/tickets', [AdminController::class, 'storeTicket'])->name('tickets.store');
    Route::get('/tickets/{ticket}/edit', [AdminController::class, 'editTicket'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [AdminController::class, 'updateTicket'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [AdminController::class, 'destroyTicket'])->name('tickets.destroy');

    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
    Route::get('/customers/{user}', [AdminController::class, 'showCustomer'])->name('customers.show');

    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [AdminController::class, 'showTransaction'])->name('transactions.show');
    Route::post('/transactions/{transaction}/resend-ticket', [AdminController::class, 'resendTicket'])->name('transactions.resend-ticket');

    Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminController::class, 'showPayment'])->name('payments.show');
    Route::post('/payments/{payment}/verify', [AdminController::class, 'verifyPayment'])->name('payments.verify');
    Route::post('/payments/{payment}/reject', [AdminController::class, 'rejectPayment'])->name('payments.reject');

    Route::get('/reports/sales', [AdminController::class, 'reports'])->name('reports.sales');
    Route::get('/reports/sales/export', [AdminController::class, 'exportReports'])->name('reports.sales.export');

    Route::get('/payment-methods', [AdminController::class, 'paymentMethods'])->name('payment-methods.index');
    Route::post('/payment-methods', [AdminController::class, 'storePaymentMethod'])->name('payment-methods.store');
    Route::put('/payment-methods/{paymentMethod}', [AdminController::class, 'updatePaymentMethod'])->name('payment-methods.update');
    Route::delete('/payment-methods/{paymentMethod}', [AdminController::class, 'destroyPaymentMethod'])->name('payment-methods.destroy');

    Route::get('/check-in', [AdminController::class, 'checkIn'])->name('check-in.index');
    Route::post('/check-in/validate', [AdminController::class, 'validateTicket'])->name('check-in.validate');
    Route::post('/check-in/{issuedTicket}/mark-used', [AdminController::class, 'markUsed'])->name('check-in.mark-used');
});
