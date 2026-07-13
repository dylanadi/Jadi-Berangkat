# CHANGELOG — Branch `vanno`

> Tanggal: 2026-07-06

---

## Ringkasan Perubahan

Penambahan backend Laravel dan data awal (seeder) untuk aplikasi Jadi Berangkat.

---

## Perubahan pada `.gitignore`

| Perubahan | Keterangan |
|-----------|------------|
| **Penambahan aturan ignore** | Menambahkan `vendor/`, `.env`, `storage/`, `bootstrap/cache/`, `.phpunit.result.cache` agar file runtime dan environment tidak tercommit. |

## Perubahan pada `database/seeders/DatabaseSeeder.php`

| Perubahan | Keterangan |
|-----------|------------|
| **Seeder baru** | Membuat user admin (`admin@jadiberangkat.com` / `password`). |
| **Urutan seeder** | `SectionDataSeeder` dipanggil **sebelum** `KontenAwalSeeder` agar tabel `images` sudah terisi saat `KontenAwalSeeder` menjalankan resolusi `image_id`. |

## Perubahan pada `database/seeders/KontenAwalSeeder.php`

| Perubahan | Keterangan |
|-----------|------------|
| **File baru** | Seeder untuk mengisi data awal aplikasi. |
| **Destinasi (7 data)** | Kawah Ijen, De Djawatan, Desa Kemiren, Pantai Boom, Gandrung Sewu, Jalur Pancing Pancer, Jalur Suci Sembah. |
| **Ulasan (6 data)** | Testimonial pengguna dengan rating dan pesan. |
| **Galeri (8 data)** | Gambar destinasi, budaya, dan armada. |
| **Artikel (3 data)** | Panduan liburan Banyuwangi 2026, tradisi Osing, spot foto Instagram. |
| **Resolusi gambar** | Konversi `gambar_file` → `image_id` berdasarkan tabel `images`. |
| **Cegah duplikasi** | Menggunakan `firstOrCreate` agar aman dijalankan berulang kali. |

## File Baru Lainnya

| File | Keterangan |
|------|------------|
| `public/build/` | Asset frontend terkompilasi (CSS/JS via Vite). |
| `jadiberangkat.sql` | Dump database untuk referensi. |
| `CHANGELOG_vanno.md` | Dokumentasi perubahan ini. |

## Catatan

- File `vendor/`, `storage/`, `bootstrap/cache/`, dan `.env` tidak di-commit karena bersifat lingkungan (environment-specific).
- Untuk menjalankan seeder: `php artisan db:seed --class=KontenAwalSeeder`
