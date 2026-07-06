@extends('layouts.app')

@section('title', 'Artikel - Jadiberangkat')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .hero-artikel {
        position: relative; overflow: hidden; background: #1a1a2e;
    }
    .hero-artikel .swiper-slide {
        position: relative; height: 65vh; min-height: 420px;
        display: flex; align-items: center;
    }
    .hero-artikel .swiper-slide .slide-bg {
        position: absolute; inset: 0;
    }
    .hero-artikel .swiper-slide .slide-bg img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .hero-artikel .swiper-slide .slide-bg::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 100%);
    }
    .hero-artikel .slide-content {
        position: relative; z-index: 2; color: #fff; max-width: 650px; padding: 0 24px;
    }
    .hero-artikel .slide-content .cat-label {
        display: inline-block; padding: 4px 16px; border-radius: 50px; font-size: 12px;
        font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        background: #2f6f42; margin-bottom: 12px;
    }
    .hero-artikel .slide-content h2 {
        font-size: clamp(1.5rem, 3vw, 2.8rem); font-weight: 800; line-height: 1.2;
        margin-bottom: 10px;
    }
    .hero-artikel .slide-content p {
        font-size: 15px; opacity: 0.85; margin-bottom: 16px;
    }
    .hero-artikel .slide-content .meta {
        font-size: 13px; opacity: 0.7; display: flex; gap: 16px;
    }

    .artikel-card-featured {
        display: grid; grid-template-columns: 1fr 1fr; border-radius: 20px;
        overflow: hidden; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.4s;
    }
    .artikel-card-featured:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(47,111,66,0.12); }
    .artikel-card-featured img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
    .artikel-card-featured:hover img { transform: scale(1.04); }
    .artikel-card-featured .card-body { padding: 32px; display: flex; flex-direction: column; justify-content: center; }
    .artikel-card-featured .card-body .cat-badge {
        align-self: flex-start; padding: 4px 16px; border-radius: 50px; font-size: 12px;
        font-weight: 700; background: rgba(47,111,66,0.12); color: #2f6f42; margin-bottom: 12px;
    }
    .artikel-card-featured .card-body h3 { font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
    .artikel-card-featured .card-body p { font-size: 14px; color: #888; margin-bottom: 16px; }

    .artikel-card-middle {
        border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.4s;
    }
    .artikel-card-middle:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(47,111,66,0.1); }
    .artikel-card-middle img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.5s; }
    .artikel-card-middle:hover img { transform: scale(1.05); }
    .artikel-card-middle .card-body { padding: 18px; }
    .artikel-card-middle .card-body .cat-badge {
        display: inline-block; padding: 3px 12px; border-radius: 50px; font-size: 11px;
        font-weight: 700; background: rgba(47,111,66,0.12); color: #2f6f42; margin-bottom: 8px;
    }
    .artikel-card-middle .card-body h3 { font-size: 17px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }

    .artikel-card-compact {
        display: flex; gap: 16px; padding: 14px; border-radius: 14px;
        background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        transition: all 0.3s;
    }
    .artikel-card-compact:hover { transform: translateX(4px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
    .artikel-card-compact img { width: 110px; height: 80px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
    .artikel-card-compact .card-body h4 { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
    .artikel-card-compact .card-body .meta { font-size: 11px; color: #aaa; display: flex; gap: 8px; }

    .filter-bar { background: #fff; border-radius: 16px; padding: 16px 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
    .filter-bar .cat-pill {
        padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 600;
        cursor: pointer; transition: all 0.3s; border: 1px solid #e0e0e0; color: #555;
    }
    .filter-bar .cat-pill:hover, .filter-bar .cat-pill.active { background: #2f6f42; color: #fff; border-color: #2f6f42; }

    .swiper-pagination-bullet { background: #fff; opacity: 0.6; }
    .swiper-pagination-bullet-active { background: #2f6f42; opacity: 1; }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')
<section class="hero-artikel">
    @auth
    <a href="{{ route('admin.artikel.index') }}" target="_blank" class="absolute top-4 right-4 text-sm bg-[#2f6f42] text-white rounded-full p-2 shadow-lg hover:bg-[#255a35] transition z-50" title="Edit artikel">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endauth
    <div class="swiper" id="artikelHeroSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-bg"><img src="{{ asset('img/artikel-hero-1.jpg') }}" alt="Artikel Hero"></div>
                <div class="slide-content max-w-7xl mx-auto w-full">
                    <span class="cat-label">Tips Travel</span>
                    <h2>5 Destinasi Wajib Dikunjungi di Banyuwangi</h2>
                    <p>Temukan keindahan alam dan budaya Banyuwangi yang memukau.</p>
                    <div class="meta"><span><i class="bi bi-person"></i> Admin</span><span><i class="bi bi-clock"></i> 5 Min Read</span><span><i class="bi bi-calendar"></i> 15 Jun 2025</span></div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-bg"><img src="{{ asset('img/artikel-hero-2.jpg') }}" alt="Artikel Hero"></div>
                <div class="slide-content max-w-7xl mx-auto w-full">
                    <span class="cat-label">Kuliner</span>
                    <h2>Menikmati Sensasi Kuliner Khas Osing</h2>
                    <p>Rasakan sajian autentik yang hanya bisa ditemukan di Bumi Blambangan.</p>
                    <div class="meta"><span><i class="bi bi-person"></i> Redaksi</span><span><i class="bi bi-clock"></i> 7 Min Read</span><span><i class="bi bi-calendar"></i> 10 Jun 2025</span></div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-bg"><img src="{{ asset('img/artikel-hero-3.jpg') }}" alt="Artikel Hero"></div>
                <div class="slide-content max-w-7xl mx-auto w-full">
                    <span class="cat-label">Budaya</span>
                    <h2>Tradisi dan Ritual Unik Masyarakat Using</h2>
                    <p>Mengenal lebih dekat kekayaan budaya yang masih terjaga hingga kini.</p>
                    <div class="meta"><span><i class="bi bi-person"></i> Kontributor</span><span><i class="bi bi-clock"></i> 8 Min Read</span><span><i class="bi bi-calendar"></i> 5 Jun 2025</span></div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <span>Artikel</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="filter-bar flex flex-col sm:flex-row sm:items-center gap-4 mb-8">
        <div class="relative flex-1">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" id="searchArtikel" placeholder="Cari artikel..." class="w-full pl-10 pr-4 py-2.5 rounded-full border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#2f6f42]" oninput="filterArtikel()">
        </div>
        <div class="flex flex-wrap gap-2" id="artikelCatFilter">
            <span class="cat-pill active" data-cat="semua" onclick="filterArtikelCat('semua', this)">Semua</span>
            <span class="cat-pill" data-cat="tips travel" onclick="filterArtikelCat('tips travel', this)">Tips Travel</span>
            <span class="cat-pill" data-cat="kuliner" onclick="filterArtikelCat('kuliner', this)">Kuliner</span>
            <span class="cat-pill" data-cat="budaya" onclick="filterArtikelCat('budaya', this)">Budaya</span>
            <span class="cat-pill" data-cat="destinasi" onclick="filterArtikelCat('destinasi', this)">Destinasi</span>
        </div>
        <input type="date" id="dateFilter" class="border border-gray-200 rounded-full px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2f6f42]" onchange="filterArtikel()">
        @auth
        <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-xs font-bold rounded-full hover:bg-[#255a35] transition shadow-md">
            <i class="bi bi-plus-lg"></i> Tambah Artikel
        </a>
        @endauth
    </div>

    <div class="space-y-8" id="artikelList">
        @php
            $featured = $artikel->shift();
        @endphp

        @if($featured)
        <div class="relative">
            <a href="{{ route('artikel.show', $featured->slug) }}" class="artikel-card-featured" data-kategori="{{ strtolower($featured->kategori) }}" data-judul="{{ strtolower($featured->judul) }}">
                <img src="{{ asset($featured->gambar) }}" alt="{{ $featured->judul }}" loading="lazy">
                <div class="card-body">
                    @if($featured->kategori)<span class="cat-badge">{{ $featured->kategori }}</span>@endif
                    <h3>{{ $featured->judul }}</h3>
                    <p>{{ Str::limit(strip_tags($featured->konten), 150) }}</p>
                    <div class="flex items-center gap-4 text-xs text-gray-400 mt-auto">
                        @if($featured->penulis)<span><i class="bi bi-person"></i> {{ $featured->penulis }}</span>@endif
                        @if($featured->durasi_baca)<span><i class="bi bi-clock"></i> {{ $featured->durasi_baca }} Min Read</span>@endif
                        @if($featured->tanggal_terbit)<span><i class="bi bi-calendar"></i> {{ $featured->tanggal_terbit->format('d M Y') }}</span>@endif
                    </div>
                </div>
            </a>
            @auth
            <div class="absolute top-2 right-2 flex gap-1.5 z-10">
                <a href="{{ route('admin.artikel.edit', $featured->id) }}" class="text-xs bg-yellow-100 text-yellow-700 rounded-full px-2.5 py-1 font-bold hover:bg-yellow-200 transition shadow-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.artikel.destroy', $featured->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs bg-red-100 text-red-700 rounded-full px-2.5 py-1 font-bold hover:bg-red-200 transition shadow-sm">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
            @endauth
        </div>
        @endif

        @if($artikel->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($artikel->take(6) as $item)
            <div class="relative">
                <a href="{{ route('artikel.show', $item->slug) }}" class="artikel-card-middle" data-kategori="{{ strtolower($item->kategori) }}" data-judul="{{ strtolower($item->judul) }}">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">
                    <div class="card-body">
                        @if($item->kategori)<span class="cat-badge">{{ $item->kategori }}</span>@endif
                        <h3>{{ $item->judul }}</h3>
                        <div class="flex items-center gap-3 text-xs text-gray-400 mt-2">
                            @if($item->durasi_baca)<span><i class="bi bi-clock"></i> {{ $item->durasi_baca }} Min Read</span>@endif
                            @if($item->tanggal_terbit)<span><i class="bi bi-calendar"></i> {{ $item->tanggal_terbit->format('d M Y') }}</span>@endif
                        </div>
                    </div>
                </a>
                @auth
                <div class="absolute top-2 right-2 flex gap-1.5 z-10">
                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="text-xs bg-yellow-100 text-yellow-700 rounded-full px-2.5 py-1 font-bold hover:bg-yellow-200 transition shadow-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs bg-red-100 text-red-700 rounded-full px-2.5 py-1 font-bold hover:bg-red-200 transition shadow-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
                @endauth
            </div>
            @endforeach
        </div>
        @endif

        @php
            $compact = $artikel->slice(6);
        @endphp
        @if($compact->count())
        <div class="space-y-3" id="compactArticles">
            @foreach($compact as $item)
            <div class="relative">
                <a href="{{ route('artikel.show', $item->slug) }}" class="artikel-card-compact" data-kategori="{{ strtolower($item->kategori) }}" data-judul="{{ strtolower($item->judul) }}">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">
                    <div class="card-body flex-1">
                        <h4>{{ $item->judul }}</h4>
                        <div class="meta">
                            @if($item->kategori)<span>{{ $item->kategori }}</span>@endif
                            @if($item->tanggal_terbit)<span>{{ $item->tanggal_terbit->format('d M Y') }}</span>@endif
                        </div>
                    </div>
                </a>
                @auth
                <div class="absolute top-2 right-2 flex gap-1.5 z-10">
                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="text-xs bg-yellow-100 text-yellow-700 rounded-full px-2.5 py-1 font-bold hover:bg-yellow-200 transition shadow-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs bg-red-100 text-red-700 rounded-full px-2.5 py-1 font-bold hover:bg-red-200 transition shadow-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
                @endauth
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="mt-10">
        {{ $artikel->links() }}
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);

    new Swiper('#artikelHeroSwiper', {
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        effect: 'fade',
        fadeEffect: { crossFade: true },
    });

    gsap.from('.filter-bar', {
        scrollTrigger: { trigger: '.filter-bar', start: 'top 95%' },
        opacity: 0, y: 20, duration: 0.5
    });

    let artikelCurrentCat = 'semua';

    function filterArtikelCat(cat, el) {
        artikelCurrentCat = cat;
        document.querySelectorAll('#artikelCatFilter .cat-pill').forEach(p => p.classList.remove('active'));
        el.classList.add('active');
        filterArtikel();
    }

    function filterArtikel() {
        const search = (document.getElementById('searchArtikel').value || '').toLowerCase();
        const dateFilter = document.getElementById('dateFilter').value;

        document.querySelectorAll('#artikelList a[data-kategori]').forEach(card => {
            const cat = (card.dataset.kategori || '').toLowerCase();
            const judul = (card.dataset.judul || '');
            const matchCat = artikelCurrentCat === 'semua' || cat === artikelCurrentCat;
            const matchSearch = judul.includes(search);
            card.style.display = (matchCat && matchSearch) ? '' : 'none';
        });
    }
</script>
@endpush
@endsection