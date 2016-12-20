		@extends('layout/baseLayout')

		@section('title', 'Hotels')

		@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>{{ $region->Country->Name }} - {{ $region->Name }} - HOTELS</h3>
				<hr>
				<div class="row">
					<br/>
					<div class="col-md-12">
						@foreach($model as $hotelRegion)
					    <a href="{{ URL::to('/') }}/hotel/{{ $hotelRegion->Hotel->Id }}/categories">{{ $hotelRegion->Hotel->Name }}</a>
					    <hr/>
					    @endforeach
					</div>
				</div>
			</div>
		</div>
		@endsection

    