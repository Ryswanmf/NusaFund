# NusaFund - Kebaikan untuk Semua

NusaFund adalah platform penggalangan dana (crowdfunding) yang transparan dan terpercaya, dibangun dengan Laravel 12 dan TailwindCSS. Platform ini dirancang untuk menghubungkan para donatur dengan berbagai program kemanusiaan, sosial, dan keagamaan di Indonesia.

## 🚀 Update Terkini (27 Februari 2026)

Berikut adalah daftar perubahan dan fitur baru yang telah diimplementasikan:

### 🎨 UI/UX & Landing Page
- **Redesain Beranda**: Mengalihkan rute utama ke landing page kustom yang lebih modern dan informatif.
- **Konfigurasi Branding**: Menambahkan palet warna `maroon` (#800000) dan font `Instrument Sans` ke dalam sistem TailwindCSS.
- **Pembersihan Kode**: Menghapus *inline styles* dan menggantinya dengan class Tailwind murni untuk performa dan kemudahan pemeliharaan.
- **Navigasi Responsif**: Navbar yang mendukung status login (Auth) dan tombol registrasi yang adaptif di desktop maupun mobile.
- **FAQ Interaktif**: Bagian tanya jawab dengan transisi halus menggunakan Alpine.js.

### 💰 Fitur Donasi
- **Listing Campaign**: Halaman daftar donasi (`/donasi`) dengan grid kartu yang informatif, menampilkan progres, kategori, dan sisa waktu.
- **Detail Campaign**: Halaman detail donasi (`/donasi/{id}`) yang komprehensif, mencakup:
    - Widget donasi *sticky* untuk kemudahan akses.
    - Sistem Tab (Cerita, Update, Donatur) berbasis Alpine.js.
    - Informasi penggalang dana terverifikasi.
    - Integrasi berbagi ke media sosial (FB, Twitter, WA).

### 🛠️ Infrastruktur & Keamanan
- **Integrasi Rute**: Penambahan rute `/donasi` dan `/donasi/{id}` yang terhubung secara dinamis.
- **Keamanan**: Implementasi sistem autentikasi Laravel Breeze (Login, Register, Profile) yang sudah diselaraskan dengan desain NusaFund.

## 🛠️ Tech Stack
- **Framework**: Laravel 12
- **Frontend**: TailwindCSS, Alpine.js, Blade Templating
- **Icons**: SVG Icons (Custom & Heroicons)
- **Asset Manager**: Vite

## 🏁 Cara Menjalankan Proyek
1. Clone repository
2. Jalankan `composer install`
3. Jalankan `npm install`
4. Setup `.env` dan `php artisan key:generate`
5. Jalankan `php artisan migrate`
6. Jalankan `npm run dev` dan `php artisan serve`

---
© 2026 NusaFund Indonesia.
