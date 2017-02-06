@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', 'Wedding services')

@section("content")
<div id="vue-app" class="container-fluid">
	<h3 class="green-title">RESERVATION FORM FOR WEDDINGS</h3>
	<br/>
	<p><strong>Important:</strong> You will be contacted through e-mail by the online wedding concierge , please make sure Provide the e-mail address that you frequently use</p>
	<div class="col-md-12">
		<div class="row">
			<form action="" method="POST">
				<div class="row">
					<div class="col-md-12">
						<h3>Personal information</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="customer_first_name" value="{{ $model->CertificateFirstName }}" class="form-control input-border" placeholder="* First name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="customer_last_name" value="{{ $model->CertificateLastName }}" class="form-control input-border" placeholder="* Last name">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="customer_email" value="{{ $model->CertificateEmail }}" class="form-control input-border" placeholder="* Email">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="customer_email_confirmation" class="form-control input-border" placeholder="* Email confirmation">
						</div>
					</div>
					<div class="col-md-12">
						<h3>Couple information</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="customer_first_name" class="form-control input-border" placeholder="* Bride/Groom full name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="customer_last_name" class="form-control input-border" placeholder="* Bride/Groom full name">
						</div>
					</div>

					<div class="col-md-12">
						<h3>Reservation information</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					<div class="clearfix"></div>
					<div class="col-md-2">
						<label>Coutry</label>
						<br/>
						<span>{{ $model->Region->Country->Name }}</span>
					</div>
					<div class="col-md-2">
						<label>Destination</label>
						<br/>
						<span>{{ $model->Region->Name }}</span>
					</div>
					<div class="col-md-2">
						<label>Hotel</label>
						<br/>
						<span>{{ $model->Hotel->Name }}</span>
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-3">
						<label>(*) Wedding Date</label>
						<br/>
						<p>We only take reservations within 6 months prior to the wedding date and not before.</p>
						<input type="text" name="" class="datepicker form-control input-border" />
						<br/>
						<label>(*) Wedding Time</label>
						<br/>
						<input type="text" name="" class="timepicker form-control input-border" />
					</div>
				</div>
			</form>	
		</div>
	</div>
	<div class="clearfix"></div>
	<h3 class="green-title">QUOTATION</h3>
	<br/>
	<div class="row">
		@foreach($cart->Items as $item)
		<div class="col-md-12">
			<h5>1 {{ ( $item->Package != null ? $item->Package->Name . ' - ' : '').$item->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $item->Cabin->Name }} )</h5>
			<span>{{ trans('checkout.booked_to') }} {{ $item->PreferedDate->format('d/m/Y') }} {{ trans('checkout.at_time') }} {{ $item->PreferedTime->format('h:m a') }}, {{ $item->CustomerName }}</span>
		</div>
		<div class="clearfix"></div>
		<hr/>
		@endforeach
	</div>
</div>
@endsection

@section('scripts')
<!-- Moment JS-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


<!-- Timepicker -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/jquery.timepicker.css">
<script type="text/javascript" src="{{ URL::to('/') }}/js/jquery.timepicker.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script>
	$(function() {
	    $('.datepicker').daterangepicker({
	        minDate: moment().add(2, "days"),
	        singleDatePicker: true,
	        showDropdowns: true,
	        
		});

		$('.timepicker').timepicker();
	});
</script>
@endsection
