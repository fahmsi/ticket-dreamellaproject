# Progress Dreamella Ticket

## Selesai

- Scaffold Laravel 12 yang kompatibel dengan PHP 8.2.4.
- Composer disesuaikan dari Laravel 13 ke Laravel 12 dan platform PHP 8.2.4.
- Migrasi database: users, events, tickets, transactions, transaction_details, payment_methods, payments, issued_tickets, ticket_email_logs.
- Model dan relasi Eloquent lengkap.
- Seeder demo admin, customer, 3 event, jenis tiket, dan metode pembayaran manual.
- Auth manual: register, login, logout, forgot password, reset password.
- Middleware role admin/customer.
- Halaman publik: home, daftar event, detail event.
- Flow customer: checkout, transaksi, instruksi pembayaran, upload bukti, riwayat transaksi, tiket saya, detail e-ticket, profil.
- Flow admin: dashboard, CRUD event, CRUD tiket, pelanggan, transaksi, verifikasi/reject pembayaran, laporan CSV, metode pembayaran, check-in, resend email tiket.
- Service class: `TicketIssuingService`, `PaymentVerificationService`, `TicketMailService`.
- Mailable: `TicketConfirmedMail`.
- Feature tests untuk alur inti.
- README dokumentasi instalasi, akun demo, alur, dan testing.

## File Utama Dibuat/Diubah

- `composer.json`, `composer.lock`
- `routes/web.php`
- `bootstrap/app.php`
- `app/Models/*`
- `app/Http/Controllers/AuthController.php`
- `app/Http/Controllers/PublicController.php`
- `app/Http/Controllers/CustomerController.php`
- `app/Http/Controllers/AdminController.php`
- `app/Http/Middleware/EnsureRole.php`
- `app/Services/*`
- `app/Mail/TicketConfirmedMail.php`
- `database/migrations/*`
- `database/seeders/DatabaseSeeder.php`
- `resources/views/*`
- `tests/Feature/DreamellaFlowTest.php`
- `README.md`, `PROGRESS.md`, `TODO.md`

## Perintah yang Sudah Dijalankan

- `composer create-project laravel/laravel . --no-interaction`
- `composer install --no-interaction`
- `composer update --with-all-dependencies --no-interaction`
- `composer check-platform-reqs --no-interaction`
- `php artisan migrate:fresh --seed`
- `php artisan route:list`
- `php artisan test --filter=DreamellaFlowTest`
- `php artisan view:cache`
- `php artisan storage:link`
- `php artisan test`
- `php artisan view:clear`

## Error dan Solusi

- Composer pertama mengunduh Laravel 13 yang membutuhkan PHP `>=8.4.1`, sementara mesin memakai PHP 8.2.4.
- Solusi: target diturunkan ke Laravel 12, dev dependency disesuaikan, dan `config.platform.php` dikunci ke `8.2.4`.
- Beberapa paket Symfony awalnya ikut versi terlalu baru. Solusi: full `composer update -W` setelah platform PHP dikunci.
- Full test pertama gagal pada test bawaan Laravel karena tidak memakai migrasi database. Solusi: `tests/Feature/ExampleTest.php` memakai `RefreshDatabase` dan seeder.

## Task Berikutnya

- Inisialisasi git dan commit perubahan tahap ini.
- Opsional: tambah PDF e-ticket, QR code scannable dengan package khusus, chart laporan visual, dan scanner kamera QR.

## Hasil Pengecekan Akhir

- `php artisan migrate:fresh --seed`: sukses.
- `php artisan route:list`: sukses, 57 route terdaftar.
- `php artisan view:cache`: sukses.
- `php artisan storage:link`: sukses.
- `php artisan test`: sukses, 8 tests / 28 assertions.
