@extends('layouts.admin')

@section('title', 'SEO Settings')

@section('content')
<div class="w-full mx-auto">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">SEO Settings</h1>
    <p class="text-sm text-gray-500 mb-6">Atur meta tag, favicon, logo, dan Open Graph untuk website.</p>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 text-sm font-semibold">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white rounded-lg shadow p-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ $settings['meta_title'] ?? old('meta_title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-holiday focus:border-holiday outline-none">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Meta Description</label>
            <textarea name="meta_description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-holiday focus:border-holiday outline-none">{{ $settings['meta_description'] ?? old('meta_description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Meta Keywords</label>
            <input type="text" name="meta_keywords" value="{{ $settings['meta_keywords'] ?? old('meta_keywords') }}" placeholder="misal: jeep, banyuwangi, wisata" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-holiday focus:border-holiday outline-none">
        </div>

        <hr class="border-gray-200">

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Favicon</label>
            <x-image-input name="favicon" :value="isset($settings['favicon']) ? $settings['favicon'] : ''" />
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Logo Website</label>
            <x-image-input name="logo" :value="isset($settings['logo']) ? $settings['logo'] : ''" />
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Open Graph Image (OG Image)</label>
            <x-image-input name="og_image" :value="isset($settings['og_image']) ? $settings['og_image'] : ''" />
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition font-bold text-sm">Simpan</button>
            <a href="{{ url('/admin') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-semibold">Kembali</a>
        </div>
    </form>
</div>
@endsection
