
@include('layouts.partials.auth')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div class="wrapper">
            @include('layouts.partials.navbar')
            @include('layouts.partials.sidebar')
            <div class="content-wrapper">
                @yield('content')
                <a class="btn btn-primary back-to-top" id="back-to-top" role="button" aria-label="Scroll to top" href="#">
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
            @include('layouts.partials.footer')
            @include('layouts.partials.controlSidebar')
            @include('layouts.partials.script')
        </div>


    </body>
</html>


