@extends('layouts.admin')

@section('title', 'Media Sosial')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Media Sosial</h1>
        @if($mediaSosial->count() < 6)
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">
            <i class="bi bi-plus-lg"></i> Tambah Media Sosial
        </button>
        @endif
    </div>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="flex items-center gap-2 p-4 bg-red-100 text-red-700 rounded-lg">
        <i class="bi bi-x-circle"></i> {{ session('error') }}
    </div>
    @endif

    @if($mediaSosial->count() >= 6)
    <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg text-sm border border-yellow-200 flex items-center">
        <i class="bi bi-info-circle mr-2"></i>Maksimal 6 media sosial sudah tercapai. Hapus salah satu untuk menambahkan yang baru.
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b text-left">
                        <th class="px-4 py-3 font-medium text-gray-600">No</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Platform</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Link</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Ikon</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Aktif</th>
                        <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mediaSosial as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $item->platform }}</td>
                        <td class="px-4 py-3 max-w-xs truncate">
                            <a href="{{ $item->link }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->link }}</a>
                        </td>
                        <td class="px-4 py-3 text-lg">{!! $item->ikon ? '<i class="' . (str_starts_with($item->ikon, 'bi ') ? $item->ikon : (str_starts_with($item->ikon, 'bi-') ? 'bi ' . $item->ikon : 'bi bi-' . $item->ikon)) . '"></i>' : '-' !!}</td>
                        <td class="px-4 py-3">
                            @if($item->aktif)
                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">Ya</span>
                            @else
                            <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">Tidak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.media-sosial.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if(strtolower($item->platform) !== 'whatsapp')
                                <form action="{{ route('admin.media-sosial.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada media sosial</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Media Sosial -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md mx-4 overflow-hidden shadow-2xl">
        <form action="{{ route('admin.media-sosial.store') }}" method="POST">
            @csrf
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-900">Tambah Media Sosial</h3>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-gray-700"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                    <input type="text" name="platform" value="{{ old('platform') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('platform') border-red-500 @enderror">
                    @error('platform') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                    <input type="url" name="link" value="{{ old('link') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('link') border-red-500 @enderror">
                    @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor (Opsional, khusus WhatsApp)</label>
                    <input type="text" name="nomor" value="{{ old('nomor') }}" placeholder="e.g. 628123456789" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('nomor') border-red-500 @enderror">
                    @error('nomor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                    <div class="flex gap-2 items-center">
                        <div id="previewIconMedia" class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-2xl text-holiday shrink-0">
                            <i class="{{ old('ikon', 'bi bi-link-45deg') }}"></i>
                        </div>
                        <input type="hidden" name="ikon" id="inputIconMedia" value="{{ old('ikon', 'bi bi-link-45deg') }}">
                        <button type="button" onclick="pilihIcon('Media')" class="flex-1 border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                            Pilih Icon
                        </button>
                    </div>
                    @error('ikon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }} class="rounded border-gray-300 text-holiday focus:ring-admin-500">
                    <label for="aktif" class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-holiday text-white px-6 py-2.5 rounded-xl font-bold hover:bg-holiday-dark transition shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

@include('admin.components.icon-picker')

@push('scripts')
<script>
    function pilihIcon(target) {
        if (typeof openIconPicker === 'function') {
            openIconPicker(function(icon) {
                document.getElementById('inputIconMedia').value = icon.class_name;
                document.getElementById('previewIconMedia').innerHTML = `<i class="${icon.class_name}"></i>`;
            });
        }
    }
</script>
@endpush
@endsection
