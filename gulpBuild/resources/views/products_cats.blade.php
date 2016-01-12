@extends('layouts.master')
@section('page_title', 'Products')

@section('parials_head')
    @include('partials.products_head')
@endsection

@section('sidebars')
<div class="banner1">
    <div class="container">
        <div class="orangebg">
            <div class="orangebg-arrow"><img src="{{ asset('resources/assets/images')}}/orangebg-arrow.png" alt="" /></div>
            <div class="bannerBaslik">Products</div>
            <!-- <div class="breadcrumbs"><a href="index.php"><i class="fa fa-home"></i> Home Page</a> <span>/</span><a href="#">Products</a>/ Cables</div> -->
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="container">
        <div class="container-a1">
        <ul class="caption-style-1">
            @foreach($products_cats as $key => $products_cat)
            <li>
                <a href="{{ URL::to('products/' .$products_cat->id)}}">
                    <div class="kat-img">
                        <img src="{{ asset("uploads") }}/{{$products_cat->image}}" alt="{{ $products_cat->title }}">
                    </div>
                    <div class="products-title">{{$products_cat->title}}</div>
                </a>
            </li>
            @endforeach           
        </ul>
    </div>
        <div class="clear"></div>
        <div class="clear"></div>
    </div>
@endsection