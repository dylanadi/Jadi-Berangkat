@extends('layouts.app')

@section('title', 'Galeri - Jadi Berangkat')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f0e7; color: #151813; overflow-x: hidden; }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: rgba(0,0,0,0.04); }
    ::-webkit-scrollbar-thumb { background: rgba(47, 111, 66, 0.4); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(47, 111, 66, 0.7); }

    /* Multi-column Layout for Masonry (Pinterest) */
    .gallery-container {
        column-count: 2;
        column-gap: 1.25rem;
        transition: all 0.5s ease;
    }
    @media (min-width: 640px) { .gallery-container { column-count: 2; } }
    @media (min-width: 768px) { .gallery-container { column-count: 3; } }
    @media (min-width: 1024px) { .gallery-container { column-count: 4; } }
    
    .gallery-container.grid-rata {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        column-count: auto; 
    }
    @media (min-width: 640px) { .gallery-container.grid-rata { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); } }
    .gallery-container.grid-rata .gallery-item {
        margin-bottom: 0;
        height: 320px !important;
    }

    .gallery-item {
        position: relative;
        border-radius: 1rem;
        overflow: hidden;
        background: rgba(0,0,0,0.05);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.5s ease;
        opacity: 0;
        break-inside: avoid;
        margin-bottom: 1.25rem;
        transform: translateY(20px);
        min-height: 200px;
    }
    .gallery-item.in-view {
        transform: translateY(0);
        opacity: 1;
    }
    .gallery-item:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        z-index: 10;
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease;
        opacity: 0;
        display: block;
    }
    .gallery-item img.loaded { opacity: 1; }

    .gallery-item .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 5;
        pointer-events: none;
    }
    .gallery-item .overlay span {
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 8px 18px;
        border: 2px solid rgba(255,255,255,0.8);
        border-radius: 999px;
        backdrop-filter: blur(4px);
        background: rgba(0,0,0,0.25);
        letter-spacing: 0.5px;
        transform: translateY(10px);
        transition: transform 0.3s ease;
    }
    .gallery-item:hover .overlay {
        opacity: 1;
    }
    .gallery-item:hover .overlay span {
        transform: translateY(0);
    }

    /* Lightbox */
    #lightbox {
        transition: opacity 0.4s ease, visibility 0.4s ease;
        opacity: 0;
        visibility: hidden;
    }
    #lightbox.active {
        opacity: 1;
        visibility: visible;
    }
    
    /* Floating Category Sidebar */
    .cat-sidebar {
        position: fixed;
        left: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0,0,0,0.15);
        border-radius: 1.5rem;
        padding: 0.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s ease;
        z-index: 40;
        overflow: hidden;
    }
    .cat-sidebar:hover {
        width: 220px;
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 10px 10px 40px rgba(0,0,0,0.1);
    }
    .cat-btn {
        width: 100%;
        height: 44px;
        display: flex;
        align-items: center;
        padding: 0 10px;
        border-radius: 999px;
        color: #4b5563;
        transition: all 0.3s ease;
        cursor: pointer;
        white-space: nowrap;
    }
    .cat-btn:hover, .cat-btn.active {
        background: #2f6f42; /* holiday base color in galery.html */
        color: white;
    }
    .cat-icon {
        width: 24px;
        text-align: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .cat-text {
        opacity: 0;
        padding-left: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: opacity 0.3s ease;
    }
    .cat-sidebar:hover .cat-text {
        opacity: 1;
    }
    @media (max-width: 768px) {
        .cat-sidebar {
            position: relative;
            transform: none;
            top: auto;
            left: 0;
            width: 100% !important;
            background: rgba(255, 255, 255, 0.85);
            flex-direction: row;
            flex-wrap: wrap;
            height: auto;
            border-radius: 1rem;
            margin-bottom: 2rem;
            margin-top: 1rem;
        }
        .cat-text {
            opacity: 1;
        }
        .cat-btn {
            width: auto;
        }
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
@endpush

@section('content')
<div class="bg-[#f4f0e7] min-h-screen relative w-full pt-20">
    <!-- Floating Category Sidebar -->
    <div class="cat-sidebar flex-col">
        <div class="cat-btn active" onclick="filterCat('semua', this)">
            <i class="bi bi-grid-fill cat-icon"></i>
            <span class="cat-text">Semua Galeri</span>
        </div>
        <div class="cat-btn" onclick="filterCat('wisata', this)">
            <i class="bi bi-image cat-icon"></i>
            <span class="cat-text">Wisata</span>
        </div>
        <div class="cat-btn" onclick="filterCat('armada', this)">
            <i class="bi bi-car-front-fill cat-icon"></i>
            <span class="cat-text">Armada</span>
        </div>
        <div class="cat-btn" onclick="filterCat('pelanggan', this)">
            <i class="bi bi-people-fill cat-icon"></i>
            <span class="cat-text">Momen Pelanggan</span>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 w-full px-4 md:pr-8 md:pl-[120px] max-w-[1440px] mx-auto pb-12">
        <!-- Top Actions -->
        <div class="flex justify-between items-center mb-8 relative z-30">
            <div>
                <h1 class="text-3xl font-extrabold text-[#151813]">Galeri Eksplorasi</h1>
                <p class="text-gray-500 font-medium text-sm mt-1">Momen tak terlupakan bersama Jadi Berangkat</p>
            </div>
            
            <!-- Apple Style Dropdown untuk View Toggle -->
            <div class="relative">
                <button id="view-toggle-btn" class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="bi bi-columns-gap" id="current-view-icon"></i> <span class="hidden sm:inline">View</span>
                </button>
                
                <!-- Dropdown Menu -->
                <div id="view-dropdown" class="absolute right-0 top-full mt-2 w-48 bg-white/90 backdrop-blur-xl border border-gray-200/60 rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.12)] overflow-hidden origin-top-right transform scale-95 opacity-0 invisible transition-all duration-300 z-50">
                    <div class="p-1.5 flex flex-col gap-0.5">
                        <button onclick="setViewMode('pinterest')" class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 hover:bg-black/5 hover:text-black transition-colors">
                            <i class="bi bi-columns-gap text-lg w-5"></i> Pinterest
                        </button>
                        <button onclick="setViewMode('grid')" class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 hover:bg-black/5 hover:text-black transition-colors">
                            <i class="bi bi-grid-fill text-lg w-5"></i> Grid Rata
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div id="gallery-container" class="gallery-container relative z-[20]">
            @if($galeri->count() > 0)
                @foreach($galeri as $key => $item)
                @php
                    $heights = ['350px', '250px', '400px', '280px', '300px', '450px', '220px', '320px'];
                    $height = $heights[$key % count($heights)];
                @endphp
                <div class="gallery-item" style="height: {{ $height }};" data-src="{{ $item->image_url }}" data-title="{{ $item->judul }}" data-desc="{{ $item->deskripsi }}" data-cat="{{ strtolower($item->kategori) }}">
                    <div class="overlay"><span>Lihat Gambar</span></div>
                </div>
                @endforeach
            @else
                <!-- Fallback Data -->
                @php
                    $dummies = [
                        ['src' => asset('img/bluefire (1).png'), 'title' => 'Kawah Ijen', 'desc' => 'Fenomena blue fire yang menakjubkan.', 'cat' => 'wisata', 'h' => '350px'],
                        ['src' => asset('img/djawatan.jpg'), 'title' => 'Hutan De Djawatan', 'desc' => 'Nuansa magis hutan Banyuwangi.', 'cat' => 'wisata', 'h' => '250px'],
                        ['src' => asset('img/unsplash_M8drGBgFNZE.png'), 'title' => 'Jeep Custom', 'desc' => 'Armada tangguh melibas medan.', 'cat' => 'armada', 'h' => '400px'],
                        ['src' => asset('img/pantaiboom.png'), 'title' => 'Pantai Boom', 'desc' => 'Sunset indah di selat bali.', 'cat' => 'wisata', 'h' => '280px'],
                        ['src' => asset('img/unsplash_Souw06F1irM.png'), 'title' => 'Hardtop Classic', 'desc' => 'Klasik dan menawan.', 'cat' => 'armada', 'h' => '300px'],
                        ['src' => asset('img/jembatan.png'), 'title' => 'Melintas Jembatan', 'desc' => 'Memacu adrenalin.', 'cat' => 'pelanggan', 'h' => '450px']
                    ];
                @endphp
                @foreach($dummies as $dum)
                <div class="gallery-item" style="height: {{ $dum['h'] }};" data-src="{{ $dum['src'] }}" data-title="{{ $dum['title'] }}" data-desc="{{ $dum['desc'] }}" data-cat="{{ $dum['cat'] }}">
                    <div class="overlay"><span>Lihat Gambar</span></div>
                </div>
                @endforeach
            @endif
        </div>
    </main>
</div>

<!-- Lightbox Popup -->
<div id="lightbox" class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-10 backdrop-blur-xl bg-black/90">
    <button id="close-lightbox" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white flex items-center justify-center transition border border-white/20">
        <i class="bi bi-x-lg text-xl"></i>
    </button>
    <div class="w-full max-w-6xl max-h-full flex flex-col md:flex-row bg-[#151813] rounded-3xl overflow-hidden border border-white/10 shadow-2xl" onclick="event.stopPropagation()">
        <!-- Image Area -->
        <div class="w-full md:w-2/3 h-[40vh] md:h-[80vh] bg-black flex items-center justify-center relative">
            <div id="lightbox-loader" class="absolute inset-0 flex items-center justify-center">
                <div class="w-8 h-8 border-4 border-[#2f6f42]/30 border-t-[#2f6f42] rounded-full animate-spin"></div>
            </div>
            <img id="lightbox-img" src="" alt="Gallery Image" class="max-w-full max-h-full object-contain relative z-10 opacity-0 transition-opacity duration-300">
        </div>
        <!-- Info Area -->
        <div class="w-full md:w-1/3 p-8 flex flex-col text-white">
            <span id="lightbox-cat" class="text-xs font-bold uppercase tracking-widest text-[#b8d9bd] mb-2">Kategori</span>
            <h3 id="lightbox-title" class="text-3xl font-extrabold mb-4">Judul Foto</h3>
            <p id="lightbox-desc" class="text-gray-400 leading-relaxed mb-8 flex-1">Deskripsi lengkap mengenai foto ini akan ditampilkan di sini.</p>
            <a href="{{ route('destinasi.index') }}" class="w-full py-4 rounded-xl bg-[#2f6f42] text-white font-bold hover:bg-[#17442a] transition shadow-lg shadow-[#2f6f42]/30 text-center block">
                Booking Jeep Ini
            </a>
        </div>
    </div>
</div>

<!-- Scroll To Top Button -->
<button id="scrollToTopBtn" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 w-12 h-12 md:w-14 md:h-14 bg-[#2f6f42] text-white rounded-full flex items-center justify-center shadow-xl shadow-[#2f6f42]/30 z-[90] opacity-0 invisible translate-y-10 hover:bg-[#17442a] transition-colors" aria-label="Scroll to top">
    <i class="bi bi-arrow-up text-xl md:text-2xl font-bold"></i>
</button>

@endsection

@push('scripts')
<script>
    // Intersection Observer for Virtualization & Lazy Load
    let observer;
    function initObserver() {
        if(observer) observer.disconnect();
        
        const options = { root: null, rootMargin: '500px', threshold: 0 };

        observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const el = entry.target;
                
                if (entry.isIntersecting) {
                    el.classList.add('in-view');
                    if (!el.querySelector('img')) {
                        const img = document.createElement('img');
                        img.src = el.dataset.src;
                        img.alt = el.dataset.title;
                        img.onload = () => img.classList.add('loaded');
                        el.appendChild(img);
                    }
                } else {
                    el.classList.remove('in-view');
                    const img = el.querySelector('img');
                    if (img) el.removeChild(img);
                }
            });
        }, options);

        document.querySelectorAll('.gallery-item').forEach(item => {
            observer.observe(item);
            item.onclick = () => {
                openLightbox({
                    src: item.dataset.src,
                    title: item.dataset.title,
                    desc: item.dataset.desc,
                    cat: item.dataset.cat
                });
            };
        });
    }

    // View Toggle
    const toggleBtn = document.getElementById('view-toggle-btn');
    const dropdownMenu = document.getElementById('view-dropdown');
    const currentIcon = document.getElementById('current-view-icon');
    const container = document.getElementById('gallery-container');
    let dropdownOpen = false;

    if(toggleBtn) {
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownOpen = !dropdownOpen;
            if (dropdownOpen) {
                dropdownMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                dropdownMenu.classList.add('opacity-100', 'visible', 'scale-100');
            } else {
                dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            }
        });
    }

    document.addEventListener('click', () => {
        if (dropdownOpen) {
            dropdownOpen = false;
            dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
        }
    });

    window.setViewMode = function(mode) {
        if (mode === 'grid') {
            container.classList.add('grid-rata');
            currentIcon.className = 'bi bi-grid-fill';
            document.querySelectorAll('.gallery-item').forEach(el => el.style.height = '');
        } else {
            container.classList.remove('grid-rata');
            currentIcon.className = 'bi bi-columns-gap';
            document.querySelectorAll('.gallery-item').forEach((el, key) => {
                const heights = ['350px', '250px', '400px', '280px', '300px', '450px', '220px', '320px'];
                el.style.height = heights[key % heights.length];
            });
        }
    };

    // Lightbox Logic
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const lightboxCat = document.getElementById('lightbox-cat');
    const lightboxLoader = document.getElementById('lightbox-loader');

    function openLightbox(item) {
        lightboxImg.style.opacity = '0';
        lightboxLoader.style.display = 'flex';
        
        lightboxImg.onload = () => {
            lightboxLoader.style.display = 'none';
            lightboxImg.style.opacity = '1';
        };
        lightboxImg.src = item.src;
        
        lightboxTitle.textContent = item.title;
        lightboxDesc.textContent = item.desc || 'Keindahan momen petualangan bersama Jadi Berangkat.';
        lightboxCat.textContent = item.cat;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; 
    }

    if(document.getElementById('close-lightbox')) {
        document.getElementById('close-lightbox').onclick = () => {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        };
    }
    
    if(lightbox) {
        lightbox.onclick = () => {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        };
    }

    // Category Filter
    window.filterCat = function(category, button) {
        document.querySelectorAll('.cat-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if(category === 'semua' || item.dataset.cat === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Init Observer for images
    initObserver();

    // Scroll to Top animation using GSAP
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('scrollToTopBtn');
        if (btn && typeof gsap !== 'undefined') {
            let isVisible = false;
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300 && !isVisible) {
                    isVisible = true;
                    gsap.to(btn, { autoAlpha: 1, y: 0, duration: 0.5, ease: 'back.out(1.5)' });
                } else if (window.scrollY <= 300 && isVisible) {
                    isVisible = false;
                    gsap.to(btn, { autoAlpha: 0, y: 40, duration: 0.3, ease: 'power2.in' });
                }
            });
            btn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });
</script>
@endpush