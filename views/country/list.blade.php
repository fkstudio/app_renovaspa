@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		
	
	@foreach($model as $country)
		@php
			$photoPath = '/noimage.jpg';

			if($country->Photo != null)
			{
				$photoPath = '/countries/country-'.$country->Id.'/'.$country->Photo->Path;
			}

		@endphp
		<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/country/{{ $country->Id }}/regions">
		    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		    	<div style="background: url({{ URL::to('/images') . $photoPath }});background-size: cover;" class="col-md-12 block-content" >
					<span>{{ $country->Name }}	</span>
				</div>
		    </div>
		</a>
    @endforeach
    </div>
</div>
@endsection

   