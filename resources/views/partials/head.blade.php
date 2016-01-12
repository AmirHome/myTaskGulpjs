<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="content-language" content="tr" />
    <meta name="description" content="site açıklaması" />
    <meta name="keywords" content="site açıklaması" />
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1 day" />
    <meta name="rating" content="general" />
    <meta name="audience" content="all" />
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no,width=device-width,height=device-height">
    
    <title>@yield('page_title')</title>
    
    <!-- head general -->
    {!! HTML::style('resources/assets/css/font-awesome.min.css') !!}
    {!! HTML::style('resources/assets/css/style.css') !!}
    {!! HTML::style('resources/assets/css/all.css') !!}
    {!! HTML::style('resources/assets/css/menu.css') !!}
    {!! HTML::style('resources/assets/css/megaMenu.css') !!}
    {!! HTML::style('resources/assets/css/dropit.css') !!}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    {!! HTML::script('resources/assets/js/menu.js'); !!}
    {!! HTML::script('resources/assets/js/jquery.confirm.js'); !!}
    {!! HTML::script('resources/assets/js/dropit.js'); !!}
    {!! HTML::script('resources/assets/js/modernizr-2.6.2.min.js'); !!}

    @yield('parials_head')
</head>

<body>