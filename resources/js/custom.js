function initChoices(el) {
    new Choices(el, {
        allowHTML: true,
        searchEnabled: false,
        removeItemButton: false,
    });
}

function initChoicesSearch(el, searchPlaceholder) {
    new Choices(el, {
        allowHTML: true,
        searchPlaceholderValue: searchPlaceholder ?? 'Search...',
    });
}

window.initChoices = initChoices;
window.initChoicesSearch = initChoicesSearch;
