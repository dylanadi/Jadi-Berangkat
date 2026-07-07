<?php
$dir = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($files as $file) {
    if ($file->isDir() || $file->getExtension() !== 'php') continue;
    $path = $file->getPathname();
    $content = file_get_contents($path);
    $original = $content;
    
    // Find all {{ $var }} not inside an attribute (simplified)
    // We only want to replace specific fields that might contain spans.
    $fields = [
        '\$item->nama',
        '\$item->deskripsi',
        '\$item->deskripsi_singkat',
        '\$item->pesan',
        '\$item->nama_user',
        '\$item->judul',
        '\$item->konten',
        '\$ulasan->pesan',
        '\$ulasan->nama_user',
        '\$paket->nama',
        '\$paket->deskripsi',
        '\$paket->deskripsi_singkat',
        '\$destinasi->nama',
        '\$destinasi->deskripsi',
        '\$destinasi->deskripsi_singkat',
        '\$artikel->judul',
        '\$artikel->konten'
    ];
    
    $pattern = '/([^="\'\w])\{\{\s*(' . implode('|', $fields) . ')(.*?)\s*\}\}/is';
    
    $content = preg_replace_callback($pattern, function($m) {
        return $m[1] . '{!! ' . ltrim($m[2] . $m[3]) . ' !!}';
    }, $content);
    
    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
echo "Done.\n";
