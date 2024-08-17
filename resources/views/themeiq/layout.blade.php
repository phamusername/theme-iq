@extends('themes::themeiq.layout_core')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $logo = setting('site_logo', '');
    preg_match('@src="([^"]+)"@', $logo, $match);

    // will return /images/image.jpg
    $logo = array_pop($match);
@endphp

@push('header')
    <link href="{{ url('/') }}" rel="alternate" hreflang="vi">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="/themes/iq/plugins/bootstrap/css/bootstrap.min.css?ver=1.0.1" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- splidejs -->
    <link href="/themes/iq/css/splide.min.css?ver=1.0.1" rel="stylesheet">
    <!-- css base -->
    <link rel='stylesheet' href='/themes/iq/css/global-styles.css?ver=1.0.1' type='text/css' />


    <!-- Page style -->
    <link rel='stylesheet' href='/themes/iq/css/dashboard/index.css?ver=1.0.1' type='text/css' />
    <link rel='stylesheet' href='/themes/iq/css/list.css?ver=1.0.1' type='text/css' />
@endpush

@section('body')
    <div class="app">
        @include('themes::themeiq.inc.header')
        <div class="main">
            @yield('content')
        </div>
    </div>
@endsection

@section('footer')
    <style>
        @media screen and (min-width: 768px) and (max-width: 1679px) {
            .dJvLcv {
                padding-bottom: 30px;
            }
        }

        .dJvLcv {
            z-index: auto;
            width: 100%;
            top: 0px;
            vertical-align: middle;
            background: rgb(10, 12, 15);
            border-top: 1px solid rgb(45, 47, 52);
            transition: background-color 0.5s linear;
            color: rgb(221, 221, 221);
            font-size: 14px;
            text-align: center;
            position: relative;
            padding-bottom: 40px;
        }
        .dJvLcv .footer-inner {
    width: 904px;
    height: 100%;
    margin: 0px auto;
    position: relative;
}
.dJvLcv .multiport-show .multiport-title {
    font-size: 20px;
    line-height: 20px;
    color: rgb(255, 255, 255);
    text-align: center;
    font-weight: 700;
    margin-top: 32px;
}
.dJvLcv .multiport-show .multiport-desc {
    font-size: 12px;
    color: rgb(169, 169, 172);
    font-weight: 400;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    height: 12px;
    line-height: 24px;
    margin-top: 16px;
}
.dJvLcv .footer-donwload-img {
    width: 48px;
}
.dJvLcv .multiport-show .multiport-content {
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    margin: 32px auto;
}
@media screen and (min-width: 1024px) and (max-width: 1679px) {
    .dJvLcv .multiport-show .multiport-content .multiport-pca {
        margin-right: 100px;
    }
}
.dJvLcv .multiport-show .multiport-content .multiport-pca {
    position: relative;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    margin-right: 120px;
}
.dJvLcv .multiport-show .multiport-content > div {
    background: rgb(35, 37, 43);
    border-radius: 4px;
    min-width: 132px;
    padding: 8px 12px;
    box-sizing: border-box;
    cursor: pointer;
}
.dJvLcv .multiport-show .multiport-content .multiport-pca svg {
    width: 20px;
    height: 20px;
}
.dJvLcv .multiport-show .multiport-content .multiport-pca > span {
    margin-left: 4px;
}
    </style>
    @if (get_theme_option('ads_catfish'))
        <div id="catfish" style="width: 100%;position:fixed;bottom:0;left:0;z-index:222" class="mp-adz">
            <div style="margin:0 auto;text-align: center;overflow: visible;" id="container-ads">
                <div id="hide_catfish"><a
                        style="font-size:12px; font-weight:bold;background: #ff8a00; padding: 2px; color: #000;display: inline-block;padding: 3px 6px;color: #FFF;background-color: rgba(0,0,0,0.7);border: .1px solid #FFF;"
                        onclick="jQuery('#catfish').fadeOut();">Đóng quảng cáo</a></div>
                <div id="catfish_content" style="z-index:999999;">
                    {!! get_theme_option('ads_catfish') !!}
                </div>
            </div>
        </div>
    @endif
    </script>

    {!! get_theme_option('footer') !!}
    <script src='/themes/iq/js/jquery.js?ver=3.0.0'></script>
    <script src='/themes/iq/js/splide.min.js?ver=1.0.1'></script>
    <script src='/themes/iq/plugins/bootstrap/js/bootstrap.bundle.min.js?ver=1.0.1'></script>
    <script src='/themes/iq/js/functions.js?ver=1.0.1'></script>
    <script src='/themes/iq/js/main.js?ver=1.0.1'></script>
    {{-- <script type="text/javascript" id='funciones_public_sol-js-extra'>
        var toroflixPublic = {
            "url": "/",
            "nonce": "7a0fde296e",
            "trailer": "",
            "noItemsAvailable": "No entries found",
            "selectAll": "Select all",
            "selectNone": "Select none",
            "searchplaceholder": "Click here to search",
            "loadingData": "Still loading data...",
            "viewmore": "View more",
            "id": "",
            "type": "",
            "report_text_reportForm": "Report Form",
            "report_text_message": "Message",
            "report_text_send": "SEND",
            "report_text_has_send": "the report has been sent",
            "playerAutomaticSlider": "1"
        };
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- Page script -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="/themes/iq/js/config-splide.js?ver=1.0.1"></script>

    <div id="fb-root"></div>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '{{ setting('social_facebook_app_id') }}',
                xfbml: true,
                version: 'v5.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/vi_VN/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    {!! setting('site_scripts_google_analytics') !!}
    <script>
        jQuery(document).ready(function() {
            let timeoutID = null;
            $("input[name=search]").keyup(function(e) {
                clearTimeout(timeoutID);
                var search = e.target.value;
                if (search.length <= 2) {
                    $(".search-suggest").hide();
                    return false;
                }
                timeoutID = setTimeout(() => searching(search), 0)
            });

            function searching(search) {
                $.ajax({
                    type: "get",
                    url: "/search/" + search,
                    dataType: "json",
                    success: function(response) {
                        let results = "";
                        $(".search-suggest").show();

                        results += '<div class="hotSearch-title">Kết quả tìm kiếm</div>';
                        for (let i = 0; i < response.data.length; i++) {
                            const element = response.data[i];
                            let img = `<img src="${element['thumb_url']}" alt="${element['name']}">`;
                            let name = `<p>${element['name']}</p>`;
                            results +=
                                '<a class="lists-item hotSearch-item" href="' +
                                element["url"] + '" title="' + element["name"] +
                                ' class="ajax-thumb""><i>' + (i + 1) + '</i><span>' + element["name"] +
                                '</span></a>';;
                        }
                        results +=
                            '<li class="ss-bottom" style="padding: 0;border-bottom: none;display: block;width: 100%;height: 40px;line-height: 40px; background: #f44336; color: #fff; font-weight: 700;text-align: center;"><a href="/?search=' +
                            search + '">Nhấn enter để tìm kiếm</a></li>';
                        $(".search-suggest").html(results);
                    }
                });
            }
        });
    </script>
@endsection
