@extends('layouts.admin')

@section('title', 'Pengaturan Utama')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Pengaturan Situs</h1>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Optimasi Gambar</h2>
            <button id="convertWebpBtn" onclick="convertToWebp()" class="px-4 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition text-sm font-semibold flex items-center gap-2">
                <i class="bi bi-images"></i> Konversi ke WebP
            </button>
        </div>
        <div id="webp-result" class="hidden p-4 rounded-lg mb-4 text-sm"></div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Logo Website</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo Full (Desktop)</label>
                        <p class="text-xs text-gray-500 mb-2">Ditampilkan di pojok kiri atas saat di layar besar.</p>
                        <x-image-input name="logo_full" :value="$pengaturan['logo_full'] ?? ''" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo Utama (Mobile / Ikon)</label>
                        <p class="text-xs text-gray-500 mb-2">Ditampilkan saat layar kecil atau pada navigasi sempit.</p>
                        <x-image-input name="logo_utama" :value="$pengaturan['logo_utama'] ?? ''" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text Logo (SEO)</label>
                        <input type="text" name="logo_alt" value="{{ old('logo_alt', $pengaturan['logo_alt'] ?? 'Logo Jadi Berangkat') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                        <p class="text-xs text-gray-500 mt-1">Teks ini akan dibaca oleh mesin pencari Google saat merayapi gambar logo.</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Pengaturan Waktu</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Zona Waktu (Timezone)</label>
                        <select name="timezone" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                            <option value="Asia/Jakarta" {{ (old('timezone', $pengaturan['timezone'] ?? '') == 'Asia/Jakarta') ? 'selected' : '' }}>Asia/Jakarta (WIB)</option>
                            <option value="Asia/Makassar" {{ (old('timezone', $pengaturan['timezone'] ?? '') == 'Asia/Makassar') ? 'selected' : '' }}>Asia/Makassar (WITA)</option>
                            <option value="Asia/Jayapura" {{ (old('timezone', $pengaturan['timezone'] ?? '') == 'Asia/Jayapura') ? 'selected' : '' }}>Asia/Jayapura (WIT)</option>
                            <option value="UTC" {{ (old('timezone', $pengaturan['timezone'] ?? '') == 'UTC') ? 'selected' : '' }}>UTC</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Ini akan mengubah pengaturan zona waktu sistem untuk artikel, komentar, dll.</p>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
<script>
function convertToWebp() {
    const btn = document.getElementById('convertWebpBtn');
    const resultDiv = document.getElementById('webp-result');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i> Memproses...';
    resultDiv.classList.add('hidden');
    
    fetch('{{ route("admin.convert.webp") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        resultDiv.classList.remove('hidden', 'bg-red-50', 'text-red-700', 'bg-green-50', 'text-green-700', 'bg-green-100', 'bg-red-100');
        
        if(data.success) {
            resultDiv.classList.add('bg-green-50', 'text-green-700');
            resultDiv.innerHTML = `
                <div class="font-semibold mb-1"><i class="bi bi-check-circle"></i> Berhasil</div>
                <div>${data.message}</div>
                <div class="mt-2 text-xs">Images converted: ${data.converted}</div>
            `;
        } else {
            resultDiv.classList.add('bg-red-50', 'text-red-700');
            resultDiv.innerHTML = `<i class="bi bi-x-circle"></i> ${data.message || 'Terjadi kesalahan'}`;
        }
    })
    .catch(error => {
        resultDiv.classList.remove('hidden');
        resultDiv.classList.add('bg-red-50', 'text-red-700');
        resultDiv.innerHTML = '<i class="bi bi-x-circle"></i> Terjadi kesalahan koneksi';
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-images"></i> Konversi ke WebP';
    });
}
</script>
@endsection
