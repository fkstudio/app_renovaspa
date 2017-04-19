@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@php

$categories = $dbcontext->getEntityManager()->getRepository("App\Models\Test\CategoryCountryModel")
                                                  ->findBy(["Country" => session('country_id')], ["Order" => "DESC"]);
$hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => session('hotel_id'), 'Region' => session('region_id') ]);
@endphp

@section('title', 'Wedding services')


@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	@include('shared._messages')
	<div class="row">
		<br/>
		<div class="col-md-5">
			<img style="margin: 0 auto;" src="{{ URL::to('/') }}/images/renova_wedding_package.jpg" class="img-responsive" />
			<br class="hidden-lg" />
		</div>
		<div class="col-md-7">
			<h4>{{ trans('titles.service_list_title') }}</h5>
			<br/>
			<form action="{{ URL::to('/') }}/cart/add/services" method="POST">
				@foreach($model as $ckey => $categoryHotel)
					<h5><strong>{{ $categoryHotel->WeddingPackageCategory->Name }}</strong></h5>
					<p>{{ $categoryHotel->WeddingPackageCategory->Description }}</p>
					@php

						$packageRelations = $dbcontext->getEntityManager()->getRepository("App\Models\Test\WeddingPackageCategoryRelationModel")
                                                  ->findBy(['WeddingPackageCategoryHotel' => $categoryHotel->Id])
					@endphp
					@foreach($packageRelations as $pkey => $package)
						@if($package->WeddingPackage->Type == 2)
							<div class="package-info row">
								<div class="col-md-8" style="padding-top: 10px;">
									<input type="hidden" value="{{ $package->Id }}" name="pacakge_relation_id[]" />
									{{ $package->WeddingPackage->Name }}
									<a style="cursor: pointer;" data-toggle="collapse" data-target="#package-{{ $ckey .'-'. $pkey }}">+Info</a>
								</div>
								<div class="col-md-2" style="padding-top: 10px;">
									<span style="font-size: 18px;" class="float-right">{{ $country->Currency->Symbol.number_format($package->getPrice(), 2) }}</span><span style="font-size: 12px;">{{ $country->Currency->Name }}</span>
								</div>
								<div class="col-md-2">
									<input style="max-width: 70px !important;" type="number" value='0' name="quantity[]" class="form-control input-border" />
								</div>
								<div class="col-md-12">
									<div id="package-{{ $ckey .'-'. $pkey }}" class="collapse">
										<p>{{ $package->WeddingPackage->Description }}</p>
										<p><strong>Included services:</strong></p>
										<ul>
											@foreach($package->WeddingPackage->WeddingPackageServices as $packageService)
												<li>{{ $packageService->Service->Name }}</li>
											@endforeach
										</ul>
										@if(count($package->WeddingPackage->WeddingPackageServices) <= 0)
										<p>There is not services added to this package</p>
										@endif
										<br/>
									</div>
								</div>	
							</div>
						@endif
					@endforeach
				@endforeach
				<div class="clearfix"></div>
				<br/>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							{{ csrf_field() }}
							<button type="submit" name="weddings" class="btn btn-interline block-button">{{ trans('shared.add_to_cart') }}</button>	
						</div>
						<br class="visible-xs" />
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<a href="{{ URL::to('/shopping/cart') }}" class="btn btn-default block-button">{{ trans('shared.go_to_cart') }}</a>
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
@endsection
