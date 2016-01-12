        @foreach ($news as $value)
        <div class="newsDate">{{ date('d', strtotime( $value->date)) }}<span>{{ date('M', strtotime( $value->date)) }}</span></div>
        <div class="newsdateText">
            <a href="{{ URL::to('news/' .$value->id)}}" /><span>{{ str_limit($value->title,27) }}</span></a>
            {{ str_limit($value->description, 110) }}
            <!-- {{ str_limit('The PHP framework for web artisans.', 7) }} -->
        </div>
        <div class="clear"></div>      	
        @endforeach
