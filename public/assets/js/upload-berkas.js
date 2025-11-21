document.addEventListener('DOMContentLoaded', function() {
    const allowedTypes = ['image/jpeg','image/jpg','image/png','application/pdf'];
    const maxSize = 5 * 1024 * 1024; // 5MB
    const docItems = document.querySelectorAll('.doc-item');

    function updateSubmitState() {
        let ok = true;
        docItems.forEach(item => {
            if (item.dataset.required === '1') {
                const input = item.querySelector('.doc-input');
                if (!input.files || input.files.length === 0) ok = false;
            }
        });
        const btn = document.getElementById('uploadAllBtn');
        if (btn) btn.disabled = !ok;
    }

    document.querySelectorAll('.btn-select').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.dataset.target;
            const el = document.getElementById(target);
            if (el) el.click();
        });
    });

    document.querySelectorAll('.doc-input').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            const container = this.closest('.doc-item');
            const previewBox = container.querySelector('.preview-box');
            const filenameBox = container.querySelector('.filename');
            const removeBtn = container.querySelector('.btn-remove');
            const uploadErrors = document.getElementById('uploadErrors');

            if (uploadErrors) {
                uploadErrors.style.display = 'none';
                uploadErrors.innerText = '';
            }

            if (!file) {
                previewBox.innerHTML = '<span class="small text-muted">No file</span>';
                filenameBox.innerText = '';
                if (removeBtn) removeBtn.classList.add('d-none');
                updateSubmitState();
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                if (uploadErrors) {
                    uploadErrors.style.display = 'block';
                    uploadErrors.innerText = 'Tipe file tidak didukung: ' + file.name;
                }
                this.value = '';
                return;
            }

            if (file.size > maxSize) {
                if (uploadErrors) {
                    uploadErrors.style.display = 'block';
                    uploadErrors.innerText = 'Ukuran file terlalu besar (maks 5MB): ' + file.name;
                }
                this.value = '';
                return;
            }

            // Show preview
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.onload = () => URL.revokeObjectURL(img.src);
                previewBox.innerHTML = '';
                previewBox.appendChild(img);
            } else {
                previewBox.innerHTML = '<div class="small text-muted">PDF</div>';
            }

            filenameBox.innerText = file.name + ' (' + Math.round(file.size/1024) + ' KB)';
            if (removeBtn) removeBtn.classList.remove('d-none');
            updateSubmitState();
        });
    });

    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = this.closest('.doc-item');
            const input = container.querySelector('.doc-input');
            input.value = '';
            container.querySelector('.preview-box').innerHTML = '<span class="small text-muted">No file</span>';
            container.querySelector('.filename').innerText = '';
            this.classList.add('d-none');
            updateSubmitState();
        });
    });

    const form = document.getElementById('multiUploadForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const uploadErrors = document.getElementById('uploadErrors');
            if (uploadErrors && uploadErrors.style.display !== 'none') {
                e.preventDefault();
                alert('Perbaiki masalah file sebelum mengirim.');
                return;
            }
            // Let the form submit normally; server will receive files via multipart/form-data
        });
    }

    // Initial state
    updateSubmitState();
});
