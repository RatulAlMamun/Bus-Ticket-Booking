@extends('frontend.master')

@section('title', 'MoonRaz')

@section('pageCSS')
<!-- Single Page CSS link or style goes here -->
@endsection

@section('maincontainer')
    <!-- Slider carousel -->
	<section class="bg-dark">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('frontend/images/bus1.jpg') }}" alt="First slide">
                    <h2 class="text">MOONRAZ</h2>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('frontend/images/bus2.jpg') }}" alt="Second slide">
                    <h2 class="text">GOURAB</h2>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('frontend/images/bus3.jpg') }}" alt="Third slide">
                    <h2 class="text">COLLECTOR</h2>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    <!-- Bus Preview Section -->
	<section id="bus-preview" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center pb-4">
					<h1 class="header-font">Our Bus Services</h1>
					<p class="lead">We have provided {{ count($buses) }} bus services. Click any button below to book your ticket.</p>
				</div>
			</div>
			@if(count($buses) > 0)
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            @foreach($buses as $bus)
                                <div class="card">
                                    <img src="{{ asset('uploads/'.$bus->image) }}" class="img-fluid card-img-top" alt="image1">
                                    <div class="card-body">
                                        <div class="card-title text-center">
                                            <h4>{{ $bus->name }}</h4>
                                            <small class="text-muted">{{ $bus->description }}</small>
                                            <hr>
                                            <ul class="list-group">
                                                @foreach($bus->busroute as $route)
                                                    <li class="list-group-item">
                                                        <i class="fa fa-check text-success"></i> {{ $route->route }} ({{ date("h:i A", strtotime($route->leavingtime)) }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <a href="{{ url('/booking/'.$bus->id) }}" class="btn btn-block btn-success mt-3">Book Your Ticket</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
		</div>
    </section>
    
    <!-- Contact us Section-->
	<section id="contact-us">
		<div class="container">
			<div class="row pb-4 text-center">
				<div class="col-12">
					<h3 class="header-font">Contact With Us</h3>
					<p class="lead">Come to our counter directly or call us for any help or query.</p>
				</div>
            </div>
            <!-- Collapsible Section or Accordion -->
            <div id="accordion">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="card-link text-info" data-toggle="collapse" href="#counterinfo">
                            <p class="lead">Counter Contact Information</p>
                        </a>
                    </div>
                    <div id="counterinfo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                @if(!empty($counters))
                                    @foreach($counters as $counter)
                                        <div class="col-12 col-md-4 text-center mt-md-0 mt-3">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h4 class="contact-heading2">{{ $counter->placename }}</h4>
                                                    <h5>{{ $counter->shopname }}</h5>
                                                    <p class="contact-paragraph">{{ $counter->address }}</p>
                                                    <ul class="list-group contact-paragraph">
                                                        <li class="list-group-item">
                                                            <i class="fa fa-phone"></i> +88{{ $counter->phoneno }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <a class="card-link text-info" data-toggle="collapse" href="#supervisorinfo">
                            <p class="lead">Supervisor Contact Information</p>
                        </a>
                    </div>
                    <div id="supervisorinfo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                @if(!empty($supervisors))
                                    @foreach($supervisors as $supervisor)
                                        <div class="col-12 col-md-4 text-center mt-md-0 mt-3">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h4 class="contact-heading2 mb-3">{{ $supervisor->busname }}</h4>
                                                    <ul class="list-group contact-paragraph">
                                                        <li class="list-group-item">
                                                            <i class="fa fa-phone"></i> +88{{ $supervisor->phoneno }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageJS')
<!-- Single Page CSS link or style goes here -->
@endsection