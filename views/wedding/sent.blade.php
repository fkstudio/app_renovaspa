@extends('layout/baseLayout')

@section('title', 'The wedding quotation has been sent')

@section("content")
	<div class="container-fluid-full" style="background: url({{ URL::to('/images') }}/certificate_cover.jpg);
										 background-size: cover;
										 background-position: center center;
										 height: 220px;">
	</div>
	<br/>
	<div class="container-fluid">
		<div class="container">
			<div class="col-md-12">
				<p style="font-size: 18px;">
				our reservation request has been successfully sent to our Wedding Concierge, who will be happy to work on the schedule and contact you back within the next 24 hours for your final approval (Saturdays after midday within 48 hrs.) These are the reservation you have sent
				</p>
			</div>
		</div>
		<br/>
		<div style="clear: both;"></div>
    	<p style="text-align: center;"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
	</div>
@endsection


	