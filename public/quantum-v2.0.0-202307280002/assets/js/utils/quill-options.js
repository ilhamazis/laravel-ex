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

function initQuill(selector) {
    return new Quill(selector, {
        modules: {
            toolbar: qnQuillToolbarOptions
        },
        theme: 'snow'
    });
}
