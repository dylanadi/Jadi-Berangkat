<?php

namespace Database\Seeders;

use App\Models\HalamanStatis;
use Illuminate\Database\Seeder;

class HalamanStatisSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'judul' => 'Beranda',
                'slug' => 'beranda',
                'konten' => json_encode([
                    'hero_judul' => 'Trip alam yang rapi dari awal sampai pulang.',
                    'hero_deskripsi' => 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.',
                    'hero_badge' => 'Jeep trip Banyuwangi',
                    'hero_jumlah_destinasi' => '25',
                    'hero_jumlah_armada' => '120',
                    'hero_rating' => '4.9',
                    'eyebrow_destinasi' => 'Eksplorasi lokal',
                    'destinasi_judul' => 'Destinasi pilihan untuk satu hari yang utuh.',
                    'destinasi_deskripsi' => 'Mulai dari kawah, hutan trembesi, kampung budaya, sampai pantai. Pilih satu rute utama, lalu kami susun perjalanan yang masuk akal untuk waktu dan energimu.',
                    'eyebrow_paket' => 'Penawaran',
                    'paket_judul' => 'Paket yang paling sering dipesan.',
                    'eyebrow_armada' => 'Kendaraan kami',
                    'armada_judul' => 'Armada tangguh, tampil bersih.',
                    'armada_deskripsi' => 'Kondisi mesin prima dan terawat, siap memberikan keamanan serta kenyamanan.',
                    'eyebrow_ulasan' => 'Ulasan',
                    'ulasan_judul' => 'Cerita setelah turun dari jeep.',
                    'ulasan_deskripsi' => 'Ribuan petualang telah membuktikan kualitas layanan kami lewat rute, driver, dan kendaraan yang siap jalan.',
                    'stat_hero_destinasi_label' => 'Destinasi',
                    'stat_destinasi_label' => 'Destinasi',
                    'stat_armada_label' => 'Armada',
                    'stat_rating_label' => 'Rating',
                    'stat_pengunjung_label' => 'Pengunjung',
                    'stat_rute_label' => 'Rute Trip',
                    'stat_jeep_label' => 'Jeep Armada',
                    'footer_judul' => 'Jadi Berangkat',
                    'footer_tentang' => 'Jelajahi Banyuwangi bersama jeep terbaik dengan driver profesional yang paham medan. Trip rapi, nyaman, dan penuh pengalaman lokal.',
                    'footer_copyright' => '© ' . date('Y') . ' Jadi Berangkat. All rights reserved.',
                    'jumlah_destinasi' => '25',
                    'jumlah_armada' => '120',
                    'pengunjung' => '12',
                    'jumlah_rute' => '50',
                    'stats_pengunjung' => '12',
                    'stats_jumlah_destinasi' => '25',
                    'stats_jumlah_rute' => '50',
                    'stats_jumlah_armada' => '120',
                ], JSON_UNESCAPED_UNICODE),
                'tipe' => 'beranda',
            ],
            [
                'judul' => 'Tentang Kami',
                'slug' => 'tentang',
                'konten' => json_encode([
                    'judul' => 'Petualangan Terbaik',
                    'konten' => '<span class="font-extrabold" style="color:#000">PT Jadi Berangkat</span> (Jeep Banyuwangi) adalah penyedia layanan wisata petualangan dan eksplorasi destinasi yang beroperasi resmi di Kabupaten Banyuwangi, Jawa Timur, menghadirkan pengalaman perjalanan aman, autentik, dan berkesan.',
                    'tentang_badge' => 'Tentang Kami',
                    'tentang_stat_tahun_label' => 'Tahun Pengalaman',
                    'tentang_stat_wisatawan_label' => 'Wisatawan Dilayani',
                    'tentang_stat_rute_label' => 'Rute Destinasi',
                    'tentang_stat_armada_label' => 'Armada Jeep 4x4',
                    'tentang_badge_premium' => 'Premium Service',
                    'tentang_caption' => 'Jelajahi Keindahan Alami Bersama Driver Profesional',
                    'tentang_kisah_badge' => 'Kisah Kami',
                    'tentang_visimisi_badge' => 'Landasan Kami',
                    'tentang_visi_label' => 'Visi',
                    'tentang_misi_label' => 'Misi',
                    'tentang_nilai_judul' => 'Mengapa Pilih Jadi Berangkat?',
                    'tentang_nilai_badge' => 'Nilai Kami',
                    'tentang_nilai_item_1_judul' => 'Keamanan Terjamin',
                    'tentang_nilai_item_1_desc' => 'Armada Jeep 4x4 terinspeksi rutin dengan standar keselamatan wisata internasional.',
                    'tentang_nilai_item_2_judul' => 'Eco-Tourism',
                    'tentang_nilai_item_2_desc' => 'Beroperasi dengan prinsip pariwisata berkelanjutan, mendukung kelestarian alam Banyuwangi.',
                    'tentang_nilai_item_3_judul' => 'Guide Lokal Expert',
                    'tentang_nilai_item_3_desc' => 'Driver sekaligus pemandu lokal berpengalaman yang mengenal setiap sudut destinasi.',
                    'tentang_nilai_item_4_judul' => 'Booking Digital',
                    'tentang_nilai_item_4_desc' => 'Sistem reservasi digital yang mudah, transparan, dan dapat diakses kapan saja.',
                    'tentang_nilai_item_5_judul' => 'Pengalaman Premium',
                    'tentang_nilai_item_5_desc' => 'Ribuan tamu telah merasakan pengalaman wisata berkesan bersama tim kami.',
                    'tentang_nilai_item_6_judul' => 'Komunitas Lokal',
                    'tentang_nilai_item_6_desc' => 'Setiap kunjungan berkontribusi langsung pada perekonomian masyarakat lokal Banyuwangi.',
                    'tentang_kisah_judul' => 'Lahir dari Kecintaan pada Alam Banyuwangi',
                    'tentang_kisah_p1' => 'Jeep Banyuwangi lahir dari semangat para pecinta alam dan petualang lokal yang ingin mengajak dunia melihat keindahan tersembunyi Banyuwangi, dari kawah biru Ijen yang memesona, savana liar Baluran, hingga pantai-pantai eksotis di ujung Jawa.',
                    'tentang_kisah_p2' => 'Dengan armada Jeep 4x4 yang terawat prima dan driver-guide lokal berpengalaman, kami memastikan setiap perjalanan bukan sekadar wisata biasa, melainkan sebuah petualangan yang akan selalu diingat.',
                    'tentang_kisah_p3' => 'Kami berkomitmen pada pariwisata yang ramah lingkungan, mendukung ekonomi komunitas lokal, dan memberikan layanan digital terdepan agar pemesanan wisata semakin mudah dan menyenangkan.',
                    'tentang_visimisi_judul' => 'Visi & Misi Perusahaan',
                    'tentang_visi_text' => 'Jadi perusahaan wisata petualangan yang dikenal karena pelayanan jujur, sopir yang asyik diajak ngobrol, dan bikin setiap trip terasa seperti jalan sama teman sendiri.',
                    'tentang_misi_item_1' => 'Kasih pengalaman jalan-jalan paling seru, aman, dan berkesan tanpa ribet.',
                    'tentang_misi_item_2' => 'Driver lokal yang ramah, paham medan, dan tahu cerita-cerita seru tiap sudut Banyuwangi.',
                    'tentang_misi_item_3' => 'Bikin reservasi semudah chat sama teman — cepat, transparan, tanpa banyak syarat.',
                    'tentang_misi_item_4' => 'Pastiin tiap perjalanan juga ngasih dampak baik buat alam dan warga lokal Banyuwangi.',
                ], JSON_UNESCAPED_UNICODE),
                'tipe' => 'tentang',
            ],
            [
                'judul' => 'Kebijakan Privasi',
                'slug' => 'privasi',
                'konten' => json_encode([
                    'judul' => 'Kebijakan Privasi & Penggunaan Situs Web',
                    'konten' => '<p>Dokumen ini mengatur hak, kewajiban, dan perlindungan data Pengguna dalam menggunakan layanan digital PT. Jadi Berangkat.</p>',
                    'badge' => 'Dokumen Resmi & Legal',
                    'tanggal' => '30 Juni 2026',
                    'subtitle' => 'PT. Jadi Berangkat',
                    'pasal_label' => 'Pasal',
                    'hukum_label' => 'Hukum Indonesia',
                    'pdp_label' => 'UU PDP 2022',
                    'sections' => [
                        ['judul' => 'Pendahuluan', 'konten' => '<p>Selamat datang di PT Jadi Berangkat. Kami berkomitmen penuh untuk menghormati privasi dan melindungi data pribadi setiap pengguna platform digital dan layanan petualangan kami.</p>'],
                        ['judul' => 'Data yang Kami Kumpulkan', 'konten' => '<p>Untuk keperluan pemesanan dan verifikasi keamanan perjalanan wisata, kami mengumpulkan informasi berupa identitas diri, detail kontak, data transaksi, dan data teknis & lokasi.</p>'],
                        ['judul' => 'Tujuan Penggunaan Data', 'konten' => '<p>Informasi yang kami kumpulkan akan kami gunakan secara bertanggung jawab untuk memproses pesanan, mengirimkan konfirmasi, memberikan dukungan pelanggan, dan mengirimkan newsletter promosi.</p>'],
                        ['judul' => 'Kewajiban Pengguna', 'konten' => '<p>Sebagai pengguna platform, Anda diwajibkan untuk memberikan informasi yang akurat, menjaga kerahasiaan data akses, dan mematuhi instruksi keselamatan di lapangan.</p>'],
                        ['judul' => 'Larangan Penggunaan Layanan', 'konten' => '<p>Pengguna dilarang keras untuk menyalahgunakan sistem reservasi, melakukan upaya peretasan, atau melakukan vandalisme selama perjalanan trip.</p>'],
                        ['judul' => 'Sanksi & Penegakan', 'konten' => '<p>Kami berhak mengambil tindakan tegas apabila pengguna terbukti melakukan pelanggaran syarat dan ketentuan, termasuk pembatalan pemesanan sepihak dan pelaporan ke otoritas hukum.</p>'],
                        ['judul' => 'Perlindungan Data Pribadi', 'konten' => '<p>Jadi Berangkat berkomitmen melindungi privasi data pribadi Anda dengan menerapkan enkripsi standar industri dan tidak akan pernah menjual data Anda ke pihak ketiga.</p>'],
                        ['judul' => 'Penyimpanan & Keamanan', 'konten' => '<p>Seluruh berkas digital dan basis data disimpan di server awan yang aman dengan kontrol akses berlapis untuk menjamin keamanan data Anda.</p>'],
                        ['judul' => 'Hak Kekayaan Intelektual', 'konten' => '<p>Semua konten digital, merek dagang, logo, dan aset visual di situs web ini sepenuhnya merupakan hak milik PT Jadi Berangkat.</p>'],
                        ['judul' => 'Ganti Rugi (Indemnity)', 'konten' => '<p>Pengguna setuju untuk membebaskan PT Jadi Berangkat dari setiap klaim tuntutan hukum yang timbul akibat kesalahan pengguna dalam menggunakan layanan kami.</p>'],
                        ['judul' => 'Pembatasan Tanggung Jawab', 'konten' => '<p>PT Jadi Berangkat tidak bertanggung jawab atas kerugian fisik, insiden kesehatan, atau pembatalan perjalanan yang disebabkan oleh faktor keadaan darurat alam.</p>'],
                        ['judul' => 'Penyelesaian Sengketa', 'konten' => '<p>Para pihak sepakat untuk mengutamakan musyawarah dalam penyelesaian sengketa, dan apabila tidak tercapai kesepakatan akan dilimpahkan ke Pengadilan Negeri Banyuwangi.</p>'],
                        ['judul' => 'Perubahan Kebijakan', 'konten' => '<p>Kami berhak melakukan perubahan pada Kebijakan Privasi ini seiring perkembangan teknologi dan pembaruan regulasi hukum pariwisata nasional.</p>'],
                        ['judul' => 'Kontak', 'konten' => '<p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email info@jadiberangkat.com, WhatsApp +62 851 9616 1351, atau kantor fisik di Banyuwangi, Jawa Timur.</p>'],
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'tipe' => 'privasi',
            ],
            [
                'judul' => 'Bantuan',
                'slug' => 'bantuan',
                'konten' => '<h2>Pusat Bantuan</h2><p>Temukan jawaban untuk pertanyaan yang sering diajukan tentang pemesanan, pembayaran, dan perjalanan bersama Jadi Berangkat.</p>',
                'tipe' => 'bantuan',
            ],
        ];

        foreach ($pages as $page) {
            $existing = HalamanStatis::where('tipe', $page['tipe'])->first();
            if ($existing) {
                $existing->update($page);
            } else {
                HalamanStatis::create($page);
            }
        }
    }
}
