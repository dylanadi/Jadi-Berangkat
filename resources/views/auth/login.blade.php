<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Jadi Berangkat') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .login-slide {
            transition: opacity 1.5s ease-in-out, transform 8s ease-out;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <div class="min-h-screen flex">
        <!-- Left Side: Slideshow -->
        <div class="hidden md:flex md:w-1/2 lg:w-3/5 relative overflow-hidden bg-ink">
            @if(isset($galeri) && $galeri->count() > 0)
                @foreach($galeri as $index => $item)
                <div class="login-slide absolute inset-0 w-full h-full {{ $index === 0 ? 'opacity-100 z-10 scale-105' : 'opacity-0 z-0 scale-100 pointer-events-none' }}" data-slide="{{ $index }}">
                    <img src="{{ $item->image ? $item->image->url : asset('img/placeholder.webp') }}" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-12 left-12 right-12 z-20">
                        @if($item->kategori)
                        <span class="inline-block px-3 py-1 !bg-holiday/90 backdrop-blur-md text-white text-xs font-bold uppercase tracking-wider rounded-lg mb-3 shadow-lg">{{ $item->kategori->nama_kategori }}</span>
                        @endif
                        <h2 class="text-white text-3xl lg:text-4xl font-extrabold leading-tight drop-shadow-lg">{!! strip_tags($item->judul) !!}</h2>
                    </div>
                </div>
                @endforeach
            @else
                <img src="{{ asset('img/bluefire (1).webp') }}" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-12 left-12 z-20">
                    <h2 class="text-white text-4xl font-extrabold drop-shadow-lg">Jadi Berangkat</h2>
                </div>
            @endif
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 lg:w-2/5 flex flex-col justify-center items-center px-8 sm:px-12 lg:px-20 py-12 relative bg-white shadow-[-20px_0_40px_rgba(0,0,0,0.05)] z-20">
            <!-- Back to Home -->
            <a href="{{ route('home') }}" class="absolute top-8 right-8 text-gray-400 hover:!text-holiday transition flex items-center gap-2 text-sm font-medium bg-gray-50 px-4 py-2 rounded-full hover:!bg-holiday/10">
                <i class="bi bi-house-door"></i> Beranda
            </a>

            <div class="w-full max-w-sm">
                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang</h1>
                    <p class="text-gray-500 font-medium text-sm">Masuk untuk mengelola sistem website.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:!ring-holiday/20 focus:!border-holiday transition-all text-sm font-medium" placeholder="admin@jadiberangkat.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500 font-medium" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:!ring-holiday/20 focus:!border-holiday transition-all text-sm font-medium" placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500 font-medium" />
                    </div>

                    <button type="submit" style="background: black;" class="w-full py-4 text-white rounded-xl font-bold text-sm transition-all duration-300 transform hover:-translate-y-1 shadow-xl !shadow-holiday/30 mt-8">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.login-slide');
            if(slides.length <= 1) return;
            
            let currentSlide = 0;
            
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100', 'z-10', 'scale-105');
                slides[currentSlide].classList.add('opacity-0', 'z-0', 'scale-100', 'pointer-events-none');
                
                currentSlide = (currentSlide + 1) % slides.length;
                
                slides[currentSlide].classList.remove('opacity-0', 'z-0', 'scale-100', 'pointer-events-none');
                slides[currentSlide].classList.add('opacity-100', 'z-10', 'scale-105');
            }, 5000);
        });
    </script>
</body>
</html>
