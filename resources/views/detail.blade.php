@extends('layouts.app')

@section('title', $destinasi->nama . ' - Jadiberangkat')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .detail-hero {
        position: relative; height: 55vh; min-height: 380px;
        overflow: hidden;
    }
    .detail-hero img { width: 100%; height: 100%; object-fit: cover; }
    .detail-hero .overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 60%);
    }
    .detail-hero .hero-bottom {
        position: absolute; bottom: 0; left: 0; right: 0; padding: 30px 24px 20px;
        color: #fff;
    }
    .detail-hero .hero-bottom h1 { font-size: clamp(1.5rem, 3vw, 2.8rem); font-weight: 800; }
    .detail-hero .hero-bottom .meta-row { display: flex; flex-wrap: wrap; gap: 16px; font-size: 14px; opacity: 0.9; margin-top: 6px; }

    .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; border-radius: 50px; background: #fff; color: #2f6f42; font-weight: 600; font-size: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s; }
    .back-btn:hover { background: #2f6f42; color: #fff; }

    .section-title { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 3px solid #2f6f42; display: inline-block; }

    .info-item { display: flex; align-items: flex-start; gap: 12px; padding: 14px 16px; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 10px; }
    .info-item .icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(47,111,66,0.1); display: flex; align-items: center; justify-content: center; font-size: 18px; color: #2f6f42; flex-shrink: 0; }

    .rincian-sidebar { background: #fff; border-radius: 20px; padding: 28px; box-shadow: 0 8px 30px rgba(0,0,0,0.06); position: sticky; top: 24px; }
    .rincian-sidebar .price-main { font-size: 32px; font-weight: 800; color: #2f6f42; }
    .rincian-sidebar .price-main small { font-size: 14px; font-weight: 400; color: #888; }
    .rincian-sidebar .total-row { display: flex; justify-content: space-between; padding: 12px 0; border-top: 1px solid #eee; font-size: 15px; }
    .rincian-sidebar .total-row.grand { font-weight: 700; font-size: 18px; color: #1a1a2e; border-top: 2px solid #2f6f42; }

    .btn-pesan { width: 100%; padding: 16px; border-radius: 14px; background: #2f6f42; color: #fff; font-size: 17px; font-weight: 700; border: none; transition: all 0.3s; cursor: pointer; }
    .btn-pesan:hover { background: #255a35; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(47,111,66,0.3); }

    .include-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; font-size: 14px; color: #444; }
    .include-item i { font-size: 16px; width: 20px; }
    .include-item .bi-check-circle-fill { color: #2f6f42; }
    .include-item .bi-x-circle-fill { color: #e74c3c; }

    .addon-card { border: 2px solid #e8e8e8; border-radius: 14px; padding: 14px; cursor: pointer; transition: all 0.3s; }
    .addon-card:hover, .addon-card.active { border-color: #2f6f42; background: rgba(47,111,66,0.03); }
    .addon-card .form-check-input:checked { background-color: #2f6f42; border-color: #2f6f42; }

    .lainnya-card { border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.06); transition: all 0.4s; }
    .lainnya-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(47,111,66,0.12); }
    .lainnya-card img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.5s; }
    .lainnya-card:hover img { transform: scale(1.05); }
    .lainnya-card .card-body { padding: 14px; }
    .lainnya-card .card-body h4 { font-size: 16px; font-weight: 700; color: #1a1a2e; }
    .lainnya-card .card-body .price { font-size: 16px; font-weight: 700; color: #2f6f42; }
</style>
@endpush

@section('content')
<section class="detail-hero">
    @auth
    <div class="absolute top-4 right-4 z-50">
        <a href="{{ route('admin.destinasi.edit', $destinasi->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2f6f42] text-white text-xs font-bold rounded-full hover:bg-[#255a35] transition shadow-md">
            <i class="bi bi-pencil-square"></i> Edit Destinasi
        </a>
    </div>
    @endauth
    <img src="{{ ($destinasi->image ? $destinasi->image->url : '') }}" alt="{{ $destinasi->nama }}">
    <div class="overlay"></div>
    <div class="hero-bottom max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('destinasi.index') }}" class="back-btn mb-4"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 data-edit="nama" data-edit-type="text" data-edit-route="{{ route('admin.destinasi.edit', $destinasi->id) }}">{!! $destinasi->nama !!}</h1>
        <div class="meta-row">
            @if($destinasi->lokasi)<span data-edit="lokasi" data-edit-type="text" data-edit-route="{{ route('admin.destinasi.edit', $destinasi->id) }}"><i class="bi bi-geo-alt"></i> {{ $destinasi->lokasi }}</span>@endif
            @if($destinasi->kategori)<span><i class="bi bi-tag"></i> {{ $destinasi->kategori->nama_kategori }}</span>@endif
            @if($destinasi->durasi)<span><i class="bi bi-clock"></i> {{ $destinasi->durasi }}</span>@endif
            @if($destinasi->mood)<span><i class="bi bi-emoji-smile"></i> {{ $destinasi->mood }}</span>@endif
            @if($destinasi->rating)<span><i class="bi bi-star-fill text-yellow-400"></i> {{ number_format($destinasi->rating, 1) }}</span>@endif
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">›</span>
        <a href="{{ route('destinasi.index') }}">Destinasi</a>
        <span class="sep">›</span>
        <span>{!! $destinasi->nama !!}</span>
    </nav>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-10">
            <div>
                <h2 class="section-title">Tentang Destinasi</h2>
                <div data-edit="deskripsi" data-edit-type="html" data-edit-route="{{ route('admin.destinasi.edit', $destinasi->id) }}" class="text-gray-600 leading-relaxed text-[15px] space-y-3">
                    {!! nl2br(e($destinasi->deskripsi)) !!}
                </div>
            </div>

            @if($destinasi->jadwalPerjalanan && $destinasi->jadwalPerjalanan->count())
            <div>
                <h2 class="section-title">Jadwal Perjalanan</h2>
                <div class="space-y-3">
                    @foreach($destinasi->jadwalPerjalanan->sortBy('urutan') as $jadwal)
                    <div class="info-item">
                        <div class="icon"><i class="bi bi-map"></i></div>
                        <div>
                            <h4 class="font-bold text-[#1a1a2e] text-[15px]">{{ $jadwal->judul }}</h4>
                            @if($jadwal->deskripsi)
                            <p class="text-gray-500 text-[13px] mt-1">{{ $jadwal->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($destinasi->includes && $destinasi->includes->count())
            <div>
                <h2 class="section-title">Termasuk</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($destinasi->includes as $inc)
                    <div class="include-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ $inc->termasuk }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($destinasi->unIncludes && $destinasi->unIncludes->count())
            <div>
                <h2 class="section-title">Tidak Termasuk</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                    @foreach($destinasi->unIncludes as $un)
                    <div class="include-item">
                        <i class="bi bi-x-circle-fill"></i>
                        <span>{{ $un->tidak_termasuk }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div>
                <h2 class="section-title">Tambahan Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="addonContainer">
                    <label class="addon-card flex items-center gap-3">
                        <input type="checkbox" class="form-check-input w-5 h-5 rounded border-gray-300 text-[#2f6f42] focus:ring-[#2f6f42]" onchange="updateTotal()">
                        <div>
                            <div class="font-semibold text-[#1a1a2e] text-sm">Asuransi Perjalanan</div>
                            <div class="text-xs text-gray-400">Perlindungan penuh selama perjalanan</div>
                        </div>
                        <div class="ml-auto font-bold text-[#2f6f42] text-sm">Rp 50K</div>
                    </label>
                    <label class="addon-card flex items-center gap-3">
                        <input type="checkbox" class="form-check-input w-5 h-5 rounded border-gray-300 text-[#2f6f42] focus:ring-[#2f6f42]" onchange="updateTotal()">
                        <div>
                            <div class="font-semibold text-[#1a1a2e] text-sm">Dokumentasi Drone</div>
                            <div class="text-xs text-gray-400">Video & foto udara berkualitas</div>
                        </div>
                        <div class="ml-auto font-bold text-[#2f6f42] text-sm">Rp 150K</div>
                    </label>
                    <label class="addon-card flex items-center gap-3">
                        <input type="checkbox" class="form-check-input w-5 h-5 rounded border-gray-300 text-[#2f6f42] focus:ring-[#2f6f42]" onchange="updateTotal()">
                        <div>
                            <div class="font-semibold text-[#1a1a2e] text-sm">Fasilitas BBQ</div>
                            <div class="text-xs text-gray-400">Pengalaman BBQ malam hari</div>
                        </div>
                        <div class="ml-auto font-bold text-[#2f6f42] text-sm">Rp 100K</div>
                    </label>
                    <label class="addon-card flex items-center gap-3">
                        <input type="checkbox" class="form-check-input w-5 h-5 rounded border-gray-300 text-[#2f6f42] focus:ring-[#2f6f42]" onchange="updateTotal()">
                        <div>
                            <div class="font-semibold text-[#1a1a2e] text-sm">Souvenir Eksklusif</div>
                            <div class="text-xs text-gray-400">Cinderamata khas daerah</div>
                        </div>
                        <div class="ml-auto font-bold text-[#2f6f42] text-sm">Rp 75K</div>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <div class="rincian-sidebar">
                <h3 class="text-lg font-bold text-[#1a1a2e] mb-1">Rincian Booking</h3>
                <p class="text-sm text-gray-400 mb-4">{!! $destinasi->nama !!}</p>

                <div class="price-main">Rp {{ number_format($destinasi->harga, 0, ',', '.') }} <small>/orang</small></div>

                <div class="mt-4">
                    <label class="text-sm font-semibold text-gray-600 mb-1 block">Jumlah Peserta</label>
                    <div class="flex items-center gap-3">
                        <button class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition" onclick="adjustQty(-1)">−</button>
                        <span class="text-xl font-bold w-8 text-center" id="qtyDisplay">1</span>
                        <button class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition" onclick="adjustQty(1)">+</button>
                    </div>
                    <input type="hidden" id="qtyInput" value="1">
                </div>

                <div class="mt-4 space-y-1">
                    <div class="total-row"><span>Harga Dasar</span><span id="basePrice" data-price="{{ $destinasi->harga }}">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span></div>
                    <div class="total-row"><span>Tambahan</span><span id="addonTotal">Rp 0</span></div>
                    <div class="total-row grand"><span>Total</span><span id="grandTotal">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span></div>
                </div>

                <button class="btn-pesan mt-6" onclick="pesanSekarang()">
                    <i class="bi bi-whatsapp me-2"></i> Pesan Sekarang
                </button>
                <p class="text-xs text-gray-400 text-center mt-3">* kamu akan diarahkan ke WhatsApp</p>
            </div>
        </div>
    </div>
</section>

@if(isset($lainnya) && $lainnya->count())
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-[#1a1a2e] mb-8 flex items-center gap-2">
            <i class="bi bi-compass text-[#2f6f42]"></i> Jelajahi Trip Lainnya
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($lainnya as $item)
            <a href="{{ route('destinasi.show', $item->slug) }}" class="lainnya-card">
                <img src="{{ ($item->image ? $item->image->url : '') }}" alt="{{ $item->nama }}" loading="lazy">
                <div class="card-body">
                    <h4>{!! $item->nama !!}</h4>
                    <p class="text-xs text-gray-400 flex items-center gap-1 mt-1"><i class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
                    <div class="price mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
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
    gsap.from('.detail-hero .hero-bottom', { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' });
    gsap.from('.rincian-sidebar', { scrollTrigger: { trigger: '.rincian-sidebar', start: 'top 85%' }, opacity: 0, x: 30, duration: 0.6 });

    let qty = 1;
    function adjustQty(delta) {
        qty = Math.max(1, qty + delta);
        document.getElementById('qtyDisplay').textContent = qty;
        document.getElementById('qtyInput').value = qty;
        updateTotal();
    }

    function getAddonTotal() {
        let total = 0;
        document.querySelectorAll('#addonContainer input:checked').forEach(cb => {
            const label = cb.closest('.addon-card');
            const priceText = label.querySelector('.ml-auto').textContent.replace(/[^0-9]/g, '');
            total += parseInt(priceText) || 0;
        });
        return total;
    }

    function updateTotal() {
        const base = parseInt(document.getElementById('basePrice').dataset.price) || 0;
        const addon = getAddonTotal();
        const subtotal = (base + addon) * qty;
        document.getElementById('addonTotal').textContent = 'Rp ' + (addon * qty).toLocaleString('id-ID');
        document.getElementById('grandTotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    function pesanSekarang() {
        const nama = "{{ $destinasi->nama }}";
        const base = parseInt(document.getElementById('basePrice').dataset.price) || 0;
        const addon = getAddonTotal();
        const total = (base + addon) * qty;

        let msg = `Halo, saya ingin memesan trip *${nama}*\n`;
        msg += `Jumlah Peserta: *${qty} orang*\n`;
        msg += `Total: *Rp ${total.toLocaleString('id-ID')}*\n\n`;
        const addons = [];
        document.querySelectorAll('#addonContainer input:checked').forEach(cb => {
            addons.push(cb.closest('.addon-card').querySelector('.font-semibold').textContent.trim());
        });
        if (addons.length) msg += `Tambahan: ${addons.join(', ')}\n`;
        msg += `\nMohon info lebih lanjut. Terima kasih!`;

        const url = `https://wa.me/{{ $waNumber }}?text=${encodeURIComponent(msg)}`;
        window.open(url, '_blank');
    }
</script>
@endpush
@endsection