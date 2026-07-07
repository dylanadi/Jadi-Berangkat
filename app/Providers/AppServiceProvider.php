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
        View::composer('*', function ($view) {
            $berandaPage = HalamanStatis::where('tipe', 'beranda')->first();
            $footerData = $berandaPage ? json_decode($berandaPage->konten, true) : [];
            $view->with('footerData', $footerData);
            $view->with('berandaPage', $berandaPage);

            $seoData = SeoSettings::pluck('value', 'key')->toArray();
            $view->with('seoData', $seoData);
        });
    }
}
