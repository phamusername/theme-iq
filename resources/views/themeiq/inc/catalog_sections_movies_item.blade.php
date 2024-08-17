<div class="item-wrap">
    <a href="{{$movie->getUrl()}}" class="item-link"
        data-wrap_data="{&quot;rate&quot;: &quot;8.0&quot;, &quot;type&quot; : &quot;Phim bộ&quot;, &quot;year&quot; : &quot;2022&quot;, &quot;desc&quot;:&quot;Thần Ấn Vương Tọa - Throne Of Seal, Shen Yin Wangzuo (2022) xoay quanh cuộc chiến giữa loài người và quỷ tộc trong bối cảnh triều đại vinh quang của nhân loại bị chấm dứt. 72 quỷ thần đe dọa sự tồn vong của nhân loại, khiến Liên minh các ngôi đền phải hợp tác để ngăn chặn sự xâm lược và duy trì sự ổn định cho thế giới. Sứ mệnh bảo vệ nhân loại khó khăn nhưng không ngừng hấp dẫn khi mỗi bước tiến mới là một thách thức lớn đối diện với các anh hùng và chiến binh dũng cảm.&quot;, &quot;img_url&quot; : &quot;https://gophim.co/storage/images/than-an-vuong-toa/126735.jpg&quot;, &quot;title&quot;: &quot;Thần Ấn Vương Tọa&quot; , &quot;linkF&quot; : &quot;https://dongphim.ink/phim/than-an-vuong-toa&quot;, &quot;firm_cate&quot; : &quot;Hoạt Hình&quot;}">
        <div class="item-img">
            <img src="{{$movie->getThumbUrl()}}" alt="{{$movie->name}}"
                class="desc-img">
            <div class="item-img-layer">
                <div class="update-info-mask">{{$movie->episode_current}}</div>
            </div>
            <div class="play-button-container">
                <svg width="40px" height="40px" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="play-button">
                    <g id="Btn/Play/Normal" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <circle id="bg" fill="#1CC749" cx="30" cy="30" r="30"></circle>
                        <path d="M35.7461509,22.4942263 L45.1405996,36.5858994 C46.059657,37.9644855 45.6871354,39.8270935 44.3085493,40.7461509 C43.8157468,41.0746859 43.2367237,41.25 42.6444487,41.25 L23.8555513,41.25 C22.198697,41.25 20.8555513,39.9068542 20.8555513,38.25 C20.8555513,37.657725 21.0308654,37.078702 21.3594004,36.5858994 L30.7538491,22.4942263 C31.6729065,21.1156403 33.5355145,20.7431187 34.9141006,21.662176 C35.2436575,21.8818806 35.5264463,22.1646695 35.7461509,22.4942263 Z" id="Triangle" fill="#FFFFFF" transform="translate(33.250000, 30.000000) rotate(-270.000000) translate(-33.250000, -30.000000) "></path>
                    </g>
                </svg>
            </div>
        </div>
        <div class="text-box">
            <div class="item-title">
                {{$movie->name}}
            </div>
        </div>
    </a>
</div>
