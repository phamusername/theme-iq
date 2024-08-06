@extends('themes::layout')
@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, [
                    'Phim hot',
                    '',
                    'type',
                    'series',
                    'view_week',
                    'desc',
                    4,
                    'top_text',
                ]);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use (
                            $relation,
                            $field,
                            $val,
                        ) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
<link href="{{ url('/') }}" rel="alternate" hreflang="vi">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"
    integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<link href="/themes/iq/static/css/main.css?v=5" rel="stylesheet" media="all">
@endpush

@section('body')
    @include('themes::themeiq.inc.header')

    <div class="container">
        <div id="top_ads"></div>

        @if (get_theme_option('ads_header'))
            {!! get_theme_option('ads_header') !!}
        @endif

        <div class="row">
            {{-- @yield('slider_recommended')
        <div class="clear"></div> --}}

            @yield('breadcrumb')
            @yield('content')
        </div>
    </div>
@endsection

@push('scripts')
@endpush

@section('footer')
    {!! setting('site_scripts_google_analytics') !!}
@endsection
