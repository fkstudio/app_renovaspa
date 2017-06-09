@extends('layout/baseLayout')

@section('title', 'Voucher')

@section("content")
	@include('payment._certificate_voucher')
	<br/>
	<div style="text-align: center;">
		<p>Follow us</p>
		<a target="_blank" href="https://www.facebook.com/RenovaSpa/"><i style="padding-left: 17px;padding-right: 17px" class="social-icon fa fa-facebook"></i></a>
        <a target="_blank" href="https://twitter.com/renovaspas"><i class="social-icon fa fa-twitter"></i></a>
        <a target="_blank" href="https://www.instagram.com/renova.spa/"><i class="social-icon fa fa-instagram"></i></a>
        <a target="_blank" href="https://es.pinterest.com/renovaspa/"><i class="social-icon fa fa-pinterest"></i></a>
	</div>
	<div class="clearfix"></div>
	<br/>
	<p class="text-center"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
@endsection
