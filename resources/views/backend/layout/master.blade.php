<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        @yield('pageCSS')
    </head>

    <body>
        @include('backend.layout.sidenav')
        @yield('maincontainer')
        
        <!-- FOOTER -->
        <section class="footer">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto p-0">
                <footer class="py-3">
                    <div>
                        <p class="lead text-center mt-3">&copy; 2020 Bus Ticket Booking Developed By Bolda Group</p>
                    </div>
                </footer>
            </div>
        </section>
        <!-- ./END FOOTER -->

        <!-- Bootstrap Scripts -->
        <script src="{{ asset('backend/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('backend/js/popper.min.js') }}"></script>
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('backend/js/main.js') }}"></script>
        @yield('pageJS')
    </body>
</html>
