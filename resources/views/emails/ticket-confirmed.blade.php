<x-mail::message>
# Halo {{ $transaction->user->name }}

Pembayaran untuk transaksi **{{ $transaction->code }}** telah dikonfirmasi.

**Event:** {{ $event?->title }}  
**Tanggal:** {{ $event?->event_date?->format('d M Y') }} {{ $event?->event_time }}  
**Lokasi:** {{ $event?->location }}

Kode tiket Anda:

@foreach ($transaction->issuedTickets as $ticket)
- {{ $ticket->ticket_code }}
@endforeach

<x-mail::button :url="route('my-tickets.index')">
Lihat Tiket
</x-mail::button>

Tunjukkan barcode/QR atau kode tiket saat masuk event.

Terima kasih,<br>
Dreamella Project
</x-mail::message>
