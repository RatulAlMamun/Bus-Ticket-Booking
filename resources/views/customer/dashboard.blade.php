<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
        <title>Bus Ticket Booking Admin Area | Users</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>

    <body>
         <!-- TOPBAR -->
         <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown mr-3">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user"></i> Welcome John Doe
                            </a>
                            <div class="dropdown-menu">
                                <a href="profile.html" class="dropdown-item">
                                    <i class="fas fa-user-circle"></i> Profile
                                </a>
                                <a href="settings.html" class="dropdown-item">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="login.html" class="nav-link">
                                <i class="fas fa-user-times"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- ./END TOPBAR -->

        <!-- HEADER -->
        <header id="main-header" class="py-2 bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1><i class="fas fa-users"></i> Users</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- ./END HEADER -->

        <!-- ACTIONS -->
        <section id="actions" class="py-4 mb-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-primary">Search</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./END ACTIONS -->

        <!-- USERS -->
        <section id="posts">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Users</h4>
                            </div>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>John Doe</td>
                                        <td>jdoe@gmail.com</td>
                                        <td>dfdr544343</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">2</td>
                                        <td>Istiak Tushar</td>
                                        <td>test@test.com</td>
                                        <td>454647564545</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">2</td>
                                        <td>Istiak Tushar</td>
                                        <td>test@test.com</td>
                                        <td>454647564545</td>
                                    </tr>
                                </tbody>
                            </table>

                            <nav class="ml-4">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./END USERS -->

        <!-- FOOTER -->
        <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="lead text-center">Copyright &copy; 2019 Blogen</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ./END FOOTER -->


        <!-- Bootstrap Scripts -->
        <script src="{{ asset('backend/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('backend/js/popper.min.js') }}"></script>
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    </body>
</html>