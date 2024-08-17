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
                    <div class="search-suggest search-list-container">
                        <div class="hotSearch-title">Tìm kiếm hot</div>
                        <a href="" class="lists-item hotSearch-item">
                            <i>1</i>
                            <span>Tứ Hải Trọng Minh</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
        </div>
    </div>
</div>
<style>
    @media (max-width: 768px) {
        .dropdown-nav {
            display: none;
            /* Hide dropdowns by default */
            flex-wrap: wrap;
            /* Allow items to wrap to the next line */
            padding: 0;
            /* Remove default padding */
            margin: 0;
            /* Remove default margin */
            list-style: none;
            /* Remove bullet points */
            position: absolute;
            /* Position it absolutely */
            background: white;
            /* Background color for dropdown */
            z-index: 1000;
            /* Ensure it appears above other content */
            width: 100%;
            /* Full width of the parent */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Optional shadow for dropdown */
        }

        .dropdown-nav.active {
            display: flex;
            /* Show dropdown when active */
        }

        .dropdown-nav__item {
            flex: 0 1 calc(33.33% - 10px);
            /* Each item takes roughly 1/3 width minus margin */
            margin: 5px;
            /* Space between items */
            box-sizing: border-box;
            /* Include padding and border in width */
        }

        .dropdown-nav__item a {
            display: block;
            /* Make the link fill the entire item */
            padding: 10px 15px;
            /* Add padding for better touch targets */
            text-align: left;
            /* Align text to the left */
            color: #333;
            /* Text color */
            text-decoration: none;
            /* Remove underline */
            width: 100%;
            /* Ensure the link takes full width */
        }

        .dropdown-nav__item a:hover {
            background-color: #f0f0f0;
            /* Change background on hover */
        }

    }

    .header__right {
        position: relative;
        /* Position relative for absolute children */
    }

    .header-search {
        width: 100%;
        /* Ensure the search container takes full width */
    }

    #search-form {
        display: flex;
        /* Use flexbox for layout */
        align-items: center;
        /* Center items vertically */
    }

    #key-search {
        flex: 1;
        /* Allow the input to grow */
        padding: 10px;
        /* Add some padding */
        border: 1px solid #ccc;
        /* Border for the input */
        border-radius: 4px;
        /* Rounded corners */
    }

    .btn-search {
        background: transparent;
        /* Transparent background */
        border: none;
        /* No border */
        cursor: pointer;
        /* Pointer cursor on hover */
    }

    .search-suggest {
        position: absolute;
        /* Position it absolutely */
        top: 100%;
        /* Align it below the search form */
        left: 0;
        /* Align it to the left */
        width: 100%;
        /* Same width as the form */
        background: rgb(26, 28, 34);
        /* Background color */
        border: 1px solid rgba(255, 255, 255, 0.12);
        /* Border color */
        border-radius: 4px;
        /* Rounded corners */
        z-index: 1000;
        /* Ensure it appears above other content */

        max-height: 486px;
        /* Limit the height */
        overflow-y: auto;
        /* Allow scrolling if needed */
        box-sizing: border-box;
        /* Include padding and border in width/height */
    }

    .search-suggest.active {
        display: block;
    }

    .hotSearch-title {
        width: 100%;
        height: 32px;
        line-height: 32px;
        font-size: 12px;
        color: rgb(153, 153, 153);
        padding: 0 16px;
        box-sizing: border-box;
    }

    .lists-item {
        display: flex;
        align-items: center;
        padding: 7px;
        font-size: 14px;
        color: rgb(204, 204, 204);
        transition: background-color 0.2s;
        max-height: 60px;
        text-decoration: none;
    }

    .lists-item:hover {
        background-color: rgba(240, 240, 240, 0.2);
    }

    .lists-item i {
        line-height: 14px;
        /* Icon height */
        font-weight: 700;
        /* Bold icon */
        margin-right: 5px
    }

    .lists-item p {
        color: rgb(188, 189, 190);
        /* Text color */
        margin-left: 8px;
        /* Space between icon and text */
        min-height: 16px;
        /* Minimum height */
        max-height: 32px;
        /* Maximum height */
        font-size: 14px;
        /* Font size */
        line-height: 16px;
        /* Line height */
        overflow: hidden;
        /* Hide overflow */
        text-overflow: ellipsis;
        /* Ellipsis for overflow text */
        display: -webkit-box;
        /* Create a flexible box */
        -webkit-box-orient: vertical;
        /* Vertical orientation */
        -webkit-line-clamp: 2;
        /* Limit to 2 lines */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.respon-navbar-second-row > li > a');

        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link behavior
                const dropdown = this.nextElementSibling; // Get the dropdown

                // Toggle dropdown visibility
                if (dropdown && dropdown.classList.contains('dropdown-nav')) {
                    dropdown.classList.toggle('active');
                }

                // Close other dropdowns
                document.querySelectorAll('.dropdown-nav').forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('active');
                    }
                });
            });
        });
    });
</script>
