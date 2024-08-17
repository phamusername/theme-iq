@extends('themes::themeiq.layout')

@push('header')
    <link rel='stylesheet' href='/themes/iq/css/details/play2.css' type='text/css' />
@endpush
@section('content')
    <div class="TPost A D">
        <div class="Container">
            <div class="intl-play-container">
                <div class="intl-play-left">
                    <div class="VideoPlayer">
                        <div style="display:flex; aspect-ratio: 16 / 9;" id="player-loaded"></div>
                    </div>
                    <div class="basis-2/4 text-center pt-2">
                        <span class="text-sm font-medium pb-2 block uppercase">Đổi Server (Nếu Lag)</span>
                        <div class="flex flex-row flex-wrap gap-2 items-center justify-center">
                            @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                <a onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}"
                                    data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                                    style="text-decoration: none; border-color: rgb(63 63 70) !important; cursor: pointer;"
                                    class="streaming-server hover:cursor-pointer text-gray-300 border border-zinc-700 px-2 py-2 text-xs font-medium rounded">Server
                                    {{ $loop->iteration }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="intl-play-right">
                    <div class="MainContainer">
                        <section class="SeasonBx AACrdn" style="padding: 0 16px">
                            <div class="Top AAIco-playlist_play AALink episodes-view episodes-load">
                                <div class="Title">Danh sách tập</div>
                                <center style="padding:10px">
                                    <input type="text" id="searchBox"
                                        placeholder="Tìm tập phim..."
                                        style="background: 0 0; border: 1px solid #fff; height: 32px; width: 200px; padding: 5px; color:#fff; border-radius: 3px !important">
                                </center>
                                <div class="loading-placeholder"></div>
                            </div>
                            <ul class="AZList">
                                @foreach ($currentMovie->episodes->groupBy('server') as $server => $data)
                                    <div class="w-full">
                                        <h3>{{ $server }}</h3>
                                    </div>
                                    @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                        <li>
                                            <a class="@if ($item->contains($episode)) active @endif"
                                                href="{{ $item->first()->getUrl() }}"
                                                title="{{ $name }}">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="Container">
            <div class="TpRwCont ">
                <main class="episodes.show">
                    <div class="row infor-watching">
                        <div class="col__left">
                            <div class="info-detail">
                                <h3 class="title" style="color: rgb(169, 169, 172)">
                                    <a href="{{ $currentMovie->getUrl() }}" class="title-link">
                                        <span class="intl-album-title-word-wrap" style="font-size: 20px">
                                            {{ $currentMovie->name }}
                                        </span>
                                        <svg width="10px" height="41px" viewBox="0 0 25 41" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="页面-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="轮播图元素-2" transform="translate(-324.000000, -2225.000000)"
                                                    fill="#FFFFFF" fill-rule="nonzero">
                                                    <g id="06-箭头" transform="translate(100.000000, 2102.000000)">
                                                        <g id="hover" transform="translate(200.000000, 78.000000)">
                                                            <path
                                                                d="M44.1666667,52 L44.1666667,56.8372093 C44.1667695,57.3894941 43.7190542,57.8372093 43.1667695,57.8372093 C43.1667352,57.8372093 43.1667009,57.8372093 43.1666667,57.8371065 L22,57.8349302 L22,57.8349302 L22,78.4883721 C22,79.0406568 21.5522847,79.4883721 21,79.4883721 L16,79.4883721 C15.4477153,79.4883721 15,79.0406568 15,78.4883721 L15,55.5581395 L15,55.5581395 C15,53.1551754 16.9037148,51.1865074 19.3183879,51.0125024 L19.6666667,51 L43.1666667,51 C43.7189514,51 44.1666667,51.4477153 44.1666667,52 Z"
                                                                id="箭头/右-"
                                                                transform="translate(29.583333, 65.244186) scale(-1, 1) rotate(-45.000000) translate(-29.583333, -65.244186) ">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    Tập {{ $episode->name }}
                                </h3>
                                <div class="intl-play-time ">
                                    <span class="focus-item-label-original">{{ request()->getHost() }} sản xuất</span>
                                    <div class="broken-line"></div>
                                    <span>{{ $currentMovie->publish_year }}</span>
                                    <div class="broken-line h5-hide"></div>
                                    <div class="broken-line h5-hide"></div>
                                    <span class="update-set">Cập nhật tới
                                        @if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '')
                                            @php
                                                $currentMovie->episodes
                                                    ->sortBy([['name', 'desc'], ['type', 'desc']])
                                                    ->sortByDesc('name', SORT_NATURAL)
                                                    ->unique('name')
                                                    ->take(1)
                                                    ->map(function ($episode) {
                                                        $name = str_replace('Tập', '', $episode->name); // Loại bỏ chữ "Tập" khỏi tên tập
                                                        echo 'Tập <i>' . $name . '</i>';
                                                    });
                                            @endphp
                                        @endif
                                        /
                                        tổng cộng {{ $currentMovie->episode_total }} tập
                                    </span>
                                </div>
                                <div class="intl-play-item-tags">
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
                                <div class="firm-desc">
                                    <span style="color: rgb(169, 169, 172)" class="prev-text">Đạo diễn: </span>
                                    <span class="desc-content">
                                        {!! count($currentMovie->directors)
                                            ? $currentMovie->directors->map(function ($director) {
                                                    return '<span class="tt-at"><a href="' .
                                                        $director->getUrl() .
                                                        '" tite="Đạo diễn ' .
                                                        $director->name .
                                                        '">' .
                                                        $director->name .
                                                        '</a></span>';
                                                })->implode(', ')
                                            : 'Đang cập nhật' !!}
                                    </span>
                                </div>
                                <div class="firm-desc">
                                    <span style="color: rgb(169, 169, 172)" class="prev-text">Diễn viên: </span>
                                    <span class="desc-content">
                                        {!! count($currentMovie->actors)
                                            ? $currentMovie->actors->map(function ($actor) {
                                                    return '<span class="tt-at"><a href="' .
                                                        $actor->getUrl() .
                                                        '" tite="Đạo diễn ' .
                                                        $actor->name .
                                                        '">' .
                                                        $actor->name .
                                                        '</a></span>';
                                                })->implode(', ')
                                            : 'Đang cập nhật' !!}
                                    </span>
                                </div>
                                <div class="banner-content__desc line-clamp-3">
                                    <span class="key"></span>
                                    <span style="color: rgb(169, 169, 172)">Miêu tả:</span>
                                    {!! $currentMovie->content !!}
                                    <div class="more-info">
                                        <span class="text">Hiển thị thêm</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div style="width: -webkit-fill-available" class="myui-panel myui-panel-bg clearfix">
                                    <style>
                                        @media only screen and (max-width: 767px) {
                                            .fb-comments {
                                                width: 100% !important;
                                            }
                                            .fb-comments iframe[style] {
                                                width: 100% !important;
                                            }
                                        }

                                        .fb-comments,
                                        .fb-comments span {
                                            background-color: #eee;
                                        }

                                        .fb-comments {
                                            margin-bottom: 20px;
                                        }
                                    </style>
                                    <div style="color:red;font-weight:bold;padding:5px">
                                        Lưu ý các bạn không nên nhấp vào các đường link ở phần bình luận, kẻ gian có thể đưa virut vào thiết bị hoặc hack mất facebook của các bạn.
                                    </div>
                                    <div data-order-by="reverse_time" id="commit-99011102" class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="" data-numposts="10"></div>
                                    <script>
                                        document.getElementById("commit-99011102").dataset.width = document.querySelector('.info-detail').clientWidth; // Set width based on col__left
                                    </script>
                                </div>
                            </div>
                            <div class="firm-propose">
                                <h2 style="font-size: 20px">
                                    Đề xuất cho bạn
                                </h2>
                                <div class="slider__column splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($movie_related as $movie)
                                                <li class="splide__slide">
                                                    <a href="{{ $movie->getUrl() }}">
                                                        <div class="splide__item">
                                                            <div class="splide__img-wrap">
                                                                <img src="{{ $movie->getThumbUrl() }}"
                                                                    alt="{{ $movie->name }}" class="splide__img">
                                                                <div class="episodes">Full</div>
                                                            </div>
                                                            <div class="splide__item-title">
                                                                {{ $movie->name }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col__right">
                            @include('themes::themeiq.sidebar')
                        </div> --}}
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            const splideByCate = new Splide(".idol-wrap .splide", {
                // Optional parameters
                start: 0,
                perPage: 5,
                perMove: 1,
                gap: 14,
                type: "slide",
                drag: "free",
                snap: true,
                arrows: true,
                lazyLoad: true,
                pagination: false,

                // Responsive breakpoint
                breakpoints: {
                    1679: {
                        perPage: 6,

                    },
                    1480: {
                        perPage: 5,

                    },
                    1200: {
                        perPage: 4,

                    },
                    768: {
                        perPage: 3,
                    }
                }
            });

            splideByCate.mount();

            $('.list-top-firm .firm-item-link').hover(function() {
                $('.list-top-firm .firm-item-link.active').removeClass('active');
                $(this).addClass('active');
            })

            function swapEpisode() {
                let windowWidth = $(window).width();
                if (windowWidth <= 1024) {
                    let episode = $('.watcher .episodes').html();
                    $('.episodes-response').html(episode);
                } else {
                    let episode = $('.episodes-response').html();
                    if (episode.trim().length !== 0) {
                        $('.watcher .episodes').html(episode);
                    }
                }
            }

            swapEpisode();
            $(window).on("resize", function() {
                swapEpisode();
            })

            var hiddenElement = $(".BtnLight.AAIco-lightbulb_outline");

            function hideElementF() {
                hiddenElement.hide();
            }

            function showElementF() {
                hiddenElement.show();
            }

            $(document).ready(function() {
                setInterval(hideElementF, 5000); // Hide element every 5 seconds

                $(document).on('click', function() {
                    showElementF();
                    clearTimeout(autoHideTimeout);
                    autoHideTimeout = setTimeout(hideElementF, 5000);
                });

                var autoHideTimeout = setTimeout(hideElementF, 5000);
            });
        })
        console.log('Design by: @gggforyou')
    </script> --}}
    <script>
        $(document).ready(function() {
            const splideByCate = new Splide(".firm-propose .splide", {
                // Optional parameters
                start: 0,
                perPage: 5,
                perMove: 1,
                gap: 14,
                type: "slide",
                drag: "free",
                snap: true,
                arrows: true,
                lazyLoad: true,
                pagination: false,

                // Responsive breakpoint
                breakpoints: {
                    1679: {
                        perPage: 6,

                    },
                    1480: {
                        perPage: 5,

                    },
                    1200: {
                        perPage: 4,

                    },
                    768: {
                        perPage: 3,
                    }
                }
            });

            splideByCate.mount();

            $('.list-top-firm .firm-item-link').hover(function() {
                $('.list-top-firm .firm-item-link.active').removeClass('active');
                $(this).addClass('active');
            })

            function swapEpisode() {
                let windowWidth = $(window).width();
                if (windowWidth <= 1024) {
                    let episode = $('.watcher .episodes').html();
                    $('.episodes-response').html(episode);
                } else {
                    let episode = $('.episodes-response').html();
                    if (episode.trim().length !== 0) {
                        $('.watcher .episodes').html(episode);
                    }
                }
            }

            swapEpisode();
            $(window).on("resize", function() {
                swapEpisode();
            })

            var hiddenElement = $(".BtnLight.AAIco-lightbulb_outline");

            function hideElementF() {
                hiddenElement.hide();
            }

            function showElementF() {
                hiddenElement.show();
            }

            $(document).ready(function() {
                setInterval(hideElementF, 5000); // Hide element every 5 seconds

                $(document).on('click', function() {
                    showElementF();
                    clearTimeout(autoHideTimeout);
                    autoHideTimeout = setTimeout(hideElementF, 5000);
                });

                var autoHideTimeout = setTimeout(hideElementF, 5000);
            });
        })
        console.log('Design by: @gggforyou')
    </script>

    {{-- <link rel='stylesheet' href='/themes/iq/css/demo.css' type='text/css' /> --}}
    <script src="/themes/iq/js/details.js?ver=1.0.1"></script>
    <script type="text/javascript" src="/themes/iq/js/util.js"></script>
    <script src="/themes/iq/static/player/skin/juicycodes.js"></script>
    <link href="/themes/iq/static/player/skin/juicycodes.css" rel="stylesheet" type="text/css">
    {{-- <link rel='stylesheet' href='/themes/iq/css/details/index.css?ver=1.0.1' type='text/css' /> --}}

    {{--    <script src="/themes/iq/static/player/js/p2p-media-loader-core.min.js"></script> --}}
    {{--    <script src="/themes/iq/static/player/js/p2p-media-loader-hlsjs.min.js"></script> --}}

    <script src="/themes/iq/static/player/jwplayer.js"></script>
    {{--    <script src="/js/jwplayer-8.9.3.js"></script> --}}
    {{--    <script src="/js/hls.min.js"></script> --}}
    {{--    <script src="/js/jwplayer.hlsjs.min.js"></script> --}}


    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player-loaded');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";
        $("a[onclick^=\"chooseStreamingServer\"]").eq(0).addClass("active")

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;

            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('bg-black');
            })
            el.classList.add('bg-black')

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/iq/static/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe sandbox = "allow-same-origin allow-scripts" width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    file: link,
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    autostart: true,
                    controls: true,
                    primary: "html5",
                    playbackRateControls: true,
                    playbackRates: [0.5, 0.75, 1, 1.5, 2],
                    // sharing: {
                    //     sites: [
                    //         "reddit",
                    //         "facebook",
                    //         "twitter",
                    //         "googleplus",
                    //         "email",
                    //         "linkedin",
                    //     ],
                    // },
                    volume: 100,
                    mute: false,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua",
                        admessage: "Quảng cáo còn xx giây."
                    },
                    tracks: [{
                        "file": "/sub.vtt",
                        "kind": "captions",
                        label: "VN",
                        default: "true"
                    }],
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    // if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                    //     var engine = new p2pml.hlsjs.Engine(engine_config);
                    //     player.setup(objSetup);
                    //     jwplayer_hls_provider.attach();
                    //     p2pml.hlsjs.initJwPlayer(player, {
                    //         liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                    //         maxBufferLength: 300,
                    //         loader: engine.createLoaderClass(),
                    //     });
                    // } else {
                    player.setup(objSetup);
                    // }
                } else {
                    player.setup(objSetup);
                }

                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind2" viewBox="0 0 240 240" focusable="false"><path d="m 25.993957,57.778 v 125.3 c 0.03604,2.63589 2.164107,4.76396 4.8,4.8 h 62.7 v -19.3 h -48.2 v -96.4 H 160.99396 v 19.3 c 0,5.3 3.6,7.2 8,4.3 l 41.8,-27.9 c 2.93574,-1.480087 4.13843,-5.04363 2.7,-8 -0.57502,-1.174985 -1.52502,-2.124979 -2.7,-2.7 l -41.8,-27.9 c -4.4,-2.9 -8,-1 -8,4.3 v 19.3 H 30.893957 c -2.689569,0.03972 -4.860275,2.210431 -4.9,4.9 z m 163.422413,73.04577 c -3.72072,-6.30626 -10.38421,-10.29683 -17.7,-10.6 -7.31579,0.30317 -13.97928,4.29374 -17.7,10.6 -8.60009,14.23525 -8.60009,32.06475 0,46.3 3.72072,6.30626 10.38421,10.29683 17.7,10.6 7.31579,-0.30317 13.97928,-4.29374 17.7,-10.6 8.60009,-14.23525 8.60009,-32.06475 0,-46.3 z m -17.7,47.2 c -7.8,0 -14.4,-11 -14.4,-24.1 0,-13.1 6.6,-24.1 14.4,-24.1 7.8,0 14.4,11 14.4,24.1 0,13.1 -6.5,24.1 -14.4,24.1 z m -47.77056,9.72863 v -51 l -4.8,4.8 -6.8,-6.8 13,-12.99999 c 3.02543,-3.03598 8.21053,-0.88605 8.2,3.4 v 62.69999 z"></path></svg>',
                    "Forward 10 Seconds", () => player.seek(player.getPosition() + 10), "Forward 10 Seconds");
                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind" viewBox="0 0 240 240" focusable="false"><path d="M113.2,131.078a21.589,21.589,0,0,0-17.7-10.6,21.589,21.589,0,0,0-17.7,10.6,44.769,44.769,0,0,0,0,46.3,21.589,21.589,0,0,0,17.7,10.6,21.589,21.589,0,0,0,17.7-10.6,44.769,44.769,0,0,0,0-46.3Zm-17.7,47.2c-7.8,0-14.4-11-14.4-24.1s6.6-24.1,14.4-24.1,14.4,11,14.4,24.1S103.4,178.278,95.5,178.278Zm-43.4,9.7v-51l-4.8,4.8-6.8-6.8,13-13a4.8,4.8,0,0,1,8.2,3.4v62.7l-9.6-.1Zm162-130.2v125.3a4.867,4.867,0,0,1-4.8,4.8H146.6v-19.3h48.2v-96.4H79.1v19.3c0,5.3-3.6,7.2-8,4.3l-41.8-27.9a6.013,6.013,0,0,1-2.7-8,5.887,5.887,0,0,1,2.7-2.7l41.8-27.9c4.4-2.9,8-1,8,4.3v19.3H209.2A4.974,4.974,0,0,1,214.1,57.778Z"></path></svg>',
                    "Rewind 10 Seconds", () => player.seek(player.getPosition() - 10), "Rewind 10 Seconds");

                const resumeData = 'OPCMS-PlayerPosition-' + id;

                player.on('error', function() {
                    // Hiển thị thông báo lỗi
                    // fx.messageBox(
                    //     "Lỗi",
                    //     "Phim <strong>{{ $currentMovie->name }} - {{ $currentMovie->origin_name }} Tập {{ $episode->name }}</strong> bạn đang xem hiện tại đã bị lỗi, hãy nhấn vào <a href='' target='_blank'><span style='color: red; font-weight: bold;'>đây</span></a> để báo cho chúng tôi qua Telegram để chúng tôi sửa lỗi sớm nhất có thể.",
                    // );
                    $("a[onclick^=\"chooseStreamingServer\"].active").removeClass(".active").next().click()
                        .addClass(".active")
                });
                player.on('error', function() {
                    // Hiển thị thông báo lỗi
                    fx.messageBox(
                        "Lỗi",
                        "Phim <strong>{{ $currentMovie->name }} - {{ $currentMovie->origin_name }} Tập {{ $episode->name }}</strong> bạn đang xem hiện tại đã bị lỗi, hãy nhấn vào <a href='' target='_blank'><span style='color: red; font-weight: bold;'>đây</span></a> để báo cho chúng tôi qua Telegram để chúng tôi sửa lỗi sớm nhất có thể.",
                    );

                });

                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
    <script>
        let searchBtn = document.getElementById("searchBox");



        let lists = document.getElementsByClassName("AZList");
        // 		let list = document.getElementsByClassName("episodes")[0].getElementsByTagName("li");

        searchBtn.addEventListener("click", searchList);
        searchBox.addEventListener("keyup", searchList);


        function searchList() {

            let searchTerm = searchBox.value.toLowerCase();

            for (let j = 0; j < lists.length; j++) {

                list = lists[j].getElementsByTagName("li");


                for (let i = 0; i < list.length; i++) {
                    let item = list[i].getElementsByTagName('a')[0].innerHTML.toLowerCase();

                    if (item.indexOf(searchTerm) > -1) {
                        list[i].style.display = "";

                    } else {
                        list[i].style.display = "none";
                    }
                }
            }

        }
    </script>
@endpush
