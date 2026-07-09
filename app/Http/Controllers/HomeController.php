<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Ulasan;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\MediaSosial;
use App\Models\PengaturanHalamanDepan;
use App\Models\HalamanStatis;
use App\Models\SectHomeHero;
use App\Models\SectHomePenawaran;
use App\Models\SectHomeCta;
use App\Models\SectHomeFooter;
use App\Models\SectAboutHero;
use App\Models\SectKisah;
use App\Models\SectVisimisi;
use App\Models\MisiItem;
use App\Models\SectNilai;
use App\Models\CardNilai;
use App\Models\SectGaleriAbout;
use App\Models\GaleriItemAbout;

class HomeController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('status', 'aktif')->inRandomOrder()->take(5)->get();
        $paket = Destinasi::where('status', 'aktif')->latest()->take(6)->get();
        $armada = Destinasi::where('status', 'aktif')->take(4)->get();
        $ulasan = Ulasan::where('ditampilkan', true)->get();
        $galeri = Galeri::take(8)->get();
        $artikel = Artikel::where('status', 'terbit')->latest()->take(3)->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        $page = HalamanStatis::where('tipe', 'beranda')->first();
        $pengaturan = (object) ($page ? json_decode($page->konten, true) : []);

        $hero = SectHomeHero::first();
        $penawaran = SectHomePenawaran::first();
        $cta = SectHomeCta::first();
        $footerData = SectHomeFooter::first();

        $pengaturanArr = (array) $pengaturan;
        if ($hero) {
            $pengaturanArr['hero_badge'] = $hero->badge;
            $pengaturanArr['hero_judul'] = $hero->judul;
            $pengaturanArr['hero_deskripsi'] = $hero->deskripsi;
            $pengaturanArr['button_booking'] = $hero->btn_booking;
            $pengaturanArr['button_destinasi'] = $hero->btn_destinasi;
            $pengaturanArr['hero_jumlah_destinasi'] = $hero->stat_destinasi_angka;
            $pengaturanArr['stat_hero_destinasi_label'] = $hero->stat_destinasi_label;
            $pengaturanArr['hero_jumlah_armada'] = $hero->stat_armada_angka;
            $pengaturanArr['stat_armada_label'] = $hero->stat_armada_label;
            $pengaturanArr['hero_rating'] = $hero->stat_rating_angka;
            $pengaturanArr['stat_rating_label'] = $hero->stat_rating_label;
        }
        if ($penawaran) {
            $pengaturanArr['eyebrow_paket'] = $penawaran->eyebrow;
            $pengaturanArr['paket_judul'] = $penawaran->judul;
            $pengaturanArr['paket_deskripsi'] = $penawaran->deskripsi;
        }
        if ($cta) {
            $pengaturanArr['cta_judul'] = $cta->judul;
            $pengaturanArr['cta_deskripsi'] = $cta->deskripsi;
        }
        if ($footerData) {
            $pengaturanArr['footer_judul'] = $footerData->judul;
            $pengaturanArr['footer_tentang'] = $footerData->tentang;
            $pengaturanArr['footer_copyright'] = $footerData->copyright;
        }
        $pengaturan = (object) $pengaturanArr;

        $footerData = $footerData ? [
            'footer_judul' => $footerData->judul,
            'footer_tentang' => $footerData->tentang,
            'footer_copyright' => $footerData->copyright,
        ] : [];

        return view('home', compact(
            'destinasi', 'paket', 'armada', 'ulasan', 'galeri', 'artikel',
            'mediaSosial', 'pengaturan', 'page',
            'hero', 'penawaran', 'cta', 'footerData'
        ));
    }

    public function tentang()
    {
        $page = HalamanStatis::where('tipe', 'tentang')->first();
        $data = (object) ($page ? json_decode($page->konten, true) : []);
        $halaman = $page;
        $mediaSosial = MediaSosial::where('aktif', true)->get();

        $footerModel = SectHomeFooter::first();
        $footerData = $footerModel ? [
            'footer_judul' => $footerModel->judul,
            'footer_tentang' => $footerModel->tentang,
            'footer_copyright' => $footerModel->copyright,
        ] : [];

        $aboutHero = SectAboutHero::with('gambar')->first();
        $kisah = SectKisah::with('gambar1', 'gambar2')->first();
        $visimisi = SectVisimisi::with('misiItems')->first();
        $nilai = SectNilai::with('cardNilai')->first();
        $galeriAbout = SectGaleriAbout::with('items.gambar')->first();

        $dataArr = (array) $data;
        if ($aboutHero) {
            $dataArr['tentang_badge'] = $aboutHero->badge;
            $dataArr['judul'] = $aboutHero->judul;
            $dataArr['konten'] = $aboutHero->konten;
            $dataArr['tentang_stat_tahun_angka'] = $aboutHero->stat_1_angka;
            $dataArr['tentang_stat_tahun_label'] = $aboutHero->stat_1_label;
            $dataArr['tentang_stat_wisatawan_angka'] = $aboutHero->stat_2_angka;
            $dataArr['tentang_stat_wisatawan_label'] = $aboutHero->stat_2_label;
            $dataArr['tentang_stat_rute_angka'] = $aboutHero->stat_3_angka;
            $dataArr['tentang_stat_rute_label'] = $aboutHero->stat_3_label;
            $dataArr['tentang_stat_armada_angka'] = $aboutHero->stat_4_angka;
            $dataArr['tentang_stat_armada_label'] = $aboutHero->stat_4_label;
            $dataArr['tentang_badge_premium'] = $aboutHero->badge_premium;
            $dataArr['tentang_caption'] = $aboutHero->caption;
        }
        if ($kisah) {
            $dataArr['tentang_kisah_badge'] = $kisah->badge;
            $dataArr['tentang_kisah_judul'] = $kisah->judul;
            $dataArr['tentang_kisah_p1'] = $kisah->deskripsi_1;
            $dataArr['tentang_kisah_p2'] = $kisah->deskripsi_2;
            $dataArr['tentang_kisah_p3'] = $kisah->highlight_text;
        }
        if ($visimisi) {
            $dataArr['tentang_visimisi_badge'] = $visimisi->badge;
            $dataArr['tentang_visimisi_judul'] = $visimisi->judul;
            $dataArr['tentang_visi_text'] = $visimisi->visi_deskripsi;
        }
        if ($nilai) {
            $dataArr['tentang_nilai_badge'] = $nilai->badge;
            $dataArr['tentang_nilai_judul'] = $nilai->judul;
            foreach ($nilai->cardNilai as $i => $card) {
                $idx = $i + 1;
                $dataArr["tentang_nilai_item_{$idx}_judul"] = $card->judul;
                $dataArr["tentang_nilai_item_{$idx}_desc"] = $card->deskripsi;
            }
        }
        $data = (object) $dataArr;

        return view('tentang', compact(
            'data', 'halaman', 'mediaSosial', 'footerData',
            'aboutHero', 'kisah', 'visimisi', 'nilai', 'galeriAbout'
        ));
    }

    public function privasi()
    {
        $page = HalamanStatis::where('tipe', 'privasi')->first();
        $data = (object) ($page ? json_decode($page->konten, true) : []);
        $halaman = $page;
        $sections = $data->sections ?? [];
        $footerModel = SectHomeFooter::first();
        $footerData = $footerModel ? [
            'footer_judul' => $footerModel->judul,
            'footer_tentang' => $footerModel->tentang,
            'footer_copyright' => $footerModel->copyright,
        ] : [];
        return view('privasi', compact('data', 'halaman', 'sections', 'footerData'));
    }

    public function bantuan()
    {
        $halaman = HalamanStatis::where('tipe', 'bantuan')->first();
        $faqs = \App\Models\Faq::orderBy('id')->get();
        $footerModel = SectHomeFooter::first();
        $footerData = $footerModel ? [
            'footer_judul' => $footerModel->judul,
            'footer_tentang' => $footerModel->tentang,
            'footer_copyright' => $footerModel->copyright,
        ] : [];
        return view('bantuan', compact('halaman', 'footerData', 'faqs'));
    }
}
