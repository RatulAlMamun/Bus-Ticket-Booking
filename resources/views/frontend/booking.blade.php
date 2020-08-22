@extends('frontend.master')

@section('title', 'Ticket Booking')

@section('pageCSS')
<!-- Single Page CSS link or style goes here -->
@endsection

@section('maincontainer')
    <!-- Multi-Step-Form Section -->
    <section class="multiStep mt-5">
        <div class="container">
            <form action="{{ route('booking.create') }}" id="regForm" method="POST">
                @csrf
                <!-- Progress Bar -->
                <div class="row text-center">
                    <div class="col-3 p-0">
                        <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                            <p>Ticket Info</p>
                        </div>
                    </div>
                    <div class="col-3 p-0">
                        <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                            <p>Seat Info</p>
                        </div>
                    </div>
                    <div class="col-3 p-0 ">
                        <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                            <p>Personal Info</p>
                        </div>
                    </div>
                    <div class="col-3 p-0">
                        <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                            <p>Payment</p>
                        </div>
                    </div>
                </div>
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
                <!-- First Tab Section -->
                <div class="tab">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card mb-4">
                                <div class="card-header border-0 text-center pt-4">
                                    <h3 class="card-title">Ticket Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="journeyofdate">Select Your Date of Journey:</label>
                                        <input type="date" class="form-control" id="journeyofdate" name="dateofjourney">
                                    </div>
                                    <div class="form-group">
                                        <label for="route">Select Bus Route</label>
                                        <select class="form-control" id="route" name="busroute">
                                            <option value="">-- Select Your Bus Route --</option>
                                            @foreach($bus->busroute as $route)
                                                <option value="{{ $route->route }}">{{ $route->route }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="arrivedplace">Where Do You Arrive The Bus</label>
                                        <input type="text" name="arrivalplace" id="arrivedplace" class="form-control" placeholder="Enter Your Arrival Place">
                                    </div>
                                    <div class="form-group">
                                        <label for="leavingplace">Where Do You Leave The Bus</label>
                                        <input type="text" name="leavingplace" id="leavingplace" class="form-control" placeholder="Enter Your Leaving Place">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-none d-md-block col-md-6">
                            <div class="card bg-transparent mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $bus->name }}</h3>
                                    <p>{{ $bus->description }}</p>
                                    <hr>
                                    <ul class="list-group">
                                        @foreach($bus->busroute as $route)
                                            <li class="list-group-item border-0 bg-transparent">
                                                <i class="fa fa-check text-success"></i> {{ $route->route }} ({{ date("h:i A", strtotime($route->leavingtime)) }})
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

                <!-- Second Tab Section -->
                <div class="tab">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-4 border rounded py-4">
                                <h3 class="mb-4 text-center">Seat Information</h3>
                                <div id="seatGenerator"></div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class=" card-title text-center">Pricing Information</h3>
                                    <hr class="mx-auto w-25 mb-5">
                                    <div class="d-flex justify-content-between px-4">
                                        <div class="selectedSeat mb-3">
                                            <p class="lead mb-4">Your Selected Seat</p>
                                            <div class="selectedseat"></div>
                                        </div>
                                        <div>
                                            <p class="lead mb-4">Total Price</p>
                                            <div class="totalprice"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="gotseats" name="selectedseat" value="">
                                    <input type="hidden" id="gottotalprice" name="totalprice" value="">
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

                <!-- Third Tab Section -->
                <div class="tab">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card mb-4">
                                <div class="card-header border-0 text-center pt-4">
                                    <h3 class="card-title">Passenger Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone No</label>
                                        <input type="text" name="phoneno" id="phone" class="form-control" placeholder="Enter Your Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email (optional)</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address (optional)</label>
                                        <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder="Write Down Your Address Here..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card bg-transparent mb-4">
                                <div class="card-body">
                                    <h3 class="card-title text-center">Pricing Table</h3>
                                    <hr class="mx-auto w-25 mb-5">
                                    <div class="d-flex justify-content-between px-4">
                                        <div class="selectedSeat mb-3">
                                            <p class="lead mb-4">Your Selected Seat</p>
                                            <div class="selectedseat"></div>
                                        </div>
                                        <div>
                                            <p class="lead mb-4">Total Price</p>
                                            <span class="totalprice"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

                <!-- Fourth Tab Section -->
                <div class="tab">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-transparent border-0 text-center pt-4">
                                    <h3 class="card-title">Payment</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="account_no">Your Bkash Account No</label>
                                        <input type="text" name="account_no" id="account_no" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_amount">Payment Amount</label>
                                        <input type="text" name="payment_amount" id="payment_amount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card bg-transparent mb-4">
                                <div class="card-body">
                                    <h3 class="card-title text-center">Pricing Table</h3>
                                    <hr class="mx-auto w-25 mb-5">
                                    <div class="d-flex justify-content-between px-4">
                                        <div class="selectedSeat mb-3">
                                            <p class="lead mb-4">Your Selected Seat</p>
                                            <span class="selectedseat"></span>
                                        </div>
                                        <div>
                                            <p class="lead mb-4">Total Price</p>
                                            <span class="totalprice"></span>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <p class="lead pl-2">* You have to pay <span class="totalprice"></span> by the Bkash.</p>
                                        <p class="lead pl-2">* Our Bkash Account No: 01965088417</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="bus_id" id="bus_id" value="{{ $bus->id }}">
                </div>
                <!-- Next, Previous, Submit Button  -->
                <div class="row mt-2 px-4">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-primary btn-md px-4" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-md px-4 getqueryvalue" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
    </section>
    <input type="hidden" id="busnumberofseat" value="{{ $bus->numberofseat }}">
@endsection

@section('pageJS')
    <script src="{{ asset('frontend/js/multiSteps.js') }}"></script>
    <script src="{{ asset('frontend/js/seatGenerator.js') }}"></script>
    <script>     
        $(document).ready(function () {
            // Date Validation For Date of Journey (Maximum and Minimum)
            $(function () {
                var dtToday = new Date();
                var minmonth = dtToday.getMonth() + 1;
                var minday = dtToday.getDate();
                var minyear = dtToday.getFullYear();
                if (minmonth < 10) {
                    minmonth  = '0' + minmonth.toString();
                }
                if (minday < 10) {
                    minday = '0' + minday.toString();
                }
                var minDate = minyear + '-' + minmonth + '-' + minday;
                $('#journeyofdate').attr('min', minDate);
                // Counting Maximum Day for Ticket Booking Selection
                var aftersevendays = new Date(Date.parse(minDate) + 86400000 * 6);
                var maxmonth = aftersevendays.getMonth() + 1;
                var maxday = aftersevendays.getDate();
                var maxyear = aftersevendays.getFullYear();
                if (maxmonth < 10) {
                    maxmonth  = '0' + maxmonth.toString();
                }
                if (maxday < 10) {
                    maxday = '0' + maxday.toString();
                }
                var maxDate = maxyear + '-' + maxmonth + '-' + maxday;
                $('#journeyofdate').attr('max', maxDate);
            });

            $('.getqueryvalue').click(function () {
                let bookedseat = [];
                var datejourney = $('#journeyofdate').val();
                var journeyroute = $('#route').val();
                var busid = $('#bus_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('seat.query.submit') }}",
                    data: {
                        'busid': busid,
                        'datejourney': datejourney,
                        'journeyroute': journeyroute
                    },
                    datatype: 'JSON',
                    success: function (data) {
                        if (data.success)
                        {
                            var numberofseat = $('#busnumberofseat').val();
                            seatGenerator(numberofseat, 'seatGenerator', data.success);

                            // Selected Seat Handler Function (One click for select and double click fro deselect)
                            var selectedseat = [];
                            $(".seatbutton").click(function () {
                                var seatno = $(this).attr('seatno');
                                var html = '';
                                var ticketprice = 300;
                                var totalprice;
                                if (jQuery.inArray(seatno, selectedseat) == -1)
                                {
                                    if (selectedseat.length < 4) 
                                    {
                                        $(this).addClass("bg-success");
                                        $(this).addClass("text-white");
                                        selectedseat.push(seatno);
                                    } 
                                } else {
                                    $(this).removeClass("bg-success");
                                    $(this).removeClass("text-white");
                                    selectedseat.splice(selectedseat.indexOf(seatno), 1);
                                }
                                for (var i = 0; i < selectedseat.length; i++)
                                {
                                    html += '<span class="seat ml-2">' + seatnoconverter(selectedseat[i], {{ $bus->numberofseat }}) + '</span>';
                                }
                                var totalprice = ticketprice*selectedseat.length;
                                var gotseat = selectedseat.join(',');
                                $('.selectedseat').html(html);
                                $('.totalprice').html(totalprice + ' tk');
                                $("#gotseats").val(gotseat);
                                $("#gottotalprice").val(totalprice);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection