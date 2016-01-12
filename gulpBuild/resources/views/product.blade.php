@extends('layouts.master')
@section('page_title', $product->title)

@section('parials_head')
    @include('partials.products_head')
    @include('partials.product_head')
@endsection

@section('sidebars')
<div class="banner1">
    <div class="container">
        <div class="orangebg">
            <div class="orangebg-arrow"><img src="{{ asset('resources/assets/images')}}/orangebg-arrow.png" alt="" /></div>
            <div class="bannerBaslik">{{$product->sub_title}}</div>
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
        <div class="categories-page-right">
            <div class="products-detail-title">{{$product->title}}</div>
            <div class="product-detail-img"><a href="#ccc"><img src="{{ asset("uploads") }}/{{$product->image}}" alt="{{$product->image_alt}}"></a></div>
            <div class="clear"></div>
            <div class="product-detail">
                <!-- <div class="products-detail-title2"></div> -->
                <!--             <div class="products-detail-quality"><span>Client</span>Lorem ipsum</div>
            <div class="products-detail-quality"><span>Date</span>24/10/2015</div>
            <div class="products-detail-quality"><span>Info</span>Phasellus ultrices tellus</div> -->
                <div class="products-detail-desc">{!! $product->content !!}</div>
            </div>
            <div id="tabs">
                <ul>
                    @if ( ! (empty($product->heading_tab1)  || empty($product->description_tab1)) )
                    <li><a href="#tabs-1">{{$product->heading_tab1}}</a></li>
                    @endif
                    @if ( ! (empty($product->heading_tab2)  || empty($product->description_tab2)) )
                    <li><a href="#tabs-2">{{$product->heading_tab2}}</a></li>
                    @endif
                    @if ( ! (empty($product->heading_tab3)  || empty($product->description_tab3)) )
                        <li><a href="#tabs-3">{{$product->heading_tab3}}</a></li>
                    @endif
                </ul>
                @if ( ! (empty($product->heading_tab1)  || empty($product->description_tab1)) )
                <div  class="products-detail-desc" id="tabs-1">
                    <p>{!! $product->description_tab1 !!}</p>
                </div>
                @endif
                @if ( ! (empty($product->heading_tab2)  || empty($product->description_tab2)) )
                <div  class="products-detail-desc" id="tabs-2">
                    <p>{!! $product->description_tab2 !!}</p>
                </div>
                @endif
                @if ( ! (empty($product->heading_tab3)  || empty($product->description_tab3)) )
                <div  class="products-detail-desc" id="tabs-3">
                    <p>{!! $product->description_tab3 !!}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
@endsection