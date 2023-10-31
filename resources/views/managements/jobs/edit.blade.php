@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'Ubah Data'],
    ];
@endphp

<x-app-layout header-static>
    <form action="{{ route('managements.jobs.update', $job) }}" method="post" enctype="multipart/form-data">
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
                <x-quantum.breadcrumb-form :paths="$paths"/>
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
                    <x-quantum.breadcrumb :paths="$paths"/>

                    <div class="main__wrapper">
                        <h1 class="main__title">Ubah Data</h1>
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
                                            <x-quantum.input type="text" id="title" name="title"
                                                             value="{{ old('title', $job->title) }}"
                                                             placeholder="Masukkan posisi pekerjaan" required/>
                                            <span data-clear="input"></span>
                                        </div>
                                        @error('title')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="banner" class="form-control__label">
                                            Banner
                                        </label>

                                        <div
                                            style="display: block;
                                                    margin-bottom: 1rem;
                                                    margin-right: auto;
                                                    margin-left: auto"
                                        >
                                            <img id="banner-preview" src="{{ asset('storage/' . $job->banner) }}"
                                                 alt="Job banner"/>
                                        </div>

                                        <x-quantum.input-file
                                            name="banner"
                                            id="banner" accept=".jpg,.jpeg,.png,.bmp,.gif,.svg,.webp"
                                            value="{{ old('banner') }}"
                                            title="Klik untuk ubah banner"
                                            support="JPG, PNG, BMP, GIF, SVG, atau WEBP (max. 500KB)"
                                        />
                                        @error('banner')
                                        <div class="form-control__h elper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div x-data="{ textareaValue: '' }" class="form-control">
                                        <label for="description" class="form-control__label">
                                            Deskripsi<span class="important">*</span>
                                        </label>
                                        <x-quantum.rich-text-editor id="description" name="description"
                                                                    :value="old('description', $job->description)"/>
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
                                            <x-quantum.select variant="single-search"
                                                              placeholder="Cari tipe pekerjaan..."
                                                              id="type" name="type" required>
                                                <option @selected(is_null(old('type'))) disabled>Tipe Pekerjaan</option>
                                                @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                                    <option
                                                        @selected(old('type', $job->type->value) === $typeEnum)
                                                        value="{{ $typeEnum }}"
                                                    >
                                                        {{ $typeEnum }}
                                                    </option>
                                                @endforeach
                                            </x-quantum.select>
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
                                            <x-quantum.select variant="single-search"
                                                              placeholder="Cari status pekerjaan..."
                                                              id="status" name="status" required>
                                                <option @selected(is_null(old('status'))) disabled>Status</option>
                                                @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                                    <option
                                                        @selected(old('status', $job->status->value) === $statusEnum)
                                                        value="{{ $statusEnum }}"
                                                    >
                                                        {{ $statusEnum }}
                                                    </option>
                                                @endforeach
                                            </x-quantum.select>
                                        </div>
                                        @error('status')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="quota" class="form-control__label">
                                            Kuota<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('quota')])>
                                            <x-quantum.input type="number" id="quota" name="quota"
                                                             value="{{ old('quota', $job->quota) }}"
                                                             placeholder="Masukkan kuota lowongan pekerjaan" required/>
                                            <span class="form-control__text">orang</span>
                                        </div>
                                        @error('quota')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <label for="start_at" class="form-control__label">Mulai</label>
                                        <div @class(['form-control__group', 'error' => $errors->has('start_at')])>
                                            <x-quantum.input
                                                type="date" id="start_at" name="start_at"
                                                value="{{ old('start_at', $job->start_at?->format('Y-m-d')) }}"
                                            />
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
                                            <x-quantum.input
                                                type="date" id="end_at" name="end_at"
                                                value="{{ old('end_at', $job->end_at?->format('Y-m-d')) }}"
                                            />
                                        </div>
                                        @error('end_at')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <div class="checkbox">
                                            <input @checked(old('need_portfolio', $job->need_portfolio))
                                                   type="checkbox" class="form-control__checkbox" id="need_portfolio"
                                                   name="need_portfolio" value="1"
                                            />
                                            <label for="need_portfolio" class="form-control__label-checkbox">
                                                Memerlukan lampiran portofolio?
                                            </label>
                                        </div>
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
            document.querySelector('#banner').addEventListener('change', event => {
                if (event.target.files[0]) {
                    document.querySelector('#banner-preview').src = URL.createObjectURL(event.target.files[0]);
                }
            });
        </script>
    @endpush
</x-app-layout>
