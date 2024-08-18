$(function () {
    function showBgHeader() {
        const headerHeight = $(".header").height();
        $(".header").toggleClass("active", $(window).scrollTop() >= headerHeight);
    }

    // Initial call and scroll event
    showBgHeader();
    $(window).on('scroll', showBgHeader);

    // Toggle menu on button click
    $(document).on('click', '.header-respon-sidebar', function() {
        $('.menu-box').addClass('show-menu');
    });

    // Close menu on background click
    $(document).on('click', '.menu-background', function() {
        $('.menu-box').removeClass('show-menu');
    });

    // Show pop-up on mouse enter
    $(document).on('mouseenter', '.firm-by-category .splide__slide.is-visible .splide__item', function() {
        if ($(window).width() <= 800) return;

        const data = $(this).data('wrap_data') || {};
        const html = generatePopUpHtml(data);
        const $detailPopModal = $('.detail-pop-modal');

        $detailPopModal.html(html).css({
            display: 'block',
            position: 'absolute',
            top: $(this).offset().top - 18,
            left: $(this).offset().left - 28,
            width: $(this).closest('.splide__slide').width() + 56,
        });
    });

    // Clear pop-up on mouse leave
    $(document).on('mouseleave', '.detail-pop-modal', function() {
        $('.detail-pop-modal').html('');
    });

    // Handle dropdown toggle
    document.querySelectorAll('.acd-drop').forEach(button => {
        button.addEventListener('click', function() {
            button.classList.toggle('active');
            const ul = button.closest('.channel-item').querySelector('ul');
            ul.style.display = (ul.style.display === 'block') ? 'none' : 'block';
        });
    });

    // Close menu on close button click
    const closeButton = document.querySelector('.m-nav-close');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            $('.menu-box').removeClass('show-menu');
        });
    }

    // Function to generate pop-up HTML
    function generatePopUpHtml(data) {
        const img = data.img_url || '';
        const title = data.title || '';
        const rate = data.rate || '';
        const type = data.type || '';
        const year = data.year || '';
        const desc = data.desc || '';
        const linkF = data.linkF || '#';
        const categories = (data.firm_cate || '').split(', ').map(cat => `<span>${cat}</span>`).join('');

        return `
            <div class="pop-wrapper">
                <a href="${linkF}" class="href-outer">
                    <div class="modal-img-wrap">
                        <div style="background-image: url(${img})" class="pop-modal-img"></div>
                    </div>
                    <div class="content-modal-wrap">
                        <div class="title-firm line-clamp-1">${title}</div>
                        <div class="content-pop-modal__infor">
                            <div class="rate"><i class="fas fa-star"></i> ${rate}</div>
                            <div class="week after-item">${type}</div>
                            <div class="year after-item">${year}</div>
                        </div>
                        <div class="content-pop-modal__category">${categories}</div>
                        <div class="desc line-clamp-5">${desc}</div>
                        <div class="episode-more-info">
                            <a class="word" href="${linkF}">Xem thêm <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        `;
    }
});
