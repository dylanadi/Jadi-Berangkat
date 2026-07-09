@extends('layouts.admin')

@section('title', 'Kelola Kategori - Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kategori</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-holiday text-white px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-holiday-dark transition">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-xl text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50/50 text-gray-900 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold w-24">ID</th>
                    <th class="px-6 py-4 font-semibold w-24 text-center">Icon</th>
                    <th class="px-6 py-4 font-semibold">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($kategoris as $k)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4">{{ $k->id }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mx-auto text-holiday text-xl">
                            <i class="{{ $k->icon }}"></i>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $k->nama_kategori }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button onclick="editKategori({{ $k->id }}, '{{ $k->nama_kategori }}', '{{ $k->icon }}')" class="text-yellow-600 hover:bg-yellow-50 px-3 py-1.5 rounded-lg transition font-medium">Edit</button>
                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md mx-4 overflow-hidden shadow-2xl">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-900">Tambah Kategori</h3>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-gray-700"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="nama_kategori" required class="w-full rounded-xl border-gray-200 focus:border-holiday focus:ring focus:ring-holiday/20 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Icon</label>
                    <div class="flex gap-2 items-center">
                        <div id="previewIconTambah" class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-2xl text-holiday shrink-0">
                            <i class="bi bi-tag"></i>
                        </div>
                        <input type="hidden" name="icon" id="inputIconTambah" value="bi bi-tag">
                        <button type="button" onclick="pilihIcon('Tambah')" class="flex-1 border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                            Pilih Icon
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-holiday text-white px-6 py-2.5 rounded-xl font-bold hover:bg-holiday-dark transition shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md mx-4 overflow-hidden shadow-2xl">
        <form id="formEdit" method="POST">
            @csrf @method('PUT')
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-900">Edit Kategori</h3>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-gray-400 hover:text-gray-700"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="editNama" required class="w-full rounded-xl border-gray-200 focus:border-holiday focus:ring focus:ring-holiday/20 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Icon</label>
                    <div class="flex gap-2 items-center">
                        <div id="previewIconEdit" class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-2xl text-holiday shrink-0">
                            <i class=""></i>
                        </div>
                        <input type="hidden" name="icon" id="inputIconEdit">
                        <button type="button" onclick="pilihIcon('Edit')" class="flex-1 border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                            Pilih Icon
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-holiday text-white px-6 py-2.5 rounded-xl font-bold hover:bg-holiday-dark transition shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@include('admin.components.icon-picker')

<script>
let currentTargetForm = '';

function pilihIcon(target) {
    currentTargetForm = target; // 'Tambah' or 'Edit'
    if (typeof openIconPicker === 'function') {
        openIconPicker(function(icon) {
            document.getElementById('inputIcon' + currentTargetForm).value = icon.class_name;
            document.getElementById('previewIcon' + currentTargetForm).innerHTML = '<i class="' + icon.class_name + '"></i>';
        });
    } else {
        alert('Icon picker component missing');
    }
}

function editKategori(id, nama, icon) {
    document.getElementById('formEdit').action = '/admin/kategori/' + id;
    document.getElementById('editNama').value = nama;
    document.getElementById('inputIconEdit').value = icon;
    document.getElementById('previewIconEdit').innerHTML = '<i class="' + icon + '"></i>';
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endsection
