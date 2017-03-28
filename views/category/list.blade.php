@extends('layout/baseLayout')

@section('title', 'Categories')

@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		@include('shared._messages')
		<div class="row">
			@if(session('reservation_type') == 3)
			<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/wedding/services">
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-xl-3">
			    	<div style="background: url({{ URL::to('/') }}/images/renova_wedding_package.jpg);background-size: cover;" class="col-md-12 block-content" >
						<span>Renova Wedding packages</span>
					</div>
			    </div>
			</a>
			@endif
			@foreach($model as $categoryCountry)
				@if($categoryCountry->Category->IsDeleted == false)
				
					@php

					$photoPath = '/noimage.jpg';

					if($categoryCountry->Category->Photo != null)
					{
						$photoPath = '/categories/'.$categoryCountry->Category->Photo->Path;
					}
					
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
					    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 " style="
					    													overflow: hidden;
					    													margin-bottom: 20px;">
					    	<img src="{{ URL::to('/images') .$photoPath  }}" class="img-responsive" style="position: absolute;height: 100%;width: 100%;">
					    	<div  class="col-md-12 block-content" >
					    		<span>{{ $categoryCountry->Category->Name }}</span>
							</div>
					    </div>
					</a>

					<!-- <a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/category/{{ $categoryCountry->Category->Id }}/services">
					    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 " style="
					    													overflow: hidden;
					    													margin-bottom: 20px;
					    													"">
					    	<div  class="col-md-12 block-content"  style="background: url({{ URL::to('/images') .$photoPath  }});
					    													background-size: cover;
																			background-position: center center;"">
					    		<span>{{ $categoryCountry->Category->Name }}</span>
							</div>
					    </div>
					</a> -->
					<!-- style="background: url({{ URL::to('/images') .$photoPath  }});background-size: cover;" -->
				@endif
	    	@endforeach
	    </div>
	</div>

@endsection