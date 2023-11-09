@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $job)],
        ['title' => $application->applicant->name . ' - Kirim Email'],
    ];
@endphp

<x-job-application-layout :breadcrumbs="$paths" :job="$job" :application="$application" :attachments="$attachments"
                          :current-application-step="$applicationStep"
                          :application-steps="$applicationSteps" :missing-application-steps="$missingApplicationSteps">
    <form
        class="card__body"
        action="{{ route('managements.jobs.applications.steps.communications.store', [
            $job, $application, $applicationStep
        ]) }}"
        method="post"
    >
        @csrf
        @method('POST')

        @error('mail')
        <x-quantum.alert style="padding-bottom: 2rem" variant="error" :message="$message" dismissable/>
        @enderror

        <div class="grid">
            <div class="col-12">
                <div class="form-control">
                    <label for="status" class="form-control__label">
                        Template
                    </label>
                    <div @class(['form-control__group', 'error' => $errors->has('template_id')])>
                        <x-quantum.select variant="single-search" placeholder="Cari template..."
                                          id="template_id" name="template_id" required>
                            <option @selected(is_null(old('template_id'))) disabled>Pilih Template</option>
                            @foreach($templates as $template)
                                <option @selected(old('template_id') === $template->id) value="{{ $template->id }}">
                                    {{ $template->title }}
                                </option>
                            @endforeach
                        </x-quantum.select>
                    </div>
                    @error('template_id')
                    <div class="form-control__helper error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-control">
                    <label class="form-control__label">
                        Subjek<span class="important">*</span>
                    </label>
                    <div @class(['form-control__group', 'error' => $errors->has('title')])>
                        <x-quantum.input type="text" id="title" name="title" value="{{ old('title') }}"
                                         placeholder="Masukkan subjek" required/>
                        <span data-clear="input"></span>
                    </div>
                    @error('title')
                    <div class="form-control__helper error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-control">
                    <label for="content" class="form-control__label">
                        Isi Email<span class="important">*</span>
                    </label>
                    <x-quantum.rich-text-editor id="content" name="content"
                                                :value="old('content')"/>
                    @error('content')
                    <div class="form-control__helper error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button type="button" class="btn btn_primary btn_full-width"
                        data-label="Buat Review" data-toggle="modal" data-target="#review-modal">
                    Kirim Email
                </button>
            </div>

            <x-quantum.modal-confirmation id="review-modal" title="Konfirmasi Membuat Review">
                <x-slot:body>
                    <p>Apakah anda yakin ingin mengirim email ke kandidat ini?</p>
                </x-slot:body>

                <x-slot:footer>
                    <div class="grid cols-1 cols-sm-2">
                        <button type="button" class="btn btn_outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn_primary">Konfirmasi</button>
                    </div>
                </x-slot:footer>
            </x-quantum.modal-confirmation>
        </div>
    </form>

    @push('custom-scripts')
        <script>
            const templateSelect = document.querySelector('#template_id');
            const contentQuill = document.querySelector('#contentQuill');

            templateSelect.addEventListener('change', async (e) => {
                const baseRoute = @js(route('managements.templates.index'));
                const templateId = e.target.value;

                const response = await fetch(`${baseRoute}/${templateId}`, {
                    method: 'GET',
                    credentials: 'same-origin',
                });
                const data = await response.json();

                contentQuill.querySelector('.ql-editor').innerHTML = data.content;
            });
        </script>
    @endpush
</x-job-application-layout>
