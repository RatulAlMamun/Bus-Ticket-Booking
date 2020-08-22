<!-- SIDE NAVBAR -->
<nav class="navbar navbar-expand-md p-0 mb-2">
    <a href="dashboard.html" class="navbar-brand d-flex justify-content-between">
        <h3 class="ml-4">Bus Ticket</h3>
    </a>
    <button class="navbar-toggler ml-auto mb-2" type="button" data-toggle="collapse" data-target="#navbarNav">
        <i class="fas fa-align-right text-light"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="container-fluid p-0">
            <div class="row w-100 m-0">
                <!-- SIDEBAR -->
                <div class="col-xl-2 col-lg-3 col-md-4 fixed-top sidebar px-0">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item d-none d-md-block text-center mb-4">
                            <a class="text-uppercase text-white logo">
                                <span class="mt-5">Bus Ticket</span>
                            </a>
                        </li>
                        <li class="nav-item current">
                            <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                                <i class="fas fa-qrcode fa-lg mr-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-stream fa-lg mr-2"></i> Booking
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ url('/admin/booking/addbooking') }}" class="dropdown-item">
                                    <i class="fas fa-plus-circle fa-lg"></i> Add Booking
                                </a>
                                <a href="{{ url('/admin/booking/view') }}" class="dropdown-item">
                                    <i class="fas fa-eye fa-lg"></i> View Booking
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/bus') }}" class="nav-link">
                                <i class="fas fa-bus-alt fa-lg mr-2"></i> Bus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/counter') }}" class="nav-link">
                                <i class="fas fa-flag fa-lg mr-2"></i>Counter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/supervisor') }}" class="nav-link">
                                <i class="fas fa-male fa-lg mr-2"></i> Supervisor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/profile') }}" class="nav-link">
                                <i class="fas fa-user-circle fa-lg"></i> Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/search') }}" class="nav-link">
                                <i class="fas fa-search fa-lg"></i> Search
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-sign-out-alt fa-lg"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
                    </ul>
                </div>
                <!-- ./END SIDEBAR -->
            </div>
        </div>
    </div>
</nav>
<!-- ./END SIDE NAVBAR -->
