@extends('layouts.app')

@section('title', 'Galeri - Jadiberangkat')

@push('styles')
<style>
    .galeri-item {
        position: relative; border-radius: 24px; overflow: hidden; cursor: pointer;
        break-inside: avoid; margin-bottom: 20px;
        display: inline-block; width: 100%; /* Fixes masonry overflow */
        transition: transform 0.4s, box-shadow 0.4s;
    }
    .galeri-item:hover { transform: scale(1.02); box-shadow: 0 12px 40px rgba(0,0,0,0.2); z-index: 10; }
    .galeri-item img { width: 100%; height: 100%; display: block; object-fit: cover; transition: transform 0.6s; }
    .galeri-item:hover img { transform: scale(1.06); }
    .galeri-item .overlay {
        position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        opacity: 0; transition: opacity 0.4s; display: flex; align-items: flex-end; padding: 16px;
    }
    .galeri-item:hover .overlay { opacity: 1; }
    .galeri-item .overlay span { color: #fff; font-weight: 600; font-size: 14px; }

    .masonry { columns: 2; column-gap: 12px; width: 100%; }
    @media (min-width: 640px) { .masonry { column-gap: 20px; } }
    @media (min-width: 1024px) { .masonry { columns: 2; } }
    @media (min-width: 1280px) { .masonry { columns: 3; } }

    /* Responsive Heights for Masonry Items */
    .h-type-1 { height: 180px; }
    .h-type-2 { height: 240px; }
    .h-type-3 { height: 200px; }
    .h-type-4 { height: 260px; }
    .h-type-5 { height: 220px; }
    @media (min-width: 640px) {
        .h-type-1 { height: 280px; }
        .h-type-2 { height: 400px; }
        .h-type-3 { height: 320px; }
        .h-type-4 { height: 450px; }
        .h-type-5 { height: 350px; }
    }

    /* Floating Category Menu CSS */
    .floating-category-wrapper {
        position: fixed; z-index: 40; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex; flex-direction: column; overflow: hidden;
    }
    .floating-category-wrapper .cat-link {
        display: flex; align-items: center; gap: 14px; padding: 12px;
        cursor: pointer; transition: all 0.3s; color: #555; font-weight: 600; font-size: 14px; border-radius: 12px;
        white-space: nowrap;
    }
    .floating-category-wrapper .cat-link:hover { background: rgba(47,111,66,0.08); color: #2f6f42; }
    .floating-category-wrapper .cat-link.active { background: #2f6f42; color: #fff; }
    .floating-category-wrapper .cat-link i { font-size: 18px; width: 24px; text-align: center; flex-shrink: 0; }
    .floating-category-wrapper .cat-name { opacity: 0; transition: opacity 0.3s; display: none; }

    /* Desktop Mode */
    @media (min-width: 1024px) {
        .floating-category-wrapper {
            top: 50%; left: 1.5rem; transform: translateY(-50%); width: 64px;
            background: #fff; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 12px 8px;
        }
        .floating-category-wrapper:hover { width: 240px; padding: 12px; }
        .floating-category-wrapper h3 { opacity: 0; white-space: nowrap; transition: opacity 0.3s; margin-bottom: 12px; padding: 0 12px; }
        .floating-category-wrapper:hover h3 { opacity: 1; }
        .floating-category-wrapper .cat-name { display: block; }
        .floating-category-wrapper:hover .cat-name { opacity: 1; }
    }

    /* Mobile Mode */
    @media (max-width: 1023px) {
        .floating-category-wrapper {
            bottom: 1.5rem; left: 1.5rem; width: 56px; height: 56px;
            background: #2f6f42; border-radius: 50%; box-shadow: 0 10px 25px rgba(47,111,66,0.4);
            justify-content: center; align-items: center; color: white; cursor: pointer;
        }
        .floating-category-wrapper .mobile-filter-icon { font-size: 24px; transition: opacity 0.3s; display: block; }
        .floating-category-wrapper h3 { display: none; }
        .floating-category-wrapper .category-content { display: none; opacity: 0; transition: opacity 0.3s; flex-direction: column; width: 100%; gap: 4px;}
        
        .floating-category-wrapper.mobile-expanded {
            width: 240px; height: auto; border-radius: 20px; background: #fff;
            padding: 16px; align-items: stretch; justify-content: flex-start;
        }
        .floating-category-wrapper.mobile-expanded .mobile-filter-icon { display: none; }
        .floating-category-wrapper.mobile-expanded .category-content { display: flex; opacity: 1; }
        .floating-category-wrapper.mobile-expanded .cat-name { display: block; opacity: 1; }
    }

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

    .galeri-edit-btn { display: none; position: absolute; top: 10px; right: 10px; z-index: 30; background: #2f6f42; color: #fff; width: 32px; height: 32px; border-radius: 50%; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.3); transition: background 0.2s; }
    .galeri-edit-btn:hover { background: #17442a; }
    .edit-mode-active .galeri-edit-btn { display: flex; }

    .galeri-item .kategori-badge {
        position: absolute; top: 12px; left: 12px; padding: 4px 12px;
        border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        background: rgba(47,111,66,0.9); color: #fff; backdrop-filter: blur(4px); z-index: 2;
    }

    #scrollToTopBtn { display: none !important; }
</style>
@endpush

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <span>Galeri</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <!-- Floating Category Menu -->
    <div id="floatingCategoryWrapper" class="floating-category-wrapper">
        <i class="bi bi-funnel-fill mobile-filter-icon lg:hidden"></i>
        <div class="category-content" id="dynamicCatList">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:block">Kategori</h3>
            <div class="cat-link active" data-cat="semua" onclick="filterGaleri('semua', this)">
                <i class="bi bi-grid"></i> <span class="cat-name">Semua Galeri</span>
            </div>
            @foreach($semuaKategori->take(4) as $kat)
            <div class="cat-link" data-cat="{{ strtolower($kat->nama_kategori) }}" onclick="filterGaleri('{{ strtolower($kat->nama_kategori) }}', this)">
                <i class="{{ $kat->icon ?? 'bi bi-tag' }}"></i> <span class="cat-name">{{ $kat->nama_kategori }}</span>
            </div>
            @endforeach
            @if($semuaKategori->count() > 4)
            <div class="cat-link text-center justify-center text-gray-400 hover:bg-gray-100 lg:justify-start" id="btn-lainnya" onclick="openKategoriModal()" title="Lainnya">
                <i class="bi bi-three-dots"></i> <span class="cat-name hidden lg:block">Lainnya</span>
            </div>
            @endif
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1 min-w-0 lg:pl-16">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-[#1a1a2e] mb-1">Galeri Eksplorasi</h2>
                    <p class="text-gray-500 text-sm">Momen tak terlupakan bersama Jadi Berangkat</p>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                    <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-sm font-bold rounded-xl hover:bg-[#255a35] transition shadow-md">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>
                    @endauth

                </div>
            </div>

            <div id="galeriContainer" class="masonry">
                @php
                    $heights = ['h-type-1', 'h-type-2', 'h-type-3', 'h-type-4', 'h-type-5'];
                @endphp
                @foreach($galeri as $index => $item)
                @php
                    $hClass = $heights[$index % count($heights)];
                @endphp
                <div class="galeri-item {{ $hClass }}" data-kategori="{{ $item->kategori->nama_kategori ?? '' }}" onclick="openLightbox('{{ ($item->image ? $item->image->url : '') }}', '{{ $item->judul }}')">
                    @if($item->kategori)
                    <span class="kategori-badge">{{ $item->kategori->nama_kategori ?? '' }}</span>
                    @endif
                    <img src="{{ ($item->image ? $item->image->url : '') }}" alt="{{ $item->judul }}" loading="lazy" data-src="{{ ($item->image ? $item->image->url : '') }}">
                    <div class="overlay"><span>{!! $item->judul !!}</span></div>
                    @auth
                    <a href="{{ url('/admin/galeri') }}" class="galeri-edit-btn" onclick="event.stopPropagation()">
                        <i class="bi bi-three-dots-vertical"></i>
                    </a>
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

<!-- Modal Kategori -->
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300" id="kategoriModal" onclick="closeKategoriModal(event)">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md m-4 transform scale-95 opacity-0 transition-all duration-300" id="kategoriModalContent" onclick="event.stopPropagation()">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">Pilih Kategori</h3>
                <button onclick="closeKategoriModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-2 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($semuaKategori as $kat)
                <button onclick="selectKategori('{{ addslashes($kat->nama_kategori) }}', '{{ $kat->icon ?? 'bi bi-tag' }}')" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-holiday hover:bg-holiday/5 text-left transition group">
                    <div class="w-8 h-8 rounded-lg bg-holiday/10 text-holiday flex items-center justify-center group-hover:bg-holiday group-hover:text-white transition">
                        <i class="{{ $kat->icon ?? 'bi bi-tag' }}"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 group-hover:text-holiday transition">{{ $kat->nama_kategori }}</span>
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
    let currentGaleriCat = 'semua';



    function filterGaleri(cat, el) {
        currentGaleriCat = cat;
        document.querySelectorAll('#dynamicCatList .cat-link').forEach(l => l.classList.remove('active'));
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

    function openKategoriModal() {
        const modal = document.getElementById('kategoriModal');
        const content = document.getElementById('kategoriModalContent');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        content.classList.remove('scale-95', 'opacity-0');
        document.body.style.overflow = 'hidden';
    }

    function closeKategoriModal(e) {
        if (e && e.target !== e.currentTarget) return;
        const modal = document.getElementById('kategoriModal');
        const content = document.getElementById('kategoriModalContent');
        modal.classList.add('opacity-0', 'pointer-events-none');
        content.classList.add('scale-95', 'opacity-0');
        document.body.style.overflow = '';
    }

    function selectKategori(nama, icon) {
        const list = document.getElementById('dynamicCatList');
        const slug = nama.toLowerCase();
        
        let existing = list.querySelector(`[data-cat="${slug}"]`);
        
        if (!existing) {
            const catLinks = Array.from(list.querySelectorAll('.cat-link')).filter(el => el.dataset.cat !== 'semua' && !el.id.includes('btn-lainnya'));
            
            if (catLinks.length >= 4) {
                const lastItem = catLinks[catLinks.length - 1];
                gsap.to(lastItem, {
                    height: 0,
                    opacity: 0,
                    paddingTop: 0,
                    paddingBottom: 0,
                    marginTop: 0,
                    marginBottom: 0,
                    duration: 0.3,
                    onComplete: () => {
                        lastItem.remove();
                        insertAndAnimateNew(nama, icon, slug, list);
                    }
                });
            } else {
                insertAndAnimateNew(nama, icon, slug, list);
            }
        } else {
            existing.click();
            closeKategoriModal();
        }
    }

    function insertAndAnimateNew(nama, icon, slug, list) {
        let existing = document.createElement('div');
        existing.className = 'cat-link';
        existing.dataset.cat = slug;
        existing.onclick = function() { filterGaleri(slug, this); };
        existing.innerHTML = `<i class="${icon}"></i> <span class="cat-name">${nama}</span>`;
        
        // Initial state for animation
        existing.style.overflow = 'hidden';
        
        const semuaCat = list.querySelector('[data-cat="semua"]');
        semuaCat.insertAdjacentElement('afterend', existing);
        
        gsap.from(existing, {
            height: 0,
            opacity: 0,
            paddingTop: 0,
            paddingBottom: 0,
            marginTop: 0,
            marginBottom: 0,
            duration: 0.4,
            ease: "back.out(1.5)",
            onComplete: () => {
                existing.style.overflow = '';
                existing.click();
            }
        });
        
        closeKategoriModal();
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
    let mobileTimeout;
    const floatingWrapper = document.getElementById('floatingCategoryWrapper');

    floatingWrapper.addEventListener('click', function(e) {
        if (window.innerWidth < 1024) {
            // Only expand if clicking the wrapper itself or the funnel icon, 
            // or if it's already open, clicking a cat-link will trigger filterGaleri but we should reset timer
            if (!this.classList.contains('mobile-expanded')) {
                this.classList.add('mobile-expanded');
                resetMobileTimer();
            }
        }
    });

    function resetMobileTimer() {
        clearTimeout(mobileTimeout);
        mobileTimeout = setTimeout(() => {
            if (window.innerWidth < 1024) {
                floatingWrapper.classList.remove('mobile-expanded');
            }
        }, 7000);
    }

    floatingWrapper.addEventListener('mousemove', resetMobileTimer);
    floatingWrapper.addEventListener('touchstart', resetMobileTimer);
    floatingWrapper.addEventListener('click', resetMobileTimer);
</script>
@endpush
@endsection