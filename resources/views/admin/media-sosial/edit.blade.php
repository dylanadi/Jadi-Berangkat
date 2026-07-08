@extends('layouts.admin')

@section('title', 'Edit Media Sosial')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.media-sosial.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Edit Media Sosial</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('admin.media-sosial.update', $mediaSosial->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                <input type="text" name="platform" value="{{ old('platform', $mediaSosial->platform) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('platform') border-red-500 @enderror">
                @error('platform') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                <input type="url" name="link" value="{{ old('link', $mediaSosial->link) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('link') border-red-500 @enderror">
                @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ikon (Bootstrap Icons class)</label>
                <input type="text" name="ikon" value="{{ old('ikon', $mediaSosial->ikon) }}" placeholder="e.g. instagram, facebook" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('ikon') border-red-500 @enderror">
                @error('ikon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $mediaSosial->aktif) ? 'checked' : '' }} class="rounded border-gray-300 text-holiday focus:ring-admin-500">
                <label for="aktif" class="text-sm font-medium text-gray-700">Aktif</label>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Update</button>
                <a href="{{ route('admin.media-sosial.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
