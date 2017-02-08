@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
	<div class="container">
		@include('shared._messages')
	</div>
	<div class="container-fluid container-fluid-full" style="margin-bottom: -20px;">
		<div class="row">
			<div id="home-carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#home-carousel" data-slide-to="1"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner"role="listbox">
					<div class="item active">
						<img src="{{ URL::to('/') }}/images/carousel/facial_treatment.jpg" alt="Flower">
						<div class="carousel-caption" style="margin-bottom: 370px;">
				        <h3 style="font-size: 60px;text-shadow: none;">RELAX MODE: <span style="color:#00CCCC;">ON</span></h3>
				      </div>
					</div>

					<div class="item" style="height: 700px;">
						<img src="{{ URL::to('/') }}/images/carousel/body_treatment.jpg" alt="Flower" />
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
	</div>
	<?php /*
	<div class="container-fluid container-fluid-full" id="home-search-content">
		<div class="container">
			<div class="row">
				<form class="">
					<div class="col-md-2">
						<p>DESTINATIONS & TREATMENTS</p>
					</div>
					<div class="col-md-2">
						<input type="text" id="daterange" class="form-control" />
					</div>
					<div class="col-md-2">
						<input type="text" id="country" placeholder="Type a country" class="form-control" />
					</div>
					<div class="col-md-2">
						<input type="text" id="region" placeholder="Select a country" class="form-control" />
					</div>
					<div class="col-md-2">
						<input type="text" id="hotel" placeholder="Select a region" class="form-control" />
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary">CONFIRM</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br/>
	<div class="container">
		<div class="row" style="text-align: right;">
		    <div class="col-md-6 col-sm-6">
				<h3>GUEST BOOK</h3>
				<br/>
				<p>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda</p>
				<br/>
				<a class="btn btn-default visible-md" href="#fakelink">see more</a>
				<a class="btn btn-default hidden-md" href="#fakelink">see more</a>
				<div class="clearfix visible-xs"></div>
				<br class="visible-xs" />
			</div>
			<div class="col-md-6 col-sm-6">
				<br class="visible-sm" />
		    	<img style="width: 500px;" src="{{ URL::to('/') }}/images/guest-book.jpg" class="img-responsive" alt="guest book" />
		    </div>
		</div>
		<div class="clearfix"></div>
		<br/>
		<hr/>
		<br/>
		<div class="clearfix"></div>
		<div class="row">
		    <div class="col-md-6 col-sm-6">
		    	<br class="visible-sm" />
		    	<img style="width: 500px;" src="{{ URL::to('/') }}/images/wedding.jpg" class="img-responsive" alt="guest book" />
		    </div>
		    <div class="col-md-6 col-sm-6">
				<h3>CUSTOM WEDDING PACKAGES</h3>
				<br/>
				<p>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda</p>
				<br/>
				<a class="btn btn-default visible-md" href="#fakelink">see more</a>
				<a class="btn btn-default hidden-md" href="#fakelink">see more</a>
			</div>
		</div>
		<br class="visible-xs" />
	</div>
	*/
	 ?>
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
	$( function() {
		var availableCountries = [
			"ARUBA",
			"BAHAMAS"
		];

		$( "#country" ).autocomplete({
			source: availableCountries
		});

		// date range
		$('input[id="daterange"]').daterangepicker();
	});
</script>
@endsection