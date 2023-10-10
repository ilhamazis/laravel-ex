@php
    $paths = [
        ['title' => 'Template', 'link' => route('managements.templates.index')],
        ['title' => 'Ubah Template'],
    ];
@endphp

<x-app-layout header-static>
    <form action="{{ route('managements.templates.update', $template) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-nav">
            <div class="form-nav__left">
                <x-link href="{{ route('managements.templates.index') }}" class="btn btn_outline">
                    <span class="icon icon-arrow-left-mini"></span>
                    <span class="btn__text">Kembali</span>
                </x-link>
            </div>
            <div class="form-nav__middle">
                <x-breadcrumb-form :paths="$paths"/>
            </div>
            <div class="form-nav__right">
                <div class="form-nav__wrapper">
                    <div class="form-nav__button-wrapper">
                        <button type="submit" class="btn btn_primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="main__header">
                <div class="main__location">
                    <x-breadcrumb :paths="$paths"/>

                    <div class="main__wrapper">
                        <h1 class="main__title">Ubah Template</h1>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-12">
                    <div class="card card_form">
                        <div class="card__body">
                            <div class="grid">
                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="title" class="form-control__label">
                                            Judul<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('title')])>
                                            <x-input type="text" id="title" name="title"
                                                     value="{{ old('title', $template->title) }}"
                                                     placeholder="Masukkan judul" required/>
                                            <span data-clear="input"></span>
                                        </div>
                                        @error('title')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="content" class="form-control__label">
                                            Isi template<span class="important">*</span>
                                        </label>
                                        <x-quill id="contentQuill">{!! old('content', $template->content) !!}</x-quill>
                                        <textarea id="content" name="content"
                                                  style="display: none">{!! old('content', $template->content) !!}</textarea>
                                        @error('content')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('custom-scripts')
        <script>
            const contentQuill = document.querySelector('#contentQuill .ql-editor');
            const contentTextarea = document.querySelector('#content');

            contentQuill.addEventListener('DOMSubtreeModified', () => {
                contentTextarea.innerHTML = contentQuill.innerHTML;
            });
        </script>
    @endpush
</x-app-layout>
