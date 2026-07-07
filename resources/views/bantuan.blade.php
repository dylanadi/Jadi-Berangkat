@extends('layouts.app')

@section('title', 'Bantuan - Jadi Berangkat')

@section('content')
{{-- Hero FAQ --}}
<section class="relative pt-32 pb-20 bg-gradient-to-br from-emerald-900 via-slate-900 to-slate-950 overflow-hidden">
    @auth
    <a href="{{ route('admin.halaman.index') }}" target="_blank" class="absolute top-4 right-4 text-sm bg-[#2f6f42] text-white rounded-full p-2 shadow-lg hover:bg-[#255a35] transition z-50" title="Edit halaman ini">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endauth
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-emerald-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-300 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-md mb-4">
            <i class="bi bi-question-circle-fill text-xs"></i>Pusat Bantuan
        </div>
        <h1 data-edit="judul" data-edit-type="text" data-edit-tipe="bantuan" class="text-3xl md:text-5xl font-black text-white tracking-tight leading-none mb-4">
            {{ $halaman->judul ?? 'Ada yang bisa kami bantu?' }}
        </h1>
        <div class="text-emerald-100/70 text-sm md:text-base max-w-2xl mx-auto font-medium relative group">
@auth
<a href="{{ $halaman ? route('admin.halaman.edit', $halaman->id) : '#' }}" class="opacity-0 group-hover:opacity-100 absolute -top-2 -right-2 text-xs bg-[#2f6f42] text-white rounded-full p-1.5 shadow-lg hover:bg-[#255a35] transition-all z-50" title="Edit konten"><i class="bi bi-pencil-square"></i></a>
@endauth
            {!! $halaman->konten ?? 'Temukan jawaban untuk pertanyaan yang paling sering diajukan. Jika masih bingung, jangan ragu hubungi kami langsung.' !!}
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="py-20">
    <div class="max-w-3xl mx-auto px-6">
        {{-- Pemesanan & Pembayaran --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h2 data-edit="bantuan_pemesanan_judul" data-edit-route="{{ route('admin.inline.update') }}" class="text-xl font-extrabold text-slate-900">Pemesanan & Pembayaran</h2>
            </div>
            <div class="space-y-3">
                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Bagaimana cara memesan paket trip?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Kamu bisa langsung klik tombol "Pesan Sekarang" di halaman destinasi atau paket trip yang kamu minati. Ikuti langkah-langkah pemesanan, pilih tanggal, isi data diri, dan lakukan pembayaran. Konfirmasi akan dikirim via WhatsApp dalam 1x24 jam.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Metode pembayaran apa saja yang tersedia?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Saat ini kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BRI), dan dompet digital (GoPay, OVO, Dana). Pembayaran penuh atau DP 50% bisa kamu pilih sesuai kenyamanan.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Apakah bisa booking secara mendadak (H-1)?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Bisa! Selama armada masih tersedia, kamu bisa booking H-1. Kami sarankan hubungi langsung via WhatsApp untuk reservasi mendadak agar lebih cepat diproses.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Apakah uang muka (DP) bisa dikembalikan?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            DP bersifat non-refundable jika pembatalan dilakukan kurang dari 3 hari sebelum keberangkatan. Namun untuk situasi darurat (bencana alam, sakit), kami bisa mendiskusikan solusi terbaik. Hubungi tim CS kami ya.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trip & Armada --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg">
                    <i class="bi bi-truck"></i>
                </div>
                <h2 data-edit="bantuan_trip_judul" data-edit-route="{{ route('admin.inline.update') }}" class="text-xl font-extrabold text-slate-900">Trip & Armada</h2>
            </div>
            <div class="space-y-3">
                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Destinasi apa saja yang bisa dikunjungi?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Kami melayani trip ke berbagai destinasi di Banyuwangi dan sekitarnya: Kawah Ijen, Baluran Savannah, Pulau Merah, Teluk Hijau, Pantai Pelengkung, dan masih banyak lagi. Cek halaman <a href="{{ url('/destinasi') }}" class="text-emerald-600 font-bold hover:underline">Destinasi Populer</a> untuk daftar lengkapnya.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Apakah Jeep yang digunakan nyaman dan aman?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Tentu! Armada Jeep 4x4 kami terawat, dibersihkan setiap hari, dan diperiksa rutin. Setiap Jeep dilengkapi seat belt, canvas atap terbuka untuk spot foto, dan sopir berpengalaman yang hafal medan.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Apakah ada paket trip khusus rombongan?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Ada! Kami menyediakan paket grup untuk 4-20 orang dengan harga spesial. Cocok untuk gathering, family trip, atau study tour. Kamu bisa hubungi kami langsung untuk request custom itinerary.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lainnya --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg">
                    <i class="bi bi-info-circle"></i>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900">Lainnya</h2>
            </div>
            <div class="space-y-3">
                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Bagaimana cara menghubungi customer service?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Kamu bisa hubungi kami via WhatsApp di <a href="https://wa.me/6285196161351" class="text-emerald-600 font-bold hover:underline">+62 851-9616-1351</a>, email ke halo@jadiberangkat.com, atau DM Instagram <a href="https://www.instagram.com/jadiberangkat/" class="text-emerald-600 font-bold hover:underline">@jadiberangkat</a>. Kami siap bantu Senin-Minggu, jam 07.00-21.00 WIB.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Apakah ada jemput dari hotel/stasiun?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Ya, kami menyediakan layanan jemput dari hotel, villa, stasiun kereta, atau bandara di area Banyuwangi. Pastikan kamu cantumkan lokasi jemput saat booking.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <button class="faq-question w-full flex items-center justify-between p-5 text-left font-bold text-sm text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>Bagaimana jika cuaca buruk saat trip?</span>
                        <i class="bi bi-chevron-down text-emerald-600 text-base transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="px-5 pb-5 text-sm text-slate-600 leading-relaxed">
                            Keselamatan adalah prioritas utama. Jika cuaca buruk, kami akan menunda atau mengalihkan rute ke destinasi alternatif. Kamu bisa reschedule tanpa biaya tambahan atau refund penuh sesuai kebijakan.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Masih bingung? --}}
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100/60 rounded-2xl p-8 text-center border border-emerald-200">
            <i class="bi bi-chat-dots text-4xl text-emerald-600 mb-3 block"></i>
            <h3 class="text-lg font-extrabold text-slate-900 mb-2">Masih punya pertanyaan?</h3>
            <p class="text-sm text-slate-600 mb-5 font-medium">Tim kami siap membantu kamu dengan senang hati.</p>
            <a href="https://wa.me/6285196161351" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition-colors shadow-md">
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
