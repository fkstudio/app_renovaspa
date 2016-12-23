	@extends('layout/baseLayout')

	@section('title', 'Categories')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>{{ $region->Country->Name }} - {{ $region->Name }} - {{ $hotel->Name }} - TREATMENTS</h3>
				<hr>
				@foreach($model as $categoryRegion)
				    <div class="col-md-3" style="padding: 100px;
												 border: solid 1px rgb(224, 224, 224);
												 text-align: center;"
				>
						<a href="{{ URL::to('/') }}/category/{{ $categoryRegion->Category->Id }}/services">{{ $categoryRegion->Category->Name }}</a>	
					</div>
			    @endforeach
			</div>
		</div>
		
	@endsection
    