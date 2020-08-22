@extends('backend.layout.master')
@section('title', 'Admin Dashboard')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- CARDS -->
<section class="cards">
    <div class="container-fluid px-4">
        <div class="row mb-3">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row bg-secondary">
                    <div class="col-lg-3 col-md-6 col-12 p-2">
                        <div class="card py-md-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-bus-alt fa-3x text-secondary"></i>
                                    <div class="text-secondary text-center">
                                        <h3>Bus</h3>
                                        <h4>{{ $bus }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 p-2">
                        <div class="card py-md-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-flag fa-3x text-secondary"></i>
                                    <div class="text-secondary text-center">
                                        <h3>Counter</h3>
                                        <h4>{{ $counter }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 p-2">
                        <div class="card py-md-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-male fa-3x text-secondary"></i>
                                    <div class="text-secondary text-center">
                                        <h3>Supervisor</h3>
                                        <h4>{{ $supervisor }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 p-2">
                        <div class="card py-md-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-stream fa-3x text-secondary"></i>
                                    <div class="text-secondary text-center">
                                        <h3>Pending</h3>
                                        <h4>{{ $newbooking }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./END CARDS -->

<!-- RECENT BOOKING -->
<section class="recentBooking">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <h2 class="text-center py-4 text-primary">Recent Booking</h2>
                    </div>
                </div>

                <div class="row">
                    @if(!empty($bookings))
                        @foreach($bookings as $booking)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <p class="lead"><i class="fas fa-bus-alt fa-lg text-danger"></i> {{ $booking->bus->name }}</p>
                                        <div class="my-4">
                                            <span class="lead">Selected Seat(s):</span>
                                            @foreach($booking->selectedseat as $seat)
                                                <span class="seat">{{ $seat }}</span>
                                            @endforeach
                                        </div>
                                        <p class="lead"><i class="fas fa-user-tie fa-lg text-info"></i> {{ $booking->name }}</p>
                                        <p class="lead"><i class="fas fa-phone-alt fa-lg text-warning"></i> {{ $booking->phoneno }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent d-flex justify-content-end">
                                        <a href="{{ url('/admin/booking/'.$booking->id.'/singleview') }}" class="btn btn-primary btn-md px-3">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./END RECENT BOOKING -->
@endsection

@section('pageJS')
@endsection
