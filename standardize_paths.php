<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Standarisasi path di tabel images ===" . PHP_EOL;
echo "Hapus prefix 'img/' dari record lama (disk=local)" . PHP_EOL . PHP_EOL;

// Ambil semua record dengan path yang diawali 'img/'
$records = DB::table('images')->where('path', 'like', 'img/%')->get();

foreach ($records as $record) {
    $newPath = substr($record->path, 4); // hapus 'img/'
    DB::table('images')->where('id', $record->id)->update([
        'path' => $newPath,
        'disk' => 'public', // standarkan disk juga
    ]);
    echo "ID:{$record->id} | [{$record->path}] → [{$newPath}]" . PHP_EOL;
}

echo PHP_EOL . "Total diupdate: " . count($records) . PHP_EOL;

// Tampilkan hasil akhir
echo PHP_EOL . "=== Hasil akhir semua images ===" . PHP_EOL;
$all = DB::table('images')->orderBy('id')->get();
foreach ($all as $img) {
    echo "ID:{$img->id} | [{$img->path}] | disk:{$img->disk}" . PHP_EOL;
}
