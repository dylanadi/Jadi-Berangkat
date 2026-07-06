@extends('layouts.app')

@section('title', $artikel->judul . ' - Jadiberangkat')

@push('styles')
<style>
    .artikel-hero {
        position: relative; height: 55vh; min-height: 380px; overflow: hidden;
    }
    .artikel-hero img { width: 100%; height: 100%; object-fit: cover; }
    .artikel-hero .overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.15) 60%);
    }
    .artikel-hero .hero-bottom {
        position: absolute; bottom: 0; left: 0; right: 0; padding: 30px 24px 20px; color: #fff;
    }
    .artikel-hero .hero-bottom h1 {
        font-size: clamp(1.4rem, 3vw, 2.6rem); font-weight: 800; max-width: 800px;
    }
    .artikel-hero .hero-bottom .meta-row {
        display: flex; flex-wrap: wrap; gap: 16px; font-size: 14px; opacity: 0.85; margin-top: 8px;
    }

    .artikel-content {
        max-width: 800px; margin: 0 auto; font-size: 16px; line-height: 1.8; color: #444;
    }
    .artikel-content h2 { font-size: 24px; font-weight: 700; color: #1a1a2e; margin-top: 32px; margin-bottom: 12px; }
    .artikel-content h3 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-top: 24px; margin-bottom: 8px; }
    .artikel-content p { margin-bottom: 16px; }
    .artikel-content img { border-radius: 16px; margin: 24px 0; width: 100%; }
    .artikel-content blockquote {
        border-left: 4px solid #2f6f42; padding: 16px 20px; margin: 24px 0;
        background: rgba(47,111,66,0.05); border-radius: 0 12px 12px 0; font-style: italic; color: #555;
    }
    .artikel-content ul, .artikel-content ol { padding-left: 24px; margin-bottom: 16px; }
    .artikel-content li { margin-bottom: 6px; }

    .artikel-meta-card {
        background: #fff; border-radius: 16px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        display: flex; flex-wrap: wrap; gap: 20px; align-items: center;
    }
    .artikel-meta-card .author-avatar {
        width: 48px; height: 48px; border-radius: 50%; background: rgba(47,111,66,0.1);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: #2f6f42; font-weight: 700;
    }

    .related-card {
        border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.4s;
    }
    .related-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(47,111,66,0.1); }
    .related-card img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.5s; }
    .related-card:hover img { transform: scale(1.05); }
    .related-card .card-body { padding: 16px; }
    .related-card .card-body h4 { font-size: 16px; font-weight: 700; color: #1a1a2e; }

    .share-btn {
        width: 40px; height: 40px; border-radius: 50%; display: inline-flex;
        align-items: center; justify-content: center; font-size: 18px;
        transition: all 0.3s; color: #fff; text-decoration: none;
    }
    .share-btn:hover { transform: translateY(-2px); color: #fff; }
</style>
@endpush

@section('content')
<section class="artikel-hero">
    @auth
    <div class="absolute top-4 right-4 z-50">
        <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-xs font-bold rounded-full hover:bg-[#255a35] transition shadow-md">
            <i class="bi bi-pencil-square"></i> Edit Artikel
        </a>
    </div>
    @endauth
    <img src="{{ asset($artikel->gambar) }}" alt="{{ $artikel->judul }}">
    <div class="overlay"></div>
    <div class="hero-bottom max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('artikel.index') }}" class="back-btn mb-4"><i class="bi bi-arrow-left"></i> Semua Artikel</a>
        @if($artikel->kategori)
        <span class="inline-block px-3 py-1 text-xs font-bold uppercase bg-[#2f6f42] rounded-full mb-3">{{ $artikel->kategori }}</span>
        @endif
        <h1 data-edit="judul" data-edit-type="text" data-edit-route="{{ route('admin.artikel.edit', $artikel->id) }}">{{ $artikel->judul }}</h1>
        <div class="meta-row">
            @if($artikel->penulis)<span data-edit="penulis" data-edit-type="text" data-edit-route="{{ route('admin.artikel.edit', $artikel->id) }}"><i class="bi bi-person"></i> {{ $artikel->penulis }}</span>@endif
            @if($artikel->durasi_baca)<span><i class="bi bi-clock"></i> {{ $artikel->durasi_baca }} Min Read</span>@endif
            @if($artikel->tanggal_terbit)<span><i class="bi bi-calendar"></i> {{ $artikel->tanggal_terbit->format('d M Y') }}</span>@endif
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <a href="{{ route('artikel.index') }}">Artikel</a>
        <span class="sep">›</span>
        <span>{{ $artikel->judul }}</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <article class="artikel-content">
        <div class="artikel-meta-card mb-8">
            <div class="author-avatar">{{ strtoupper(substr($artikel->penulis ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="font-bold text-[#1a1a2e]">{{ $artikel->penulis ?? 'Admin' }}</div>
                <div class="text-sm text-gray-400">Penulis</div>
            </div>
            <div class="ml-auto flex gap-2">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" style="background:#1877F2"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" style="background:#1DA1F2"><i class="bi bi-twitter-x"></i></a>
                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' ' . request()->url()) }}" target="_blank" class="share-btn" style="background:#25D366"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>

        <div data-edit="konten" data-edit-type="html" data-edit-route="{{ route('admin.artikel.edit', $artikel->id) }}">
            {!! nl2br(e($artikel->konten)) !!}
        </div>
    </article>
</section>

@if(isset($lainnya) && $lainnya->count())
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-[#1a1a2e] mb-8 flex items-center gap-2">
            <i class="bi bi-bookmark text-[#2f6f42]"></i> Artikel Terkait
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($lainnya as $item)
            <a href="{{ route('artikel.show', $item->slug) }}" class="related-card">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">
                <div class="card-body">
                    @if($item->kategori)
                    <span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase bg-[#2f6f42]/10 text-[#2f6f42] rounded-full mb-2">{{ $item->kategori }}</span>
                    @endif
                    <h4>{{ $item->judul }}</h4>
                    <div class="flex items-center gap-3 text-xs text-gray-400 mt-2">
                        @if($item->durasi_baca)<span><i class="bi bi-clock"></i> {{ $item->durasi_baca }} Min Read</span>@endif
                        @if($item->tanggal_terbit)<span><i class="bi bi-calendar"></i> {{ $item->tanggal_terbit->format('d M Y') }}</span>@endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.from('.artikel-hero .hero-bottom', { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' });
    gsap.from('.artikel-content', {
        scrollTrigger: { trigger: '.artikel-content', start: 'top 95%' },
        opacity: 0, y: 20, duration: 0.5
    });
</script>
@endpush
@endsection