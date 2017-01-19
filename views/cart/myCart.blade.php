	@extends('layout/baseLayout')

	@section('title', 'Shopping cart')

	@inject("dbcontext", "App\Database\DbContext")

	@section("content")
		<div class="container-fluid">
			@include('shared._breadcrumps')
			<hr>
			<h3>SHOPPING CART SERVICES</h3>
			<hr>
			<div class="row">
				<br/>
				<div class="col-md-12">
				    @include('shared._messages')
					<form action="{{ URL::to('/') . $action }}" method="post">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th></th>
									<th><span style="font-weight: normal !important;">Service</span></th>
									<th><span style="font-weight: normal !important;">Unit price</span></th>
									@if (session('reservation_type') == 2)
									<th><span style="font-weight: normal !important;">Certificate number</span></th>
									@endif

									<th><span style="font-weight: normal !important;"></span></th>
									<th><span style="font-weight: normal !important;">Quantity</span></th>
									<th><span style="font-weight: normal !important;">Total</span></th>
									<th><span style="font-weight: normal !important;">Delete</span></th>
								</tr>
							</thead>
							<tbody>
								@php
									$hotel_id = session('hotel_id');
									$subtotal = 0;
									$total = 0;

									$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => $hotel_id, 'Region' => session('region_id') ]);
								@endphp

								@foreach($model->Items as $item)
									@php
										$subtotal += $item->Service->getPlanePrice($hotel_region->Hotel->Id) * $item->Quantity;
										$total += $item->Service->getPrice($hotel_region->Hotel->Id) * $item->Quantity;
									@endphp
								<tr>
									<td><img style="max-width: 80px;" src="{{ URL::to('/') }}/images/services/collagen-puls-facial.jpg" class="img-responsive" /> </td>
									<td class="padding-td">
										<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
										<span>{{ $item->Service->Name }}</span>
									</td>
									<td class="padding-td">{{ $country->Currency->Symbol }}{{ number_format($item->Service->getPlanePrice($hotel_region->Hotel->Id)) }}</td>
									@if (session('reservation_type') == 2)
									<td class="padding-td">Certificate #{{ $item->CertificateNumber }}</td>
									@endif
									<td class="padding-td">
										@if ($item->Service->hasDiscount($hotel_region->Hotel->Id))
										@php
											$discount = $item->Service->getDiscount($hotel_region->Hotel->Id)
										@endphp
										<span class="discount">{{ "-".$discount. "% discount" }}</span>
										@endif

										@if ($item->Service->hasHotelDiscount($hotel_region->Hotel->Id))
										<span class="discount-tached">-10% online discount</span>
										@else
										<span class="discount">-10% online discount</span>
										@endif
									</td>
									<td class="padding-td">
										<input style="width: 80px;margin-top: -5px;" constorls=false type="number" name="quantity[]" value="{{ $item->Quantity }}" min=0 class="form-control input-border" />
									</td>
									<td class="padding-td">{{ $country->Currency->Symbol }}{{ $item->Service->getPrice($hotel_region->Hotel->Id) * $item->Quantity }}</td>
									<td class="padding-td">
										<a style="margin-top: -6px" href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
									</td>
								</tr>
							    @endforeach
							</tbody>
						</table>
						@if (count($model->Items) <= 0)
						<p style="text-align: center;">There is not item at your cart</p>
						@endif
						<div class="clearfix"></div>
						<div class="col-md-offset-7 col-md-5">
							<div class="row">
								<h3>CART TOTAL</h3>
								<table class="table table-borderless">
									<tbody>
										<tr>
											<td>Subtotal</td>
											<td>{{ $country->Currency->Symbol }}{{ $subtotal }}</td>
										</tr>
										@if ($hotel_region->Hotel->ActiveDiscount)
										<tr>
											<td><span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Hotel->Discount }}% online discount available</span></td>
										</tr>
										@endif
										<tr>
											<td><strong>Total</strong></td>
											<td>{{ $country->Currency->Symbol }}{{ $total }}</td>
										</tr>
									</tbody>
								</table>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-md-6">
										{{ csrf_field() }}
										<a href="{{ URL::to('/') }}/category/{{ $category_id }}/services" class="btn btn-default block-button">BACK TO SERVICES</a>
									</div>
									<div class="col-md-6">
										@if ($reservationType == 1) 
										<button type="submit" class="btn btn-primary block-button">PROCEED TO CHECKOUT</button>
										@elseif ($reservationType == 2)
										<button type="submit" class="btn btn-primary block-button">GO TO GIFT REGISTRATION</button>
										@endif
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection
    