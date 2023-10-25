<form
    class="grid"
    action="{{ route('managements.jobs.applications.steps.attachments.store', [
                request()->route('job'), request()->route('application'), request()->route('step')
            ]) }}"
    method="post"
    enctype="multipart/form-data"
>
    @csrf
    @method('POST')

    <div class="col-12">
        <div class="form-control">
            <x-quantum.input-file
                name="file" id="file"
                accept="application/pdf,.doc,.docx"
                support="DOC, DOCX, atau PDF (max. 2MB)"
            />

            @error('file')
            <div class="form-control__helper error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn_primary btn_full-width"
                data-label="Upload"
                data-toggle="modal"
                data-target="#create-attachment-modal">
            Unggah Lampiran
        </button>
    </div>

    <x-quantum.modal-confirmation id="create-attachment-modal"
                                  title="Konfirmasi Unggah Lampiran">
        <x-slot:body>
            <p>Apakah anda yakin ingin mengunggah lampiran?</p>
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
    </x-quantum.modal-confirmation>
</form>
