<li class="splide__slide">
    <a href="{{$movie->getUrl()}}">
        <div class="splide__item"
            data-wrap_data='{"rate": "8.0", "type" : "Phim bộ", "year" : "2024", "desc":"Trong bộ phim &#039;Ôm Nhau Trong Đêm Tối - Embrace in the Dark Night (2024)&#039;, câu chuyện xoay quanh cuộc phiêu lưu đầy kịch tính của Ôn Hề và Từ Triết Thanh trong thế giới ngầm đen tối của võ đài. Hai nhân vật chính với hai nhiệm vụ khác nhau đã phải đối mặt với sự nguy hiểm và âm mưu từ ông trùm bí ẩn. Sự gặp lại sau nhiều năm không chỉ là cơ hội để họ tìm ra sự thật, mà còn là dịp để họ cùng nhau chiến đấu và xóa tan bóng tối, để cuối cùng, có thể ôm nhau trong ánh sáng của hạnh phúc.", "img_url" : "https://gophim.co/storage/hinh-anh/om-nhau-trong-dem-toi-poster.jpg", "title": "Ôm Nhau Trong Đêm Tối" , "linkF" : "https://dongphim.ink/phim/om-nhau-trong-dem-toi", "firm_cate" : "Chính Kịch"}'>
            <div class="splide__img-wrap">
                <img src="{{$movie->getThumbUrl()}}" alt="Slider"
                    class="splide__img">
                <div class="episodes">{{$movie->episode_current}}</div>
            </div>
            <div class="splide__item-title">
               {{$movie->name}}
            </div>
        </div>
    </a>
</li>
