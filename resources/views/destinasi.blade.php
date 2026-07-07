@extends('layouts.app')

@section('title', 'Jadi Berangkat - Destinasi')

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
    
    .view-uniform > a {
        height: 280px !important;
        margin-bottom: 0 !important;
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
    
    .view-card > a {
        height: auto !important;
        margin-bottom: 0 !important;
        background-color: white !important;
        border: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }
    .view-card > a > img {
        position: relative !important;
        height: 200px !important;
    }
    .view-card > a > div.overlay-gradient-div {
        display: none !important;
    }
    .view-card > a > div.info-container-div {
        position: relative !important;
        padding: 1.25rem !important;
        background: transparent !important;
    }
    .view-card > a h4 {
        color: #151813 !important;
    }
    .view-card > a p {
        color: #4b5563 !important;
        max-width: none !important; 
    }
</style>
@endpush

@section('content')
<!-- HERO SECTION -->
<section class="relative h-[65vh] w-full mt-0 overflow-hidden">
    <img src="{{ asset('img/bluefire (1).png') }}" alt="Hero Destinasi" class="absolute inset-0 w-full h-full object-cover object-center">
    <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/40 to-black/30"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-6 mt-16">
        <span class="text-holiday-light font-bold text-sm tracking-widest uppercase mb-4 drop-shadow-md">Eksplorasi Tak Terbatas</span>
        <h1 class="text-5xl md:text-7xl font-extrabold text-white drop-shadow-2xl">Destinasi Pilihan</h1>
        <p class="text-white/80 mt-4 max-w-2xl text-lg font-medium">Temukan keindahan alam dan budaya Banyuwangi, disusun khusus untuk pengalaman petualangan Anda.</p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-16">
    
    <!-- UNTUK ANDA -->
    <section class="mb-16">
        <h2 class="text-3xl md:text-4xl font-extrabold text-ink mb-8">Untuk Anda</h2>
        <div class="grid lg:grid-cols-[1.05fr_1fr] gap-5 lg:gap-6">
            <!-- Kiri: 1 Card -->
            @if($destinasi->count() > 0)
            @php $first = $destinasi->first(); @endphp
            <a href="{{ route('destinasi.show', $first->slug) }}" class="group relative min-h-[400px] lg:min-h-[520px] overflow-hidden rounded-[1.75rem] bg-ink text-white shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ $first->image_url }}" alt="{{ $first->nama }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute left-6 right-6 top-6 flex items-center justify-between">
                    <span class="rounded-full bg-white/16 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] backdrop-blur-md">Rekomendasi</span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-4xl md:text-5xl font-extrabold leading-tight">{{ $first->nama }}</h3>
                </div>
            </a>
            @endif
            
            <!-- Kanan: 2 Cards -->
            <div class="grid gap-5 lg:gap-6 grid-rows-2">
                @foreach($destinasi->skip(1)->take(2) as $item)
                <a href="{{ route('destinasi.show', $item->slug) }}" class="group relative min-h-[200px] lg:min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <img src="{{ $item->image_url }}" alt="{{ $item->nama }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                        <h3 class="text-2xl font-extrabold">{{ $item->nama }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KATEGORI & SEARCH -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-t border-black/10 pt-10">
        <!-- Categories -->
        <div class="flex gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 no-scrollbar">
            <button class="category-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-holiday text-white shadow-sm transition whitespace-nowrap active" onclick="filterCategory('semua', this)">Semua</button>
            <button class="category-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm transition whitespace-nowrap" onclick="filterCategory('Kawah Ijen', this)">Kawah Ijen</button>
            <button class="category-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm transition whitespace-nowrap" onclick="filterCategory('Hutan', this)">Hutan</button>
            <button class="category-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm transition whitespace-nowrap" onclick="filterCategory('Budaya', this)">Budaya</button>
            <button class="category-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white text-gray-600 border border-gray-200 hover:border-holiday hover:text-holiday shadow-sm transition whitespace-nowrap" onclick="filterCategory('Pantai', this)">Pantai</button>
        </div>
        
        <!-- Search Bar -->
        <div class="relative w-full md:w-72">
            <input type="text" id="searchInput" placeholder="Cari destinasi wisata..." class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-holiday focus:ring-1 focus:ring-holiday text-sm bg-white font-medium" oninput="searchDestinasi()">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
        </div>
    </div>

    <!-- BREADCRUMB & VIEW TOGGLE -->
    <div class="flex justify-between items-center mb-8 relative">
        <nav class="text-sm font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center">
                <li class="flex items-center">
                    <a href="{{ url('/') }}" class="hover:text-holiday transition">Beranda</a>
                    <i class="bi bi-chevron-right mx-2 text-xs"></i>
                </li>
                <li class="flex items-center">
                    <span class="text-ink font-bold">Destinasi</span>
                </li>
            </ol>
        </nav>

        <!-- Apple Style Dropdown -->
        <div class="relative">
            <button id="view-toggle-btn" class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
                <i class="bi bi-grid" id="current-view-icon"></i> <span class="hidden sm:inline">View</span>
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
    <div id="destinasi-grid" class="columns-2 md:columns-4 lg:columns-6 gap-4 space-y-4">
        @foreach($destinasi as $key => $item)
        @php
            $heights = ['250px', '300px', '200px', '350px', '250px', '400px', '200px', '350px', '300px', '250px'];
            $height = $heights[$key % count($heights)];
        @endphp
        <a href="{{ route('destinasi.show', $item->slug) }}" class="dest-item block relative group overflow-hidden rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 mb-4 break-inside-avoid bg-gray-200" style="height: {{ $height }};" data-kategori="{{ $item->kategori }}" data-nama="{{ strtolower($item->nama) }}">
            <img src="{{ $item->image_url }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item->nama }}">
            <div class="overlay-gradient-div absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="info-container-div absolute bottom-0 left-0 right-0 p-4 z-10">
                <h4 class="text-white font-extrabold text-lg leading-tight mb-1">{{ $item->nama }}</h4>
                <p class="text-gray-300 text-sm max-w-[15ch] truncate">{{ $item->deskripsi_singkat }}</p>
            </div>
        </a>
        @endforeach
    </div>

</main>

<!-- Scripts -->
<script>
    const viewToggleBtn = document.getElementById('view-toggle-btn');
    const viewDropdown = document.getElementById('view-dropdown');
    const destinasiGrid = document.getElementById('destinasi-grid');
    const currentViewIcon = document.getElementById('current-view-icon');
    let dropdownOpen = false;

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

    document.addEventListener('click', () => {
        if (dropdownOpen) {
            dropdownOpen = false;
            viewDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
            viewDropdown.classList.remove('opacity-100', 'visible', 'scale-100');
        }
    });

    function setView(viewMode) {
        destinasiGrid.style.opacity = 0;
        
        setTimeout(() => {
            destinasiGrid.classList.remove('view-uniform', 'view-card', 'columns-2', 'md:columns-4', 'lg:columns-6', 'gap-4', 'space-y-4');
            
            if (viewMode === 'pinterest') {
                destinasiGrid.classList.add('columns-2', 'md:columns-4', 'lg:columns-6', 'gap-4', 'space-y-4');
                currentViewIcon.className = 'bi bi-columns-gap';
                document.querySelectorAll('.dest-item').forEach((el, key) => {
                    const heights = ['250px', '300px', '200px', '350px', '250px', '400px', '200px', '350px', '300px', '250px'];
                    el.style.height = heights[key % heights.length];
                });
            } else if (viewMode === 'uniform') {
                destinasiGrid.classList.add('view-uniform');
                currentViewIcon.className = 'bi bi-grid-fill';
                document.querySelectorAll('.dest-item').forEach(el => el.style.height = '');
            } else if (viewMode === 'card') {
                destinasiGrid.classList.add('view-card');
                currentViewIcon.className = 'bi bi-card-list';
                document.querySelectorAll('.dest-item').forEach(el => el.style.height = '');
            }
            
            destinasiGrid.style.opacity = 1;
        }, 300);
    }

    function filterCategory(category, button) {
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('bg-holiday', 'text-white');
            btn.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
        });
        button.classList.add('bg-holiday', 'text-white');
        button.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');

        const items = document.querySelectorAll('.dest-item');
        items.forEach(item => {
            const cat = item.dataset.kategori;
            if (category === 'semua' || cat === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function searchDestinasi() {
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const items = document.querySelectorAll('.dest-item');
        items.forEach(item => {
            const name = item.dataset.nama;
            if (name.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection