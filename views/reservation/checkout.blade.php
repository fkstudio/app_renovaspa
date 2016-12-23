	@extends('layout/baseLayout')

	@section('title', 'Services')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>PAYMENT INFORMATION</h3>
				<hr>
				<div class="row">
					<form action="{{ URL::to('/') }}/payment" method="POST">
						<div class="form-group">
							<input type="text" name="first_name" class="form-control" placeholder="First name">
						</div>
						<div class="form-group">
							<input type="text" name="last_name" class="form-control" placeholder="Last name">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<input type="text" name="Country" class="form-control" placeholder="Country">
						</div>
						<div class="form-group">
							<select class="form-control" name="payment_method">
								@foreach($paymentMethods as $method)
									<option value="{{ $method->Id }}">{{ $method->Name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-primary">Payment</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection
    