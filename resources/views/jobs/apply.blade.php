<x-landing-layout :title="$job->title . ' - SEVIMA Career'">
    <div class="navbar__wrapper">
        <x-landing.navbar/>
    </div>

    <section class="jobs-detail__wrapper">
        <h1 class="jobs-detail__title">{{ $job->title }}</h1>

        <div class="jobs-detail__badges">
            <span class="custom__badge custom__badge-outline">{{ $job->type }}</span>
            <div class="custom__badge custom__badge-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.5999 2.39999C9.28164 2.39999 8.97642 2.52642 8.75137 2.75147C8.52633 2.97651 8.3999 3.28173 8.3999 3.59999C8.3999 3.91825 8.52633 4.22348 8.75137 4.44852C8.97642 4.67357 9.28164 4.79999 9.5999 4.79999H11.9999C12.3182 4.79999 12.6234 4.67357 12.8484 4.44852C13.0735 4.22348 13.1999 3.91825 13.1999 3.59999C13.1999 3.28173 13.0735 2.97651 12.8484 2.75147C12.6234 2.52642 12.3182 2.39999 11.9999 2.39999H9.5999Z"
                        fill="#989898"/>
                    <path
                        d="M3.6001 6.00001C3.6001 5.36349 3.85295 4.75304 4.30304 4.30295C4.75313 3.85286 5.36358 3.60001 6.0001 3.60001C6.0001 4.55479 6.37938 5.47046 7.05451 6.14559C7.72964 6.82072 8.64532 7.20001 9.6001 7.20001H12.0001C12.9549 7.20001 13.8706 6.82072 14.5457 6.14559C15.2208 5.47046 15.6001 4.55479 15.6001 3.60001C16.2366 3.60001 16.8471 3.85286 17.2972 4.30295C17.7472 4.75304 18.0001 5.36349 18.0001 6.00001V13.2H12.4969L14.0485 11.6484C14.2671 11.4221 14.388 11.119 14.3853 10.8043C14.3826 10.4897 14.2564 10.1887 14.0339 9.96622C13.8114 9.74373 13.5104 9.61753 13.1958 9.6148C12.8811 9.61206 12.578 9.73302 12.3517 9.95161L8.7517 13.5516C8.52673 13.7766 8.40035 14.0818 8.40035 14.4C8.40035 14.7182 8.52673 15.0234 8.7517 15.2484L12.3517 18.8484C12.578 19.067 12.8811 19.1879 13.1958 19.1852C13.5104 19.1825 13.8114 19.0563 14.0339 18.8338C14.2564 18.6113 14.3826 18.3103 14.3853 17.9957C14.388 17.6811 14.2671 17.3779 14.0485 17.1516L12.4969 15.6H18.0001V19.2C18.0001 19.8365 17.7472 20.447 17.2972 20.8971C16.8471 21.3472 16.2366 21.6 15.6001 21.6H6.0001C5.36358 21.6 4.75313 21.3472 4.30304 20.8971C3.85295 20.447 3.6001 19.8365 3.6001 19.2V6.00001ZM18.0001 13.2H20.4001C20.7184 13.2 21.0236 13.3264 21.2486 13.5515C21.4737 13.7765 21.6001 14.0817 21.6001 14.4C21.6001 14.7183 21.4737 15.0235 21.2486 15.2485C21.0236 15.4736 20.7184 15.6 20.4001 15.6H18.0001V13.2Z"
                        fill="#989898"/>
                </svg>
                {{ $job->applications_count }} Pelamar
            </div>
        </div>

        <hr style="margin: 2.5rem 0"/>

        <div x-data="{ education: @js(old('education')) }" class="jobs-form__container">
            <h2 class="jobs-form__title">Form Pelamaran</h2>

            <x-alert variant="success" :message="session()->get('success')"
                     font-weight="normal" style="padding-bottom: 2rem" dismissable/>

            <form action="{{ route('jobs.apply', $job) }}" method="POST"
                  class="grid" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="col-12">
                    <div class="form-control">
                        <label for="name" class="form-control__label">
                            Nama Lengkap<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('name')])>
                            <x-input type="text" id="name" name="name" value="{{ old('name') }}"
                                     placeholder="Masukkan nama lengkap Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('name')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="email" class="form-control__label">
                            Email<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('email')])>
                            <span data-input-icon="email"></span>
                            <x-input type="email" id="email" name="email" value="{{ old('email') }}"
                                     placeholder="Masukkan email" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('email')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="telephone" class="form-control__label">
                            Nomor Telepon<span class="important">*</span>
                            <span data-tooltip="contoh: 6281234567890">
                        <span class="icon icon-information-circle"></span>
                    </span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('telephone')])>
                            <span class="form-control__text">+</span>
                            <x-input type="number" id="telephone" name="telephone" value="{{ old('telephone') }}"
                                     placeholder="Masukkan nomor telepon" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('telephone')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="age" class="form-control__label">
                            Umur<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('age')])>
                            <x-input type="number" id="age" name="age" value="{{ old('age') }}"
                                     placeholder="Masukkan umur Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('age')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label class="form-control__label">
                            Status<span class="important">*</span>
                        </label>
                        <div class="radio-button">
                            <input type="radio" class="form-control__radio" id="not_married"
                                   name="is_married" value="0" @checked(old('is_married') === '0')>
                            <label for="not_married" class="form-control__label-radio">Belum Menikah</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="form-control__radio" id="married"
                                   name="is_married" value="1" @checked(old('is_married') === '1')>
                            <label for="married" class="form-control__label-radio">Sudah Menikah</label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="address" class="form-control__label">
                            Alamat<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('address')])>
                            <x-input type="text" id="address" name="address" value="{{ old('address') }}"
                                     placeholder="Masukkan alamat Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('address')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="education" class="form-control__label">
                            Pendidikan Terakhir<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('education')])>
                            <x-select x-on:change="education = $event.target.value" variant="single-search"
                                      placeholder="Cari skala pendidikan..."
                                      id="education" name="education" required>
                                <option @selected(is_null(old('education'))) disabled>Pendidikan Terakhir</option>
                                @foreach(['S3', 'S2', 'S1', 'SMK', 'SMA', 'SMP', 'SD'] as $education)
                                    <option
                                        @selected(old('education') === $education) value="{{ $education }}">
                                        {{ $education }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        @error('education')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <template x-if="['S3', 'S2', 'S1'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="school" class="form-control__label">
                                Universitas<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('school')])>
                                <x-input type="text" id="school" name="school" value="{{ old('school') }}"
                                         placeholder="Masukkan universitas tempat Anda belajar"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('school')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <template x-if="['S3', 'S2', 'S1'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="faculty" class="form-control__label">
                                Fakultas<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('faculty')])>
                                <x-input type="text" id="faculty" name="faculty" value="{{ old('faculty') }}"
                                         placeholder="Masukkan fakultas Anda"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('faculty')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <template x-if="['SMK', 'SMA', 'SMP', 'SD'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="school" class="form-control__label">
                                Sekolah<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('school')])>
                                <x-input type="text" id="school" name="school" value="{{ old('school') }}"
                                         placeholder="Masukkan sekolah Anda"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('school')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <template x-if="['S3', 'S2', 'S1', 'SMK', 'SMA'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="major" class="form-control__label">
                                Jurusan<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('major')])>
                                <x-input type="text" id="major" name="major" value="{{ old('major') }}"
                                         placeholder="Masukkan jurusan Anda"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('major')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <div class="col-12">
                    <div class="form-control">
                        <label for="experience" class="form-control__label">
                            Pengalaman Kerja<span class="important">*</span>
                            <span data-tooltip="Pengalaman kerja dalam skala tahun">
                        <span class="icon icon-information-circle"></span>
                    </span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('experience')])>
                            <x-input type="number" id="experience" name="experience" value="{{ old('experience') }}"
                                     placeholder="Masukkan pengalaman bekerja Anda (dalam skala tahun)" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('experience')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="salary_before" class="form-control__label">
                            Gaji Sebelumnya
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('salary_before')])>
                            <span class="form-control__text">Rp</span>
                            <x-input type="text" id="salary_before" name="salary_before"
                                     value="{{ old('salary_before') }}"
                                     placeholder="Masukkan gaji Anda sebelumnya"/>
                            <span data-clear="input"></span>
                        </div>
                        @error('salary_before')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="salary_expected" class="form-control__label">
                            Gaji yang Diharapkan
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('salary_expected')])>
                            <span class="form-control__text">Rp</span>
                            <x-input type="text" id="salary_expected"
                                     name="salary_expected" value="{{ old('salary_expected') }}"
                                     placeholder="Masukkan gaji yang Anda harapkan"/>
                            <span data-clear="input"></span>
                        </div>
                        @error('salary_expected')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="curriculum_vitae" class="form-control__label">
                            CV<span class="important">*</span>
                        </label>
                        <div class="upload-draggable">
                            <div class="upload-draggable__box">
                                <input type="file" class="upload-draggable__file-input" name="curriculum_vitae"
                                       id="curriculum_vitae" accept=".doc,.docx,.pdf" required
                                       value="{{ old('curriculum_vitae') }}"/>
                                <label class="upload-draggable__icon"><span
                                        class="icon icon-cloud-arrow-up"></span></label>
                                <h2 class="upload-draggable__title">Klik untuk pilih file</h2>
                                <p class="upload-draggable__subtitle">atau seret file ke sini</p>
                                <p class="upload-draggable__support">DOC, DOCX, atau PDF (max. 2MB)</p>
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
                        @error('curriculum_vitae')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="portfolio" class="form-control__label">
                            Portofolio<span class="important">*</span>
                        </label>
                        <div class="upload-draggable">
                            <div class="upload-draggable__box">
                                <input type="file" class="upload-draggable__file-input" name="portfolio"
                                       id="portfolio" accept=".doc,.docx,.pdf" required
                                       value="{{ old('portfolio') }}"/>
                                <label class="upload-draggable__icon"><span
                                        class="icon icon-cloud-arrow-up"></span></label>
                                <h2 class="upload-draggable__title">Klik untuk pilih file</h2>
                                <p class="upload-draggable__subtitle">atau seret file ke sini</p>
                                <p class="upload-draggable__support">DOC, DOCX, atau PDF (max. 2MB)</p>
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
                        @error('portfolio')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <button type="button" class="button button__md button__primary"
                            style="display: block; margin-left: auto"
                            data-label="Upload" data-toggle="modal"
                            data-target="#job-apply-modal">
                        Submit
                    </button>

                    <x-modal-confirmation id="job-apply-modal"
                                          title="Konfirmasi Melamar Pekerjaan">
                        <x-slot:body>
                            <p>Apakah Anda yakin ingin melamar pekerjaan ini?</p>
                            <p>Pastikan semua inputan Anda sudah benar.</p>
                        </x-slot:body>

                        <x-slot:footer>
                            <div class="grid cols-1 cols-sm-2">
                                <button type="button" class="btn btn_outline"
                                        data-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn_primary">
                                    Konfirmasi
                                </button>
                            </div>
                        </x-slot:footer>
                    </x-modal-confirmation>
                </div>
            </form>
        </div>
    </section>

    <x-landing.cta/>

    <x-landing.footer/>

    @push('styles')
        <link href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
        @livewireScripts
        <script type="text/javascript"
                src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
        <script>
            const salaryBefore = document.getElementById('salary_before');
            salaryBefore.addEventListener('keyup', function (e) {
                salaryBefore.value = formatRupiah(e.target.value);
            });

            const salaryExpected = document.getElementById('salary_expected');
            salaryExpected.addEventListener('keyup', function (e) {
                salaryExpected.value = formatRupiah(e.target.value);
            });
        </script>
    @endpush
</x-landing-layout>
