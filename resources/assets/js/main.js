$(function () {
    function showBgHeader(){
        var headerHeight = $(".header").height();
        if ($(window).scrollTop() >= headerHeight) {
            $(".header").addClass("active");
        } else {
            $(".header").removeClass("active");
        }
    }
    showBgHeader();

    $(window).scroll(function () {
        showBgHeader()
    });

    $(document).on('click', '.header-respon-sidebar', function(){
        $('.menu-box').addClass('show-menu')
    });

    $(document).on('click', '.menu-background', function(){
        $('.menu-box').removeClass('show-menu')
    })

    $(document).on('mouseenter', '.firm-by-category .splide__slide.is-visible .splide__item', function(){

        if($(window).width() <=800){
            return;
        }

        const data = $(this).data('wrap_data') ?? {};
        const img = data.img_url ?? '';
        const title = data.title ?? '';
        const rate = data.rate ?? '';
        const type = data.type ?? '';
        const year = data.year ?? '';
        const desc = data.desc ?? '';
        const linkF = data.linkF ?? '#';
        const firmCategories = data.firm_cate.split(', ');
        const cateF = Array.isArray(firmCategories) ? firmCategories : [];
        let cateHtml = ''
        $.each(cateF, function(idx, value){
            cateHtml += `<span>${value}</span>`
        });
        let html = `
                <div class="pop-wrapper">
                    <a href="${linkF}" class="href-outer">
                        <div class="modal-img-wrap">
                            <div style="background-image: url(${img})" class="pop-modal-img"></div>
                        </div>
                        <div class="content-modal-wrap">
                            <div class="title-firm line-clamp-1">
                                ${title}
                            </div>
                            <div class="content-pop-modal__infor">
                                <div class="rate">
                                    <i class="fas fa-star"></i> ${rate}
                                </div>
                                <div class="week after-item">
                                    ${type}
                                </div>
                                <div class="year after-item">
                                    ${year}
                                </div>
                            </div>
                            <div class="content-pop-modal__category">
                                ${cateHtml}
                            </div>
                            <div class="desc line-clamp-5">
                                ${desc}
                            </div>
                            <div class="episode-more-info">
                                <a class="word" href="${linkF}">Xem thêm <i class="fa-solid fa-angle-right"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
            `;

        $('.detail-pop-modal').html(html);

        $('.detail-pop-modal').css({
            'display' : 'block',
            'position': 'absolute',
            'top': $(this).offset().top - 18,
            'left': $(this).offset().left - 28,
            'width': $(this).closest('.splide__slide').width() + 56,

        })
    });
    $(document).on('mouseleave', '.detail-pop-modal', function(){
        $('.detail-pop-modal').html('')
    })
});
