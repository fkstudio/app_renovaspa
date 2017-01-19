@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		
	
	@foreach($model as $country)
		<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/country/{{ $country->Id }}/regions">
		    <div class="col-md-3">
		    	<div style="background: url({{ URL::to('/images') }}/countries/country-{{ $country->Id  }}/{{ $country->Photo->Path }});background-size: cover;" class="col-md-12 block-content" >
					<span>{{ $country->Name }}	</span>
				</div>
		    </div>
		</a>
		@break
    @endforeach
    </div>
</div>
@endsection

   