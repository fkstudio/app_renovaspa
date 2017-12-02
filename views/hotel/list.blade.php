@extends('layout/baseLayout')

@section('title', 'Hotels')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		@foreach($model as $hotelRegion)
			@if($hotelRegion->Hotel->IsDeleted != true)
		    @php
		    	$url = "";
			    
			    if ($reservationType == 2){
			    	$url = "/certificate/options/".$hotelRegion->Hotel->Id;
			    }
			    else {
			    	$url = "/hotel/".$hotelRegion->Hotel->Id."/categories";
			    }
		    @endphp
		    <a style="font-size: 30px;color:white;" href="{{ URL::to('/').$url }}">
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 parent" style="overflow: hidden;margin-bottom: 20px;">
			    	<span style="position: absolute;
								 height: 100%;
								 width: 100%;
								 background-image: url({{ config("app.admin_url") .'/images/hotels/'. $hotelRegion->Hotel->getProfile() }});
								 background-position: center center;
								 background-size: cover;"  class="img-responsive"></span>
			    	<div  class="col-md-12 block-content" >
			    		<span class="span-list">{{ $hotelRegion->Hotel->Name }}</span>
					</div>
			    </div>
			</a>
			@endif
	    @endforeach
	</div>
</div>
@endsection

    