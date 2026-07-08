@extends('layouts.admin')

@section('title', 'Ulasan')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Ulasan</h1>

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
                        <th class="px-4 py-3 font-medium text-gray-600">Nama User</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Bintang</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Pesan</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Ditampilkan</th>
                        <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ulasan as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{!! $item->nama_user !!}</td>
                        <td class="px-4 py-3">
                            <span class="text-yellow-500">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $item->bintang ? '-fill' : '' }}"></i>
                                @endfor
                            </span>
                        </td>
                        <td class="px-4 py-3 max-w-xs truncate">{{ Str::limit($item->pesan, 60) }}</td>
                        <td class="px-4 py-3">
                            @if($item->ditampilkan)
                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">Ya</span>
                            @else
                            <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">Tidak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.ulasan.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada ulasan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($ulasan->hasPages())
        <div class="p-4 border-t">
            {{ $ulasan->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
