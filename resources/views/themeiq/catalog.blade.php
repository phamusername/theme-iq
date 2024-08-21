@extends('themes::themeiq.layout')

@php
    $years = Cache::remember(
        'all_years',
        \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60),
        function () {
            return \Ophim\Core\Models\Movie::select('publish_year')->distinct()->pluck('publish_year')->sortDesc();
        },
    );
@endphp



@section('content')
    <div class="sc-e2b0905f-0 csCKYT">

        <main class="types.movies.index">
            <section class="breadcrumb">
                <div class="wrap-breadcrumb"
                    style="background: url(/themes/iq/collection-bg-nomal.png) left center / cover no-repeat;">
                    <h2 class="title-category">{{ $section_name }}</h2>
                </div>

            </section>
            
            <section class="list-item">
                <div class="myui-panel myui-panel-list mt-2 clearfix" style="margin-bottom: 10px; width: 100%">
                    @include('themes::themeiq.inc.catalog_filter')
                </div>
                @foreach ($data as $key => $movie)
                    @php
                        $xClass = 'item';
                        if ($key === 0 || $key % 4 === 0) {
                            $xClass .= ' no-margin-left';
                        }
                    @endphp

                    @include('themes::themeiq.inc.catalog_sections_movies_item')
                @endforeach
            </section>
            <div class="list-item pagination">
                {{ $data->appends(request()->all())->links('themes::themeiq.inc.pagination') }}
            </div>
        </main>

    </div>
@endsection
<style>
    .myui-panel {
        /* padding-left: 60px;
        padding-right: 60px; */
        position: relative;
    }

    @media screen and (max-width: 1679px) and (min-width: 768px) {
        .csCKYT {
            padding-top: 60px;
        }
    }

    .csCKYT {
        padding-top: 70px;
        max-width: 1520px;
        margin: 0px auto;
    }

    .col-xs-6 {
        width: 16.6666667%;
    }

    @media (max-width: 767px) {
        .filter-box .col-xs-6 {
            width: 50%;
            padding: 5px
        }
    }

    .btn-submit {
        padding: 5.5px 8px;
        font-size: 12px;
        font-weight: bold;
        background: #666;
        color: #fff;
        border: none;
        outline: none;
        border-radius: 0;
    }

    .filter-box .form-control {
        padding: 0.25rem 0.75rem;
        border-radius: 0;
        -webkit-appearance: auto;
        background: #383838;
        border: 1px solid #383838;
        color: #fafafa;
        font-size: 14px;
    }

    /* .filter-box .row>div {
        margin-bottom: 10px;
        margin-right: 10px
    } */
</style>
