$(function () {
    // Окошко Обратный звонок
    $('.popup-callbackme').magnificPopup({
        type: 'inline',
        preloader: false,
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        midClick: true,
        // removalDelay: 500,
        mainClass: 'my-mfp-slide-bottom'
    });

    // Открыть Постановление
    $(".popup-solution").magnificPopup({
        type:'inline',
        midClick:true,
    });

    $(".callback").submit(function() {
        var th = $(this);
        $.ajax({
                type: "post",
                url: "/mail",
                data: th.serialize()
            }).done(function () {
                $(".success").addClass("visible");
                setTimeout(function() {
                    th.trigger("reset");
                    $(".success").removeClass("visible");
                    $.magnificPopup.close();
                }, 2000);
        });
        return false;
    });

    $("#menuShow").click(function () {
        if($("#mobileMenu").is(':visible')){
            $('#mobileMenu').hide();
        } else {
            $('#mobileMenu').addClass('d-flex flex-column');
        }

        window.onresize = function (ev) {
            $('#mobileMenu').hide()
        }
    });
    $(document).scroll(function () {
        if ($(document).width() > 785) {
            if ($(document).scrollTop() > $('#header').height() + 10) {
                $('nav').addClass('fixed')
            } else {
                $('nav').removeClass('fixed')
            }
        }
    });

    $("#phone").mask("+7 (999) 999-99-99");


    // Подсветка пунктов меню
    var pathname_url = window.location.pathname;

    $("nav .menu__item").each(function () {
        var link = $(this).find("a").attr("href");
        if (pathname_url == link) {
            $(this).addClass("active")
        }
    });

    $(document).ready(function () {
        $('.gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick:false,
            mainClass:'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: false,
                cursor: 'mfp-zoom-out-cur',
                titleSrc: false
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            }
        })
    })

});