	@extends('layout/baseLayout')

	@section('title', 'Services')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>SHOPPING CART</h3>
				<hr>
				<div class="row">
					<br/>
					<div class="col-md-12">
					    @if (session('status'))
						<p>{{ session('status') }}</p>
						@endif
						<form action="{{ URL::to('/') }}/shopping/cart/checkout" method="post">
							<table class="table table-responsive">
								<thead>
									<tr>
										<th>Name</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total</th>
										<td>Delete</td>
									</tr>
								</thead>
								<tbody>
									@foreach($model->Items as $item)
									<tr>
										<td>
											<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
											{{ $item->Service->Name }}
										</td>
										<td>${{ number_format($item->Service->getPrice(session('hotel_id'))) }}</td>
										<td>
											<input type="number" name="quantity[]" value="{{ $item->Quantity }}" class="form-control" />
										</td>
										<th>{{ $item->Service->getPrice(session('hotel_id')) * $item->Quantity }}</th>
										<td>
											<a href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
										</td>
									</tr>
								    @endforeach
								</tbody>
							</table>
							<div class="clearfix"></div>
							<div class="form-group">
								{{ csrf_field() }}
								<a href="{{ URL::to('/') }}/category/{{ $category_id }}/services" class="btn btn-default">BACK TO SERVICES</a>
								<button type="submit" class="btn btn-primary">PROCEED TO CHECKOUT</button>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
    