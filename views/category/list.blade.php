@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', 'Categories')

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
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		@include('shared._messages')
		<div class="row">
			@if(session('reservation_type') == 3)
				@if(count($weddings) > 0)
					<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/wedding/services">
					    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-xl-3 parent">
					    	<div style="background: url({{ URL::to('/') }}/images/renova_wedding_package.jpg);background-size: cover;" class="col-md-12 block-content" >
								<span>Renova Wedding packages</span>
							</div>
					    </div>
					</a>
				@endif
			@endif
			@foreach($model as $categoryCountry)
				@if($categoryCountry->Category->IsDeleted != true && $categoryCountry->Category->IsActive == true)
				
					@php
					
					if($categoryCountry->IsSpecial == true && $categoryCountry->SpecialBeginDate != null && $categoryCountry->SpecialEndDate != null)
					{
						$currentDate = new DateTIme("now");

						if($currentDate >= $categoryCountry->SpecialBeginDate && $currentDate <= $categoryCountry->SpecialEndDate)
						{

						}
						else {
							continue;
						}
					}

					@endphp

					<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/category/{{ $categoryCountry->Category->Id }}/services">
					    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 parent" style="overflow: hidden;margin-bottom: 20px;">
					    	<span style="position: absolute;
										 height: 100%;
										 width: 100%;
										 background-image: url({{ config('app.admin_url') . '/images/categories/' . ($categoryCountry->Category->Photo != null ? $categoryCountry->Category->Photo->Path : "" ) }});
										 background-position: center center;
										 background-size: cover;"  class="img-responsive"></span>
					    	<div  class="col-md-12 block-content" >
					    		<span class="span-list">{{ $categoryCountry->Category->Name }}</span>
							</div>
					    </div>
					</a>
				@endif
	    	@endforeach
	    </div>
	</div>

@endsection