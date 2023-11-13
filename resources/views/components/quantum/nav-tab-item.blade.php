@props(['active' => false])

<li @class(['nav-tab__item', 'active' => $active])>
    {{ $slot }}
</li>
