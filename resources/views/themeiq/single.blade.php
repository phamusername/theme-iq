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
                        <div class="focus-info-tag type"><a
                                href="//www.iq.com/film-library?value=7128547076428233;must&amp;chnid=4"
                                data-pb="block=library_channel&amp;rpage=album&amp;rseat=7128547076428233"><span
                                    class="type-style">Trung Quốc đại lục</span></a><a
                                href="//www.iq.com/film-library?value=3134563320729933;must&amp;chnid=4"
                                data-pb="block=library_channel&amp;rpage=album&amp;rseat=3134563320729933"><span
                                    class="type-style">Tiếng Phổ Thông</span></a><a
                                href="//www.iq.com/film-library?value=1425950065128833;must&amp;chnid=4"
                                data-pb="block=library_channel&amp;rpage=album&amp;rseat=1425950065128833"><span
                                    class="type-style">Hài Hước</span></a><a
                                href="//www.iq.com/film-library?value=3158628296160833;must&amp;chnid=4"
                                data-pb="block=library_channel&amp;rpage=album&amp;rseat=3158628296160833"><span
                                    class="type-style">Tình Yêu</span></a></div>
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
                            <a href="{{ $watchUrl }}" class="btn-item btn-play"
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
                                    <li class="nav-item" role="presentation">
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
                                    </li>
                                </ul>
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
    <script src="/themes/iq/js/details.js?ver=1.0.1"></script>
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
