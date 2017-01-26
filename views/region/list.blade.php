	@extends('layout/baseLayout')

	@section('title', 'Regions')

	@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		<div class="row">
			@foreach($model as $region)
			<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/region/{{ $region->Id }}/hotels">
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			    	<div style="background: url({{ URL::to('/')  }}/images/regions/region-{{ $region->Id  }}/{{ $region->Photo->Path  }});background-size: cover;" class="col-md-12 block-content" >
						<span>{{ $region->Name }}</span>
					</div>
			    </div>
			</a>
		    @endforeach
		</div>
	</div>
	@endsection