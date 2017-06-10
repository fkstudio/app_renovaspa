@extends('layout/baseLayout')

@section('title', 'Book your spa treatment in the best destinations')

@section('content')
	<div class="container-fluid-full">
		<ul class="bxslider">
		  <li>
		  	<div style="background:url({{ URL::to('/') }}/images/carousel/facial_treatment.jpg);background-size: cover;background-position:center;height: 100%;" >
		  		<h3 class="custom-caption">
		  			<a style="color: white;" href="{{ URL::to('/') }}/services">
		  				RELAX MODE: <span style="color:#5fc7ae;">ON</span>
		  			</a>
		  		</h3>
		  	</div>
		  </li>
		  <li>
		  	<div style="background:url({{ URL::to('/') }}/images/carousel/body_treatment.jpg);background-size: cover;background-position:center;height: 100%;" >
		  		<h3 class="custom-caption" style="font-weight: 200;">
		  			<a  style="color: white;"href="{{ URL::to('/') }}/certificates">ONLINE BOOKING RECEIVES 10% DISCOUNT</a>
		  		</h3>
		  	</div>
		  </li>
		  <li>
		  	<div style="background:url({{ URL::to('/') }}/images/carousel/wedding_treatment.jpg);background-size: cover;background-position:center;height: 100%;" >
		  		<h3 class="custom-caption">
		  			<a  style="color: white;"href="{{ URL::to('/') }}/weddings">
		  				THE DAY
		  			</a>
		  		</h3>
		  	</div>
		  </li>
		</ul>
	</div>
@endsection

@section('scripts')
<!-- Moment JS-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!-- bxSlider CSS file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.9/jquery.bxslider.min.css" rel="stylesheet" />

<!-- bxSlider Javascript file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.9/jquery.bxslider.min.js"></script>
<script>
	function adjustSize(){
		var height = $(window).height();  //getting windows height
		var width = $(window).width();
		$('.bxslider li').css('height',height+'px');   //and setting height of 
		$('.bxslider li div').css('width',width+'px');
		$('.custom-caption').css("margin-top", ( ( height / 2 ) - 40 ) + 'px');
	}

	adjustSize();

	$(document).ready(function(){
		$('.bxslider').bxSlider({
		  auto: true,
		  mode: 'fade',
		  speed: 700,
		  captions: true,
		  easing : [ 'linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)' ]
		});

		

		$(window).resize(function(){
			adjustSize();
		})
	});
</script>
@endsection