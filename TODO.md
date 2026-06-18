# TODO Dreamella Ticket

## Prioritas Tinggi

- Isi kredensial database MySQL/MariaDB asli di `.env` server deployment.
- Isi kredensial SMTP asli di `.env` jika email sungguhan diperlukan.
- Pasang cron scheduler Laravel di server deployment agar `transactions:expire-pending` berjalan otomatis.

## Prioritas Menengah

- Tambahkan package QR code scannable seperti `simplesoftwareio/simple-qrcode` bila environment mengizinkan.
- Tambahkan export PDF laporan atau PDF e-ticket.

## Prioritas Rendah

- Tambahkan scanner QR berbasis kamera di halaman check-in.
- Tambahkan policy class terpisah untuk transaksi, payment, dan issued ticket.
- Tambahkan FormRequest class untuk semua form besar.
