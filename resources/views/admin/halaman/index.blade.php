@extends('layouts.admin')

@section('title', 'Halaman Statis')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Halaman Statis</h1>

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
                        <th class="px-4 py-3 font-medium text-gray-600">Slug</th>
                        <th class="px-4 py-3 font-medium text-gray-600">Tipe</th>
                        <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($halaman as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $item->judul }}</td>
                        <td class="px-4 py-3">{{ $item->slug }}</td>
                        <td class="px-4 py-3">{{ $item->tipe ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.halaman.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada halaman</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
