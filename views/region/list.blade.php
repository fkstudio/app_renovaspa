	@extends('layout/baseLayout')

	@section('title', 'Regions')

	@section("content")
	<div class="container-fluid">
		<div class="container">
			<h3>{{ $country->Name }} - REGIONS</h3>
			<hr>
			<div class="row">
				<br/>
				<div class="col-md-12">
					@foreach($model as $region)
				    <a href="{{ URL::to('/') }}/region/{{ $region->Id }}/hotels">{{ $region->Name }}</a>
				    <hr/>
				    @endforeach
				</div>
			</div>
		</div>
	</div>
	@endsection