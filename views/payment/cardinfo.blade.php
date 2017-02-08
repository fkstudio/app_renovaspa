	@extends('layout/baseLayout')

	@section('title', 'Card information')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>CREDIT CARD INFORMATION</h3>
				<hr>
				@include('shared._messages')
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-12 text-center">
							<h3>Payment your order</h3>
							<h3><small>Total amount</small></h3>
							<h2 style="margin-bottom: 20px;">{{ $country->Currency->Symbol.$total.' '.$country->Currency->Name }} </h2>
						</div>
						<div class="col-md-offset-3 col-md-6" style="padding: 20px;background: #EEE;">
							<p class="text-center">Please fill your Credit Card Information</p>
							<div class='card-wrapper'></div>
							<form action="{{ URL::to('/') }}/payment/gateway/proceed" method="POST">
								<div class="form-group">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="card_number" id="card_number" placeholder="Card number" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="card_name" id="card_name" placeholder="Card name" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="month_year" id="month_year" placeholder="MM/YY" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="number" name="cvc" id="cvc" placeholder="CVC" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary btn-block">Submit</button>	
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="clearfix"></div>
						<br/>
						<p style="font-size: 10px;" class="text-center"><a href="{{ URL::to('/') }}/reservation/checkout">BACK TO CHECKOUT</a></p>
					</div>
				</div>
			</div>
		</div>
	@endsection

	@section('scripts')
	<script src="{{ URL::to('') }}/js/card.js"></script>
	<script src="{{ URL::to('') }}/js/jquery.card.js"></script>
	<script>
		var card = new Card({
		    form: 'form',
		    container: '.card-wrapper',

		    formSelectors: {
		        numberInput: 'input#card_number', // optional — default input[name="number"]
		        expiryInput: 'input#month_year', // optional — default input[name="expiry"]
		        cvcInput: 'input#cvc', // optional — default input[name="cvc"]
		        nameInput: 'input#card_name' // optional - defaults input[name="name"]
		    }, //5400831512696942
		});
	</script>
	@endsection
    