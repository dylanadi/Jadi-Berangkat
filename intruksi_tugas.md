# 📋 Rencana Kerja Migrasi Project "Jadi Berangkat" ke Laravel 10

Dokumen ini berisi panduan dan instruksi tugas untuk mengkonversi template HTML statis "Jadi Berangkat" menjadi aplikasi web dinamis menggunakan **Laravel 10**. 

---

## 1. Tahap Persiapan (Setup Project)
**Target:** Project Laravel 10 berjalan dan sistem autentikasi Admin siap digunakan.

- [ ] **Install Laravel 10:** 
  Buat project Laravel baru dengan nama bebas (misal: `jadi-berangkat-web`).
- [ ] **Setup Database:**
  Buat database MySQL dan hubungkan dengan `.env`.
- [ ] **Setup Autentikasi Admin:**
  Gunakan starter kit Laravel (seperti **Laravel Breeze** atau **Laravel UI**) untuk membuat fitur login Admin.
- [ ] **Persiapan Asset Public:**
  Copy semua aset dari template statis (folder CSS, JS, Image/Img) ke dalam folder `public/` di Laravel.

---

## 2. Tahap Desain Database & Migrations
**Target:** Semua tabel dan relasi yang dibutuhkan untuk sistem berhasil dirancang dan dibuat menggunakan Laravel Migrations.

*Catatan: Rancang sendiri skema databasenya (nama tabel, tipe kolom, dan relasi) sesuai dengan kebutuhan fitur di bawah ini.*

Tugas Anda adalah memikirkan dan membuat *migration* beserta *model* untuk mengelola data berikut:
- [ ] Data **Destinasi** (Informasi detail tiap tujuan wisata)
- [ ] Data **Ulasan / Testimoni** (Dari pelanggan)
- [ ] Data **Galeri** (Foto-foto kegiatan)
- [ ] Data **Artikel / Blog**
- [ ] Data **Halaman Statis** (Untuk halaman "Tentang Kami" & "Kebijakan Privasi")
- [ ] Data **Media Sosial** (Link ke platform sosial media)
- [ ] Data **Pengaturan Halaman Depan / Beranda** (Untuk mengatur konten dinamis section Hero, CTA, dan data Statistik).

---

## 3. Tahap Pembuatan CRUD Admin (Backend)
**Target:** Admin bisa mengelola (Create, Read, Update, Delete) semua data dari dashboard.

- [ ] Buat *routing* khusus Admin (gunakan *middleware* `auth` agar aman).
- [ ] Buat antarmuka (UI) Dashboard Admin. (Boleh menggunakan template gratis seperti AdminLTE, Stisla, dll).
- [ ] Buat fitur CRUD lengkap untuk:
  - Destinasi (termasuk fungsi upload gambar)
  - Ulasan (fitur setujui/tolak tayang)
  - Galeri (fungsi upload foto)
  - Artikel (sertakan WYSIWYG editor seperti CKEditor/TinyMCE untuk penulisan konten)
  - Halaman Tentang & Kebijakan Privasi (Update konten halaman)
  - Media Sosial
  - Pengaturan Halaman Depan (Ubah teks/gambar Hero, teks tombol CTA, dan update angka statistik).

---

## 4. Tahap Integrasi Frontend (Slicing HTML ke Blade)
**Target:** File HTML statis menjadi `.blade.php` dan menampilkan data dari database secara dinamis.

- [ ] **Pembuatan Layout Utama:**
  Pecah HTML statis (Header, Footer, dll) menjadi layout utama yang *reusable* (misal menggunakan `@extends` dan `@yield` di Blade).
- [ ] **Halaman Beranda (`/`):**
  Tampilkan data Hero, CTA, dan Statistik, serta *looping* beberapa data Destinasi terbaru dan Ulasan secara dinamis.
- [ ] **Halaman Destinasi (`/destinasi`):**
  Tampilkan daftar semua destinasi menggunakan paginasi.
- [ ] **Halaman Detail Destinasi (`/destinasi/{slug}`):**
  Tampilkan rincian destinasi berdasarkan URL slug-nya.
- [ ] **Halaman Galeri (`/galeri`):**
  Tampilkan foto-foto galeri dari database.
- [ ] **Halaman Artikel (`/artikel`):**
  Tampilkan daftar artikel berita wisata.
- [ ] **Halaman Tentang & Kebijakan Privasi:**
  Tampilkan konten dinamis dari database.

---

## 5. Testing & Penyesuaian Akhir
- [ ] Uji coba semua form CRUD di Dashboard (terutama validasi input dan fitur upload gambar).
- [ ] Pastikan tidak ada link atau gambar yang *broken* di halaman pengunjung.
- [ ] Cek responsivitas tampilan di layar perangkat *mobile* dan pastikan desain animasi (Tailwind/GSAP) tetap berjalan normal setelah dipindah ke Blade.
