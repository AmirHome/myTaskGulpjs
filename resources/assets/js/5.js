$(document).ready(function(){
  $("#accordian div").click(function(){
    //slide up all the link lists
    $("#accordian > ul").slideUp();
    //slide down the link list below the h3 clicked - only if its closed
    if(!$(this).next().is(":visible"))
    {
      $(this).next().slideDown();

       $('html, body').animate({
            scrollTop: $('div#accordian').position().top
        }, 800);
    }
  })
})  