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
                <input type="text" name="platform" value="{{ old('platform', $mediaSosial->platform) }}" {{ strtolower($mediaSosial->platform) === 'whatsapp' ? 'readonly' : '' }} class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('platform') border-red-500 @enderror {{ strtolower($mediaSosial->platform) === 'whatsapp' ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                @if(strtolower($mediaSosial->platform) === 'whatsapp')
                    <p class="text-gray-500 text-xs mt-1">Nama platform khusus WhatsApp tidak bisa diubah.</p>
                @endif
                @error('platform') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                <input type="url" name="link" value="{{ old('link', $mediaSosial->link) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('link') border-red-500 @enderror">
                @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor (Opsional, khusus WhatsApp)</label>
                <input type="text" name="nomor" value="{{ old('nomor', $mediaSosial->nomor) }}" placeholder="e.g. 628123456789" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('nomor') border-red-500 @enderror">
                @error('nomor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                <div class="flex gap-2 items-center">
                    <div id="previewIconMedia" class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-2xl text-holiday shrink-0">
                        <i class="{{ old('ikon', $mediaSosial->ikon ?: 'bi bi-link-45deg') }}"></i>
                    </div>
                    <input type="hidden" name="ikon" id="inputIconMedia" value="{{ old('ikon', $mediaSosial->ikon ?: 'bi bi-link-45deg') }}">
                    <button type="button" onclick="pilihIcon('Media')" class="flex-1 border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                        Pilih Icon
                    </button>
                </div>
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
