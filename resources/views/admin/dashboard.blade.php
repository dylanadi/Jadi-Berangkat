@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-holiday">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Destinasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalDestinasi }}</p>
                </div>
                <i class="bi bi-geo-alt text-4xl text-holiday"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Artikel</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalArtikel }}</p>
                </div>
                <i class="bi bi-newspaper text-4xl text-blue-500"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Ulasan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUlasan }}</p>
                </div>
                <i class="bi bi-star text-4xl text-yellow-500"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Galeri</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalGaleri }}</p>
                </div>
                <i class="bi bi-images text-4xl text-purple-500"></i>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Kelola Data</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.destinasi.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #2f6f42;">
                        <i class="bi bi-geo-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#2f6f42] transition-colors">Destinasi</p>
                        <p class="text-xs text-gray-500">Kelola Destinasi</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #3b82f6;">
                        <i class="bi bi-newspaper text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#3b82f6] transition-colors">Artikel</p>
                        <p class="text-xs text-gray-500">Kelola Artikel</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #8b5cf6;">
                        <i class="bi bi-images text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#8b5cf6] transition-colors">Galeri</p>
                        <p class="text-xs text-gray-500">Kelola Galeri</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.ulasan.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #eab308;">
                        <i class="bi bi-star text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#eab308] transition-colors">Ulasan</p>
                        <p class="text-xs text-gray-500">Kelola Ulasan</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.halaman.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #14b8a6;">
                        <i class="bi bi-file-text text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#14b8a6] transition-colors">Halaman Statis</p>
                        <p class="text-xs text-gray-500">Kelola Halaman</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.media-sosial.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #ec4899;">
                        <i class="bi bi-share text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#ec4899] transition-colors">Media Sosial</p>
                        <p class="text-xs text-gray-500">Kelola Media Sosial</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.faq.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f97316;">
                        <i class="bi bi-question-circle text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#f97316] transition-colors">FAQ</p>
                        <p class="text-xs text-gray-500">Kelola FAQ</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.pengaturan.index') }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow group">
                <div class="flex flex-col items-center text-center gap-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #6b7280;">
                        <i class="bi bi-gear text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-[#6b7280] transition-colors">Pengaturan</p>
                        <p class="text-xs text-gray-500">Kelola Pengaturan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Destinasi Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="pb-2 font-medium text-gray-600">Nama</th>
                            <th class="pb-2 font-medium text-gray-600">Kategori</th>
                            <th class="pb-2 font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinasiTerbaru as $d)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ $d->nama }}</td>
                            <td class="py-2">{{ $d->kategori }}</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-xs {{ $d->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $d->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-4 text-center text-gray-500">Belum ada destinasi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Artikel Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="pb-2 font-medium text-gray-600">Judul</th>
                            <th class="pb-2 font-medium text-gray-600">Penulis</th>
                            <th class="pb-2 font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikelTerbaru as $a)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ Str::limit($a->judul, 30) }}</td>
                            <td class="py-2">{{ $a->penulis ?? '-' }}</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-xs {{ $a->status === 'terbit' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $a->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-4 text-center text-gray-500">Belum ada artikel</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
