	
		@extends('layout/baseLayout')

		@section('title', 'Regions')

		@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>COUNTRIES</h3>
				<hr>
				<div class="row">
					<br/>
					<div class="col-md-12">
						 @foreach($model as $country)
					    <a href="{{ URL::to('/') }}/country/{{ $country->Id }}/regions">{{ $country->Name }}</a>
					    <hr/>
					    @endforeach
					</div>
				</div>
			</div>
		</div>
		@endsection

   