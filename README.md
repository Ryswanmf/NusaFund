# NusaFund - Platform Filantropi Modern & Transparan

NusaFund adalah platform penggalangan dana (fundraising), pengelolaan zakat, dan manajemen event kemanusiaan yang dibangun dengan fokus pada transparansi, otomatisasi pembayaran, dan pengalaman donatur yang premium.

## 🚀 Fitur Utama

### 1. Manajemen Donasi & Kampanye
- **Sistem Kampanye:** Pengelolaan penuh (CRUD) kampanye donasi dengan status aktif, selesai, atau ditangguhkan.
- **Logika Target Tercapai:** Otomatis menutup akses donasi dan mengubah visual jika target dana sudah 100% terpenuhi.
- **Donasi Tanpa Login:** Memungkinkan pengunjung berdonasi sebagai tamu (*guest*) untuk meningkatkan konversi.
- **Doa & Dukungan:** Menampilkan pesan emosional dan doa dari para donatur di setiap halaman kampanye.

### 2. Otomatisasi Pembayaran (Midtrans)
- **Integrasi Midtrans Sandbox:** Mendukung pembayaran otomatis via Virtual Account (Khususnya BSI).
- **Auto-Update Status:** Saldo kampanye dan status donasi diperbarui secara real-time tanpa campur tangan admin setelah pembayaran berhasil.

### 3. Ekosistem Donatur (User Experience)
- **Dashboard Donatur:** Visualisasi "Grafik Kebaikan Saya" menggunakan Chart.js (Tren donasi & sebaran dampak kategori).
- **Sertifikat Digital Premium:** Penerbitan piagam penghargaan otomatis dengan desain eksklusif yang dapat diunduh/dicetak sebagai PDF.
- **NusaBot (Smart ChatBot):** Asisten virtual pintar yang siap membantu pengunjung 24/7.

### 4. Transparansi & Kredibilitas
- **Kabar Terbaru (Updates):** Fitur bagi admin untuk melaporkan progres penyaluran dana disertai bukti foto.
- **Sistem Event:** Manajemen pendaftaran event kemanusiaan lengkap dengan kontrol kuota otomatis.
- **Sistem Zakat:** Pengelolaan zakat berdasarkan kategori asnaf dan lembaga penyalur.
- **FAQ & Testimoni:** Ruang edukasi dan bukti sosial untuk membangun kepercayaan publik.

### 5. Optimasi & SEO
- **SEO Dashboard:** Pengaturan Meta Description dan Keywords dinamis untuk setiap kampanye.
- **Open Graph Ready:** Pratinjau link yang cantik saat dibagikan ke WhatsApp, Facebook, dan media sosial lainnya.
- **Logo Dinamis:** Seluruh identitas visual dikelola terpusat melalui menu Pengaturan.

## 🛠️ Tech Stack
- **Framework:** Laravel 12
- **Frontend:** TailwindCSS, Alpine.js
- **Database:** MySQL
- **Payment Gateway:** Midtrans Snap API
- **Charts:** Chart.js
- **Icons:** Heroicons & Lucide Icons

## ⚙️ Instalasi

1. Clone repositori ini
2. Jalankan `composer install` dan `npm install`
3. Salin `.env.example` ke `.env` dan atur konfigurasi database serta kunci Midtrans:
   ```env
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   ```
4. Jalankan migrasi: `php artisan migrate --seed`
5. Tautkan storage: `php artisan storage:link`
6. Jalankan server: `php artisan serve` & `npm run dev`

## 📱 Responsivitas
Website ini telah dioptimasi sepenuhnya untuk perangkat mobile, termasuk fitur **Sticky Mobile Donation Button** untuk memudahkan proses berbagi dalam satu genggaman.

---
Dikembangkan dengan ❤️ untuk kemanusiaan.
