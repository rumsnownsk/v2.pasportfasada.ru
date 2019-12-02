$(function () {
    // Подсветка пунктов меню АДМИНКИ
    var pathname_url = window.location.pathname;

    $("ul li").each(function () {
        var link = $(this).find("a").attr("href");
        if (pathname_url == link) {
            $(this).addClass("active")
        }
    });
});

