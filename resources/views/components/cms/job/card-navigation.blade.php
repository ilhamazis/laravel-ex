<div class="card__body">
    <nav class="nav-tab">
        <ul class="nav-tab__wrapper">
            <li @class(['nav-tab__item', 'active' => request()->routeIs('managements.jobs.show')])>
                <x-link :href="route('managements.jobs.show', request()->route('job'))">Deskripsi</x-link>
            </li>
            @can(\App\Enums\PermissionEnum::VIEW_APPLICATION->value)
                <li @class([
                        'nav-tab__item', 'active' => request()->routeIs('managements.jobs.applications.index'),
                    ])>
                    <x-link :href="route('managements.jobs.applications.index', request()->route('job'))">
                        List Pelamar
                    </x-link>
                </li>
            @endcan
        </ul>
    </nav>
</div>
