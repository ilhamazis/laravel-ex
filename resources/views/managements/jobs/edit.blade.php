@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'Ubah Lowongan Pekerjaan'],
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
                        <h1 class="main__title">Ubah Lowongan Pekerjaan</h1>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-12">
                    <div class="card card_form">
                        <div class="card__header">
                            <div class="form-header">
                                <div class="form-header__wrapper">
                                    <div class="form-header__avatar">
                                        <span class="icon icon-briefcase-mini"></span>
                                    </div>
                                    <div class="form-header__information">
                                        <h3 class="form-header__title">Data Lowongan Pekerjaan</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <label for="quota" class="form-control__label">
                                            Kuota<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('quota')])>
                                            <x-quantum.input type="number" id="quota" name="quota"
                                                             style="border-top-right-radius: 0;
                                                                    border-bottom-right-radius: 0;"
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
                                        <label for="location" class="form-control__label">
                                            Lokasi<span class="important">*</span>
                                        </label>
                                        <div @class(['form-control__group', 'error' => $errors->has('location')])>
                                            <x-quantum.input type="text" id="location" name="location"
                                                             value="{{ old('location', $job->location) }}"
                                                             placeholder="Masukkan lokasi pekerjaan" required/>
                                            <span data-clear="input"></span>
                                        </div>
                                        @error('location')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-control">
                                        <div class="checkbox">
                                            <input type="checkbox" class="form-control__checkbox" id="need_portfolio"
                                                   name="need_portfolio"
                                                   value="1" @checked(old('need_portfolio', $job->need_portfolio))/>
                                            <label for="need_portfolio" class="form-control__label-checkbox">
                                                Memerlukan lampiran portofolio?
                                            </label>
                                        </div>
                                        @error('need_portfolio')
                                        <div class="form-control__helper error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <livewire:jobs.section :sections="old('sections', $job->sections->toArray())"
                                           :errors="$errors->get('sections') + $errors->get('sections.*')"/>
                </div>

                <div class="col-12">
                    <div class="card card_form">
                        <div class="card__header">
                            <div class="form-header">
                                <div class="form-header__wrapper">
                                    <div class="form-header__avatar">
                                        <span class="icon icon-clock-mini"></span>
                                    </div>
                                    <div class="form-header__information">
                                        <h3 class="form-header__title">Periode Lowongan Pekerjaan</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card__body">
                            <div class="grid">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
