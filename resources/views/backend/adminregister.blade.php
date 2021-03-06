<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/dashboard.css') }}">
        <title>Admin Login</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    </head>

<body>
<section id="login" class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">Admin Registration</h4>
                            </div>
                            <div class="card-body">
                                <form action="dashboard.html">
                                    <div class="form-group">
                                        <label for="name">Enter Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Enter Email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Enter Phone</label>
                                        <input type="tel" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Enter Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Sign Up">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FOOTER -->
        <section class="footer">
            <div class="col-12 ml-auto p-0">
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