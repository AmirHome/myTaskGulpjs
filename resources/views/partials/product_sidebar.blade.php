<!-- partials product_sidebar.blade.php -->       
        @foreach($pro_parents as $pro_parent)
	        <!-- <div class="categories-page-arrow"><img src="{{ asset('resources/assets/images')}}/graybg-arrow.png" alt="" /></div> -->
	        <div class="categories-title">{{ $pro_parent->title }}</div>
	        @if ( isset($gets['parent_id'] ))
	        <ul {{ ( $pro_parent->id == $gets['parent_id'] ) ? 'class=active' : ''}}>
	        @else
	        <ul {{ ( $pro_parent->id == $product->cat_parent_id ) ? 'class=active' : ''}}>
	        @endif
	        @foreach($pro_childs as $key => $pro_child)
	        @if ($pro_child->parent_id === $pro_parent->id)
				<a href="{{ URL::to('products/' .$pro_child->parent_id.'/'.$pro_child->id )}}"><h3><span class="icon-dashboard"></span>{{ $pro_child->title }}</h3></a>
                @if (isset($gets['id']))
                <ul {{ ( $gets['id'] == $pro_child->id ) ? 'class=active' : ''}}>
                @elseif (isset($product->cat_id))
                <ul {{ ( $product->cat_id == $pro_child->id ) ? 'class=active' : ''}}>
                @else  
                <ul {{ ( $key == 0 ) ? 'class=active' : ''}}>
                @endif
				@foreach($products as $key => $sidebar_product_list)
				@if ($sidebar_product_list->cat_id === $pro_child->id)
					<li {{ ( isset($product->id) && ($product->id == $sidebar_product_list->id) ) ? 'class=active-select' : ''}} ><a href="{{ URL::to('product/' .$sidebar_product_list->page_title)}}">{{$sidebar_product_list->title}}</a></li>
				@endif
				@endforeach
                </ul>
            @endif
	        @endforeach
	        </ul>

        @endforeach