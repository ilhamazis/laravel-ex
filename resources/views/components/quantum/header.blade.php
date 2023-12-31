<header {{ $attributes->merge(['class' => 'header']) }}>
    <div class="header__left">
        <div class="header__group">
            <x-link :href="route('home')" class="header__identity">
                <img class="header__logo" src="{{ asset('assets/images/logo_sevima-career.svg') }}"
                     alt="Logo Sevima Career">
            </x-link>
        </div>
        <div class="header__navigation">
            <nav class="nav">
                <ul class="nav__list" data-more-text="Lainnya">
                    <li @class(['nav__item', 'active' => request()->routeIs('dashboard')])>
                        <x-link class="nav__link" href="{{ route('dashboard') }}">
                            <span>Beranda</span>
                        </x-link>
                    </li>
                    @can(\App\Enums\PermissionEnum::VIEW_JOB->value)
                        <li @class(['nav__item', 'active' => request()->routeIs('managements.jobs.*')])>
                            <x-link class="nav__link" href="{{ route('managements.jobs.index') }}">
                                <span>Lowongan Pekerjaan</span>
                            </x-link>
                        </li>
                    @endcan
                    @can(\App\Enums\PermissionEnum::VIEW_APPLICATION->value)
                        <li @class(['nav__item', 'active' => request()->routeIs('managements.applications.*')])>
                            <x-link class="nav__link" href="{{ route('managements.applications.index') }}">
                                <span>Pelamar</span>
                            </x-link>
                        </li>
                    @endcan
                    @can(\App\Enums\PermissionEnum::VIEW_TEMPLATE->value)
                        <li @class(['nav__item', 'active' => request()->routeIs('managements.templates.*')])>
                            <x-link class="nav__link" href="{{ route('managements.templates.index') }}">
                                <span>Template</span>
                            </x-link>
                        </li>
                    @endcan
                </ul>
            </nav>
        </div>
    </div>
    <div class="header__right">
        <div class="dropdown dropdown_nav dropdown_profile">
            <button class="header__user" data-toggle="dropdown">
                    <span class="header__user-wrapper">
                        <span class="header__user-info">
                            <span class="header__user-name">{{ auth()->user()->name }}</span>
                            <span class="header__user-role">{{ auth()->user()->email }}</span>
                        </span>
                    </span>
                <span class="icon icon-chevron-down-solid"></span>
            </button>
            <div class="dropdown__box dropdown__box_menu-end">
                <ul class="dropdown__list">
                    <li class="dropdown__item">
                        <a href="#">Manage Account</a>
                    </li>
                    <li class="dropdown__line"></li>
                    <li class="dropdown__item dropdown__item_danger">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <span class="icon icon-arrow-left-on-rectangle-mini"></span>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
