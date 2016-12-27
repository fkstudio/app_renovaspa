@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
	<div class="container-fluid">
		<div class="container">
			<div class="col-md-12" style="text-align:center;">
				<a href="{{ URL::to('/') }}/select/services">Servicios</a><br/>
			</div>
		</div>
		<div class="container">
			<div class="col-md-12" style="text-align:center;">
				<a href="{{ URL::to('/') }}/select/certificates">Gift certificates</a><br/>
			</div>
		</div>
		<div class="container">
			<div class="col-md-12" style="text-align:center;">
				<a href="{{ URL::to('/') }}/select/weddings">Weddings</a><br/>
			</div>
		</div>
	</div>
@endsection