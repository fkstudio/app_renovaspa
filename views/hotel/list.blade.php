		@extends('layout/baseLayout')

		@section('title', 'Hotels')

		@section("content")
		<div class="container-fluid">
				@include('shared._breadcrumps')
				<hr>
				<div class="row">
					<br/>
					<div class="col-md-12">
						@foreach($model as $hotelRegion)
					    @if ($reservationType == 1)
					    	<a href="{{ URL::to('/') }}/hotel/{{ $hotelRegion->Hotel->Id }}/categories">{{ $hotelRegion->Hotel->Name }}</a>
					    @elseif ($reservationType == 2)
					    	<a href="{{ URL::to('/')}}/certificate/options/{{ $hotelRegion->Hotel->Id }}">{{ $hotelRegion->Hotel->Name }}</a>
					    @endif
					    <hr/>
					    @endforeach
					</div>
				</div>
		</div>
		@endsection

    