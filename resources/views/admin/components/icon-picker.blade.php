<div id="admin-icon-picker-modal" class="fixed inset-0 z-[100] bg-black/60 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-4xl mx-4 overflow-hidden flex flex-col max-h-[90vh] shadow-2xl">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <i class="bi bi-star-fill text-yellow-500"></i> Pilih Ikon
            </h3>
            <button onclick="closeIconPicker()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-200 hover:text-gray-700 transition">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 flex-1 overflow-hidden flex flex-col gap-4">
            <!-- Search -->
            <div class="relative">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="icon-picker-search" class="w-full pl-11 pr-4 py-3 rounded-xl border-gray-200 focus:border-[#2f6f42] focus:ring focus:ring-[#2f6f42]/20 transition text-sm" placeholder="Cari nama ikon... (contoh: star, arrow)">
            </div>

            <!-- Loading State -->
            <div id="icon-picker-loading" class="flex-1 flex flex-col items-center justify-center text-gray-400">
                <i class="bi bi-arrow-clockwise animate-spin text-3xl mb-2"></i>
                <p class="text-sm">Memuat ikon...</p>
            </div>

            <!-- Icon Grid -->
            <div id="icon-picker-grid" class="flex-1 overflow-y-auto grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-3 pr-2 hidden content-start">
                <!-- Icons will be rendered here -->
            </div>
        </div>
    </div>
</div>

<script>
    let iconPickerModalEl;
    let iconPickerGrid;
    let iconPickerSearch;
    let iconPickerLoading;
    let onIconSelectCallback = null;
    let allBootstrapIcons = [];
    let isIconsLoaded = false;

    document.addEventListener('DOMContentLoaded', function() {
        iconPickerModalEl = document.getElementById('admin-icon-picker-modal');
        iconPickerGrid = document.getElementById('icon-picker-grid');
        iconPickerSearch = document.getElementById('icon-picker-search');
        iconPickerLoading = document.getElementById('icon-picker-loading');

        iconPickerSearch.addEventListener('input', function(e) {
            const keyword = e.target.value.toLowerCase().trim();
            if (!keyword) {
                renderIcons(allBootstrapIcons);
                return;
            }
            const filtered = allBootstrapIcons.filter(icon => icon.includes(keyword));
            renderIcons(filtered);
        });

        // Close on outside click
        iconPickerModalEl.addEventListener('click', function(e) {
            if (e.target === iconPickerModalEl) closeIconPicker();
        });
    });

    function loadBootstrapIcons() {
        if (isIconsLoaded) return;
        iconPickerLoading.classList.remove('hidden');
        iconPickerGrid.classList.add('hidden');

        fetch('https://unpkg.com/bootstrap-icons@1.11.3/font/bootstrap-icons.json')
            .then(res => res.json())
            .then(data => {
                allBootstrapIcons = Object.keys(data);
                isIconsLoaded = true;
                iconPickerLoading.classList.add('hidden');
                iconPickerGrid.classList.remove('hidden');
                renderIcons(allBootstrapIcons);
            })
            .catch(err => {
                console.error("Gagal memuat ikon:", err);
                iconPickerLoading.innerHTML = '<div class="text-red-500"><i class="bi bi-exclamation-triangle block text-3xl mb-2"></i> Gagal memuat ikon. Pastikan koneksi internet aktif.</div>';
            });
    }

    function renderIcons(icons) {
        iconPickerGrid.innerHTML = '';
        if (icons.length === 0) {
            iconPickerGrid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-10">Ikon tidak ditemukan</div>';
            return;
        }

        // Untuk performa, limit render jika terlalu banyak saat tidak ada search
        const displayIcons = icons.slice(0, 500); // Limit 500 ikon pertama untuk performa render (jika tidak di-search)

        displayIcons.forEach(iconName => {
            const btn = document.createElement('button');
            btn.className = 'aspect-square rounded-xl border border-gray-100 bg-gray-50 hover:bg-[#2f6f42] hover:text-white hover:border-[#2f6f42] hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center justify-center gap-2 group';
            btn.innerHTML = `<i class="bi bi-${iconName} text-2xl group-hover:scale-110 transition-transform"></i>`;
            btn.title = iconName;

            btn.addEventListener('click', function() {
                selectIcon(`bi bi-${iconName}`);
            });

            iconPickerGrid.appendChild(btn);
        });

        if (icons.length > 500) {
            const more = document.createElement('div');
            more.className = 'col-span-full text-center text-xs text-gray-400 py-2';
            more.textContent = `Menampilkan 500 dari ${icons.length} ikon. Gunakan pencarian untuk hasil lebih spesifik.`;
            iconPickerGrid.appendChild(more);
        }
    }

    function selectIcon(className) {
        const loadingToast = typeof showToast === 'function' ? true : false;
        
        // Simpan ke database via AJAX
        fetch('/admin/save-icon', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ class_name: className })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (onIconSelectCallback) {
                    onIconSelectCallback({
                        id: data.icon_id,
                        class_name: data.class_name
                    });
                }
                closeIconPicker();
            } else {
                if (loadingToast) showToast(data.message || 'Gagal menyimpan ikon', 'error');
                else alert(data.message || 'Gagal menyimpan ikon');
            }
        })
        .catch(err => {
            console.error(err);
            if (loadingToast) showToast('Gagal terhubung ke server', 'error');
            else alert('Gagal terhubung ke server');
        });
    }

    window.openIconPicker = function(callback) {
        onIconSelectCallback = callback;
        iconPickerModalEl.classList.remove('hidden');
        iconPickerModalEl.classList.add('flex');
        iconPickerSearch.value = '';
        loadBootstrapIcons();
        if (isIconsLoaded) renderIcons(allBootstrapIcons); // Reset view
    };

    window.closeIconPicker = function() {
        iconPickerModalEl.classList.add('hidden');
        iconPickerModalEl.classList.remove('flex');
        onIconSelectCallback = null;
    };
</script>
