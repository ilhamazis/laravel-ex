function initChoices(el) {
    new Choices(el, {
        allowHTML: true,
        searchEnabled: false,
        removeItemButton: false,
    });
}

function initChoicesSearch(el) {
    const searchPlaceholder = el.dataset.placeholder ?? 'Search...';

    new Choices(el, {
        allowHTML: true,
        searchPlaceholderValue: searchPlaceholder,
    });
}

async function copyToClipboard(el, url) {
    await navigator.clipboard.writeText(url);

    const innerBefore = el.innerHTML;

    el.innerText = 'Disalin!';
    el.disabled = true;

    setTimeout(() => {
        el.innerHTML = innerBefore;
        el.disabled = false;
    }, 1000);
}

function formatRupiah(angka) {
    let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        const separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

window.initChoices = initChoices;
window.initChoicesSearch = initChoicesSearch;
window.copyToClipboard = copyToClipboard;
window.formatRupiah = formatRupiah;

document.addEventListener('DOMContentLoaded', () => {
    if (typeof Livewire === 'undefined') {
        document.querySelectorAll('select[x-init="initChoices($el)"]').forEach(el => {
            initChoices(el);
        });

        document.querySelectorAll('select[x-init="initChoicesSearch($el)"]').forEach(el => {
            initChoicesSearch(el);
        });
    }

    document.querySelectorAll('.stepper').forEach(el => {
        const stepperLineWidth = (el.scrollWidth / el.childElementCount) + 8;

        el.style.setProperty('--stepper-line-width', `${stepperLineWidth}px`)
    });
});
