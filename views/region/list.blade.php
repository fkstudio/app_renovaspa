@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		@foreach($model as $region)
		@php
			$name = str_replace(' ', '_', $region->Name);

		@endphp
		<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/region/{{ $region->Id }}/hotels">
		    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 " style="
		    													overflow: hidden;
		    													margin-bottom: 20px;">
		    	<img src="{{ URL::to('/images') }}/regions/{{ $name  }}.jpg" class="img-responsive" style="position: absolute;height: 100%;width: 100%;">
		    	<div  class="col-md-12 block-content" >
		    		<span>{{ $region->Name }}</span>
				</div>
		    </div>
		</a>

	    @endforeach
	</div>
</div>
@endsection