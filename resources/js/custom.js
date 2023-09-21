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

window.initChoices = initChoices;
window.initChoicesSearch = initChoicesSearch;
window.copyToClipboard = copyToClipboard;

if (typeof Livewire === 'undefined') {
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('select[x-init="initChoices($el)"]').forEach(el => {
            initChoices(el);
        });

        document.querySelectorAll('select[x-init="initChoicesSearch($el)"]').forEach(el => {
            initChoicesSearch(el);
        });
    });
}
