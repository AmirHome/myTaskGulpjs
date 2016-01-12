@extends('layouts.master')
@section('page_title', 'Contacts')

@section('parials_head')

@endsection


@section('sidebars')
<div class="banner1">
    <div class="container">
        <div class="orangebg">
            <div class="orangebg-arrow"><img src="{{ asset('resources/assets/images')}}/orangebg-arrow.png" alt="" /></div>
            <div class="bannerBaslik">
            Contacts
            </div>
            <!-- <div class="breadcrumbs"><a href="index.php"><i class="fa fa-home"></i> Home Page</a> <span>/</span><a href="#">Products</a>/ Cables</div> -->
        </div>
    </div>
</div>

<div class="container">
    <div class="categories-page-left">
            <!-- <div class="categories-page-arrow"><img src="images/graybg-arrow.png" alt="" /></div> -->
            <div class="categories-title">Contacts</div>
            <ul class="categories-menu">
                <li><a href="#">Contact Information</a>
                    <ul>
                    @foreach ($contacts as $contact)
                        <li><a href="#contact_{{$contact->id}}" class="anchorLink">{{$contact->title}}</a></li>
                    @endforeach
                    </ul>
                </li>
                <li><a href="#">Contact Form</a>
                    <ul>
                        <li><a href="{{ URL::to('contact/')}}">Contact Form</a></li>
                    </ul>
                </li>
            </ul>
        
    </div>
</div>
@endsection

@section('content')

<div class="container">
    

        <div class="categories-page-right">
            <div class="products-detail-title">Contact Information</div>
            
            @foreach ($contacts as $contact)
                <div class="maps" id="contact_{{$contact->id}}"><iframe src="{{$contact->google_map}}" width="760" height="300" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                <div class="mapTitle mapAdd" >{{$contact->title}}</div>
                <div class="mapText">{!! $contact->content !!}</div>
                <div class="mapText"><span>Phone</span>: {{$contact->tele_phone}}</div>
                <div class="mapText" id="office2"><span>Fax</span>: {{$contact->fax}}</div>
                <div class="mapText"><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></div>
                <div class="mapLine mapAdd"></div>
            @endforeach
            
        <div class="clear"></div> 
    </div>
        <div class="clear"></div>
    
</div>
@endsection