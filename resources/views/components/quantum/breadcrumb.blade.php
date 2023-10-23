@props(['paths' => []])

<ul class="breadcrumb">
    <li class="breadcrumb__item">
        <a href="{{ route('home') }}">
            <span class="icon icon-home-solid"></span>
        </a>
    </li>
    @foreach($paths as $path)
        @if($loop->last)
            <li class="breadcrumb__item active">{{ $path['title'] }}</li>
        @else
            <li class="breadcrumb__item">
                <x-link href="{{ $path['link'] }}">{{ $path['title'] }}</x-link>
            </li>
        @endif
    @endforeach
</ul>