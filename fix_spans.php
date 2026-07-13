<?php
$dir = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($files as $file) {
    if ($file->isDir() || $file->getExtension() !== 'php') continue;
    $path = $file->getPathname();
    $content = file_get_contents($path);
    $original = $content;
    
    // Replace {{ ... }} with {!! ... !!} if it's immediately after a tag with data-edit=
    $content = preg_replace_callback('/(data-edit="[^"]*"[^>]*>)\s*\{\{\s*(.*?)\s*\}\}/is', function($m) {
        return $m[1] . '{!! ' . $m[2] . ' !!}';
    }, $content);

    // Some variables might be inside tags without data-edit but are editable via parent, or maybe the user just used {{ $pengaturan->... }} inline
    // Let's also just replace all {{ $pengaturan->... }} and {{ $data->... }} when NOT inside an HTML attribute
    $content = preg_replace_callback('/([^="\'\w])\{\{\s*(\$pengaturan->.*?|\$data->.*?|\$item->deskripsi.*?|\$item->ulasan.*?|\$ulasan->pesan.*?)\s*\}\}/is', function($m) {
        return $m[1] . '{!! ' . $m[2] . ' !!}';
    }, $content);

    // Also let's check artikel_view.blade.php manually
    if (strpos($path, 'artikel_view.blade.php') !== false) {
        $content = preg_replace('/\{\{\s*(\$artikel->judul|\$artikel->penulis|\$item->judul|\$artikel->konten)\s*\}\}/is', '{!! $1 !!}', $content);
    }
    
    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
echo "Done.\n";
