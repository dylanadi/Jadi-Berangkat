@extends('layouts.app')

@section('title', 'Jadi Berangkat - Halaman Wisata')

@push('styles')
<style>
    .text-slate-900 { color: #0f172a !important; }
    .text-slate-600 { color: #475569 !important; }

    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
    
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } 
    }
    
    /* Initial state for GSAP */
    .gsap-item { opacity: 0; visibility: hidden; }
    
    /* Smooth scrolling behavior specifically for slider container */
    .smooth-scroll-x { scroll-behavior: smooth; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Sticky filter shadow transition */
    .sticky-filter { transition: box-shadow 0.3s ease, background-color 0.3s ease; }
    .sticky-filter.is-pinned {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Fallback colors just in case tailwind config doesn't catch it */
    .text-holiday { color: #2e7d32; }
    .bg-holiday { background-color: #2e7d32; }
    .hover\:text-holiday:hover { color: #2e7d32; }
    .hover\:bg-holiday:hover { background-color: #2e7d32; }
    .border-holiday { border-color: #2e7d32; }
    .text-holiday-600 { color: #2e7d32; }
    .hover\:text-holiday-600:hover { color: #2e7d32; }
    .bg-holiday-600 { background-color: #2e7d32; }
    .bg-holiday-500 { background-color: #388e3c; }
    .text-holiday-500 { color: #388e3c; }
    .text-holiday-400 { color: #4caf50; }
</style>

<!-- Konfigurasi Tailwind Khusus Halaman Ini (Sesuai Desain User) -->
<script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        base: '#F6F5ED',
                        holiday: '#2e7d32', 
                        'holiday-dark': '#1b5e20',
                        'holiday-light': '#a5d6a7',
                        'holiday-glow': 'rgba(46, 125, 50, 0.4)',
                        'holiday-400': '#4caf50',
                        'holiday-500': '#388e3c',
                        'holiday-600': '#2e7d32',
                        'holiday-700': '#1b5e20'
                    }
                }
            }
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
@endpush

@section('content')

<!-- HERO SECTION SLIDER -->
<section class="relative h-[85vh] w-full overflow-hidden bg-slate-900 -mt-24">
    <div id="hero-slider" class="relative h-full w-full">
        
        <!-- Slide 1: Pantai Boom Banyuwangi -->
        <div class="hero-slide absolute inset-0 w-full h-full opacity-100 transition-opacity duration-1000 ease-in-out">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-slate-950/50 to-slate-900/20 z-10"></div>
            <img src="{{ asset('img/pantaiboom.webp') }}" class="w-full h-full object-cover" alt="Sunrise Pantai Boom Banyuwangi">
            <div class="absolute inset-0 z-20 flex flex-col justify-end pb-24 px-6 md:px-9 max-w-[1440px] mx-auto w-full">
                <span class="text-yellow-300 font-bold tracking-wider uppercase mb-2 flex items-center gap-2 drop-shadow-lg">
                    <i class="bi bi-sun-fill"></i> Sunrise of Java
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white max-w-2xl leading-tight mb-4 drop-shadow-lg">
                    Saksikan Fajar Emas di <span class="text-yellow-300">Pantai Boom</span> Banyuwangi
                </h1>
                <p class="text-white/80 text-sm md:text-base max-w-xl mb-2 drop-shadow">
                    Nikmati pesona siluet ikonik berlatar belakang selat Bali yang megah, tempat keindahan mentari terbit pertama kali menyapa Pulau Jawa.
                </p>
            </div>
        </div>

        <!-- Slide 2: Kawah Ijen Banyuwangi -->
        <div class="hero-slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-slate-950/50 to-slate-900/20 z-10"></div>
            <img src="{{ asset('img/bluefire (1).webp') }}" class="w-full h-full object-cover" alt="Kawah Ijen Banyuwangi">
            <div class="absolute inset-0 z-20 flex flex-col justify-end pb-24 px-6 md:px-9 max-w-[1440px] mx-auto w-full">
                <span class="text-cyan-300 font-bold tracking-wider uppercase mb-2 flex items-center gap-2 drop-shadow-lg">
                    <i class="bi bi-fire"></i> Fenomena Api Biru Langka
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white max-w-2xl leading-tight mb-4 drop-shadow-lg">
                    Petualangan Mistis <span class="text-cyan-300">Blue Fire</span> Kawah Ijen
                </h1>
                <p class="text-white/80 text-sm md:text-base max-w-xl mb-2 drop-shadow">
                    Mendaki menembus dingin malam lereng Ijen untuk menyaksikan langsung salah satu dari dua fenomena api biru abadi yang ada di dunia.
                </p>
            </div>
        </div>
    </div>

    <!-- HERO SLIDER DOTS INDIKATOR -->
    <div class="absolute bottom-6 left-0 right-0 z-30 flex justify-center gap-3">
        <button onclick="goToSlide(0)" class="hero-dot w-10 h-2.5 rounded-full bg-white transition-all duration-300"></button>
        <button onclick="goToSlide(1)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300"></button>
    </div>
</section>

<!-- MAIN WISATA CONTENT SECTION -->
<!-- Breadcrumb -->
<div class="w-full max-w-7xl mx-auto px-6 md:px-12 pt-8">
    <nav class="flex text-sm font-medium text-gray-500">
        <ol class="inline-flex items-center gap-2">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="hover:text-holiday transition inline-flex items-center gap-1.5">
                    <i class="bi bi-house"></i> Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="bi bi-chevron-right text-[10px] mx-2 text-gray-400"></i>
                    <span class="text-ink font-semibold">Wisata & Berita</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-6 md:px-12 pb-16 pt-4">
    
    <!-- Judul Kategori Atas -->
    <div class="mb-6 text-center md:text-left">
        <span class="text-holiday-600 font-bold text-sm tracking-widest uppercase flex items-center justify-center md:justify-start gap-2 mb-2">
            <i class="bi bi-grid-3x3-gap-fill"></i> Jelajahi Cerita Baru
        </span>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Artikel & Kabar Wisata Terbaru</h2>
    </div>
    
    <!-- Sticky Filter, Category, Search, View Mode -->
    <div id="filter-container" class="w-full z-40 transition-all duration-300 mb-10">
        <div class="sticky-filter bg-white border border-slate-200 rounded-3xl p-4 flex flex-col md:flex-row items-center justify-between gap-4 w-full shadow-sm">
            
            <!-- Left: Search & Category -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto flex-1">
                <div class="relative w-full sm:max-w-xs">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="bi bi-search text-gray-400"></i>
                    </div>
                    <input id="search-input" type="text" placeholder="Cari artikel..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-2xl focus:bg-white focus:border-holiday-500 focus:ring-2 focus:ring-holiday-500/20 transition-all text-sm font-semibold outline-none text-slate-800">
                </div>
                
                <div class="w-full sm:w-auto overflow-x-auto no-scrollbar">
                    <div class="flex items-center gap-2 min-w-max" id="filter-buttons">
                        <button class="filter-btn px-5 py-2.5 rounded-2xl bg-[#0f172a] text-white font-bold text-sm shadow-md transition" data-filter="all">Semua Berita</button>
                        <button class="filter-btn px-5 py-2.5 rounded-2xl bg-white text-slate-600 border border-slate-200 hover:border-holiday-500 hover:text-holiday-600 font-bold text-sm transition shadow-sm" data-filter="destinasi">Destinasi</button>
                        <button class="filter-btn px-5 py-2.5 rounded-2xl bg-white text-slate-600 border border-slate-200 hover:border-holiday-500 hover:text-holiday-600 font-bold text-sm transition shadow-sm" data-filter="tips">Tips</button>
                        <button class="filter-btn px-5 py-2.5 rounded-2xl bg-white text-slate-600 border border-slate-200 hover:border-holiday-500 hover:text-holiday-600 font-bold text-sm transition shadow-sm" data-filter="kuliner">Kuliner</button>
                        <button class="filter-btn px-5 py-2.5 rounded-2xl bg-white text-slate-600 border border-slate-200 hover:border-holiday-500 hover:text-holiday-600 font-bold text-sm transition shadow-sm" data-filter="event">Event</button>
                    </div>
                </div>
            </div>

            <!-- Right: Date Filter -->
            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 border-slate-100 pt-4 md:pt-0">
                <div class="relative">
                    <select id="date-filter" class="appearance-none bg-slate-50 border border-slate-200 rounded-2xl pl-5 pr-10 py-2.5 text-sm font-bold text-slate-700 hover:bg-white transition cursor-pointer outline-none focus:border-holiday-500 focus:ring-2 focus:ring-holiday-500/20">
                        <option value="baru">Terbaru</option>
                        <option value="1bulan">1 Bulan Terakhir</option>
                        <option value="lampau">Terdahulu</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <i class="bi bi-chevron-down text-[10px] text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRID SYSTEM UTAMA -->
    <div class="space-y-8" id="article-grid-container">

        <!-- EMPTY STATE: muncul kalau filter kategori/pencarian tidak ada hasilnya atau database kosong -->
        <div id="empty-state" class="{{ $artikel->count() == 0 ? 'flex' : 'hidden' }} flex-col items-center justify-center text-center py-20 px-6 bg-white rounded-3xl border border-dashed border-slate-200">
            <div class="w-16 h-16 rounded-full bg-holiday-50 flex items-center justify-center mb-4">
                <i class="bi bi-journal-x text-3xl text-holiday-500"></i>
            </div>
            <h3 class="text-lg font-extrabold text-slate-900 mb-2">Artikel Belum Tersedia</h3>
            <p class="text-sm text-slate-500 max-w-sm">Kami sedang menyiapkan artikel menarik untuk kategori ini. Nantikan update selanjutnya, ya!</p>
        </div>

        <div id="filtered-layout" class="hidden flex-col gap-8"></div>

        <div id="default-layout" class="{{ $artikel->count() > 0 ? 'space-y-12' : 'hidden' }}">
            
            <!-- TOP GRID: 1 BESAR KIRI, 2 KANAN ATAS BAWAH -->
            @if($artikel->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                
                <!-- Kiri Besar -->
                @php $featured = $artikel->first(); @endphp
                <article class="lg:col-span-2 relative bg-slate-900 rounded-[2rem] overflow-hidden h-[400px] md:h-[520px] group shadow-sm hover:shadow-xl transition-all duration-500 flex items-end cursor-pointer" onclick="window.location.href='{{ route('artikel.show', $featured->slug) }}'" data-cats="{{ strtolower($featured->kategori) }}" data-date="{{ $featured->tanggal_terbit ? $featured->tanggal_terbit->format('Y-m-d') : '' }}" data-article="{{ $featured->slug }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent z-10"></div>
                    <img src="{{ $featured->image ? $featured->image->url : asset('img/bluefire (1).webp') }}" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" alt="{{ $featured->judul }}">
                    
                    <div class="relative z-20 p-6 md:p-10 w-full pointer-events-none">
                        <div class="flex items-center gap-2 mb-4 pointer-events-auto">
                            <span class="bg-holiday-500 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-md shadow-sm">{{ strtoupper($featured->kategori ?? 'DESTINASI') }}</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-white mb-3 leading-tight pointer-events-auto drop-shadow-md">
                            {{ $featured->judul }}
                        </h3>
                        <p class="text-slate-200 text-sm md:text-base max-w-2xl mb-6 line-clamp-2 pointer-events-auto drop-shadow">
                            {{ Str::limit(strip_tags($featured->konten), 200) }}
                        </p>
                        <div class="flex items-center gap-5 pt-5 border-t border-white/20 text-xs md:text-sm text-white/80 pointer-events-auto font-medium">
                            <span class="flex items-center gap-2"><i class="bi bi-calendar3 text-holiday-400"></i> {{ $featured->tanggal_terbit ? $featured->tanggal_terbit->format('d F Y') : '-' }}</span>
                            @if($featured->penulis)<span class="flex items-center gap-2"><i class="bi bi-person text-holiday-400"></i> {{ $featured->penulis }}</span>@endif
                        </div>
                    </div>
                </article>

                <!-- Kanan Atas Bawah -->
                @if($artikel->count() > 1)
                <div class="flex flex-col gap-4 md:gap-6 h-full">
                    @foreach($artikel->skip(1)->take(2) as $item)
                    <article class="relative bg-slate-900 rounded-[2rem] overflow-hidden flex-1 group shadow-sm hover:shadow-xl transition-all duration-500 flex items-end cursor-pointer min-h-[200px]" onclick="window.location.href='{{ route('artikel.show', $item->slug) }}'" data-cats="{{ strtolower($item->kategori->nama_kategori ?? '') }}" data-date="{{ $item->tanggal_terbit ? $item->tanggal_terbit->format('Y-m-d') : '' }}" data-article="{{ $item->slug }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/50 to-transparent z-10"></div>
                        <img src="{{ $item->image ? $item->image->url : asset('img/bluefire (1).webp') }}" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" alt="{{ $item->judul }}">
                        
                        <div class="relative z-20 p-6 md:p-8 w-full pointer-events-none">
                            <div class="flex items-center gap-2 mb-3 pointer-events-auto">
                                <span class="bg-holiday-500 text-white text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">{{ strtoupper($item->kategori->nama_kategori ?? 'WISATA') }}</span>
                            </div>
                            <h4 class="text-lg md:text-xl font-bold text-white mb-2 leading-snug pointer-events-auto drop-shadow-md line-clamp-2">
                                {{ $item->judul }}
                            </h4>
                            <div class="flex items-center gap-3 text-xs text-white/70 pointer-events-auto font-medium mt-3">
                                <span class="flex items-center gap-1.5"><i class="bi bi-calendar3"></i> {{ $item->tanggal_terbit ? $item->tanggal_terbit->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- BAWAH: CONTAINER LEBIH KECIL (Standar Blog) -->
            @if($artikel->count() > 3)
            <div class="max-w-5xl mx-auto pt-10 border-t border-slate-100 mt-12">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Berita & Cerita Lainnya</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="compact-cards">
                    @php $otherArticles = $artikel->skip(3); @endphp
                    @foreach($otherArticles as $item)
                    <article class="news-card bg-white rounded-[1.5rem] overflow-hidden shadow-sm border border-slate-100 flex flex-col justify-between group cursor-pointer hover:-translate-y-1 hover:shadow-md transition-all duration-300" onclick="window.location.href='{{ route('artikel.show', $item->slug) }}'" data-cats="{{ strtolower($item->kategori->nama_kategori ?? '') }}" data-date="{{ $item->tanggal_terbit ? $item->tanggal_terbit->format('Y-m-d') : '' }}" data-article="{{ $item->slug }}">
                        <div class="relative h-52 overflow-hidden shrink-0">
                            <img src="{{ $item->image ? $item->image->url : asset('img/bluefire (1).webp') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $item->judul }}">
                            <span class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-holiday-700 text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-md shadow-sm">{{ strtoupper($item->kategori->nama_kategori ?? 'TIPS') }}</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between pointer-events-none">
                            <div class="pointer-events-auto">
                                <h4 class="font-extrabold text-slate-900 text-lg leading-snug group-hover:text-holiday-600 transition-colors line-clamp-2 mb-3">
                                    {{ $item->judul }}
                                </h4>
                                <p class="text-sm text-slate-500 line-clamp-3 mb-4 leading-relaxed">
                                    {{ Str::limit(strip_tags($item->konten), 120) }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 text-xs text-slate-400 flex items-center justify-between pointer-events-auto font-medium">
                                <span class="flex items-center gap-1.5"><i class="bi bi-calendar3 text-holiday-400"></i> {{ $item->tanggal_terbit ? $item->tanggal_terbit->format('d M Y') : '-' }}</span>
                                <span class="text-holiday-600 font-bold hover:underline flex items-center gap-1">Baca <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                
                @if(method_exists($artikel, 'links') && $artikel->hasPages())
                <div class="mt-14 mb-6 flex justify-center">
                    {{ $artikel->links('pagination::tailwind') }}
                </div>
                @endif
            </div>
            @endif
        </div>

    </div>
</section>

<!-- Scroll To Top Button -->
<button id="scrollToTopBtn" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 w-12 h-12 md:w-14 md:h-14 bg-holiday text-white rounded-full flex items-center justify-center shadow-xl shadow-holiday/30 z-[90] opacity-0 invisible translate-y-10 hover:bg-holiday-dark transition-colors" aria-label="Scroll to top">
    <i class="bi bi-arrow-up text-xl md:text-2xl font-bold"></i>
</button>

@endsection

@push('scripts')
<!-- INTERACTION JAVASCRIPT -->
<script>
    // --- 1. HERO SLIDER LOGIC ---
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('opacity-0', 'pointer-events-none');
                slide.classList.add('opacity-100');
            } else {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0', 'pointer-events-none');
            }
        });
        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('w-2.5', 'bg-white/50');
                dot.classList.add('w-10', 'bg-white');
            } else {
                dot.classList.remove('w-10', 'bg-white');
                dot.classList.add('w-2.5', 'bg-white/50');
            }
        });
        currentSlide = index;
    }

    function goToSlide(index) {
        showSlide(index);
    }

    // Auto-play Slider setiap 4 detik
    if (totalSlides > 1) {
        setInterval(() => {
            let next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }, 4000);
    }

    // --- 2. SEARCH, CATEGORY & DATE FILTER LOGIC ---
    const searchInput = document.getElementById('search-input');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const newsCards = document.querySelectorAll('.news-card');
    const dateFilter = document.getElementById('date-filter');

    let activeCat = 'all';

    function extractCardData(card) {
        const img = card.querySelector('img');
        const heading = card.querySelector('h2, h3, h4');
        const paragraphs = card.querySelectorAll('p');
        return {
            imgSrc: img ? (img.getAttribute('src') || img.src || '') : '',
            title: heading ? heading.textContent.trim() : '',
            excerpt: paragraphs.length > 0 ? paragraphs[0].textContent.trim() : '',
            slug: card.dataset.article || '',
            kategori: (card.dataset.cats || '').split(',')[0].trim().toUpperCase() || 'WISATA',
            date: card.dataset.date || ''
        };
    }

    function applyFilters() {
        const query = searchInput.value.toLowerCase().trim();
        const dateVal = dateFilter.value;

        const defaultLayout = document.getElementById('default-layout');
        const filteredLayout = document.getElementById('filtered-layout');
        const emptyState = document.getElementById('empty-state');

        const oneMonthAgo = new Date();
        oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);

        let visibleCards = Array.from(newsCards).filter(card => {
            const cats = (card.dataset.cats || '').split(',').map(c => c.trim());
            const matchesCat = activeCat === 'all' || cats.some(c => c.includes(activeCat));
            const matchesSearch = !query || card.textContent.toLowerCase().includes(query);
            const cardDate = card.dataset.date || '';
            const d = new Date(cardDate);
            let matchesDate = true;
            if (dateVal === '1bulan') {
                matchesDate = !isNaN(d.getTime()) && d >= oneMonthAgo;
            }
            return matchesCat && matchesSearch && matchesDate;
        });

        // Sort by date
        if (dateVal === 'baru' || dateVal === '1bulan') {
            visibleCards.sort((a, b) => (b.dataset.date || '').localeCompare(a.dataset.date || ''));
        } else if (dateVal === 'lampau') {
            visibleCards.sort((a, b) => (a.dataset.date || '').localeCompare(b.dataset.date || ''));
        }

        const isDefault = activeCat === 'all' && query === '' && dateVal === 'baru';

        if (isDefault) {
            defaultLayout.style.display = 'block';
            filteredLayout.style.display = 'none';
            if (emptyState) emptyState.classList.add('hidden');
            if (emptyState) emptyState.classList.remove('flex');
            
            // Restore visibility of original cards just in case
            newsCards.forEach(c => { c.style.display = ''; });
        } else {
            defaultLayout.style.display = 'none';
            filteredLayout.style.display = 'flex';
            filteredLayout.innerHTML = '';

            if (visibleCards.length === 0) {
                if (emptyState) {
                    emptyState.classList.remove('hidden');
                    emptyState.classList.add('flex');
                }
            } else {
                if (emptyState) {
                    emptyState.classList.add('hidden');
                    emptyState.classList.remove('flex');
                }

                // Render First Card as Big
                const firstData = extractCardData(visibleCards[0]);
                const bigCardHTML = `
                    <article class="news-card relative bg-slate-900 rounded-3xl overflow-hidden h-[480px] md:h-[520px] group shadow-sm hover:shadow-xl transition-all duration-500 flex items-end cursor-pointer" onclick="window.location.href='${firstData.slug ? '{{ url("artikel") }}/' + firstData.slug : '#"'}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent z-10"></div>
                        <img src="${firstData.imgSrc}" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" alt="${firstData.title}">
                        
                        <div class="relative z-20 p-8 md:p-10 w-full">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-holiday-500 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md">${firstData.kategori}</span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-3 leading-tight">${firstData.title}</h3>
                            <p class="text-slate-300 text-sm max-w-3xl mb-5 line-clamp-3">${firstData.excerpt}</p>
                            <div class="flex items-center justify-between pt-4 border-t border-white/10 text-xs text-slate-300">
                                <span><i class="bi bi-calendar3 text-holiday-400 mr-1"></i> ${formatDateLabel(firstData.date)}</span>
                                <span class="text-holiday-400 font-bold flex items-center gap-1">Baca Artikel <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </article>
                `;
                filteredLayout.innerHTML += bigCardHTML;

                // Render remaining as Small
                if (visibleCards.length > 1) {
                    let smallCardsHTML = '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';
                    for (let i = 1; i < visibleCards.length; i++) {
                        const data = extractCardData(visibleCards[i]);
                        smallCardsHTML += `
                            <article class="news-card bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 flex flex-col justify-between group cursor-pointer" onclick="window.location.href='${data.slug ? '{{ url("artikel") }}/' + data.slug : '#"'}">
                                <div class="relative h-48 overflow-hidden shrink-0">
                                    <img src="${data.imgSrc}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="${data.title}">
                                    <span class="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-sm text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md">${data.kategori}</span>
                                </div>
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-extrabold text-slate-900 text-base md:text-lg leading-snug group-hover:text-holiday-600 transition-colors line-clamp-2 mb-2">${data.title}</h4>
                                        <p class="text-sm text-slate-500 line-clamp-2 mb-4">${data.excerpt}</p>
                                    </div>
                                    <div class="pt-4 border-t border-slate-100 text-xs text-slate-400 flex items-center justify-between">
                                        <span><i class="bi bi-calendar3 text-holiday-500 mr-1"></i> ${formatDateLabel(data.date)}</span>
                                        <span class="text-holiday-600 font-bold hover:underline">Baca <i class="bi bi-chevron-right"></i></span>
                                    </div>
                                </div>
                            </article>
                        `;
                    }
                    smallCardsHTML += '</div>';
                    filteredLayout.innerHTML += smallCardsHTML;
                }
            }
        }
    }

    function formatDateLabel(dateString) {
        if (!dateString) return '-';
        const d = new Date(dateString);
        if (isNaN(d.getTime())) return dateString;
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    }

    // Search input listener
    if(searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    // Category filter buttons
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            activeCat = btn.dataset.filter;

            filterButtons.forEach(b => {
                b.classList.remove('bg-[#0f172a]', 'text-white');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            btn.classList.add('bg-[#0f172a]', 'text-white');

            applyFilters();
        });
    });

    // Date filter listener
    if(dateFilter) {
        dateFilter.addEventListener('change', applyFilters);
    }

    // Make all cards clickable
    newsCards.forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function(e) {
            if (e.target.closest('a')) return;
            const article = this.dataset.article;
            if (article && article.trim() !== '') {
                window.location.href = '{{ url('artikel') }}/' + article;
            }
        });
    });

    // Scroll to Top
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