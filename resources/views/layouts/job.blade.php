<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$breadcrumbs"/>
            </div>
        </div>

        <x-quantum.alert variant="success" :message="session()->get('success')"
                         dismissable/>

        <x-cms.job.header-detail :job="$job"/>

        <div class="card">
            <div class="card__body">
                <nav class="nav-tab">
                    <ul class="nav-tab__wrapper">
                        <li @class(['nav-tab__item', 'active' => request()->routeIs('managements.jobs.show')])>
                            <x-link :href="route('managements.jobs.show', $job)">Deskripsi</x-link>
                        </li>
                        @can(\App\Enums\PermissionEnum::VIEW_APPLICATION->value)
                            <li @class([
                                'nav-tab__item', 'active' => request()->routeIs('managements.jobs.applications.index'),
                            ])>
                                <x-link :href="route('managements.jobs.applications.index', $job)">List Pelamar</x-link>
                            </li>
                        @endcan
                    </ul>
                </nav>
            </div>

            {{ $slot }}
        </div>
    </div>
</x-app-layout>
