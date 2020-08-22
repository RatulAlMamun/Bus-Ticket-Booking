@extends('backend.layout.master')
@section('title', 'Admin Dashboard')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- COUNTER -->
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="row mb-4">
        <div class="col-md-3 ml-auto mt-md-3">
            <div class="card p-0 m-0 border-0 bg-transparent">
                <div class="card-body p-0 m-0 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary btn-md px-3" data-toggle="modal" data-target="#counter">
                        Add New Counter <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
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
    <div class="row">
        <div class="col-md-3 mx-auto">
            <h2 class="text-center mb-5">Counter List</h2>
        </div>
    </div>
    <div class="row">
        @if(!empty($counters))
            @foreach($counters as $counter)
            <div class="col-md-4 mx-auto">
                <div class="card p-4 mb-3">
                    <div class="card-body text-center">
                        <h5>{{ $counter->placename }}</h5>
                        <h3>{{ $counter->shopname }}</h3>
                        <p>{{ $counter->address }}</p>
                        <p><i class="fas fa-phone-alt"></i> {{ $counter->phoneno }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-transparent">
                        <button class="btn btn-sm px-3 btn-warning mr-2" data-toggle="modal" data-target="#edit{{ $counter->id }}">Edit</button>
                        <a class="btn btn-sm px-3 btn-danger" href="{{ route('counter.destroy', ['id'=>$counter->id]) }}">Delete</a>
                    </div>
                </div>
            </div>

            <!-- EDIT MODAL -->
            <div class="modal fade" id="edit{{ $counter->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit {{ $counter->placename }}</h5>
                            <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form action="{{ route('counter.edit') }}" method="POST">
                        @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="place">Counter Place</label>
                                    <input type="text" name="placename" value="{{ $counter->placename }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="shop">Shop Name</label>
                                    <input type="text" name="shopname" value="{{ $counter->shopname }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phole">Phone Number</label>
                                    <input type="tel" name="phoneno" value="{{ $counter->phoneno }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" rows="3" name="address">{{ $counter->address }}</textarea>
                                </div>
                                <input type="hidden" name="id" value="{{ $counter->id }}">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary px-4" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ./END EDIT MODAL -->
            @endforeach
        @else
            <h3 class="text-center">You have NO COUNTER to show.</h3>
        @endif
    </div>
</div>
<!-- END COUNTER -->


<!-- ADD COUNTER MODAL -->
<div class="modal fade" id="counter">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Counter</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('counter.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="place">Counter Place</label>
                        <input type="text" name="placename" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="shop">Shop Name</label>
                        <input type="text" name="shopname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phole">Phone Number</label>
                        <input type="text" name="phoneno" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea cols="30" rows="3" name="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./END COUNTER MODAL -->
@endsection

@section('pageJS')

@endsection
