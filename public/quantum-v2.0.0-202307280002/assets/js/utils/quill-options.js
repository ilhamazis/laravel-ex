// Bisa dipanggil setelah inisialisasi vendor quill

// Variabel pembantu
/**
 * Variabel ini:
 *  1. Di sematkan di modules.toolbar
 */
const qnQuillToolbarOptions = [
    [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
    // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    ['bold', 'italic', 'underline'],        // toggled buttons

    [{'list': 'ordered'}, {'list': 'bullet'}, {'align': []}],

    ['link', 'image', 'video']
];

function initQuill(quillSelector) {
    return new Quill(quillSelector, {
        modules: {
            toolbar: qnQuillToolbarOptions
        },
        theme: 'snow'
    });
}

function syncQuillToTextarea(quillSelector, textareaSelector) {
    document.querySelector(quillSelector)
        .querySelector('.ql-editor')
        .addEventListener('DOMSubtreeModified', () => {
            document.querySelector(textareaSelector).value = document.querySelector(quillSelector)
                .querySelector('.ql-editor')
                .innerHTML;
        });
}
