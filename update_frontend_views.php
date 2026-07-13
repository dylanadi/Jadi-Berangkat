<?php
$dir = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($files as $file) {
    if ($file->isDir() || $file->getExtension() !== 'php') continue;
    $path = $file->getPathname();
    $content = file_get_contents($path);
    $original = $content;

    // We only replace usages in frontend files, not admin forms yet (we will do admin manually)
    if (strpos($path, 'admin') === false) {
        
        // Pattern 1: asset('img/' . $item->gambar) => $item->image ? $item->image->url : ''
        $content = preg_replace("/asset\('img\/'\s*\.\s*\\$(\w+)->gambar\)/i", "(\$$1->image ? \$$1->image->url : '')", $content);
        
        // Pattern 2: asset($item->gambar) => $item->image ? $item->image->url : ''
        $content = preg_replace("/asset\(\\$(\w+)->gambar\)/i", "(\$$1->image ? \$$1->image->url : '')", $content);
        
        // Pattern 3: $item->gambar (standalone) => $item->image ? $item->image->url : ''
        // (Wait, in some cases it was $item->gambar ? asset(...) : '')
        // Let's replace $item->gambar ? ... : '' entirely
        // Example: {{ $item->gambar ? asset('img/' . $item->gambar) : '' }}
        $content = preg_replace("/\{\{\s*\\$(\w+)->gambar\s*\?\s*asset\([^)]+\)\s*:\s*('\"'|\"\"|'')\s*\}\}/i", "{{ \$$1->image ? \$$1->image->url : '' }}", $content);
        
        // Same for $artikel->gambar
        $content = preg_replace("/\{\{\s*\\$(\w+)->gambar\s*\?\s*asset\([^)]+\)\s*:\s*('\"'|\"\"|'')\s*\}\}/i", "{{ \$$1->image ? \$$1->image->url : '' }}", $content);
        
        // Just directly replace $item->gambar with $item->image?->url (PHP 8 feature) or $item->image->url
        // Actually, $item->image ? $item->image->url : '' is safer if they use old PHP
        // Let's just find {{ asset($item->gambar) }} and replace with {{ $item->image ? $item->image->url : '' }}
        $content = str_replace("{{ asset(\$item->gambar) }}", "{{ \$item->image ? \$item->image->url : '' }}", $content);
        $content = str_replace("{{ asset(\$artikel->gambar) }}", "{{ \$artikel->image ? \$artikel->image->url : '' }}", $content);
        
        // Also check if they used asset('storage/' . $item->gambar)
        $content = str_replace("{{ asset('storage/' . \$item->gambar) }}", "{{ \$item->image ? \$item->image->url : '' }}", $content);

        // Ulasan gambar_profile
        $content = preg_replace("/\{\{\s*\\$(\w+)->gambar_profile\s*\?\s*asset\([^)]+\)\s*:\s*(asset\([^)]+\)|'[^']*'|\"[^\"]*\")\s*\}\}/i", "{{ \$$1->image ? \$$1->image->url : (isset(\$$1->gambar_profile) && !\$$1->image ? asset('img/default-avatar.png') : asset('img/default-avatar.png')) }}", $content);
        
        // And simple occurrences
        $content = str_replace("\$item->gambar", "(\$item->image ? \$item->image->url : '')", $content);
        $content = str_replace("\$artikel->gambar", "(\$artikel->image ? \$artikel->image->url : '')", $content);
        $content = str_replace("\$ulasan->gambar_profile", "(\$ulasan->image ? \$ulasan->image->url : '')", $content);
    }

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
echo "Done.\n";
