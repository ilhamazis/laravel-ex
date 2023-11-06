<div class="card card_details-primary">
    <div class="grid">
        <div class="col-12 col-md-6">
            <div class="grid">
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Nama Lengkap</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->name }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">NIK/Nomor KTP</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->nik }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Email</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->email }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Nomor Telepon</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            62{{ $applicant->telephone }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="grid">
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Tempat, Tanggal Lahir</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->place_of_birth }}, {{ $applicant->date_of_birth->isoFormat('LL') }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Status</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->is_married ? 'Sudah Menikah' : 'Belum Menikah' }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Jenis Kelamin</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->gender }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
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
        <div class="col-12 col-md-6">
            <div class="grid">
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Pendidikan Terakhir</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->education }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Universitas/Sekolah</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->school }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Pengalaman Kerja</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                            {{ $applicant->experience }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="grid">
                <div class="col-12">
                    <div class="row-data">
                        <label class="row-data__name">Gaji Sebelumnya</label>
                        <span class="row-data__value">
                            <span class="row-data__colon">:</span>
                             {{ $application->salary_before }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
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
