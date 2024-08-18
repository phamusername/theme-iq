{{-- <div class="myui-top-movies {{ $loop->even ? 'even' : 'odd' }}">
    <div class="myui-block-header">
        <h2 class="myui-block-title">{{ $item['label'] }}</h2>
        <a class="more text-muted icon-btn" href="{{ $item['link'] }}">
            Xem thêm
            <svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z" fill="#fff" />
            </svg>
        </a>
    </div>
    <ul class="myui-vodlist clearfix">
        @foreach ($item['data'] as $key => $movie)
            @php
                $xClass = 'item';
                if ($key === 0 || $key % 4 === 0) {
                    $xClass .= ' no-margin-left';
                }
            @endphp
            @include('themes::themeiq.inc.sections_movies_item')
        @endforeach
    </ul>
</div> --}}

<div class="Main Container">
    <div class="container">
        <section class="firm-by-category">
            <div class="myui-block-header">
                <h2 class="title-category">{{ $item['label'] }}</h2>
                <a class="more text-muted icon-btn" href="{{ $item['link'] }}">
                    Xem thêm
                    <svg width="20" height="20" viewBox="0 0 1792 1792">
                        <path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z" fill="#fff"></path>
                    </svg>
                </a>
            </div>
            <div class="slider__column splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($item['data'] as $key => $movie)
                            {{-- @php
                                $xClass = 'item';
                                if ($key === 0 || $key % 4 === 0) {
                                    $xClass .= ' no-margin-left';
                                }
                            @endphp --}}
                            @include('themes::themeiq.inc.sections_movies_item')
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <div class="detail-pop-modal"></div>
    </div>
</div>
<style>
    .more.icon-btn {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    color: #6c757d;
    transition: color 0.3s ease;
    text-decoration: none;
}

.myui-block-header {
    display: flex;
    justify-content: space-between;
}

.more.icon-btn:hover {
    color: rgb(28, 199, 73) !important;
}
</style>
