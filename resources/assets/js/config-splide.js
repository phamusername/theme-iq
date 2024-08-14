$(document).ready(function () {
    const splideBanner = new Splide("#slider .splide", {
        type: 'carousel',
    autoplay: true,
    interval: 3000,
    }).mount();

    var splides = $(".firm-by-category .splide");
    // 1. query slider elements: are there any splide elements?
    if (splides.length) {
        // 2. process all instances
        for (var i = 0; i < splides.length; i++) {
            var splideElement = splides[i];
            //3.1 if no options are defined by 'data-splide' attribute: take these default options
            var splideDefaultOptions = {
                start: 0,
                perPage: 8,
                perMove: 1,
                gap: 14,
                type: "slide",
                drag: "free",
                snap: true,
                arrows: true,
                lazyLoad: true,
                pagination: false,
                autoplay: true,
                // Responsive breakpoint
                breakpoints: {
                    1680: {
                        perPage: 6,

                    },
                    1199: {
                        perPage: 5,
                        gap: 12,
                    },
                    991:{
                        perPage: 4,
                        gap: 10
                    },
                    800:{
                        perPage: 3,

                    },
                    767: {
                        gap: 8

                    },
                    // 640: {
                    //   perPage: 2,

                    // },
                    585:{
                        gap: 6,
                    }
                },
            };
            /**
             * 3.2 if options are defined by 'data-splide' attribute: default options will we overridden
             * see documentation: https://splidejs.com/guides/options/#by-data-attribute
             **/

            var splide = new Splide(splideElement, splideDefaultOptions);
            // 3. mount/initialize this slider
            splide.mount();
        }
    }


});
