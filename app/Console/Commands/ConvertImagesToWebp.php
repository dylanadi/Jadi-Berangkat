<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:to-webp {disk? : Disk name (public or local)}';
    protected $description = 'Convert all JPG/PNG images to WebP format';

    public function handle()
    {
        $disk = $this->argument('disk') ?: 'public';
        $diskDriver = Storage::disk($disk);
        $converted = 0;
        $skipped = 0;

        $files = $diskDriver->allFiles();
        $imgExtensions = ['jpg', 'jpeg', 'png'];

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (!in_array($ext, $imgExtensions)) continue;

            $fullPath = $diskDriver->path($file);
            $webpPath = pathinfo($fullPath, PATHINFO_DIRNAME) . '/' . pathinfo($fullPath, PATHINFO_FILENAME) . '.webp';
            $webpRelative = pathinfo($file, PATHINFO_DIRNAME) . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';

            if (file_exists($webpPath)) {
                $this->warn("Skipped (already exists): $webpRelative");
                $skipped++;
                continue;
            }

            $this->info("Converting: $file");

            $image = null;
            if ($ext === 'png') {
                $image = @imagecreatefrompng($fullPath);
            } else {
                $image = @imagecreatefromjpeg($fullPath);
            }

            if (!$image) {
                $this->error("Failed to read: $file");
                continue;
            }

            $result = imagewebp($image, $webpPath, 80);
            imagedestroy($image);

            if ($result) {
                $this->info("Created: $webpRelative");
                $converted++;
            } else {
                $this->error("Failed to convert: $file");
            }
        }

        $publicImgDir = public_path('img');
        if (is_dir($publicImgDir)) {
            foreach (scandir($publicImgDir) as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (!in_array($ext, $imgExtensions)) continue;

                $fullPath = $publicImgDir . '/' . $file;
                $webpPath = $publicImgDir . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';

                if (file_exists($webpPath)) {
                    $this->warn("Skipped (already exists): img/" . pathinfo($file, PATHINFO_FILENAME) . '.webp');
                    $skipped++;
                    continue;
                }

                $this->info("Converting: img/$file");

                $image = null;
                if ($ext === 'png') {
                    $image = @imagecreatefrompng($fullPath);
                } else {
                    $image = @imagecreatefromjpeg($fullPath);
                }

                if (!$image) {
                    $this->error("Failed to read: img/$file");
                    continue;
                }

                $result = imagewebp($image, $webpPath, 80);
                imagedestroy($image);

                if ($result) {
                    $this->info("Created: img/" . pathinfo($file, PATHINFO_FILENAME) . '.webp');
                    $converted++;
                } else {
                    $this->error("Failed to convert: img/$file");
                }
            }
        }

        $this->newLine();
        $this->info("Done! Converted: $converted, Skipped: $skipped");
    }
}
