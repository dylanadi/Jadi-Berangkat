@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">FAQ</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">
            <i class="bi bi-plus-lg"></i> Tambah FAQ
        </button>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b text-left">
                        <th class="px-4 py-3 font-medium text-gray-600">No</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Judul</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Deskripsi</th>
                        <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faq as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ Str::limit($item->judul, 40) }}</td>
                        <td class="px-4 py-3 max-w-xs truncate">{{ Str::limit($item->deskripsi, 60) }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.faq.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada FAQ</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah FAQ -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md mx-4 overflow-hidden shadow-2xl">
        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-900">Tambah FAQ</h3>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-gray-700"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('judul') border-red-500 @enderror">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-holiday text-white px-6 py-2.5 rounded-xl font-bold hover:bg-holiday-dark transition shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
