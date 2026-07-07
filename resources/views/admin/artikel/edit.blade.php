@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.artikel.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Edit Artikel</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-4xl">
        <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('judul') border-red-500 @enderror">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $artikel->slug) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('slug') border-red-500 @enderror">
                @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-gray-400 text-xs">(WYSIWYG editor recommended)</span></label>
                <textarea name="konten" id="konten" rows="15" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('konten') border-red-500 @enderror">{{ old('konten', $artikel->konten) }}</textarea>
                @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                
                                <input type="hidden" name="image_id" id="image_id_input" value="{{ old('image_id', isset($artikel->image_id) ? $artikel->image_id : '') }}">
                
                <div class="flex items-center gap-4">
                    <div id="image_preview_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center">
                        <i class="bi bi-image text-gray-400 text-2xl {{ isset($artikel->image_id) && $artikel->image_id ? 'hidden' : '' }}" id="image_placeholder_icon"></i>
                        <img id="image_preview_img" class="w-full h-full object-cover {{ isset($artikel->image_id) && $artikel->image_id ? '' : 'hidden' }}" src="{{ isset($artikel->image_id) && $artikel->image_id ? $artikel->image->url : '' }}">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $artikel->kategori) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('kategori') border-red-500 @enderror">
                    @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $artikel->penulis) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('penulis') border-red-500 @enderror">
                    @error('penulis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi Baca (menit)</label>
                    <input type="number" name="durasi_baca" value="{{ old('durasi_baca', $artikel->durasi_baca) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('durasi_baca') border-red-500 @enderror">
                    @error('durasi_baca') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('status') border-red-500 @enderror">
                        <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="terbit" {{ old('status', $artikel->status) == 'terbit' ? 'selected' : '' }}>Terbit</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                    <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit', $artikel->tanggal_terbit ? \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('Y-m-d') : '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('tanggal_terbit') border-red-500 @enderror">
                    @error('tanggal_terbit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Update</button>
                <a href="{{ route('admin.artikel.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
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