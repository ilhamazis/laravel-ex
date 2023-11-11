<div class="card card_form">
    <div class="card__header">
        <div class="form-header">
            <div class="form-header__wrapper">
                <div class="form-header__avatar">
                    <span class="icon icon-book-open-mini"></span>
                </div>
                <div class="form-header__information">
                    <h3 class="form-header__title">Deskripsi Lowongan Pekerjaan</h3>
                </div>
            </div>

            <button wire:loading.remove wire:click="addSection"
                    type="button" class="btn btn_outline btn_xs">
                <span class="icon icon-plus-mini"></span>
                Tambah Bagian
            </button>

            <button wire:loading wire:target="addSection"
                    type="button" class="btn btn_outline btn_xs" disabled>
                Loading
            </button>
        </div>
    </div>
    <div class="card__body">
        <div class="grid">
            @foreach($sections as $index => $section)
                <div wire:key="{{ 'section-' . $index }}" class="col-12">
                    <div style="width: 100%; display: flex; justify-content: end">
                        @if(!$loop->first)
                            <button
                                wire:loading.remove
                                wire:click="removeSection(@js($index))"
                                type="button"
                                class="btn btn_destructive btn_xs">
                                <span class="icon icon-trash-mini"></span>
                                Hapus
                            </button>

                            <button wire:loading wire:target="removeSection(@js($index))"
                                    type="button" class="btn btn_destructive btn_xs" disabled>
                                Loading
                            </button>
                        @endif
                    </div>
                    <div class="form-control">
                        <label for="{{ 'section-' . $index }}" class="form-control__label">
                            Bagian {{ $index + 1 }}
                            @if($index === 0)
                                <span class="important">*</span>
                            @endif
                        </label>
                        <div wire:ignore>
                            <div
                                id="{{ "section-{$index}-quill" }}"
                                x-init="
                                    const quill = initQuill(@js("#section-{$index}-quill"));
                                    quill.on('text-change', function () {
                                        document.getElementById(@js("section-{$index}"))
                                            .dispatchEvent(new Event('input'));
                                    });
                                    syncQuillToTextarea(@js("#section-{$index}-quill"), @js("#section-{$index}"));
                                    sanitize($el.querySelector('.ql-editor'), @js($section['content'] ?? ''));
                                "
                                x-on:section-updated.window="
                                    const sectionContent = $event.detail[0][{{ $index }}]?.content;

                                    if (sectionContent !== undefined) {
                                        $el.querySelector('.ql-editor').innerHTML = sectionContent;
                                    }
                                "
                            >
                            </div>
                        </div>
                        <textarea id="{{ "section-{$index}" }}" name="sections[{{ $index }}][content]"
                                  wire:model.debounce.500ms="sections.{{ $index }}.content"
                                  x-init="sanitize($el, @js($section['content'] ?? ''))"
                                  style="display: none"
                        ></textarea>
                    </div>
                </div>

                @if(!$loop->last)
                    <div class="col-12">
                        <hr class="dashed"/>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.snow.css') }}"/>
    @endpush

    @push('scripts')
        <script
            src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.min.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/utils/quill-options.js') }}"></script>
    @endpush
</div>
