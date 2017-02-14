@extends('layout/baseLayout')

@section('title', 'Card information')

@section("content")
	<div class="container-fluid">
		<div class="container">
			<p class="message-alert success">PLEASE WAIT A MOMENT, WE ARE PROCEDING TO CHECKOUT.</p>
			<hr/>
			<div class="row hidden">
				<form name="paymentForm" action="{{ $url }}" method="POST" >
					<div class="">
						<input type="hidden" name="Ds_SignatureVersion" value="{{ $version }}"/>
					</div>
					<div class="">
						<input type="hidden" name="Ds_MerchantParameters" value="{{ $params }}"/>
					</div>
					<div class="">
						<input type="hidden" name="Ds_Signature" value="{{ $signature }}"/>
					</div>
					<div class="">
						<button style="visibility:hidden;" type="submit"></button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script>
	document.paymentForm.submit();
</script>
@endsection


	