@extends('layouts.app')

@section('title', 'Destinasi Pilihan - Jadiberangkat')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .hero-destinasi {
        position: relative; height: 60vh; min-height: 420px;
        background: url('{{ asset('img/hero-destinasi.jpg') }}') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center;
    }
    .hero-destinasi::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(47,111,66,0.75) 0%, rgba(0,0,0,0.45) 100%);
    }
    .hero-destinasi .hero-content { position: relative; z-index: 2; text-align: center; color: #fff; }
    .hero-destinasi h1 { font-size: clamp(2rem, 5vw, 4rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 0.5rem; text-shadow: 0 2px 20px rgba(0,0,0,0.3); }
    .hero-destinasi p { font-size: clamp(0.95rem, 1.5vw, 1.2rem); opacity: 0.9; max-width: 600px; margin: 0 auto; }

    .cat-btn { padding: 8px 22px; border-radius: 50px; font-size: 14px; font-weight: 600; transition: all 0.3s ease; cursor: pointer; border: 2px solid #ddd; background: transparent; color: #555; }
    .cat-btn:hover, .cat-btn.active { border-color: #2f6f42; background: #2f6f42; color: #fff; }

    .view-btn { padding: 8px 14px; border-radius: 8px; border: 1px solid #ddd; background: #fff; color: #555; cursor: pointer; transition: all 0.2s; }
    .view-btn.active { border-color: #2f6f42; background: #2f6f42; color: #fff; }
    .view-btn:hover:not(.active) { border-color: #2f6f42; color: #2f6f42; }

    .dest-card { border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.25,0.46,0.45,0.94); cursor: pointer; }
    .dest-card:hover { transform: translateY(-6px); box-shadow: 0 12px 40px rgba(47,111,66,0.15); }
    .dest-card .card-img { position: relative; overflow: hidden; aspect-ratio: 4/3; }
    .dest-card .card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
    .dest-card:hover .card-img img { transform: scale(1.08); }
    .dest-card .card-badge { position: absolute; top: 12px; left: 12px; padding: 4px 14px; border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: rgba(47,111,66,0.9); color: #fff; backdrop-filter: blur(4px); }
    .dest-card .card-rating { position: absolute; top: 12px; right: 12px; display: flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 12px; font-weight: 700; background: rgba(255,255,255,0.9); color: #f59e0b; backdrop-filter: blur(4px); }
    .dest-card .card-body { padding: 18px; }
    .dest-card .card-body h3 { font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
    .dest-card .card-body .location { font-size: 13px; color: #888; display: flex; align-items: center; gap: 5px; margin-bottom: 10px; }
    .dest-card .card-body .location i { color: #2f6f42; }
    .dest-card .card-body .meta { display: flex; flex-wrap: wrap; gap: 12px; font-size: 12px; color: #888; margin-bottom: 12px; }
    .dest-card .card-body .meta span { display: flex; align-items: center; gap: 4px; }
    .dest-card .card-body .meta i { color: #2f6f42; }
    .dest-card .card-body .price { font-size: 20px; font-weight: 800; color: #2f6f42; }
    .dest-card .card-body .price small { font-size: 12px; font-weight: 400; color: #888; }

    .featured-card-large { grid-column: span 2; grid-row: span 2; }
    .featured-card-large .card-img { aspect-ratio: auto; height: 100%; }
    .featured-card-large .card-body { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.75)); color: #fff; padding: 30px 24px 20px; }
    .featured-card-large .card-body h3 { color: #fff; font-size: 24px; }
    .featured-card-large .card-body .location, .featured-card-large .card-body .meta { color: rgba(255,255,255,0.8); }
    .featured-card-large .card-body .price { color: #fff; }
    .featured-card-large .card-body .price small { color: rgba(255,255,255,0.7); }

    .grid-pinterest .dest-card:nth-child(3n+1) .card-img { aspect-ratio: 3/4; }
    .grid-pinterest .dest-card:nth-child(3n+2) .card-img { aspect-ratio: 1/1; }
    .grid-pinterest .dest-card:nth-child(3n+3) .card-img { aspect-ratio: 4/3; }

    .grid-uniform .dest-card .card-img { aspect-ratio: 4/3; }

    .grid-card .dest-card { display: flex; flex-direction: row; }
    .grid-card .dest-card .card-img { min-width: 280px; aspect-ratio: auto; height: 200px; }
    .grid-card .dest-card .card-body { flex: 1; display: flex; flex-direction: column; justify-content: center; }

    .search-box { position: relative; }
    .search-box input { width: 100%; padding: 14px 20px 14px 50px; border-radius: 60px; border: 2px solid #e0e0e0; background: #fff; font-size: 15px; outline: none; transition: all 0.3s; }
    .search-box input:focus { border-color: #2f6f42; box-shadow: 0 0 0 4px rgba(47,111,66,0.1); }
    .search-box i { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #999; font-size: 18px; }

    @media (max-width: 768px) {
        .grid-card .dest-card { flex-direction: column; }
        .grid-card .dest-card .card-img { min-width: auto; }
    }
</style>
@endpush

@section('content')
<section class="hero-destinasi">
    <div class="hero-content px-4">
        <h1>Destinasi Pilihan</h1>
        <p>Temukan pengalaman perjalanan tak terlupakan bersama Jadiberangkat</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <span>Destinasi</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#1a1a2e] flex items-center gap-2">
            <i class="bi bi-star-fill text-[#2f6f42]"></i> Untuk Anda
        </h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 auto-rows-[280px]">
        <a href="{{ route('destinasi.show', 'kawah-ijen') }}" class="dest-card featured-card-large relative overflow-hidden rounded-2xl group">
            <div class="card-img absolute inset-0">
                <img src="{{ asset('img/kawah-ijen.jpg') }}" alt="Kawah Ijen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="relative z-10 mt-auto p-6 text-white">
                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-[#2f6f42]/90 rounded-full mb-3">Alam</span>
                <h3 class="text-2xl font-bold mb-1">Kawah Ijen</h3>
                <p class="flex items-center gap-1 text-sm text-white/80 mb-2"><i class="bi bi-geo-alt"></i> Banyuwangi, Jawa Timur</p>
                <div class="flex items-center gap-4 text-xs text-white/70 mb-3">
                    <span><i class="bi bi-clock"></i> 3 Hari</span>
                    <span><i class="bi bi-emoji-smile"></i> Petualangan</span>
                    <span class="flex items-center gap-1 text-yellow-400"><i class="bi bi-star-fill"></i> 4.8</span>
                </div>
                <div class="text-2xl font-bold">Rp 1.250K <small class="text-sm font-normal text-white/60">/orang</small></div>
            </div>
        </a>

        <a href="{{ route('destinasi.show', 'de-djawatan') }}" class="dest-card rounded-2xl overflow-hidden group">
            <div class="card-img h-[280px]">
                <img src="{{ asset('img/de-djawatan.jpg') }}" alt="De Djawatan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-4 bg-white">
                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-[#2f6f42]/90 text-white rounded-full mb-2">Alam</span>
                <h3 class="text-lg font-bold text-[#1a1a2e]">De Djawatan</h3>
                <p class="flex items-center gap-1 text-sm text-gray-500"><i class="bi bi-geo-alt text-[#2f6f42]"></i> Banyuwangi</p>
                <div class="flex items-center gap-3 text-xs text-gray-400 mt-2 mb-2">
                    <span><i class="bi bi-clock"></i> 1 Hari</span>
                    <span class="flex items-center gap-1 text-yellow-400"><i class="bi bi-star-fill"></i> 4.6</span>
                </div>
                <div class="text-lg font-bold text-[#2f6f42]">Rp 350K <small class="text-xs font-normal text-gray-400">/org</small></div>
            </div>
        </a>

        <a href="{{ route('destinasi.show', 'pantai-boom') }}" class="dest-card rounded-2xl overflow-hidden group">
            <div class="card-img h-[130px]">
                <img src="{{ asset('img/pantai-boom.jpg') }}" alt="Pantai Boom" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-4 bg-white">
                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-blue-500 text-white rounded-full mb-2">Pantai</span>
                <h3 class="text-lg font-bold text-[#1a1a2e]">Pantai Boom</h3>
                <p class="flex items-center gap-1 text-sm text-gray-500"><i class="bi bi-geo-alt text-[#2f6f42]"></i> Banyuwangi</p>
                <div class="flex items-center gap-3 text-xs text-gray-400 mt-2 mb-2">
                    <span><i class="bi bi-clock"></i> 1 Hari</span>
                    <span class="flex items-center gap-1 text-yellow-400"><i class="bi bi-star-fill"></i> 4.5</span>
                </div>
                <div class="text-lg font-bold text-[#2f6f42]">Rp 250K <small class="text-xs font-normal text-gray-400">/org</small></div>
            </div>
        </a>

        <a href="{{ route('destinasi.show', 'pulau-merah') }}" class="dest-card rounded-2xl overflow-hidden group">
            <div class="card-img h-[130px]">
                <img src="{{ asset('img/pulau-merah.jpg') }}" alt="Pulau Merah" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-4 bg-white">
                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-blue-500 text-white rounded-full mb-2">Pantai</span>
                <h3 class="text-lg font-bold text-[#1a1a2e]">Pulau Merah</h3>
                <p class="flex items-center gap-1 text-sm text-gray-500"><i class="bi bi-geo-alt text-[#2f6f42]"></i> Banyuwangi</p>
                <div class="flex items-center gap-3 text-xs text-gray-400 mt-2 mb-2">
                    <span><i class="bi bi-clock"></i> 1 Hari</span>
                    <span class="flex items-center gap-1 text-yellow-400"><i class="bi bi-star-fill"></i> 4.7</span>
                </div>
                <div class="text-lg font-bold text-[#2f6f42]">Rp 300K <small class="text-xs font-normal text-gray-400">/org</small></div>
            </div>
        </a>

        <a href="{{ route('destinasi.show', 'ijen-blaster') }}" class="dest-card rounded-2xl overflow-hidden group">
            <div class="card-img h-[130px]">
                <img src="{{ asset('img/ijen-blaster.jpg') }}" alt="Ijen Blaster" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-4 bg-white">
                <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-purple-600 text-white rounded-full mb-2">Budaya</span>
                <h3 class="text-lg font-bold text-[#1a1a2e]">Ijen Blaster</h3>
                <p class="flex items-center gap-1 text-sm text-gray-500"><i class="bi bi-geo-alt text-[#2f6f42]"></i> Banyuwangi</p>
                <div class="flex items-center gap-3 text-xs text-gray-400 mt-2 mb-2">
                    <span><i class="bi bi-clock"></i> 2 Hari</span>
                    <span class="flex items-center gap-1 text-yellow-400"><i class="bi bi-star-fill"></i> 4.9</span>
                </div>
                <div class="text-lg font-bold text-[#2f6f42]">Rp 850K <small class="text-xs font-normal text-gray-400">/org</small></div>
            </div>
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <h2 class="text-2xl font-bold text-[#1a1a2e]">Semua Destinasi</h2>
            @auth
            <a href="{{ route('admin.destinasi.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-xs font-bold rounded-full hover:bg-[#255a35] transition shadow-md">
                <i class="bi bi-plus-lg"></i> Tambah Destinasi
            </a>
            @endauth
        </div>
        <div class="flex items-center gap-3">
            <div class="search-box flex-1 sm:w-64">
                <i class="bi bi-search"></i>
                <input type="text" id="searchDestinasi" placeholder="Cari destinasi..." oninput="filterDestinasi()">
            </div>
            <div class="flex gap-1" id="viewToggle">
                <button class="view-btn active" data-view="uniform" title="Uniform Grid" onclick="setView('uniform', this)"><i class="bi bi-grid-3x3-gap-fill"></i></button>
                <button class="view-btn" data-view="pinterest" title="Pinterest" onclick="setView('pinterest', this)"><i class="bi bi-grid-1x2-fill"></i></button>
                <button class="view-btn" data-view="card" title="Card List" onclick="setView('card', this)"><i class="bi bi-view-list"></i></button>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-6" id="categoryFilters">
        <button class="cat-btn active" data-cat="semua" onclick="filterCategory('semua', this)">Semua</button>
        <button class="cat-btn" data-cat="alam" onclick="filterCategory('alam', this)">Alam</button>
        <button class="cat-btn" data-cat="budaya" onclick="filterCategory('budaya', this)">Budaya</button>
        <button class="cat-btn" data-cat="pantai" onclick="filterCategory('pantai', this)">Pantai</button>
        <button class="cat-btn" data-cat="kuliner" onclick="filterCategory('kuliner', this)">Kuliner</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="destinasiGrid">
        @foreach($destinasi as $item)
        <div class="relative">
            <a href="{{ route('destinasi.show', $item->slug) }}" class="dest-card" data-kategori="{{ $item->kategori }}" data-nama="{{ strtolower($item->nama) }}">
                <div class="card-img">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
                    @if($item->kategori)
                    <span class="card-badge">{{ $item->kategori }}</span>
                    @endif
                    @if($item->rating)
                    <span class="card-rating"><i class="bi bi-star-fill"></i> {{ number_format($item->rating, 1) }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <h3>{{ $item->nama }}</h3>
                    @if($item->lokasi)
                    <p class="location"><i class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
                    @endif
                    <div class="meta">
                        @if($item->durasi)
                        <span><i class="bi bi-clock"></i> {{ $item->durasi }}</span>
                        @endif
                        @if($item->mood)
                        <span><i class="bi bi-emoji-smile"></i> {{ $item->mood }}</span>
                        @endif
                    </div>
                    @if($item->harga)
                    <div class="price">Rp {{ number_format($item->harga, 0, ',', '.') }} <small>/orang</small></div>
                    @endif
                </div>
            </a>
            @auth
            <div class="absolute top-2 right-2 flex gap-1.5 z-10">
                <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="text-xs bg-yellow-100 text-yellow-700 rounded-full px-2.5 py-1 font-bold hover:bg-yellow-200 transition shadow-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus destinasi ini?')" class="inline">
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

    <div class="mt-10">
        {{ $destinasi->links() }}
    </div>
</section>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);

    gsap.from('.hero-destinasi .hero-content', {
        opacity: 0, y: 40, duration: 1, ease: 'power3.out'
    });

    gsap.from('.featured-card-large', {
        scrollTrigger: { trigger: '.featured-card-large', start: 'top 90%' },
        opacity: 0, y: 30, duration: 0.6
    });

    document.querySelectorAll('.dest-card:not(.featured-card-large)').forEach((el,i) => {
        gsap.from(el, {
            scrollTrigger: { trigger: el, start: 'top 95%' },
            opacity: 0, y: 30, duration: 0.5, delay: i*0.05
        });
    });

    let currentCategory = 'semua';
    let currentView = 'uniform';

    function filterCategory(cat, btn) {
        currentCategory = cat;
        document.querySelectorAll('#categoryFilters .cat-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterDestinasi();
    }

    function filterDestinasi() {
        const search = (document.getElementById('searchDestinasi').value || '').toLowerCase();
        document.querySelectorAll('#destinasiGrid .dest-card').forEach(card => {
            const cat = (card.dataset.kategori || '').toLowerCase();
            const nama = (card.dataset.nama || '');
            const matchCat = currentCategory === 'semua' || cat === currentCategory;
            const matchSearch = nama.includes(search);
            card.style.display = (matchCat && matchSearch) ? '' : 'none';
        });
    }

    function setView(view, btn) {
        currentView = view;
        document.querySelectorAll('#viewToggle .view-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const grid = document.getElementById('destinasiGrid');
        grid.className = 'grid gap-5 ' + (
            view === 'uniform' ? 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 grid-uniform' :
            view === 'pinterest' ? 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 grid-pinterest' :
            'grid-cols-1 grid-card'
        );
    }
</script>
@endpush
@endsection