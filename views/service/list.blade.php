@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', $categoryCountry->Category->Name. ' / Services')

@php

  $categories = $dbcontext->getEntityManager()->createQuery('SELECT cc FROM App\Models\Test\CategoryCountryModel cc WHERE cc.Country = :country AND cc.IsDeleted = :deleted AND cc.IsActive = :active
                AND
                ( SELECT count(sch) FROM App\Models\Test\ServiceCategoryHotelModel sch where sch.Category = cc.Category AND sch.Hotel = :hotel) > 0  ORDER BY cc.Order ASC')
                             ->setParameter('deleted', false)
                             ->setParameter('active', true)
                             ->setParameter('country', session('country_id'))
                             ->setParameter('hotel', session('hotel_id'))
                             ->getResult();

  $hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => session('hotel_id'), 'Region' => session('region_id') ]);
  
@endphp

@section("content")
	<!-- category modal -->
	<div id="categoryModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">ABOUT {{ $categoryCountry->Category->Name }}</h4>
				</div>
				<div class="modal-body">
					<p style="line-height: 25px;text-align: center;">{!! ( $categoryCountry->Description ? $categoryCountry->Description : 'No description to show.' ) !!}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		@include('shared._messages')
		<div class="row">
			<br/>
			<div class="col-lg-4 col-md-12 col-sm-12">
				<img style="margin: 0 auto;" src="{{ config('app.admin_url') . '/images/categories/' . ($categoryCountry->Category->Photo != null ? $categoryCountry->Category->Photo->Path : "" ) }}" class="img-responsive" alt='{{ $categoryCountry->Category->Name }}' />
				<br class="hidden-lg" />
				<p class="text-center">
					<a href="#fakelink" data-toggle="modal" data-target="#categoryModal" style="color:#5fc7ae;">+Info</a>
				</p>
			</div>
			<div class="col-lg-8 col-md-12 col-sm-12">
				<h4>{{ trans('titles.service_list_title') }}</h5>
				<br/>
				<form action="{{ URL::to('/') }}/cart/add/services" method="POST">
					<div class="row">
						<div class="col-lg-5 col-md-4 col-sm-4 col-xs-5">
							<label>Service</label>
						</div>
						<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
							<label>Duration</label>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
						</div>
						<div class="col-lg-1 col-md-1 col-sm-2 col-xs-3">
							<label>Price</label>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
							<label>Quantity</label>
						</div>
					</div>
					@foreach($model as $key => $serviceCategoryHotelModel)
						@if($serviceCategoryHotelModel->Service->IsActive == true && $serviceCategoryHotelModel->Service->IsDeleted == false)
							@php
								$serviceInformation = $serviceCategoryHotelModel->ServiceInformation;
							@endphp
							<div class="row" style="margin-bottom: 5px">
								<div class="col-lg-5 col-md-4 col-sm-4 col-xs-5">
									{{ $serviceCategoryHotelModel->Service->Name }} <a href="#fakelink" data-toggle="collapse" data-target="#service-{{ $key }}" style="color:#5fc7ae;">+info</a>
									<input type="hidden" name="id[]" value="{{ $serviceCategoryHotelModel->Service->Id }}" /> 
								</div>
								<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
									{{ ($serviceInformation != null ? $serviceInformation->Duration : 'N/A' ) }}
								</div>
								<div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
									@if ($serviceCategoryHotelModel->Service->hasDiscount($hotel->Id))
										@php
											$discount = $serviceCategoryHotelModel->Service->getDiscount($hotel->Id)
										@endphp
									<span class="discount">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
									@endif

									@if ($serviceCategoryHotelModel->Service->hasHotelDiscount($hotel->Id))
									<span class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
									@elseif ($hotel_region->ActiveDiscount)
									<span class="discount-tached">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
									@endif
								</div>
								<div class="col-lg-1 col-md-1 col-sm-2 col-xs-3">
									{{ $region->Country->Currency->Symbol.number_format($serviceCategoryHotelModel->Service->getPlanePrice($hotel->Id), 2) }}
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
									<input style="max-width: 70px !important;" type="number" value='0' name="quantity[]" class="input-border input-cart" />
								</div>
								<div class="clearfix"></div>
								<div class="col-md-12 collapse" id="service-{{ $key }}">
									<hr/>
									<strong>Description:</strong>
									<blockquote>
										{{ ($serviceInformation != null ? $serviceInformation->Description : 'N/A' ) }}
									</blockquote>
									<strong>Schedules:</strong>
									<blockquote>
										From
										{{ ($serviceInformation->OpeningTime != null ? $serviceInformation->OpeningTime->format('h:m a') : 'N/A' ) }} 
										to 
										{{ ($serviceInformation->EndingTime != null ? $serviceInformation->EndingTime->format('h:m a') : 'N/A' ) }}
									</blockquote>
									<strong>Restrictions:</strong>
									<blockquote>
										Pregnant restriction: {{ ($serviceInformation && $serviceInformation->PregnantRestriction == true ? 'Yes' : 'No') }}
										<br/>
										Age restriction: {{ ($serviceInformation && $serviceInformation->AgeRestriction == true ? 'Yes' : 'No') }}
									</blockquote>
									<hr/>
								</div>
							</div>
							<div class="clearfix"></div>
						@endif
					@endforeach
						<div class="clearfix"></div>
						<br/>
					@if (count($model) <= 0)
						<p style="text-align: center;">{{ trans('messages.there_is_no_items_to_show') }}</p>
						<br/>
					@endif
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								{{ csrf_field() }}
								<button type="submit" name="services" class="btn btn-interline block-button">{{ trans('shared.add_to_cart') }}</button>	
							</div>
							<div class="clearfix visible-xs"></div>
							<br class="visible-xs" />
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								@if (session('reservation_type') == 1 || session('reservation_type') == 3 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == true)
								<a href="{{ URL::to('/shopping/cart') }}" class="btn btn-default block-button">{{ trans('shared.go_to_cart') }}</a>
								@elseif (session('reservation_type') == 1 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == false)
								<a href="#fakelink" class="disabled btn btn-default block-button">{{ trans('shared.complete_to_go_cart') }}</a>
								@else
								<a href="{{ URL::to('/') }}/hotel/{{ $hotel->Id }}/categories/{{ session('current_certificate') + 1 }}" class="btn btn-default block-button">{{ trans('shared.go_to_next_certificate') }}</a>
								@endif	
							</div>
						</div>
					</div>	
				</form>
				
			</div>
			<div class="clearfix"></div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<p class="text-center">Prices include 16.00 % tax</p>
			</div>
		</div>
	</div>
	<br/>
@endsection
