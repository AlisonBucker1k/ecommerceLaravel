$(function () {
    //Set active menu
    var current_url = window.location.href;
    var current_page = get_page(current_url);
    $("ul.nav-main li a").filter(function () {
        var url = $(this).attr("href");
        var nav_page = get_page(url);

        return (nav_page == current_page);
    }).parents("li").addClass("nav-expanded nav-active");

    function get_page(url) {
        var treat_url = url.replace("http://", "");
        treat_url = treat_url.replace("https://", "");
        var url = treat_url;
        var split = url.split("/");
        var url_return = '';
        for(var i = 1; i < split.length; i++){
            if (typeof split[i] !== "undefined" && typeof split[i] !== "number") {
                url_return = url_return + '/' + split[i];
            }
        }
        return url_return;
    }
});