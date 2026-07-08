<div id="admin-image-picker-modal" class="fixed inset-0 z-[100] bg-black/60 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-[95%] max-w-3xl max-h-[90vh] flex flex-col shadow-2xl relative overflow-hidden">
        
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-xl font-extrabold text-gray-900">Pilih Gambar</h3>
            <button type="button" id="admin-picker-close-btn" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 hover:bg-red-100 hover:text-red-600 transition-colors">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="p-6 flex-1 overflow-hidden flex flex-col">
            <div class="flex gap-2 mb-6">
                <button type="button" id="admin-picker-tab-gallery" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-holiday text-white shadow-md hover:bg-holiday-dark transition-colors">Galeri</button>
                <button type="button" id="admin-picker-tab-upload" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition-colors">Upload Baru</button>
            </div>

            <!-- Gallery View -->
            <div id="admin-picker-gallery-view" class="flex-1 overflow-y-auto pr-2 no-scrollbar">
                <div id="admin-picker-gallery-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 pb-4">
                    <div class="col-span-full text-center py-12 text-gray-400 text-sm flex flex-col items-center">
                        <i class="bi bi-arrow-clockwise animate-spin text-3xl mb-3"></i> Memuat gambar...
                    </div>
                </div>
            </div>

            <!-- Upload View -->
            <div id="admin-picker-upload-view" class="hidden flex-1 overflow-y-auto no-scrollbar">
                <div id="admin-picker-dropzone" class="border-2 border-dashed border-gray-300 rounded-2xl p-12 text-center cursor-pointer hover:bg-gray-50 hover:border-holiday transition-all group">
                    <div class="w-16 h-16 rounded-full bg-holiday/10 text-holiday flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="bi bi-cloud-upload text-3xl"></i>
                    </div>
                    <p class="text-gray-600 font-semibold mb-1">Tarik file ke sini atau klik untuk memilih</p>
                    <p class="text-gray-400 text-xs">PNG, JPG, WebP — Maks 5MB</p>
                    <input type="file" id="admin-picker-file-input" accept="image/*" class="hidden">
                </div>
                
                <div id="admin-picker-upload-preview" class="hidden mt-6 text-center">
                    <div class="relative inline-block mx-auto max-w-xs shadow-lg rounded-xl overflow-hidden mb-4 border border-gray-100">
                        <img id="admin-picker-preview-img" class="w-full object-cover">
                    </div>
                    
                    <div id="admin-picker-upload-progress" class="hidden w-full max-w-xs mx-auto h-2 bg-gray-100 rounded-full overflow-hidden mb-4">
                        <div class="h-full bg-holiday w-0 transition-all duration-300"></div>
                    </div>
                    
                    <button type="button" id="admin-picker-upload-btn" class="px-6 py-2.5 rounded-xl font-bold bg-holiday text-white hover:bg-holiday-dark shadow-md transition-all">
                        <i class="bi bi-upload mr-2"></i> Upload & Pilih
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gallery-item-group:hover .gallery-item-actions {
        opacity: 1;
    }
</style>

<script>
(function() {
    let modal = document.getElementById('admin-image-picker-modal');
    if (!modal) return;

    let closeBtn = document.getElementById('admin-picker-close-btn');
    let tabGallery = document.getElementById('admin-picker-tab-gallery');
    let tabUpload = document.getElementById('admin-picker-tab-upload');
    let galleryView = document.getElementById('admin-picker-gallery-view');
    let uploadView = document.getElementById('admin-picker-upload-view');
    let galleryGrid = document.getElementById('admin-picker-gallery-grid');
    
    let dropzone = document.getElementById('admin-picker-dropzone');
    let fileInput = document.getElementById('admin-picker-file-input');
    let uploadPreview = document.getElementById('admin-picker-upload-preview');
    let previewImg = document.getElementById('admin-picker-preview-img');
    let uploadProgress = document.getElementById('admin-picker-upload-progress');
    let progressBar = uploadProgress.querySelector('div');
    let uploadBtn = document.getElementById('admin-picker-upload-btn');

    let onSelectCallback = null;

    window.openImagePicker = function(callback) {
        onSelectCallback = callback;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        tabGallery.click();
        loadGallery();
    };

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        
        // Reset upload form
        fileInput.value = '';
        uploadPreview.classList.add('hidden');
        uploadBtn.classList.add('hidden');
        uploadBtn._file = null;
        uploadProgress.classList.add('hidden');
    }

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });

    // Tabs
    tabGallery.addEventListener('click', function() {
        tabGallery.className = "px-5 py-2.5 rounded-xl text-sm font-bold bg-holiday text-white shadow-md transition-colors";
        tabUpload.className = "px-5 py-2.5 rounded-xl text-sm font-bold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition-colors";
        galleryView.classList.remove('hidden');
        uploadView.classList.add('hidden');
        loadGallery();
    });

    tabUpload.addEventListener('click', function() {
        tabUpload.className = "px-5 py-2.5 rounded-xl text-sm font-bold bg-holiday text-white shadow-md transition-colors";
        tabGallery.className = "px-5 py-2.5 rounded-xl text-sm font-bold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition-colors";
        galleryView.classList.add('hidden');
        uploadView.classList.remove('hidden');
    });

    // Upload Drag n Drop
    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', (e) => { e.preventDefault(); dropzone.classList.add('border-holiday', 'bg-gray-50'); });
    dropzone.addEventListener('dragleave', () => { dropzone.classList.remove('border-holiday', 'bg-gray-50'); });
    dropzone.addEventListener('drop', (e) => { 
        e.preventDefault(); 
        dropzone.classList.remove('border-holiday', 'bg-gray-50'); 
        if (e.dataTransfer.files.length) handlePickerFile(e.dataTransfer.files[0]); 
    });
    fileInput.addEventListener('change', function() { if (this.files.length) handlePickerFile(this.files[0]); });

    function handlePickerFile(file) {
        if (!file.type.startsWith('image/')) { alert('Hanya file gambar yang diizinkan'); return; }
        if (file.size > 5 * 1024 * 1024) { alert('Ukuran gambar maksimal 5MB'); return; }
        
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            uploadPreview.classList.remove('hidden');
            uploadBtn.classList.remove('hidden');
            uploadBtn._file = file;
        };
        reader.readAsDataURL(file);
    }

    uploadBtn.addEventListener('click', function() {
        var file = uploadBtn._file;
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);
        // Upload logic
        var xhr = new XMLHttpRequest();
        uploadProgress.classList.remove('hidden');
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="bi bi-arrow-clockwise animate-spin mr-2"></i> Mengupload...';
        
        xhr.open('POST', '/admin/upload-image');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        xhr.setRequestHeader('Accept', 'application/json');
        
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var pct = (e.loaded / e.total) * 100;
                progressBar.style.width = pct + '%';
            }
        };

        xhr.onload = function() {
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="bi bi-upload mr-2"></i> Upload & Pilih';
            uploadProgress.classList.add('hidden');
            
            if (xhr.status === 200 || xhr.status === 201) {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        if (onSelectCallback) {
                            onSelectCallback({
                                id: res.image_id,
                                url: res.url,
                                path: res.path
                            });
                        }
                        closeModal();
                    } else {
                        alert(res.error || 'Gagal upload gambar');
                    }
                } catch(e) { alert('Response tidak valid'); }
            } else if (xhr.status === 422) {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.errors) {
                        alert('Validasi gagal: ' + Object.values(res.errors).join(', '));
                    } else {
                        alert(res.message || 'Validasi gagal');
                    }
                } catch (e) { alert('Validasi gagal'); }
            } else {
                alert('Terjadi kesalahan saat upload (Kode: ' + xhr.status + ')');
            }
        };

        xhr.onerror = function() {
            alert('Koneksi gagal');
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="bi bi-upload mr-2"></i> Upload & Pilih';
        };

        xhr.send(fd);
    });

    // Gallery Logic
    function loadGallery() {
        galleryGrid.innerHTML = '<div class="col-span-full text-center py-12 text-gray-400 text-sm flex flex-col items-center"><i class="bi bi-arrow-clockwise animate-spin text-3xl mb-3"></i> Memuat gambar...</div>';
        
        fetch('/admin/images')
            .then(res => res.json())
            .then(data => {
                galleryGrid.innerHTML = '';
                if (!data.images || data.images.length === 0) {
                    galleryGrid.innerHTML = '<div class="col-span-full text-center py-12 text-gray-500 font-medium">Belum ada gambar</div>';
                    return;
                }
                
                data.images.forEach(item => {
                    // Only show DB images for destinasi, so it can be saved properly (requires ID)
                    if (item.image_id) {
                        var card = document.createElement('div');
                        card.className = "group gallery-item-group relative aspect-square rounded-xl overflow-hidden cursor-pointer bg-gray-100 shadow-sm border border-gray-200 hover:border-holiday hover:shadow-md transition-all";
                        
                        var img = document.createElement('img');
                        img.src = item.url;
                        img.className = "w-full h-full object-cover transition-transform duration-500 group-hover:scale-110";
                        
                        var overlay = document.createElement('div');
                        overlay.className = "absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between";
                        
                        // Select Action overlay
                        var selectOverlay = document.createElement('div');
                        selectOverlay.className = "flex-1 flex items-center justify-center";
                        selectOverlay.innerHTML = '<span class="text-white text-xs font-bold px-3 py-1 bg-holiday/80 backdrop-blur-sm rounded-full">Pilih</span>';
                        selectOverlay.onclick = function(e) {
                            e.stopPropagation();
                            if (onSelectCallback) {
                                onSelectCallback({
                                    id: item.image_id,
                                    url: item.url,
                                    path: item.path
                                });
                            }
                            closeModal();
                        };
                        
                        // Delete Action
                        var delAction = document.createElement('div');
                        delAction.className = "gallery-item-actions opacity-0 absolute top-2 right-2 transition-opacity z-10";
                        delAction.innerHTML = '<button type="button" class="w-8 h-8 rounded-full bg-red-500/90 text-white hover:bg-red-600 flex items-center justify-center shadow-sm backdrop-blur-md transition-all" title="Hapus Gambar"><i class="bi bi-trash-fill text-xs"></i></button>';
                        delAction.onclick = function(e) {
                            e.stopPropagation();
                            if (confirm('Yakin ingin menghapus gambar ini secara permanen?')) {
                                deleteImage(item.image_id, card);
                            }
                        };
                        
                        overlay.appendChild(selectOverlay);
                        
                        card.appendChild(img);
                        card.appendChild(overlay);
                        card.appendChild(delAction);
                        
                        galleryGrid.appendChild(card);
                    }
                });
                
                if (galleryGrid.innerHTML === '') {
                    galleryGrid.innerHTML = '<div class="col-span-full text-center py-12 text-gray-500 font-medium">Belum ada gambar di galeri database</div>';
                }
            })
            .catch(err => {
                galleryGrid.innerHTML = '<div class="col-span-full text-center py-12 text-red-500 text-sm">Gagal memuat galeri.</div>';
            });
    }
    
    function deleteImage(id, cardEl) {
        if (!id) return;
        
        const btn = cardEl.querySelector('button');
        const oldHtml = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-arrow-clockwise animate-spin"></i>';
        btn.disabled = true;
        
        fetch('/admin/delete-image/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                cardEl.remove();
            } else {
                alert('Gagal menghapus: ' + (data.message || 'unknown error'));
                btn.innerHTML = oldHtml;
                btn.disabled = false;
            }
        })
        .catch(err => {
            alert('Koneksi gagal');
            btn.innerHTML = oldHtml;
            btn.disabled = false;
        });
    }
})();
</script>
