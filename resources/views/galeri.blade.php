@extends('layouts.app')

@section('title', 'Galeri - Jadiberangkat')

@push('styles')
<style>
    .hero-galeri {
        position: relative; height: 40vh; min-height: 300px;
        background: url('{{ asset('img/hero-galeri.webp') }}') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center;
    }
    .hero-galeri::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(47,111,66,0.7) 0%, rgba(0,0,0,0.4) 100%);
    }
    .hero-galeri .hero-content { position: relative; z-index: 2; text-align: center; color: #fff; }
    .hero-galeri h1 { font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 800; letter-spacing: -0.02em; text-shadow: 0 2px 20px rgba(0,0,0,0.3); }
    .hero-galeri p { font-size: clamp(0.95rem, 1.3vw, 1.15rem); opacity: 0.9; }

    .galeri-item {
        position: relative; border-radius: 16px; overflow: hidden; cursor: pointer;
        break-inside: avoid; margin-bottom: 16px;
        transition: transform 0.4s, box-shadow 0.4s;
    }
    .galeri-item:hover { transform: scale(1.02); box-shadow: 0 12px 40px rgba(0,0,0,0.2); }
    .galeri-item img { width: 100%; display: block; transition: transform 0.6s; }
    .galeri-item:hover img { transform: scale(1.06); }
    .galeri-item .overlay {
        position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        opacity: 0; transition: opacity 0.4s; display: flex; align-items: flex-end; padding: 16px;
    }
    .galeri-item:hover .overlay { opacity: 1; }
    .galeri-item .overlay span { color: #fff; font-weight: 600; font-size: 14px; }

    .masonry { columns: 1; column-gap: 16px; }
    @media (min-width: 640px) { .masonry { columns: 2; } }
    @media (min-width: 1024px) { .masonry { columns: 3; } }
    @media (min-width: 1280px) { .masonry { columns: 4; } }

    .grid-rata { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
    .grid-rata .galeri-item img { aspect-ratio: 4/3; object-fit: cover; }

    .category-sidebar {
        position: sticky; top: 24px;
    }
    .category-sidebar .cat-link {
        display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 12px;
        font-size: 14px; font-weight: 600; color: #555; cursor: pointer; transition: all 0.3s;
    }
    .category-sidebar .cat-link:hover { background: rgba(47,111,66,0.08); color: #2f6f42; }
    .category-sidebar .cat-link.active { background: #2f6f42; color: #fff; }
    .category-sidebar .cat-link i { font-size: 18px; width: 24px; text-align: center; }

    .lightbox {
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,0.92); display: none;
        align-items: center; justify-content: center; padding: 24px;
    }
    .lightbox.show { display: flex; }
    .lightbox img { max-width: 90vw; max-height: 85vh; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
    .lightbox .close-lb {
        position: absolute; top: 20px; right: 30px; font-size: 36px; color: #fff;
        cursor: pointer; transition: transform 0.3s;
    }
    .lightbox .close-lb:hover { transform: rotate(90deg); }
    .lightbox .caption {
        position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
        color: #fff; font-size: 16px; text-align: center; max-width: 600px;
    }

    .galeri-item .kategori-badge {
        position: absolute; top: 12px; left: 12px; padding: 4px 12px;
        border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        background: rgba(47,111,66,0.9); color: #fff; backdrop-filter: blur(4px); z-index: 2;
    }
</style>
@endpush

@section('content')
<section class="hero-galeri relative">
    @auth
    <a href="{{ route('admin.galeri.index') }}" target="_blank" class="absolute top-4 right-4 text-sm bg-[#2f6f42] text-white rounded-full p-2 shadow-lg hover:bg-[#255a35] transition z-50" title="Edit galeri">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endauth
    <div class="hero-content px-4">
        <h1>Galeri</h1>
        <p>Jelajahi Keindahan Dalam Setiap Bingkai</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <span>Galeri</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="flex flex-col lg:flex-row gap-8">
        <aside class="lg:w-56 flex-shrink-0">
            <div class="category-sidebar bg-white rounded-2xl p-4 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3 px-2">Kategori</h3>
                <div class="cat-link active" data-cat="semua" onclick="filterGaleri('semua', this)"><i class="bi bi-grid"></i> Semua Galeri</div>
                <div class="cat-link" data-cat="wisata" onclick="filterGaleri('wisata', this)"><i class="bi bi-geo-alt"></i> Wisata</div>
                <div class="cat-link" data-cat="armada" onclick="filterGaleri('armada', this)"><i class="bi bi-truck"></i> Armada</div>
                <div class="cat-link" data-cat="momen pelanggan" onclick="filterGaleri('momen pelanggan', this)"><i class="bi bi-people"></i> Momen Pelanggan</div>
            </div>
        </aside>

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <h2 class="text-xl font-bold text-[#1a1a2e]">
                        <span id="galeriCount">{{ $galeri->count() }}</span> Foto & Video
                    </h2>
                    @auth
                    <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-xs font-bold rounded-full hover:bg-[#255a35] transition shadow-md">
                        <i class="bi bi-plus-lg"></i> Tambah Galeri
                    </a>
                    @endauth
                </div>
                <div class="flex gap-1">
                    <button class="view-btn active" data-view="masonry" onclick="setGaleriView('masonry', this)"><i class="bi bi-grid-3x3-gap-fill"></i></button>
                    <button class="view-btn" data-view="rata" onclick="setGaleriView('rata', this)"><i class="bi bi-grid"></i></button>
                </div>
            </div>

            <div id="galeriContainer" class="masonry">
                @foreach($galeri as $item)
                <div class="galeri-item relative" data-kategori="{{ $item->kategori }}" onclick="openLightbox('{{ ($item->image ? $item->image->url : '') }}', '{{ $item->judul }}')">
                    @if($item->kategori)
                    <span class="kategori-badge">{{ $item->kategori }}</span>
                    @endif
                    <img src="{{ ($item->image ? $item->image->url : '') }}" alt="{{ $item->judul }}" loading="lazy" data-src="{{ ($item->image ? $item->image->url : '') }}" data-image-edit data-edit-field="galeri_img_{{ $item->id }}" data-edit-tipe="galeri">
                    <div class="overlay"><span>{!! $item->judul !!}</span></div>
                    @auth
                    <div class="absolute top-2 right-2 flex gap-1.5 z-20">
                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="text-xs bg-yellow-100 text-yellow-700 rounded-full px-2.5 py-1 font-bold hover:bg-yellow-200 transition shadow-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus galeri ini?')" class="inline">
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
        </div>
    </div>
</section>

<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <span class="close-lb" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" src="" alt="">
    <div class="caption" id="lightboxCaption"></div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
    let currentGaleriCat = 'semua';
    let currentGaleriView = 'masonry';

    gsap.from('.hero-galeri .hero-content', { opacity: 0, y: 40, duration: 1, ease: 'power3.out' });

    function filterGaleri(cat, el) {
        currentGaleriCat = cat;
        document.querySelectorAll('.category-sidebar .cat-link').forEach(l => l.classList.remove('active'));
        el.classList.add('active');
        const items = document.querySelectorAll('#galeriContainer .galeri-item');
        let visible = 0;
        items.forEach(item => {
            const match = cat === 'semua' || (item.dataset.kategori || '').toLowerCase() === cat;
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('galeriCount').textContent = visible;
    }

    function setGaleriView(view, btn) {
        currentGaleriView = view;
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const container = document.getElementById('galeriContainer');
        container.className = view === 'masonry' ? 'masonry' : 'grid-rata';
    }

    function openLightbox(src, caption) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightboxCaption').textContent = caption;
        document.getElementById('lightbox').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e && e.target !== e.currentTarget) return;
        document.getElementById('lightbox').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        }, { rootMargin: '200px' });

        document.querySelectorAll('#galeriContainer img[data-src]').forEach(img => observer.observe(img));
    }
</script>
@endpush
@endsection