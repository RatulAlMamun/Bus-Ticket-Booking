@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Booking')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- SINGLE VIEW -->
<section class="singleView">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row my-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-md-flex justify-content-between">
                                <div>
                                    <p class="lead"><i class="fas fa-bus-alt fa-lg"></i> {{ $booking->bus->name }}</p>
                                    <p class="lead"><i class="fas fa-calendar-alt fa-lg"></i> {{ date_format(date_create($booking->dateofjourney), "d F, Y") }}</p>
                                    <p class="lead"><i class="fas fa-user-tie fa-lg"></i> {{ $booking->name }}</p>
                                    <p class="lead"><i class="fas fa-phone-alt fa-lg"></i> {{ $booking->phoneno }}</p>
                                    <p class="lead"><i class="fas fa-envelope fa-lg"></i> 
                                        @if($booking->email)
                                            {{ $booking->email }}
                                        @else
                                            <span class="text-danger">No Email</span>
                                        @endif
                                    </p>
                                    <p class="lead"><i class="fas fa-map-marker-alt fa-lg"></i> 
                                        @if($booking->address)
                                            {{ $booking->address }}
                                        @else
                                            <span class="text-danger">No Address</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    @if($booking->account_no)
                                        <p class="lead">Account No: {{ $booking->account_no }}</p>
                                    @endif
                                    <p class="lead">Paid Amount: {{ $booking->payment_amount }} tk</p>
                                </div>
                                <div>
                                    <div class="my-3">
                                        @foreach($booking->selectedseat as $seat)
                                            <span class="seat">{{ $seat }}</span>
                                        @endforeach
                                    </div>
                                    <p class="lead"><i class="fas fa-credit-card fa-lg"></i> {{ $booking->totalprice }} tk</p>
                                    <p class="lead"><i class="fas fa-location-arrow fa-lg"></i> {{ $booking->busroute }}</p>
                                    <p class="lead">Leaving Place: {{ $booking->arrivalplace }}</p>
                                    <p class="lead">Arrival Place: {{ $booking->leavingplace }}</p>
                                    <p class="lead">Status: 
                                        @if($booking->booking_status == 0)
                                            <span class="bg-warning p-2">Pending</span>
                                        @elseif($booking->booking_status == 1)
                                            <span class="bg-success text-white p-2">Approved</span>
                                        @else
                                            <span class="bg-info text-white p-2">Returned</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent d-flex mx-auto mb-3 p-0">
                                <a href="{{ route('booking.approved', ['id'=>$booking->id]) }}" class="btn btn-success btn-md text-center px-md-3 mr-md-2 mobileBtn">Approve</a>
                                <a href="{{ route('booking.destroy', ['id'=>$booking->id]) }}" class="btn btn-danger btn-md text-center px-md-3 mr-md-2 mobileBtn">Delete</a>
                                <a href="{{ route('booking.return', ['id'=>$booking->id]) }}" class="btn btn-warning btn-md text-center px-md-3 mobileBtn">Return</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./SINGLE VIEW -->

@endsection

@section('pageJS')

@endsection
