<section id="slider">
    <div class="container">
        <div class="slider__column splide">
            <div class="splide__track">

                <ul class="splide__list">
                    @foreach ($recommendations['data'] as $movie)
                        <li class="splide__slide">
                            <a href="{{ $movie->getUrl() }}" tabindex="-1">
                                <img src="{{ $movie->getPosterUrl() }}" alt="Slider">
                            </a>
                            <div class="crs-content">
                                <a href="{{ $movie->getUrl() }}" tabindex="-1">
                                    <div class="crs-content__title">
                                        <h2>{{ $movie->name }}</h2>
                                    </div>
                                    <span class="crs-content__top">
                                        <div class="top">
                                            @if ($movie->status == 'ongoing')
                                                Đang chiếu
                                            @elseif ($movie->status == 'completed')
                                                Hoàn thành
                                            @else
                                                Trailer
                                            @endif
                                        </div>
                                        {{ $movie->origin_name }}
                                    </span>
                                    <div class="crs-content__infor">
                                        <div class="rate">
                                            <i class="fas fa-star"></i> {{ $movie->getRatingStar() }}
                                        </div>
                                        <div class="year after-item">
                                            {{ $movie->publish_year }}
                                        </div>
                                        <div class="week after-item">

                                        </div>
                                        <div class="episode_number after-item">
                                            @if ($movie->type == 'movies')
                                                Phim lẻ
                                            @else
                                               Phim bộ
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <div class="crs-content__category">
                                    <a href="{{ $movie->getUrl() }}" tabindex="-1">Đạo
                                        diễn:
                                    </a>
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
                                </div>
                                <div class="crs-content__category">Thể loại:
                                    {!! $currentMovie->categories->map(function ($category) {
                                        return '<a href="' . $category->getUrl() . '" tite="' . $category->name . '">' . $category->name . '</a>';
                                    })->implode(', ') !!}
                                </div>
                                <div class="crs-content__desc">{!! $currentMovie->content !!}
                                </div>
                                <div class="sc-a4176019-0 gHWgi option-button">
                                    <div class="sc-88e580be-0 gUElsb">
                                        <div class="wrap" href="{{ $movie->getUrl() }}">
                                            <i class="icon-play"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            {{-- <ul class="splide__pagination splide__pagination--ltr" role="tablist" aria-label="Select a slide to show"><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide01" aria-label="Go to slide 1" tabindex="-1"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide02" aria-label="Go to slide 2" tabindex="-1"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide03" aria-label="Go to slide 3" tabindex="-1"></button></li><li role="presentation"><button class="splide__pagination__page is-active" type="button" role="tab" aria-controls="splide01-slide04" aria-label="Go to slide 4" aria-selected="true"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide05" aria-label="Go to slide 5" tabindex="-1"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide06" aria-label="Go to slide 6" tabindex="-1"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide07" aria-label="Go to slide 7" tabindex="-1"></button></li></ul></div> --}}
        </div>
</section>
