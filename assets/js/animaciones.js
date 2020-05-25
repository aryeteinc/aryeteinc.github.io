/*$(window).scroll(function () {
    var scrollPos = $(document).scrollTop();
    console.log(scrollPos);
});*/

$("#item-proyecto").on("click", function () {
    var posicion = $("#our-project").offset().top;
    $("html, body").animate({
        scrollTop: posicion
    }, 1000);
});