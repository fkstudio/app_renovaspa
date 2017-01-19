@inject("dbcontext", "App\Database\DbContext")

@extends('layout/baseLayout')

@section('title', 'Services')

@php

  $categories = $dbcontext->getEntityManager()->getRepository("App\Models\Test\CategoryCountryModel")
                                                  ->findBy(["Country" => session('country_id')], ["Order" => "DESC"]);

@endphp

@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		@include('shared._messages')
		<div class="row">
			<br/>
			<div class="col-md-5">
				@if ($category->Photo != null)
				<img style="margin: 0 auto;" src="{{ URL::to('/images/categories') }}/category-{{ $category->Id }}/{{ $category->Photo->Path }}" class="img-responsive" alt='{{ $category->Name }}' />
				@endif
			</div>
			<div class="col-md-7">
				<h4>Select your moment of pleasure</h5>
				<form action="{{ URL::to('/') }}/cart/add/services" method="POST">
					<table class="table table-responsive table-borderless">
						<thead>
							<tr>
								<th>Name</th>
								<th></th>
								<th></th>
								<th>Price</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $categoryRegion)
							<tr>
								<td>
									<input type="hidden" name="id[]" value="{{ $categoryRegion->Service->Id }}" /> 
									{{ $categoryRegion->Service->Name }} +info
								</td>
								<td></td>
								<td>
									@if ($categoryRegion->Service->hasDiscount($hotel->Id))
										@php
											$discount = $categoryRegion->Service->getDiscount($hotel->Id)
										@endphp
									<span class="discount">{{ "-".$discount. "% discount" }}</span>
									@endif

									@if ($categoryRegion->Service->hasHotelDiscount($hotel->Id))
									<span class="discount-tached">-10% online discount</span>
									@else
									<span class="discount">-10% online discount</span>
									@endif
									
								</td>
								<td>{{ $region->Country->Currency->Symbol.number_format($categoryRegion->Service->getPrice($hotel->Id)) }}</td>
								<td>
									<input style="max-width: 70px !important;" type="number" value='0' name="quantity[]" class="form-control input-border" />
								</td>
							</tr>
						    @endforeach
						</tbody>
					</table>
					@if (count($model) <= 0)
					<p style="text-align: center;">There is not item at your cart</p>
					<br/>
					@endif
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								{{ csrf_field() }}
								<button class="btn btn-interline block-button">ADD TO CART</button>	
							</div>
							<div class="col-md-6">
								@if (session('reservation_type') == 1 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == true)
								<a href="{{ URL::to('/shopping/cart') }}" class="btn btn-default block-button">GO TO CART</a>
								@elseif (session('reservation_type') == 1 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == false)
								<a href="#fakelink" class="disabled btn btn-default block-button">COMPLETE TO VIEW THE CART</a>
								@else
								<a href="{{ URL::to('/') }}/hotel/{{ $hotel->Id }}/categories/{{ session('current_certificate') + 1 }}" class="btn btn-default block-button">GO TO NEXT CERTIFICATE</a>
								@endif	
								
								 
							</div>
						</div>
					</div>	
				</form>
				
			</div>
		</div>
	</div>
@endsection
