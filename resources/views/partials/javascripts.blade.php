{!! HTML::script('resources/assets/js/owl/owl.carousel.js'); !!}
<style>
#owl-demo .item {margin: 3px;}
#owl-demo .item img {display: block;width: 100%;height: auto;padding: 100px 0 0;}
</style>

<script>
$(document).ready(function() {
  $("#owl-demo").owlCarousel({
  autoPlay: 3000,
  items : 3,
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [979,3]
  });
});
</script>
<script>
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
</script>
{!! HTML::script('resources/assets/js/jquery.nav.js'); !!}
<script type="text/javascript">
        $(document).ready(function() {
    $('.menu').dropit();
});
</script>
<script>
  var slideRight = new Menu({
    wrapper: '#o-wrapper',
    type: 'slide-right',
    menuOpenerClass: '.c-button',
    maskId: '#c-mask'
  });
  var slideRightBtn = document.querySelector('#c-button--slide-right');
  slideRightBtn.addEventListener('click', function(e) {
    e.preventDefault;
    slideRight.open();
  });
</script>
<script>
/*jQuery time*/
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
</script>
<script type="text/javascript">
$(document).ready(function() { 
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('#footer').position().top + footerHeight;
   
   if (footerTop < docHeight) {
    $('#footer').css('margin-top', 10 + (docHeight - footerTop) + 'px');
   }
  });
 </script>