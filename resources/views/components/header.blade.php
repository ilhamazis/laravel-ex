<header {{ $attributes->merge(['class' => 'header']) }}>
    <div class="header__left">
        <div class="header__group">
            <a href="{{ route('home') }}" class="header__identity">
                <img class="header__logo" src="{{ asset('assets/images/logo_sevima-career.svg') }}"
                     alt="Logo Sevima Career">
            </a>
        </div>
        <div class="header__navigation">
            <nav class="nav">
                <ul class="nav__list" data-more-text="Lainnya">
                    <li @class(['nav__item', 'active' => request()->routeIs('dashboard')])>
                        <x-link class="nav__link" href="{{ route('dashboard') }}">
                            <span>Dashboard</span>
                        </x-link>
                    </li>
                    <li @class(['nav__item', 'active' => request()->routeIs('managements.jobs.*')])>
                        <x-link class="nav__link" href="{{ route('managements.jobs.index') }}">
                            <span>Jobs</span>
                        </x-link>
                    </li>
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