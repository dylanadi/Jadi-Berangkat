@extends('layouts.app')

@section('title', $artikel->judul . ' - Jadiberangkat')

@push('styles')
<style>
    .article-content p { margin-bottom: 1.5rem; line-height: 1.8; color: #334155; font-size: 1rem; }
    .article-content h2 { font-size: 1.5rem; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; color: #0f172a; }
    .article-content h3 { font-size: 1.25rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #0f172a; }
    .article-content ul { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #334155; }
    .article-content li { margin-bottom: 0.5rem; line-height: 1.7; }
    .article-content blockquote { border-left: 4px solid #2e7d32; padding-left: 1.25rem; margin: 1.5rem 0; color: #475569; font-style: italic; background: #f8fafc; padding: 1rem 1.5rem; border-radius: 0 0.75rem 0.75rem 0; }
    .article-content img { border-radius: 16px; margin: 24px 0; width: 100%; }
</style>

<script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        holiday: '#2e7d32', 
                        'holiday-dark': '#1b5e20',
                        'holiday-400': '#4caf50',
                        'holiday-500': '#388e3c',
                        'holiday-600': '#2e7d32',
                    }
                }
            }
        }
    }
</script>
@endpush

@section('content')

{{-- Article Hero Section --}}
<div id="article-hero" class="relative w-full h-[70vh] md:h-[80vh] overflow-hidden bg-slate-900">
    @auth
    <div class="absolute top-6 right-6 z-30">
        <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-holiday-600 text-white text-xs font-bold rounded-full hover:bg-holiday-700 transition shadow-md">
            <i class="bi bi-pencil-square"></i> Edit Artikel
        </a>
    </div>
    @endauth
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/50 to-transparent z-10"></div>
    <img id="article-image" src="{{ $artikel->image ? $artikel->image->url : asset('img/bluefire (1).webp') }}" class="w-full h-full object-cover" alt="{{ $artikel->judul }}">
    <div class="absolute inset-0 z-20 flex flex-col justify-end pb-16 md:pb-24 px-6 md:px-16 max-w-5xl mx-auto w-full">
        @if($artikel->kategori)
        <span id="article-badge" class="inline-block w-fit bg-holiday-500 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-md mb-4">{{ strtoupper($artikel->kategori->nama_kategori) }}</span>
        @endif
        <h1 id="article-title" class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">{{ $artikel->judul }}</h1>
        <div class="flex items-center gap-4 text-sm text-slate-300">
            @if($artikel->penulis)<span class="flex items-center gap-1"><i class="bi bi-person"></i> {{ $artikel->penulis }}</span>@endif
            @if($artikel->tanggal_terbit)
            <span id="article-date" class="flex items-center gap-1"><i class="bi bi-calendar3 text-holiday-400"></i> {{ $artikel->tanggal_terbit->format('d F Y') }}</span>
            @endif
            @if($artikel->durasi_baca)
            <span id="article-readtime" class="flex items-center gap-1"><i class="bi bi-clock text-holiday-400"></i> {{ $artikel->durasi_baca }} min</span>
            @endif
        </div>
    </div>
</div>

{{-- Article Content --}}
<section class="max-w-4xl mx-auto px-6 md:px-12 py-12 md:py-16">
    <div class="flex gap-4 mb-8">
        <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-holiday hover:text-holiday-dark transition">
            <i class="bi bi-arrow-left"></i> Kembali ke Artikel
        </a>
        <div class="ml-auto flex gap-2">
            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-8 h-8 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:-translate-y-1 transition"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="w-8 h-8 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:-translate-y-1 transition"><i class="bi bi-twitter-x"></i></a>
            <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' ' . request()->url()) }}" target="_blank" class="w-8 h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:-translate-y-1 transition"><i class="bi bi-whatsapp"></i></a>
        </div>
    </div>
    
    <div id="article-content" class="article-content">
        {!! $artikel->konten !!}
    </div>
</section>

@if(isset($lainnya) && $lainnya->count())
<section class="bg-slate-50 py-16 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-2">
            <i class="bi bi-bookmark text-holiday-600"></i> Artikel Terkait
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($lainnya as $item)
            <a href="{{ route('artikel.show', $item->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 flex flex-col group hover:shadow-md transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $item->image ? $item->image->url : asset('img/bluefire (1).webp') }}" alt="{!! $item->judul !!}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                    @if($item->kategori)
                    <span class="absolute bottom-3 left-3 bg-slate-950/80 text-white text-[10px] font-black uppercase px-2 py-1 rounded-md">{{ $item->kategori->nama_kategori ?? '' }}</span>
                    @endif
                </div>
                <div class="p-4 flex flex-col flex-1">
                    <h4 class="font-bold text-slate-900 text-sm md:text-base leading-snug group-hover:text-holiday-600 transition-colors line-clamp-2">{!! $item->judul !!}</h4>
                    <div class="flex items-center justify-between gap-3 text-xs text-slate-400 mt-auto pt-4 border-t border-slate-50">
                        @if($item->tanggal_terbit)<span><i class="bi bi-calendar3"></i> {{ $item->tanggal_terbit->format('d M Y') }}</span>@endif
                        @if($item->durasi_baca)<span><i class="bi bi-clock"></i> {{ $item->durasi_baca }} mnt</span>@endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.from('#article-hero .z-20', { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' });
    gsap.from('#article-content', {
        scrollTrigger: { trigger: '#article-content', start: 'top 95%' },
        opacity: 0, y: 20, duration: 0.5
    });
</script>
@endpush