<x-landing-layout :title="$job->title . ' - SEVIMA Career'">
    <div class="navbar__wrapper">
        <x-landing.navbar/>
    </div>

    <section class="jobs-detail__wrapper">
        <div class="jobs-detail__header-wrapper">
            <div class="jobs-detail__header">
                <h1 class="jobs-detail__title">{{ $job->title }}</h1>
                <p class="jobs-detail__timestamp">Diposting {{ $job->updated_at->diffForHumans() }}</p>
            </div>

            <div class="jobs-detail__actions">
                <x-link href="{{ route('jobs.show', $job) }}" class="btn btn_outline">
                    Kembali ke Detail Lowongan
                </x-link>
            </div>
        </div>

        <div class="jobs-detail__badges">
            <div class="custom__badge custom__badge-outline">
                <svg width="16" height="16" viewBox="0 0 20 20"
                     fill="none">
                    <path
                        d="M16.668 5.83333H3.33464C2.41416 5.83333 1.66797 6.57952 1.66797 7.49999V15.8333C1.66797 16.7538 2.41416 17.5 3.33464 17.5H16.668C17.5884 17.5 18.3346 16.7538 18.3346 15.8333V7.49999C18.3346 6.57952 17.5884 5.83333 16.668 5.83333Z"
                        stroke="#3955A4" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path
                        d="M13.3346 17.5V4.16667C13.3346 3.72464 13.159 3.30072 12.8465 2.98816C12.5339 2.67559 12.11 2.5 11.668 2.5H8.33464C7.89261 2.5 7.46869 2.67559 7.15612 2.98816C6.84356 3.30072 6.66797 3.72464 6.66797 4.16667V17.5"
                        stroke="#3955A4" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
                {{ $job->type }}
            </div>
            <div class="custom__badge custom__badge-secondary">
                <span class="icon icon-clipboard-document-list-solid"></span>
                {{ $job->quota }} Kuota Tersisa
            </div>
            <div class="custom__badge custom__badge-secondary">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_980_5906)">
                        <path
                            d="M17.5 8.33333C17.5 14.1667 10 19.1667 10 19.1667C10 19.1667 2.5 14.1667 2.5 8.33333C2.5 6.3442 3.29018 4.43655 4.6967 3.03003C6.10322 1.6235 8.01088 0.833328 10 0.833328C11.9891 0.833328 13.8968 1.6235 15.3033 3.03003C16.7098 4.43655 17.5 6.3442 17.5 8.33333Z"
                            stroke="#989898" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path
                            d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"
                            stroke="#989898" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_980_5906">
                            <rect width="20" height="20" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                {{ $job->location }}
            </div>
        </div>

        <hr class="jobs-detail__divider"/>

        <div x-data="{ education: @js(old('education')) }" class="jobs-form__container">
            <h2 class="jobs-form__title">Form Pelamaran</h2>

            <x-quantum.alert variant="success" :message="session()->get('success')"
                             font-weight="normal" style="padding-bottom: 2rem" dismissable/>

            <form id="apply-form" action="{{ route('jobs.apply', $job) }}" method="POST"
                  class="grid" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="col-12">
                    <div class="hr-intext">
                        <span class="hr-intext__line"></span>
                        <p class="hr-intext__text">Data Diri</p>
                    </div>
                </div>

                <div class="col-12 col-md-3" style="margin: auto">
                    <div class="avatar avatar_xl">
                        <img id="photo-preview" src="{{ asset('assets/images/dummy_avatar.jpg') }}"
                             alt="Foto Diri"/>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <div class="form-control">
                        <label for="photo" class="form-control__label">
                            Foto Diri<span class="important">*</span>
                        </label>
                        <x-quantum.input-file-small id="photo" name="photo"
                                                    accept="image/jpeg,image/png" required
                                                    support="JPG atau PNG (max. 512KB)"/>
                        @error('photo')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="name" class="form-control__label">
                            Nama Lengkap<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('name')])>
                            <x-quantum.input type="text" id="name" name="name" value="{{ old('name') }}"
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
                        <label for="nik" class="form-control__label">
                            NIK/Nomor KTP<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('nik')])>
                            <x-quantum.input type="number" id="nik" name="nik"
                                             value="{{ old('nik') }}"
                                             placeholder="Masukkan NIK atau Nomor KTP Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('nik')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-control">
                        <label for="place_of_birth" class="form-control__label">
                            Tempat Lahir<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('place_of_birth')])>
                            <x-quantum.input type="text" id="place_of_birth" name="place_of_birth"
                                             value="{{ old('place_of_birth') }}"
                                             placeholder="Masukkan kota/kabupaten kelahiran Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('place_of_birth')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-control">
                        <label for="date_of_birth" class="form-control__label">
                            Tanggal Lahir<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('date_of_birth')])>
                            <x-quantum.input type="date" id="date_of_birth" name="date_of_birth"
                                             value="{{ old('date_of_birth') }}"
                                             placeholder="Masukkan tanggal lahir Anda" required/>
                        </div>
                        @error('date_of_birth')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-control">
                        <label class="form-control__label">
                            Jenis Kelamin<span class="important">*</span>
                        </label>
                        <div class="radio-button">
                            <input type="radio" class="form-control__radio" id="laki-laki"
                                   name="gender" value="Laki-laki" @checked(old('gender') === 'Laki-laki')>
                            <label for="laki-laki" class="form-control__label-radio">Laki-laki</label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="form-control__radio" id="perempuan"
                                   name="gender" value="Perempuan" @checked(old('gender') === 'Perempuan')>
                            <label for="perempuan" class="form-control__label-radio">Perempuan</label>
                        </div>
                        @error('gender')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
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
                        @error('is_married')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="address" class="form-control__label">
                            Alamat<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('address')])>
                            <x-quantum.input type="text" id="address" name="address" value="{{ old('address') }}"
                                             placeholder="Masukkan alamat Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('address')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12" style="padding-top: 3rem">
                    <div class="hr-intext">
                        <span class="hr-intext__line"></span>
                        <p class="hr-intext__text">Kontak</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="email" class="form-control__label">
                            Email<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('email')])>
                            <span data-input-icon="email"></span>
                            <x-quantum.input type="email" id="email" name="email" value="{{ old('email') }}"
                                             placeholder="Masukkan email Anda" required/>
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
                            <span data-tooltip="contoh: 81234567890">
                                <span class="icon icon-information-circle"></span>
                            </span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('telephone')])>
                            <span class="form-control__text">+62</span>
                            <x-quantum.input type="number" id="telephone" name="telephone"
                                             style="border-top-left-radius: 0;
                                                    border-bottom-left-radius: 0;"
                                             value="{{ old('telephone') }}"
                                             placeholder="Masukkan nomor telepon Anda" required/>
                            <span data-clear="input"></span>
                        </div>
                        @error('telephone')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="linkedin_url" class="form-control__label">
                            URL LinkedIn
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('linkedin_url')])>
                            <x-quantum.input type="url" id="linkedin_url" name="linkedin_url"
                                             value="{{ old('linkedin_url') }}"
                                             placeholder="Masukkan URL LinkedIn Anda"/>
                            <span data-clear="input"></span>
                        </div>
                        @error('linkedin_url')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12" style="padding-top: 3rem">
                    <div class="hr-intext">
                        <span class="hr-intext__line"></span>
                        <p class="hr-intext__text">Edukasi & Pengalaman</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="education" class="form-control__label">
                            Pendidikan Terakhir<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('education')])>
                            <x-quantum.select x-on:change="education = $event.target.value" id="education"
                                              name="education" required>
                                <option @selected(is_null(old('education'))) disabled>Pendidikan Terakhir</option>
                                @foreach(['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMK', 'SMA'] as $education)
                                    <option
                                        @selected(old('education') === $education) value="{{ $education }}">
                                        {{ $education }}
                                    </option>
                                @endforeach
                            </x-quantum.select>
                        </div>
                        @error('education')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <template x-if="['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="school" class="form-control__label">
                                Universitas<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('school')])>
                                <x-quantum.input type="text" id="school" name="school" value="{{ old('school') }}"
                                                 placeholder="Masukkan universitas tempat Anda belajar"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('school')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <template x-if="['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="faculty" class="form-control__label">
                                Fakultas<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('faculty')])>
                                <x-quantum.input type="text" id="faculty" name="faculty" value="{{ old('faculty') }}"
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
                                <x-quantum.input type="text" id="school" name="school" value="{{ old('school') }}"
                                                 placeholder="Masukkan sekolah Anda"/>
                                <span data-clear="input"></span>
                            </div>
                            @error('school')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </template>

                <template x-if="['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMK', 'SMA'].includes(education)">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="major" class="form-control__label">
                                Jurusan<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('major')])>
                                <x-quantum.input type="text" id="major" name="major" value="{{ old('major') }}"
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
                            Lama Bekerja<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('education')])>
                            <x-quantum.select id="experience" name="experience" required>
                                <option @selected(is_null(old('experience'))) disabled>Lama Bekerja</option>
                                @foreach(\App\Enums\ApplicationExperienceEnum::values() as $experience)
                                    <option
                                        @selected(old('experience') === $experience) value="{{ $experience }}">
                                        {{ $experience }}
                                    </option>
                                @endforeach
                            </x-quantum.select>
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
                            <x-quantum.input type="text" id="salary_before" name="salary_before"
                                             style="border-radius: 0"
                                             value="{{ old('salary_before') }}"
                                             placeholder="Masukkan gaji Anda sebelumnya"/>
                            <span class="form-control__text">,-</span>
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
                            <x-quantum.input type="text" id="salary_expected"
                                             style="border-radius: 0"
                                             name="salary_expected" value="{{ old('salary_expected') }}"
                                             placeholder="Masukkan gaji yang Anda harapkan"/>
                            <span class="form-control__text">,-</span>
                        </div>
                        @error('salary_expected')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12" style="padding-top: 3rem">
                    <div class="hr-intext">
                        <span class="hr-intext__line"></span>
                        <p class="hr-intext__text">Lampiran Berkas</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="curriculum_vitae" class="form-control__label">
                            Curriculum Vitae<span class="important">*</span>
                        </label>
                        <x-quantum.input-file
                            name="curriculum_vitae" id="curriculum_vitae"
                            accept="application/pdf" required
                            support="Format file PDF (max. 5MB)"
                        />
                        @error('curriculum_vitae')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if($job->need_portfolio)
                    <div class="col-12">
                        <div class="form-control">
                            <label for="portfolio" class="form-control__label">
                                Portofolio<span class="important">*</span>
                            </label>
                            <x-quantum.input-file
                                name="portfolio"
                                id="portfolio" accept="application/pdf" required
                                value="{{ old('portfolio') }}"
                                support="Format file PDF (max. 5MB)"
                            />
                            @error('portfolio')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="col-12" style="padding-top: 3rem">
                    <div class="form-control" style="margin-bottom: 2rem">
                        <div class="checkbox">
                            <input type="checkbox" class="form-control__checkbox" id="statement_of_honesty"
                                   name="statement_of_honesty" value="1"/>
                            <label for="statement_of_honesty" class="form-control__label-checkbox">
                                Saya menyatakan bahwa data yang saya masukkan adalah benar dan akurat.
                            </label>
                        </div>
                        @error('statement_of_honesty')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="button" class="btn btn_primary btn_full-width btn_md"
                            data-label="Upload" data-toggle="modal"
                            data-target="#job-apply-modal">
                        Kirim Lamaran
                    </button>

                    <x-quantum.modal-confirmation id="job-apply-modal"
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
                                <button
                                    type="button" class="btn btn_primary"
                                    onclick="document.getElementById('apply-form').submit()"
                                >
                                    Konfirmasi
                                </button>
                            </div>
                        </x-slot:footer>
                    </x-quantum.modal-confirmation>
                </div>
            </form>
        </div>
    </section>

    <div style="padding-top: 5rem">
        <x-landing.cta title="Temukan Semua yang Perlu Anda Ketahui Tentang SEVIMA">
            <x-slot:action>
                <x-link href="{{ route('about') }}" class="cta__button button button__lg button__primary">
                    Pelajari Lebih Lanjut
                </x-link>
            </x-slot:action>
        </x-landing.cta>
    </div>

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

            document.querySelector('#photo').addEventListener('change', event => {
                if (event.target.files[0]) {
                    document.querySelector('#photo-preview').src = URL.createObjectURL(event.target.files[0]);
                }
            });
        </script>
    @endpush
</x-landing-layout>
