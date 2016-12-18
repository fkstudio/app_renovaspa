@extends('layout/baseLayout')

@section('title', $model->Name)

@section('content')
    <h1>{{ $model->Name }}</h1>
    <br/>
    <div class="clearfix"></div>
    
    <div class="clearfix"></div>
    <div class="row">
    	<div class="col-md-6">
    		<div id="hotelCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			  	@foreach($model->Photos as $key => $photo)
			  		@php

			  		$active = ($key == 0 ? 'active' : '');

			  		@endphp
			  		<li data-target="#hotelCarousel" data-slide-to="{{ $key }}" class="{{ $active }}"></li>
			  	@endforeach
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			  	@foreach($model->Photos as $key => $photo)
			  		@php

			  		$active = ($key == 0 ? 'active' : '');

			  		@endphp
			  		<div class="item {{ $active }}">
				      <img src="{{ URL::to('/images/hotels') }}/hotel-{{ $model->Id }}/{{ $photo->Path }}" alt="Chania">
				    </div>
			  	@endforeach

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#hotelCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">{{ trans('pagination.previous') }}</span>
			  </a>
			  <a class="right carousel-control" href="#hotelCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">{{ trans('pagination.next') }}</span>
			  </a>
			</div>
	    </div>
	    <div class="col-md-6">
	    	<p><strong>{{ trans("hotel.address") }}</strong>: {{ $model->Address }}</p>
	    	<p><strong>{{ trans("hotel.hours") }}</strong>: {{ $model->OpenAt->format('H:i:s') }} - {{ $model->ClosetAt->format('H:i:s') }}</p>
	    </div>
    </div>	
    
@endsection