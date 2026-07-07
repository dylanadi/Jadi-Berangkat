@extends('layouts.app')

@section('title', ($data->judul ?? 'Kebijakan Privasi') . ' - PT Jadi Berangkat')

@section('content')
{{-- Sub-Header Bar --}}
<div class="bg-slate-900 border-b border-slate-800 py-3 px-4 md:px-12 flex items-center justify-between text-white gap-2">
    <a href="{{ url('/') }}" class="flex items-center gap-1.5 text-xs md:text-sm font-bold text-slate-300 hover:text-white transition shrink-0">
        <i class="bi bi-arrow-left text-base"></i> Kembali
    </a>
    <div class="flex items-center gap-2 md:gap-3 min-w-0">
        <div class="w-7 h-7 md:w-10 md:h-10 rounded-full bg-holiday/20 flex items-center justify-center border border-holiday text-holiday-light shrink-0">
            <i class="bi bi-shield-check text-sm md:text-xl"></i>
        </div>
        <div class="truncate">
            <h2 class="font-extrabold text-[11px] md:text-base leading-tight truncate">{!! $data->judul ?? 'Kebijakan Privasi' !!}</h2>
            <p data-edit="subtitle" data-edit-type="text" data-edit-tipe="privasi" class="text-[9px] md:text-[11px] text-slate-400 font-bold uppercase tracking-wider truncate">{!! $data->subtitle ?? 'PT. Jadi Berangkat' !!}</p>
        </div>
    </div>
    <div class="text-right shrink-0">
        <p class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase tracking-widest">Terakhir diperbarui</p>
        <p data-edit="tanggal" data-edit-type="text" data-edit-tipe="privasi" class="text-[10px] md:text-xs font-extrabold text-holiday-light">{!! $data->tanggal ?? '30 Juni 2026' !!}</p>
    </div>
</div>

{{-- Hero Banner --}}
<div class="bg-gradient-to-b from-slate-950 to-slate-900 text-white py-16 px-6 md:px-12 text-center border-b border-slate-800 relative">
    @auth
    <a href="{{ route('admin.halaman.index') }}" target="_blank" class="absolute top-4 right-4 text-sm bg-[#2f6f42] text-white rounded-full p-2 shadow-lg hover:bg-[#255a35] transition z-50" title="Edit halaman ini">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endauth
    <div class="max-w-4xl mx-auto space-y-6 flex flex-col items-center">
        <span data-edit="badge" data-edit-type="text" data-edit-tipe="privasi" class="inline-flex items-center gap-1.5 border border-holiday text-holiday-light px-3.5 py-1.5 rounded-full text-xs font-black tracking-wider uppercase bg-holiday/10">
            <i class="bi bi-file-earmark-lock-fill"></i> {!! $data->badge ?? 'Dokumen Resmi & Legal' !!}
        </span>
        <h1 data-edit="judul" data-edit-type="text" data-edit-tipe="privasi" class="text-3xl md:text-5xl font-black tracking-tight leading-tight max-w-3xl">{!! $data->judul ?? 'Kebijakan Privasi & Penggunaan Situs Web' !!}
        </h1>
        <div data-edit="konten" data-edit-type="html" data-edit-tipe="privasi" class="text-slate-300 text-sm md:text-base max-w-2xl font-medium leading-relaxed">
            {!! $data->konten ?? 'Dokumen ini mengatur hak, kewajiban, dan perlindungan data Pengguna dalam menggunakan layanan digital PT. Jadi Berangkat.' !!}
        </div>
        <div class="flex flex-wrap items-center justify-center gap-6 pt-4 text-xs font-bold text-slate-400">
            <span data-edit="pasal_label" data-edit-type="text" data-edit-tipe="privasi" class="flex items-center gap-2"><i class="bi bi-file-earmark-text text-holiday-light text-base"></i> {{ count($sections) }} Pasal</span>
            <span data-edit="hukum_label" data-edit-type="text" data-edit-tipe="privasi" class="flex items-center gap-2"><i class="bi bi-bank text-holiday-light text-base"></i> {!! $data->hukum_label ?? 'Hukum Indonesia' !!}</span>
            <span data-edit="pdp_label" data-edit-type="text" data-edit-tipe="privasi" class="flex items-center gap-2"><i class="bi bi-shield-check text-holiday-light text-base"></i> {!! $data->pdp_label ?? 'UU PDP 2022' !!}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 md:px-12 pt-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        {{-- TOC Overlay Mobile --}}
        <div id="toc-overlay" class="fixed inset-0 bg-black/60 z-[75] hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

        {{-- Sidebar Daftar Isi --}}
        <aside id="toc-sidebar" class="fixed lg:static top-0 left-0 h-full w-[85%] max-w-sm lg:w-auto lg:h-auto bg-white p-6 lg:rounded-3xl border-r lg:border border-slate-200/60 shadow-2xl lg:shadow-sm z-[80] lg:z-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:col-span-4 lg:sticky lg:top-28 lg:max-h-[80vh] overflow-y-auto no-scrollbar">
            <div class="flex justify-between items-center mb-6 lg:block px-3 lg:px-0">
                <h2 class="text-slate-400 font-extrabold text-[11px] uppercase tracking-widest lg:px-3">Daftar Isi</h2>
                <button id="close-toc-btn" class="lg:hidden w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <nav class="space-y-1" id="toc-nav">
                @foreach($sections as $index => $section)
                <a href="#pasal-{{ $index + 1 }}" class="toc-link block px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-slate-600 hover:bg-slate-50 hover:text-slate-900">{{ $index + 1 }}. {{ $section['judul'] }}</a>
                @endforeach
            </nav>
        </aside>

        {{-- Konten Detail --}}
        <div id="sections-container" class="lg:col-span-8 bg-white p-8 md:p-10 rounded-3xl border border-slate-200/60 shadow-sm space-y-12">
            @foreach($sections as $index => $section)
            <section id="pasal-{{ $index + 1 }}" data-section-index="{{ $index }}" class="scroll-mt-28">
                <h2 data-edit="sections[{{ $index }}].judul" data-edit-type="text" data-edit-tipe="privasi" class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-holiday rounded-full"></span> <span class="section-num">{{ $index + 1 }}.</span> {{ $section['judul'] }}
                </h2>
                <div data-edit="sections[{{ $index }}].konten" data-edit-type="html" data-edit-tipe="privasi" class="text-slate-600 text-sm leading-relaxed">
                    {!! $section['konten'] !!}
                </div>
            </section>
            @endforeach

            @auth
            <div class="text-center pt-4" id="add-section-btn-wrap">
                <button onclick="addSection('privasi')" class="inline-flex items-center gap-2 text-sm bg-[#2f6f42] text-white rounded-xl px-5 py-3 font-bold hover:bg-[#255a35] transition shadow-lg">
                    <i class="bi bi-plus-lg"></i> Tambah Pasal
                </button>
            </div>
            @endauth
        </div>
    </div>

    {{-- Pernyataan Persetujuan --}}
    <div class="mt-12 mb-16 bg-slate-900 border border-slate-800 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden shadow-lg flex flex-col items-center">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-holiday/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute -left-20 -top-20 w-80 h-80 bg-holiday/5 rounded-full blur-3xl -z-10"></div>

        <div class="w-14 h-14 rounded-full bg-holiday/20 flex items-center justify-center border border-holiday text-holiday-light mb-6">
            <i class="bi bi-shield-check text-2xl"></i>
        </div>

        <h3 class="text-xl md:text-2xl font-black mb-4">Pernyataan Persetujuan</h3>
        <p class="text-slate-300 text-sm md:text-base leading-relaxed max-w-3xl font-medium">
            Dengan menggunakan situs web, aplikasi, portal pelanggan, maupun layanan digital yang disediakan oleh <strong class="text-white">PT. Jadi Berangkat</strong>, Pengguna menyatakan telah membaca, memahami, dan menyetujui seluruh isi Kebijakan Privasi dan Ketentuan Penggunaan ini.
        </p>
        <div class="mt-8 pt-6 border-t border-slate-800/80 w-full">
            <p class="text-[10px] md:text-[11px] font-black uppercase tracking-[0.2em] text-holiday-light/80">
                &copy; {{ date('Y') }} PT. JADI BERANGKAT. ALL RIGHTS RESERVED.
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Mobile TOC
    const openTocBtn = document.getElementById('open-toc-btn');
    const closeTocBtn = document.getElementById('close-toc-btn');
    const tocSidebar = document.getElementById('toc-sidebar');
    const tocOverlay = document.getElementById('toc-overlay');

    function openToc() {
        tocOverlay.classList.remove('hidden');
        setTimeout(() => tocOverlay.classList.remove('opacity-0'), 10);
        tocSidebar.classList.remove('-translate-x-full');
    }

    function closeToc() {
        tocSidebar.classList.add('-translate-x-full');
        tocOverlay.classList.add('opacity-0');
        setTimeout(() => tocOverlay.classList.add('hidden'), 300);
    }

    if (openTocBtn) openTocBtn.addEventListener('click', openToc);
    if (closeTocBtn) closeTocBtn.addEventListener('click', closeToc);
    if (tocOverlay) tocOverlay.addEventListener('click', closeToc);
    document.querySelectorAll('.toc-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) closeToc();
        });
    });

    // Scroll-spy for sections within the content area
    const contentSections = document.querySelectorAll('#sections-container section');
    const allNavLinks = document.querySelectorAll('#toc-nav a');

    function updateActiveLink() {
        let currentId = '';
        const scrollPos = window.scrollY + 130;
        contentSections.forEach(section => {
            if (section.offsetTop <= scrollPos) {
                currentId = section.getAttribute('id');
            }
        });
        allNavLinks.forEach(link => {
            link.classList.remove('bg-[#e2f7ea]', 'text-holiday', 'shadow-sm');
            link.classList.add('text-slate-600', 'hover:bg-slate-50');
            if (link.getAttribute('href') === '#' + currentId) {
                link.classList.add('bg-[#e2f7ea]', 'text-holiday', 'shadow-sm');
            }
        });
    }

    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink();
</script>
@endpush
