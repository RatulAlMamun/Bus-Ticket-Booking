@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Booking')

@section('pageCSS')
@endsection

@section('maincontainer')
<!-- ADD BOOKING -->
<section class="multiStep">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row mt-4">
                    <div class="col-md-4 mx-auto">
                        <h2 class="text-center">ADD BOOKING</h2>
                    </div>
                </div>

                <form action="{{ route('addbooking.create') }}" method="POST" id="regForm">
                    @csrf
                    <!-- Progress Bar -->
                    <div class="row text-center">
                        <div class="col-4 p-0">
                            <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                                <p>Ticket Info</p>
                            </div>
                        </div>
                        <div class="col-4 p-0">
                            <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                                <p>Seat Info</p>
                            </div>
                        </div>
                        <div class="col-4 p-0 ">
                            <div class="step btn btn-secondary px-md-5 pt-3 my-4 w-100">
                                <p>Personal Info</p>
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
                            <div class="col-md-6 col-12 mx-auto">
                                <div class="card mb-4">
                                    <div class="card-header border-0 text-center pt-4">
                                        <h3 class="card-title">Ticket Information</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="journeyofdate">Select Your Date of Journey:</label>
                                            <input type="date" class="form-control" id="journeyofdate" placeholder="Enter date" name="dateofjourney">
                                        </div>
                                        <div class="form-group">
                                            <label for="bus">Select Bus</label>
                                            <select class="form-control" id="bus" name="bus_id">
                                                <option value="">-- Select Your Bus --</option>
                                                @if(!empty($buses))
                                                    @foreach($buses as $bus)
                                                        <option value="{{ $bus->id }}" seat="{{ $bus->numberofseat }}">{{ $bus->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div id="routeoption"></div> 
                                        <div class="form-group">
                                            <label for="arrivedplace">Where Do You Arrive The Bus</label>
                                            <input type="text" name="arrivalplace" id="arrivedplace" class="form-control" placeholder="Enter Your Arrival Place">
                                        </div>
                                        <div class="form-group">
                                            <label for="leavingplace">Where Do You Leave The Bus</label>
                                            <input type="text" name="leavingplace" id="leavingplace" class="form-control" placeholder="Enter Your Arrival Place">
                                        </div>
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
                                            <label for="payment_amount">Payment Amount</label>
                                            <input type="text" name="payment_amount" id="payment_amount" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email (optional)</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address (optional)</label>
                                            <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Write Down Your Address Here..."></textarea>
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
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <!-- Next, Previous, Submit Button  -->
                    <div class="row px-4 mb-5">
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
        </div>
    </div> 
</section>
<!-- ADD BOOKING -->
@endsection

@section('pageJS')
    <script src="{{ asset('frontend/js/seatGenerator.js') }}"></script>
    <script src="{{ asset('backend/js/multiSteps.js') }}"></script>
    <script>
        $('#bus').change(function () {
            var busid = $(this).val();
            var html = `<div class="form-group">
                            <label for="route">Choose Bus Road</label>
                                <select class="form-control" id="route" name="busroute">
                                    <option value="">-- Select Bus Road --</option>`;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('road.getval') }}",
                data: {
                    'busid': busid
                },
                datatype: 'JSON',
                success: function (data) {
                    if (data.success)
                    {
                        for (let i = 0; i < data.success.length; i++) {
                            html += `<option value="`+ data.success[i] +`">`+ data.success[i] +`</option>`;
                        }
                        html += `</select></div>`;
                        $('#routeoption').html(html);
                    }
                }
            });
        });

        $('.getqueryvalue').click(function () {
            let bookedseat = [];
            var datejourney = $('#journeyofdate').val();
            var journeyroute = $('#route').val();
            var busid = $('#bus').val();
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
                        var numberofseat = $('#bus option:selected').attr('seat');
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
                                html += '<span class="seat ml-2">' + seatnoconverter(selectedseat[i], numberofseat) + '</span>';
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
    </script>
@endsection
