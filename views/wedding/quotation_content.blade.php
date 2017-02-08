	@extends('layout/baseLayout')

	@section('title', 'Voucher')

	@section("content")
		@include('wedding._quotation');
		<div class="clearfix"></div>
		<p class="text-center"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
	@endsection
