@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', 'Wedding services')

@php
	$subtotal = 0;
	$total = 0;

	$hotel_id = session('hotel_id');
	$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => $hotel_id, 'Region' => session('region_id') ]);

	$quotation = session("quotation");
@endphp

@section("content")
<div id="vue-app" class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<h3 class="green-title">{{ trans('titles.wedding_reservation') }}</h3>
	<br/>
	<p><strong>{{ trans('wedding.important') }}:</strong> {{ trans('wedding.you_will_be_contacted') }}</p>
	<form action="{{ URL::to('/') }}/wedding/send/quotation" method="POST">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
					<div class="col-md-12">
						<h3>{{ trans('wedding.personal_info') }}</h3>
						<div class="clearfix"></div>
						<hr />
						@include('shared._messages')
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="first_name" value="{{ ($quotation != null ? $quotation['first_name'] : '') }}" class="form-control input-border" placeholder="* First name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="last_name" value="{{ ($quotation != null ? $quotation['last_name'] : '') }}" class="form-control input-border" placeholder="* Last name">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="email" value="{{ ($quotation != null ? $quotation['email'] : '') }}" class="form-control input-border" placeholder="* Email">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="email" required name="email_confirmation" class="form-control input-border" placeholder="* Email confirmation">
						</div>
					</div>
					<div class="col-md-12">
						<h3>{{ trans('wedding.couple_info') }}</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="bride_full_name" class="form-control input-border" value="{{ ($quotation != null ? $quotation['bride_name'] : '') }}" placeholder="* Couple member 1">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" required name="groom_full_name" class="form-control input-border" value="{{ ($quotation != null ? $quotation['groom_name'] : '') }}" placeholder="* Couple member 2">
						</div>
					</div>

					<div class="col-md-12">
						<h3>{{ trans('wedding.reservation_info') }}</h3>
						<div class="clearfix"></div>
						<hr />
					</div>
					<div class="clearfix"></div>
					<div class="col-md-2">
						<label>{{ trans('shared.country') }}</label>
						<br/>
						<span>{{ $model->Region->Country->Name }}</span>
					</div>
					<div class="col-md-2">
						<label>{{ trans('shared.destination') }}</label>
						<br/>
						<span>{{ $model->Region->Name }}</span>
					</div>
					<div class="col-md-2">
						<label>{{ trans('shared.hotel') }}</label>
						<br/>
						<span>{{ $model->Hotel->Name }}</span>
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-2">
						<label>{{ trans('shared.arrival') }}</label>
						<br/>
						<span>{{ $model->Arrival->format('F j, Y') }}</span>
					</div>
					<div class="col-md-2">
						<label>{{ trans('shared.departure') }}</label>
						<br/>
						<span>{{ $model->Departure->format('F j, Y') }}</span>
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-3">
						<label>(*) {{ trans('wedding.wedding_date') }}</label>
						<br/>
						<input type="text" value="{{ ($quotation != null ? $quotation['wedding_date'] : '') }}" name="wedding_date" required class="datepicker form-control input-border" />
						<br/>
						<label>(*) {{ trans('wedding.wedding_time') }}</label>
						<br/>
						<input type="text" value="{{ ($quotation != null ? $quotation['wedding_time'] : '') }}" name="wedding_time" required class="timepicker form-control input-border" />
					</div>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div>
		<h3 class="green-title">{{ trans('wedding.quotation') }}</h3>
		<br/>
		<h3>{{ trans('wedding.service_info') }}</h3>
		<hr/>
		<div class="row">
			@foreach($cart->Items as $item)
				@php
					$packageRelation = $item->PackageCategoryRelation;
				@endphp
				@if($item->Service != null)
					@php
						$subtotal += $item->Service->getPlanePrice($model->Hotel->Id);
						$total += $item->Service->getPrice($model->Hotel->Id);
					@endphp
					<div class="col-md-12">
						<h5>{{ $item->Service->Name }}</h5>
						<span>{{ trans('checkout.booked_to') }} {{ ($item->PreferedDate != null ? $item->PreferedDate->format('F j, Y') : "Open date") }} {{ trans('checkout.at_time') }} {{ ($item->PreferedTime != null ? $item->PreferedTime->format('h:m a') : "Open time") }}, {{ $item->CustomerName }}</span>
						@if ($item->Service->hasDiscount($hotel_id))
							@php
								$discount = $item->Service->getDiscount($hotel_id)
							@endphp
							<br/>
							<span class="discount">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
							@endif

							@if ($item->Service->hasHotelDiscount($hotel_id))
							<br/>
							<span class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
							@elseif ($hotel_region->ActiveDiscount)
							<span class="discount-tached">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
						@endif
						<br/>
						<span>{{ trans('shared.price') }}: {{ $model->Region->Country->Currency->Symbol.number_format($item->Service->getPlanePrice($hotel_id), 2) }}</span>
						<?php /* <br/>
						<span>{{ trans('shared.final_price') }}: <strong>{{ $model->Region->Country->Currency->Symbol.number_format($item->Service->getPrice($hotel_id), 2) }}</strong></span> */ ?>
					</div>
					<div class="clearfix"></div>
					<hr/>
				@else
					@php
						$packages = session('packages');

						//print_r($packages);

						$weddingPackage = $packageRelation->WeddingPackage;

						if(array_key_exists($packageRelation->WeddingPackage->Id, $packages)){
							$data = $packages[$packageRelation->WeddingPackage->Id];
						}
						else {
							$data = null;
						}
						
						
						$subtotal += $packageRelation->getPlanePrice();
						$total += $packageRelation->getPrice();
					@endphp
					<div class="col-md-12">
						<h5>{{ $weddingPackage->Name }}</h5>
						@if($packageRelation->ActiveDiscount)
							@php
								$discount = $packageRelation->Discount;

							@endphp
							<span class="discount">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
						@endif
						<br/>
						<span>{{ trans('shared.price') }}: {{ $model->Region->Country->Currency->Symbol.number_format($packageRelation->getPlanePrice(), 2) }}</span>
						<?php /* <br/>
						<span>{{ trans('shared.final_price') }}: <strong>{{ $model->Region->Country->Currency->Symbol.number_format($packageRelation->getPrice(), 2) }}</strong></span> */ ?>
						<ul style="list-style: none;">
							@foreach($weddingPackage->WeddingPackageFeatures as $feature)
							<li>{{ $feature->Description }}</li>
							@endforeach	
							@foreach($packageRelation->WeddingPackage->WeddingPackageServices as $key => $packageService)
								<li>
									<div class="col-md-12">
										<h5>1  {{ $packageService->Service->Name }} - {{ trans("shared.cabin_type") }}</h5>
										<span>{{ trans('checkout.booked_to') }} {{ ($data != null && $data[$key]['prefered_date'] != null ? $data[$key]['prefered_date']->format('F j, Y') : "Open date") }} {{ trans('checkout.at_time') }} {{ ($data != null && $data[$key]['prefered_time'] != null ? $data[$key]['prefered_time']->format('h:m a') : "Open time") }}, {{ $data[$key]['customer_name'] }}</span>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="clearfix"></div>
					<hr/>
				@endif
			@endforeach
		</div>
		<h3>CART TOTAL</h3>
		<table style="font-size: 20px;" class="table table-borderless">
			<tbody>
				<tr>
					<td>Subtotal</td>
					<td><span class="pull-right">{{ $model->Region->Country->Currency->Symbol }}{{ $subtotal }}</span></td>
				</tr>
				@if ($hotel_region->ActiveDiscount)
				<tr>
					<td>
					<span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
				</tr>
				@endif
				<tr>
					<td><strong>Total</strong></td>
					<td><strong class="pull-right">{{ $model->Region->Country->Currency->Symbol }}{{ $total }}</strong></td>
				</tr>
			</tbody>
		</table>
		<hr/>
		<button style="background: none;
border: none;
color: rgb(64, 90, 139);" formnovalidate type="submit" name="save_quotation" href="{{ URL::to('/') }}/hotel/{{ $hotel_region->Hotel->Id }}/categories">{{ trans('messages.would_you_like') }}</button>
		<hr/>
		<p style="color: red;"><strong>50% down payment will be required by the wedding concierge in order to confirm this reservation once this request has been checked out and approved within the next 24 hours For any questions, please, contact: info@renovaspa.com</strong></p>
		<hr/>
		<h3>{{ trans('wedding.payment_info') }}</h3>
		<hr>
		<p>{{ trans('wedding.would_you_like') }}</p>
		<div class="col-md-7">
			<div class="row">
				<select name="bill_delivery" required class="form-control custom-select">
					<option value="1">-- Select an option --</option>
					<option value="2">Send one bill including all the services.</option>
					<option value="3">Send one bill including the wedding couples services and other for each person of the wedding party</option>
					<option value="4">Send separate bills for each person.</option>
				</select>
				<label>Remarks</label>
				<br>
				<p>{{ trans('wedding.aditional_request') }}</p>
				<textarea name="remarks" rows="10" resizable='false' class="form-control input-border">{{ $model->Remarks }}</textarea>
				<hr>
				{{ csrf_field() }}
				<button type="submit" class="btn btn-primary">{{ trans('wedding.send_reservation_form') }}</button>
				<a href="{{ URL::to('/') }}/reservation/canceled" class="btn btn-danger">{{ trans('wedding.cancel') }}</a>
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
	        autoUpdateInput: false
	        
		});

		$('.datepicker').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('MM/DD/YYYY'));
		});

		$('.timepicker').timepicker({
			interval: 60,
		    minTime: '08',
		    maxTime: '06pm',
		    defaultTime: '24',
		    startTime: '10:00'
		});
	});
</script>
@endsection
