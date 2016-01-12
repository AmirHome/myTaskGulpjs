<!-- partials index head -->
{!! HTML::style('resources/assets/css/jquery.bxslider.css') !!}
{!! HTML::style('resources/assets/css/owl/owl.carousel.css') !!}
{!! HTML::style('resources/assets/css/owl/owl.theme.css') !!}
{!! HTML::script('resources/assets/js/jquery.bxslider.js'); !!}
<script type="text/javascript">
    $(document).ready(function() {
        $('.bxslider').bxSlider({
            auto: true,
            //autoControls: false {{ asset("../resources/assets/css/") }}
        });
    });
</script>