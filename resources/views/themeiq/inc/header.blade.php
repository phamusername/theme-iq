@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp
<div class="header">
    <div class="header-container">
        <div class="row wrap-header">
            <div class="header__left">
                <ul class="navbar__list header-respon-sidebar mr-3">
                    <li class="navbar__list--item">
                        <i class="fa-solid fa-bars"></i>
                    </li>
                </ul>
                <div class="header__logo">
                    <a href="/" class="logo" title="{{ $title }}">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </a>
                </div>
                <ul class="navbar__list">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                            <li class="navbar__list--item">
                                <a href="javascript:void(0)" title="{{ $item['name'] }}">
                                    {{ $item['name'] }}
                                </a>
                                <ul class="dropdown-nav">
                                    @foreach ($item['children'] as $children)
                                        <li class="dropdown-nav__item">
                                            <a href="{{ $children['link'] }}"
                                                title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="navbar__list--item">
                                <a title="{{ $item['name'] }}" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <ul class="navbar__list respon-navbar-left">

                </ul>
            </div>
            <div class="header__right">
                <div class="header-search">
                    <form id="search-form" action="/" method="get">
                        <input type="text" placeholder="Tìm kiếm phim" name="search" id="key-search"
                            autocomplete="off" value="">
                        <button class="btn-search" type="submit">
                            <div class="search-btn" role="button" tabindex="0" aria-label="search button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </button>
                        <span class="line"></span>
                    </form>
                    <div class="search-suggest search-list-container" style="display: none"></div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <ul class="respon-navbar-second-row">
                @foreach ($menu as $item)
                    @if (count($item['children']))
                        <li>
                            <a href="javascript:void(0)" title="{{ $item['name'] }}">
                                {{ $item['name'] }}
                            </a>
                            <ul style="position: fixed" class="dropdown-nav">
                                @foreach ($item['children'] as $children)
                                    <li class="dropdown-nav__item">
                                        <a href="{{ $children['link'] }}"
                                            title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a class="link-active" title="{{ $item['name'] }}"
                                href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div> --}}
    </div>
</div>
<div class="menu-box m-nav">
    <div class="menu-background"></div>
    <div class="menu-content">
        <button class="m-nav-close">×</button>
        <div class="nav-ct">
            <ul>
                @foreach ($menu as $item)
                    @if (count($item['children']))
                        <li class="channel-item">
                            <button type="button" class="acd-drop"></button>
                            <a href="{{ $item['link'] }}" class="channel-item--link">{{ $item['name'] }}</a>
                            <ul>
                                @foreach ($item['children'] as $children)
                                    <li>
                                        <a href="{{ $children['link'] }}"
                                            title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0)" title="{{ $item['name'] }}">
                                {{ $item['name'] }}
                            </a>
                            <ul style="position: fixed" class="dropdown-nav">
                                @foreach ($item['children'] as $children)
                                    <li class="dropdown-nav__item">
                                        <a href="{{ $children['link'] }}"
                                            title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li> --}}
                    @else
                        <li class="channel-item">
                            <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

