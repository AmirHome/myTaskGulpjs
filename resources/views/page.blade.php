@extends('layouts.master')
@section('page_title', $page->title )

@section('parials_head')

@endsection


@section('sidebars')
<div class="banner1">
    <div class="container">
        <div class="orangebg">
            <div class="orangebg-arrow"><img src="{{ asset('resources/assets/images')}}/orangebg-arrow.png" alt="" /></div>
            <div class="bannerBaslik">
            {{{ ($page->pagecategories->title == 'TECHNICAL INFORMATION') ? $page->pagecategories->title : 'ABOUT SIGNAL' }}}
            </div>
            <!-- <div class="breadcrumbs"><a href="index.php"><i class="fa fa-home"></i> Home Page</a> <span>/</span><a href="#">Products</a>/ Cables</div> -->
        </div>
    </div>
</div>

<div class="container">
    <div class="categories-page-left">
        @include('partials.page_sidebar')
    </div>
</div>
@endsection

@section('content')

<div class="container">
    

        <div class="categories-page-right">
            <div class="categories-right-text">
            <span>{{$page->title}}</span>
            {!! $page->text !!}
            </div>
</div>
        <div class="clear"></div>
    
</div>
@endsection