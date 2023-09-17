@props(['paths' => []])

<ul class="form-nav__breadcrumb">
    @foreach($paths as $path)
        @if($loop->last)
            <li class="form-nav__breadcrumb-item active">{{ $path['title'] }}</li>
        @else
            <li class="form-nav__breadcrumb-item">
                <a wire:navigate href="{{ $path['link'] }}" class="form-nav__breadcrumb-btn">{{ $path['title'] }}</a>
            </li>

            <li class="form-nav__breadcrumb-diagonal"></li>
        @endif
    @endforeach
</ul>