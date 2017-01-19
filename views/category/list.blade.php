	@extends('layout/baseLayout')

	@section('title', 'Categories')

	@section("content")
		<div class="container-fluid">
			@include('shared._breadcrumps')
			<hr>
			@include('shared._messages')
			<div class="row">
				@foreach($model as $categoryRegion)
				<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/category/{{ $categoryRegion->Category->Id }}/services">
				    <div class="col-md-3">
				    	<div style="background: url({{ URL::to('/')  }}/images/categories/category-{{ $categoryRegion->Category->Id  }}/{{ $categoryRegion->Category->Photo->Path  }});background-size: cover;" class="col-md-12 block-content" >
							<span>{{ $categoryRegion->Category->Name }}</span>
						</div>
				    </div>
				</a>
		    @endforeach
		    </div>
		</div>
		
	@endsection