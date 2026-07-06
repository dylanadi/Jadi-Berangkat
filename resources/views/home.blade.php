@extends('layouts.app')

@section('title', 'Jadi Berangkat - Premium Jeep Booking')

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[100dvh] w-full overflow-hidden flex items-start md:items-center">
    @auth
    <a href="{{ route('admin.pengaturan.index') }}" target="_blank" class="absolute top-4 right-4 text-sm bg-[#2f6f42] text-white rounded-full p-2 shadow-lg hover:bg-[#255a35] transition z-50" title="Edit pengaturan">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endauth
    <div class="absolute inset-0 w-full h-full overflow-hidden bg-slate-950 pointer-events-none z-0">
        <iframe id="hero-video" class="absolute top-1/2 left-1/2 w-[300vw] h-[300vh] min-w-[100vw] min-h-[100vh] -translate-x-1/2 -translate-y-1/2 opacity-90"
            src="https://www.youtube.com/embed/qNVdijuWwGo?autoplay=1&mute=1&controls=0&loop=1&playlist=qNVdijuWwGo&rel=0&showinfo=0&enablejsapi=1"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>
    </div>
    <div class="absolute inset-0 hero-gradient"></div>
    <div class="relative z-10 text-white section-shell w-full pt-28 md:pt-28 pb-16 md:pb-20 gsap-section">
        <div class="max-w-3xl">
            <p class="gsap-item inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-holiday-light backdrop-blur-md">
                <span data-edit="hero_badge" data-edit-type="text" data-edit-tipe="beranda">{{ $pengaturan->hero_badge ?? 'Jeep trip Banyuwangi' }}</span>
            </p>
            <h1 data-edit="hero_judul" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item mt-7 text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-extrabold mb-6 drop-shadow-2xl leading-[0.98] md:leading-[0.95] text-white">
                {{ $pengaturan->hero_judul ?? 'Trip alam yang rapi dari awal sampai pulang.' }}
            </h1>
            <p data-edit="hero_deskripsi" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item text-base md:text-xl max-w-xl drop-shadow-md text-white/88 mb-7 md:mb-9 font-medium leading-relaxed">
                {{ $pengaturan->hero_deskripsi ?? 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.' }}
            </p>
            <div class="gsap-item flex flex-col sm:flex-row gap-3">
                <a href="{{ url('/booking') }}" class="btn-primary px-7 py-4 rounded-full transition-all font-bold inline-flex items-center justify-center gap-2">
<span data-edit="button_booking" data-edit-type="text" data-edit-tipe="beranda">{{ $pengaturan->button_booking ?? 'Booking Trip' }}</span> <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ url('/destinasi') }}" class="px-8 py-4 rounded-xl bg-white/15 text-white font-extrabold text-sm hover:bg-white hover:text-holiday transition-all flex items-center gap-2">
                            <span data-edit="button_destinasi" data-edit-type="text" data-edit-tipe="beranda">{{ $pengaturan->button_destinasi ?? 'Lihat Destinasi' }}</span>
                </a>
            </div>
        </div>
        <div class="gsap-item mt-10 md:mt-14 grid grid-cols-3 max-w-2xl divide-x divide-white/18 rounded-[1.5rem] border border-white/14 bg-black/24 p-4 text-white backdrop-blur-md">
            <div class="px-3">
                <p class="text-2xl md:text-3xl font-extrabold"><span data-edit="hero_jumlah_destinasi" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->hero_jumlah_destinasi ?? 25 }}" data-suffix="+">0</span></p>
<p data-edit="stat_hero_destinasi_label" data-edit-type="text" data-edit-tipe="beranda" class="text-xs text-white/65 font-bold">{{ $pengaturan->stat_hero_destinasi_label ?? 'Destinasi' }}</p>
            </div>
            <div class="px-3">
                <p class="text-2xl md:text-3xl font-extrabold"><span data-edit="hero_jumlah_armada" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->hero_jumlah_armada ?? 120 }}" data-suffix="+">0</span></p>
                <p data-edit="stat_armada_label" data-edit-type="text" data-edit-tipe="beranda" class="text-xs text-white/65 font-bold">{{ $pengaturan->stat_armada_label ?? 'Armada' }}</p>
            </div>
            <div class="px-3">
                <p class="text-2xl md:text-3xl font-extrabold"><span data-edit="hero_rating" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->hero_rating ?? '4.9' }}">0</span><i class="bi bi-star-fill text-amber-400"></i></p>
                <p data-edit="stat_rating_label" data-edit-type="text" data-edit-tipe="beranda" class="text-xs text-white/65 font-bold">{{ $pengaturan->stat_rating_label ?? 'Rating' }}</p>
            </div>
        </div>
    </div>
    <button id="mute-btn" class="absolute bottom-8 left-6 md:left-10 z-20 w-12 h-12 bg-black/50 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-holiday transition border border-white/20 shadow-xl">
        <i class="bi bi-volume-mute-fill text-xl" id="mute-icon"></i>
    </button>
</section>

{{-- Destinasi Section --}}
<section id="destinasi" class="py-24 md:py-28 overflow-hidden relative gsap-section">
    <div class="section-shell">
        <div class="grid lg:grid-cols-[0.9fr_1.4fr] gap-10 lg:gap-14 items-end mb-12">
            <div class="max-w-5xl lg:col-span-2">
                <span data-edit="eyebrow_destinasi" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item eyebrow">{{ $pengaturan->eyebrow_destinasi ?? 'Eksplorasi lokal' }}</span>
                <h2 data-edit="destinasi_judul" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item text-4xl md:text-5xl xl:text-6xl font-extrabold text-ink mt-3 mb-5 leading-tight">{{ $pengaturan->destinasi_judul ?? 'Destinasi pilihan untuk satu hari yang utuh.' }}</h2>
            </div>
            <p data-edit="destinasi_deskripsi" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item text-gray-600 max-w-2xl font-medium leading-relaxed lg:pb-3">
                {{ $pengaturan->destinasi_deskripsi ?? 'Mulai dari kawah, hutan trembesi, kampung budaya, sampai pantai. Pilih satu rute utama, lalu kami susun perjalanan yang masuk akal untuk waktu dan energimu.' }}
            </p>
        </div>

        <div class="gsap-item grid lg:grid-cols-[1.05fr_1fr] gap-5 lg:gap-6">
            @if(isset($destinasi) && count($destinasi) > 0)
                @foreach($destinasi as $key => $item)
                    @if($loop->first)
                    <a href="{{ url('/destinasi/' . $item->slug) }}" class="group relative min-h-[520px] overflow-hidden rounded-[1.75rem] bg-ink text-white shadow-[0_28px_90px_rgba(21,24,19,0.18)]">
                        <img src="{{ asset('img/' . ($item->gambar ?? 'unsplash_M8drGBgFNZE.png')) }}" alt="{{ $item->nama }}" data-image-edit data-edit-url="{{ route('admin.destinasi.edit', $item->id) }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                        <div class="absolute left-6 right-6 top-6 flex items-center justify-between">
                            <span class="rounded-full bg-white/16 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] backdrop-blur-md">Rute utama</span>
                            <span class="rounded-full bg-white text-holiday-dark px-4 py-2 text-sm font-extrabold">{{ $item->label ?? 'Mulai pagi' }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                            <p class="mb-3 text-sm font-bold text-holiday-light">{{ $item->kategori ?? 'Destinasi' }}</p>
                            <h3 class="max-w-xl text-4xl md:text-5xl font-extrabold leading-tight">{{ $item->nama }}</h3>
                            <div class="mt-7 grid grid-cols-3 gap-3 border-t border-white/18 pt-5 text-sm">
                                <div>
                                    <p class="text-white/55 font-bold">Durasi</p>
                                    <p class="font-extrabold">{{ $item->durasi ?? '8 jam' }}</p>
                                </div>
                                <div>
                                    <p class="text-white/55 font-bold">Mood</p>
                                    <p class="font-extrabold">{{ $item->mood ?? 'Sunrise' }}</p>
                                </div>
                                <div>
                                    <p class="text-white/55 font-bold">Rating</p>
                                    <p class="font-extrabold">{{ $item->rating ?? '4.9' }}/5</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                @endforeach
                <div class="grid sm:grid-cols-2 gap-5 lg:gap-6">
                    @foreach($destinasi as $key => $item)
                        @if(!$loop->first)
                        <a href="{{ url('/destinasi/' . $item->slug) }}" class="group relative min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white">
                            <img src="{{ asset('img/' . ($item->gambar ?? 'djawatan.jpg')) }}" alt="{{ $item->nama }}" data-image-edit data-edit-url="{{ route('admin.destinasi.edit', $item->id) }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5">
                                <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-holiday-light">{{ $item->kategori ?? 'Wisata' }}</p>
                                <h3 class="mt-2 text-2xl font-extrabold">{{ $item->nama }}</h3>
                                <p class="mt-2 text-sm text-white/72">{{ $item->deskripsi_singkat ?? '' }}</p>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            @else
                {{-- Static fallback --}}
                <a href="{{ url('/detail') }}" class="group relative min-h-[520px] overflow-hidden rounded-[1.75rem] bg-ink text-white shadow-[0_28px_90px_rgba(21,24,19,0.18)]">
                    <img src="{{ asset('img/unsplash_M8drGBgFNZE.png') }}" alt="Kawah Ijen Banyuwangi" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                    <div class="absolute left-6 right-6 top-6 flex items-center justify-between">
                        <span class="rounded-full bg-white/16 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] backdrop-blur-md">Rute utama</span>
                        <span class="rounded-full bg-white text-holiday-dark px-4 py-2 text-sm font-extrabold">Mulai pagi</span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                        <p class="mb-3 text-sm font-bold text-holiday-light">Kawah Ijen</p>
                        <h3 class="max-w-xl text-4xl md:text-5xl font-extrabold leading-tight">Blue fire, sunrise, dan jeep transfer yang rapi.</h3>
                        <div class="mt-7 grid grid-cols-3 gap-3 border-t border-white/18 pt-5 text-sm">
                            <div><p class="text-white/55 font-bold">Durasi</p><p class="font-extrabold">8 jam</p></div>
                            <div><p class="text-white/55 font-bold">Mood</p><p class="font-extrabold">Sunrise</p></div>
                            <div><p class="text-white/55 font-bold">Rating</p><p class="font-extrabold">4.9/5</p></div>
                        </div>
                    </div>
                </a>
                <div class="grid sm:grid-cols-2 gap-5 lg:gap-6">
                    <a href="{{ url('/detail') }}" class="group relative min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white">
                        <img src="{{ asset('img/djawatan.jpg') }}" alt="Hutan De Djawatan" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-holiday-light">Hutan</p>
                            <h3 class="mt-2 text-2xl font-extrabold">De Djawatan</h3>
                            <p class="mt-2 text-sm text-white/72">Trembesi raksasa dan jalur foto teduh.</p>
                        </div>
                    </a>
                    <a href="{{ url('/detail') }}" class="group relative min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white">
                        <img src="{{ asset('img/kemiren.png') }}" alt="Desa Wisata Kemiren" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-holiday-light">Budaya</p>
                            <h3 class="mt-2 text-2xl font-extrabold">Desa Kemiren</h3>
                            <p class="mt-2 text-sm text-white/72">Kopi, tradisi Osing, dan cerita lokal.</p>
                        </div>
                    </a>
                    <a href="{{ url('/detail') }}" class="group relative min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white">
                        <img src="{{ asset('img/pantaiboom.png') }}" alt="Pantai Boom Banyuwangi" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-holiday-light">Pantai</p>
                            <h3 class="mt-2 text-2xl font-extrabold">Pantai Boom</h3>
                            <p class="mt-2 text-sm text-white/72">Sunrise, dermaga, dan angin laut kota.</p>
                        </div>
                    </a>
                    <a href="{{ url('/detail') }}" class="group relative min-h-[250px] overflow-hidden rounded-[1.5rem] bg-ink text-white">
                        <img src="{{ asset('img/Tarian_Gandrung_sewu_03 1.png') }}" alt="Gandrung Sewu" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-holiday-light">Festival</p>
                            <h3 class="mt-2 text-2xl font-extrabold">Gandrung Sewu</h3>
                            <p class="mt-2 text-sm text-white/72">Ribuan penari dan energi budaya pesisir.</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- Paket Trip Section --}}
<section id="paket" class="py-20 relative gsap-section overflow-hidden">
    <div class="section-shell relative">
        <div class="flex justify-between items-end mb-10 gap-6">
            <div class="gsap-item text-left w-auto">
                <span data-edit="eyebrow_paket" data-edit-type="text" data-edit-tipe="beranda" class="eyebrow">{{ $pengaturan->eyebrow_paket ?? 'Penawaran' }}</span>
                <h2 data-edit="paket_judul" data-edit-type="text" data-edit-tipe="beranda" class="text-4xl md:text-5xl font-extrabold text-ink mt-3 leading-tight">{{ $pengaturan->paket_judul ?? 'Paket yang paling sering dipesan.' }}</h2>
            </div>
            <div class="gsap-item flex gap-2">
                <button id="btn-prev-paket" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-600 hover:text-white hover:bg-holiday transition cursor-pointer border border-black/10"><i class="bi bi-chevron-left"></i></button>
                <button id="btn-next-paket" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-600 hover:text-white hover:bg-holiday transition cursor-pointer border border-black/10"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div id="paket-slider" class="gsap-item flex overflow-x-auto gap-4 md:gap-6 pb-6 pt-2 snap-x snap-mandatory no-scrollbar -mx-6 px-6 md:mx-0 md:px-0 md:justify-start items-stretch w-auto smooth-scroll-x relative">
            @forelse($paket ?? [] as $item)
            <div class="slider-card-native w-full md:w-[340px] flex-shrink-0 surface-card rounded-[1.5rem] overflow-hidden snap-center group flex flex-col">
                <div class="relative w-full h-52 overflow-hidden bg-gray-200 flex-shrink-0">
                    <img src="{{ asset('img/' . ($item->gambar ?? 'unsplash_M8drGBgFNZE.png')) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-extrabold px-3 py-1.5 rounded-full flex items-center gap-1 shadow">
                        <i class="bi bi-clock text-holiday"></i> {{ $item->durasi ?? '1 Hari' }}
                    </div>
                    <div class="absolute top-4 right-4 bg-gray-900/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full shadow">{{ $item->tipe ?? 'Private' }}</div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-1 group-hover:text-holiday transition-colors">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1 font-medium"><i class="bi bi-geo-alt-fill text-gray-400"></i> {{ $item->rute ?? 'Rute Alam Terbuka' }}</p>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="font-extrabold text-gray-900">{{ $item->rating ?? '4.8' }}</span>
                        <div class="flex text-yellow-400 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= floor($item->rating ?? 4.8) ? 'bi-star-fill' : ($i - 0.5 <= ($item->rating ?? 4.8) ? 'bi-star-half' : 'bi-star') }}"></i>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-400 font-semibold">({{ $item->jml_ulasan ?? '128' }} review)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-6 line-clamp-2">{{ $item->deskripsi ?? 'Menikmati keindahan alam secara langsung dengan rute menantang yang memacu adrenalin ..' }}</p>
                    <div class="mt-auto">
                        <div class="bg-holiday-light/35 rounded-2xl p-4 mb-5 border border-holiday/10">
                            <p class="text-xs text-holiday-dark/80 font-bold mb-1 uppercase tracking-wider">Mulai dari</p>
                            <p class="text-xl font-extrabold text-holiday-dark">Rp {{ number_format($item->harga ?? 1250000, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ url('/detail/' . ($item->slug ?? '#')) }}" class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold hover:bg-gray-50 transition text-center">Detail</a>
                            <a href="{{ url('/booking/' . ($item->slug ?? '#')) }}" class="flex-1 py-3 rounded-xl bg-holiday text-white font-extrabold hover:bg-holiday-dark transition shadow-md shadow-holiday-glow text-center">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="slider-card-native w-full md:w-[340px] flex-shrink-0 surface-card rounded-[1.5rem] overflow-hidden snap-center group flex flex-col">
                <div class="relative w-full h-52 overflow-hidden bg-gray-200 flex-shrink-0">
                    <img src="{{ asset('img/unsplash_M8drGBgFNZE.png') }}" alt="Trip 1" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-extrabold px-3 py-1.5 rounded-full flex items-center gap-1 shadow">
                        <i class="bi bi-clock text-holiday"></i> 1 Hari
                    </div>
                    <div class="absolute top-4 right-4 bg-gray-900/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full shadow">Private</div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-1 group-hover:text-holiday transition-colors">Eksplorasi Alam Bebas</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1 font-medium"><i class="bi bi-geo-alt-fill text-gray-400"></i> Rute Alam Terbuka</p>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="font-extrabold text-gray-900">4.8</span>
                        <div class="flex text-yellow-400 text-xs"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                        <span class="text-xs text-gray-400 font-semibold">(128 review)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-6 line-clamp-2">Menikmati keindahan alam secara langsung dengan rute menantang yang memacu adrenalin ..</p>
                    <div class="mt-auto">
                        <div class="bg-holiday-light/35 rounded-2xl p-4 mb-5 border border-holiday/10">
                            <p class="text-xs text-holiday-dark/80 font-bold mb-1 uppercase tracking-wider">Mulai dari</p>
                            <p class="text-xl font-extrabold text-holiday-dark">Rp 1.250.000</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ url('/detail') }}" class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold hover:bg-gray-50 transition text-center">Detail</a>
                            <a href="{{ url('/booking') }}" class="flex-1 py-3 rounded-xl bg-holiday text-white font-extrabold hover:bg-holiday-dark transition shadow-md shadow-holiday-glow text-center">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-card-native w-full md:w-[340px] flex-shrink-0 surface-card rounded-[1.5rem] overflow-hidden snap-center group flex flex-col">
                <div class="relative w-full h-52 overflow-hidden bg-gray-200 flex-shrink-0">
                    <img src="{{ asset('img/unsplash_Souw06F1irM.png') }}" alt="Trip 2" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-extrabold px-3 py-1.5 rounded-full flex items-center gap-1 shadow">
                        <i class="bi bi-clock text-holiday"></i> 3 Jam
                    </div>
                    <div class="absolute top-4 right-4 bg-gray-900/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full shadow">Open Trip</div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-1 group-hover:text-holiday transition-colors">Menyusuri Lanskap Hijau</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1 font-medium"><i class="bi bi-geo-alt-fill text-gray-400"></i> Perbukitan Asri</p>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="font-extrabold text-gray-900">5.0</span>
                        <div class="flex text-yellow-400 text-xs"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <span class="text-xs text-gray-400 font-semibold">(450 review)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-6 line-clamp-2">Perjalanan singkat melintasi kawasan asri dengan pemandangan pegunungan yang menyejukkan ..</p>
                    <div class="mt-auto">
                        <div class="bg-holiday-light/35 rounded-2xl p-4 mb-5 border border-holiday/10">
                            <p class="text-xs text-holiday-dark/80 font-bold mb-1 uppercase tracking-wider">Mulai dari</p>
                            <p class="text-xl font-extrabold text-holiday-dark">Rp 450.000</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ url('/detail') }}" class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold hover:bg-gray-50 transition text-center">Detail</a>
                            <a href="{{ url('/booking') }}" class="flex-1 py-3 rounded-xl bg-holiday text-white font-extrabold hover:bg-holiday-dark transition shadow-md shadow-holiday-glow text-center">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-card-native w-full md:w-[340px] flex-shrink-0 surface-card rounded-[1.5rem] overflow-hidden snap-center group flex flex-col">
                <div class="relative w-full h-52 overflow-hidden bg-gray-200 flex-shrink-0">
                    <img src="{{ asset('img/gandrung1.png') }}" alt="Trip 3" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 object-top">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-extrabold px-3 py-1.5 rounded-full flex items-center gap-1 shadow">
                        <i class="bi bi-clock text-holiday"></i> Budaya
                    </div>
                    <div class="absolute top-4 right-4 bg-gray-900/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full shadow">Eksklusif</div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-1 group-hover:text-holiday transition-colors">Paket Wisata Budaya</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1 font-medium"><i class="bi bi-geo-alt-fill text-gray-400"></i> Desa Tradisional</p>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="font-extrabold text-gray-900">4.9</span>
                        <div class="flex text-yellow-400 text-xs"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                        <span class="text-xs text-gray-400 font-semibold">(320 review)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-6 line-clamp-2">Kenali lebih dekat kearifan lokal melalui tarian dan tradisi masyarakat setempat ..</p>
                    <div class="mt-auto">
                        <div class="bg-holiday-light/35 rounded-2xl p-4 mb-5 border border-holiday/10">
                            <p class="text-xs text-holiday-dark/80 font-bold mb-1 uppercase tracking-wider">Mulai dari</p>
                            <p class="text-xl font-extrabold text-holiday-dark">Rp 850.000</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ url('/detail') }}" class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold hover:bg-gray-50 transition text-center">Detail</a>
                            <a href="{{ url('/booking') }}" class="flex-1 py-3 rounded-xl bg-holiday text-white font-extrabold hover:bg-holiday-dark transition shadow-md shadow-holiday-glow text-center">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-8 flex items-center justify-between relative z-10">
            <div id="dots-paket" class="flex gap-2 md:hidden"></div>
            <div class="ml-auto gsap-item">
                <a href="{{ url('/destinasi') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 md:px-8 md:py-4 rounded-full bg-white border border-gray-200 !text-gray-600 font-extrabold hover:bg-holiday hover:text-white hover:border-holiday transition-all shadow-sm hover:shadow-lg group text-sm md:text-base">
                    Lihat Lebih Banyak <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Statistik Section --}}
<section class="py-16 bg-ink text-white relative overflow-hidden gsap-section">
    <div class="section-shell relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-6 text-left md:text-center divide-y-0 md:divide-x divide-white/12">
            <div class="px-4 gsap-item flex flex-col justify-center">
                <h3 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight"><span data-edit="stats_pengunjung" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->stats_pengunjung ?? 12 }}" data-suffix="K+">0</span></h3>
                <p data-edit="stat_pengunjung_label" data-edit-type="text" data-edit-tipe="beranda" class="text-sm text-white/58 font-bold uppercase tracking-widest">{{ $pengaturan->stat_pengunjung_label ?? 'Pengunjung' }}</p>
            </div>
            <div class="px-4 gsap-item flex flex-col justify-center border-l border-white/20 md:border-l-0">
                <h3 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight"><span data-edit="stats_jumlah_destinasi" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->stats_jumlah_destinasi ?? 25 }}" data-suffix="+">0</span></h3>
                <p data-edit="stat_destinasi_label" data-edit-type="text" data-edit-tipe="beranda" class="text-sm text-white/58 font-bold uppercase tracking-widest">{{ $pengaturan->stat_destinasi_label ?? 'Destinasi' }}</p>
            </div>
            <div class="px-4 gsap-item flex flex-col justify-center">
                <h3 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight"><span data-edit="stats_jumlah_rute" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->stats_jumlah_rute ?? 50 }}" data-suffix="+">0</span></h3>
                <p data-edit="stat_rute_label" data-edit-type="text" data-edit-tipe="beranda" class="text-sm text-white/58 font-bold uppercase tracking-widest">{{ $pengaturan->stat_rute_label ?? 'Rute Trip' }}</p>
            </div>
            <div class="px-4 gsap-item flex flex-col justify-center border-l border-white/20 md:border-l-0">
                <h3 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight"><span data-edit="stats_jumlah_armada" data-edit-type="number" data-edit-tipe="beranda" class="hero-stat" data-target="{{ $pengaturan->stats_jumlah_armada ?? 120 }}" data-suffix="+">0</span></h3>
                <p data-edit="stat_jeep_label" data-edit-type="text" data-edit-tipe="beranda" class="text-sm text-white/58 font-bold uppercase tracking-widest">{{ $pengaturan->stat_jeep_label ?? 'Jeep Armada' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Armada Section --}}
<section id="armada" class="py-24 bg-base relative gsap-section overflow-hidden">
    <div class="section-shell relative">
        <div class="flex justify-between items-end mb-10 gap-6">
            <div class="gsap-item text-left w-auto">
                <span data-edit="eyebrow_armada" data-edit-type="text" data-edit-tipe="beranda" class="eyebrow">{{ $pengaturan->eyebrow_armada ?? 'Kendaraan kami' }}</span>
                <h2 data-edit="armada_judul" data-edit-type="text" data-edit-tipe="beranda" class="text-4xl md:text-5xl font-extrabold text-ink mt-3 mb-4 leading-tight">{{ $pengaturan->armada_judul ?? 'Armada tangguh, tampil bersih.' }}</h2>
                <p data-edit="armada_deskripsi" data-edit-type="text" data-edit-tipe="beranda" class="text-gray-500 max-w-lg font-medium">{{ $pengaturan->armada_deskripsi ?? 'Kondisi mesin prima dan terawat, siap memberikan keamanan serta kenyamanan.' }}</p>
            </div>
            <div class="gsap-item flex gap-2">
                <button id="btn-prev-armada" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-600 hover:text-white hover:bg-holiday transition cursor-pointer border border-black/10"><i class="bi bi-chevron-left"></i></button>
                <button id="btn-next-armada" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-600 hover:text-white hover:bg-holiday transition cursor-pointer border border-black/10"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div id="slider-armada" class="gsap-item flex overflow-x-auto gap-4 md:gap-8 pb-6 snap-x snap-mandatory no-scrollbar -mx-6 px-6 md:mx-0 md:px-0 md:justify-start items-stretch w-auto smooth-scroll-x relative">
            @forelse($armada ?? [] as $item)
            <div class="slider-card-native w-full md:w-[360px] flex-shrink-0 surface-card rounded-[1.5rem] p-5 flex flex-col items-center snap-center group hover:border-holiday/50 transition-all">
                <img src="{{ asset('img/' . ($item->gambar ?? 'unsplash_M8drGBgFNZE.png')) }}" alt="{{ $item->nama }}" class="w-full object-cover h-48 md:h-56 mb-6 rounded-2xl transition-transform duration-500 group-hover:scale-105 relative z-10 flex-shrink-0">
                <div class="relative z-10 text-center w-full flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $item->nama }}</h3>
                        <p class="text-sm text-gray-500 mb-6 font-medium">{{ $item->deskripsi ?? '' }}</p>
                    </div>
                    <a href="{{ url('/detail/' . ($item->slug ?? '#')) }}" class="w-full py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 font-bold hover:bg-holiday hover:text-white transition-all mt-auto text-center">Lihat Detail</a>
                </div>
            </div>
            @empty
            <div class="slider-card-native w-full md:w-[360px] flex-shrink-0 surface-card rounded-[1.5rem] p-5 flex flex-col items-center snap-center group hover:border-holiday/50 transition-all">
                <img src="{{ asset('img/unsplash_M8drGBgFNZE.png') }}" alt="Kendaraan 1" class="w-full object-cover h-48 md:h-56 mb-6 rounded-2xl transition-transform duration-500 group-hover:scale-105 relative z-10 flex-shrink-0">
                <div class="relative z-10 text-center w-full flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Jeep 4x4 Custom</h3>
                        <p class="text-sm text-gray-500 mb-6 font-medium">Suspensi premium & Power</p>
                    </div>
                    <a href="{{ url('/detail') }}" class="w-full py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 font-bold hover:bg-holiday hover:text-white transition-all mt-auto text-center">Lihat Detail</a>
                </div>
            </div>
            <div class="slider-card-native w-full md:w-[360px] flex-shrink-0 surface-card rounded-[1.5rem] p-5 flex flex-col items-center snap-center group hover:border-holiday/50 transition-all">
                <img src="{{ asset('img/unsplash_Souw06F1irM.png') }}" alt="Kendaraan 2" class="w-full object-cover h-48 md:h-56 mb-6 rounded-2xl transition-transform duration-500 group-hover:scale-105 relative z-10 flex-shrink-0">
                <div class="relative z-10 text-center w-full flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Classic Hardtop</h3>
                        <p class="text-sm text-gray-500 mb-6 font-medium">Ikonik dan bertenaga</p>
                    </div>
                    <a href="{{ url('/detail') }}" class="w-full py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 font-bold hover:bg-holiday hover:text-white transition-all mt-auto text-center">Lihat Detail</a>
                </div>
            </div>
            <div class="slider-card-native w-full md:w-[360px] flex-shrink-0 surface-card rounded-[1.5rem] p-5 flex flex-col items-center snap-center group hover:border-holiday/50 transition-all">
                <img src="{{ asset('img/jembatan.png') }}" alt="Kendaraan 3" class="w-full object-cover h-48 md:h-56 mb-6 rounded-2xl transition-transform duration-500 group-hover:scale-105 relative z-10 flex-shrink-0">
                <div class="relative z-10 text-center w-full flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Defender Series</h3>
                        <p class="text-sm text-gray-500 mb-6 font-medium">Kapasitas besar medan berat</p>
                    </div>
                    <a href="{{ url('/detail') }}" class="w-full py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 font-bold hover:bg-holiday hover:text-white transition-all mt-auto text-center">Lihat Detail</a>
                </div>
            </div>
            @endforelse
        </div>

        <div id="dots-armada" class="flex justify-center gap-2 mt-4 relative z-10 md:hidden"></div>
    </div>
</section>

{{-- Ulasan Section (Marquee) --}}
<section class="py-20 bg-white overflow-hidden relative gsap-section">
    <div class="section-shell mb-12">
        <span data-edit="eyebrow_ulasan" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item eyebrow">{{ $pengaturan->eyebrow_ulasan ?? 'Ulasan' }}</span>
        <h2 data-edit="ulasan_judul" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item text-4xl md:text-5xl font-extrabold text-ink mt-3 mb-4 leading-tight">{{ $pengaturan->ulasan_judul ?? 'Cerita setelah turun dari jeep.' }}</h2>
        <p data-edit="ulasan_deskripsi" data-edit-type="text" data-edit-tipe="beranda" class="gsap-item text-gray-500 font-medium max-w-xl">{{ $pengaturan->ulasan_deskripsi ?? 'Ribuan petualang telah membuktikan kualitas layanan kami lewat rute, driver, dan kendaraan yang siap jalan.' }}</p>
    </div>

    <div class="gsap-item section-shell py-4">
        <div class="marquee-wrapper">
            <div class="marquee-track">
                @forelse($ulasan ?? [] as $item)
                <div class="flex gap-6 pr-6">
                    <div class="w-[340px] flex-shrink-0 bg-base p-8 rounded-[1.5rem] border border-gray-200">
                        <div class="flex text-yellow-400 text-sm mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= ($item->bintang ?? 5) ? 'bi-star-fill' : ($i - 0.5 <= ($item->bintang ?? 5) ? 'bi-star-half' : 'bi-star') }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-700 mb-6 text-sm leading-relaxed font-semibold">"{{ $item->pesan ?? '' }}"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-holiday text-white flex items-center justify-center font-bold">{{ substr($item->nama_user ?? 'A', 0, 1) }}</div>
                            <div>
                                <h4 class="font-extrabold text-sm text-gray-900">{{ $item->nama_user ?? '' }}</h4>
                                <p class="text-xs text-gray-500 font-medium">{{ $item->kategori ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex gap-6 pr-6">
                    <div class="w-[340px] flex-shrink-0 bg-base p-8 rounded-[1.5rem] border border-gray-200">
                        <div class="flex text-yellow-400 text-sm mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p class="text-gray-700 mb-6 text-sm leading-relaxed font-semibold">"Sangat terkesan dengan pelayanan JB. Driver ramah dan paham betul kondisi jalanan. Rute Hutan De Djawatan jadi super seru!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-holiday text-white flex items-center justify-center font-bold">AS</div>
                            <div><h4 class="font-extrabold text-sm text-gray-900">Andi Saputra</h4><p class="text-xs text-gray-500 font-medium">Trip Hutan</p></div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-6 pr-6">
                    <div class="w-[340px] flex-shrink-0 bg-base p-8 rounded-[1.5rem] border border-gray-200">
                        <div class="flex text-yellow-400 text-sm mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                        <p class="text-gray-700 mb-6 text-sm leading-relaxed font-semibold">"Pengalaman kultural di Desa Kemiren sangat otentik. Jeep yang dipakai bersih dan mesinnya halus. Sangat direkomendasikan!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-ink text-white flex items-center justify-center font-bold">RM</div>
                            <div><h4 class="font-extrabold text-sm text-gray-900">Rina Melati</h4><p class="text-xs text-gray-500 font-medium">Budaya Trip</p></div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-6 pr-6">
                    <div class="w-[340px] flex-shrink-0 bg-base p-8 rounded-[1.5rem] border border-gray-200">
                        <div class="flex text-yellow-400 text-sm mb-4"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p class="text-gray-700 mb-6 text-sm leading-relaxed font-semibold">"Tripnya sangat on-time dan profesional. Kendaraannya benar-benar tangguh melintasi jalanan berat tanpa hambatan sama sekali!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-holiday-dark text-white flex items-center justify-center font-bold">DK</div>
                            <div><h4 class="font-extrabold text-sm text-gray-900">Dimas Kusuma</h4><p class="text-xs text-gray-500 font-medium">Open Trip</p></div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // YouTube mute toggle
    const muteBtn = document.getElementById('mute-btn');
    const muteIcon = document.getElementById('mute-icon');
    let heroPlayer;
    let isMuted = true;

    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    window.onYouTubeIframeAPIReady = function() {
        heroPlayer = new YT.Player('hero-video', {
            events: { 'onReady': onPlayerReady }
        });
    };

    function onPlayerReady(event) {
        if (muteBtn) {
            muteBtn.addEventListener('click', () => {
                if (isMuted) {
                    heroPlayer.unMute();
                    isMuted = false;
                    muteIcon.className = 'bi bi-volume-up-fill text-xl';
                } else {
                    heroPlayer.mute();
                    isMuted = true;
                    muteIcon.className = 'bi bi-volume-mute-fill text-xl';
                }
            });
        }
    }

    // Hero Stat Counter Animation
    document.addEventListener('DOMContentLoaded', () => {
        const animateHeroStat = (el) => {
            const target = parseFloat(el.getAttribute('data-target'));
            const suffix = el.getAttribute('data-suffix') || '';
            const decimal = parseInt(el.getAttribute('data-decimal')) || 0;
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const update = () => {
                current += step;
                if (current < target) {
                    el.innerText = decimal > 0 ? current.toFixed(decimal) : Math.ceil(current);
                    requestAnimationFrame(update);
                } else {
                    el.innerText = target + suffix;
                }
            };
            update();
        };

        const heroObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateHeroStat(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.hero-stat').forEach(stat => heroObserver.observe(stat));
    });

    // Native Slider Focus
    function initNativeSliderFocus({ sliderId, prevBtnId, nextBtnId, dotsId }) {
        const slider = document.getElementById(sliderId);
        const prevBtn = prevBtnId ? document.getElementById(prevBtnId) : null;
        const nextBtn = nextBtnId ? document.getElementById(nextBtnId) : null;
        const dotsContainer = dotsId ? document.getElementById(dotsId) : null;

        if (!slider) return;
        const cards = slider.querySelectorAll('.snap-center');
        if (cards.length === 0) return;

        if (dotsContainer) {
            dotsContainer.innerHTML = '';
            cards.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.className = 'slider-dot w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none';
                dot.addEventListener('click', () => {
                    const scrollPos = cards[index].offsetLeft - slider.offsetLeft;
                    slider.scrollTo({ left: scrollPos, behavior: 'smooth' });
                });
                dotsContainer.appendChild(dot);
            });
        }

        const updateNativeFocus = () => {
            if (!slider || cards.length === 0) return;
            const scrollLeft = slider.scrollLeft;
            const cardDistance = cards.length > 1 ? (cards[1].offsetLeft - cards[0].offsetLeft) : cards[0].offsetWidth;
            let activeIndex = Math.round(scrollLeft / cardDistance);
            if (activeIndex >= cards.length) activeIndex = cards.length - 1;
            if (activeIndex < 0) activeIndex = 0;

            cards.forEach((card, index) => {
                if (index === activeIndex) {
                    card.classList.add('active-slide');
                } else {
                    card.classList.remove('active-slide');
                }
            });

            if (dotsContainer) {
                const dots = dotsContainer.children;
                Array.from(dots).forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.className = 'slider-dot w-6 h-2 rounded-full bg-holiday focus:outline-none shadow-md shadow-holiday/50';
                    } else {
                        dot.className = 'slider-dot w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none';
                    }
                });
            }
        };

        slider.addEventListener('scroll', updateNativeFocus);
        window.addEventListener('resize', updateNativeFocus);
        setTimeout(updateNativeFocus, 100);

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => {
                const cardDistance = cards.length > 1 ? (cards[1].offsetLeft - cards[0].offsetLeft) : cards[0].offsetWidth;
                slider.scrollBy({ left: -cardDistance, behavior: 'smooth' });
            });
            nextBtn.addEventListener('click', () => {
                const cardDistance = cards.length > 1 ? (cards[1].offsetLeft - cards[0].offsetLeft) : cards[0].offsetWidth;
                slider.scrollBy({ left: cardDistance, behavior: 'smooth' });
            });
        }
    }

    initNativeSliderFocus({ sliderId: 'paket-slider', prevBtnId: 'btn-prev-paket', nextBtnId: 'btn-next-paket', dotsId: 'dots-paket' });
    initNativeSliderFocus({ sliderId: 'slider-armada', prevBtnId: 'btn-prev-armada', nextBtnId: 'btn-next-armada', dotsId: 'dots-armada' });
</script>
@endpush
