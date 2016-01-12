<div id="footer">
    <div class="container">
        <div class="footerLogo">
            <a href="#"><img src="{{ asset("uploads") }}/{{$settings->logo}}" /></a>
            <div class="footerLink hizala">
                <div class="social-icon">
                    <a href="{{$settings->linkedin}}"><img src="{{ asset("resources/assets/images") }}/linkedin1.png" alt="" /><span>Linkedin</span></a>
                </div>
                <div class="social-icon">
                    <a href="{{$settings->googleplus}}"><img src="{{ asset("resources/assets/images") }}/gp1.png" alt="" /><span>GooglePlus</span></a>
                </div>
                <div class="social-icon">
                    <a href="{{$settings->twitter}}"><img src="{{ asset("resources/assets/images") }}/twitter1.png" alt="" /><span>Twitter</span></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="footerLogo-text">@if($settings->show_copyright === 1) {{$settings->copyright}} @endif</div>

        </div>

        <div class="web-right">
            <div class="footerTitle3">{{$settings['contact_us_title']}}</div>
            <div class="footerText">{{$settings['contact_us_text']}}</div>
        </div>


            <div class="web-right hide">
                <div class="footerTitle">PRODUCTS</div>
                <div class="footerLink">
                    <ul>
                        @foreach($footer_menus as $key => $footer_menu)
                        @if ( $footer_menu->category == 'PRODUCTS' )
                            <li><a href="{{ URL::to($footer_menu->link) }}">{{ $footer_menu->title }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>            

            <div class="web-right hide">
                <div class="footerTitle">NAVIGATION</div>
                <div class="footerLink">
                    <ul>
                        @foreach($footer_menus as $key => $footer_menu)
                        @if ( $footer_menu->category == 'NAVIGATION' )
                            <li><a href="{{ URL::to($footer_menu->link) }}">{{ $footer_menu->title }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>



        <div class="clear"></div>
    </div>
</div>

</body>
</html>