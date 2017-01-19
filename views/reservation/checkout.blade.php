	@extends('layout/baseLayout')

	@section('title', 'Services')

	@section("content")
	<div class="container-fluid">
		@include('shared._breadcrumps')
		<hr>
		<h3>PAYMENT INFORMATION</h3>
		<hr>
		<div class="row">
			<form action="{{ URL::to('/') }}/payment" method="POST">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="first_name" class="form-control input-border" placeholder="First name">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="last_name" class="form-control input-border" placeholder="Last name">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" name="email" class="form-control input-border" placeholder="Email">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="Country" class="form-control input-border" placeholder="Country">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<select class="form-control input-border" name="payment_method">
								@foreach($paymentMethods as $method)
									<option value="{{ $method->Id }}">{{ $method->Name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary">Payment</button>
					</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection
    