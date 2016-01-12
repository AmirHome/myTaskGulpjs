@extends('layouts.master')
@section('page_title', $last_news->title)

@section('parials_head')

@endsection


@section('sidebars')
<div class="banner1">
    <div class="container">
        <div class="orangebg">
            <div class="orangebg-arrow"><img src="{{ asset('resources/assets/images')}}/orangebg-arrow.png" alt="" /></div>
            <div class="bannerBaslik">
            {{$last_news->title}}
            </div>
            <!-- <div class="breadcrumbs"><a href="index.php"><i class="fa fa-home"></i> Home Page</a> <span>/</span><a href="#">Products</a>/ Cables</div> -->
        </div>
    </div>
</div>

<div class="container">
    <div class="categories-page-left">
            <!-- <div class="categories-page-arrow"><img src="images/graybg-arrow.png" alt="" /></div> -->
            <div class="categories-title">News List</div>
            <ul class="categories-menu">
                <li ><!-- <a href="#">News List</a> -->
                    <ul>
                    @foreach ($news as $news_value)
                        <li {{ ( $last_news->id == $news_value->id ) ? 'class=active-select' : ''}} ><a href="{{ URL::to('news/' .$news_value->id)}}" class="anchorLink">{{ str_limit($news_value->title, 23)}}</a></li>
                    @endforeach
                    </ul>
                </li>
            </ul>
        
    </div>
</div>
@endsection

@section('content')

<div class="container">
    

        <div class="categories-page-right">
            <div class="categories-right-text">
            <span>{{$last_news->title}}</span>
            <div class="leds-img"><img src="{{ asset("uploads") }}/{{$last_news->image}}" alt="{{ $last_news->title }}" /></div>
            {!! $last_news->text !!}
            </div>
        </div>
        <div class="clear"></div>
    
</div>
@endsection