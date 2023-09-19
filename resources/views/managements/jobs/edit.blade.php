@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'Detail Job', 'link' => route('managements.jobs.show', $job)],
        ['title' => 'Edit Job'],
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
            type="text/javascript"
            src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/scripts/choices.min.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/utils/quill-options.js') }}"></script>
        <script>
            const descriptionQuill = document.querySelector('div.text-editor .ql-editor');
            const descriptionTextarea = document.querySelector('#description');

            descriptionQuill.addEventListener('DOMSubtreeModified', () => {
                descriptionTextarea.innerHTML = descriptionQuill.innerHTML;
            });
        </script>
    @endpush
@endonce

<x-app-layout header-static>
    <form action="{{ route('managements.jobs.update', $job) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-nav">
            <div class="form-nav__left">
                <x-link href="{{ route('managements.jobs.show', $job) }}" class="btn btn_outline">
                    <span class="icon icon-arrow-left-mini"></span>
                    <span class="btn__text">Kembali</span>
                </x-link>
            </div>
            <div class="form-nav__middle">
                <x-breadcrumb-form :paths="$paths"/>
            </div>
            <div class="form-nav__right">
                <div class="form-nav__wrapper">
                    <span class="form-nav__timestamp">
                        <span class="icon icon-check"></span>
                        Disimpan {{ $job->updated_at->diffForHumans() }}
                    </span>
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
                        <h1 class="main__title">Edit Job</h1>
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
                                            Posisi<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('title')])>
                                            <input type="text" id="title" name="title"
                                                   class="form-control__input"
                                                   value="{{ old('title', $job->title) }}"
                                                   placeholder="Masukkan posisi" required>
                                            <span data-clear="input"></span>
                                        </div>
                                        @error('title')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="description" class="form-control__label">
                                            Deskripsi<span class="important">*</span>
                                        </label>
                                        <div class="text-editor">{!! old('description', $job->description) !!}</div>
                                        <textarea id="description" name="description"
                                                  style="display: none">{!! old('description', $job->description) !!}</textarea>
                                        @error('description')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="type" class="form-control__label">
                                            Tipe Pekerjaan<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('type')])>
                                            <select
                                                x-init="initChoicesSearch($el)"
                                                data-placeholder="Cari tipe pekerjaan..."
                                                id="type"
                                                name="type"
                                                required
                                            >
                                                <option @selected(is_null(old('type'))) disabled>Tipe Pekerjaan</option>
                                                @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                                    <option
                                                        @selected(old('type', $job->type->value) === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('type')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="status" class="form-control__label">
                                            Status<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('status')])>
                                            <select
                                                x-init="initChoicesSearch($el)"
                                                data-placeholder="Cari status pekerjaan..."
                                                id="status"
                                                name="status"
                                                required
                                            >
                                                <option @selected(is_null(old('status'))) disabled>Status</option>
                                                @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                                    <option
                                                        @selected(old('status', $job->status->value) === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('status')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="start_at" class="form-control__label">Mulai</label>
                                        <div @class(['form-control__group', 'error' => $errors->has('start_at')])>
                                            <input type="date" id="start_at" name="start_at" class="form-control__input"
                                                   value="{{ old('start_at', $job->start_at) }}">
                                        </div>
                                        @error('start_at')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="end_at" class="form-control__label">Selesai</label>
                                        <div @class(['form-control__group', 'error' => $errors->has('end_at')])>
                                            <input type="date" id="end_at" name="end_at" class="form-control__input"
                                                   value="{{ old('end_at', $job->end_at) }}">
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
        </div>
    </form>
</x-app-layout>
