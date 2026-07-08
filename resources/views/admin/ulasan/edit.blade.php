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
                <x-image-input name="image_id" :value="old('image_id', $ulasan->image_id)" />
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

@endsection
