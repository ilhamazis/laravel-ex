@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'Detail Job', 'link' => route('managements.jobs.show', $job)],
        ['title' => 'Edit Job'],
    ];
@endphp

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
                                            <x-input type="text" id="title" name="title"
                                                     value="{{ old('title', $job->title) }}"
                                                     placeholder="Masukkan posisi" required/>
                                            <span data-clear="input"></span>
                                        </div>
                                        @error('title')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div x-data="{ textareaValue: '' }" class="form-control">
                                        <label for="description" class="form-control__label">
                                            Deskripsi<span class="important">*</span>
                                        </label>
                                        <x-quill
                                            id="descriptionQuill">{!! old('description', $job->description) !!}</x-quill>
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
                                            <x-select variant="single-search" placeholder="Cari tipe pekerjaan..."
                                                      id="type" name="type" required>
                                                <option @selected(is_null(old('type'))) disabled>Tipe Pekerjaan</option>
                                                @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                                    <option
                                                        @selected(old('type', $job->type->value) === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                                                @endforeach
                                            </x-select>
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
                                            <x-select variant="single-search" placeholder="Cari status pekerjaan..."
                                                      id="status" name="status" required>
                                                <option @selected(is_null(old('status'))) disabled>Status</option>
                                                @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                                    <option
                                                        @selected(old('status', $job->status->value) === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                                @endforeach
                                            </x-select>
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
                                            <x-input type="date" id="start_at" name="start_at"
                                                     value="{{ old('start_at', $job->start_at->format('Y-m-d')) }}"/>
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
                                            <x-input type="date" id="end_at" name="end_at"
                                                     value="{{ old('end_at', $job->end_at->format('Y-m-d')) }}"/>
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

    @push('custom-scripts')
        <script>
            const descriptionQuill = document.querySelector('#descriptionQuill .ql-editor');
            const descriptionTextarea = document.querySelector('#description');

            descriptionQuill.addEventListener('DOMSubtreeModified', () => {
                descriptionTextarea.innerHTML = descriptionQuill.innerHTML;
            });
        </script>
    @endpush
</x-app-layout>
