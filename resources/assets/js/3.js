$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('header').addClass("sticky");
        $('.logo').addClass("sticky");
        $('#menu').addClass("stickyMenu");
    }
    else{
        $('header').removeClass("sticky");
        $('.logo').removeClass("sticky");
        $('#menu').removeClass("stickyMenu");
    }
});