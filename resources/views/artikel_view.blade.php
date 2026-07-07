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
@endpush

@section('content')

{{-- Article Hero Section --}}
<div id="article-hero" class="relative w-full h-[70vh] md:h-[80vh] overflow-hidden bg-slate-900 -mt-24">
    @auth
    <div class="absolute top-6 right-6 z-30">
        <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-holiday-600 text-white text-xs font-bold rounded-full hover:bg-holiday-700 transition shadow-md">
            <i class="bi bi-pencil-square"></i> Edit Artikel
        </a>
    </div>
    @endauth
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/50 to-transparent z-10"></div>
    <img id="article-image" src="{{ $artikel->image_url }}" class="w-full h-full object-cover" alt="{{ $artikel->judul }}">
    <div class="absolute inset-0 z-20 flex flex-col justify-end pb-16 md:pb-24 px-6 md:px-16 max-w-5xl mx-auto w-full">
        @if($artikel->kategori)
        <span id="article-badge" class="inline-block w-fit bg-holiday-500 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-md mb-4">{{ strtoupper($artikel->kategori) }}</span>
        @endif
        <h1 id="article-title" class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">{{ $artikel->judul }}</h1>
        <div class="flex items-center gap-4 text-sm text-slate-300">
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
    </div>
    <div id="article-content" class="article-content" data-edit="konten" data-edit-type="html" data-edit-route="{{ route('admin.artikel.edit', $artikel->id) }}">
        {!! $artikel->konten !!}
    </div>
    <div class="mt-12 pt-8 border-t border-slate-200">
        <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 bg-holiday text-white px-6 py-3 rounded-full font-bold hover:bg-holiday-dark transition shadow-lg shadow-holiday-glow">
            <i class="bi bi-arrow-left"></i> Kembali ke Berita Lainnya
        </a>
    </div>
</section>

@endsection