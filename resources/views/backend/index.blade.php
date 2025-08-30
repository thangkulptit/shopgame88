@extends('backend.master')
@section('title', 'Trang chủ quản trị')
@section('name_page','Home')
@section('main')

<div class="container">
    <form method="POST" action="">
    @csrf

    <label>Tiêu đề:</label>
    <input type="text" name="title" value="{{ $notification->title ?? '' }}" class="form-control">

    <label>Nội dung popup (có thể dùng HTML):</label>
    <textarea name="content" id="content" rows="10" class="form-control">{{ $notification->content ?? '' }}</textarea>

    <label>
        <input type="checkbox" name="is_active" 
            {{ isset($notification) && $notification->is_active ? 'checked' : '' }}>
        Bật thông báo
    </label>

    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
</form>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => {
        console.error(error);
    });
</script>

</div>
@stop