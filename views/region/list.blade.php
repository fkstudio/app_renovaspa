@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		@foreach($model as $region)
		<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/region/{{ $region->Id }}/hotels">
		    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-xl-3 parent" style="overflow: hidden;margin-bottom: 20px;">
		    	<span style="position: absolute;
							 height: 90%;
							 width: 90%;
							 display: block;
							 background: rgb(239, 232, 232);
							 background-image: url({{ config("app.admin_url") .'/images/regions/'. ($region->Photo != null ? $region->Photo->Path : "" ) }});
							 background-position: center center;
							 background-size: cover;"  class="img-responsive center-block"></span>
		    	<div  class="col-md-12 block-content-regions" >
		    		<span class="span-list">{{ $region->Name }}</span>
				</div>
		    </div>
		</a>
	    @endforeach
	</div>
</div>
@endsection