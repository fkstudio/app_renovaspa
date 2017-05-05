	@extends('layout/baseLayout')

	@section('title', 'Services')

	@inject("dbcontext", "App\Database\DbContext")


	@php
		$country = $dbcontext->getEntityManager()->getRepository('App\Models\Test\CountryModel')->findOneBy(['Id' => session('country_id')]);
		$hotel_region = $dbcontext->getEntityManager()->getRepository('App\Models\Test\HotelRegionModel')->findOneBy(['Hotel' => session('hotel_id'), 'Region' => session('region_id')]);

		$reservationType = session('reservation_type');
	@endphp

	@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr style="margin-bottom: 0px !important;">
		@include('shared._messages')
		<div class="row">
			<form action="{{ URL::to('/') }}/payment" method="POST">
				<div class="col-md-6">
					@if ($model->Type == 2)
					<h3>{{ trans('titles.reservation_checkout_customer_title') }}</h3>
					<hr>
					<p>We will use this information to send purchase confirmations and certificates to your e-mail address. The billing information may be different.</p>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<input type="text" required name="customer_first_name" value="{{ $model->CertificateFirstName }}" class="form-control input-border" placeholder="* First name/Given name">
							</div>
						</div>
						<div class="col-md-2">
							<input type="text" name="customer_MI" value="{{ $model->CertificateMI }}" class="form-control input-border" placeholder="MI">
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<input type="text" required name="customer_last_name" value="{{ $model->CertificateLastName }}" class="form-control input-border" placeholder="* Last name/Surname">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="checkbox" name="not_my_info" /> {{ trans('checkout.not_my_info') }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="email" required name="customer_email" value="{{ $model->CertificateEmail }}" class="form-control input-border" placeholder="* Email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="email" required name="customer_email_confirmation" class="form-control input-border" placeholder="* Email confirmation">
							</div>
						</div>
					</div>
					@endif
					<h3>{{ trans('titles.reservation_checkout_left_title') }}</h3>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" value="{{ $model->PaymentInformation->FirstName }}" required name="first_name" class="form-control input-border" placeholder="* First name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" required value="{{ $model->PaymentInformation->LastName }}" name="last_name" class="form-control input-border" placeholder="* Last name">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" required value="{{ $model->PaymentInformation->CustomerEmail }}" name="email" class="form-control input-border" placeholder="* email">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" required name="country" value="{{ $model->PaymentInformation->CountryName }}" class="form-control input-border" placeholder="* country">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="city" value="{{ $model->PaymentInformation->TownCity }}" class="form-control input-border" placeholder="Town/City">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="post_code" value="{{ $model->PaymentInformation->PostCode }}" class="form-control input-border" placeholder="Postcode/Zip">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="number" name="phone_number" value="{{ $model->PaymentInformation->PhoneNumber }}" class="form-control input-border" placeholder="Phone number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="company_name" value="{{ $model->PaymentInformation->CompanyName }}" class="form-control input-border" placeholder="Company name">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="street_address" value="{{ $model->PaymentInformation->StreetAddress }}" class="form-control input-border" placeholder="StreetAddress">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="apartment_unit" value="{{ $model->PaymentInformation->ApartmentUnit }}" class="form-control input-border" placeholder="Apartment, suit, unit, etc (optional)">
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-6">
					<h3>{{ trans('titles.reservation_checkout_right_title') }}</h3>
					<hr>
					@php
						$hotel_id = $hotel_region->Hotel->Id;
					@endphp
					@if ($model->Type == 1)
						@foreach($model->ServicesDetails as $detail)
						<div class="col-md-12">
							<div class="row">
								<h5><strong>1 {{ $detail->Service->Name }}</strong> - {{ trans("shared.cabin_type") }} ( {{ $detail->Cabin->Name }} )</h5>
								@if ($detail->Service->hasDiscount($hotel_id))
									@php
										$discount = $detail->Service->getDiscount($hotel_id)
									@endphp
									<span class="discount">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
									@endif

									@if ($detail->Service->hasHotelDiscount($hotel_id))
									<span class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
									@elseif ($hotel_region->ActiveDiscount)
									<span class="discount-tached">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
								@endif
								<br/>
								<span>{{ trans('checkout.booked_to') }} {{ $detail->PreferedDate->format('d/m/Y') }} {{ trans('checkout.at_time') }} {{ $detail->PreferedTime->format('h:m a') }}, {{ $detail->CustomerName }}</span>
								<br/>
								<span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol.number_format($detail->Service->getPlanePrice($hotel_id), 2) }}</span>
								<br/>
								<span>{{ trans('shared.final_price') }}: <strong>{{ $country->Currency->Symbol.number_format($detail->Service->getPrice($hotel_id), 2) }}</strong></span>
								<br/>
								<a href="{{ URL::to('/') }}/reservation/service/delete/item/{{ $detail->Id }}">Remove</a>
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
								<br/>
								<span>Services:</span>
									<ul style="list-style: none;margin-bottom: 0px;">
										@foreach($detail->CertificateDetailServices as $certificateDetailService)
										<li>- {{ $certificateDetailService->Service->Name }}</li>
										@endforeach
									</ul>
								@else
								<br/>
								@endif
								<span>{{ trans('checkout.message') }}: {{ $detail->Message }}</span>
								<br/>
								<span>{{ trans('checkout.value') }}: <strong>{{ $country->Currency->Symbol.$detail->Value }}</strong></span>
								<br/>
								<a href="{{ URL::to('/') }}/reservation/certificate/delete/item/{{ $detail->Id }}/checkout">Remove</a>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr style="border-color:#5fc7ae;" />
						@endforeach
					@endif
					<table class="table table-borderless">
						<h3>{{ trans('titles.cart_total') }}</h3>
						<tbody style="font-size: 20px;">
							<tr>
								<td>Subtotal</td>
								<td>{{ $country->Currency->Symbol }}{{ number_format($model->getSubtotal(), 2) }}</td>
							</tr>
							@if ($hotel_region->ActiveDiscount)
							<tr>
								@if($model->Type == 1)
								<td><span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
								@else
								<td><span style="font-size: 15px;font-weight: bold;" class="discount">{{ $hotel_region->Discount }}% bonus</span></td>
								@endif
							</tr>
							@endif
							<tr>
								<td><strong>Total</strong></td>
								@if($model->Type == 2 && count($model->CertificateDetails) > 0 && $model->CertificateDetails[0]->Type == 2)
								<td>{{ $country->Currency->Symbol }}{{ number_format($model->getSubTotal(), 2) }}</td>
								@else
								<td>{{ $country->Currency->Symbol }}{{ number_format($model->getTotal(), 2) }}</td>
								@endif
							</tr>
						</tbody>
					</table>
					<div class="col-md-6">
						<input type="radio" name="payment_method" value="{{ $paymentMethods[0]->Id }}" /> {{ $paymentMethods[0]->Name }}
						<img style="width: 100px; float:right; margin-top: -15px" class="img-responsive" src="{{ URL::to('/') }}/images/paypal.png" />
					</div>
					<div class="col-md-6">
						<input type="radio" checked name="payment_method" value="{{ $paymentMethods[1]->Id }}" /> {{ $paymentMethods[1]->Name }}
						<img style="width: 100px; float:right; margin-top: -5px" class="img-responsive" src="{{ URL::to('/') }}/images/visamastercard.png" />
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-12">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-block">{{ trans('checkout.place_order') }}</button>
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-12">
						@if($reservationType == 1 || $reservationType == 3)
						<a href="{{ URL::to('/') }}/shopping/cart/checkout" class="btn btn-default btn-block">{{ trans('shared.back_to_checkout') }}</a>
						@elseif($reservationType == 2)
						<a href="{{ URL::to('/') }}/certificate/registration" class="btn btn-default btn-block">{{ trans('shared.back_to_registration') }}</a>
						@endif
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection

	@section("scripts")
	<script>
		
		$(document).on('ready', function(){
			$("#showContentButton").click(function(){
				preventDefault();
				$("#contentPaymentInfo").removeClass("hidden");
			})
		})
	</script>
	@endsection
    