!function (t) {
    t.fn.recliner = function (n) {
        var i, a, o = t(window), e = this, r = this.selector;
        n = t.extend({attrib: "data-src", throttle: 300, threshold: 100, printable: !0, live: !0, getScript: !1}, n);

        function l(t) {
            t.removeClass("lazy-loading"), t.addClass("lazy-loaded"), t.trigger("lazyshow")
        }

        function d() {
            var a = e.filter(function () {
                var i = t(this);
                if ("none" != i.css("display")) {
                    var a = void 0 !== window.innerHeight ? window.innerHeight : o.height(), e = o.scrollTop(),
                        r = e + a, l = i.offset().top;
                    return l + i.height() >= e - n.threshold && l <= r + n.threshold
                }
            });
            i = a.trigger("lazyload"), e = e.not(i)
        }

        function c(i) {
            i.one("lazyload", function () {
                var i, a, o;
                i = t(this), a = i.attr(n.attrib), o = i.prop("tagName"), a ? (i.addClass("lazy-loading"), /^(IMG|IFRAME|AUDIO|EMBED|SOURCE|TRACK|VIDEO)$/.test(o) ? (i.attr("src", a), i[0].onload = function (t) {
                    l(i)
                }) : !0 === n.getScript ? t.getScript(a, function (t) {
                    l(i)
                }) : i.load(a, function (t) {
                    l(i)
                })) : l(i)
            }), d()
        }

        return o.on("scroll.lazy resize.lazy lookup.lazy", function (t) {
            a && clearTimeout(a), a = setTimeout(function () {
                o.trigger("lazyupdate")
            }, n.throttle)
        }), o.on("lazyupdate", function (t) {
            d()
        }), n.live && t(document).ajaxSuccess(function (n, i, a) {
            var o = t(r).not(".lazy-loaded").not(".lazy-loading");
            e = e.add(o), c(o)
        }), n.printable && window.matchMedia && window.matchMedia("print").addListener(function (n) {
            n.matches && t(r).trigger("lazyload")
        }), c(this), this
    }
}(jQuery);
var createCookie = function (name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

if (typeof jQuery === 'undefined') {
    throw new Error('jquery-rate-picker requires jQuery');
}
(function ($) {
    "use strict";
    $.ratePicker = function (target, options) {
        if (typeof options === 'undefined') options = {};
        options.max = typeof options.max === 'undefined' ? 5 : options.max;
        options.rgbOn = typeof options.rgbOn === 'undefined' ? "#f1c40f" : options.rgbOn;
        options.rgbOff = typeof options.rgbOff === 'undefined' ? "#ecf0f1" : options.rgbOff;
        options.rgbSelection = typeof options.rgbSelection === 'undefined' ? "#ffcf10" : options.rgbSelection;
        options.cursor = typeof options.cursor === 'undefined' ? "pointer" : options.cursor;
        options.indicator = typeof options.indicator === 'undefined' ? "fa fa-star" : "fa " + options.indicator;
        var stars = typeof $(target).data('stars') == 'undefined' ? 0 : $(target).data('stars');
        $(target).css('cursor', options.cursor);
        $(target).append($("<input>", {type: "hidden", name: target.replace("#", ""), value: stars}));
        $(target).append($("<i>", {class: options.indicator, style: "color: transparent; font-size: 0;"}));
        for (var i = 1; i <= options.max; i++) {
            $(target).append($("<i>", {
                class: options.indicator,
                style: "color:" + (i <= stars ? options.rgbOn : options.rgbOff)
            }));
        }
        $(target).append($("<i>", {class: options.indicator, style: "color: transparent; font-size: 0;"}));
        $.each($(target + " > i"), function (index, item) {
            $(item).click(function () {
                $("[name=" + target.replace("#", "") + "]").val(index);
                for (var i = 1; i <= options.max; i++) {
                    $($(target + "> i")[i]).css("color", i <= index ? options.rgbOn : options.rgbOff);
                }
                if (!(options.rate === 'undefined')) {
                    options.rate(index > options.max ? options.max : index);
                    stars = index;
                }
            });
            $(item).mouseover(function () {
                for (var i = 1; i <= options.max; i++) {
                    $($(target + " > i")[i]).css("color", i <= index ? options.rgbSelection : options.rgbOff);
                }
            });
            $(item).mouseleave(function () {
                $("[name=" + target.replace("#", "") + "]").val(index);
                for (var i = 1; i <= options.max; i++) {
                    $($(target + "> i")[i]).css("color", i <= stars ? options.rgbOn : options.rgbOff);
                }
            });
        });
    };
})(jQuery);
jQuery(document).ready(function ($) {
    $(document).on('click', '.rtg', function (event) {
        event.preventDefault();
        var ide = $(this).attr('tab');
        $('.rtg').addClass('inactive').removeClass('active');
        $(this).addClass('active').removeClass('inactive');
        $('.lrt').removeClass('active');
        $('#' + ide).addClass('active');
    });

    function modalReport() {
        var html = '';
        html += '<div class="Modal-Box Treport on">';
        html += '<div class="Modal-Content">';
        html += '<span class="Modal-Close Button AAIco-clear"></span>';
        html += '<div class="report-form">';
        html += '<form id="form-report">';
        html += '<h3>' + toroflixPublic.report_text_reportForm + '</h3>';
        html += '<label for="desc-report">' + toroflixPublic.report_text_message + '</label>';
        html += '<textarea required id="desc-report"></textarea>';
        html += '<button type="submit">' + toroflixPublic.report_text_send + '</button>';
        html += '</form>';
        html += '</div>';
        html += '</div>';
        html += '<i class="AAOverlay"></i>';
        html += '</div>';
        return html;
    }

    $(document).on('click', '#tr-report', function (event) {
        event.preventDefault();
        $('body').append(modalReport());
    });
    $(document).on('submit', '#form-report', function (event) {
        event.preventDefault();
        var message = $('#desc-report').val(), postType = toroflixPublic.type, postID = toroflixPublic.id;
        $.ajax({
            url: toroflixPublic.url,
            dataType: 'json',
            method: 'POST',
            data: {action: 'action_send_report', message: message, postType: postType, postID: postID},
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data);
                $('.TPMvCn').append('<p class="report-succ">' + toroflixPublic.report_text_has_send + '</p>');
                setTimeout(() => {
                    $('.report-succ').fadeOut('400', function () {
                        $('.report-succ').remove();
                    });
                }, 3000);
                $('.Treport').remove();
            },
            error: function () {
            }
        });
    });
    $(document).on('click', '.drpdn', function () {
        var $this = $(this);
        if ($this.find('.bstd').hasClass('on')) {
            $('.bstd').removeClass('on');
        } else {
            $('.bstd').removeClass('on');
            $this.find('.bstd').addClass('on');
        }
    });
    $(document).click(function (event) {
        if (!($(event.target).closest("#HdTop").length)) {
            $('#HdTop').removeClass('open');
            $('#tr_live_search_content').empty().removeClass('on');
            $('#Tf-Search').val('');
        }
    });
    $('.like-mov').on('click', function (event) {
        event.preventDefault();
        var id = $(this).data('id'), like = $(this).data('like');
        if (getCookie('like_flix_' + id) == 1) {
            return;
        }
        $.ajax({
            url: toroflixPublic.url,
            dataType: 'json',
            method: 'POST',
            data: {action: 'action_like_mov', like: like, id: id},
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data);
                $('.vot_cl').text(data.like);
                $('.vot_cu').text(data.unlike);
                createCookie('like_flix_' + id, 1, 365);
            },
            error: function () {
                console.warn('error');
            }
        });
    });
    $('.Cast-sh a').hide();
    $('.Cast-sh .dot-sh').hide();
    $('.Cast-sh a').eq(0).show();
    $('.Cast-sh a').eq(1).show();
    $('.Cast-sh a').eq(2).show();
    $('.Cast-sh .dot-sh').eq(0).show();
    $('.Cast-sh .dot-sh').eq(1).show();
    $('.Cast-sh').append('<a class="view-sh Button">' + toroflixPublic.viewmore + '</a>');
    $('body').on('click', '.view-sh', function (event) {
        event.preventDefault();
        $('.Cast-sh a').show();
        $('.Cast-sh a').show();
        $('.view-sh').remove();
        $('.Cast-sh .dot-sh').show();
        $('.Cast.Cast-sh').removeClass('oh');
    });
    $('#watch-trailer').on('click', function (event) {
        event.preventDefault();
        var trailer = $(this).data('trailer');
        $('.Ttrailer').addClass('on');
        $('.Ttrailer .Modal-Content').prepend(toroflixPublic.trailer);
    });
    $(document).on('click', '.Modal-Close', function (event) {
        event.preventDefault();
        $(this).parent().parent().removeClass('on');
        $('.Treport').remove();
        $('.Ttrailer iframe').remove();
    });
    $('body').on('click', '.sorted-list a', function (event) {
        event.preventDefault();
        var $this = $(this), type_list = $this.attr('href'),
            type_post = $this.parent().parent().parent().parent().parent().data('id');
        if ($this.parent().hasClass('on')) {
            $this.parent().parent().parent().removeClass('open');
            return;
        }
        $this.parent().parent().find('li').removeClass('on');
        $this.parent().addClass('on');
        $this.parent().parent().parent().removeClass('open');
        $.ajax({
            url: toroflixPublic.url,
            method: 'POST',
            data: {action: 'action_changue_post_by', type: type_list, posttype: type_post},
            beforeSend: function () {
                $this.parent().parent().parent().parent().next().fadeOut(400);
            },
            success: function (data) {
                $this.parent().parent().parent().parent().next().empty().fadeIn(300).html(data);
                $('.imglazy').recliner({attrib: "data-src", throttle: 300, threshold: 300, live: true});
            },
            error: function () {
            }
        });
    });
    $('.AADrpd').each(function () {
        var $AADrpdwn = $(this);
        $('.AALink', $AADrpdwn).click(function (e) {
            e.preventDefault();
            $AADrpdDv = $('.AACont', $AADrpdwn);
            $AADrpdDv.parent('.AADrpd').toggleClass('open');
            $('.AACont').not($AADrpdDv).parent('.AADrpd').removeClass('open');
            return false;
        });
    });
    $(document).on('click', function (e) {
        if ($(e.target).closest('.AACont').length === 0) {
            $('.AACont').parent('.AADrpd').removeClass('open');
        }
    });
    $('.AATggl').on('click', function () {
        var shwhdd = $(this).attr('data-tggl');
        $('#' + shwhdd).toggleClass('open');
        $('#tr_live_search_content').empty().removeClass('on');
        $('#Tf-Search').val('');
    });

    $(document).keyup(function (a) {
        if (a.keyCode == 27) $('.lgtbx-on').toggleClass('lgtbx-on');
    });
    $('.lgtbx').click(function (event) {
        event.preventDefault();
        $('body').toggleClass('lgtbx-on');
    });
    $('.lgtbx-lnk').click(function (event) {
        event.preventDefault();
        $('body').toggleClass('lgtbx-on');
    });
    $('.ListOptions>li').click(function () {
        var tab_id = $(this).attr('data-VidOpt'), id = $(this).data('id'), typ = $(this).data('typ'),
            key = $(this).data('key');
        $('.ListOptions>li').removeClass('on');
        $(this).addClass('on');
        $("#" + tab_id).addClass('on');
        $.ajax({
            url: toroflixPublic.url,
            method: 'POST',
            data: {action: 'action_player_change', id: id, key: key, typ: typ},
            beforeSend: function () {
            },
            success: function (data) {
                $('#VideoOption01').fadeOut('200');
                setTimeout(() => {
                    $('#VideoOption01').empty().fadeIn('0').html(data);
                }, 100);
                setTimeout(() => {
                    $('#VidOpt').removeClass('open');
                }, 500);
            },
            error: function () {
            }
        });
    });
    (function (a) {
        var b = ["DOMMouseScroll", "mousewheel"];
        if (a.event.fixHooks) for (var c = b.length; c;) a.event.fixHooks[b[--c]] = a.event.mouseHooks;
        a.event.special.mousewheel = {
            setup: function () {
                if (this.addEventListener) for (var a = b.length; a;) this.addEventListener(b[--a], d, false); else this.onmousewheel = d
            }, teardown: function () {
                if (this.removeEventListener) for (var a = b.length; a;) this.removeEventListener(b[--a], d, false); else this.onmousewheel = null
            }
        };
        a.fn.extend({
            mousewheel: function (a) {
                return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
            }, unmousewheel: function (a) {
                return this.unbind("mousewheel", a)
            }
        });

        function d(b) {
            var c = b || window.event, d = [].slice.call(arguments, 1), e = 0, f = true, g = 0, h = 0;
            b = a.event.fix(c);
            b.type = "mousewheel";
            if (c.wheelDelta) e = c.wheelDelta / 120;
            if (c.detail) e = -c.detail / 3;
            h = e;
            if (c.axis !== undefined && c.axis === c.HORIZONTAL_AXIS) {
                h = 0;
                g = -1 * e
            }
            if (c.wheelDeltaY !== undefined) h = c.wheelDeltaY / 120;
            if (c.wheelDeltaX !== undefined) g = -1 * c.wheelDeltaX / 120;
            d.unshift(b, e, g, h);
            return (a.event.dispatch || a.event.handle).apply(this, d)
        }
    })(jQuery);
    $(function () {
        $(".ListOptions").mousewheel(function (a, b) {
            this.scrollLeft -= b * 30;
            a.preventDefault()
        })
    })
    $('#Tf-Search').on('keyup', function (event) {
        $(this).attr('autocomplete', 'off');
        var searchTerm = $(this).val();
        if (searchTerm.length > 2) {
            $.ajax({
                url: toroflixPublic.url,
                type: 'POST',
                data: {action: 'action_search_suggest', term: searchTerm},
                beforeSend: function () {
                    $('form .Result').addClass('On');
                    var html = '<p class="trloading"><i class="fa-spinner fa-spin"></i> Loading</p>';
                    $('form .Result').append(html);
                },
                success: function (data) {
                    $('form .Result').addClass('On').html(data);
                },
                error: function () {
                }
            });
        } else {
            $('form .Result').empty().removeClass('On');
        }
    }).keyup();
    $('.imglazy').recliner({attrib: "data-src", throttle: 100, threshold: 100, live: true});
    $.ratePicker("#star", {
        rate: function (stars) {
            var id = $('#star').data('id');
            if (getCookie('vote_ep' + id) == id) {
                return;
            }
            $.ajax({
                url: toroflixPublic.url,
                method: 'POST',
                dataType: 'json',
                data: {action: 'action_vote_serie', id: id, stars: stars},
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                    createCookie('vote_ep' + id, id);
                    $('#star').attr('data-stars', data.prom);
                },
                error: function () {
                }
            });
            console.log(stars);
        }
    });
    $.ratePicker("#stars", {
        rate: function (stars) {
            var id = $('#stars').data('id');
            console.log('prev12');
            if (getCookie('vote_tx' + id) == id) {
                return;
            }
            console.log('prev');
            $.ajax({
                url: toroflixPublic.url,
                method: 'POST',
                dataType: 'json',
                data: {action: 'action_vote_tax', id: id, stars: stars},
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                    createCookie('vote_tx' + id, id);
                    $('#stars').attr('data-stars', data.prom);
                },
                error: function () {
                }
            });
            console.log(stars);
        }
    });
});
$(document).on('click', '#scrapper', function (event) {
    event.preventDefault();
    console.log(toroflixPublic.url);
    $.ajax({
        url: 'https://torothemes.com/demo/toroflix/wp-admin/admin-ajax.php',
        method: 'POST',
        data: {action: 'action_player_change', id: 156, key: 0, typ: 'movie'},
        beforeSend: function () {
            console.log('cargando');
        },
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log('error');
        }
    });
});
