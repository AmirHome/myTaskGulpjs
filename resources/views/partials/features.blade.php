        @foreach ($features as $value)
        <div class="item">
            <div style="height:100px;background:#fd8204;width:360px;position:absolute;z-index:99;">
                <div class="ca-title">{{ $value->title }}</div>
                <div class="ca-desc">{{ $value->description }}</div>
            </div>
            <a href="{{ $value->link }}"><img src="{{ asset("uploads") }}/{{$value->image}}" alt="{{$value->title}}">
        </a></div>     	
        @endforeach
