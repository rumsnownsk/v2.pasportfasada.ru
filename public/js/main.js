$(function () {
    $('.popup-with-move-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 500,
        mainClass: 'my-mfp-slide-bottom'
    });

    $(".callback").submit(function() {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/mail",
            dаta: th.serialize()
        }).done(function() {
            $(".success").addClass("visible");
            setTimeout(function() {
                th.trigger("reset");
                $(".success").removeClass("visible");
                $.magnificPopup.close();
            }, 10000);
        });
        return false;
    });

    $("#phone").mask("+7 (999) 999-99-99");

});