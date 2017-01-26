@extends('layout/baseLayout')

@section('title', $model->Name)

@section('content')
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr/>
	<div class="row">
		<div class="col-md-6">
			<!-- Slider -->
	        <div id="slider">
	            <!-- Top part of the slider -->
	            <div class="row">
	                <div class="col-sm-12" id="carousel-bounding-box">
	                    <div class="carousel slide carousel-bordered" style="height: 320px;" id="myCarousel">
	                        <!-- Carousel items -->
	                        @foreach($model->Photos as $key => $photo)
						  		@php

						  		$active = ($key == 0 ? 'active' : '');

						  		@endphp
						  		<div class="carousel-inner">
	                                <div class="{{ $active }} item" data-slide-number="{{ $key }}">
	                                    <img style="height: 300px;" src="{{ URL::to('/images/hotels') }}/hotel-{{ $model->Id }}/{{ $photo->Path }}">
	                                </div>
	                            </div>
						  	@endforeach


	                        <!-- Carousel nav -->
	                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	                            <span class="glyphicon glyphicon-chevron-left"></span>
	                        </a>
	                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	                            <span class="glyphicon glyphicon-chevron-right"></span>
	                        </a>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-12 col-lg-12" id="slider-thumbs">
	            <div class="row">
	            	<!-- Bottom switcher of slider -->
		            <ul class="hide-bullets">
		            	<div class="row">
		            		@foreach($model->Photos as $key => $photo)
					  		@php

					  		$active = ($key == 0 ? 'active' : '');

					  		@endphp
					  		<li class="col-md-4">
		                        <a class="thumbnail thumbnail-carousel" id="carousel-selector-{{ $key }}">
		                            <img src="{{ URL::to('/images/hotels') }}/hotel-{{ $model->Id }}/{{ $photo->Path }}">
		                        </a>
		                    </li>
					  	@endforeach
		            	</div>
		            </ul>
	            </div>
	        </div>
	        <!--/Slider-->
	    </div>
	    <div class="col-md-6">
	    	<h2 class="details-hotel-title">{{ $model->Name }}</h2>
	    	<div class="clearfix"></div>
	    	<div class="under-title-line"></div>
	    	<p><strong>{{ trans("hotel.address") }}</strong>: {{ $model->Address }}<br/>
	    	   <strong>{{ trans("hotel.hours") }}</strong>: {{ $model->OpenAt->format('H:i:s a') }} - {{ $model->ClosetAt->format('H:i:s a') }}</p>
	    	@if (empty($model->Description))
	    	<p>No description to show</p>
	    	@else
	    	<span style="font-size: 12px;">
	    	{!! $model->Description !!}
	    	</span>
	    	@endif
	    </div>
	</div>
</div>	
<div class="clearfix"></div>
<div class="container-fluid-full" id="details-hotel-container-book">
	<div class="container-fluid">
		<br/>
		<h2 style="color: #5fc7ae;" class="text-center">Book your treatment or certificate</h2>
		<br/>
		<form action="" method="" class="form-inline text-center">
			<div class="form-group text-left">
				<label class="custom-label">Book type</label>
				<div class="clearfix"></div>
				<select class="form-control custom-select">
					<option value="0">Individual services</option>
					<option value="1">Gift certificate</option>
				</select>
			</div>
			<div class="form-group text-left">
				<label class="custom-label">Country</label>
				<div class="clearfix"></div>
				<select class="form-control custom-select">
					<option>Aruba</option>
				</select>
			</div>
			<div class="form-group text-left">
				<label class="custom-label">Destination</label>
				<div class="clearfix"></div>
				<select class="form-control custom-select"></select>
			</div>
			<div class="form-group text-left">
				<label class="custom-label">Hotel</label>
				<div class="clearfix"></div>
				<select class="form-control custom-select"></select>
			</div>
			<div class="form-group">
				<label class="custom-label"></label>
				<div class="clearfix"></div>
				<button type="submit" class="btn-confirm-book btn btn-primary">CONFIRM</button>
			</div>
		</form>
		<br/>
		<br/>
		<br/>
	</div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function($) {
 
    $('#myCarousel').carousel({
            interval: 5000
    });

    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            $('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
    // When the carousel slides, auto update the text
    $('#myCarousel').on('slid.bs.carousel', function (e) {
             var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
    });
});
</script>
@endsection