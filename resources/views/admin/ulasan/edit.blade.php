@extends('layouts.admin')

@section('title', 'Edit Ulasan')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.ulasan.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Edit Ulasan</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.ulasan.update', $ulasan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama User</label>
                <input type="text" name="nama_user" value="{{ old('nama_user', $ulasan->nama_user) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('nama_user') border-red-500 @enderror">
                @error('nama_user') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bintang</label>
                <select name="bintang" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('bintang') border-red-500 @enderror">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('bintang', $ulasan->bintang) == $i ? 'selected' : '' }}>{{ $i }} - {{ ['Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'][$i-1] }}</option>
                    @endfor
                </select>
                @error('bintang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                <textarea name="pesan" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('pesan') border-red-500 @enderror">{{ old('pesan', $ulasan->pesan) }}</textarea>
                @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $ulasan->kategori) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('kategori') border-red-500 @enderror">
                @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Profil (Opsional)</label>
                <input type="hidden" name="image_id" id="image_id_input" value="{{ old('image_id', $ulasan->image_id) }}">
                
                <div class="flex items-center gap-4">
                    <div id="image_preview_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center">
                        @if($ulasan->image)
                            <img id="image_preview_img" src="{{ $ulasan->image->url }}" class="w-full h-full object-cover">
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

            <div class="flex items-center gap-2">
                <input type="checkbox" name="ditampilkan" id="ditampilkan" value="1" {{ old('ditampilkan', $ulasan->ditampilkan) ? 'checked' : '' }} class="rounded border-gray-300 text-holiday focus:ring-admin-500">
                <label for="ditampilkan" class="text-sm font-medium text-gray-700">Ditampilkan</label>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Update</button>
                <a href="{{ route('admin.ulasan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
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
