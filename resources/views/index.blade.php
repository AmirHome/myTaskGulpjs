@extends('layouts.master')
@section('page_title', 'Signal-International')

@section('parials_head')
    @include('partials.index_head')
@endsection

@section('content')

<!-- slider -->
@include('partials.slider')

<div class="container">
    <!-- features -->
    <div id="owl-demo" class="owl-carousel">
        @include('partials.features')        
    </div>

    <div class="clear"></div>
    <!-- important -->
    <div class="leds">

        <div class="pageTitle">{{ $importances->title }}</div>
        <div class="leds-img"><img src="{{ asset("uploads") }}/{{$importances->image}}" alt="{{ $importances->title }}" /></div>
        <div class="pageText"><span>{{ $importances->sub_title }}</span>{!! str_limit($importances->description, 350) !!}</div>
        <div class="pageLink"><a href="{{ $importances->link }}">Read More</a></div>
    </div>
    <!-- news -->
    <div class="news">
        <div class="pageTitle">NEWS</div>
        @include('partials.news')
        <div class="pageLink"><a href="{{ URL::to('news/')}}">View More</a></div>
    </div>
    
    <!-- catalogs -->
    <div class="catalogs">
        <div class="pageTitle">SIGNAL CATALOGS</div>
        @include('partials.catalogs')
        <div class="pageLink"><a href="{{ URL::to('catalogs/') }}">View More</a></div>
    </div>

    <div class="clear"></div>
</div>
<!-- advertisement -->
<div class="bg-gray container-fulid">
    @include('partials.advertisement')
</div>
@endsection