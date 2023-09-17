@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'Tambah Job'],
    ];
@endphp

@once
    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.snow.css') }}"/>
        <link rel="stylesheet"
              href="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/styles/choices.min.css') }}"/>
    @endpush

    @push('scripts')
        <script
            src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/scripts/choices.min.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/utils/quill-options.js') }}"></script>
    @endpush
@endonce

<x-app-layout header-static>
    <form action="{{ route('managements.jobs.store') }}" method="post">
        @csrf
        @method('POST')

        <div class="form-nav">
            <div class="form-nav__left">
                <x-link href="{{ route('managements.jobs.index') }}" class="btn btn_outline">
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
                        <h1 class="main__title">Tambah Job</h1>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-12">
                    <div class="card card_form">
                        <div class="card__body">
                            <div class="grid cols-1">
                                <div class="form-control">
                                    <label for="title" class="form-control__label">
                                        Posisi<span class="important">*</span>
                                    </label>
                                    <div @class(['form-control__group', 'error' => $errors->has('title')])>
                                        <input type="text" id="title" name="title"
                                               class="form-control__input"
                                               value="{{ old('title') }}"
                                               placeholder="Masukkan posisi" required>
                                        <span data-clear="input"></span>
                                    </div>
                                    @error('title')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label for="description" class="form-control__label">
                                        Deskripsi<span class="important">*</span>
                                    </label>
                                    <div @class(['form-control__group', 'error' => $errors->has('description')])>
                                        <textarea id="description" name="description"
                                                  class="form-control__input textarea"
                                                  placeholder="Deskripsi job"
                                                  required>{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label for="type" class="form-control__label">
                                        Tipe Pekerjaan<span class="important">*</span>
                                    </label>
                                    <div @class(['form-control__group', 'error' => $errors->has('type')])>
                                        <select
                                            x-init="initChoicesSearch($el, 'Cari tipe pekerjaan...')"
                                            id="type"
                                            name="type"
                                            class="select-search"
                                            required
                                        >
                                            <option @selected(is_null(old('type'))) disabled>Tipe Pekerjaan</option>
                                            @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                                <option
                                                    @selected(old('type') === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('type')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label for="status" class="form-control__label">
                                        Status<span class="important">*</span>
                                    </label>
                                    <div @class(['form-control__group', 'error' => $errors->has('status')])>
                                        <select
                                            x-init="initChoicesSearch($el, 'Cari status pekerjaan...')"
                                            id="status"
                                            name="status"
                                            class="select-search"
                                            required
                                        >
                                            <option @selected(is_null(old('status'))) disabled>Status</option>
                                            @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                                <option
                                                    @selected(old('status') === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('status')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label for="start_at" class="form-control__label">Mulai</label>
                                    <div @class(['form-control__group', 'error' => $errors->has('start_at')])>
                                        <input type="date" id="start_at" name="start_at" class="form-control__input"
                                               value="{{ old('start_at') }}">
                                    </div>
                                    @error('start_at')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label for="end_at" class="form-control__label">Selesai</label>
                                    <div @class(['form-control__group', 'error' => $errors->has('end_at')])>
                                        <input type="date" id="end_at" name="end_at" class="form-control__input"
                                               value="{{ old('end_at') }}">
                                    </div>
                                    @error('end_at')
                                    <div class="form-control__helper error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>