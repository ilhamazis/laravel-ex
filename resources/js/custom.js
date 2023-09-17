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

window.initChoices = initChoices;
window.initChoicesSearch = initChoicesSearch;

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
