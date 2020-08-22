<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @yield('pageCSS')
</head>
<body>
    <!-- Navigation Bar-->
	<nav class="navbar navbar-dark bg-info fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/images/logo.jpg') }}" alt="Logo" style="width:40px;">
            <h2 class="d-inline align-middle">MoonRaz</h2>
        </a>
    </nav>

    @yield('maincontainer')

    <!-- Footer Section -->
    <footer id="footer" class="text-white bg-info py-3 mt-4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="lead mb-0 text-left">
                        Copyright 2020 &copy; MoonRaz Paribahan
                        <br>
                        Developed by Bolda Group
                    </p>
				</div>
			</div>
		</div>
	</footer>

    <!-- Jquery, Popper, Bootstrap JS -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Optional JS -->
    @yield('pageJS')
</body>
</html>