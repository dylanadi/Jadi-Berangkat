@extends('layouts.app')

@section('title', 'Tentang Kami - PT Jadi Berangkat')

@section('content')
<section class="relative min-h-screen pt-32 pb-20 flex items-center bg-gradient-to-tr from-slate-50 via-white to-amber-50/30 overflow-hidden">
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-10 left-10 w-72 h-72 bg-amber-100/30 rounded-full blur-2xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-6 relative lg:-top-8">
            <div class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-800 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-md">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></span><span data-edit="tentang_badge" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_badge ?? 'Tentang Kami' }}</span>
            </div>
            <h1 data-edit="judul" data-edit-type="text" data-edit-tipe="tentang" class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight leading-none">
                {{ $data->judul ?? 'Petualangan Terbaik' }} <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-500">Dimulai dari Sini</span>
            </h1>
            <div data-edit="konten" data-edit-type="html" data-edit-tipe="tentang" class="text-sm md:text-base leading-relaxed max-w-2xl font-medium relative group" style="color: #000 !important">
                {!! $data->konten ?? '<span class="font-extrabold" style="color: #000 !important">PT Jadi Berangkat</span> (Jeep Banyuwangi) adalah penyedia layanan wisata petualangan dan eksplorasi destinasi yang beroperasi resmi di Kabupaten Banyuwangi, Jawa Timur, menghadirkan pengalaman perjalanan aman, autentik, dan berkesan.' !!}
            </div>

            <div id="stats-container" class="pt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="stat-number text-2xl font-black text-emerald-600" data-target="5">0+</div>
                    <div data-edit="tentang_stat_tahun_label" data-edit-type="text" data-edit-tipe="tentang" class="text-[10px] font-bold text-slate-600 uppercase tracking-wider mt-1">{{ $data->tentang_stat_tahun_label ?? 'Tahun Pengalaman' }}</div>
                </div>
                <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="stat-number text-2xl font-black text-emerald-600" data-target="2000">0+</div>
                    <div data-edit="tentang_stat_wisatawan_label" data-edit-type="text" data-edit-tipe="tentang" class="text-[10px] font-bold text-slate-600 uppercase tracking-wider mt-1">{{ $data->tentang_stat_wisatawan_label ?? 'Wisatawan Dilayani' }}</div>
                </div>
                <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="stat-number text-2xl font-black text-emerald-600" data-target="20">0+</div>
                    <div data-edit="tentang_stat_rute_label" data-edit-type="text" data-edit-tipe="tentang" class="text-[10px] font-bold text-slate-600 uppercase tracking-wider mt-1">{{ $data->tentang_stat_rute_label ?? 'Rute Destinasi' }}</div>
                </div>
                <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="stat-number text-2xl font-black text-emerald-600" data-target="15">0+</div>
                    <div data-edit="tentang_stat_armada_label" data-edit-type="text" data-edit-tipe="tentang" class="text-[10px] font-bold text-slate-600 uppercase tracking-wider mt-1">{{ $data->tentang_stat_armada_label ?? 'Armada Jeep 4x4' }}</div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 relative">
            <div class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl group">
                <img src="{{ asset('img/pantaipelengkung.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Banyuwangi">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 bg-slate-950/80 backdrop-blur-sm p-5 space-y-1.5">
                    <p data-edit="tentang_badge_premium" data-edit-type="text" data-edit-tipe="tentang" class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest">{{ $data->tentang_badge_premium ?? 'Premium Service' }}</p>
                    <h3 data-edit="tentang_caption" data-edit-type="text" data-edit-tipe="tentang" class="text-base md:text-lg font-bold text-white">{{ $data->tentang_caption ?? 'Jelajahi Keindahan Alami Bersama Driver Profesional' }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 grid grid-cols-2 gap-4 relative">
            <div class="space-y-4">
                <img src="{{ asset('img/unsplash_M8drGBgFNZE.png') }}" class="w-full aspect-square object-cover rounded-xl shadow-md" alt="Nature Briefing">
                <div class="bg-emerald-600 p-5 rounded-xl text-center space-y-1">
                    <span class="text-2xl font-bold block text-white">100%</span>
                    <span class="text-[10px] text-emerald-100 font-medium uppercase tracking-wider block">Local Empowerment</span>
                </div>
            </div>
            <div class="pt-8 space-y-4">
                <img src="{{ asset('img/unsplash_Souw06F1irM.png') }}" class="w-full aspect-[3/4] object-cover rounded-xl shadow-md" alt="Savana Baluran">
            </div>
        </div>

        <div class="lg:col-span-7 space-y-6">
            <div class="space-y-2">
                <span data-edit="tentang_kisah_badge" data-edit-type="text" data-edit-tipe="tentang" class="text-emerald-400 font-bold text-xs uppercase tracking-widest block">{{ $data->tentang_kisah_badge ?? 'Kisah Kami' }}</span>
                <h2 data-edit="tentang_kisah_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-2xl md:text-4xl font-extrabold tracking-tight">{{ $data->tentang_kisah_judul ?? 'Lahir dari Kecintaan pada Alam Banyuwangi' }}</h2>
            </div>
            <div class="text-slate-300 text-sm md:text-base space-y-4 leading-relaxed font-light">
                <p data-edit="tentang_kisah_p1" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_kisah_p1 ?? 'Jeep Banyuwangi lahir dari semangat para pecinta alam dan petualang lokal yang ingin mengajak dunia melihat keindahan tersembunyi Banyuwangi.' }}</p>
                <p data-edit="tentang_kisah_p2" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_kisah_p2 ?? 'Dengan armada Jeep 4x4 yang terawat prima dan driver-guide lokal berpengalaman, kami memastikan setiap perjalanan bukan sekadar wisata biasa.' }}</p>
                <p data-edit="tentang_kisah_p3" data-edit-type="text" data-edit-tipe="tentang" class="border-l-2 border-emerald-500 pl-4 text-white italic">{{ $data->tentang_kisah_p3 ?? 'Kami berkomitmen pada pariwisata yang ramah lingkungan, mendukung ekonomi komunitas lokal.' }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-[#fafafa]">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <span data-edit="tentang_visimisi_badge" data-edit-type="text" data-edit-tipe="tentang" class="text-emerald-600 font-bold text-xs uppercase tracking-widest block mb-1">{{ $data->tentang_visimisi_badge ?? 'Landasan Kami' }}</span>
            <h2 data-edit="tentang_visimisi_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-xl font-bold text-slate-900">{{ $data->tentang_visimisi_judul ?? 'Visi & Misi Perusahaan' }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
            <div class="md:col-span-6 bg-white p-6 rounded-xl border border-slate-100 shadow-sm border-l-4 border-l-slate-800 relative overflow-hidden">
                <i class="bi bi-eye-fill absolute -right-4 -bottom-6 text-7xl text-slate-900/5"></i>
                <div class="relative z-10 space-y-4">
                    <div class="text-slate-800 text-xl"><i class="bi bi-eye-fill"></i></div>
                    <h3 data-edit="tentang_visi_label" data-edit-type="text" data-edit-tipe="tentang" class="text-sm font-bold uppercase tracking-wider text-slate-900">{{ $data->tentang_visi_label ?? 'Visi' }}</h3>
                    <p data-edit="tentang_visi_text" data-edit-type="text" data-edit-tipe="tentang" class="text-slate-600 text-xs md:text-sm leading-relaxed font-medium">{{ $data->tentang_visi_text ?? 'Jadi perusahaan wisata petualangan yang dikenal karena pelayanan jujur, sopir yang asyik diajak ngobrol.' }}</p>
                </div>
            </div>

            <div class="md:col-span-6 bg-white p-6 rounded-xl border border-slate-100 shadow-sm border-l-4 border-l-slate-800 relative overflow-hidden">
                <i class="bi bi-layers-half absolute -right-4 -top-6 text-7xl text-slate-900/5"></i>
                <div class="relative z-10 space-y-4">
                    <div class="text-slate-800 text-xl"><i class="bi bi-layers-half"></i></div>
                    <h3 data-edit="tentang_misi_label" data-edit-type="text" data-edit-tipe="tentang" class="text-sm font-bold uppercase tracking-wider text-slate-900">{{ $data->tentang_misi_label ?? 'Misi' }}</h3>
                    <ul class="space-y-3 text-slate-600 text-xs md:text-sm font-medium">
                        <li class="flex gap-3"><span class="text-emerald-500 font-bold">01.</span><span data-edit="tentang_misi_item_1" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_misi_item_1 ?? 'Kasih pengalaman jalan-jalan paling seru, aman, dan berkesan tanpa ribet.' }}</span></li>
                        <li class="flex gap-3"><span class="text-emerald-500 font-bold">02.</span><span data-edit="tentang_misi_item_2" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_misi_item_2 ?? 'Driver lokal yang ramah, paham medan, dan tahu cerita-cerita seru tiap sudut Banyuwangi.' }}</span></li>
                        <li class="flex gap-3"><span class="text-emerald-500 font-bold">03.</span><span data-edit="tentang_misi_item_3" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_misi_item_3 ?? 'Bikin reservasi semudah chat sama teman — cepat, transparan, tanpa banyak syarat.' }}</span></li>
                        <li class="flex gap-3"><span class="text-emerald-500 font-bold">04.</span><span data-edit="tentang_misi_item_4" data-edit-type="text" data-edit-tipe="tentang">{{ $data->tentang_misi_item_4 ?? 'Pastiin tiap perjalanan juga ngasih dampak baik buat alam dan warga lokal Banyuwangi.' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 md:px-12 py-20 bg-white rounded-3xl shadow-sm border border-slate-100 my-10">
    <div class="text-center mb-16 space-y-2">
        <span data-edit="tentang_nilai_badge" data-edit-type="text" data-edit-tipe="tentang" class="text-emerald-600 font-bold text-xs uppercase tracking-widest block">{{ $data->tentang_nilai_badge ?? 'Nilai Kami' }}</span>
        <h2 data-edit="tentang_nilai_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">{{ $data->tentang_nilai_judul ?? 'Mengapa Pilih Jadi Berangkat?' }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-shield-check"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_1_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_1_judul ?? 'Keamanan Terjamin' }}</h3>
                <p data-edit="tentang_nilai_item_1_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_1_desc ?? 'Armada Jeep 4x4 terinspeksi rutin dengan standar keselamatan wisata internasional.' }}</p>
            </div>
        </div>
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-tree"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_2_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_2_judul ?? 'Eco-Tourism' }}</h3>
                <p data-edit="tentang_nilai_item_2_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_2_desc ?? 'Beroperasi dengan prinsip pariwisata berkelanjutan, mendukung kelestarian alam Banyuwangi.' }}</p>
            </div>
        </div>
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-person-badge"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_3_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_3_judul ?? 'Guide Lokal Expert' }}</h3>
                <p data-edit="tentang_nilai_item_3_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_3_desc ?? 'Driver sekaligus pemandu lokal berpengalaman yang mengenal setiap sudut destinasi.' }}</p>
            </div>
        </div>
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-phone-vibrate"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_4_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_4_judul ?? 'Booking Digital' }}</h3>
                <p data-edit="tentang_nilai_item_4_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_4_desc ?? 'Sistem reservasi digital yang mudah, transparan, dan dapat diakses kapan saja.' }}</p>
            </div>
        </div>
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-gem"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_5_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_5_judul ?? 'Pengalaman Premium' }}</h3>
                <p data-edit="tentang_nilai_item_5_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_5_desc ?? 'Ribuan tamu telah merasakan pengalaman wisata berkesan bersama tim kami.' }}</p>
            </div>
        </div>
        <div class="flex gap-4 items-start">
            <div class="w-10 h-10 shrink-0 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg"><i class="bi bi-people"></i></div>
            <div class="space-y-1">
                <h3 data-edit="tentang_nilai_item_6_judul" data-edit-type="text" data-edit-tipe="tentang" class="text-sm md:text-base font-bold" style="color: #000 !important">{{ $data->tentang_nilai_item_6_judul ?? 'Komunitas Lokal' }}</h3>
                <p data-edit="tentang_nilai_item_6_desc" data-edit-type="text" data-edit-tipe="tentang" class="text-xs leading-relaxed" style="color: #000 !important">{{ $data->tentang_nilai_item_6_desc ?? 'Setiap kunjungan berkontribusi langsung pada perekonomian masyarakat lokal Banyuwangi.' }}</p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 md:px-12 py-16">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
        <div>
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-widest block mb-1">Galeri Kegiatan</span>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Momen Bersama Kami</h2>
        </div>
        <div class="inline-flex bg-slate-100 p-1 rounded-lg text-[10px] font-bold uppercase tracking-wider text-slate-600">
            <span class="bg-white px-3 py-1.5 rounded-md shadow-sm">Koleksi Media</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-5">
        <div class="md:col-span-4 relative rounded-xl overflow-hidden group min-h-[320px] shadow-sm">
            <img src="{{ asset('img/laut.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Ekspedisi Ijen">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            <span class="absolute bottom-4 left-4 bg-emerald-600 text-white text-[9px] font-extrabold uppercase px-2 py-0.5 rounded">EKSPEDISI IJEN</span>
        </div>
        <div class="md:col-span-5 relative rounded-xl overflow-hidden aspect-[4/3] sm:aspect-auto sm:h-52 md:h-auto md:row-span-1 shadow-sm">
            <img src="{{ asset('img/bluefire (1).png') }}" class="w-full h-full object-cover" alt="Momen Savana">
        </div>
        <div class="md:col-span-3 relative rounded-xl overflow-hidden aspect-[4/3] bg-slate-950 shadow-sm flex items-center justify-center group">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=600" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" alt="Video Pantai">
            <span class="absolute top-3 right-3 bg-red-600 text-white text-[8px] font-bold px-1.5 py-0.5 rounded">VIDEO</span>
            <button class="relative z-10 w-11 h-11 bg-white/90 backdrop-blur-sm rounded-full text-slate-900 flex items-center justify-center text-base shadow-md hover:scale-110 transition">
                <i class="bi bi-play-fill ml-0.5"></i>
            </button>
        </div>
        <div class="md:col-span-5 bg-gradient-to-br from-slate-100 to-slate-200/60 rounded-xl p-6 flex flex-col justify-end min-h-[160px] relative overflow-hidden shadow-sm">
            <img src="{{ asset('img/laut.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-20 filter grayscale" alt="Meru Betiri">
            <p class="font-extrabold text-slate-800 text-xs tracking-wider uppercase relative z-10"><i class="bi bi-people-fill text-emerald-600 mr-1.5"></i>Meru Betiri team</p>
        </div>
        <div class="md:col-span-3 relative rounded-xl overflow-hidden aspect-[4/3] bg-slate-950 shadow-sm flex items-center justify-center group">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=600" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 transition duration-500" alt="Video Gunung">
            <span class="absolute top-3 right-3 bg-red-600 text-white text-[8px] font-bold px-1.5 py-0.5 rounded">VIDEO</span>
            <button class="relative z-10 w-11 h-11 bg-white/90 backdrop-blur-sm rounded-full text-slate-900 flex items-center justify-center text-base shadow-md hover:scale-110 transition">
                <i class="bi bi-play-fill ml-0.5"></i>
            </button>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const statEls = document.querySelectorAll('.stat-number');
        if (!statEls.length) return;
        let animated = false;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    observer.disconnect();
                    statEls.forEach(el => {
                        const target = parseInt(el.dataset.target);
                        const duration = 1500;
                        const start = performance.now();
                        function update(now) {
                            const elapsed = now - start;
                            const progress = Math.min(elapsed / duration, 1);
                            const ease = 1 - Math.pow(1 - progress, 3);
                            const current = Math.floor(ease * target);
                            el.textContent = current + '+';
                            if (progress < 1) requestAnimationFrame(update);
                            else el.textContent = target + '+';
                        }
                        requestAnimationFrame(update);
                    });
                }
            });
        }, { threshold: 0.3 });
        observer.observe(document.getElementById('stats-container'));
    });
</script>
@endpush
