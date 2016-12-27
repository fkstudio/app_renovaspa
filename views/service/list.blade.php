	@extends('layout/baseLayout')

	@section('title', 'Services')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>{{ $region->Country->Name }} - {{ $region->Name }} - {{ $hotel->Name }} - {{ $category->Name }} - SERVICES</h3>
				<hr>
				@if (session('status'))
				<p>{{ session('status') }}</p>
				@endif
				<div class="row">
					<br/>
					<div class="col-md-5">
						<img src="{{ URL::to('/images/categories') }}/category-{{ $category->Id }}/{{ $category->Photo->Path }}" class="img-responsive" alt='{{ $category->Name }}' />
					</div>
					<div class="col-md-7">
						<h3>Select your services</h3>
						<form action="{{ URL::to('/') }}/cart/add/services" method="POST">
							<table class="table table-responsive">
								<thead>
									<tr>
										<th>Name</th>
										<th>Price</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									@foreach($model as $categoryRegion)
									<tr>
										<td>
											<input type="hidden" name="id[]" value="{{ $categoryRegion->Service->Id }}" /> 
											{{ $categoryRegion->Service->Name }}
										</td>
										<td>{{ $region->Country->Currency->Symbol.number_format($categoryRegion->Service->getPrice($hotel->Id)) }}</td>
										<td>
											<input type="number" value='0' name="quantity[]" class="form-control" />
										</td>
									</tr>
								    @endforeach
								</tbody>
							</table>
							<div class="clearfix"></div>
							<div class="form-group">
								{{ csrf_field() }}
								<button class="btn btn-primary">ADD TO CART</button>
								@if (session('current_certificate') > session('certificate_quantity'))
								<a href="{{ URL::to('/shopping/cart') }}" class="btn btn-default">GO TO CART</a>
								@else
								<a href="{{ URL::to('/') }}/hotel/{{ $hotel->Id }}/categories" class="btn btn-default">GO TO NEXT CERTIFICATE</a>
								@endif
							</div>	
						</form>
						
					</div>
				</div>
			</div>
		</div>
	@endsection
    