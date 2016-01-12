<div class="slider">
    <div class="container-mobil">
        <div class="bx-slider-cont">
            <ul class="bxslider">
        	@foreach ($sliders as $key => $value)
                <li style="overflow:hidden;"><img src="{{ asset("uploads") }}/{{$value->image}}" /></li>
            @endforeach
            </ul>
        </div>
    </div>
</div>