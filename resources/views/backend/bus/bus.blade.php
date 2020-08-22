@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Bus')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- BUS LIST -->
<section class="busList">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-4 ml-auto mt-md-3">
                <div class="card p-0 m-0 border-0 bg-transparent">
                    <div class="card-body p-0 m-0 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary btn-md px-3 mr-2" data-toggle="modal" data-target="#bus">
                            Add New Bus <i class="fas fa-plus-circle"></i>
                        </a>
                        <a href="#" class="btn btn-success btn-md px-3" data-toggle="modal" data-target="#busroute">
                            Add Bus Road <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible m-3 lead">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible m-2">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <h2 class="text-center mb-3">Bus List</h2>
                @if(count($buses) > 0)
                    <table class="table table-striped table-responsive bg-light text-center mb-5 pb-5">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">#</th>
                                <th scope="col">Bus Name</th>
                                <th scope="col">Bus Road (Leaving Time)</th>
                                <th scope="col">Bus Image</th>
                                <th scope="col">Bus Description</th>
                                <th scope="col">Number of Seat</th>
                                <th scope="col">Seat Price</th>
                                <th scope="col">Service</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 0; ?>
                            @foreach($buses as $bus)
                                <tr>
                                    <th scope="row"><?php echo ++$x; ?></th>
                                    <td>{{ $bus->name }}</td>
                                    <td>
                                        @if(count($bus->busroute) > 0)
                                            @foreach($bus->busroute as $route)
                                                <li>{{ $route->route }} ({{ date("h:i A", strtotime($route->leavingtime)) }})</li>
                                            @endforeach
                                        @else
                                            <p class="bg-danger text-white p-2">Please Add Some Road!!!</p>
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('/uploads/'.$bus->image) }}" width="100" alt=""></td>
                                    <td>{{ $bus->description }}</td>
                                    <td>{{ $bus->numberofseat }}</td>
                                    <td>300</td>
                                    @if($bus->service == "1")
                                        <td>On</td>
                                    @else
                                        <td>Off</td>
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#busedit{{ $bus->id }}">Edit</a>
                                                <a class="dropdown-item" href="{{ route('bus.destroy', ['id'=>$bus->id]) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- EDIT BUS MODAL -->
                                <div class="modal fade" id="busedit{{ $bus->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Edit Bus</h5>
                                                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <form action="{{ route('bus.edit') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 border-right">
                                                            <h4>Bus Information</h4>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label for="busName">Bus Name</label>
                                                                <input type="text" name="name" value="{{ $bus->name }}" class="form-control" id="busName">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="busDescription">Bus Description</label>
                                                                <input type="text" name="description" value="{{ $bus->description }}" class="form-control" id="busDescription">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="seatNumber">Number of Seat</label>
                                                                <input type="text" name="numberofseat" value="{{ $bus->numberofseat }}" class="form-control" id="seatNumber">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="busImage">Select Bus Image</label>
                                                                <input type="file" name="image" class="form-control" id="busImage">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="service">Service</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="service" id="on" value="1" checked>
                                                                    <label class="form-check-label" for="on">
                                                                        On
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="service" id="off" value="0">
                                                                    <label class="form-check-label" for="off">
                                                                        Off
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4>Road Information</h4>
                                                            <hr>
                                                            @foreach($bus->busroute as $route)
                                                                <li class="bg-success text-white p-2 d-flex justify-content-between">
                                                                    <div>{{ $route->route }} ({{ date("h:i A", strtotime($route->leavingtime)) }})</div>
                                                                    <div>
                                                                        <a href="{{ route('busroute.destroy', ['id'=>$route->id]) }}" class="badge badge-pill badge-danger">Delete</a>
                                                                    </div>
                                                                </li>
                                                                <div class="form-group">
                                                                    <label for="busroute{{ $route->id }}">Bus Road</label>
                                                                    <input type="text" name="route{{ $route->id }}" value="{{ $route->route }}" class="form-control" id="busroute{{ $route->id }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="leavingTime{{ $route->id }}">Bus Leaving Time</label>
                                                                    <input type="time" name="leavingtime{{ $route->id }}" value="{{ $route->leavingtime }}" class="form-control" id="leavingTime{{ $route->id }}" required>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{ $bus->id }}" name="id">
                                                    <input type="hidden" value="{{ $bus->image }}" name="oldimg">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                                                    <input class="btn btn-primary px-4" type="submit" value="Update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./END EDIT MODAL -->
                            @endforeach
                        </tbody>
                    </table>
                @else
                <p class="lead text-center bg-danger text-white p-5 m-5">Nothing to show!! <strong>Please add some Buses.</strong></p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- ./END BUS LIST -->


<!-- BUS MODAL -->
<div class="modal fade" id="bus">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Bus</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('bus.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="busName">Bus Name</label>
                        <input type="text" name="name" class="form-control" id="busName">
                    </div>
                    <div class="form-group">
                        <label for="busDescription">Bus Description</label>
                        <input type="text" name="description" class="form-control" id="busDescription">
                    </div>
                    <div class="form-group">
                        <label for="seatNumber">Number of Seat</label>
                        <input type="text" name="numberofseat" class="form-control" id="seatNumber">
                    </div>
                    <div class="form-group">
                        <label for="busImage">Select Bus Image</label>
                        <input type="file" name="image" class="form-control" id="busImage">
                    </div>
                    <div class="form-group">
                        <label for="seatPrice">Seat Price</label>
                        <input type="text" name="seat_price" class="form-control" id="seatPrice">
                    </div>
                    <div class="form-group">
                        <label for="service">Service</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="service" id="on" value="1" checked>
                            <label class="form-check-label" for="on">
                                On
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="service" id="off" value="0">
                            <label class="form-check-label" for="off">
                                Off
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary px-4" type="submit" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./END BUS MODAL -->

<!-- BUS ROUTE MODAL -->
<div class="modal fade" id="busroute">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Bus Road</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('bus.route.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="busName">Select Bus Name</label>
                        <select class="form-control bg-transparent" id="busName" name="busname">
                            @if(count($buses) < 1)
                                <option disabled>Please Add Some Bus First</option>
                            @else
                                <option selected disabled>-- Select Bus --</option>
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="busroute">Bus Road</label>
                        <input type="text" name="route" class="form-control" id="busroute" placeholder="e.g. Sherpur to Dhaka">
                    </div>
                    <div class="form-group">
                        <label for="leavingTime">Bus Leaving Time</label>
                        <input type="time" name="leavingtime" class="form-control" id="leavingTime">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary px-4" type="submit" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./END BUS ROUTE MODAL -->
@endsection

@section('pageJS')

@endsection
