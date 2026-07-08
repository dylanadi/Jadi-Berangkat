<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$images = \App\Models\Image::where('disk', 'local')->get();
if (!is_dir(storage_path('app/public/uploads'))) {
    mkdir(storage_path('app/public/uploads'), 0777, true);
}
foreach($images as $img) {
    $filename = basename($img->path);
    $oldPath = public_path($img->path);
    $newPathRelative = 'uploads/' . $filename;
    $newPathAbs = storage_path('app/public/' . $newPathRelative);
    if(file_exists($oldPath)) {
        copy($oldPath, $newPathAbs);
        echo "Copied {$filename}\n";
    }
    $img->update([
        'path' => $newPathRelative,
        'disk' => 'public'
    ]);
}
echo "Migration complete.\n";
