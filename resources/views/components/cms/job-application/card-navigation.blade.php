<div class="card__body">
    <x-quantum.nav-tab>
        @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_REVIEW->value)
            <x-quantum.nav-tab-item
                :active="request()->routeIs('managements.jobs.applications.steps.reviews.*')"
            >
                <x-link
                    :href="route('managements.jobs.applications.steps.reviews.index', [
                               request()->route('job'),
                               request()->route('application'),
                               request()->route('step'),
                           ])"
                >
                    Review
                </x-link>
            </x-quantum.nav-tab-item>
        @endcan

        @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_NOTE->value)
            <x-quantum.nav-tab-item
                :active="request()->routeIs('managements.jobs.applications.steps.notes.*')"
            >
                <x-link
                    :href="route('managements.jobs.applications.steps.notes.index', [
                               request()->route('job'),
                               request()->route('application'),
                               request()->route('step'),
                           ])"
                >
                    Catatan
                </x-link>
            </x-quantum.nav-tab-item>
        @endcan

        @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_COMMUNICATION->value)
            <x-quantum.nav-tab-item
                :active="url()->current() === route('managements.jobs.applications.steps.show', [
                                                  request()->route('job'),
                                                  request()->route('application'),
                                                  request()->route('step'),
                                              ])"
            >
                <x-link
                    :href="route('managements.jobs.applications.steps.show', [
                               request()->route('job'),
                               request()->route('application'),
                               request()->route('step'),
                           ])"
                >
                    Kirim Email
                </x-link>
            </x-quantum.nav-tab-item>
        @endcan
    </x-quantum.nav-tab>
</div>
