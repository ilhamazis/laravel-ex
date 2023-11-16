@props([
    'title' => 'Klik untuk pilih file',
    'subtitle' => 'atau seret file ke sini',
    'support' => null,
])

<div class="upload-draggable upload-draggable_inline">
    <div class="upload-draggable__box-inline">
        <input type="file" class="upload-draggable__file-input" {{ $attributes }}/>
        <div class="upload-draggable__inline-wrapper">
            <label class="upload-draggable__icon">
                <span class="icon icon-cloud-arrow-up"></span>
            </label>
            <div class="upload-draggable__wrapper">
                <h2 class="upload-draggable__title">
                    {{ $title }}
                    <span class="upload-draggable__subtitle">{{ $subtitle }}</span>
                    @if($support)
                        <p class="upload-draggable__support">
                            {{ $support }}
                        </p>
                    @endif
                </h2>
            </div>
        </div>
    </div>
    <div class="upload-draggable__success">
        Berhasil
    </div>
</div>
