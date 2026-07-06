@extends('layouts.admin')

@section('title', 'Edit Destinasi')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.destinasi.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Edit Destinasi</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <form action="{{ route('admin.destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('kategori') border-red-500 @enderror">
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori', $destinasi->kategori) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $destinasi->nama) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('nama') border-red-500 @enderror">
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $destinasi->lokasi) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('lokasi') border-red-500 @enderror">
                @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" name="harga" value="{{ old('harga', $destinasi->harga) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('harga') border-red-500 @enderror">
                @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <input type="hidden" name="image_id" id="image_id_input" value="{{ old('image_id', $destinasi->image_id) }}">
                
                <div class="flex items-center gap-4">
                    <div id="image_preview_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center">
                        @if($destinasi->image)
                            <img id="image_preview_img" src="{{ $destinasi->image->url }}" class="w-full h-full object-cover">
                            <i class="bi bi-image text-gray-400 text-2xl hidden" id="image_placeholder_icon"></i>
                        @else
                            <img id="image_preview_img" class="w-full h-full object-cover hidden">
                            <i class="bi bi-image text-gray-400 text-2xl" id="image_placeholder_icon"></i>
                        @endif
                    </div>
                    <div>
                        <button type="button" onclick="openImagePicker(handleImageSelect)" class="px-4 py-2 bg-holiday text-white rounded-lg text-sm font-semibold hover:bg-holiday-dark transition shadow-sm">
                            <i class="bi bi-image mr-1"></i> Pilih Gambar
                        </button>
                        <p class="text-xs text-gray-500 mt-2 max-w-sm">Pilih gambar dari galeri atau upload baru melalui popup.</p>
                    </div>
                </div>
                @error('image_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('status') border-red-500 @enderror">
                    <option value="aktif" {{ old('status', $destinasi->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $destinasi->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                <select name="durasi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('durasi') border-red-500 @enderror">
                    <option value="">Pilih Durasi</option>
                    @foreach($durasiList as $durasi)
                        <option value="{{ $durasi }}" {{ old('durasi', $destinasi->durasi) == $durasi ? 'selected' : '' }}>{{ $durasi }}</option>
                    @endforeach
                </select>
                @error('durasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mood</label>
                <select name="mood" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('mood') border-red-500 @enderror">
                    <option value="">Pilih Mood</option>
                    @foreach($moodList as $mood)
                        <option value="{{ $mood }}" {{ old('mood', $destinasi->mood) == $mood ? 'selected' : '' }}>{{ $mood }}</option>
                    @endforeach
                </select>
                @error('mood') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <input type="text" name="rating" value="{{ old('rating', $destinasi->rating) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('rating') border-red-500 @enderror">
                @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Update</button>
                <a href="{{ route('admin.destinasi.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>

@include('admin.components.image-picker')

@push('scripts')
<script>
    function handleImageSelect(image) {
        document.getElementById('image_id_input').value = image.id;
        
        const previewImg = document.getElementById('image_preview_img');
        const icon = document.getElementById('image_placeholder_icon');
        
        previewImg.src = image.url;
        previewImg.classList.remove('hidden');
        icon.classList.add('hidden');
    }
</script>
@endpush
@endsection
