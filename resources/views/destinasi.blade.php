@extends('layouts.app')

@section('title', 'Destinasi Pilihan - Jadiberangkat')

@push('styles')
<style>
    /* View Toggle Styles */
    #destinasi-grid {
        transition: opacity 0.3s ease;
    }
    
    /* Uniform View */
    .view-uniform {
        column-count: auto !important;
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }
    @media (min-width: 768px) { .view-uniform { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
    @media (min-width: 1024px) { .view-uniform { grid-template-columns: repeat(6, minmax(0, 1fr)); } }
    
    .view-uniform > div {
        height: 280px !important;
        margin-bottom: 0 !important;
    }
    
    .view-uniform > div > a {
        height: 100% !important;
    }

    /* Card View */
    .view-card {
        column-count: auto !important;
        display: grid !important;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.5rem;
    }
    @media (min-width: 640px) { .view-card { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (min-width: 768px) { .view-card { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
    @media (min-width: 1024px) { .view-card { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
    
    .view-card > div {
        height: auto !important;
        margin-bottom: 0 !important;
    }
    .view-card > div > a {
        height: auto !important;
        background-color: white !important;
        border: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }
    .view-card > div > a > img {
        position: relative !important;
        height: 200px !important;
    }
    .view-card > div > a > div:nth-child(2) {
        display: none !important;
    }
    .view-card > div > a > div:nth-child(3) {
        position: relative !important;
        padding: 1.25rem !important;
        background: transparent !important;
    }
    .view-card > div > a h4 {
        color: #151813 !important;
    }
    .view-card > div > a p {
        color: #4b5563 !important;
        max-width: none !important; 
    }
</style>
@endpush

@section('content')
<!-- HERO SECTION SLIDER -->
<section class="relative h-[65vh] w-full overflow-hidden bg-ink" id="hero-slider">
    @if(isset($slider_destinasi) && $slider_destinasi->count() > 0)
        @foreach($slider_destinasi as $index => $slide)
        <div class="hero-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}" data-slide="{{ $index }}">
            <img src="{{ $slide->image ? $slide->image->url : asset('img/placeholder.webp') }}" alt="{{ $slide->nama }}" class="absolute inset-0 w-full h-full object-cover object-center transform transition-transform duration-[8000ms] ease-out {{ $index === 0 ? 'scale-105' : 'scale-100' }}">
            <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/60 to-black/30"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-6 mt-16">
                <div class="slide-content transform transition-all duration-1000 ease-out {{ $index === 0 ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0' }} max-w-4xl">
                    <!-- <span class="inline-block text-holiday-light font-bold text-sm tracking-widest uppercase mb-4 drop-shadow-md bg-black/20 px-4 py-1.5 rounded-full backdrop-blur-sm">{{ $slide->kategori }}</span> -->
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white drop-shadow-2xl mb-4 leading-tight">{{ $slide->nama }}</h1>
                    <p class="text-white/90 text-base md:text-lg lg:text-xl font-medium max-w-2xl mx-auto drop-shadow-md line-clamp-2">
                        {{ $slide->deskripsi_singkat ?? Str::limit(strip_tags($slide->deskripsi), 120) }}
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('destinasi.show', $slide->slug) }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-holiday hover:bg-holiday-dark text-white font-bold rounded-full transition-all duration-300 transform hover:-translate-y-1 shadow-lg shadow-holiday/30">
                            Jelajahi <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        <!-- Slider Navigation -->
        <div class="absolute bottom-8 left-0 right-0 z-20 flex justify-center gap-2.5">
            @foreach($slider_destinasi as $index => $slide)
            <button class="slider-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-holiday w-8' : 'bg-white/50 hover:bg-white' }}" data-target="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        
        <!-- Slider Controls -->
        <button id="slider-prev" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md text-white flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-100 hidden md:flex">
            <i class="bi bi-chevron-left text-xl"></i>
        </button>
        <button id="slider-next" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md text-white flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-100 hidden md:flex">
            <i class="bi bi-chevron-right text-xl"></i>
        </button>
    @else
        <!-- Fallback static hero -->
        <img src="{{ asset('img/bluefire (1).webp') }}" class="absolute inset-0 w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/40 to-black/30"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-6 mt-16">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white drop-shadow-2xl">Destinasi Pilihan</h1>
        </div>
    @endif
</section>

<main class="w-[96%] max-w-[1500px] mx-auto px-6 md:px-10 py-16">
    
    <!-- UNTUK ANDA -->
    <section class="mb-16">
        <h2 data-edit="destinasi_untuk_anda_judul" data-edit-type="text" data-edit-tipe="destinasi" class="text-3xl md:text-4xl font-extrabold text-ink mb-8">{!! $data->destinasi_untuk_anda_judul ?? 'Untuk Anda' !!}</h2>
        <div class="grid lg:grid-cols-[1.05fr_1fr] gap-5 lg:gap-6">
            <!-- Kiri: 1 Card -->
            @if($featured_destinasi->count() > 0)
            <a href="{{ route('destinasi.show', $featured_destinasi[0]->slug) }}" class="group relative min-h-[400px] lg:min-h-[520px] overflow-hidden rounded-[1.75rem] bg-ink text-white shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ $featured_destinasi[0]->image ? $featured_destinasi[0]->image->url : asset('img/placeholder.webp') }}" alt="{{ $featured_destinasi[0]->nama }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute left-6 right-6 top-6 flex items-center justify-between">
                    <span class="rounded-full bg-white/16 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] backdrop-blur-md">Rekomendasi</span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-4xl md:text-5xl font-extrabold leading-tight">{{ $featured_destinasi[0]->nama }}</h3>
                </div>
            </a>
            @endif
            
            <!-- Kanan: 2 Cards -->
            <div class="grid gap-5 lg:gap-6 grid-rows-2">
                @if($featured_destinasi->count() > 1)
                <a href="{{ route('destinasi.show', $featured_destinasi[1]->slug) }}" class="group relative min-h-[200px] lg:min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <img src="{{ $featured_destinasi[1]->image ? $featured_destinasi[1]->image->url : asset('img/placeholder.webp') }}" alt="{{ $featured_destinasi[1]->nama }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                        <h3 class="text-2xl font-extrabold">{{ $featured_destinasi[1]->nama }}</h3>
                    </div>
                </a>
                @endif
                @if($featured_destinasi->count() > 2)
                <a href="{{ route('destinasi.show', $featured_destinasi[2]->slug) }}" class="group relative min-h-[200px] lg:min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <img src="{{ $featured_destinasi[2]->image ? $featured_destinasi[2]->image->url : asset('img/placeholder.webp') }}" alt="{{ $featured_destinasi[2]->nama }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                        <h3 class="text-2xl font-extrabold">{{ $featured_destinasi[2]->nama }}</h3>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- KATEGORI & SEARCH -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-t border-black/10 pt-10">
        <!-- Categories -->
        <div class="flex gap-3 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 no-scrollbar px-2" id="categoryFilters">
            <button class="cat-btn group relative px-6 py-2.5 transition-all duration-300 transform -skew-x-12 bg-holiday text-white shadow-sm" data-cat="semua" onclick="filterCategory('semua', this)">
                <span class="block transform skew-x-12 text-xs font-bold uppercase tracking-wider whitespace-nowrap">Semua</span>
            </button>
            
            @foreach($semuaKategori->take(4) as $kat)
            <button class="cat-btn group relative px-6 py-2.5 transition-all duration-300 transform -skew-x-12 bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm" data-cat="{{ strtolower($kat->nama_kategori) }}" onclick="filterCategory('{{ strtolower($kat->nama_kategori) }}', this)">
                <span class="block transform skew-x-12 text-xs font-bold uppercase tracking-wider whitespace-nowrap">{{ $kat->nama_kategori }}</span>
            </button>
            @endforeach
            
            @if($semuaKategori->count() > 4)
            <button id="btn-lainnya" class="group relative px-6 py-2.5 transition-all duration-300 transform -skew-x-12 bg-white text-gray-400 border border-gray-200 hover:bg-gray-50 shadow-sm" onclick="openKategoriModal()" title="Lainnya">
                <span class="block transform skew-x-12 text-xs font-bold uppercase tracking-wider whitespace-nowrap"><i class="bi bi-three-dots"></i></span>
            </button>
            @endif
        </div>
        
        <!-- Search Bar -->
        <div class="relative w-full md:w-72">
            <input type="text" id="searchDestinasi" oninput="filterDestinasi()" placeholder="Cari destinasi wisata..." class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-holiday focus:ring-1 focus:ring-holiday text-sm bg-white font-medium">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
        </div>
    </div>

    <!-- BREADCRUMB & VIEW TOGGLE -->
    <div class="flex justify-between items-center mb-8 relative">
        <nav class="text-sm font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-holiday transition">Beranda</a>
                    <i class="bi bi-chevron-right mx-2 text-xs"></i>
                </li>
                <li class="flex items-center">
                    <span class="text-ink font-bold">Destinasi</span>
                </li>
            </ol>
        </nav>

        <!-- Apple Style Dropdown -->
        <div class="relative flex items-center gap-2">
            @auth
            <a href="{{ route('admin.destinasi.create') }}" class="flex items-center gap-2 bg-holiday border border-holiday px-4 py-2 rounded-xl text-sm font-bold text-white shadow-sm hover:bg-holiday-dark transition-colors">
                <i class="bi bi-plus-lg"></i> <span class="hidden sm:inline">Tambah</span>
            </a>
            @endauth
            <button id="view-toggle-btn" class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
                <i class="bi bi-columns-gap" id="current-view-icon"></i> <span class="hidden sm:inline">View</span>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="view-dropdown" class="absolute right-0 top-full mt-2 w-48 bg-white/90 backdrop-blur-xl border border-gray-200/60 rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.12)] overflow-hidden origin-top-right transform scale-95 opacity-0 invisible transition-all duration-300 z-50">
                <div class="p-1.5 flex flex-col gap-0.5">
                    <button onclick="setView('pinterest')" class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 hover:bg-black/5 hover:text-black transition-colors">
                        <i class="bi bi-columns-gap text-lg w-5"></i> Pinterest
                    </button>
                    <button onclick="setView('uniform')" class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 hover:bg-black/5 hover:text-black transition-colors">
                        <i class="bi bi-grid-fill text-lg w-5"></i> Uniform
                    </button>
                    <button onclick="setView('card')" class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 hover:bg-black/5 hover:text-black transition-colors">
                        <i class="bi bi-card-list text-lg w-5"></i> Card
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- PINTEREST GRID -->
    @php
        $heights = ['h-[250px]', 'h-[300px]', 'h-[200px]', 'h-[350px]', 'h-[400px]', 'h-[250px]'];
    @endphp
    
    <div id="destinasi-grid" class="columns-2 md:columns-4 lg:columns-6 gap-4 space-y-4">
        @foreach($destinasi as $index => $item)
        @php
            $h = $heights[$index % count($heights)];
        @endphp
        <div class="dest-card-container break-inside-avoid relative mb-4" data-kategori="{{ strtolower($item->kategori->nama_kategori ?? '') }}" data-nama="{{ strtolower($item->nama) }}">
            <a href="{{ route('destinasi.show', $item->slug) }}" class="block relative group overflow-hidden rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-gray-200 {{ $h }}">
                <img src="{{ $item->image ? $item->image->url : asset('img/placeholder.webp') }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item->nama }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h4 class="text-white font-extrabold text-lg leading-tight mb-1">{!! $item->nama !!}</h4>
                    <p class="text-gray-300 text-sm inline-block max-w-full truncate">{{ Str::limit($item->lokasi, 25) }}</p>
                </div>
            </a>
            @auth
            <div class="absolute top-2 right-2 flex gap-1.5 z-10 opacity-0 group-hover:opacity-100 transition-opacity" style="opacity: 1;">
                <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="text-xs bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center font-bold hover:bg-gray-100 transition shadow-sm">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus destinasi ini?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold hover:bg-red-600 transition shadow-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
            @endauth
        </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $destinasi->links() }}
    </div>

</main>

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
                <button onclick="selectKategori('{{ addslashes($kat->nama_kategori) }}', '{{ strtolower($kat->nama_kategori) }}')" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-holiday hover:bg-holiday/5 text-left transition group">
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

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    // Hero Slider Logic
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');
        let currentSlide = 0;
        let slideInterval;

        if(slides.length === 0) return;

        function goToSlide(index) {
            slides[currentSlide].classList.remove('opacity-100', 'z-10');
            slides[currentSlide].classList.add('opacity-0', 'z-0', 'pointer-events-none');
            
            const currentContent = slides[currentSlide].querySelector('.slide-content');
            if(currentContent) {
                currentContent.classList.remove('translate-y-0', 'opacity-100');
                currentContent.classList.add('translate-y-8', 'opacity-0');
            }
            
            const currentImg = slides[currentSlide].querySelector('img');
            if(currentImg) {
                currentImg.classList.remove('scale-105');
                currentImg.classList.add('scale-100');
            }

            if(dots.length > 0) {
                dots[currentSlide].classList.remove('bg-holiday', 'w-8');
                dots[currentSlide].classList.add('bg-white/50');
            }

            currentSlide = index;

            slides[currentSlide].classList.remove('opacity-0', 'z-0', 'pointer-events-none');
            slides[currentSlide].classList.add('opacity-100', 'z-10');
            
            const newContent = slides[currentSlide].querySelector('.slide-content');
            if(newContent) {
                setTimeout(() => {
                    newContent.classList.remove('translate-y-8', 'opacity-0');
                    newContent.classList.add('translate-y-0', 'opacity-100');
                }, 100);
            }
            
            const newImg = slides[currentSlide].querySelector('img');
            if(newImg) {
                newImg.classList.remove('scale-100');
                newImg.classList.add('scale-105');
            }

            if(dots.length > 0) {
                dots[currentSlide].classList.remove('bg-white/50');
                dots[currentSlide].classList.add('bg-holiday', 'w-8');
            }
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function prevSlide() {
            goToSlide((currentSlide - 1 + slides.length) % slides.length);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        }

        if(nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => { nextSlide(); resetInterval(); });
            prevBtn.addEventListener('click', () => { prevSlide(); resetInterval(); });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                if(currentSlide !== index) {
                    goToSlide(index);
                    resetInterval();
                }
            });
        });

        resetInterval();
    });

    // View Toggle Logic
    const viewToggleBtn = document.getElementById('view-toggle-btn');
    const viewDropdown = document.getElementById('view-dropdown');
    const destinasiGrid = document.getElementById('destinasi-grid');
    const currentViewIcon = document.getElementById('current-view-icon');
    
    let dropdownOpen = false;

    if (viewToggleBtn) {
        viewToggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownOpen = !dropdownOpen;
            if (dropdownOpen) {
                viewDropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
                viewDropdown.classList.add('opacity-100', 'visible', 'scale-100');
            } else {
                viewDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                viewDropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        });

        document.addEventListener('click', (e) => {
            if (dropdownOpen && !viewDropdown.contains(e.target)) {
                dropdownOpen = false;
                viewDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                viewDropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        });
    }

    function setView(viewMode) {
        destinasiGrid.style.opacity = 0;
        
        setTimeout(() => {
            destinasiGrid.classList.remove('view-uniform', 'view-card', 'columns-2', 'md:columns-4', 'lg:columns-6', 'gap-4', 'space-y-4');
            
            if (viewMode === 'pinterest') {
                destinasiGrid.classList.add('columns-2', 'md:columns-4', 'lg:columns-6', 'gap-4', 'space-y-4');
                currentViewIcon.className = 'bi bi-columns-gap';
            } else if (viewMode === 'uniform') {
                destinasiGrid.classList.add('view-uniform');
                currentViewIcon.className = 'bi bi-grid-fill';
            } else if (viewMode === 'card') {
                destinasiGrid.classList.add('view-card');
                currentViewIcon.className = 'bi bi-card-list';
            }
            
            destinasiGrid.style.opacity = 1;
        }, 300);
        
        dropdownOpen = false;
        if(viewDropdown) {
            viewDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
            viewDropdown.classList.remove('opacity-100', 'visible', 'scale-100');
        }
    }

    let currentCategory = 'semua';
    function filterCategory(cat, btn) {
        currentCategory = cat;
        document.querySelectorAll('#categoryFilters .cat-btn').forEach(b => {
            b.classList.remove('bg-holiday', 'text-white');
            b.classList.add('bg-white', 'text-gray-600');
        });
        btn.classList.remove('bg-white', 'text-gray-600');
        btn.classList.add('bg-holiday', 'text-white');
        filterDestinasi();
    }

    function filterDestinasi() {
        const search = (document.getElementById('searchDestinasi').value || '').toLowerCase();
        document.querySelectorAll('#destinasi-grid .dest-card-container').forEach(card => {
            const cat = (card.dataset.kategori || '').toLowerCase();
            const nama = (card.dataset.nama || '');
            const matchCat = currentCategory === 'semua' || cat === currentCategory;
            const matchSearch = nama.includes(search);
            
            if (matchCat && matchSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // GSAP Animations
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
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

    function selectKategori(nama, slug) {
        const list = document.getElementById('categoryFilters');
        let existing = list.querySelector(`[data-cat="${slug}"]`);
        
        if (!existing) {
            const catBtns = Array.from(list.querySelectorAll('.cat-btn')).filter(el => el.dataset.cat !== 'semua');
            
            if (catBtns.length >= 4) {
                const lastItem = catBtns[catBtns.length - 1];
                if (typeof gsap !== 'undefined') {
                    gsap.to(lastItem, {
                        width: 0,
                        opacity: 0,
                        paddingLeft: 0,
                        paddingRight: 0,
                        marginRight: 0,
                        duration: 0.3,
                        onComplete: () => {
                            lastItem.remove();
                            insertAndAnimateNew(nama, slug, list);
                        }
                    });
                } else {
                    lastItem.remove();
                    insertAndAnimateNew(nama, slug, list);
                }
            } else {
                insertAndAnimateNew(nama, slug, list);
            }
        } else {
            existing.click();
            closeKategoriModal();
        }
    }

    function insertAndAnimateNew(nama, slug, list) {
        let btn = document.createElement('button');
        btn.className = 'cat-btn group relative px-6 py-2.5 transition-all duration-300 transform -skew-x-12 bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm';
        btn.dataset.cat = slug;
        btn.onclick = function() { filterCategory(slug, this); };
        btn.innerHTML = `<span class="block transform skew-x-12 text-xs font-bold uppercase tracking-wider whitespace-nowrap">${nama}</span>`;
        
        // Insert after "Semua"
        const semuaBtn = list.querySelector('[data-cat="semua"]');
        semuaBtn.after(btn);
        
        if (typeof gsap !== 'undefined') {
            gsap.fromTo(btn, 
                { width: 0, opacity: 0, paddingLeft: 0, paddingRight: 0, marginRight: 0 },
                { width: 'auto', opacity: 1, paddingLeft: 24, paddingRight: 24, duration: 0.3, clearProps: "width,paddingLeft,paddingRight,marginRight" }
            );
        }
        
        btn.click();
        closeKategoriModal();
    }
</script>
@endpush