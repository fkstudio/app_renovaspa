@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', 'Wedding services')

@section("content")
<div id="vue-app" class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<h3 class="green-title">RESERVATION FORM FOR WEDDINGS</h3>
	<br/>
	<p><strong>Important:</strong> You will be contacted through e-mail by the online wedding concierge , please make sure Provide the e-mail address that you frequently use</p>
	<form action="{{ URL::to('/') }}/wedding/send/quotation" method="POST">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
					<div class="col-md-12">
						<h3>Personal information</h3>
						<div class="clearfix"></div>
						<hr />
						@include('shared._messages')
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="first_name" value="{{ $model->CertificateFirstName }}" class="form-control input-border" placeholder="* First name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="last_name" value="{{ $model->CertificateLastName }}" class="form-control input-border" placeholder="* Last name">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="email" value="{{ $model->Email }}" class="form-control input-border" placeholder="* Email">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="email_confirmation" class="form-control input-border" placeholder="* Email confirmation">
						</div>
					</div>
					<div class="col-md-12">
						<h3>Couple information</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="bride_full_name" class="form-control input-border" value="{{ $model->BrideName }}" placeholder="* Bride full name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="groom_full_name" class="form-control input-border" value="{{ $model->GroomName }}" placeholder="* Groom full name">
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
						<input type="text" name="wedding_date" class="datepicker form-control input-border" />
						<br/>
						<label>(*) Wedding Time</label>
						<br/>
						<input type="text" value="{{ ( $model->WeddingTime != null ? $model->WeddingTime->format('h:m a') : '' ) }}" name="wedding_time" class="timepicker form-control input-border" />
					</div>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div>
		<h3 class="green-title">QUOTATION</h3>
		<br/>
		<h3>Services's information</h3>
		<hr/>
		<div class="row">
			@foreach($cart->Items as $item)
				@php
					$packageRelation = $item->PackageCategoryRelation;
				@endphp
				@foreach($packageRelation->WeddingPackage->WeddingPackageServices as $packageService)
					<div class="col-md-12">
						<h5>1 {{ ( $packageRelation != null ? $packageRelation->WeddingPackage->Name . ' - ' : '').$packageService->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $packageService->Service->Cabin->Name }} )</h5>
						<span>{{ trans('checkout.booked_to') }} {{ $item->PreferedDate->format('d/m/Y') }} {{ trans('checkout.at_time') }} {{ $item->PreferedTime->format('h:m a') }}, {{ $item->CustomerName }}</span>
					</div>
					<div class="clearfix"></div>
					<hr/>
				@endforeach
			@endforeach
		</div>
		<h3>CART TOTAL</h3>
		<table style="font-size: 20px;" class="table table-borderless">
			@php
				$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => session('hotel_id'), 'Region' => session('region_id') ]);
			@endphp
			<tbody>
				<tr>
					<td>Subtotal</td>
					<td><span class="pull-right">{{ $model->Region->Country->Currency->Symbol }}{{ $model->Subtotal }}</span></td>
				</tr>
				@if ($hotel_region->ActiveDiscount)
				<tr>
					<td>
					<span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
				</tr>
				@endif
				<tr>
					<td><strong>Total</strong></td>
					<td><strong class="pull-right">{{ $model->Region->Country->Currency->Symbol }}{{ $model->Total }}</strong></td>
				</tr>
			</tbody>
		</table>
		<hr>
		<p style="color: red;"><strong>50% down payment will be required by the wedding concierge in order to confirm this reservation once this request has been checked out and approved within the next 24 hours For any questions, please, contact: info@renovaspa.com</strong></p>
		<hr/>
		<h3>Payment Information</h3>
		<hr>
		<p>How would you like to receive the bill for the requested service?</p>
		<div class="col-md-7">
			<div class="row">
				<select name="bill_delivery" class="form-control custom-select">
					<option value="1">-- Select an option --</option>
					<option value="2">Send one bill including all the services.</option>
					<option value="3">Send one bill including the wedding couples services and other for each person of the wedding party</option>
					<option value="4">Send separate bills for each person.</option>
				</select>
				<label>Remarks</label>
				<br>
				<p>If you need to make additional requests please use this space.</p>
				<textarea name="remarks" rows="10" resizable='false' class="form-control input-border">{{ $model->Remarks }}</textarea>
				<hr>
				{{ csrf_field() }}
				<button type="submit" class="btn btn-primary">SEND RESERVATION FORM</button>
				<button type="button" class="btn btn-danger">CANCEL</button>
			</div>
			
		</div>
	</form>	
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