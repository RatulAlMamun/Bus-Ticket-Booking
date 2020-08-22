@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Search')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- SEARCH DATA -->
<section class="searchData">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row py-4 text-center">
                    <div class="col-md-4 mx-auto">
                        <h2>Search Your Data</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="date">Choose Your Date</label>
                                    <input type="date" class="form-control" id="date">
                                </div>
                                <div class="form-group">
                                    <label for="bus">Choose Your Bus</label>
                                    <select class="form-control bus" id="bus">
                                        <option selected disabled>Choose Bus...</option>
                                        @if(!empty($buses))
                                            @foreach($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div id="routeoption"></div>
                                
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-md" id="search">
                                        <i class="fas fa-search fa-lg px-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center cared-title">Searched Result</h3>
                                <div id="seatGenerator"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./EnD SEARCH DATA -->
@endsection

@section('pageJS')
    <script src="{{ asset('/frontend/js/seatGenerator.js') }}"></script>
    <script>
        $('.bus').change(function () {
            var busid = $(this).val();
            var html = `<div class="form-group">
                            <label for="route">Choose Bus Road</label>
                                <select class="form-control" id="route">
                                    <option selected disabled>Choose Bus Road...</option>`;
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
            $('#search').click(function (){
                var date = $('#date').val();
                var busid = $('#bus').val();
                var road = $('#route').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('seat.query') }}",
                    data: {
                        'date': date,
                        'busid': busid,
                        'road': road
                    },
                    datatype: 'JSON',
                    success: function (data) {
                        if (data.success)
                        {
                            if(data.success == "No Search Result Found!!!")
                            {
                                $('#seatGenerator').html(data.success);
                            } else {
                                seatGenerator(data.numberofseat, 'seatGenerator', data.success);  
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
