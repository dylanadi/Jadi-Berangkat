@extends('layouts.admin')

@section('title', 'Media Sosial')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-semibold text-gray-800">Media Sosial</h1>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 bg-green-100 text-green-700 rounded-lg">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b text-left">
                            <th class="px-4 py-3 font-medium text-gray-600">No</th>
                            <th class="px-4 py-3 font-medium text-gray-600">Platform</th>
                            <th class="px-4 py-3 font-medium text-gray-600">Link</th>
                            <th class="px-4 py-3 font-medium text-gray-600">Ikon</th>
                            <th class="px-4 py-3 font-medium text-gray-600">Aktif</th>
                            <th class="px-4 py-3 font-medium text-gray-600 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mediaSosial as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $item->platform }}</td>
                            <td class="px-4 py-3 max-w-xs truncate">
                                <a href="{{ $item->link }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->link }}</a>
                            </td>
                            <td class="px-4 py-3 text-lg">{{ $item->ikon ? '<i class="bi bi-' . $item->ikon . '"></i>' : '-' }}</td>
                            <td class="px-4 py-3">
                                @if($item->aktif)
                                <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">Ya</span>
                                @else
                                <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.media-sosial.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition text-xs">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.media-sosial.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada media sosial</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Media Sosial</h2>
            <form action="{{ route('admin.media-sosial.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                    <input type="text" name="platform" value="{{ old('platform') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('platform') border-red-500 @enderror">
                    @error('platform') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                    <input type="url" name="link" value="{{ old('link') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('link') border-red-500 @enderror">
                    @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ikon (Bootstrap Icons class)</label>
                    <input type="text" name="ikon" value="{{ old('ikon') }}" placeholder="e.g. instagram, facebook" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-admin-500 focus:border-holiday @error('ikon') border-red-500 @enderror">
                    @error('ikon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }} class="rounded border-gray-300 text-holiday focus:ring-admin-500">
                    <label for="aktif" class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-holiday text-white rounded-lg hover:bg-holiday-dark transition">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
