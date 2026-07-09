@extends('layouts.admin')

@section('title', 'Destinasi')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Destinasi</h1>
        <a href="{{ route('admin.destinasi.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">
            <i class="bi bi-plus-lg"></i> Tambah Destinasi
        </a>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="flex items-center gap-2 p-4 bg-red-100 text-red-700 rounded-lg">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b text-left">
                        <th class="px-4 py-3 font-medium text-gray-600 w-12">No</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Nama</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Kategori</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Status</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Harga</th>
                        <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinasi as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{!! $item->nama !!}</td>
                        <td class="px-4 py-3">{{ $item->kategori->nama_kategori ?? '' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs {{ $item->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada data destinasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($destinasi->hasPages())
        <div class="p-4 border-t">
            {{ $destinasi->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
