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
            <span class="custom__badge custom__badge-outline">{{ $job->type }}</span>
            <div class="custom__badge custom__badge-secondary">
                <span class="icon icon-clipboard-document-list-solid"></span>
                {{ $job->quota }} kuota
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

                <div class="col-12">
                    <div class="form-control">
                        <label for="email" class="form-control__label">
                            Email<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('email')])>
                            <span data-input-icon="email"></span>
                            <x-quantum.input type="email" id="email" name="email" value="{{ old('email') }}"
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
                            <span data-tooltip="contoh: 81234567890">
                        <span class="icon icon-information-circle"></span>
                    </span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('telephone')])>
                            <span class="form-control__text">+62</span>
                            <x-quantum.input type="number" id="telephone" name="telephone"
                                             value="{{ old('telephone') }}"
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

                <div class="col-12 col-md-6">
                    <div class="form-control">
                        <label for="education" class="form-control__label">
                            Pendidikan Terakhir<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('education')])>
                            <x-quantum.select x-on:change="education = $event.target.value" variant="single-search"
                                              placeholder="Cari skala pendidikan..."
                                              id="education" name="education" required>
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

                <div class="col-12 col-md-6">
                    <div class="form-control">
                        <label for="experience" class="form-control__label">
                            Pengalaman Kerja<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('education')])>
                            <x-quantum.select variant="single-search"
                                              placeholder="Cari skala pengalaman kerja..."
                                              id="experience" name="experience" required>
                                <option @selected(is_null(old('experience'))) disabled>Pengalaman Kerja</option>
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
                        <label for="salary_before" class="form-control__label">
                            Gaji Sebelumnya
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('salary_before')])>
                            <span class="form-control__text">Rp</span>
                            <x-quantum.input type="text" id="salary_before" name="salary_before"
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
                            <x-quantum.input type="text" id="salary_expected"
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
                        <x-quantum.input-file
                            name="curriculum_vitae"
                            id="curriculum_vitae" accept=".doc,.docx,.pdf" required
                            value="{{ old('curriculum_vitae') }}"
                            support="DOC, DOCX, atau PDF (max. 2MB)"
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
                                id="portfolio" accept=".doc,.docx,.pdf" required
                                value="{{ old('portfolio') }}"
                                support="DOC, DOCX, atau PDF (max. 2MB)"
                            />
                            @error('portfolio')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div style="padding-top: 3rem">
                        <button type="button" class="btn btn_primary btn_full-width btn_md"
                                data-label="Upload" data-toggle="modal"
                                data-target="#job-apply-modal">
                            Kirim Lamaran
                        </button>
                    </div>

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
        <x-landing.cta title="Belum Yakin untuk Bergabung dengan SEVIMA?">
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
        </script>
    @endpush
</x-landing-layout>
