$(function () {
    // Подсветка пунктов меню АДМИНКИ
    var pathname_url = window.location.pathname;

    $("ul li").each(function () {
        var link = $(this).find("a").attr("href");
        if (pathname_url == link) {
            $(this).addClass("active")
        }
    });

    document.querySelector('#elastic').oninput = function () {
        let val = this.value.trim();
        let elasticItems = document.querySelectorAll('#workTitle');
        // console.log(elasticItems)

        if (val != '') {
            elasticItems.forEach(function (elem) {
                if (elem.innerText.search(val) == -1) {
                    // elem.addClass()
                    elem.parentElement.classList.add('hide');
                    // elem.classList.add('hide');
                } else {
                    elem.parentElement.classList.remove('hide');
                }
            })
        } else {
            elasticItems.forEach(function (elem) {
                elem.parentElement.classList.remove('hide');
            })
        }
    }
});

