@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Pengaturan Halaman Depan</h1>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Hero Section</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                        <input type="text" name="hero_label" value="{{ old('hero_label', $pengaturan['hero_label'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="hero_judul" value="{{ old('hero_judul', $pengaturan['hero_judul'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="hero_deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">{{ old('hero_deskripsi', $pengaturan['hero_deskripsi'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol (teks)</label>
                        <input type="text" name="hero_btn" value="{{ old('hero_btn', $pengaturan['hero_btn'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Statistik</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statistik 1</label>
                        <input type="text" name="statistik_1" value="{{ old('statistik_1', $pengaturan['statistik_1'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                        <input type="text" name="statistik_1_label" value="{{ old('statistik_1_label', $pengaturan['statistik_1_label'] ?? '') }}" placeholder="Label" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statistik 2</label>
                        <input type="text" name="statistik_2" value="{{ old('statistik_2', $pengaturan['statistik_2'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                        <input type="text" name="statistik_2_label" value="{{ old('statistik_2_label', $pengaturan['statistik_2_label'] ?? '') }}" placeholder="Label" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statistik 3</label>
                        <input type="text" name="statistik_3" value="{{ old('statistik_3', $pengaturan['statistik_3'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                        <input type="text" name="statistik_3_label" value="{{ old('statistik_3_label', $pengaturan['statistik_3_label'] ?? '') }}" placeholder="Label" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">CTA Section</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="cta_judul" value="{{ old('cta_judul', $pengaturan['cta_judul'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="cta_deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">{{ old('cta_deskripsi', $pengaturan['cta_deskripsi'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Footer</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Copyright</label>
                    <input type="text" name="copyright" value="{{ old('copyright', $pengaturan['copyright'] ?? '') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endsection
