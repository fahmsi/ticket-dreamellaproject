# Sistem Informasi Pembelian Tiket Online Dreamella Project

Website Laravel untuk Tugas Akhir "Rancang Bangun Sistem Informasi Pembelian Tiket Online Berbasis Web Pada Dreamella Project Menggunakan Framework Laravel Dengan Metode SDLC Waterfall".

Sistem ini menangani informasi event, jenis tiket, checkout pelanggan, pembayaran manual, upload bukti pembayaran, verifikasi admin, penerbitan e-ticket dengan kode/QR, email tiket, laporan penjualan, dan validasi/check-in tiket.

## Fitur Utama

- Registrasi, login, lupa password/reset password, dan profil pelanggan.
- Role admin dan customer dengan middleware terpisah.
- Daftar event, detail event, filter sederhana, dan pemilihan tiket.
- Checkout dengan validasi stok. `sold_count` bertambah setelah pembayaran diverifikasi.
- Pembayaran manual melalui bank, e-wallet, atau QRIS. Tidak memakai payment gateway.
- Upload bukti pembayaran JPG/PNG/PDF dan verifikasi manual admin.
- Tiket unik per kuantitas pembelian dengan kode `DML-YYYYMMDD-ORDERID-RANDOM`.
- Email otomatis `TicketConfirmedMail` setelah pembayaran diterima.
- Dashboard admin, CRUD event, CRUD tiket, data pelanggan, transaksi, pembayaran, metode pembayaran, laporan CSV, dan check-in tiket.

## Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL/MariaDB untuk deployment TA
- SQLite dapat dipakai untuk demo lokal cepat
- Blade + Bootstrap 5 CDN
- Laravel Mail
- PHPUnit feature tests

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Konfigurasi database MySQL/MariaDB di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dreamella_ticket
DB_USERNAME=root
DB_PASSWORD=
```

Untuk demo cepat tanpa MySQL, gunakan SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Lalu jalankan:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

## Akun Demo

- Admin: `admin@dreamella.test` / `password`
- Customer: `customer@dreamella.test` / `password`

## Alur Pembelian

1. Pelanggan membuka website dan memilih event.
2. Pelanggan memilih jenis tiket dan jumlah.
3. Jika belum login, pelanggan diarahkan ke login dan kembali ke checkout.
4. Sistem membuat transaksi `pending_payment`.
5. Pelanggan memilih metode pembayaran manual dan upload bukti.
6. Status berubah menjadi `waiting_verification`.
7. Admin memverifikasi pembayaran.
8. Jika diterima, status menjadi `paid`, tiket diterbitkan, dan email tiket dikirim.
9. Jika ditolak, pelanggan melihat alasan penolakan dan dapat upload ulang.

## Alur Admin

- Login ke `/admin/dashboard`.
- Kelola event dan tiket.
- Buka menu Verifikasi Pembayaran.
- Terima pembayaran untuk menerbitkan tiket dan email otomatis.
- Tolak pembayaran dengan alasan.
- Lihat laporan di `/admin/reports/sales`.
- Validasi/check-in tiket di `/admin/check-in`.

## Email

Default `.env` memakai `MAIL_MAILER=log`, sehingga email disimpan ke log saat demo lokal. Untuk SMTP, isi konfigurasi mail Laravel sesuai server email yang digunakan.

Jika email gagal, transaksi tetap `paid` dan error dicatat di tabel `ticket_email_logs`.

## Testing

```bash
php artisan test
```

Test otomatis mencakup:

- Register berhasil.
- Login berhasil dan gagal.
- Daftar/detail event tampil.
- Guest diarahkan ke login saat checkout.
- Customer membuat transaksi.
- Stok berlebih ditolak.
- Upload bukti pembayaran.
- Admin verifikasi pembayaran.
- Transaksi menjadi paid.
- Issued tickets dibuat.
- Mailable tiket terpanggil.
- Customer tidak dapat melihat tiket milik orang lain.

## Catatan Pembayaran

Sistem ini sengaja tidak menggunakan Midtrans, Xendit, Stripe, PayPal, atau payment gateway lain. Semua pembayaran dilakukan manual melalui rekening/e-wallet/QRIS Dreamella Project dan diverifikasi admin.
