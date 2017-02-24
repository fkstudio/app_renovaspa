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
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			    	<div style="background: url({{ URL::to('/') }}/images/renova_wedding_package.jpg);background-size: cover;" class="col-md-12 block-content" >
						<span>Renova Wedding packages</span>
					</div>
			    </div>
			</a>
			@endif
			@foreach($model as $categoryRegion)
				@php

				$photoPath = '/noimage.jpg';

				if($categoryRegion->Category->Photo != null)
				{
					$photoPath = '/categories/category-'.$categoryRegion->Category->Id.'/'.$categoryRegion->Category->Photo->Path;
				}
				@endphp
			<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/category/{{ $categoryRegion->Category->Id }}/services">
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			    	<div style="background: url({{ URL::to('/images') .$photoPath  }});background-size: cover;" class="col-md-12 block-content" >
						<span>{{ $categoryRegion->Category->Name }}</span>
					</div>
			    </div>
			</a>
	    @endforeach
	    </div>
	</div>

@endsection