@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
	<div class="container-fluid-full">
		<ul class="bxslider">
		  <li><img title="RELAX MODE" src="{{ URL::to('/') }}/images/carousel/facial_treatment.jpg" /></li>
		  <li><img src="{{ URL::to('/') }}/images/carousel/body_treatment.jpg" /></li>
		  <li><img src="{{ URL::to('/') }}/images/carousel/wedding_treatment.jpg" /></li>
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
		$('.bx-viewport').css('height',height+'px');   //and setting height of 
	}

	$(document).ready(function(){
		$('.bxslider').bxSlider({
		  auto: true,
		  mode: 'fade',
		  speed: 700,
		  captions: true,
		  easing : [ 'linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)' ]
		});

		adjustSize();

		$(window).resize(function(){
			console.log('w');
			adjustSize();
		})
	});
</script>
@endsection