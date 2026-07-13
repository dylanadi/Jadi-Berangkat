-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jadiberangkat
CREATE DATABASE IF NOT EXISTS `jadiberangkat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jadiberangkat`;

-- Dumping structure for table jadiberangkat.artikel
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi_baca` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `tanggal_terbit` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artikel_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.artikel: ~3 rows (approximately)
INSERT INTO `artikel` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `penulis`, `durasi_baca`, `status`, `tanggal_terbit`, `created_at`, `updated_at`) VALUES
	(1, 'Panduan Lengkap Liburan ke Banyuwangi 2026', 'panduan-liburan-banyuwangi-2026', '<p>Banyuwangi semakin populer sebagai destinasi wisata unggulan di Indonesia. Dengan bentang alam yang lengkap mulai dari pegunungan, hutan, pantai, hingga budaya yang kaya, kota di ujung timur Jawa ini menawarkan pengalaman liburan yang tak terlupakan.</p><h2>Destinasi Wajib Dikunjungi</h2><p>Kawah Ijen, De Djawatan, dan Desa Kemiren adalah tiga destinasi yang wajib masuk itinerary Anda. Masing-masing menawarkan pengalaman yang berbeda namun sama-sama memukau.</p><h2>Tips Berlibur</h2><p>Gunakan jasa jeep lokal untuk pengalaman yang lebih autentik. Driver lokal paham betul medan dan kondisi jalan, plus mereka tahu spot-spot foto terbaik!</p>', 'unsplash_M8drGBgFNZE.png', 'Tips Wisata', 'Tim Jadi Berangkat', 5, 'terbit', '2026-06-15', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(2, 'Mengenal Tradisi Osing di Desa Kemiren', 'tradisi-osing-desa-kemiren', '<p>Desa Kemiren adalah salah satu desa adat suku Osing yang masih mempertahankan tradisi leluhur hingga kini. Terletak di kaki Gunung Ijen, desa ini menawarkan pengalaman budaya yang autentik bagi para pengunjung.</p><h2>Kearifan Lokal</h2><p>Masyarakat Osing memiliki tradisi unik seperti Tari Gandrung, Barong Ider Bumi, dan berbagai upacara adat lainnya. Pengunjung dapat belajar membuat kopi tradisional, menenun, dan memasak masakan khas Osing.</p><h2>Paket Wisata Budaya</h2><p>Jadi Berangkat menawarkan paket wisata budaya ke Desa Kemiren dengan durasi 4 jam, termasuk transportasi jeep, guide lokal, dan makan siang.</p>', 'kemiren.png', 'Budaya', 'Tim Jadi Berangkat', 4, 'terbit', '2026-06-20', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(3, '5 Spot Foto Terbaik di Banyuwangi untuk Instagram', 'spot-foto-banyuwangi-instagram', '<p>Banyuwangi memiliki banyak spot foto instagramable yang sayang untuk dilewatkan. Dari pemandangan alam hingga spot urban, berikut adalah 5 rekomendasi terbaik.</p><h2>1. Kawah Ijen</h2><p>Spot sunrise di puncak Kawah Ijen adalah yang terbaik. Kabut pagi yang tipis dan sinar matahari keemasan menciptakan latar foto yang dramatis.</p><h2>2. Hutan De Djawatan</h2><p>Pohon trembesi raksasa dengan cabang-cabang yang menjuntai menciptakan efek hutan mistis yang sangat fotogenik.</p><h2>3. Pantai Boom</h2><p>Dermaga panjang Pantai Boom adalah spot favorit untuk foto sunrise dengan latar Selat Bali dan Gunung Merapi.</p><h2>4. Desa Kemiren</h2><p>Arsitektur tradisional Osing dengan gapura khas dan rumah adat yang warna-warni sangat menarik untuk difoto.</p><h2>5. Perkebunan Kopi</h2><p>Kebun kopi hijau di lereng Gunung Ijen menawarkan pemandangan yang menenangkan dan spot foto yang estetik.</p>', 'djawatan.jpg', 'Tips Wisata', 'Tim Jadi Berangkat', 3, 'terbit', '2026-06-25', '2026-07-02 23:15:01', '2026-07-02 23:15:01');

-- Dumping structure for table jadiberangkat.card_nilai
CREATE TABLE IF NOT EXISTS `card_nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sect_nilai_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `card_nilai_sect_nilai_id_foreign` (`sect_nilai_id`),
  CONSTRAINT `card_nilai_sect_nilai_id_foreign` FOREIGN KEY (`sect_nilai_id`) REFERENCES `sect_nilai` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.card_nilai: ~6 rows (approximately)
INSERT INTO `card_nilai` (`id`, `sect_nilai_id`, `icon`, `judul`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
	(1, 1, 'bi-shield-check', 'Keamanan Terjamin', 'Armada Jeep 4x4 terinspeksi rutin dengan standar keselamatan wisata internasional.', 1, '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(2, 1, 'bi-tree', 'Eco-Tourism', 'Beroperasi dengan prinsip pariwisata berkelanjutan, mendukung kelestarian alam Banyuwangi.', 2, '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(3, 1, 'bi-person-badge', 'Guide Lokal Expert', 'Driver sekaligus pemandu lokal berpengalaman yang mengenal setiap sudut destinasi.', 3, '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(4, 1, 'bi-phone-vibrate', 'Booking Digital', 'Sistem reservasi digital yang mudah, transparan, dan dapat diakses kapan saja.', 4, '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(5, 1, 'bi-gem', 'Pengalaman Premium', 'Ribuan tamu telah merasakan pengalaman wisata berkesan bersama tim kami.', 5, '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(6, 1, 'bi-people', 'Komunitas Lokal', 'Setiap kunjungan berkontribusi langsung pada perekonomian masyarakat lokal Banyuwangi.', 6, '2026-07-05 19:00:46', '2026-07-05 19:00:46');

-- Dumping structure for table jadiberangkat.destinasi
CREATE TABLE IF NOT EXISTS `destinasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_singkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `image_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mood` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Private',
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_ulasan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinasi_slug_unique` (`slug`),
  KEY `destinasi_image_id_foreign` (`image_id`),
  CONSTRAINT `destinasi_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.destinasi: ~9 rows (approximately)
INSERT INTO `destinasi` (`id`, `kategori`, `nama`, `label`, `slug`, `deskripsi`, `deskripsi_singkat`, `lokasi`, `rute`, `harga`, `image_id`, `status`, `durasi`, `mood`, `tipe`, `rating`, `jml_ulasan`, `created_at`, `updated_at`) VALUES
	(1, 'Kawah Ijen', 'Blue Fire Ijen Midnight', 'Mulai pagi', 'blue-fire-ijen-midnight', 'Mulai perjalanan tengah malam menuju kawah biru Ijen yang legendaris. Nikmati fenomena blue fire yang langka, lalu saksikan sunrise spektakuler dari puncak kawah. Perjalanan ini mencakup transfer jeep dari berbagai titik di Banyuwangi, guide lokal berpengalaman, serta perlengkapan keselamatan lengkap.', 'Blue fire, sunrise, dan jeep transfer yang rapi.', 'Kawah Ijen, Banyuwangi', 'Kawah Ijen Banyuwangi', 1250000.00, 19, 'aktif', '8 jam', 'Sunrise', 'Private', '4.9', 128, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(2, 'Hutan', 'De Djawatan', NULL, 'de-djawatan', 'Jelajahi hutan trembesi raksasa yang menjadi ikon Banyuwangi. De Djawatan menawarkan suasana teduh dengan pohon-pohon tinggi menjulang, cocok untuk foto-foto dan petualangan santai. Termasuk jeep transportasi dan guide lokal.', 'Trembesi raksasa dan jalur foto teduh.', 'De Djawatan, Banyuwangi', 'Hutan De Djawatan', 350000.00, 20, 'aktif', '3 jam', 'Santai', 'Private', '4.7', 89, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(3, 'Budaya', 'Desa Wisata Kemiren', NULL, 'desa-wisata-kemiren', 'Kunjungi desa adat Osing yang masih mempertahankan tradisi leluhur. Nikmati kopi lokal, saksikan tarian tradisional, dan belajar tentang kearifan lokal masyarakat Using. Paket ini termasuk transportasi jeep, guide, dan makan siang.', 'Kopi, tradisi Osing, dan cerita lokal.', 'Desa Kemiren, Banyuwangi', 'Kampung Adat Osing', 450000.00, 21, 'aktif', '4 jam', 'Budaya', 'Open Trip', '4.8', 156, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(4, 'Pantai', 'Pantai Boom Banyuwangi', NULL, 'pantai-boom-banyuwangi', 'Nikmati sunrise di Pantai Boom, ikon kota Banyuwangi yang indah. Dermaga panjang, angin laut sepoi, dan pemandangan Selat Bali membuat tempat ini sempurna untuk memulai hari. Paket termasuk jeep transportasi dan sarapan ringan.', 'Sunrise, dermaga, dan angin laut kota.', 'Pantai Boom, Banyuwangi', 'Pantai Boom Marina', 250000.00, 22, 'aktif', '2 jam', 'Sunrise', 'Private', '4.5', 234, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(5, 'Festival', 'Gandrung Sewu', NULL, 'gandrung-sewu', 'Saksikan ribuan penari Gandrung yang memukau dalam festival budaya tahunan Banyuwangi. Pengalaman budaya yang tak terlupakan dengan iringan musik tradisional dan kostum yang indah. Termasuk transportasi jeep dan tiket masuk.', 'Ribuan penari dan energi budaya pesisir.', 'Banyuwangi Kota', 'Festival Gandrung Sewu', 550000.00, 23, 'aktif', '1 Hari', 'Festival', 'Eksklusif', '4.9', 320, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(6, 'Petualangan', 'Jalur Pancing Pancer', NULL, 'jalur-pancing-pancer', 'Jelajahi jalur off-road yang menantang menuju destinasi favorit para pemancing. Medan berbatu dan pemandangan laut lepas yang spektakuler akan menemani perjalanan Anda. Jeep 4x4 tangguh siap membawa Anda melewati segala medan.', 'Off-road seru ke spot pancing favorit.', 'Pancer, Banyuwangi', 'Pancer Fishing Spot', 750000.00, 24, 'aktif', '5 jam', 'Petualangan', 'Private', '4.6', 67, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(7, 'Wisata', 'Jalur Suci Sembah', NULL, 'jalur-suci-sembah', 'Perjalanan spiritual melewati jalur suci di kawasan Gunung Ijen. Nikmati ketenangan alam sambil belajar tentang sejarah dan budaya spiritual masyarakat setempat. Paket lengkap dengan guide dan transportasi.', 'Tranquil spiritual journey', 'Gunung Ijen, Banyuwangi', 'Spiritual Trail Ijen', 950000.00, 25, 'aktif', '6 jam', 'Spiritual', 'Private', '4.8', 45, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(8, 'Alam', 'sayuwiwit', NULL, 'sayuwiwit', 'sayuwiwit adalaha ai blabalbalblab', NULL, 'songgonnnn', NULL, 1000000.00, 28, 'aktif', NULL, NULL, 'Private', '6.9', 0, '2026-07-05 20:02:57', '2026-07-05 20:31:44'),
	(9, 'Petualangan', 'Badut Jahat', NULL, 'badut-jahat', 'Badut jahat konon katanya blablbalalbab', NULL, 'genteng woww', NULL, 100000.00, 29, 'aktif', '1 Hari', 'Romantis', 'Private', '100.3', 0, '2026-07-05 20:37:15', '2026-07-05 20:37:15');

-- Dumping structure for table jadiberangkat.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.faq: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.galeri
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.galeri: ~8 rows (approximately)
INSERT INTO `galeri` (`id`, `kategori`, `judul`, `gambar`, `deskripsi`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Destinasi', 'Kawah Ijen Blue Fire', 'unsplash_M8drGBgFNZE.png', 'Fenomena blue fire di Kawah Ijen yang legendaris', 'kawah-ijen-blue-fire', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(2, 'Destinasi', 'Hutan De Djawatan', 'djawatan.jpg', 'Trembesi raksasa di Hutan De Djawatan', 'hutan-de-djawatan', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(3, 'Budaya', 'Desa Wisata Kemiren', 'kemiren.png', 'Kehidupan desa adat Osing di Kemiren', 'desa-wisata-kemiren', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(4, 'Destinasi', 'Pantai Boom', 'pantaiboom.png', 'Sunrise di Pantai Boom Banyuwangi', 'pantai-boom', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(5, 'Budaya', 'Tari Gandrung Sewu', 'Tarian_Gandrung_sewu_03 1.png', 'Festival Gandrung Sewu yang memukau', 'tari-gandrung-sewu', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(6, 'Armada', 'Jeep 4x4 di Jalur Off-road', 'unsplash_Souw06F1irM.png', 'Jeep 4x4 tangguh melintasi medan berat', 'jeep-off-road', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(7, 'Armada', 'Jeep Classic Hardtop', 'jembatan.png', 'Jeep classic hardtop yang ikonik dan bertenaga', 'jeep-classic-hardtop', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(8, 'Destinasi', 'Pemandangan Alam Banyuwangi', 'bluefire.jpg', 'Keindahan alam Banyuwangi yang memukau', 'pemandangan-alam-banyuwangi', '2026-07-02 23:15:01', '2026-07-02 23:15:01');

-- Dumping structure for table jadiberangkat.galeri_item_about
CREATE TABLE IF NOT EXISTS `galeri_item_about` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sect_galeri_about_id` bigint unsigned NOT NULL,
  `gambar_id` bigint unsigned DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_video` tinyint(1) NOT NULL DEFAULT '0',
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeri_item_about_sect_galeri_about_id_foreign` (`sect_galeri_about_id`),
  KEY `galeri_item_about_gambar_id_foreign` (`gambar_id`),
  CONSTRAINT `galeri_item_about_gambar_id_foreign` FOREIGN KEY (`gambar_id`) REFERENCES `images` (`id`) ON DELETE SET NULL,
  CONSTRAINT `galeri_item_about_sect_galeri_about_id_foreign` FOREIGN KEY (`sect_galeri_about_id`) REFERENCES `sect_galeri_about` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.galeri_item_about: ~5 rows (approximately)
INSERT INTO `galeri_item_about` (`id`, `sect_galeri_about_id`, `gambar_id`, `tag`, `is_video`, `video_url`, `urutan`, `created_at`, `updated_at`) VALUES
	(1, 1, 11, 'EKSPEDISI IJEN', 0, NULL, 1, '2026-07-05 19:27:14', '2026-07-05 19:27:14'),
	(2, 1, 6, 'MOMEN SAVANA', 0, NULL, 2, '2026-07-05 19:27:14', '2026-07-05 19:27:14'),
	(3, 1, NULL, 'PESISIR', 1, 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=600', 3, '2026-07-05 19:27:14', '2026-07-05 19:27:14'),
	(4, 1, NULL, 'Meru Betiri team', 0, NULL, 4, '2026-07-05 19:27:14', '2026-07-05 19:27:14'),
	(5, 1, NULL, 'GUNUNG', 1, 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=600', 5, '2026-07-05 19:27:14', '2026-07-05 19:27:14');

-- Dumping structure for table jadiberangkat.halaman_statis
CREATE TABLE IF NOT EXISTS `halaman_statis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `halaman_statis_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.halaman_statis: ~5 rows (approximately)
INSERT INTO `halaman_statis` (`id`, `judul`, `slug`, `konten`, `tipe`, `created_at`, `updated_at`) VALUES
	(1, 'Beranda', 'beranda', '{"hero_judul":"Trip alam yang rapi dari awal sampai pulang kampung","hero_deskripsi":"Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.","hero_badge":"Jeep trip Banyuwangi","hero_jumlah_destinasi":"25+","hero_jumlah_armada":"120+","hero_rating":"4.9","eyebrow_destinasi":"Eksplorasi lokal","destinasi_judul":"Destinasi pilihan untuk vanno","destinasi_deskripsi":"Mulai dari kawah, hutan trembesi, kampung budaya, sampai pantai. Pilih satu rute utama, lalu kami susun perjalanan yang masuk akal untuk waktu dan energimu.","eyebrow_paket":"Penawaran","paket_judul":"Paket yang paling sering dipesan.","eyebrow_armada":"Kendaraan kami","armada_judul":"Armada tangguh, tampil bersih.","armada_deskripsi":"Kondisi mesin prima dan terawat, siap memberikan keamanan serta kenyamanan.","eyebrow_ulasan":"ULASAN","ulasan_judul":"Cerita setelah turun dari jeep.","ulasan_deskripsi":"Ribuan petualang telah membuktikan kualitas layanan kami lewat rute, driver, dan kendaraan yang siap jalan.","stat_hero_destinasi_label":"Destinasi","stat_destinasi_label":"Destinasi","stat_armada_label":"Armada","stat_rating_label":"Rating","stat_pengunjung_label":"Pengunjung","stat_rute_label":"Rute Trip","stat_jeep_label":"Jeep Armada","footer_judul":"Jadi Berangkat","footer_tentang":"Jelajahi Banyuwangi bersama jeep terbaik dengan driver profesional yang paham medan. Trip rapi, nyaman, dan penuh pengalaman lokal.","footer_copyright":"© 2026 Jadi Berangkat. All rights reserved.","jumlah_destinasi":"25","jumlah_armada":"120","pengunjung":"12","jumlah_rute":"50","stats_pengunjung":"12K+","stats_jumlah_destinasi":"1000+","stats_jumlah_rute":"90+","stats_jumlah_armada":"120+","tentang_hero_img":18}', 'beranda', '2026-07-02 23:15:00', '2026-07-05 19:33:12'),
	(2, 'Tentang Kami', 'tentang', '{"judul":"Petualangan Terbaik Dimulai dari <span style=\\"color: rgb(241, 52, 254);\\">hati sendiri<\\/span>","konten":"<p><span class=\\"font-extrabold\\" style=\\"color: #000;\\">PT Jadi Berangkat<\\/span> (Jeep Banyuwangi) adalah penyedia layanan wisata petualangan dan eksplorasi destinasi yang beroperasi resmi di Kabupaten Banyuwangi, Jawa Timur, menghadirkan pengalaman perjalanan aman, autentik, dan berkesan. karena itulah tujuan kamu aku dan dia<\\/p>","tentang_badge":"Tentang Kami","tentang_stat_tahun_label":"Tahun Pengalaman","tentang_stat_wisatawan_label":"Wisatawan Dilayani","tentang_stat_rute_label":"Rute Destinasi","tentang_stat_armada_label":"Armada Jeep 4x4","tentang_badge_premium":"Premium Service","tentang_caption":"Jelajahi Keindahan Alami Bersama Driver Profesional","tentang_kisah_badge":"Kisah Kami","tentang_visimisi_badge":"Landasan Kami","tentang_visi_label":"Visi","tentang_misi_label":"Misi","tentang_nilai_judul":"Mengapa Pilih Jadi monyet?","tentang_nilai_badge":"Nilai Kami","tentang_nilai_item_1_judul":"Keamanan Terjamin","tentang_nilai_item_1_desc":"Armada Jeep 4x4 terinspeksi rutin dengan standar keselamatan wisata internasional.","tentang_nilai_item_2_judul":"Eco-Tourism","tentang_nilai_item_2_desc":"Beroperasi dengan prinsip pariwisata berkelanjutan, mendukung kelestarian alam Banyuwangi.","tentang_nilai_item_3_judul":"Guide Lokal Expert","tentang_nilai_item_3_desc":"Driver sekaligus pemandu lokal berpengalaman yang mengenal setiap sudut destinasi.","tentang_nilai_item_4_judul":"Booking Digital","tentang_nilai_item_4_desc":"Sistem reservasi digital yang mudah, transparan, dan dapat diakses kapan saja.","tentang_nilai_item_5_judul":"Pengalaman Premium","tentang_nilai_item_5_desc":"Ribuan tamu telah merasakan pengalaman wisata berkesan bersama tim kami.","tentang_nilai_item_6_judul":"Komunitas Lokal","tentang_nilai_item_6_desc":"Setiap kunjungan berkontribusi langsung pada perekonomian masyarakat lokal Banyuwangi.","tentang_kisah_judul":"Lahir dari Kecintaan pada Alam Banyuwangi","tentang_kisah_p1":"Jeep Banyuwangi lahir dari semangat para pecinta alam dan petualang lokal yang ingin mengajak dunia melihat keindahan tersembunyi Banyuwangi, dari kawah biru Ijen yang memesona, savana liar Baluran, hingga pantai-pantai eksotis di ujung Jawa.","tentang_kisah_p2":"Dengan armada Jeep 4x4 yang terawat prima dan driver-guide lokal berpengalaman, kami memastikan setiap perjalanan bukan sekadar wisata biasa, melainkan sebuah petualangan yang akan selalu diingat. apabila","tentang_kisah_p3":"Kami berkomitmen pada pariwisata yang ramah lingkungan, mendukung ekonomi komunitas lokal, dan memberikan layanan digital terdepan agar pemesanan wisata semakin mudah dan menyenangkan. serta mudah di simpan","tentang_visimisi_judul":"Visi & Misi Perusahaan","tentang_visi_text":"Jadi perusahaan wisata petualangan yang dikenal karena pelayanan jujur, sopir yang asyik diajak ngobrol, dan bikin setiap trip terasa seperti jalan sama teman sendiri.","tentang_misi_item_1":"Kasih pengalaman jalan-jalan paling seru, aman, dan berkesan tanpa ribet.","tentang_misi_item_2":"Driver lokal yang ramah, paham medan, dan tahu cerita-cerita seru tiap sudut Banyuwangi.","tentang_misi_item_3":"Bikin reservasi semudah chat sama teman — cepat, transparan, tanpa banyak syarat.","tentang_misi_item_4":"Pastiin tiap perjalanan juga ngasih dampak baik buat alam dan warga lokal Banyuwangi.","tentang_galeri_img_2":"img\\/Tarian_Gandrung_sewu_03 1.png","tentang_stat_armada_angka":"200","tentang_galeri_img_1":14,"tentang_stat_tahun_angka":"5","tentang_stat_wisatawan_angka":"2000","tentang_stat_rute_angka":"20","tentang_kisah_img_2":6,"tentang_kisah_img_1":5,"tentang_hero_img":6}', 'tentang', '2026-07-02 23:15:01', '2026-07-05 20:46:53'),
	(3, 'Kebijakan Privasi', 'privasi', '{"judul":"Kebijakan Privasi & Penggunaan Situs Web","konten":"<p>Dokumen ini mengatur hak, kewajiban, dan perlindungan data Pengguna dalam menggunakan layanan digital PT. Jadi Berangkat.<\\/p>","badge":"Dokumen Resmi & Legal","tanggal":"30 Juni 2026","subtitle":"PT. Jadi Berangkat","pasal_label":"Pasal","hukum_label":"Hukum Indonesia","pdp_label":"UU PDP 2022","sections":[{"judul":"Pendahuluan","konten":"<p>Selamat datang di PT Jadi Berangkat. Kami berkomitmen penuh untuk menghormati privasi dan melindungi data pribadi setiap pengguna platform digital dan layanan petualangan kami.<\\/p>"},{"judul":"Data yang Kami Kumpulkan","konten":"<p>Untuk keperluan pemesanan dan verifikasi keamanan perjalanan wisata, kami mengumpulkan informasi berupa identitas diri, detail kontak, data transaksi, dan data teknis & lokasi.<\\/p>"},{"judul":"Tujuan Penggunaan Data","konten":"<p>Informasi yang kami kumpulkan akan kami gunakan secara bertanggung jawab untuk memproses pesanan, mengirimkan konfirmasi, memberikan dukungan pelanggan, dan mengirimkan newsletter promosi.<\\/p>"},{"judul":"Kewajiban Pengguna","konten":"<p>Sebagai pengguna platform, Anda diwajibkan untuk memberikan informasi yang akurat, menjaga kerahasiaan data akses, dan mematuhi instruksi keselamatan di lapangan.<\\/p>"},{"judul":"Larangan Penggunaan Layanan","konten":"<p>Pengguna dilarang keras untuk menyalahgunakan sistem reservasi, melakukan upaya peretasan, atau melakukan vandalisme selama perjalanan trip.<\\/p>"},{"judul":"Sanksi & Penegakan","konten":"<p>Kami berhak mengambil tindakan tegas apabila pengguna terbukti melakukan pelanggaran syarat dan ketentuan, termasuk pembatalan pemesanan sepihak dan pelaporan ke otoritas hukum.<\\/p>"},{"judul":"Perlindungan Data Pribadi","konten":"<p>Jadi Berangkat berkomitmen melindungi privasi data pribadi Anda dengan menerapkan enkripsi standar industri dan tidak akan pernah menjual data Anda ke pihak ketiga.<\\/p>"},{"judul":"Penyimpanan & Keamanan","konten":"<p>Seluruh berkas digital dan basis data disimpan di server awan yang aman dengan kontrol akses berlapis untuk menjamin keamanan data Anda.<\\/p>"},{"judul":"Hak Kekayaan Intelektual","konten":"<p>Semua konten digital, merek dagang, logo, dan aset visual di situs web ini sepenuhnya merupakan hak milik PT Jadi Berangkat.<\\/p>"},{"judul":"Ganti Rugi (Indemnity)","konten":"<p>Pengguna setuju untuk membebaskan PT Jadi Berangkat dari setiap klaim tuntutan hukum yang timbul akibat kesalahan pengguna dalam menggunakan layanan kami.<\\/p>"},{"judul":"Pembatasan Tanggung Jawab","konten":"<p>PT Jadi Berangkat tidak bertanggung jawab atas kerugian fisik, insiden kesehatan, atau pembatalan perjalanan yang disebabkan oleh faktor keadaan darurat alam.<\\/p>"},{"judul":"Penyelesaian Sengketa","konten":"<p>Para pihak sepakat untuk mengutamakan musyawarah dalam penyelesaian sengketa, dan apabila tidak tercapai kesepakatan akan dilimpahkan ke Pengadilan Negeri Banyuwangi.<\\/p>"},{"judul":"Perubahan Kebijakan","konten":"<p>Kami berhak melakukan perubahan pada Kebijakan Privasi ini seiring perkembangan teknologi dan pembaruan regulasi hukum pariwisata nasional.<\\/p>"},{"judul":"Kontak","konten":"<p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email info@jadiberangkat.com, WhatsApp +62 851 9616 1351, atau kantor fisik di Banyuwangi, Jawa Timur.<\\/p>"}]}', 'privasi', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(4, 'Bantuan', 'bantuan', '<h2>Pusat Bantuan</h2><p>Temukan jawaban untuk pertanyaan yang sering diajukan tentang pemesanan, pembayaran, dan perjalanan bersama Jadi Berangkat.</p>', 'bantuan', '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(5, 'Destinasi', 'destinasi', '{"destinasi_badge":"Eksplorasi Tak Terbatas","destinasi_judul":"Destinasi Pilihan","destinasi_deskripsi":"Temukan keindahan alam dan budaya Banyuwangi, disusun khusus untuk pengalaman petualangan Anda.","destinasi_hero_img":"img\\/bluefire (1).png","destinasi_untuk_anda_judul":"Untuk Anda"}', 'destinasi', '2026-07-05 19:51:02', '2026-07-05 19:51:02');

-- Dumping structure for table jadiberangkat.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.images: ~24 rows (approximately)
INSERT INTO `images` (`id`, `name`, `path`, `alt`, `disk`, `created_at`, `updated_at`) VALUES
	(4, 'Pantaisukamade', 'img/Pantaisukamade.png', 'Pantaisukamade', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(5, 'Tarian_Gandrung_sewu_03 1', 'img/Tarian_Gandrung_sewu_03 1.png', 'Tarian_Gandrung_sewu_03 1', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(6, 'bluefire (1)', 'img/bluefire (1).png', 'bluefire (1)', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(7, 'djawatan', 'img/djawatan.jpg', 'djawatan', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(8, 'gandrung1', 'img/gandrung1.png', 'gandrung1', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(9, 'jembatan', 'img/jembatan.png', 'jembatan', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(10, 'kemiren', 'img/kemiren.png', 'kemiren', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(11, 'laut', 'img/laut.png', 'laut', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(12, 'pantaiboom', 'img/pantaiboom.png', 'pantaiboom', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(13, 'pantaipelengkung', 'img/pantaipelengkung.png', 'pantaipelengkung', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(14, 'picto', 'img/picto.png', 'picto', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(15, 'rujaksoto', 'img/rujaksoto.png', 'rujaksoto', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(16, 'unsplash_M8drGBgFNZE', 'img/unsplash_M8drGBgFNZE.png', 'unsplash_M8drGBgFNZE', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(17, 'unsplash_Souw06F1irM', 'img/unsplash_Souw06F1irM.png', 'unsplash_Souw06F1irM', 'assets', '2026-07-05 18:59:51', '2026-07-05 20:35:22'),
	(19, 'unsplash_M8drGBgFNZE.png', 'img/unsplash_M8drGBgFNZE.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(20, 'djawatan.jpg', 'img/djawatan.jpg', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(21, 'kemiren.png', 'img/kemiren.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(22, 'pantaiboom.png', 'img/pantaiboom.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(23, 'Tarian_Gandrung_sewu_03 1.png', 'img/Tarian_Gandrung_sewu_03 1.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(24, 'unsplash_Souw06F1irM.png', 'img/unsplash_Souw06F1irM.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(25, 'jembatan.png', 'img/jembatan.png', NULL, 'assets', '2026-07-05 20:10:46', '2026-07-05 20:35:22'),
	(28, 'image-removebg-preview (20) (1)', 'uploads/PygwCjmr4Cr5YdOoNtEm8FzqjsrjDPiuQM72vUoN.png', 'image-removebg-preview (20) (1)', 'public', '2026-07-05 20:31:35', '2026-07-05 20:31:35'),
	(29, 'canva-scary-evil-clown-MADE--nqEMw', 'uploads/gbcLWNr5jHUgcNK20qrSrgIxRWR8tRfJqJmuzllW.jpg', 'canva-scary-evil-clown-MADE--nqEMw', 'public', '2026-07-05 20:36:26', '2026-07-05 20:36:26'),
	(30, 'HeroSection_News Wisata', 'uploads/DHMPiT2fYdgV2tJCZE0zivkdtxAJI3724BsisPjW.png', 'HeroSection_News Wisata', 'public', '2026-07-05 20:53:56', '2026-07-05 20:53:56');

-- Dumping structure for table jadiberangkat.include
CREATE TABLE IF NOT EXISTS `include` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `destinasi_id` bigint unsigned NOT NULL,
  `termasuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `include_destinasi_id_foreign` (`destinasi_id`),
  CONSTRAINT `include_destinasi_id_foreign` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.include: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.jadwal_perjalanan
CREATE TABLE IF NOT EXISTS `jadwal_perjalanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `destinasi_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_perjalanan_destinasi_id_foreign` (`destinasi_id`),
  CONSTRAINT `jadwal_perjalanan_destinasi_id_foreign` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.jadwal_perjalanan: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.media_sosial
CREATE TABLE IF NOT EXISTS `media_sosial` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ikon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.media_sosial: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.migrations: ~22 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_07_03_014125_create_destinasi_table', 1),
	(6, '2026_07_03_014126_create_include_table', 1),
	(7, '2026_07_03_014126_create_jadwal_perjalanan_table', 1),
	(8, '2026_07_03_014127_create_ulasan_table', 1),
	(9, '2026_07_03_014127_create_un_include_table', 1),
	(10, '2026_07_03_014128_create_galeri_table', 1),
	(11, '2026_07_03_014129_create_artikel_table', 1),
	(12, '2026_07_03_014129_create_halaman_statis_table', 1),
	(13, '2026_07_03_014129_create_media_sosial_table', 1),
	(14, '2026_07_03_014130_create_pengaturan_halaman_depan_table', 1),
	(15, '2026_07_03_014131_create_faq_table', 1),
	(16, '2026_07_03_035517_create_seo_settings_table', 1),
	(17, '2026_07_03_061059_add_fields_to_destinasi_table', 1),
	(18, '2026_07_06_000001_add_text_color_to_users_table', 2),
	(19, '2026_07_06_000002_create_images_table', 3),
	(20, '2026_07_06_000003_create_home_sections_tables', 3),
	(21, '2026_07_06_000004_create_about_sections_tables', 3),
	(22, '2026_07_06_031018_update_destinasi_table_foreign_keys', 4);

-- Dumping structure for table jadiberangkat.misi_item
CREATE TABLE IF NOT EXISTS `misi_item` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sect_visimisi_id` bigint unsigned NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `misi_item_sect_visimisi_id_foreign` (`sect_visimisi_id`),
  CONSTRAINT `misi_item_sect_visimisi_id_foreign` FOREIGN KEY (`sect_visimisi_id`) REFERENCES `sect_visimisi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.misi_item: ~4 rows (approximately)
INSERT INTO `misi_item` (`id`, `sect_visimisi_id`, `nomor`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 1, '01', 'Kasih pengalaman jalan-jalan paling seru, aman, dan berkesan tanpa ribet.', '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(2, 1, '02', 'Driver lokal yang ramah, paham medan, dan tahu cerita-cerita seru tiap sudut Banyuwangi.', '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(3, 1, '03', 'Bikin reservasi semudah chat sama teman — cepat, transparan, tanpa banyak syarat.', '2026-07-05 19:00:46', '2026-07-05 19:00:46'),
	(4, 1, '04', 'Pastiin tiap perjalanan juga ngasih dampak baik buat alam dan warga lokal Banyuwangi.', '2026-07-05 19:00:46', '2026-07-05 19:00:46');

-- Dumping structure for table jadiberangkat.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.pengaturan_halaman_depan
CREATE TABLE IF NOT EXISTS `pengaturan_halaman_depan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaturan_halaman_depan_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.pengaturan_halaman_depan: ~19 rows (approximately)
INSERT INTO `pengaturan_halaman_depan` (`id`, `key`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
	(1, 'jumlah_destinasi', '25', 'angka', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(2, 'jumlah_armada', '120', 'angka', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(3, 'pengunjung', '12', 'angka', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(4, 'jumlah_rute', '50', 'angka', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(5, 'hero_judul', 'Trip alam yang rapi dari awal sampai pulang.', 'text', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(6, 'hero_subjudul', 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.', 'text', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(7, 'cta_judul', 'Siap menjelajah Banyuwangi?', 'text', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(8, 'cta_subjudul', 'Booking jeep-mu sekarang dan nikmati trip alam yang rapi dari awal sampai pulang.', 'text', '2026-07-02 23:15:00', '2026-07-02 23:15:00'),
	(9, 'copyright', '© 2026 Jadi Berangkat. All rights reserved. laly', 'text', '2026-07-02 23:15:00', '2026-07-05 18:22:41'),
	(10, 'hero_label', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(11, 'hero_deskripsi', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(12, 'hero_btn', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(13, 'statistik_1', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(14, 'statistik_1_label', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(15, 'statistik_2', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(16, 'statistik_2_label', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(17, 'statistik_3', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(18, 'statistik_3_label', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41'),
	(19, 'cta_deskripsi', NULL, 'text', '2026-07-05 18:22:41', '2026-07-05 18:22:41');

-- Dumping structure for table jadiberangkat.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.sect_about_hero
CREATE TABLE IF NOT EXISTS `sect_about_hero` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci,
  `stat_1_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_1_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_2_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_2_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_3_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_3_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_4_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_4_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_id` bigint unsigned DEFAULT NULL,
  `badge_premium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sect_about_hero_gambar_id_foreign` (`gambar_id`),
  CONSTRAINT `sect_about_hero_gambar_id_foreign` FOREIGN KEY (`gambar_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_about_hero: ~1 rows (approximately)
INSERT INTO `sect_about_hero` (`id`, `badge`, `judul`, `konten`, `stat_1_angka`, `stat_1_label`, `stat_2_angka`, `stat_2_label`, `stat_3_angka`, `stat_3_label`, `stat_4_angka`, `stat_4_label`, `gambar_id`, `badge_premium`, `caption`, `created_at`, `updated_at`) VALUES
	(1, 'Tentang Kami', 'Petualangan Terbaik Dimulai dari <span style="color: rgb(241, 52, 254);">hati sendiri</span>', '<p><span class="font-extrabold" style="color: #000;">PT Jadi Berangkat</span> (Jeep Banyuwangi) adalah penyedia layanan wisata petualangan dan eksplorasi destinasi yang beroperasi resmi di Kabupaten Banyuwangi, Jawa Timur, menghadirkan pengalaman perjalanan aman, autentik, dan berkesan. karena itulah tujuan kamu aku dan dia</p>', '5', 'Tahun Pengalaman', '2000', 'Wisatawan Dilayani', '20', 'Rute Destinasi', '200', 'Armada Jeep 4x4', 6, 'Premium Service', 'Jelajahi Keindahan Alami Bersama Driver Profesional', '2026-07-05 18:59:51', '2026-07-05 20:46:53');

-- Dumping structure for table jadiberangkat.sect_galeri_about
CREATE TABLE IF NOT EXISTS `sect_galeri_about` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tombol_teks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_galeri_about: ~1 rows (approximately)
INSERT INTO `sect_galeri_about` (`id`, `label`, `judul`, `tombol_teks`, `created_at`, `updated_at`) VALUES
	(1, 'Galeri Kegiatan', 'Momen Bersama Kami', 'Koleksi Media', '2026-07-05 19:00:46', '2026-07-05 19:00:46');

-- Dumping structure for table jadiberangkat.sect_home_cta
CREATE TABLE IF NOT EXISTS `sect_home_cta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_home_cta: ~1 rows (approximately)
INSERT INTO `sect_home_cta` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Siap Mulai Petualangan?', 'Hubungi tim kami untuk pertanyaan, reservasi, atau custom trip.', '2026-07-05 18:59:51', '2026-07-05 18:59:51');

-- Dumping structure for table jadiberangkat.sect_home_footer
CREATE TABLE IF NOT EXISTS `sect_home_footer` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tentang` text COLLATE utf8mb4_unicode_ci,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_home_footer: ~1 rows (approximately)
INSERT INTO `sect_home_footer` (`id`, `judul`, `tentang`, `copyright`, `created_at`, `updated_at`) VALUES
	(1, 'Jadi Berangkat', 'Jelajahi Banyuwangi bersama jeep terbaik dengan driver profesional yang paham medan. Trip rapi, nyaman, dan penuh pengalaman lokal.', '© 2026 Jadi Berangkat. All rights reserved.', '2026-07-05 18:59:51', '2026-07-05 18:59:51');

-- Dumping structure for table jadiberangkat.sect_home_hero
CREATE TABLE IF NOT EXISTS `sect_home_hero` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `btn_booking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_destinasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_destinasi_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_destinasi_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_armada_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_armada_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_rating_angka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_rating_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_latar_id` bigint unsigned DEFAULT NULL,
  `embed_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sect_home_hero_gambar_latar_id_foreign` (`gambar_latar_id`),
  CONSTRAINT `sect_home_hero_gambar_latar_id_foreign` FOREIGN KEY (`gambar_latar_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_home_hero: ~1 rows (approximately)
INSERT INTO `sect_home_hero` (`id`, `badge`, `judul`, `deskripsi`, `btn_booking`, `btn_destinasi`, `stat_destinasi_angka`, `stat_destinasi_label`, `stat_armada_angka`, `stat_armada_label`, `stat_rating_angka`, `stat_rating_label`, `gambar_latar_id`, `embed_video`, `created_at`, `updated_at`) VALUES
	(1, 'Jeep trip Banyuwangi', 'Trip alam yang rapi dari awal sampai pulang kampung', 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.', 'Booking Trip', 'Lihat Destinasi', '25+', 'Destinasi', '120+', 'Armada', '4.9', 'Rating', NULL, 'https://www.youtube.com/embed/qNVdijuWwGo', '2026-07-05 18:59:51', '2026-07-05 18:59:51');

-- Dumping structure for table jadiberangkat.sect_home_penawaran
CREATE TABLE IF NOT EXISTS `sect_home_penawaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `eyebrow` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_home_penawaran: ~1 rows (approximately)
INSERT INTO `sect_home_penawaran` (`id`, `eyebrow`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Penawaran', 'Paket yang paling sering dipesan.', '', '2026-07-05 18:59:51', '2026-07-05 18:59:51');

-- Dumping structure for table jadiberangkat.sect_kisah
CREATE TABLE IF NOT EXISTS `sect_kisah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_1` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_2` text COLLATE utf8mb4_unicode_ci,
  `highlight_text` text COLLATE utf8mb4_unicode_ci,
  `gambar_1_id` bigint unsigned DEFAULT NULL,
  `gambar_2_id` bigint unsigned DEFAULT NULL,
  `badge_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sect_kisah_gambar_1_id_foreign` (`gambar_1_id`),
  KEY `sect_kisah_gambar_2_id_foreign` (`gambar_2_id`),
  CONSTRAINT `sect_kisah_gambar_1_id_foreign` FOREIGN KEY (`gambar_1_id`) REFERENCES `images` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sect_kisah_gambar_2_id_foreign` FOREIGN KEY (`gambar_2_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_kisah: ~1 rows (approximately)
INSERT INTO `sect_kisah` (`id`, `badge`, `judul`, `deskripsi_1`, `deskripsi_2`, `highlight_text`, `gambar_1_id`, `gambar_2_id`, `badge_text`, `created_at`, `updated_at`) VALUES
	(1, 'Kisah Kami', 'Lahir dari Kecintaan pada Alam Banyuwangi', 'Jeep Banyuwangi lahir dari semangat para pecinta alam dan petualang lokal yang ingin mengajak dunia melihat keindahan tersembunyi Banyuwangi, dari kawah biru Ijen yang memesona, savana liar Baluran, hingga pantai-pantai eksotis di ujung Jawa.', 'Dengan armada Jeep 4x4 yang terawat prima dan driver-guide lokal berpengalaman, kami memastikan setiap perjalanan bukan sekadar wisata biasa, melainkan sebuah petualangan yang akan selalu diingat. apabila', 'Kami berkomitmen pada pariwisata yang ramah lingkungan, mendukung ekonomi komunitas lokal, dan memberikan layanan digital terdepan agar pemesanan wisata semakin mudah dan menyenangkan. serta mudah di simpan', 5, 6, '100% Local Empowerment', '2026-07-05 18:59:51', '2026-07-05 19:32:04');

-- Dumping structure for table jadiberangkat.sect_nilai
CREATE TABLE IF NOT EXISTS `sect_nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_nilai: ~1 rows (approximately)
INSERT INTO `sect_nilai` (`id`, `badge`, `judul`, `created_at`, `updated_at`) VALUES
	(1, 'Nilai Kami', 'Mengapa Pilih Jadi monyet?', '2026-07-05 19:00:46', '2026-07-05 19:00:46');

-- Dumping structure for table jadiberangkat.sect_visimisi
CREATE TABLE IF NOT EXISTS `sect_visimisi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visi_deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.sect_visimisi: ~1 rows (approximately)
INSERT INTO `sect_visimisi` (`id`, `badge`, `judul`, `visi_deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Landasan Kami', 'Visi & Misi Perusahaan', 'Jadi perusahaan wisata petualangan yang dikenal karena pelayanan jujur, sopir yang asyik diajak ngobrol, dan bikin setiap trip terasa seperti jalan sama teman sendiri.', '2026-07-05 18:59:51', '2026-07-05 18:59:51');

-- Dumping structure for table jadiberangkat.seo_settings
CREATE TABLE IF NOT EXISTS `seo_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seo_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.seo_settings: ~5 rows (approximately)
INSERT INTO `seo_settings` (`id`, `key`, `value`, `tipe`, `created_at`, `updated_at`) VALUES
	(1, 'meta_title', NULL, 'text', '2026-07-05 18:23:33', '2026-07-05 18:23:33'),
	(2, 'meta_description', NULL, 'text', '2026-07-05 18:23:33', '2026-07-05 18:23:33'),
	(3, 'meta_keywords', NULL, 'text', '2026-07-05 18:23:33', '2026-07-05 18:23:33'),
	(4, 'favicon', 'seo/vRGjRyMZbTDgUI1ypJ29Jlyu5QRllXTlifiw4y0Z.png', 'file', '2026-07-05 18:23:33', '2026-07-05 18:23:33'),
	(5, 'logo', 'seo/9qNRVw1gEa72KTsHVYIsi9PSThmnjyLkAiX23AU5.png', 'file', '2026-07-05 18:23:33', '2026-07-05 18:23:33');

-- Dumping structure for table jadiberangkat.ulasan
CREATE TABLE IF NOT EXISTS `ulasan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bintang` int NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ditampilkan` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.ulasan: ~6 rows (approximately)
INSERT INTO `ulasan` (`id`, `bintang`, `pesan`, `gambar_profile`, `nama_user`, `kategori`, `ditampilkan`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Sangat terkesan dengan pelayanan JB. Driver ramah dan paham betul kondisi jalanan. Rute Hutan De Djawatan jadi super seru!', NULL, 'Andi Saputraw', 'Trip Hutan', 1, '2026-07-02 23:15:01', '2026-07-05 18:22:12'),
	(2, 4, 'Pengalaman kultural di Desa Kemiren sangat otentik. Jeep yang dipakai bersih dan mesinnya halus. Sangat direkomendasikan!', NULL, 'Rina Melati', 'Budaya Trip', 1, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(3, 5, 'Tripnya sangat on-time dan profesional. Kendaraannya benar-benar tangguh melintasi jalanan berat tanpa hambatan sama sekali!', NULL, 'Dimas Kusuma', 'Open Trip', 1, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(4, 5, 'Blue Fire Ijen adalah pengalaman yang luar biasa! Guide sangat berpengalaman dan jeepnya nyaman. Pasti balik lagi!', NULL, 'Sari Dewi', 'Ijen Trip', 1, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(5, 4, 'Pantai Boom sunrise tour sangat indah. Jeep-nya bersih dan driver tepat waktu. Sarapan yang disediakan juga enak!', NULL, 'Budi Hartono', 'Sunrise Tour', 1, '2026-07-02 23:15:01', '2026-07-02 23:15:01'),
	(6, 5, 'Gandrung Sewu festival benar-benar spektakuler! Terima kasih JB sudah mengatur semuanya dengan rapi. Sangat puas!', NULL, 'Mega Putri', 'Festival', 1, '2026-07-02 23:15:01', '2026-07-02 23:15:01');

-- Dumping structure for table jadiberangkat.un_include
CREATE TABLE IF NOT EXISTS `un_include` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `destinasi_id` bigint unsigned NOT NULL,
  `tidak_termasuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `un_include_destinasi_id_foreign` (`destinasi_id`),
  CONSTRAINT `un_include_destinasi_id_foreign` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.un_include: ~0 rows (approximately)

-- Dumping structure for table jadiberangkat.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jadiberangkat.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `text_color`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@jadiberangkat.com', '2026-07-02 23:14:57', '$2y$12$i/VcIu9bv/YHE.Tx.oA2Su8VeHibzVzf1GgXiN7vrrNEAP7p7vU.K', '#000000', 'rdp2zBK5RZKE9U5hxpgyZbvIQ60lHuQrglO5ozwtu1dlcwTyWUYAnkn4jTye', '2026-07-02 23:15:00', '2026-07-02 23:15:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
