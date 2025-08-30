class ImageUploadHandler {
    constructor(fileInputId, options = {}) {
        this.fileInput = document.getElementById(fileInputId);
        if (!this.fileInput) {
            console.error(`Không tìm thấy phần tử input với ID: ${fileInputId}`);
            return;
        }
        this.config = {
            maxFileSize: 10 * 1024 * 1024, // 10MB
            maxFiles: 80,
            convertToJpg: true,
            compressQuality: 0.4,
            jpgQuality: 0.4,
            maxWidth: 600,
            maxHeight: 400,
            backgroundColor: '#FFFFFF',
            allowedTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp'],
            ...options
        };
        this.selectedFiles = [];
        this.previewContainer = this.createPreviewContainer();
        this.init();
    }

    init() {
        if (this.fileInput) {
            this.fileInput.addEventListener('change', (e) => this.handleFileSelect(e));
        }
    }

    createPreviewContainer() {
        let container = document.getElementById('preview-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'preview-container';
            container.className = 'image-preview-container';
            this.fileInput.parentNode.insertBefore(container, this.fileInput.nextSibling);
        }
        return container;
    }

    async handleFileSelect(event) {
        const files = Array.from(event.target.files);
        if (files.length === 0) {
            this.showMessage('Không có file được chọn', 'error');
            return;
        }

        this.clearMessages();
        if (this.selectedFiles.length + files.length > this.config.maxFiles) {
            this.showMessage(`Chỉ được chọn tối đa ${this.config.maxFiles} ảnh`, 'error');
            return;
        }

        this.showProgress(true);
        this.updateProgress(0);

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const progress = ((i + 1) / files.length) * 100;
            this.updateProgress(progress);

            try {
                await this.validateFile(file);
                const processedFile = await this.compressImage(file);
                await this.createPreview(processedFile);
                this.selectedFiles.push(processedFile);
                console.log(`Added file to selectedFiles: ${processedFile.name}`);
            } catch (error) {
                this.showMessage(`Lỗi file ${file.name}: ${error.message}`, 'error');
                console.error('File processing error:', error);
            }
        }

        this.showProgress(false);
        this.updateFileInput();
        this.showMessage(`Đã xử lý ${files.length} ảnh`, 'success');
    }

    async validateFile(file) {
        if (!this.config.allowedTypes.includes(file.type)) {
            throw new Error(`Định dạng không hỗ trợ. Chỉ chấp nhận: JPG, PNG, GIF, WebP, BMP`);
        }
        if (file.size > this.config.maxFileSize) {
            throw new Error(`Kích thước quá lớn. Tối đa: ${this.formatFileSize(this.config.maxFileSize)}`);
        }
    }

    async compressImage(file) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            img.onerror = () => reject(new Error('Không thể tải ảnh'));
            img.onload = () => {
                const { width, height } = this.calculateNewDimensions(
                    img.width,
                    img.height,
                    this.config.maxWidth,
                    this.config.maxHeight
                );

                canvas.width = width;
                canvas.height = height;

                if (this.config.convertToJpg && ['image/png', 'image/gif', 'image/webp'].includes(file.type)) {
                    ctx.fillStyle = this.config.backgroundColor;
                    ctx.fillRect(0, 0, width, height);
                }

                ctx.drawImage(img, 0, 0, width, height);

                const outputType = this.config.convertToJpg ? 'image/jpeg' : file.type;
                const quality = this.config.convertToJpg ? this.config.jpgQuality : this.config.compressQuality;

                canvas.toBlob(
                    (blob) => {
                        if (!blob) return reject(new Error('Không thể nén ảnh'));

                        let newFileName = file.name;
                        if (this.config.convertToJpg && !file.name.toLowerCase().endsWith('.jpg') && !file.name.toLowerCase().endsWith('.jpeg')) {
                            newFileName = file.name.replace(/\.[^/.]+$/, '') + '.jpg';
                        }

                        const processedFile = new File([blob], newFileName, {
                            type: outputType,
                            lastModified: Date.now()
                        });
                        console.log(`File compressed: ${file.name}, Size: ${this.formatFileSize(file.size)} → ${this.formatFileSize(processedFile.size)}, Type: ${processedFile.type}`);
                        resolve(processedFile);
                    },
                    outputType,
                    quality
                );
            };

            img.src = URL.createObjectURL(file);
        });
    }

    calculateNewDimensions(originalWidth, originalHeight, maxWidth, maxHeight) {
        let width = originalWidth;
        let height = originalHeight;

        const widthRatio = maxWidth / width;
        const heightRatio = maxHeight / height;
        const ratio = Math.min(widthRatio, heightRatio);

        if (ratio < 1) {
            width = Math.round(width * ratio);
            height = Math.round(height * ratio);
        }

        return { width, height };
    }

    async createPreview(file) {
        const previewItem = document.createElement('div');
        previewItem.className = 'image-preview-item loading';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);

        const removeBtn = document.createElement('button');
        removeBtn.className = 'image-remove-btn';
        removeBtn.innerHTML = '×';
        removeBtn.type = 'button';
        removeBtn.onclick = () => this.removeFile(file, previewItem);

        const fileInfo = document.createElement('div');
        fileInfo.className = 'image-file-info';
        fileInfo.textContent = `${file.type.replace('image/', '').toUpperCase()} ${this.formatFileSize(file.size)}`;

        previewItem.appendChild(img);
        previewItem.appendChild(removeBtn);
        previewItem.appendChild(fileInfo);

        this.previewContainer.appendChild(previewItem);
        previewItem.classList.remove('loading');
        this.updateImageCounter();
    }

    updateImageCounter() {
        const label = document.querySelector('label[for="file-input-hehe"]');
        if (!label) {
            console.warn('Không tìm thấy label cho input file-input-hehe');
            return;
        }
        const oldCounter = label.querySelector('.image-count-display');
        if (oldCounter) oldCounter.remove();

        if (this.selectedFiles.length > 0) {
            const counter = document.createElement('span');
            counter.className = 'image-count-display';
            counter.textContent = `${this.selectedFiles.length} ảnh`;
            label.appendChild(counter);
        }
    }

    removeFile(file, previewElement) {
        this.selectedFiles = this.selectedFiles.filter(f => f !== file);
        previewElement.remove();
        this.updateFileInput();
        this.updateImageCounter();
    }

    updateFileInput() {
        const dt = new DataTransfer();
        this.selectedFiles.forEach(file => dt.items.add(file));
        this.fileInput.files = dt.files;
        console.log('Files attached to input:', Array.from(dt.files).map(f => f.name));
    }

    showProgress(show) {
        let progressDiv = document.getElementById('upload-progress');
        if (!progressDiv) {
            progressDiv = document.createElement('div');
            progressDiv.id = 'upload-progress';
            progressDiv.className = 'upload-progress';
            progressDiv.innerHTML = '<div id="upload-progress-bar" class="upload-progress-bar"></div>';
            this.fileInput.parentNode.insertBefore(progressDiv, this.previewContainer);
        }
        progressDiv.style.display = show ? 'block' : 'none';
    }

    updateProgress(percent) {
        const progressBar = document.getElementById('upload-progress-bar');
        if (progressBar) {
            progressBar.style.width = `${percent}%`;
        }
    }

    showMessage(message, type) {
        this.clearMessages();
        const messageDiv = document.createElement('div');
        messageDiv.className = `upload-message upload-${type}`;
        messageDiv.textContent = message;
        this.fileInput.parentNode.insertBefore(messageDiv, this.previewContainer);

        if (type === 'success') {
            setTimeout(() => messageDiv.remove(), 3000);
        }
    }

    clearMessages() {
        const messages = this.fileInput.parentNode.querySelectorAll('.upload-message');
        messages.forEach(msg => msg.remove());
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    reset() {
        this.selectedFiles = [];
        this.previewContainer.innerHTML = '';
        this.fileInput.value = '';
        this.clearMessages();
        this.updateImageCounter();
    }

    getFiles() {
        return this.selectedFiles;
    }
}

$(document).ready(function() {
    // Khởi tạo ImageUploadHandler
    const fileInput = document.getElementById('file-input-hehe');
    let imageHandler = null;
    if (fileInput) {
        imageHandler = new ImageUploadHandler('file-input-hehe', {
            maxFileSize: 10 * 1024 * 1024,
            maxFiles: 80,
            convertToJpg: true,
            compressQuality: 0.4,
            jpgQuality: 0.6,
            maxWidth: 1200,
            maxHeight: 800,
            backgroundColor: '#FFFFFF'
        });
    } else {
        console.error('Không tìm thấy input file với ID "file-input-hehe"');
        return;
    }

    // Xử lý sự kiện submit form bằng jQuery
    $('#add-account-submit').on('click', async function(e) {
        e.preventDefault(); // Ngăn form submit mặc định

        const formData = new FormData();
        
        // Thêm các file đã nén từ imageHandler
        if (imageHandler) {
            const files = imageHandler.getFiles();
            console.log('Files to send:', files.map(f => f.name)); // Debug
            if (files.length === 0) {
                console.warn('Không có file nào để gửi');
            }
            files.forEach(file => {
                formData.append('url_images[]', file);
            });
        } else {
            console.error('imageHandler không được khởi tạo');
        }

        // Thêm các trường form khác
        formData.append('type_account', $('[name="type_account"]').val() || '');
        formData.append('username', $('[name="username"]').val() || '');
        formData.append('password', $('[name="password"]').val() || '');
        formData.append('content', $('[name="content"]').val() || '');
        formData.append('url_image', $('[name="url_image"]').val() || '');
        formData.append('vip_name', $('[name="vip_name"]').val() || '');
        formData.append('vip_level', $('[name="vip_level"]').val() || '');
        formData.append('vip_main', $('[name="vip_main"]').val() || '');
        formData.append('price', $('[name="price"]').val() || '');
        formData.append('count_champs', $('[name="count_champs"]').val() || '');
        formData.append('count_ngoc', $('[name="count_ngoc"]').val() || '');
        formData.append('count_skins', $('[name="count_skins"]').val() || '');
        formData.append('rank', $('[name="rank"]').val() || '');
        formData.append('da_quy', $('[name="da_quy"]').val() || '');
        formData.append('url_champs', $('[name="url_champs"]').val() || '');
        formData.append('url_ngocs', $('[name="url_ngocs"]').val() || '');
        formData.append('url_skins', $('[name="url_skins"]').val() || '');
        formData.append('vip_content', $('[name="vip_content"]').val() || '');
        formData.append('_token', $('[name="_token"]').val() || '');

        // Debug FormData
        for (let [key, value] of formData.entries()) {
            console.log(`FormData: ${key} =`, value instanceof File ? value.name : value);
        }

        try {
            const response = await $.ajax({
                url: '/admin/accounts/add',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json'
            });

            if (response.success) {
                imageHandler.showMessage(response.message, 'success');
                window.location.reload();
                $('form[enctype="multipart/form-data"]')[0].reset();
                imageHandler.reset();
            } else {
                throw new Error(response.message || 'Lỗi khi thêm account');
            }
        } catch (error) {
            imageHandler.showMessage(error.message || 'Lỗi không xác định', 'error');
            console.error('AJAX error:', error);
        }
    });
});