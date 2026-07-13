@props([
    'name' => 'image_id',
    'value' => '',
])

@php
    $inputId = 'image_input_' . Str::random(8);
    $imageUrl = '';
    if ($value) {
        if (is_numeric($value)) {
            $image = \App\Models\Image::find($value);
            if ($image) {
                $imageUrl = $image->url;
            }
        } else {
            $imageUrl = asset('storage/' . $value);
        }
    }
@endphp

<input type="hidden" name="{{ $name }}" id="{{ $inputId }}_value" value="{{ $value }}">

<div class="flex items-center gap-4">
    <div id="{{ $inputId }}_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center relative shadow-inner">
        <i class="bi bi-image text-gray-400 text-2xl {{ $imageUrl ? 'hidden' : '' }}" id="{{ $inputId }}_icon"></i>
        <img id="{{ $inputId }}_preview" class="w-full h-full object-cover {{ $imageUrl ? '' : 'hidden' }}" src="{{ $imageUrl }}">
        <!-- Hapus Gambar Button Overlay (Muncul jika ada gambar) -->
        <button type="button" id="{{ $inputId }}_remove" onclick="
            document.getElementById('{{ $inputId }}_value').value = '';
            document.getElementById('{{ $inputId }}_preview').src = '';
            document.getElementById('{{ $inputId }}_preview').classList.add('hidden');
            document.getElementById('{{ $inputId }}_icon').classList.remove('hidden');
            this.classList.add('hidden');
        " class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition {{ $imageUrl ? '' : 'hidden' }}" title="Hapus">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <div>
        <button type="button" onclick="openImagePicker(function(image) { 
            document.getElementById('{{ $inputId }}_value').value = image.id;
            document.getElementById('{{ $inputId }}_preview').src = image.url;
            document.getElementById('{{ $inputId }}_preview').classList.remove('hidden');
            document.getElementById('{{ $inputId }}_icon').classList.add('hidden');
            document.getElementById('{{ $inputId }}_remove').classList.remove('hidden');
        })" class="px-4 py-2 bg-holiday text-white rounded-lg text-sm font-semibold hover:bg-holiday-dark transition shadow-sm flex items-center">
            <i class="bi bi-image mr-2"></i> Pilih Gambar
        </button>
        <p class="text-xs text-gray-500 mt-2 max-w-xs leading-relaxed">Pilih gambar dari galeri atau upload baru melalui popup.</p>
    </div>
</div>
@error($name) <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
