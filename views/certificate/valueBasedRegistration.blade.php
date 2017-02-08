
@extends('layout/baseLayout')

@section('title', 'Complete certificate information')

@inject("dbcontext", "App\Database\DbContext")

@php
	$country = $dbcontext->getEntityManager()->getRepository("App\Models\Test\CountryModel")->findOneBy([ 'Id' => session('country_id') ]);

	$symbol = $country->Currency->Symbol;
@endphp

@section("content")
<div id="vue-app" class="container-fluid">
	<div class="container">
		<h3 class="green-title">GIFT CERTIFICATE REGISTRATION</h3>
		<br/>
		<form action="{{ URL::to('/') }}/reservation/checkout" method="POST">

			<div class="clearfix"></div>
			<hr class="custom-hr" > 
			
			<div class="form-group">
				<label>A) Personalize by adding a message:</label>
			</div>
			@foreach($model as $key => $item)
			<h3>Certificate #{{ $item->CertificateNumber }}</h3>
			<hr>
			<strong>Value: {{ $symbol.$item->Value }}</strong>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<input type="hidden" class="form-control input-border" name="certificate_number[{{ $key }}]" value="{{ $key }}" />
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="custom-label">* To (as it will appear on the gift certificate):</label>
								<input type="text" class="form-control input-border" name="to_customer[{{ $key }}]" />
							</div>
							<div class="col-md-6">
								<label class="custom-label">* From (as it will appear on the gift certificate):</label>
								<input type="text" class="form-control input-border" name="from_customer[{{ $key }}]" />
							</div>	
							<div class="clearfix"></div>
							<br/>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-label">Enter a message</label>
									<textarea  name="message[{{ $key }}]" class="form-control input-border"></textarea>
								</div>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label>B) Select delivery method:</label>
						<p>* Choose from Renova Spa s flexible delivery options</p>
					</div>
					<div class="clearfix"></div>
					<br/>
					<div class="col-md-4 delivery-type-content">
						<span style="font-size: 30px;margin-left: 12px" class="glyphicon glyphicon-envelope"></span>
						<br/>
						<input type="radio" name="sendType[{{ $key }}]" value=1 > Email
						<br/>
						<p>Instantly send it to the recipient's e-mail.</p>
					</div>
					<div class="col-md-4 delivery-type-content">
						<span style="font-size: 30px;margin-left: 12px" class="glyphicon glyphicon-print"></span>
						<br/>
						<input type="radio" name="sendType[{{ $key }}]" value=2 > Print
						<br/>
						<p>Receive the gift certificate in your mail and print it off.</p>
					</div>
					<div class="col-md-4 delivery-type-content">
						<span style="font-size: 30px;margin-left: 12px" class="glyphicon glyphicon-home"></span>
						<br/>
						<input type="radio" name="sendType[{{ $key }}]" value=3 > Hotel
						<br/>
						<p>Let us deliver your certificate at your recipient's hotel room*.</p>
					</div>
				</div>

			</div>

			
			<div class="clearfix"></div>
			<hr>
			@endforeach
			<div class="col-md-12 certificate-terms">
				<p> <input type="checkbox" name="terms">{{ trans('shared.certificate_terms') }}</p>
			</div>
			<div class="col-md-3">
				<div class="row">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary">CONTINUE</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
    $(document).ready(function(){
        var vue = new Vue({
            el: '#vue-app',
            data: {
               quantity: 0,
               type: 1,
               value_based: [ ]
            },
            ready: function(){
            },
            computed: {

            },
            methods: {
                add_certificate(){
                	this.value_based = [];
                	for($i = 1; $i <= this.quantity; $i++){
                		this.value_based.push({ value: 0 });
                	}
                }
            }
        });
    });
</script>
@endsection

