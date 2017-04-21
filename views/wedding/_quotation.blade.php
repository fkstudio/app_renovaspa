@inject("dbcontext", "App\Database\DbContext")
@php
	$subtotal = 0;
	$total = 0;

	$hotel_id = $model->Hotel->Id;
	$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => $hotel_id, 'Region' => $model->Region->Id ]);
@endphp
<!-- App -->
<link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">

<!-- Bootstrap -->
<link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">
<div id="vue-app" class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<h3 class="green-title">ONLINE RESERVATIONS - WEDDING GROUPS</h3>
	<br/>
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
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label>First name</label>
						<br/>
						{{ $model->CertificateFirstName }}
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label>Last name</label>
						<br/>
						{{ $model->CertificateLastName }}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-3 col-sm-12">
					<div class="form-group">
						<label>E-mail</label>
						<br/>
						{{ $model->Email }}
					</div>
				</div>
				<div class="clearfix visible-sm"></div>
				<div class="col-md-3">
					<div class="form-group">
					</div>
				</div>
				<div class="col-md-12">
					<h3>Couple information</h3>
					<div class="clearfix"></div>
					<hr />
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label>Bride</label>
						<br/>
						{{ $model->BrideName }}
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label>Groom</label>
						<br/>
						{{ $model->GroomName }}
					</div>
				</div>
				<div class="clearfix visible-sm"></div>
				<div class="col-md-12">
					<h3>Reservation information</h3>
					<div class="clearfix"></div>
					<hr />
				</div>
				<div class="clearfix"></div>
				<div class="col-md-2 col-sm-4">
					<label>Coutry</label>
					<br/>
					<span>{{ $model->Region->Country->Name }}</span>
				</div>
				<div class="col-md-2 col-sm-4">
					<label>Destination</label>
					<br/>
					<span>{{ $model->Region->Name }}</span>
				</div>
				<div class="col-md-2 col-sm-4">
					<label>Hotel</label>
					<br/>
					<span>{{ $model->Hotel->Name }}</span>
				</div>
				<div class="clearfix"></div>
				<br/>
				<br/>
				<div class="col-md-2 col-sm-4">
					<label>Wedding Date</label>
					<br/>
					{{ $model->WeddingDate->format('d/m/Y') }}
					<br/>
				</div>
				<div class="col-md-2 col-sm-4">
					<label>Wedding Time</label>
					<br/>
					{{ ( $model->WeddingTime != null ? $model->WeddingTime->format('h:m a') : '' ) }}
				</div>
				<div class="clearfix visible-sm"></div>
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
			@if($item->Service != null)
				@php
					$subtotal += $item->Service->getPlanePrice($model->Hotel->Id);
					$total += $item->Service->getPrice($model->Hotel->Id);
				@endphp
				<div class="col-md-12">
					<h5>1 {{ $item->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )</h5>
					<span>{{ trans('checkout.booked_to') }} {{ $item->PreferedDate->format('d/m/Y') }} {{ trans('checkout.at_time') }} {{ $item->PreferedTime->format('h:m a') }}, {{ $item->CustomerName }}</span>
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
					<br/>
					<span>{{ trans('shared.final_price') }}: <strong>{{ $model->Region->Country->Currency->Symbol.number_format($item->Service->getPrice($hotel_id), 2) }}</strong></span>
				</div>
				<div class="clearfix"></div>
				<hr/>
			@else
				@php
					$weddingPackage = $packageRelation->WeddingPackage;
					
					$subtotal += $packageRelation->getPlanePrice();
					$total += $packageRelation->getPrice();
				@endphp
				<div class="col-md-12">
					<h5>{{ $weddingPackage->Name }}</h5>
					<ul style="list-style: none;">
						@foreach($weddingPackage->WeddingPackageFeatures as $feature)
						<li>{{ $feature->Description }}</li>
						@endforeach	
						@foreach($packageRelation->WeddingPackage->WeddingPackageServices as $packageService)
							<li>
								<div class="col-md-12">
									<h5>1  {{ $packageService->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $packageService->Service->Cabin->Name }} )</h5>
									<span>{{ trans('checkout.booked_to') }} {{ $item->PreferedDate->format('d/m/Y') }} {{ trans('checkout.at_time') }} {{ $item->PreferedTime->format('h:m a') }}, {{ $item->CustomerName }}</span>
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
	<hr>
	<p style="color: red;"><strong>50% down payment will be required by the wedding concierge in order to confirm this reservation once this request has been checked out and approved within the next 24 hours For any questions, please, contact: info@renovaspa.com</strong></p>
	<hr/>
	<h3>Payment Information</h3>
	<hr>
	<div class="col-md-7">
		<div class="row">
			@php
				$delivery = $model->WeddingBillDelivery;
			@endphp

			@if($delivery == 2)
			<p>Send one bill including all the services.</p>
			@elseif ($delivery == 3)
			<p>Send one bill including the wedding couples services and other for each person of the wedding party</p>
			@else 
			<p>Send separate bills for each person.</p>
			@endif
			<label>Remarks</label>
			<br>
			<p>{{ $model->Remarks }}</p>
			<hr>
		</div>
	</div>
</div>