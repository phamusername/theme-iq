<li class="splide__slide">
    <a href="{{ $movie->getUrl() }}">
        <div class="splide__item" data-wrap_data='{
            "rate": "{{ $movie->getRatingStar() }}",
            "type": "@if ($movie->type == 'single') Phim lẻ @else Phim Bộ @endif",
            "year": "{{ $movie->publish_year }}",
            "desc": "{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})",
            "img_url": "{{ $movie->getPosterUrl() }}",
            "title": "{{ $movie->name }}",
            "linkF": "{{ $movie->getUrl() }}",
            "firm_cate": "{!! count($movie->categories) ? $movie->categories->first()['name'] : 'Đang cập nhật' !!}"
        }'>
            <div class="splide__img-wrap">
                <img style="display: block; width: 100%" src="{{ $movie->getThumbUrl() }}" alt="Slider" class="splide__img">
                <div class="episodes">{{ $movie->episode_current }}</div>
            </div>
            <div class="splide__item-title">{{ $movie->name }}</div>
        </div>
    </a>
</li>
