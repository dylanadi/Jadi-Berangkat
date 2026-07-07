@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.galeri.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Galeri</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.galeri.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('kategori') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    <option value="Destinasi" {{ old('kategori') == 'Destinasi' ? 'selected' : '' }}>Destinasi</option>
                    <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Kuliner" {{ old('kategori') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('judul') border-red-500 @enderror">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('slug') border-red-500 @enderror">
                @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                                <input type="hidden" name="image_id" id="image_id_input" value="{{ old('image_id', isset($galeri->image_id) ? $galeri->image_id : '') }}">
                
                <div class="flex items-center gap-4">
                    <div id="image_preview_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center">
                        <i class="bi bi-image text-gray-400 text-2xl {{ isset($galeri->image_id) && $galeri->image_id ? 'hidden' : '' }}" id="image_placeholder_icon"></i>
                        <img id="image_preview_img" class="w-full h-full object-cover {{ isset($galeri->image_id) && $galeri->image_id ? '' : 'hidden' }}" src="{{ isset($galeri->image_id) && $galeri->image_id ? $galeri->image->url : '' }}">
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Simpan</button>
                <a href="{{ route('admin.galeri.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
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