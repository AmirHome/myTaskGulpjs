@extends('layouts.master')
@section('page_title', 'Contact Form')

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
                        <li><a href="{{URL::to('contacts#contact_'.$contact->id)}}" class="anchorLink">{{$contact->title}}</a></li>
                    @endforeach
                    </ul>
                </li>
                <li>Contact Form
                    <ul>
                        <li class="active-select">Contact Form</li>
                    </ul>
                </li>
            </ul>
        
    </div>
</div>
@endsection

@section('content')

<div class="container">
    

        <div class="categories-page-right">
            <div class="products-detail-title">Contact Form</div>
            {!! Form::open(array('url' => 'contact', 'class' => 'form')) !!}
            <ul class="errors">
            @foreach($errors->all('<li>:message</li>') as $message) {!! $message !!}
            @endforeach
            </ul>

            <div class="contactText">
            <span>{!! Form::label('Name', 'Name') !!}</span>
            {!! Form::text('name', Input::old('name'), ['class' => 'form-control inputOne', 'onblur'=>"if (this.value==''){this.value='Name';}", 'onfocus'=>"if (this.value=='Name'){this.value='';}"] ) !!}
            </div>

            <div class="contactText">
            <span>{!! Form::label('Email', 'Email') !!}</span>
            {!! Form::text('email', Input::old('email'), ['class' => 'form-control inputOne', 'onfocus'=>"if (this.value=='Email'){this.value='';}", 'onblur'=>"if (this.value==''){this.value='Email';}"] ) !!}
            </div>

            <div class="contactTextR">
            <span>{!! Form::label('Message', 'Message') !!}</span>
            {!! Form::textarea('str_message', Input::old('str_message'), ['class' => 'form-control adressTextArea'] ) !!}
            </div>
            <div>{!! Form::submit('Send', ['class' => 'clear sendBtn', ]) !!}</div>
            {!! Form::close() !!}

        </div>
            
            
        <div class="clear"></div>
    
</div>
@endsection