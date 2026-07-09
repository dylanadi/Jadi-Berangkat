<?php

namespace App\Providers;

use App\Models\HalamanStatis;
use App\Models\SeoSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $globalPengaturan = \App\Models\PengaturanHalamanDepan::pluck('value', 'key')->toArray();
            if (isset($globalPengaturan['timezone']) && $globalPengaturan['timezone']) {
                date_default_timezone_set($globalPengaturan['timezone']);
                \Illuminate\Support\Facades\Config::set('app.timezone', $globalPengaturan['timezone']);
            }
        } catch (\Exception $e) {
            $globalPengaturan = [];
        }

        View::composer('*', function ($view) use ($globalPengaturan) {
            $view->with('globalPengaturan', $globalPengaturan);
            $berandaPage = HalamanStatis::where('tipe', 'beranda')->first();
            $footerData = $berandaPage ? json_decode($berandaPage->konten, true) : [];
            $view->with('footerData', $footerData);
            $view->with('berandaPage', $berandaPage);

            $seoData = SeoSettings::pluck('value', 'key')->toArray();
            $view->with('seoData', $seoData);

            $globalMediaSosial = \App\Models\MediaSosial::where('aktif', true)->get();
            $view->with('globalMediaSosial', $globalMediaSosial);

            $waData = $globalMediaSosial->filter(function($item) { return strtolower($item->platform) == 'whatsapp'; })->first();
            $waNumber = $waData && $waData->nomor ? preg_replace('/[^0-9]/', '', $waData->nomor) : '6285196161351';
            $waLink = $waData ? ($waData->nomor ? 'https://wa.me/' . $waNumber : $waData->link) : 'https://wa.me/6285196161351';
            $view->with('waNumber', $waNumber);
            $view->with('waLink', $waLink);
        });
    }
}
