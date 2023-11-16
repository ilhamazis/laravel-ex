<div class="card card_details-primary">
    <div class="grid">
        <div class="col-12 col-md-2 col-lg-2" style="margin: auto">
            <div class="avatar custom__avatar-xxl">
                <img src="{{ route('managements.applicants.photo', $applicant) }}" alt="Foto Diri Pelamar">
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-6">
            <div class="grid">
                <div class="col-12 col-lg-12">
                    <div class="row-data">
                        <label class="row-data__name">Nama Pelamar</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->name }}
                        </span>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="row-data">
                        <label class="row-data__name">Email</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->email }}
                        </span>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="row-data">
                        <label class="row-data__name">Nomor Telepon</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            +62{{ $applicant->telephone }}
                        </span>
                    </div>
                </div>
                @if($applicant->linkedin_url)
                    <div class="col-12 col-lg-12">
                        <div class="row-data">
                            <label class="row-data__name">URL LinkedIn</label>
                            <span class="row-data__value">
                                <span class="row-data__colon">:</span>
                                <x-link href="{{ $applicant->linkedin_url }}" target="_blank"
                                        style="text-decoration: underline">
                                    {{ $applicant->linkedin_url }}
                                </x-link>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="grid">
    <div class="col-12 col-lg-6">
        <div class="card card_details-default">
            <div class="card__header">
                <div class="card__header-left">
                    <div class="card__header-icon">
                        <span class="icon icon-user-solid"></span>
                    </div>
                    <div class="card__header-block">
                        <h2 class="header__title">Data Diri</h2>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="grid">
                    <div class="col-12">
                        <div class="grid">
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Nama Lengkap</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">NIK/Nomor KTP</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->nik }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Tempat, Tanggal Lahir</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->place_of_birth }},
                                        {{ $applicant->date_of_birth->isoFormat('LL') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Jenis Kelamin</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->gender }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Status</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->is_married ? 'Sudah Menikah' : 'Belum Menikah' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Alamat</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->address }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card_details-default">
            <div class="card__header">
                <div class="card__header-left">
                    <div class="card__header-icon">
                        <span class="icon icon-building-office-solid"></span>
                    </div>
                    <div class="card__header-block">
                        <h2 class="header__title">Edukasi & Pengalaman</h2>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="grid">
                    <div class="col-12">
                        <div class="grid">
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Pendidikan Terakhir</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->education }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Universitas/Sekolah</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->school }}
                                    </span>
                                </div>
                            </div>
                            @if($applicant->faculty)
                                <div class="col-12 col-lg-12">
                                    <div class="row-data">
                                        <label class="row-data__name">Fakultas</label>
                                        <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->faculty }}
                                    </span>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Jurusan</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->major }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Lama Bekerja</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $applicant->experience }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Gaji Sebelumnya</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $application->salary_before }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="row-data">
                                    <label class="row-data__name">Gaji yang Diharapkan</label>
                                    <span class="row-data__value">
                                        <span class="row-data__colon">:</span>
                                        {{ $application->salary_expected }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
