@extends('layouts.app')

@section('title', 'Bantuan - Jadi Berangkat')

@section('content')
{{-- Hero FAQ --}}
<section class="relative pt-32 pb-20 bg-gradient-to-br from-emerald-900 via-slate-900 to-slate-950 overflow-hidden">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-emerald-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-300 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-md mb-4">
            <i class="bi bi-question-circle-fill text-xs"></i>Pusat Bantuan
        </div>
        <h1 data-edit="judul" data-edit-type="text" data-edit-tipe="bantuan" class="text-3xl md:text-5xl font-black text-white tracking-tight leading-none mb-4">{!! $halaman->judul ?? 'Ada yang bisa kami bantu?' !!}
        </h1>
        <div class="text-emerald-100/70 text-sm md:text-base max-w-2xl mx-auto font-medium relative group">

            {!! $halaman->konten ?? 'Temukan jawaban untuk pertanyaan yang paling sering diajukan. Jika masih bingung, jangan ragu hubungi kami langsung.' !!}
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="py-20">
    <div class="max-w-3xl mx-auto px-6">
        {{-- Daftar Bantuan --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg">
                    <i class="bi bi-question-circle"></i>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900">Pertanyaan Umum</h2>
            </div>
            
            <div class="space-y-3">
                @forelse($faqs as $faq)
                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>{{ $faq->judul }}</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed formatted-content">
                            {!! $faq->deskripsi !!}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-slate-500 text-sm">
                    Belum ada pertanyaan umum (FAQ).
                </div>
                @endforelse
            </div>
        </div>

        {{-- Masih bingung? --}}
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100/60 rounded-2xl p-8 text-center border border-emerald-200">
            <i class="bi bi-chat-dots text-4xl text-emerald-600 mb-3 block"></i>
            <h3 class="text-lg font-extrabold text-slate-900 mb-2">Masih punya pertanyaan?</h3>
            <p class="text-sm text-slate-600 mb-5 font-medium">Tim kami siap membantu kamu dengan senang hati.</p>
            <a href="{{ $waLink }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition-colors shadow-md">
                <i class="bi bi-whatsapp"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            const answer = item.querySelector('.faq-answer');
            const isOpen = answer.classList.contains('open');
            document.querySelectorAll('.faq-answer.open').forEach(el => {
                el.classList.remove('open');
                el.closest('.faq-item').querySelector('.faq-question').classList.remove('active');
            });
            if (!isOpen) {
                answer.classList.add('open');
                btn.classList.add('active');
            }
        });
    });
</script>
@endpush
