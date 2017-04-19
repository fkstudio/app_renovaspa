	@extends('layout/baseLayout')

	@section('title', 'Shopping cart')

	@inject("dbcontext", "App\Database\DbContext")

	@section("content")
		<div class="container-fluid">
			@include('shared._breadcrumps')
			<hr>
			<h3>{{ trans('titles.my_cart_title') }}</h3>
			<hr>
			<div class="row">
				<br/>
				<div class="col-md-12">
				    @include('shared._messages')
					<form action="{{ URL::to('/') . $action }}" method="{{ $method }}">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th></th>
									<th><span style="font-weight: normal !important;">{{ trans("shared.service") }}</span></th>
									<th><span style="font-weight: normal !important;">{{ trans('shared.unit_price') }}</span></th>
									@if (session('reservation_type') == 2)
									<th><span style="font-weight: normal !important;">{{ trans('shared.certificate_numer') }}</span></th>
									@endif

									<th><span style="font-weight: normal !important;"></span></th>
									<th><span style="font-weight: normal !important;">{{ trans('shared.quantity') }}</span></th>
									<th><span style="font-weight: normal !important;">{{ trans('shared.total') }}</span></th>
									<th><span style="font-weight: normal !important;">{{ trans('shared.delete') }}</span></th>
								</tr>
							</thead>
							<tbody>
								@php
									$hotel_id = session('hotel_id');
									$subtotal = 0;
									$total = 0;
									$reservation_type = session('reservation_type');

									$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => $hotel_id, 'Region' => session('region_id') ]);
								@endphp

								@foreach($model->Items as $item)
									@php
										$packageCategoryRelation = $item->PackageCategoryRelation;
									@endphp

                         			@if($packageCategoryRelation != null && $reservation_type == 3)
                         				@php
											$subtotal += $packageCategoryRelation->Price * $item->Quantity;
											$total += $packageCategoryRelation->Price * $item->Quantity;
	                         			@endphp	
                         				<tr>
                         					<td>
                         						<img style="max-width: 80px;margin-left: 10px;" src="{{ URL::to('/images/') }}/wedding_package_icon.png" class="img-responsive" /> 
                         					</td>
											<td class="padding-td">
												<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
												<span>{{ $packageCategoryRelation->WeddingPackage->Name }}</span>
											</td>
											<td class="padding-td">
												@if($packageCategoryRelation->WeddingPackage->Type == 2)
													{{ $country->Currency->Symbol }}{{ number_format($packageCategoryRelation->Price) }}</td>
												@else
													--
												@endif
											<td>
												
											</td>
											<td class="padding-td">
												@if($packageCategoryRelation->WeddingPackage->Type == 2)
													<input style="width: 80px;margin-top: -5px;" constorls=false type="number" name="quantity[]" value="{{ $item->Quantity }}" min=0 class="form-control input-border" />
												@else
													<input constorls=false type="hidden" name="quantity[]" value="1" min=0 class="form-control input-border" />
													--
												@endif
											</td>
											<td class="padding-td">
												@if($packageCategoryRelation->WeddingPackage->Type == 2)
													{{ $country->Currency->Symbol }}{{ number_format($packageCategoryRelation->Price * $item->Quantity, 2) }}
												@else
													--
												@endif
											</td>
											<td class="padding-td">
												<a style="margin-top: -6px;" href="{{ URL::to('/') }}/shopping/cart/remove/parckage/{{ $packageCategoryRelation->Id }}" type="button" class="btn btn-danger">X</a>
											</td>
                         				</tr>
                         			@else
                         				@php
											$subtotal += $item->Service->getPlanePrice($hotel_region->Hotel->Id) * $item->Quantity;
											$total += $item->Service->getPrice($hotel_region->Hotel->Id) * $item->Quantity;
	                         			@endphp	
                         				<tr>
											<td>
											@php
												$photoPath = '/noimage.jpg';

												if($category->Photo != null)
												{
													$photoPath = '/categories/'.$item->Category->Photo->Path;
												}
											@endphp
											<img style="max-width: 80px;" src="{{ URL::to('/images/') . $photoPath }}" class="img-responsive" /> </td>
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
												<span class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
												@elseif ($hotel_region->ActiveDiscount)
												<span class="discount-tached">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
												@endif
											</td>
											<td class="padding-td">
												<input style="width: 80px;margin-top: -5px;" constorls=false type="number" name="quantity[]" value="{{ $item->Quantity }}" min=0 class="form-control input-border" />
											</td>
											<td class="padding-td">{{ $country->Currency->Symbol }}{{ number_format($item->Service->getPrice($hotel_region->Hotel->Id) * $item->Quantity, 2) }}</td>
											<td class="padding-td">
												<a style="margin-top: -6px" href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
											</td>
										</tr>
                         			@endif
								
							    @endforeach
							</tbody>
						</table>
						@if (count($model->Items) <= 0)
						<p style="text-align: center;">{{ trans('messages.there_is_no_items_in_cart') }}</p>
						@endif
						<div class="clearfix"></div>
						<div class="col-lg-offset-7 col-lg-5 col-md-offset-5 col-md-7 col-sm-12">
							<div class="row">
								<h3>CART TOTAL</h3>
								<table class="table table-borderless">
									<tbody>
										<tr>
											<td>Subtotal</td>
											<td>{{ $country->Currency->Symbol }}{{ number_format($subtotal, 2) }}</td>
										</tr>
										@if ($hotel_region->ActiveDiscount)
										<tr>
											<td><span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
										</tr>
										@endif
										<tr>
											<td><strong>Total</strong></td>
											<td>{{ $country->Currency->Symbol }}{{ number_format($total, 2) }}</td>
										</tr>
									</tbody>
								</table>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										{{ csrf_field() }}
										@if(session('category_id') == null)
										<a href="{{ URL::to('/') }}/wedding/services" class="btn btn-default block-button">{{ trans('shared.back_to_services') }}</a>
										@else
										<a href="{{ URL::to('/') }}/category/{{ session('category_id') }}/services" class="btn btn-default block-button">{{ trans('shared.back_to_services') }}</a>
										@endif
										
									</div>
									<div class="clearfix visible-xs"></div>
									<br class="visible-xs" />
									<div class="col-md-6 col-sm-6 col-xs-12">
										@if ($reservationType == 1 || $reservationType == 3) 
											@if ($total > 0 || $reservationType == 3)
												<button type="submit" class="btn btn-primary block-button">{{ trans('shared.checkout') }}</button>
											@else
												<button type="button" class="disabled btn btn-primary block-button">{{ trans('shared.checkout') }}</button>
											@endif

										@elseif ($reservationType == 2)
											@if ($total > 0)
												<button type="submit" class="btn btn-primary block-button">{{ trans('shared.go_to_gift_registration') }}</button>
											@else
												<button type="button" class="disabled btn btn-primary block-button">{{ trans('shared.go_to_gift_registration') }}</button>
											@endif
										
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
    