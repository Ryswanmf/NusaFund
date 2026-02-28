# NusaFund - Platform Kebaikan & Filantropi Modern

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB1.svg?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/alpine.js-%238BC0D0.svg?style=for-the-badge&logo=alpine.js&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%234479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

NusaFund adalah platform penggalangan dana (crowdfunding), pengelolaan zakat, dan aksi sosial yang dirancang dengan antarmuka modern, transparan, dan sepenuhnya dinamis. Dibangun menggunakan teknologi terbaru Laravel 12, TailwindCSS, dan Alpine.js.

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.3+)
- **Frontend**: TailwindCSS (Custom Theme), Alpine.js, Blade Templating
- **Database**: MySQL / MariaDB
- **Authentication**: Laravel Breeze (Customized UI)
- **Asset Manager**: Vite

## Fitur Utama

### Halaman Publik (Landing Page)
- **Hero Slider Dinamis**: Banner utama otomatis yang dapat dikelola dari Admin Panel.
- **Kalkulator Zakat**: Hitung kewajiban Zakat Profesi & Maal secara real-time sesuai syariat.
- **Manajemen Campaign**: Daftar donasi murni dari database dengan kategori dan progres bar otomatis.
- **Sistem Event**: Pendaftaran relawan dan aksi sosial dengan informasi kuota dan lokasi.
- **Pusat Bantuan (FAQ)**: Dokumentasi tanya jawab interaktif untuk memudahkan pengguna.
- **Profil Organisasi**: Halaman Tentang Kami yang dinamis mencakup Visi, Misi, dan Legalitas.
- **Legalitas & Keamanan**: Halaman Syarat & Ketentuan serta Kebijakan Privasi yang dapat diatur oleh Admin.

### Dashboard Admin (Eksklusif)
Dashboard kustom untuk kontrol penuh tanpa library pihak ketiga:
- **Statistik Ringkas**: Pantau total donasi, jumlah donatur, dan performa campaign.
- **CRUD Kategori**: Kelola kategori kebaikan dengan ikon SVG Heroicons.
- **CRUD Campaign & Event**: Manajemen konten penggalangan dana dan aksi sosial.
- **CRUD Zakat**: Kelola program penyaluran zakat produktif.
- **Verifikasi Galang Dana**: Menyetujui atau menolak pengajuan dana dari masyarakat.
- **Manajemen User**: Pantau data donatur dan atur hak akses (Admin/User).
- **Pengaturan Website**: Ubah Link Sosial Media, Alamat, Email, dan Copyright secara global.

## Panduan Instalasi

### 1. Persiapan
Pastikan sistem telah terpasang Composer, Node.js, dan web server (XAMPP/Laragon).

### 2. Clone & Install Dependencies
```bash
git clone https://github.com/username/nusafund.git
cd NusaFund
composer install
npm install
```

### 3. Konfigurasi Lingkungan
Salin file konfigurasi lingkungan dan atur koneksi database.
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database & Link Storage
Jalankan migrasi untuk membuat tabel dan buat link storage untuk aset gambar.
```bash
php artisan migrate --seed
php artisan storage:link
```
*Catatan: Perintah seed akan mengisi data awal termasuk akun administrator.*

### 5. Jalankan Aplikasi
```bash
# Jalankan server Laravel
php artisan serve

# Jalankan Vite (di terminal terpisah)
npm run dev
```

## Kredensial Akses (Development)

Untuk masuk ke Dashboard Admin, gunakan akun default berikut:
- **URL Login**: /login
- **Email**: admin@nusafund.com
- **Password**: password123

## Struktur Folder Utama
- **app/Http/Controllers**: Logika bisnis dan integrasi data.
- **resources/views/landing_page**: Kumpulan view halaman publik.
- **resources/views/admin**: Kumpulan view dashboard pengelolaan.
- **resources/views/layouts**: Template utama (Admin & Landing).
- **routes/web.php**: Seluruh pengaturan rute yang terorganisir.

## Kontak & Dukungan
Jika terdapat pertanyaan terkait pengembangan platform ini, silakan hubungi tim IT NusaFund melalui email: kontak@nusafund.id.

---
Copyright 2026 NusaFund Indonesia. Kebaikan untuk Semua.
