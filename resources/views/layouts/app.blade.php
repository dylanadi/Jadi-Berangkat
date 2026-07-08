<!DOCTYPE html>
<html lang="id" class="scroll-smooth" style="min-height:100vh;background:#f4f0e7">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jadi Berangkat - Premium Jeep Booking')</title>
    <meta name="description" content="{{ $seoData['meta_description'] ?? 'Jelajahi Banyuwangi dengan Jeep 4x4 bersama Jadi Berangkat.' }}">
    <meta name="keywords" content="{{ $seoData['meta_keywords'] ?? 'jeep banyuwangi, wisata banyuwangi, sewa jeep' }}">
    @if(!empty($seoData['favicon']))
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $seoData['favicon']) }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('img/logo-icon.png') }}">
    @endif
    <meta property="og:title" content="{{ $seoData['meta_title'] ?? 'Jadi Berangkat' }}">
    <meta property="og:description" content="{{ $seoData['meta_description'] ?? 'Jelajahi Banyuwangi dengan Jeep 4x4.' }}">
    @if(!empty($seoData['og_image']))
    <meta property="og:image" content="{{ asset('storage/' . $seoData['og_image']) }}">
    @endif
    <meta property="og:type" content="website">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    @stack('styles')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        base: '#f4f0e7',
                        ink: '#151813',
                        clay: '#b96f3c',
                        mist: '#dfe8df',
                        holiday: {
                            DEFAULT: '#2f6f42',
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        },
                        'holiday-dark': '#17442a',
                        'holiday-light': '#b8d9bd',
                        'holiday-glow': 'rgba(47, 111, 66, 0.28)'
                    }
                }
            }
        }
    </script>

    <style>
        html { min-height: 100vh; }
        html, body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f0e7; color: #151813; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .card-gradient { background: linear-gradient(to top, rgba(7,13,9,0.96) 0%, rgba(7,13,9,0.34) 58%, transparent 100%); }
        .hero-gradient { background: linear-gradient(90deg, rgba(10,16,11,0.82) 0%, rgba(10,16,11,0.56) 42%, rgba(10,16,11,0.14) 100%), linear-gradient(to bottom, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.02) 48%, rgba(0,0,0,0.58) 100%); }
        .section-shell { max-width: 1280px; margin-inline: auto; padding-inline: 1.5rem; }
        .btn-primary { background: #2f6f42; color: #fff; box-shadow: 0 16px 42px rgba(47, 111, 66, 0.26); }
        .btn-primary:hover { background: #17442a; transform: translateY(-1px); }
        .btn-secondary { border: 1px solid rgba(255,255,255,0.34); background: rgba(255,255,255,0.12); color: #fff; backdrop-filter: blur(14px); }
        .btn-secondary:hover { background: rgba(255,255,255,0.2); transform: translateY(-1px); }
        .surface-card { background: rgba(255,255,255,0.72); border: 1px solid rgba(21,24,19,0.08); box-shadow: 0 20px 70px rgba(36, 45, 34, 0.08); }
        .eyebrow { color: #2f6f42; font-size: .78rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
        .flag-button { width: 28px; height: 28px; border-radius: 999px; border: 1px solid rgba(21,24,19,0.1); box-shadow: inset 0 0 0 1px rgba(255,255,255,0.65); overflow: hidden; }
        .flag-id { background: linear-gradient(to bottom, #ef3340 0 50%, #fff 50% 100%); }
        .flag-en { background: linear-gradient(to bottom, transparent 41%, #c8102e 41% 59%, transparent 59%), linear-gradient(to right, transparent 42%, #c8102e 42% 58%, transparent 58%), linear-gradient(to bottom, transparent 32%, #fff 32% 68%, transparent 68%), linear-gradient(to right, transparent 34%, #fff 34% 66%, transparent 66%), linear-gradient(34deg, transparent 44%, #c8102e 44% 56%, transparent 56%), linear-gradient(-34deg, transparent 44%, #c8102e 44% 56%, transparent 56%), linear-gradient(34deg, transparent 38%, #fff 38% 62%, transparent 62%), linear-gradient(-34deg, transparent 38%, #fff 38% 62%, transparent 62%), #012169; }
        .carousel-card { transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1); position: absolute; cursor: pointer; will-change: transform, opacity; user-select: none; -webkit-user-drag: none; }
        .carousel-card:not(.active) .card-content { opacity: 0; pointer-events: none; transform: translateY(20px); }
        .carousel-card.active .card-content { opacity: 1; transform: translateY(0); }
        .carousel-card.active:hover img { transform: scale(1.08); }
        #carousel-container { -webkit-tap-highlight-color: transparent; }
        .slider-card-native { transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease; position: relative; }
        @media (max-width: 767px) {
            #paket-slider, #slider-armada, #idx-art-slider { padding-left: 14vw !important; padding-right: 14vw !important; }
            .slider-card-native { width: 80vw !important; flex: 0 0 80vw !important; margin: 0 -4vw !important; opacity: 0.35; transform: scale(0.85); }
            .slider-card-native::after { content: ''; position: absolute; inset: 0; background: black; opacity: 0.3; transition: opacity 0.5s ease; pointer-events: none; z-index: 20; border-radius: inherit; }
            .slider-card-native.active-slide { opacity: 1; transform: scale(1); z-index: 10; }
            .slider-card-native.active-slide::after { opacity: 0; }
        }
        @media (min-width: 768px) {
            .slider-card-native { opacity: 1; transform: scale(1); }
            .slider-card-native:hover { transform: translateY(-8px); }
        }
        .marquee-wrapper { display: flex; overflow: hidden; width: 100%; mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); }
        .marquee-track { display: flex; width: max-content; animation: marquee 30s linear infinite; }
        .marquee-track:hover { animation-play-state: paused; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .gsap-item { opacity: 1; visibility: visible; }
        .smooth-scroll-x { scroll-behavior: smooth; }
        .slider-dot { transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; transition-duration: 0.01ms !important; }
        }
        #navbar { transition: all 0.5s ease; }
        html { scroll-padding-top: 100px; }
        .img-edit-overlay { position:absolute;top:0;right:0;z-index:999;opacity:0;transition:opacity 0.2s; }
        .img-wrapper:hover .img-edit-overlay { opacity:1; }
        .img-edit-overlay button { width:36px;height:36px;background:#2f6f42;color:#fff;border:none;border-radius:0 0 0 8px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 2px 8px rgba(0,0,0,0.3); }
        .img-edit-overlay button:hover { background:#17442a; }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .edit-mode-only { display: none !important; }
        body.is-editing .edit-mode-only { display: inline-flex !important; }
        /* Hide Google Translate UI */
        .VIpgJd-ZVi9od-ORHb-OEVmcd { display: none !important; }
        .goog-te-banner-frame { display: none !important; }
        body { top: 0 !important; }
        .goog-tooltip { display: none !important; }
        .goog-tooltip:hover { display: none !important; }
        .goog-text-highlight { background-color: transparent !important; border: none !important; box-shadow: none !important; }
    </style>
</head>
<body class="text-gray-800 overflow-x-hidden antialiased min-h-screen flex flex-col">

    {{-- Navbar & Sidebar --}}
    <div id="menu-overlay" class="fixed inset-0 !bg-black/60 z-[60] hidden opacity-0 backdrop-blur-sm"></div>
    <aside id="mobile-sidebar" class="fixed top-0 left-0 h-full w-[85%] max-w-sm !bg-base shadow-2xl z-[70] p-6 flex flex-col transform -translate-x-full border-r !border-black/5 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold flex items-center gap-2">
                <i class="bi bi-jeep !text-holiday"></i> JB.
            </a>
            <button id="close-menu-btn" class="w-10 h-10 rounded-full !bg-white flex items-center justify-center !text-gray-800 hover:!bg-holiday hover:!text-white transition shadow-sm border !border-black/5">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <nav class="flex flex-col gap-3 text-[15px] font-bold !text-gray-700">
            <a href="{{ url('/') }}" class="flex items-center gap-4 p-3 rounded-2xl hover:!bg-white hover:!text-holiday transition border !border-transparent hover:!border-black/5 hover:shadow-sm"><i class="bi bi-house text-xl"></i> Beranda</a>
            <a href="{{ url('/tentang') }}" class="flex items-center gap-4 p-3 rounded-2xl hover:!bg-white hover:!text-holiday transition border !border-transparent hover:!border-black/5 hover:shadow-sm"><i class="bi bi-info-circle text-xl"></i> Tentang</a>
            <div class="flex flex-col rounded-2xl !bg-white/40 border !border-black/5 overflow-hidden">
                <button class="flex items-center justify-between p-3 w-full text-left font-bold hover:!text-holiday transition" onclick="this.nextElementSibling.classList.toggle('hidden')">
                    <span class="flex items-center gap-4"><i class="bi bi-compass text-xl"></i> Wisata</span>
                    <i class="bi bi-chevron-down text-sm"></i>
                </button>
                <div class="hidden flex-col gap-2 p-3 pt-0 border-t !border-black/5 mt-2">
                    <a href="{{ url('/destinasi') }}" class="flex items-center gap-3 p-3 rounded-xl !bg-white shadow-sm border !border-black/5 hover:!border-holiday transition">
                        <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 border !border-black/5">
                            <img src="{{ asset('img/bluefire (1).png') }}" alt="Destinasi" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="block !text-ink text-sm font-extrabold">Destinasi</span>
                            <span class="text-[10px] !text-gray-500 font-medium">Jelajahi surga tersembunyi.</span>
                        </div>
                    </a>
                    <a href="{{ url('/galeri') }}" class="flex items-center gap-3 p-3 rounded-xl !bg-white shadow-sm border !border-black/5 hover:!border-holiday transition">
                        <div class="w-12 h-12 rounded-lg !bg-mist/50 flex items-center justify-center !text-holiday shrink-0 border !border-black/5">
                            <i class="bi bi-images text-xl"></i>
                        </div>
                        <div>
                            <span class="block !text-ink text-sm font-extrabold">Galery</span>
                            <span class="text-[10px] !text-gray-500 font-medium">Koleksi foto perjalanan.</span>
                        </div>
                    </a>
                    <a href="{{ url('/artikel') }}" class="flex items-center gap-3 p-3 rounded-xl !bg-ink shadow-sm border !border-black/5 hover:!bg-holiday transition !text-white">
                        <div class="w-12 h-12 rounded-lg !bg-white/10 flex items-center justify-center !text-white shrink-0">
                            <i class="bi bi-newspaper text-xl"></i>
                        </div>
                        <div>
                            <span class="block !text-white text-sm font-extrabold">Hal Baru</span>
                            <span class="text-[10px] !text-white/70 font-medium">Berita & tips terbaru.</span>
                        </div>
                    </a>
                </div>
            </div>
            <a href="{{ url('/privasi') }}" class="flex items-center gap-4 p-3 rounded-2xl hover:!bg-white hover:!text-holiday transition border !border-transparent hover:!border-black/5 hover:shadow-sm"><i class="bi bi-shield-check text-xl"></i> Privasi</a>
        </nav>
        <div class="mt-auto pt-8 flex flex-col gap-4">
            <div class="flex items-center justify-between p-4 rounded-2xl !bg-white border !border-black/5 shadow-sm">
                <span class="text-sm font-bold !text-gray-700">Bahasa</span>
                <div class="flex items-center gap-2">
                    <button onclick="switchLanguage('id')" class="lang-selector-id-mob flex items-center gap-2 !bg-base px-3 py-2 rounded-xl border !border-black/5 hover:!border-holiday transition">
                        <img src="https://flagcdn.com/id.svg" class="w-5 h-auto rounded-sm shadow-sm" alt="ID">
                        <span class="font-bold text-sm">ID</span>
                    </button>
                    <button onclick="switchLanguage('en')" class="lang-selector-en-mob flex items-center gap-2 !bg-transparent px-3 py-2 rounded-xl border !border-transparent hover:!bg-base hover:!border-black/5 transition">
                        <img src="https://flagcdn.com/gb.svg" class="w-5 h-auto rounded-sm shadow-sm" alt="EN">
                        <span class="font-bold text-sm !text-gray-400 hover:!text-ink">EN</span>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <header id="header-wrapper" class="fixed w-full top-0 z-50 transition-all duration-700 ease-in-out py-3 flex justify-center px-4 md:px-6">
        <div id="nav-container" class="w-full max-w-[1440px] flex justify-between items-center px-6 md:px-9 py-3.5 transition-all duration-500 !text-ink !bg-white/90 backdrop-blur-xl rounded-[1.65rem] border !border-white/70 shadow-[0_18px_55px_rgba(0,0,0,0.16)]">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold tracking-wide flex items-center gap-2">
                <i class="bi bi-jeep !text-holiday"></i> <span class="hidden sm:block">Jadi Berangkat</span><span class="sm:hidden">JB.</span>
            </a>
            <nav class="hidden md:flex gap-8 font-semibold items-center !text-gray-700">
                <a href="{{ url('/') }}" class="hover:!text-holiday transition">Beranda</a>
                <a href="{{ url('/tentang') }}" class="hover:!text-holiday transition">Tentang</a>
                <div class="relative group">
                    <button class="hover:!text-holiday transition flex items-center gap-1 cursor-pointer py-2">
                        Wisata <i class="bi bi-chevron-down text-[10px] stroke-[2px] transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-[540px] !bg-white border !border-black/5 rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] p-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-400 transform origin-top -translate-y-2 group-hover:translate-y-0 z-[60]">
                        <div class="grid grid-cols-5 gap-4 h-[220px]">
                            <div class="col-span-3 flex flex-col gap-3">
                                <a href="{{ url('/destinasi') }}" class="group/dest flex-1 flex items-center p-3 rounded-2xl !bg-base border !border-black/5 hover:!bg-white hover:shadow-md hover:shadow-black/5 transition-all duration-300 gap-4">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 shadow-sm border !border-black/5">
                                        <img src="{{ asset('img/bluefire (1).png') }}" alt="Destinasi" class="w-full h-full object-cover group-hover/dest:scale-110 transition duration-700">
                                    </div>
                                    <div class="flex-1 pr-1">
                                        <span class="block font-extrabold !text-ink text-[15px] mb-0.5">Destinasi</span>
                                        <p class="text-[11px] !text-gray-500 font-medium leading-snug">Jelajahi surga tersembunyi yang menakjubkan.</p>
                                    </div>
                                </a>
                                <a href="{{ url('/artikel') }}" class="group/news flex-1 flex items-center p-3 rounded-2xl !bg-base border !border-black/5 hover:!bg-white hover:shadow-md hover:shadow-black/5 transition-all duration-300 gap-4">
                                    <div class="w-20 h-20 rounded-xl !bg-mist/50 border !border-black/5 flex items-center justify-center !text-holiday group-hover/news:bg-holiday group-hover/news:text-white transition-all duration-300 shrink-0 shadow-sm">
                                        <i class="bi bi-newspaper text-2xl"></i>
                                    </div>
                                    <div class="flex-1 pr-1">
                                        <span class="block font-extrabold !text-ink text-[15px] mb-0.5">Hal Baru</span>
                                        <p class="text-[11px] !text-gray-500 font-medium leading-snug">Berita, tips, dan update perjalanan terbaru.</p>
                                    </div>
                                </a>
                            </div>
                            <a href="{{ url('/galeri') }}" class="col-span-2 group/gal relative rounded-2xl overflow-hidden flex flex-col p-4 h-full shadow-sm border !border-black/5">
                                <img src="{{ asset('img/djawatan.jpg') }}" alt="Galeri" class="absolute inset-0 w-full h-full object-cover group-hover/gal:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/10"></div>
                                <div class="relative z-10 flex flex-col h-full justify-between">
                                    <div class="w-8 h-8 rounded-full !bg-white/20 backdrop-blur-md flex items-center justify-center !text-white border !border-white/30 self-start group-hover/gal:bg-holiday group-hover/gal:border-holiday group-hover/gal:scale-110 transition duration-300">
                                        <i class="bi bi-arrow-up-right text-xs"></i>
                                    </div>
                                    <div>
                                        <h3 class="!text-white font-extrabold text-lg tracking-wide">Galery</h3>
                                        <p class="!text-white/80 text-[10px] font-semibold uppercase tracking-wider mt-0.5 flex items-center">Lihat <i class="bi bi-arrow-right ml-1 transition-transform group-hover/gal:translate-x-1"></i></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex items-center gap-4">
                <a href="{{ url('/privasi') }}" class="hidden md:flex items-center justify-center w-11 h-11 rounded-full border !border-black/10 !text-ink hover:!text-holiday hover:!border-holiday transition !bg-white/50 backdrop-blur-md" title="Kebijakan Privasi"><i class="bi bi-shield-check text-xl"></i></a>
                <div class="hidden md:flex items-center gap-3 border-l !border-black/10 pl-4" aria-label="Pilihan bahasa">
                    <button onclick="switchLanguage('id')" class="lang-selector-id w-7 h-7 rounded-full overflow-hidden border !border-black/10 hover:opacity-80 transition" aria-label="Bahasa Indonesia"><img src="https://flagcdn.com/id.svg" alt="ID" class="w-full h-full object-cover"></button>
                    <button onclick="switchLanguage('en')" class="lang-selector-en w-7 h-7 rounded-full overflow-hidden border !border-black/10 hover:opacity-80 transition" aria-label="English"><img src="https://flagcdn.com/gb.svg" alt="EN" class="w-full h-full object-cover"></button>
                </div>
                <button id="open-menu-btn" class="md:hidden w-11 h-11 flex items-center justify-center rounded-full !bg-ink !text-white border !border-black/10 hover:!bg-holiday transition">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-1 pt-24">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-ink text-white pt-20 pb-8 border-t-[6px] border-holiday">
        <div class="section-shell">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8 mb-16">
                <div class="md:col-span-5 pr-0 md:pr-10">
                    <a href="{{ url('/') }}" class="text-3xl font-extrabold tracking-wide flex items-center gap-2 mb-6 text-white">
                        <div class="w-10 h-10 bg-holiday rounded-xl flex items-center justify-center shadow-lg">
                            <i class="bi bi-jeep text-white text-xl"></i>
                        </div>
                        <span data-edit="footer_judul" data-edit-type="text" data-edit-tipe="beranda">{{ $footerData['footer_judul'] ?? 'Jadi Berangkat' }}</span>
                    </a>
                    <p data-edit="footer_tentang" data-edit-type="text" data-edit-tipe="beranda" class="text-gray-400 text-sm leading-relaxed mb-8 font-medium">
                        {{ $footerData['footer_tentang'] ?? 'Platform penyedia layanan penyewaan Jeep wisata premium.' }}
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/jadiberangkat/" target="_blank" rel="noopener noreferrer" aria-label="Instagram Jadi Berangkat" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-holiday hover:scale-110 transition-all"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/jadiberangkat/" target="_blank" rel="noopener noreferrer" aria-label="Facebook Jadi Berangkat" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-holiday hover:scale-110 transition-all"><i class="bi bi-facebook"></i></a>
                        <a href="https://wa.me/6285196161351" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Jadi Berangkat" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-holiday hover:scale-110 transition-all"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="md:col-span-3 md:col-start-7">
                    <h4 class="text-lg font-extrabold mb-6 text-white">Eksplorasi</h4>
                    <ul class="space-y-4 text-sm text-gray-400 font-bold">
                        <li><a href="{{ url('/tentang') }}" class="hover:text-holiday transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ url('/destinasi') }}" class="hover:text-holiday transition-colors">Destinasi Populer</a></li>
                        <li><a href="{{ url('/destinasi') }}" class="hover:text-holiday transition-colors">Paket Promo</a></li>
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h4 class="text-lg font-extrabold mb-6 text-white">Dukungan</h4>
                    <ul class="space-y-4 text-sm text-gray-400 font-bold">
                        <li><a href="{{ url('/bantuan') }}" class="hover:text-holiday transition-colors">Bantuan</a></li>
                        <li><a href="{{ url('/privasi') }}" class="hover:text-holiday transition-colors">Syarat Ketentuan</a></li>
                        <li><a href="https://wa.me/6285196161351" target="_blank" rel="noopener noreferrer" class="hover:text-holiday transition-colors">Kontak</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center md:text-left flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 pt-8 border-t border-gray-800 font-medium">
                <p data-edit="footer_copyright" data-edit-type="text" data-edit-tipe="beranda">{{ $footerData['footer_copyright'] ?? '&copy; ' . date('Y') . ' Jadi Berangkat. All rights reserved.' }}</p>
                <p class="mt-2 md:mt-0">Jeep trip Banyuwangi, siap dipesan online.</p>
            </div>
        </div>
    </footer>

    {{-- Scroll To Top Button --}}
    <button id="scrollToTopBtn" class="fixed bottom-6 left-6 md:bottom-10 md:left-10 w-12 h-12 md:w-14 md:h-14 bg-holiday text-white rounded-full flex items-center justify-center shadow-xl shadow-holiday/30 z-[90] opacity-0 invisible translate-y-10 hover:bg-[#236026] transition-colors" aria-label="Scroll to top">
        <i class="bi bi-arrow-up text-xl md:text-2xl font-bold"></i>
    </button>

    {{-- WhatsApp Button --}}
    <a href="https://wa.me/6285196161351" target="_blank" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 w-12 h-12 md:w-14 md:h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-xl shadow-green-500/30 z-[90] hover:bg-green-600 transition-colors" aria-label="WhatsApp">
        <i class="bi bi-whatsapp text-xl md:text-2xl font-bold"></i>
    </a>

    {{-- Core Scripts --}}
    <script>
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
                btn.addEventListener('click', () => { window.scrollTo({ top: 0, behavior: 'smooth' }); });
            }
        });
    </script>

    <script>
        // Mobile Menu
        const openBtn = document.getElementById('open-menu-btn');
        const closeBtn = document.getElementById('close-menu-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('menu-overlay');

        function openMenu() {
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            sidebar.classList.remove('-translate-x-full');
        }

        function closeMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }

        if (openBtn) openBtn.addEventListener('click', openMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        if (overlay) overlay.addEventListener('click', closeMenu);

        // GSAP Scroll Animations
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            gsap.utils.toArray('.gsap-section').forEach(section => {
                const items = section.querySelectorAll('.gsap-item');
                if (items.length > 0) {
                    gsap.fromTo(items,
                        { y: 50, autoAlpha: 0 },
                        {
                            scrollTrigger: { trigger: section, start: 'top 85%' },
                            y: 0, autoAlpha: 1, duration: 0.8, stagger: 0.15, ease: 'power3.out'
                        }
                    );
                }
            });
        }
    </script>

    @stack('scripts')

@auth
{{-- Floating Admin Toolbar --}}
<div id="adminToolbar" class="fixed top-0 left-0 right-0 z-[9999] bg-gray-900/95 text-white px-4 py-2 shadow-lg backdrop-blur-md border-b border-gray-700 hidden">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-4">
      <span class="font-extrabold text-sm flex items-center gap-2"><i class="bi bi-shield-check text-holiday-light"></i> Panel Admin</span>
      <div class="h-4 w-px bg-gray-600"></div>
      <a href="/admin" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="/admin/destinasi" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-geo-alt"></i> Destinasi</a>
      <a href="/admin/artikel" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-newspaper"></i> Artikel</a>
      <a href="/admin/galeri" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-images"></i> Galeri</a>
      <a href="/admin/ulasan" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-star"></i> Ulasan</a>
      <a href="/admin/halaman" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-file-text"></i> Halaman</a>
      <a href="/admin/media-sosial" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-share"></i> Sosmed</a>
      <a href="/admin/faq" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-question-circle"></i> FAQ</a>
      <a href="/admin/pengaturan" class="text-xs text-gray-300 hover:text-white transition font-medium"><i class="bi bi-gear"></i> Pengaturan</a>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="toggleEditMode()" id="editModeBtnInToolbar" class="text-xs bg-holiday text-white px-3 py-1.5 rounded-full font-bold hover:bg-holiday-dark transition flex items-center gap-1.5">
        <i class="bi bi-pencil-square"></i> <span id="editModeLabel">Mode Edit</span>
      </button>
      <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="text-xs text-gray-400 hover:text-red-400 transition"><i class="bi bi-box-arrow-right"></i></button>
      </form>
    </div>
  </div>
</div>

<script>
let editMode = false;
let tinymceInitialized = false;

function showToast(msg, type) {
  const toast = document.getElementById('editToast') || (function() {
    const t = document.createElement('div');
    t.id = 'editToast';
    t.style.cssText = 'position:fixed;bottom:80px;left:50%;transform:translateX(-50%);z-index:9999;padding:10px 24px;border-radius:8px;font-size:14px;font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.2);transition:opacity 0.3s;max-width:90vw;text-align:center';
    document.body.appendChild(t);
    return t;
  })();
  toast.style.background = type === 'error' ? '#dc2626' : '#2f6f42';
  toast.style.color = '#fff';
  toast.textContent = msg;
  toast.style.display = 'block';
  toast.style.opacity = '1';
  clearTimeout(toast._timer);
  toast._timer = setTimeout(() => { toast.style.opacity = '0'; }, 4000);
}

// Show admin toolbar on load
document.getElementById('adminToolbar').style.display = 'block';

function toggleEditMode() {
  editMode = !editMode;
  document.getElementById('editModeLabel').textContent = editMode ? 'Selesai Edit' : 'Mode Edit';
  document.body.classList.toggle('is-editing', editMode);

  if (editMode) {
    document.querySelectorAll('[data-edit]').forEach(el => makeEditable(el));
    initTinyMCE();
  } else {
    if (typeof tinymce !== 'undefined') { tinymce.remove(); }
    finishEditMode();
    saveAllDirty();
  }
}

function initTinyMCE() {
  if (typeof tinymce === 'undefined') return;
  document.querySelectorAll('[data-edit-type="html"]').forEach(el => {
    if (!el.id) el.id = 'html-editor-' + Math.random().toString(36).slice(2, 9);
    tinymce.init({
      target: el,
      menubar: false,
      plugins: 'link lists',
      toolbar: 'bold italic underline | bullist numlist | link | removeformat',
      branding: false,
      promotion: false,
      height: 300,
      setup: function(editor) {
        editor.on('init', function() {
          el.dataset.originalValue = editor.getContent().trim();
        });
      }
    });
  });
  tinymceInitialized = true;
}

function getContent(el) {
  if (el.dataset.editType === 'html') {
    if (typeof tinymce !== 'undefined') {
      const editor = tinymce.get(el.id);
      if (editor) return editor.getContent().trim();
    }
    return el.innerHTML.trim();
  }
  return el.innerText.trim();
}

function setContent(el, val) {
  if (el.dataset.editType === 'html') {
    if (typeof tinymce !== 'undefined') {
      const editor = tinymce.get(el.id);
      if (editor) { editor.setContent(val); return; }
    }
    el.innerHTML = val;
  } else {
    el.textContent = val;
  }
}

function makeEditable(el) {
  if (el.dataset.editType === 'html') return; // handled by TinyMCE
  el.dataset.originalValue = getContent(el);
  el.contentEditable = true;
  el.classList.add('ring-2', 'ring-[#2f6f42]', 'ring-offset-2', 'rounded', 'px-1');
}

function finishEditMode() {
  document.querySelectorAll('[data-edit]').forEach(el => {
    if (el.dataset.editType === 'html') return; // handled by TinyMCE
    el.contentEditable = false;
    el.classList.remove('ring-2', 'ring-[#2f6f42]', 'ring-offset-2', 'rounded', 'px-1');
  });
}

function saveAllDirty() {
  const changes = [];
  document.querySelectorAll('[data-edit]').forEach(el => {
    const newVal = getContent(el);
    const origVal = el.dataset.originalValue || '';
    // When sections were added/removed, include all section fields to sync DB indices
    if (window._sectionsModified && el.dataset.edit && el.dataset.edit.match(/^sections\[\d+\]\./)) {
      changes.push({
        field: el.dataset.edit,
        value: newVal,
        tipe: el.dataset.editTipe || ''
      });
      if (el.dataset.editType === 'number') {
        el.dataset.target = newVal;
      }
      return;
    }
    if (newVal !== origVal) {
      changes.push({
        field: el.dataset.edit,
        value: newVal,
        tipe: el.dataset.editTipe || ''
      });
      // Update data-target for number fields after save
      if (el.dataset.editType === 'number') {
        el.dataset.target = newVal;
      }
    }
  });
  // When sections added/removed, send section count so server can truncate
  if (window._sectionsModified) {
    var container = document.getElementById('sections-container');
    if (container) {
      var sectionCount = container.querySelectorAll('[data-section-index]').length;
      var tipeEl = document.querySelector('#sections-container [data-edit-tipe]');
      changes.push({
        field: '_sections_count',
        value: String(sectionCount),
        tipe: tipeEl ? tipeEl.getAttribute('data-edit-tipe') : ''
      });
    }
  }

  if (changes.length === 0) return;

  document.getElementById('editModeLabel').textContent = 'Menyimpan...';

  fetch(window.location.origin + '/admin/inline-batch-save', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    },
    body: JSON.stringify({ changes: changes })
  })
  .then(res => {
    if (res.status === 419) throw new Error('Sesi habis, silakan login ulang');
    if (res.status === 302) throw new Error('Sesi tidak terautentikasi');
    if (!res.ok) throw new Error('HTTP ' + res.status);
    return res.json();
  })
  .then(data => {
    if (data.success) {
      window._sectionsModified = false;
      window.location.reload();
    } else {
      showToast('Gagal menyimpan: ' + (data.message || 'unknown error'), 'error');
      document.getElementById('editModeLabel').textContent = 'Mode Edit';
    }
  })
  .catch(err => {
    showToast('Error: ' + err.message, 'error');
    document.getElementById('editModeLabel').textContent = 'Mode Edit';
  });
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && editMode) {
    toggleEditMode();
  }
});

// Image editing overlay
(function() {
  var uploadModal = null;
  var currentImg = null;
  var currentField = null;

  function createUploadModal() {
    var modal = document.createElement('div');
    modal.id = 'image-upload-modal';
    modal.style.cssText = 'position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,0.6);display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px);';
    modal.innerHTML = '<div style="background:#fff;border-radius:16px;padding:32px;max-width:480px;width:90%;box-shadow:0 24px 48px rgba(0,0,0,0.3);text-align:center;">' +
      '<h3 style="font-size:18px;font-weight:800;margin-bottom:4px;color:#151813;">Upload Gambar</h3>' +
      '<p style="font-size:12px;color:#6b7280;margin-bottom:20px;">Klik atau drag & drop file gambar di sini</p>' +
      '<div id="upload-dropzone" style="border:2px dashed #d1d5db;border-radius:12px;padding:40px 20px;cursor:pointer;transition:all 0.2s;background:#f9fafb;">' +
        '<i class="bi bi-cloud-upload" style="font-size:40px;color:#2f6f42;display:block;margin-bottom:12px;"></i>' +
        '<p style="font-size:13px;color:#6b7280;font-weight:500;">Tarik file ke sini atau klik untuk memilih</p>' +
        '<p style="font-size:11px;color:#9ca3af;margin-top:6px;">PNG, JPG, WebP — Maks 5MB</p>' +
        '<input type="file" id="upload-input" accept="image/*" style="display:none;">' +
      '</div>' +
      '<div id="upload-preview" style="display:none;margin-top:16px;position:relative;">' +
        '<img id="upload-preview-img" style="max-height:200px;border-radius:8px;margin:0 auto;display:block;">' +
        '<div id="upload-progress" style="display:none;margin-top:12px;height:4px;background:#e5e7eb;border-radius:4px;overflow:hidden;"><div style="height:100%;width:0%;background:#2f6f42;transition:width 0.3s;"></div></div>' +
      '</div>' +
      '<div style="display:flex;gap:10px;margin-top:20px;justify-content:center;">' +
        '<button id="upload-cancel-btn" style="padding:10px 24px;border:1px solid #d1d5db;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;background:#fff;color:#374151;">Batal</button>' +
        '<button id="upload-save-btn" style="padding:10px 24px;border:none;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;background:#2f6f42;color:#fff;display:none;">Simpan</button>' +
      '</div>' +
    '</div>';
    document.body.appendChild(modal);

    var dropzone = modal.querySelector('#upload-dropzone');
    var input = modal.querySelector('#upload-input');
    var preview = modal.querySelector('#upload-preview');
    var previewImg = modal.querySelector('#upload-preview-img');
    var progress = modal.querySelector('#upload-progress');
    var progressBar = progress.querySelector('div');
    var saveBtn = modal.querySelector('#upload-save-btn');
    var cancelBtn = modal.querySelector('#upload-cancel-btn');

    dropzone.addEventListener('click', function() { input.click(); });
    dropzone.addEventListener('dragover', function(e) { e.preventDefault(); dropzone.style.borderColor = '#2f6f42'; dropzone.style.background = '#f0fdf4'; });
    dropzone.addEventListener('dragleave', function() { dropzone.style.borderColor = '#d1d5db'; dropzone.style.background = '#f9fafb'; });
    dropzone.addEventListener('drop', function(e) { e.preventDefault(); dropzone.style.borderColor = '#d1d5db'; dropzone.style.background = '#f9fafb'; if (e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]); });
    input.addEventListener('change', function() { if (this.files.length) handleFile(this.files[0]); });

    function handleFile(file) {
      if (!file.type.startsWith('image/')) { showToast('Hanya file gambar yang diizinkan', 'error'); return; }
      if (file.size > 5 * 1024 * 1024) { showToast('Maksimal 5MB', 'error'); return; }
      var reader = new FileReader();
      reader.onload = function(e) {
        previewImg.src = e.target.result;
        preview.style.display = 'block';
        saveBtn.style.display = 'inline-block';
        saveBtn._file = file;
      };
      reader.readAsDataURL(file);
    }

    saveBtn.addEventListener('click', function() {
      var file = saveBtn._file;
      if (!file) return;
      var fd = new FormData();
      fd.append('image', file);
      fd.append('field', currentField || '');
      fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);
      progress.style.display = 'block';
      saveBtn.disabled = true;
      saveBtn.textContent = 'Mengupload...';
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '/admin/upload-image');
      xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) progressBar.style.width = (e.loaded / e.total * 100) + '%';
      };
      xhr.onload = function() {
        saveBtn.disabled = false;
        saveBtn.textContent = 'Simpan';
        progress.style.display = 'none';
        progressBar.style.width = '0%';
        if (xhr.status === 200) {
          var res = JSON.parse(xhr.responseText);
          if (res.url && currentImg) {
            currentImg.src = res.url;
            showToast('Gambar berhasil diupload', 'success');
            closeModal();
          } else {
            showToast(res.error || 'Gagal upload', 'error');
          }
        } else {
          showToast('Gagal upload gambar', 'error');
        }
      };
      xhr.onerror = function() { showToast('Gagal upload gambar', 'error'); saveBtn.disabled = false; saveBtn.textContent = 'Simpan'; };
      xhr.send(fd);
    });

    cancelBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });

    function closeModal() { modal.style.display = 'none'; currentImg = null; currentField = null; preview.style.display = 'none'; saveBtn.style.display = 'none'; saveBtn._file = null; dropzone.style.borderColor = '#d1d5db'; dropzone.style.background = '#f9fafb'; }

    return modal;
  }

  document.addEventListener('DOMContentLoaded', function() {
    uploadModal = createUploadModal();
    document.querySelectorAll('[data-image-edit]').forEach(function(img) {
      if (img.parentElement.classList.contains('img-wrapper')) return;
      var wrapper = document.createElement('div');
      wrapper.className = 'img-wrapper';
      wrapper.style.cssText = 'position:relative;display:inline-block;';
      img.parentNode.insertBefore(wrapper, img);
      wrapper.appendChild(img);

      var overlay = document.createElement('div');
      overlay.className = 'img-edit-overlay';
      var btn = document.createElement('button');
      btn.innerHTML = '<i class="bi bi-pencil-square"></i>';
      btn.title = 'Edit gambar';
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var url = img.dataset.editUrl || '';
        if (url) {
          window.open(url, '_blank');
        } else {
          currentImg = img;
          currentField = img.dataset.editField || '';
          uploadModal.style.display = 'flex';
        }
      });
      overlay.appendChild(btn);
      wrapper.appendChild(overlay);
    });
  });

  // Section management (privasi / bantuan)
  window._sectionsModified = false;

  window.addSection = function(tipe) {
    var container = document.getElementById('sections-container');
    if (!container) return;
    var existing = container.querySelectorAll('[data-section-index]');
    var index = existing.length;
    var newId = 'section-' + Date.now();
    var html = '<section id="' + newId + '" class="scroll-mt-28 border-2 border-dashed border-holiday/40 rounded-2xl p-6 relative group/section" data-section-index="' + index + '">';
    html += '<div class="flex items-center justify-between gap-2 mb-3">';
    html += '<h2 class="text-xl font-bold text-slate-900 flex items-center gap-2 flex-1 relative group w-full" style="outline:none;"><span class="w-1.5 h-6 bg-holiday rounded-full"></span> <span class="section-num">' + (index + 1) + '.</span> <span class="flex-1" contenteditable="true" data-edit="sections[' + index + '].judul" data-edit-type="text" data-edit-tipe="' + tipe + '">Pasal Baru</span></h2>';
    html += '<button onclick="removeSection(this)" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 rounded-lg px-2 py-1 text-xs font-bold transition"><i class="bi bi-trash"></i></button>';
    html += '</div>';
    html += '<div contenteditable="true" data-edit="sections[' + index + '].konten" data-edit-type="html" data-edit-tipe="' + tipe + '" class="text-slate-600 text-sm leading-relaxed">';
    html += '<p>Ketik konten pasal di sini...</p>';
    html += '</div>';
    html += '</section>';
    container.insertAdjacentHTML('beforeend', html);
    // Add TOC link
    var tocNav = document.getElementById('toc-nav');
    if (tocNav) {
      var link = document.createElement('a');
      link.href = '#' + newId;
      link.className = 'toc-link block px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-slate-600 hover:bg-slate-50 hover:text-slate-900';
      link.textContent = (index + 1) + '. Pasal Baru';
      tocNav.appendChild(link);
    }
    window._sectionsModified = true;
    showToast('Pasal baru ditambahkan. Isi lalu simpan.', 'success');
  };

  window.removeSection = function(btn) {
    if (!confirm('Hapus pasal ini?')) return;
    var section = btn.closest('[data-section-index]');
    if (section) {
      section.remove();
      renumberSections();
      window._sectionsModified = true;
      showToast('Pasal dihapus. Jangan lupa simpan.', 'success');
    }
  };

  function renumberSections() {
    var container = document.getElementById('sections-container');
    if (!container) return;
    container.querySelectorAll('[data-section-index]').forEach(function(sec, i) {
      sec.dataset.sectionIndex = i;
      sec.id = 'pasal-' + (i + 1);
      var num = sec.querySelector('.section-num');
      if (num) num.textContent = (i + 1) + '.';
      sec.querySelectorAll('[data-edit]').forEach(function(el) {
        var oldEdit = el.dataset.edit;
        var newEdit = oldEdit.replace(/sections\[\d+\]/, 'sections[' + i + ']');
        el.dataset.edit = newEdit;
        el.dataset.originalValue = '';
      });
    });
    // Update TOC nav
    var tocNav = document.getElementById('toc-nav');
    if (tocNav) {
      var links = tocNav.querySelectorAll('a');
      var sections = container.querySelectorAll('[data-section-index]');
      links.forEach(function(link, i) {
        if (sections[i]) {
          link.href = '#' + sections[i].id;
          link.textContent = (i + 1) + '. ' + (link.textContent.replace(/^\d+\.\s*/, '') || 'Pasal Baru');
        }
      });
    }
  }
})();
</script>
@endauth

<div id="google_translate_element" style="display: none;"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'id', includedLanguages: 'en,id', autoDisplay: false}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
function switchLanguage(lang) {
    if (lang === 'id') {
        document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + window.location.hostname + "; path=/;";
        document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=." + window.location.hostname + "; path=/;";
    } else {
        document.cookie = "googtrans=/id/en; path=/";
        document.cookie = "googtrans=/id/en; domain=" + window.location.hostname + "; path=/";
        document.cookie = "googtrans=/id/en; domain=." + window.location.hostname + "; path=/";
    }
    localStorage.setItem('preferred_language', lang);
    window.location.reload();
}

document.addEventListener('DOMContentLoaded', function() {
    var lang = localStorage.getItem('preferred_language') || 'id';
    var match = document.cookie.match(new RegExp('(^| )googtrans=([^;]+)'));
    if (match) {
        if (match[2] === '/id/en') lang = 'en';
        else lang = 'id';
    }
    updateLangUI(lang);
});

function updateLangUI(lang) {
    if (lang === 'en') {
        document.querySelectorAll('.lang-selector-en').forEach(el => el.classList.add('ring-2', 'ring-holiday'));
        document.querySelectorAll('.lang-selector-id').forEach(el => el.classList.remove('ring-2', 'ring-holiday'));
        document.querySelectorAll('.lang-selector-en-mob').forEach(el => { el.classList.add('!bg-base'); el.classList.remove('!bg-transparent'); });
        document.querySelectorAll('.lang-selector-id-mob').forEach(el => { el.classList.remove('!bg-base'); el.classList.add('!bg-transparent'); });
    } else {
        document.querySelectorAll('.lang-selector-id').forEach(el => el.classList.add('ring-2', 'ring-holiday'));
        document.querySelectorAll('.lang-selector-en').forEach(el => el.classList.remove('ring-2', 'ring-holiday'));
        document.querySelectorAll('.lang-selector-id-mob').forEach(el => { el.classList.add('!bg-base'); el.classList.remove('!bg-transparent'); });
        document.querySelectorAll('.lang-selector-en-mob').forEach(el => { el.classList.remove('!bg-base'); el.classList.add('!bg-transparent'); });
    }
}
</script>

</body>
</html>