@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.galeri.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Edit Galeri</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('kategori') border-red-500 @enderror">
                    <option value="Destinasi" {{ old('kategori', $galeri->kategori) == 'Destinasi' ? 'selected' : '' }}>Destinasi</option>
                    <option value="Kegiatan" {{ old('kategori', $galeri->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Kuliner" {{ old('kategori', $galeri->kategori) == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                    <option value="Lainnya" {{ old('kategori', $galeri->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('judul') border-red-500 @enderror">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $galeri->slug) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('slug') border-red-500 @enderror">
                @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                @if($galeri->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $galeri->gambar) }}" class="h-32 w-32 object-cover rounded-lg">
                </div>
                @endif
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('gambar') border-red-500 @enderror">
                @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Update</button>
                <a href="{{ route('admin.galeri.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
