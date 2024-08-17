@extends('themes::themeiq.layout')

@php
    $watchUrl = '#';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watchUrl = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
    if ($currentMovie->status == 'trailer') {
        $watchUrl = 'javascript:alert("Phim đang được cập nhật!")';
    }
@endphp

@section('content')
    <link rel='stylesheet' href='/themes/iq/css/details/index.css?ver=1.0.1' type='text/css' />
    <section class="banner">
        <div class="wrap-banner">
            <div class="row">
                <div class="col__left">
                    <div class="banner-content">
                        <div class="banner-content__title">
                            <h1>{{ $currentMovie->name }}</h1>
                        </div>
                        <span class="banner-content__top">
                            <div class="top">
                                @if ($currentMovie->status == 'ongoing')
                                    Đang chiếu
                                @elseif ($currentMovie->status == 'completed')
                                    Hoàn thành
                                @else
                                    Trailer
                                @endif
                            </div>
                            {{ $currentMovie->origin_name }}
                        </span>
                        <div class="banner-content__infor">
                            <div class="rate">
                                <i class="fas fa-star"></i> {{ $currentMovie->getRatingStar() }}
                            </div>
                            <div class="year after-item">
                                {{ $currentMovie->publish_year }}
                            </div>
                            <div class="week after-item">
                                Cập nhật tới tập {{ $currentMovie->episode_current }}
                            </div>
                            <div class="episode_number after-item">
                                Phim bộ
                            </div>
                        </div>
                        <div class="focus-info-tag type">
                            {!! $currentMovie->categories->map(function ($category) {
                                    return '<a href="' .
                                        $category->getUrl() .
                                        '" tite="' .
                                        $category->name .
                                        '"><span>' .
                                        $category->name .
                                        '</span></a>';
                                })->implode(', ') !!}
                            {!! $currentMovie->regions->map(function ($region) {
                                    return '<a href="' .
                                        $region->getUrl() .
                                        '" tite="' .
                                        $region->name .
                                        '"><span>' .
                                        $region->name .
                                        '</span></a>';
                                })->implode(', ') !!}
                            <a><span>{{ $currentMovie->language }}</span></a>
                        </div>
                        <div class="focus-info-tag">
                            <span class="key">Đạo diễn:</span>
                            <span>
                                {!! count($currentMovie->directors)
                                    ? $currentMovie->directors->map(function ($director) {
                                            return '<a href="' .
                                                $director->getUrl() .
                                                '" tite="Đạo diễn ' .
                                                $director->name .
                                                '">' .
                                                $director->name .
                                                '</a>';
                                        })->implode(', ')
                                    : 'Đang cập nhật' !!}
                            </span>
                        </div>
                        <div class="focus-info-tag">
                            <span class="key">Diễn viên:</span>
                            <span>
                                {!! count($currentMovie->actors)
                                    ? $currentMovie->actors->map(function ($actor) {
                                            return '<a href="' . $actor->getUrl() . '" tite="Đạo diễn ' . $actor->name . '">' . $actor->name . '</a>';
                                        })->implode(', ')
                                    : 'Đang cập nhật' !!}
                            </span>
                        </div>
                        <div class="focus-info-tag">
                            <span class="key">Thể loại:</span>
                            <span>
                                {!! $currentMovie->categories->map(function ($category) {
                                        return '<a href="' . $category->getUrl() . '" tite="' . $category->name . '">' . $category->name . '</a>';
                                    })->implode(', ') !!}
                            </span>
                        </div>
                        <div class="banner-content__desc line-clamp-3">
                            <span class="key"></span>
                            {!! $currentMovie->content !!}
                            <div class="more-info">
                                <span class="text">Hiển thị thêm</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="group-btn">
                            <a style="background-color: rgb(28, 199, 73)" href="{{ $watchUrl }}" class="btn-item btn-s"
                                title="Xem Phim {{ $currentMovie->name }}">
                                <i class="fa-solid fa-play"></i>
                                Xem Phim
                            </a>
                            <a href="javascript:void(0)" title="Chia sẻ lên facebook"
                                onclick="window.open('http://www.facebook.com/sharer.php?u={{ $currentMovie->getUrl() }}', 'Facebook', 'toolbar=0, status=0, width=650, height=450');"
                                class="btn-item btn-facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="javascript:void(0)" title="Chia sẻ lên twitter"
                                onclick="window.open('https://twitter.com/intent/tweet?original_referer={{ $currentMovie->getUrl() }}&amp;text={{ $currentMovie->name }}&amp;tw_p=tweetbutton&amp;url={{ $currentMovie->getUrl() }}', 'Twitter', 'toolbar=0, status=0, width=650, height=450');"
                                class="btn-item btn-twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col__right">
                    <div class="wrap-banner-img">
                        <img src="{{ $currentMovie->getPosterUrl() }}" class="banner-img" alt="{{ $currentMovie->name }}">
                        <div class="left-layer"></div>
                        <div class="bottom-layer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="Main Container">
        <div class="TpRwCont ">
            <main class="movies.show">
                <section class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-pills mb-3 tab-content-ul" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-propose-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-propose" type="button" role="tab"
                                            aria-controls="pills-propose" aria-selected="false">Đề xuất cho bạn
                                        </button>
                                    </li>
                                    @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-firm-tab-{{ $loop->index + 1 }}"
                                                data-bs-toggle="pill" data-bs-target="#pills-firm-{{ $loop->index + 1 }}"
                                                type="button" role="tab"
                                                aria-controls="pills-firm-{{ $loop->index + 1 }}" aria-selected="false">
                                                Danh sách tập <span>{{ $server }}</span>
                                            </button>
                                        </li>
                                    @endforeach
                                    {{-- <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-firm-tab-1" data-bs-toggle="pill"
                                            data-bs-target="#pills-firm-1" type="button" role="tab"
                                            aria-controls="pills-firm-1" aria-selected="false">
                                            Danh sách tập <span>Thuyết minh</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-firm-tab-2" data-bs-toggle="pill"
                                            data-bs-target="#pills-firm-2" type="button" role="tab"
                                            aria-controls="pills-firm-2" aria-selected="false">
                                            Danh sách tập <span>Vietsub</span>
                                        </button>
                                    </li> --}}
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-propose" role="tabpanel"
                                        aria-labelledby="pills-propose-tab">
                                        <div class="firm-propose video-list-wrapper">
                                            @foreach ($movie_related as $movie)
                                                <a href="{{ $movie->getUrl() }}" class="video-item">
                                                    <div class="video-item-img">
                                                        <img src="{{ $movie->getThumbUrl() }}" alt=""
                                                            class="desc-img">
                                                        <div class="video-item-img-layer">
                                                            <div class="update-info-mask">{{ $movie->episode_current }}
                                                            </div>
                                                        </div>
                                                        <div class="wrap " role="button" aria-label="play-button"
                                                            tabindex="0" rseat="0"
                                                            data-pb="block=album_information&amp;r=3513185601796900&amp;a=play&amp;rpage=album">
                                                            <svg width="60px" height="60px" viewBox="0 0 60 60"
                                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                class="play-button">
                                                                <g id="Btn/Play/Normal" stroke="none" stroke-width="1"
                                                                    fill="none" fill-rule="evenodd">
                                                                    <circle id="bg" fill="#1CC749" cx="30"
                                                                        cy="30" r="30"></circle>
                                                                    <path
                                                                        d="M35.7461509,22.4942263 L45.1405996,36.5858994 C46.059657,37.9644855 45.6871354,39.8270935 44.3085493,40.7461509 C43.8157468,41.0746859 43.2367237,41.25 42.6444487,41.25 L23.8555513,41.25 C22.198697,41.25 20.8555513,39.9068542 20.8555513,38.25 C20.8555513,37.657725 21.0308654,37.078702 21.3594004,36.5858994 L30.7538491,22.4942263 C31.6729065,21.1156403 33.5355145,20.7431187 34.9141006,21.662176 C35.2436575,21.8818806 35.5264463,22.1646695 35.7461509,22.4942263 Z"
                                                                        id="Triangle" fill="#FFFFFF"
                                                                        transform="translate(33.250000, 30.000000) rotate(-270.000000) translate(-33.250000, -30.000000) ">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="video-item-name">
                                                        {{ $movie->name }}
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                        <div class="tab-pane fade" id="pills-firm-{{ $loop->index + 1 }}"
                                            role="tabpanel" aria-labelledby="pills-firm-tab-{{ $loop->index + 1 }}">
                                            <div class="video-list-wrapper">
                                                @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                                    <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}"
                                                        class="video-item" title="Thế Giới Võ Hiệp: Kim Dung - Tập30">
                                                        <div class="video-item-img">
                                                            @php
                                                                $ep_link = $item->sortByDesc('type')->first()->link;
                                                                $ep_img = str_replace(
                                                                    'index.m3u8',
                                                                    '1.jpg',
                                                                    $ep_link,
                                                                    $check_replace,
                                                                );
                                                                if ($check_replace == 0) {
                                                                    $ep_img = $currentMovie->getPosterUrl();
                                                                }
                                                            @endphp
                                                            <img src="{{ $ep_img }}" alt=""
                                                                class="desc-img">
                                                            <div class="video-item-img-layer"></div>
                                                            <div class="wrap " role="button" aria-label="play-button"
                                                                tabindex="0" rseat="0"
                                                                data-pb="block=album_information&amp;r=3513185601796900&amp;a=play&amp;rpage=album">
                                                                <svg width="60px" height="60px" viewBox="0 0 60 60"
                                                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    class="play-button">
                                                                    <g id="Btn/Play/Normal" stroke="none"
                                                                        stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <circle id="bg" fill="#1CC749"
                                                                            cx="30" cy="30" r="30"></circle>
                                                                        <path
                                                                            d="M35.7461509,22.4942263 L45.1405996,36.5858994 C46.059657,37.9644855 45.6871354,39.8270935 44.3085493,40.7461509 C43.8157468,41.0746859 43.2367237,41.25 42.6444487,41.25 L23.8555513,41.25 C22.198697,41.25 20.8555513,39.9068542 20.8555513,38.25 C20.8555513,37.657725 21.0308654,37.078702 21.3594004,36.5858994 L30.7538491,22.4942263 C31.6729065,21.1156403 33.5355145,20.7431187 34.9141006,21.662176 C35.2436575,21.8818806 35.5264463,22.1646695 35.7461509,22.4942263 Z"
                                                                            id="Triangle" fill="#FFFFFF"
                                                                            transform="translate(33.250000, 30.000000) rotate(-270.000000) translate(-33.250000, -30.000000) ">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="video-item-name">
                                                            {{ $currentMovie->name }} - Tập {{ $name }}
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <style>
        .focus-info-tag {
            margin-top: 10px;
            color: rgb(255, 255, 255);
            font-size: 16px;
            letter-spacing: 0px;
            line-height: 22px;
            margin-bottom: 10px;
        }

        .focus-info-tag a:hover {
            color: rgb(28, 199, 73);
        }

        .intl-album-more-btn {
            color: rgb(28, 199, 73);
            font-weight: 600;
            text-decoration: none
        }

        @media screen and (min-width: 768px) and (max-width: 1023px) {
            .focus-info-tag {
                font-size: 14px;
                line-height: 16px;
                margin-top: 8px;
                margin-bottom: 8px;
            }
        }

        .focus-info-tag .tag-inline {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-bottom: 10px;
        }

        .focus-info-tag .key {
            color: rgb(169, 169, 172);
            font-size: 16px;
        }
    </style>
@endsection

@push('scripts')
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
