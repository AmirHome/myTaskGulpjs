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

<div class="container">
    <div class="categories-page-left">
        <div id="accordian">
        @include('partials.product_sidebar')            
        </div>        
    </div>
</div>
@endsection

@section('content')
<div class="container">

    <div class="categories-page-right">
        <div class="container-a1">
            <ul class="caption-style-1">
                @foreach($products as $key => $p_product)
                <li>
                    <a href="{{ URL::to('product/' .$p_product->page_title)}}">
                        <div class="kat-imgS">
                            <img src="{{ asset("uploads") }}/{{$p_product->image}}" alt="{{ $p_product->title }}">
                        </div>
                        <div class="products-titleM">{{$p_product->title}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
@endsection