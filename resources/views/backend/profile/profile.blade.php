@extends('backend.layout.master')
@section('title', 'Admin Dashboard | Search')

@section('pageCSS')

@endsection

@section('maincontainer')
<!-- ACTIONS -->
<section class="actions">
    <div class="container-fluid px-4">
        <div class="row mb-3">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row py-4">
                    <div class="col-md-3 mb-3 ml-auto">
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#passwordModal">
                            <i class="fas fa-lock"></i> Change Password
                        </a>
                    </div>
                </div>

                <!-- PROFILE EDIT -->
                <div class="row">
                    @if(session('success'))
               <div class="alert alert-success">{{session('success')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                                <p class="lead">{{ $error }}</p><br>
                           
                        @endforeach
                         </div>
                    @endif
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-sm" value="{{ $user->name }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-sm" value="{{ $user->email }}" name="email">
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./END ACTIONS -->

<!-- PASSWORD MODAL -->
<div class="modal fade" id="passwordModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Change Password</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('password.change') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control form-control-sm" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" class="form-control form-control-sm" name="password_confirmation">
                    </div>  
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./END PASSWORD MODAL -->
@endsection

@section('pageJS')

@endsection
