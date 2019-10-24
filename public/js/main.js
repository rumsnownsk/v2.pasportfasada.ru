$(function () {
    $('.popup-with-move-anim').magnificPopup({
        type: 'inline',
        preloader: false,
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        midClick: true,
        removalDelay: 500,
        mainClass: 'my-mfp-slide-bottom'
    });

    $(".callback").submit(function() {
        var th = $(this);
        $.ajax({
                type: "post",
                url: "/mail",
                data: th.serialize()
            }).done(function () {
                // console.log(th)
                $(".success").addClass("visible");
                setTimeout(function() {
                    th.trigger("reset");
                    $(".success").removeClass("visible");
                    $.magnificPopup.close();
                }, 2000);
            // dаta: {id: 2}
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

});