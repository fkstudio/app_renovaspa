	@extends('layout/baseLayout')

	@section('title', 'Card information')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>CREDIT CARD INFORMATION</h3>
				<hr>
				<div class="row">
					<div class="col-md-12">
						@if (session('status'))
						<p>{{ session('status') }}</p>
						@endif
						<form action="{{ URL::to('/') }}/payment/gateway/proceed" method="POST">
							<div class="form-group">
								<input type="text" name="card_name" class="form-control" placeholder="Card name">
							</div>
							<div class="form-group">
								<input type="text" name="card_number" class="form-control" placeholder="Card number">
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="form-group">
										<select class="form-control" name="month">
											@for($i = 1; $i <= 12; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="form-group">
										<select class="form-control" name="year">
											@for($i = 2017; $i < 2027; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="cvv" class="form-control" placeholder="CVV">
							</div>
							<div class="form-group">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-primary">CONFIRM REQUEST</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endsection
    