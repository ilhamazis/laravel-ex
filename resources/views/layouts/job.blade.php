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
            <x-cms.job.card-navigation/>

            {{ $slot }}
        </div>
    </div>
</x-app-layout>
