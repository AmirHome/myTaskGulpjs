<!-- partials page_sidebar.blade.php -->
            <!-- <div class="categories-page-arrow"><img src="images/graybg-arrow.png" alt="" /></div> -->
            <div class="categories-title">
            {{{ ($page->pagecategories->title == 'TECHNICAL INFORMATION') ? $page->pagecategories->title : 'ABOUT SIGNAL' }}}
            </div>
            @foreach($sid_pg_parents as $sid_pg_parent)
	            @if ($page->pagecategories->title == 'TECHNICAL INFORMATION' && $sid_pg_parent->title== $page->pagecategories->title)
	            <ul class="categories-menu">
	                <li><a href="">{{$sid_pg_parent->title}}</a>
	                    <ul>
	                    	@foreach( $sid_pages as $sid_page )
							@if( $sid_pg_parent->id === $sid_page->pagecategories_id )
	                        	<li {{ ( $page->id == $sid_page->id ) ? 'class=active-select' : ''}} ><a href="{{ URL::to('page/' .$sid_page->id)}}">{{$sid_page->title}}</a></li>
	                        @endif
	                        @endforeach
	                    </ul>
	                </li>
	            </ul>
	            @endif

	            @if ($page->pagecategories->title != 'TECHNICAL INFORMATION' && $sid_pg_parent->title != 'TECHNICAL INFORMATION')           
	            <ul class="categories-menu">
	                <li><a href="">{{$sid_pg_parent->title}}</a>
	                    <ul>
	                    	@foreach( $sid_pages as $sid_page )
							@if( $sid_pg_parent->id === $sid_page->pagecategories_id )
	                        	<li {{ ( $page->id == $sid_page->id ) ? 'class=active-select' : ''}} ><a href="{{ URL::to('page/' .$sid_page->id)}}">{{$sid_page->title}}</a></li>
	                        @endif
	                        @endforeach
	                    </ul>
	                </li>
	            </ul>
	            @endif
            @endforeach