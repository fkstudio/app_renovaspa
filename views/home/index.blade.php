@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
	<div class="container-fluid-full" >
		<div id="home-carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home-carousel" data-slide-to="1"></li>
				<li data-target="#home-carousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner"role="listbox">
				<div class="item active">
					<img src="{{ URL::to('/') }}/images/carousel/facial_treatment.jpg" alt="Flower">
					<div class="carousel-caption" >
			        <a href="{{ URL::to('/') }}/services" style="margin: 0 auto;">
			        	<h3 style="color:white;font-size: 60px;text-shadow: none;">RELAX MODE: <span style="color:#00CCCC;">ON</span></h3>
			        </a>
			      </div>
				</div>

				<div class="item">
					<img src="{{ URL::to('/') }}/images/carousel/body_treatment.jpg" alt="Flower" />
					<div class="carousel-caption" >
						<a href="{{ URL::to('/') }}/certificates" style="margin: 0 auto;">
				        	<h3 style="color:white;font-size: 40px;text-shadow: none;">ONLINE BOOKING RECEIVES 10% DISCOUNT</span></h3>
				        </a>
			        </div>
				</div>

				<div class="item">
					<img src="{{ URL::to('/') }}/images/carousel/wedding_treatment.jpg" alt="Flower" />
					<div class="carousel-caption" >
						<a href="{{ URL::to('/') }}/weddings" style="margin: 0 auto;">
				        	<h3 style="color:white;font-size: 60px;text-shadow: none;">THE DAY</span></h3>
				        </a>
			        </div>
				</div>

			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
@endsection

@section('scripts')
<!-- Moment JS-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!-- JQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	// $( function() {
	// 	var availableCountries = [
	// 		"ARUBA",
	// 		"BAHAMAS"
	// 	];

	// 	$( "#country" ).autocomplete({
	// 		source: availableCountries
	// 	});

	// 	// date range
	// 	$('input[id="daterange"]').daterangepicker();
	// });
</script>
@endsection