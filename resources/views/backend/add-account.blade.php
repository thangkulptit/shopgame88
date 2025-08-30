@extends('backend.master');
@section('main')
@section('title', 'Add Account')
@section('name_page', 'Account')
@include('errors.error')
<style>
    /* CSS cải thiện cho upload nhiều ảnh - thay thế đoạn addStyles() */
    .image-preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 8px;
        margin-top: 15px;
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .image-preview-item {
        position: relative;
        width: 100%;
        height: 100px;
        border: 2px solid #dee2e6;
        border-radius: 6px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .image-preview-item:hover {
        border-color: #007bff;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.15);
        transform: translateY(-2px);
    }

    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-preview-item:hover img {
        transform: scale(1.05);
    }

    .image-remove-btn {
        position: absolute;
        top: 3px;
        right: 3px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        cursor: pointer;
        font-size: 10px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .image-preview-item:hover .image-remove-btn {
        opacity: 1;
    }

    .image-remove-btn:hover {
        background: #c82333;
        transform: scale(1.1);
    }

    .image-file-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
        padding: 2px 4px;
        font-size: 8px;
        text-align: center;
        line-height: 1.1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-preview-item:hover .image-file-info {
        opacity: 1;
    }

    /* Upload messages */
    .upload-message {
        margin-top: 10px;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 13px;
        line-height: 1.4;
        position: relative;
    }

    .upload-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-left: 4px solid #dc3545;
    }

    .upload-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-left: 4px solid #28a745;
    }

    /* Progress bar */
    .upload-progress {
        width: 100%;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 10px;
        display: none;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .upload-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #28a745, #20c997, #007bff);
        background-size: 200% 100%;
        width: 0%;
        transition: width 0.4s ease;
        animation: progressGradient 2s ease-in-out infinite;
        border-radius: 4px;
    }

    @keyframes progressGradient {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    /* File input styling */
    #file {
        padding: 8px 12px;
        border: 2px dashed #ced4da;
        border-radius: 6px;
        background: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    #file:hover {
        border-color: #007bff;
        background: #e3f2fd;
    }

    #file:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .image-preview-container {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 6px;
            max-height: 300px;
            padding: 8px;
        }

        .image-preview-item {
            height: 80px;
        }

        .image-remove-btn {
            width: 16px;
            height: 16px;
            font-size: 9px;
            opacity: 1;
            /* Luôn hiện trên mobile */
        }

        .image-file-info {
            font-size: 7px;
            opacity: 1;
            /* Luôn hiện trên mobile */
        }
    }

    @media (max-width: 480px) {
        .image-preview-container {
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 4px;
            max-height: 250px;
            padding: 6px;
        }

        .image-preview-item {
            height: 60px;
        }

        .upload-message {
            font-size: 12px;
            padding: 6px 10px;
        }
    }

    /* Scrollbar styling cho container */
    .image-preview-container::-webkit-scrollbar {
        width: 6px;
    }

    .image-preview-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .image-preview-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .image-preview-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Loading state */
    .image-preview-item.loading {
        background: linear-gradient(45deg, #f8f9fa 25%, #e9ecef 25%, #e9ecef 50%, #f8f9fa 50%, #f8f9fa 75%, #e9ecef 75%);
        background-size: 20px 20px;
        animation: loadingStripes 1s linear infinite;
    }

    @keyframes loadingStripes {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 20px 20px;
        }
    }

    /* Counter cho số ảnh */
    .image-count-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #007bff;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Empty state */
    .image-preview-container:empty::before {
        content: "Chưa có ảnh nào được chọn";
        display: block;
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 40px 20px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>') no-repeat center top;
        background-size: 32px 32px;
        padding-top: 50px;
    }
</style>
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <strong>Add Account</strong>
                <small>Form</small>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <!-- /.row-->
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ccmonth">Type Account</label>
                            <select class="form-control" id="sel1" name="type_account">
                                @foreach ($type_account as $rows)
                                    <option @if (!empty($account) && $account->type_account == $rows->ta_id) selected @endif
                                        value="{{ $rows->ta_id }}">
                                        {{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.row-->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" type="text"
                                    value="{{ isset($account->username) ? $account->username : '' }}" name="username"
                                    placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" name="password"
                                    value="{{ isset($account->password) ? $account->password : '' }}" type="text"
                                    placeholder="Password | Password 2" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="content">Nội dung mô tả</label>
                            <input class="form-control" id="content" type="text"
                                value="{{ isset($account->content) ? $account->content : '' }}" name="content"
                                placeholder="Trắng Thông Tin">
                        </div>
                        <!-- /.row-->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="url_image">Url Ảnh</label>
                                <input class="form-control" id="url_image" type="text"
                                    value="{{ isset($account->url_image) ? $account->url_image : '' }}" name="url_image"
                                    placeholder="Ảnh 1 | Ảnh 2 | ...">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Upload nhiều ảnh</label>
                                <input type="file" name="url_images[]" id="file-input-hehe" multiple accept="image/*">
                                <div id="file-info"></div>
                                <div class="upload-progress" id="upload-progress">
                                    <div class="progress-bar" id="progress-bar"></div>
                                </div>
                                <div id="preview-container" class="image-preview-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="vip_name">Víp gì</label>
                                <input class="form-control" id="vip_name"
                                    value="{{ isset($account->vip_name) ? $account->vip_name : '' }}" type="text"
                                    name="vip_name" placeholder="VD: Vip map1401">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="vip_level">Vip Ingame</label>
                                <input class="form-control" id="vip_level"
                                    value="{{ isset($account->vip_level) ? $account->vip_level : '' }}" type="text"
                                    name="vip_level" placeholder="Vip ingame: 1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="vip_main">Acc chuyên</label>
                                <input class="form-control" id="vip_main"
                                    value="{{ isset($account->vip_main) ? $account->vip_main : '' }}" type="text"
                                    name="vip_main" placeholder="Acc chuyên gì">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control" id="price"
                                    value="{{ isset($account->price) ? $account->price : '' }}" type="number"
                                    placeholder="Giá" name="price" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Submit">
                                <input class="btn btn-primary" type="reset" value="Reset">
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
    @if (empty($account))
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>Add Type Account</strong>
                    <small>Form</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="type_account">Type Account</label>
                            <input class="form-control" id="type_account" name="name" type="text"
                                placeholder="Type account" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Thêm">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
<script defer src="{{ asset('/frontend/js/app/upload.js') }}"></script>
@stop