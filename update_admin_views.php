<?php
$views = [
    'resources/views/admin/galeri/create.blade.php',
    'resources/views/admin/galeri/edit.blade.php',
    'resources/views/admin/artikel/create.blade.php',
    'resources/views/admin/artikel/edit.blade.php',
];

$pickerHtml = <<<'HTML'
                <input type="hidden" name="image_id" id="image_id_input" value="{{ old('image_id', isset($__MODEL__->image_id) ? $__MODEL__->image_id : '') }}">
                
                <div class="flex items-center gap-4">
                    <div id="image_preview_container" class="w-24 h-24 rounded-lg overflow-hidden border border-gray-300 bg-gray-100 flex items-center justify-center">
                        <i class="bi bi-image text-gray-400 text-2xl {{ isset($__MODEL__->image_id) && $__MODEL__->image_id ? 'hidden' : '' }}" id="image_placeholder_icon"></i>
                        <img id="image_preview_img" class="w-full h-full object-cover {{ isset($__MODEL__->image_id) && $__MODEL__->image_id ? '' : 'hidden' }}" src="{{ isset($__MODEL__->image_id) && $__MODEL__->image_id ? $__MODEL__->image->url : '' }}">
                    </div>
                    <div>
                        <button type="button" onclick="openImagePicker(handleImageSelect)" class="px-4 py-2 bg-holiday text-white rounded-lg text-sm font-semibold hover:bg-holiday-dark transition shadow-sm">
                            <i class="bi bi-image mr-1"></i> Pilih Gambar
                        </button>
                        <p class="text-xs text-gray-500 mt-2 max-w-sm">Pilih gambar dari galeri atau upload baru melalui popup.</p>
                    </div>
                </div>
                @error('image_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
HTML;

$pickerInclude = <<<'HTML'
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
HTML;

foreach ($views as $view) {
    $path = __DIR__ . '/' . $view;
    if (!file_exists($path)) continue;
    
    $content = file_get_contents($path);
    $modelName = strpos($view, 'galeri') !== false ? '$galeri' : '$artikel';
    $replacement = str_replace('$__MODEL__', $modelName, $pickerHtml);
    
    // Replace <input type="file" name="gambar" ... > and @error('gambar')
    $content = preg_replace('/<input type="file" name="gambar" [^>]+>[\s\n]*@error\(\'gambar\'\).*?@enderror/is', $replacement, $content);
    
    // Remove the old image preview if it's an edit view
    if (strpos($view, 'edit.blade.php') !== false) {
        // Pattern: @if($model->gambar) ... @endif
        $content = preg_replace('/@if\(\\$[a-z]+->gambar\).*?@endif/is', '', $content);
    }
    
    // Replace enctype="multipart/form-data" with nothing (no longer needed)
    $content = str_replace(' enctype="multipart/form-data"', '', $content);
    
    // Replace @endsection at the very end with the $pickerInclude
    $content = preg_replace('/@endsection$/', $pickerInclude, trim($content));
    
    file_put_contents($path, $content);
    echo "Updated: $path\n";
}

// Ulasan Edit (Wait, I should check if it already has image or just add it)
// Let's not touch ulasan edit for now if they didn't have it, or just add it below pesan?
echo "Done.\n";
