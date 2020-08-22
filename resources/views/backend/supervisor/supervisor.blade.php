@extends('backend.layout.master')
@section('title', 'Admin Dashboard')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- SUPERVISOR -->
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="row mb-4">
        <div class="col-md-3 ml-auto mt-md-3">
            <div class="card p-0 m-0 border-0 bg-transparent">
                <div class="card-body p-0 m-0 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary btn-md px-3" data-toggle="modal" data-target="#supervisor">
                        Add New Supervisor <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
        <div class="col-md-3 mx-auto">
            <h2 class="text-center mb-4">Supervisor List</h2>
        </div>
    </div>
    <div class="row">
        @if(!empty($supervisors))
            @foreach($supervisors as $supervisor)
                <div class="col-md-4 mx-auto">
                    <div class="card p-4 mb-3">
                        <div class="card-body text-center">
                            <h4>{{ $supervisor->busname }}</h4>
                            <p>{{ $supervisor->phoneno }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-end bg-transparent">
                            <button class="btn btn-sm px-3 btn-warning mr-2" data-toggle="modal" data-target="#edit{{ $supervisor->id }}">Edit</button>
                            <a href="{{ route('supervisor.destroy', ['id'=>$supervisor->id]) }}" class="btn btn-sm px-3 btn-danger">Delete</a>
                        </div>
                    </div>
                </div>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="edit{{ $supervisor->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Edit Supervisor</h5>
                                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <form action="{{ route('supervisor.edit') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select class="form-control bg-transparent" name="busname">
                                            <option disabled>Choose Bus...</option>
                                            @if(!empty($buses))
                                                @foreach($buses as $bus)
                                                    <option value="{{ $bus->name }}">{{ $bus->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phole">Phone Number</label>
                                        <input type="text" value="{{ $supervisor->phoneno }}" class="form-control" name="phoneno">
                                    </div>
                                    <input type="hidden" value="{{ $supervisor->id }}" name="id">
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
        @endif
    </div>
</div>
<!-- END SUPERVISOR -->


<!-- SUPERVISOR MODAL -->
<div class="modal fade" id="supervisor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Supervisor</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('supervisor.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control bg-transparent" name="busname">
                            <option selected disabled>Choose Bus...</option>
                            @if(!empty($buses))
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->name }}">{{ $bus->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phole">Phone Number</label>
                        <input type="text" name="phoneno" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger px-3" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary px-4" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./END SUPERVISOR MODAL -->
@endsection

@section('pageJS')

@endsection
