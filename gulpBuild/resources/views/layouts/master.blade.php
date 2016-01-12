<!-- head -->
@include('partials.head')
<!-- topbar -->
@include('partials.topbar')

<!--  preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0]))  -->


<!-- include('partials.sidebar') -->


<!--                     @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif -->


<!-- sidebars -->
@yield('sidebars')
<!-- content -->
@yield('content')
<!-- javascript -->
@include('partials.javascripts')

<!-- footer -->
@include('partials.footer')


