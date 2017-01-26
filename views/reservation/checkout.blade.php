	@extends('layout/baseLayout')

	@section('title', 'Services')

	@inject("dbcontext", "App\Database\DbContext")


	@php
		$country = $dbcontext->getEntityManager()->getRepository('App\Models\Test\CountryModel')->findOneBy(['Id' => session('country_id')]);
		$hotel_region = $dbcontext->getEntityManager()->getRepository('App\Models\Test\HotelRegionModel')->findOneBy(['Hotel' => session('hotel_id'), 'Region' => session('region_id')]);
	@endphp

	@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr style="margin-bottom: 0px !important;">
		<div class="row">
			<form action="{{ URL::to('/') }}/payment" method="POST">
				<div class="col-md-6">
					<h3>PAYMENT INFORMATION</h3>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="first_name" class="form-control input-border" placeholder="First name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="last_name" class="form-control input-border" placeholder="Last name">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" name="email" class="form-control input-border" placeholder="Email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="Country" class="form-control input-border" placeholder="Country">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="PostCode" class="form-control input-border" placeholder="Postcode/Zip">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="number" name="Phone" class="form-control input-border" placeholder="Phone number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="CompanyName" class="form-control input-border" placeholder="Company name">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="StreetAddress" class="form-control input-border" placeholder="StreetAddress">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="Apartment" class="form-control input-border" placeholder="Apartment, suit, unit, etc (optional)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="City" class="form-control input-border" placeholder="Town/City">
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-md-6">
					<h3>ORDER SUMMARY</h3>
					<hr>
					@php
						$hotel_id = $hotel_region->Hotel->Id;
					@endphp
					@if ($model->Type == 1)
						@foreach($model->ServicesDetails as $detail)
						<div class="col-md-12">
							<div class="row">
								<h5><strong>1 {{ $detail->Service->Name }}</strong></h5>
								@if ($detail->Service->hasDiscount($hotel_id))
									@php
										$discount = $detail->Service->getDiscount($hotel_id)
									@endphp
									<span class="discount">{{ "-".$discount. "% discount" }}</span>
									@endif

									@if ($detail->Service->hasHotelDiscount($hotel_id))
									<span class="discount">-{{ $hotel_region->Discount }}% online discount</span>
									@elseif ($hotel_region->ActiveDiscount)
									<span class="discount-tached">-{{ $hotel_region->Discount }}% online discount</span>
								@endif
								<br/>
								<span>Booked to {{ $detail->PreferedDate->format('d/m/Y') }} at time {{ $detail->PreferedTime->format('h:m a') }}, {{ $detail->CustomerName }}</span>
								<br/>
								<span>Price: {{ $country->Currency->Symbol.number_format($detail->Service->getPlanePrice($hotel_id), 2) }}</span>
								<br/>
								<span>Final price: <strong>{{ $country->Currency->Symbol.number_format($detail->Service->getPrice($hotel_id), 2) }}</strong></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr style="border-color:#5fc7ae;" />
						@endforeach
					@elseif($model->Type == 2)
						@foreach($model->CertificateDetails as $key => $detail)
						<div class="col-md-2">
							<span class="glyphicon glyphicon-gift gift-icon"></span>
						</div>
						<div class="col-md-10">
							<div class="row">
								<h5 style="color:#5fc7ae;"><strong>Gift certificate #{{ $key + 1 }}</strong></h5>
								@if($detail->Type == 2)
								<span>(Value based)</span>
								<br/>
								@endif
								<span>From {{ $detail->FromCustomerName }} to {{ $detail->ToCustomerName }}</span>
								@if($detail->Type == 1)
									{{ count($detail->CertificateDetailServices) }}
									<ul style="list-style: none;margin-bottom: 0px;">
										@foreach($detail->CertificateDetailServices as $certificateDetailService)
										<li>- {{ $certificateDetailService->Service->Name }}</li>
										@endforeach
									</ul>
								@else
								<br/>
								@endif
								<span>Message: {{ $detail->Message }}</span>
								<br/>
								<span>Value: <strong>{{ $country->Currency->Symbol.$detail->Value }}</strong></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr style="border-color:#5fc7ae;" />
						@endforeach
					@endif
					<table class="table table-borderless">
						<h3>CART TOTAL</h3>
						<tbody style="font-size: 20px;">
							<tr>
								<td>Subtotal</td>
								<td>{{ $country->Currency->Symbol }}{{ $model->Subtotal }}</td>
							</tr>
							@if ($hotel_region->ActiveDiscount)
							<tr>
								<td><span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% online discount available</span></td>
							</tr>
							@endif
							<tr>
								<td><strong>Total</strong></td>
								<td>{{ $country->Currency->Symbol }}{{ $model->Total }}</td>
							</tr>
						</tbody>
					</table>
					<div class="col-md-6">
						<input type="radio" name="payment_method" value="{{ $paymentMethods[0]->Id }}" /> {{ $paymentMethods[0]->Name }}
						<img style="width: 100px; float:right; margin-top: -5px" class="img-responsive" src="{{ URL::to('/') }}/images/visamastercard.png" />
					</div>
					<div class="col-md-6">
						<input type="radio" name="payment_method" value="{{ $paymentMethods[1]->Id }}" /> {{ $paymentMethods[1]->Name }}
						<img style="width: 100px; float:right; margin-top: -15px" class="img-responsive" src="{{ URL::to('/') }}/images/paypal.png" />
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-12">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-block">PLACE ORDER</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection
    