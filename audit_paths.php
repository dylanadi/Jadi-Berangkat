<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Semua record di tabel images ===" . PHP_EOL;
$imgs = DB::table('images')->orderBy('id')->get();
foreach ($imgs as $img) {
    echo "ID:{$img->id} | name:{$img->name} | path:[{$img->path}] | disk:{$img->disk}" . PHP_EOL;
}

echo PHP_EOL . "=== Destinasi image_id ===" . PHP_EOL;
$rows = DB::table('destinasi')->select('id','nama','image_id')->get();
foreach ($rows as $r) {
    echo "ID:{$r->id} | {$r->nama} | image_id:{$r->image_id}" . PHP_EOL;
}

echo PHP_EOL . "=== Galeri gambar + image_id ===" . PHP_EOL;
$rows = DB::table('galeri')->select('id','judul','gambar','image_id')->get();
foreach ($rows as $r) {
    echo "ID:{$r->id} | {$r->judul} | gambar:[{$r->gambar}] | image_id:{$r->image_id}" . PHP_EOL;
}

echo PHP_EOL . "=== Artikel gambar + image_id ===" . PHP_EOL;
$rows = DB::table('artikel')->select('id','judul','gambar','image_id')->get();
foreach ($rows as $r) {
    echo "ID:{$r->id} | {$r->judul} | gambar:[{$r->gambar}] | image_id:{$r->image_id}" . PHP_EOL;
}
