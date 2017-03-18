@extends('layout/baseLayout')

@section('title', $model->Name)

@section('content')
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr/>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<!-- Top part of the slider -->
            <div class="row">
                <div class="col-lg-12 col-sm-12" id="carousel-bounding-box">
                    <div class="carousel slide" id="hotel-carousel">    	
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            @php
                                $countryName = strtolower(str_replace(' ', '-', $region->Country->Name));
                                $regionName = strtolower(str_replace(' ', '-', $region->Name));
                                $hotelName = str_replace(' ', '-', $model->Name);

                                $folderPath = '/images/hotels/'.$countryName .'/'. $regionName .'/'.$hotelName;
                                $photoPath = base_path().'/public'.$folderPath;
                                $urlPath = URL::to('/').$folderPath;

                                $files = scandir($photoPath);

                                array_shift($files);
                                array_shift($files);
                            @endphp
                        	<!-- Carousel items -->
	                        @foreach($files as $key => $file)
						  		    @php

    						  		$active = ($key == 0 ? 'active' : '');

    						  		@endphp
	                                <div  class="{{ $active }} item" data-slide-number="{{ $key }}">
	                                    <img src="{{ $urlPath . '/' . $file }}">
	                                </div>
						  	@endforeach
                        </div>
                        <!-- Carousel nav -->
                        <a class="left carousel-control" href="#hotel-carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#hotel-carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
	        <div class="row visible-lg">
        		<!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                	@foreach($files  as $key => $file)
				  		@php

				  		$active = ($key == 0 ? 'active' : '');

				  		@endphp
				  		<li class="col-lg-4 col-sm-3 col-xs-4">
	                        <a class="thumbnail thumbnail-carousel" id="carousel-selector-{{ $key }}">
	                            <img src="{{ $urlPath .'/'. $file }}">
	                        </a>
	                    </li>
				  	@endforeach
                </ul>	
        	</div>
	    </div>
        <div class="clearfix hidden-lg hidden-md"></div>
        <br class="hidden-lg hidden-md" />
	    <div class="col-lg-6 col-md-6">
	    	<h2 class="details-hotel-title">{{ $model->Name }}</h2>
	    	<div class="clearfix"></div>
	    	<div class="under-title-line"></div>
	    	<p><strong>{{ trans("hotel.address") }}</strong>: {!! $model->Address !!}<br/>
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
@endsection

@section('scripts')
<script>
$(document).ready(function($) {
 
    $('#hotel-carousel').carousel({
            interval: 5000
    });

    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            $('#hotel-carousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
    // When the carousel slides, auto update the text
    $('#hotel-carousel').on('slid.bs.carousel', function (e) {
             var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
    });
});
</script>
@endsection