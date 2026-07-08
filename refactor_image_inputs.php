<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views/admin');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;

    // Pattern for the image block
    // <input type="hidden" name="image_id" ...> ... @error('image_id') ... @enderror
    $pattern = '/<input type="hidden" name="image_id"[^>]+value="([^"]+)"[^>]*>.*?@error\(\'image_id\'\).*?@enderror/is';
    
    if (preg_match($pattern, $content, $matches)) {
        $valueStr = $matches[1];
        // Decode HTML entities if any
        $valueStr = html_entity_decode($valueStr);
        // Ensure it's safe to use as an expression in Blade
        // If it's already using {{ ... }}, wait, the regex matched inside value="{{ ... }}".
        // Actually, $matches[1] will literally be the inside of value="", for example:
        // old('image_id', isset($galeri->image_id) ? $galeri->image_id : '')
        // Wait! The regex matches inside the quotes. But in the HTML it's:
        // value="{{ old(...) }}"
        // Let's adjust the regex to capture what's inside {{ }}
        // Or better yet, just extract the string.
    }
    
    // Better regex:
    $pattern = '/<input type="hidden" name="image_id"[^>]+value="\{\{\s*(.+?)\s*\}\}"[^>]*>.*?@error\(\'image_id\'\).*?@enderror/is';
    $content = preg_replace_callback($pattern, function($matches) {
        $valExpr = $matches[1];
        return "<x-image-input name=\"image_id\" :value=\"$valExpr\" />";
    }, $content);

    // Remove the trailing scripts and include
    $content = preg_replace('/@include\(\'admin\.components\.image-picker\'\)/', '', $content);
    $content = preg_replace('/@push\(\'scripts\'\)\s*<script>\s*function handleImageSelect\(image\) \{.*?\}\s*<\/script>\s*@endpush/is', '', $content);
    
    // Some trailing whitespace cleanup
    $content = preg_replace("/\n{3,}/", "\n\n", $content);

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Refactored: $path\n";
    }
}
echo "Done.\n";
