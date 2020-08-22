@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Booking')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- BOOKING -->
<section class="booking">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible m-3 lead">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-6 text-center">
                        <h2 class="my-3">Booking</h2>
                    </div>
                    <div class="col-6 text-center">
                        <input type="text" class="form-control mt-3 w-50" id="myInput" onkeyup="myFunction()" placeholder="Search By Phone Number...">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <table class="table w-75 table-striped table-responsive bg-light text-center" id="myTable">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">#</th>
                                <th scope="col">Bus Name</th>
                                <th scope="col">Seat Number</th>
                                <th scope="col">Passenger Name</th>
                                <th scope="col">Passenger Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($bookings))
                                <?php $x = 1; ?>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td scope="row">{{ $x++ }}</td>
                                        <td>{{ $booking->bus->name }}</td>
                                        <td>
                                            @foreach($booking->selectedseat as $seat)
                                                <span>{{ $seat }},</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->phoneno }}</td>
                                        <td>
                                            @if($booking->booking_status == 0)
                                                <span class="text-warning">Pending</span>
                                            @elseif($booking->booking_status == 1)
                                                <span class="text-success">Approved</span>
                                            @elseif($booking->booking_status == 2)
                                                <span class="text-info">Returned</span>
                                            @else
                                                <span class="text-danger">Paid</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ url('/admin/booking/'.$booking->id.'/singleview') }}" class="btn btn-primary btn-md px-3">View Details</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./END BOOKING -->
@endsection

@section('pageJS')
<script>
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
            if (td) {
                if (td.innerHTML.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
