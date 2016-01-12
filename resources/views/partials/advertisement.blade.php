<div class="container">
@foreach ($advertisements as $key => $value)
        <div class="box {{ ($key === 1) ? 'box-center' : '' }}">
            <a target="_blank" href="{{ URL::to($value->link) }}" /><img src="{{ asset("uploads") }}/{{$value->image}}" /></a>
        </div>
@endforeach
</div>