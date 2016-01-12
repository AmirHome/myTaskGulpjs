        @foreach ($catalogs as $value)
        <div class="pdf-bg">
            <img src="{{ asset("uploads") }}/{{$value->image}}" />
            <a target="_blank" href="{{ asset("uploads") }}/{{$value->file}}" />{{ $value->title }}</a>
        </div>        	
        @endforeach
