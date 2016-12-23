	
		@extends('layout/baseLayout')

		@section('title', 'Regions')

		@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>COUNTRIES</h3>
				<hr>
				@foreach($model as $country)
				    <div class="col-md-3" style="padding: 100px;
												 text-align: center;
												 background: url('{{ URL::to('/images') }}/countries/country-{{ $country->Id  }}/{{ $country->Photo->Path }}');
												 background-size: cover;"
				>
						<a style="color:white;
								  font-size: 20px;
								  font-weight: bold;" href="{{ URL::to('/') }}/country/{{ $country->Id }}/regions">{{ $country->Name }}</a>	
					</div>
					@break
			    @endforeach
			</div>
		</div>
		@endsection

   