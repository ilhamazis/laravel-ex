@props([
    'title' => 'Klik untuk pilih file',
    'subtitle' => 'atau seret file ke sini',
    'support' => null,
])

<div class="upload-draggable">
    <div class="upload-draggable__box">
        <input type="file" class="upload-draggable__file-input" {{ $attributes }}/>
        <label class="upload-draggable__icon">
            <span class="icon icon-cloud-arrow-up"></span>
        </label>
        <h2 class="upload-draggable__title">{{ $title }}</h2>
        <p class="upload-draggable__subtitle">{{ $subtitle }}</p>
        @if($support)
            <p class="upload-draggable__support">{{ $support }}</p>
        @endif
    </div>

    <div class="upload-draggable__uploading">
        <span class="loader"></span> sedang memuat...
    </div>
    <div class="upload-draggable__success">
        Berhasil
    </div>
    <div class="upload-draggable__error">
        Gagal
    </div>
</div>
