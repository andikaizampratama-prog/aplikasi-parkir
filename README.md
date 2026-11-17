# SISTEM INFORMASI PARKIRKU

## 1. Deskripsi Program
ParkirKu adalah aplikasi berbasis web yang digunakan untuk membantu pengelolaan parkir kendaraan. Aplikasi ini dikembangkan menggunakan Laravel 13, PHP, dan MySQL.

Sistem ini bertujuan mempermudah proses pencatatan kendaraan masuk dan keluar, pengelolaan tarif parkir, transaksi pembayaran, serta pembuatan laporan parkir.

## 2. Tujuan Program
- Mempermudah pengelolaan data parkir.
- Mencatat kendaraan masuk dan keluar.
- Mengelola transaksi pembayaran parkir.
- Mempermudah pemantauan kapasitas parkir.
- Menyediakan laporan transaksi parkir.
- Meningkatkan ketertiban administrasi parkir.

## 3. Teknologi yang Digunakan
- **Bahasa pemrograman:** PHP
- **Framework:** Laravel 13
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Code Editor:** Visual Studio Code
- **Version Control:** Git dan GitHub

## 4. Hak Akses Pengguna

### Admin
- Mengelola data anggota.
- Mengelola data kendaraan.
- Mengelola data parkir.
- Mengelola tarif parkir.
- Memvalidasi transaksi.
- Melihat laporan.
- Melihat log aktivitas.

### Petugas
- Mencatat kendaraan masuk.
- Mencatat kendaraan keluar.
- Mengelola proses parkir.
- Mencetak tiket parkir.
- Melihat notifikasi.

### Owner
- Melihat dashboard.
- Melihat laporan parkir.
- Melihat rekap transaksi.

## 5. Fitur Program
1. Login dan logout.
2. Dashboard berdasarkan hak akses.
3. Manajemen data anggota.
4. Manajemen data kendaraan.
5. Pengelolaan parkir.
6. Pengaturan tarif parkir.
7. Pencatatan transaksi.
8. Validasi pembayaran.
9. Cetak tiket parkir dengan QR Code.
10. Notifikasi.
11. Laporan parkir.
12. Log aktivitas pengguna.

## 6. Struktur Folder Laravel
- `app/` — Menyimpan Model dan Controller.
- `bootstrap/` — Konfigurasi awal aplikasi.
- `config/` — Konfigurasi aplikasi.
- `database/` — Migration, Seeder, dan Factory.
- `public/` — File publik aplikasi.
- `resources/` — File View, CSS, dan JavaScript.
- `routes/` — Pengaturan URL aplikasi.
- `storage/` — Penyimpanan file dan log.
- `tests/` — File pengujian.
- `artisan` — Perintah CLI Laravel.

## 7. Cara Menjalankan Program
1. Clone repository dari GitHub.
2. Masuk ke folder proyek.
3. Jalankan `composer install`.
4. Salin `.env.example` menjadi `.env`.
5. Atur konfigurasi database pada file `.env`.
6. Jalankan `php artisan key:generate`.
7. Jalankan migration dengan `php artisan migrate`.
8. Jalankan aplikasi menggunakan `php artisan serve`.

## 8. Kesimpulan
ParkirKu merupakan sistem informasi yang dirancang untuk membantu proses pengelolaan parkir agar lebih efektif, terstruktur, dan mudah dipantau. Dengan adanya sistem ini, proses pencatatan kendaraan, transaksi, dan laporan parkir dapat dilakukan melalui satu aplikasi.

---
**Nama Proyek:** ParkirKu  
**Jenis Aplikasi:** Sistem Informasi Parkir Berbasis Web  
**Framework:** Laravel 13  
**Database:** MySQL
