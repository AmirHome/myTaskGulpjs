<div id="index" class="section">
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ URL::to('/') }}"><img src="{{ asset("resources/assets/images") }}/logo.png" alt="" /></a>
            </div>
            <div class="right hide">
                <ul id="menu">
                    @foreach($topmenus as $key => $topmenu)
                        @if ($topmenu->type === 'products')
                            <li>

                                <a class="drop" href="{{ URL::to($topmenu->url) }}">{{$topmenu->title}}</a>
                                <div class="dropdown_4columns">
                                    <div class="anabaslik">{{$topmenu->title}}</div>
                                    @foreach($pro_parents as $key => $pro_parent)
                                         <div class="col_1">
                                            <div class="menuPhoto"><img src="{{ asset("uploads") }}/{{ $pro_parent->image }}" /></div>
                                            <div class="alt_baslik">{{ $pro_parent->title }}</div>
                                            <ul class="alt">
                                                @foreach($pro_childs as $key => $pro_child)
                                                    @if ($pro_child->parent_id === $pro_parent->id)
                                                    <li><a href="{{ URL::to('products/' .$pro_child->parent_id.'/'.$pro_child->id)}}">{{$pro_child->title}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    <div class="clear"></div>
                                </div>
                            </li>

                        @elseif ($topmenu->type === 'abouts')
                            <li>
                                <a class="drop" href="{{ URL::to($topmenu->url) }}">{{$topmenu->title}}</a>
                                <div class="dropdown_5columns">
                                    <div class="anabaslik">{{$topmenu->title}}</div>
                                        @foreach ($cat_pages_projects as $cat)
                                            @if ( $cat['cat_title'] != 'TECHNICAL INFORMATION' )
                                                <div class="col_4">
                                                    <div class="menuPhoto"><img src="{{ asset("uploads") }}/{{ $cat['cat_image'] }}" /></div>
                                                    <div class="alt_baslik">{{ $cat['cat_title'] }}</div>
                                                    <ul class="alt2">
                                                    @foreach ($pages as $key => $page)
                                                        @if ($page->cat_title === $cat['cat_title'])
                                                                <li><a href="{{ URL::to('page/' .$page->id)}}">{{$page->title}}</a></li>
                                                        @endif
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach                                
                                    <div class="clear"></div>
                                </div>
                            </li>
                        @elseif ($topmenu->type === 'info')
                            <li><a class="drop" href="{{ URL::to($topmenu->url) }}">{{$topmenu->title}}</a>
                                <div class="dropdown_2column">
                                    <div class="col_3">
                                        <ul class="simple2">
                                            @foreach ($pages as $key => $page)
                                                @if ($page->cat_title === 'TECHNICAL INFORMATION')
                                                    <li><a href="{{ URL::to('page/' .$page->id)}}">{{ $page->title }}</a></li>                                                
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @else 
                            <li><a href="{{ URL::to($topmenu->url) }}">{{$topmenu->title}}</a></li>
                        @endif

                    @endforeach
                </ul>
            </div>

            <div id="o-wrapper" class="o-wrapper right visible">
                <main class="o-content">
                    <div class="o-container">
                        <div class="c-buttons">
                            <button id="c-button--slide-right" class="c-button"><img src="{{ asset("resources/assets/images") }}/nav-menu-gray1.png" alt="" /></button>
                        </div>
                    </div>
                </main>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    
    <!-- MENU MOBILE -->

    <nav id="c-menu--slide-right" class="c-menu c-menu--slide-right visible">
        <button class="c-menu__close">CLOSE MENU →</button>
        <ul class="c-menu__items">
                     @foreach($topmenus as $key => $topmenu)
                        @if ($topmenu->type === 'products')
                        <li class="c-menu__item"><a  href="{{ URL::to($topmenu->url) }}" class="c-menu__link">{{$topmenu->title}}</a>
                            <ul>
                                <li>
                                @foreach($pro_parents as $key => $pro_parent)
                                    <div class="m_alt_baslik">{{ $pro_parent->title }}</div>
                                    <ul class="m_alt">
                                    @foreach($pro_childs as $key => $pro_child)
                                        @if ($pro_child->parent_id === $pro_parent->id)
                                        <li><a href="{{ URL::to('products/' .$pro_child->parent_id.'/'.$pro_child->id)}}">{{$pro_child->title}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
                                @endforeach
                                </li>
                            </ul>
                        </li>
                        @elseif ($topmenu->type === 'abouts')
                        <li class="c-menu__item"><a href="#" class="c-menu__link">{{$topmenu->title}}</a>
                            <ul>
                            @foreach ($cat_pages_projects as $cat)
                                @if ( $cat['cat_title'] != 'TECHNICAL INFORMATION' )
                                <li>
                                    <div class="m_alt_baslik">{{ $cat['cat_title'] }}</div>
                                    <ul class="m_alt">
                                        @foreach ($pages as $key => $page)
                                            @if ($page->cat_title === $cat['cat_title'])
                                            <li><a href="{{ URL::to('page/' .$page->id)}}">{{$page->title}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            @endforeach 
                            </ul>
                        </li>
                        @elseif ($topmenu->type === 'info')
                            <li class="c-menu__item"><a href="{{ URL::to($topmenu->url) }}" class="c-menu__link">{{$topmenu->title}}</a>
                            
                                <ul class="m_alt">
                                    @foreach ($pages as $key => $page)
                                        @if ($page->cat_title === 'TECHNICAL INFORMATION')
                                            <li><a href="{{ URL::to('page/' .$page->id)}}">{{ $page->title }}</a></li>                                                
                                        @endif
                                    @endforeach
                                </ul>
                                    
                            </li>
                        @else 
                        <li class="c-menu__item"><a href="{{ URL::to($topmenu->url) }}" class="c-menu__link">{{$topmenu->title}}</a></li>
                        @endif

                    @endforeach
                
        </ul>
    </nav>
    <div id="c-mask" class="c-mask"></div>
    <div class="clear"></div>
</div>