<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Jadi Berangkat')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                        holiday: '#2f6f42',
                        'holiday-dark': '#17442a',
                        'holiday-light': '#b8d9bd',
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        html, body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,0.1); }
        .sidebar-link.active { background: #2f6f42; color: white; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100 h-screen flex overflow-hidden">
    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-full w-64 bg-gray-900 text-white z-40 flex flex-col shadow-xl">
        <div class="p-5 border-b border-gray-800">
            <a href="{{ url('/admin') }}" class="text-xl font-extrabold flex items-center gap-2">
                @if(!empty($globalPengaturan['logo_full']))
                    <img src="{{ asset('storage/' . $globalPengaturan['logo_full']) }}" alt="{{ $globalPengaturan['logo_alt'] ?? 'Logo Admin' }}" class="h-8 w-auto">
                @else
                    <div class="w-8 h-8 bg-holiday rounded-lg flex items-center justify-center">
                        <i class="bi bi-jeep text-white text-sm"></i>
                    </div>
                    <span>Jadi Berangkat</span>
                @endif
            </a>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Panel Admin</p>
        </div>
        <nav class="flex-1 overflow-y-auto no-scrollbar p-3 space-y-1">
            <a href="{{ url('/admin') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 @if(request()->routeIs('admin.dashboard')) active @endif">
                <i class="bi bi-speedometer2 text-lg"></i> Dashboard
            </a>
            <a href="{{ url('/admin/destinasi') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-geo-alt text-lg"></i> Destinasi
            </a>
            <a href="{{ url('/admin/artikel') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-newspaper text-lg"></i> Artikel
            </a>
            <a href="{{ url('/admin/kategori') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-tags text-lg"></i> Kategori
            </a>
            <a href="{{ url('/admin/galeri') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-images text-lg"></i> Galeri
            </a>
            <a href="{{ url('/admin/ulasan') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-star text-lg"></i> Ulasan
            </a>
            <a href="{{ url('/admin/media-sosial') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-share text-lg"></i> Media Sosial
            </a>
            <a href="{{ url('/admin/faq') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-question-circle text-lg"></i> FAQ
            </a>
            <a href="{{ url('/admin/pengaturan') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-gear text-lg"></i> Pengaturan
            </a>
            <a href="{{ url('/admin/seo') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300">
                <i class="bi bi-search-heart text-lg"></i> SEO
            </a>
        </nav>
        <div class="p-3 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-400 w-full hover:text-red-400">
                    <i class="bi bi-box-arrow-right text-lg"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 flex-1 flex flex-col h-screen">
        {{-- Top Nav --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
            <div>
                <h1 class="text-lg font-extrabold text-gray-900">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-gray-500 font-medium">@yield('subtitle', 'Kelola data website')</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">{{ Auth::user()->email ?? 'admin@jadiberangkat.com' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-holiday text-white flex items-center justify-center font-extrabold text-sm">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 w-[96%] max-w-[1500px] mx-auto p-6 md:px-10 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    @include('admin.components.image-picker')

    @stack('scripts')
</body>
</html>
