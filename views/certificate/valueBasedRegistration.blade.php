
@extends('layout/baseLayout')

@section('title', 'Complete certificate information')

@inject("dbcontext", "App\Database\DbContext")

@php
	$country = $dbcontext->getEntityManager()->getRepository("App\Models\Test\CountryModel")->findOneBy([ 'Id' => session('country_id') ]);

	$symbol = $country->Currency->Symbol;
@endphp

@section("content")
<div class="container-fluid">
		@include('shared._breadcrumps')
		<br/>
</div>
<div class="container-fluid-full" style="background: url({{ URL::to('/images') }}/certificate_cover.jpg);
										 background-size: cover;
										 background-position: center center;
										 height: 420px;"	>
</div>
<div id="vue-app" class="container-fluid">
	<h3 class="green-title">GIFT CERTIFICATE REGISTRATION</h3>
	<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please fill all fields and accept the terms.</p>
	<br/>
	<form onsubmit="return validateTerms()" action="{{ URL::to('/') }}/reservation/checkout" method="POST">
		@foreach($model as $key => $item)
		<h3 style="cursor: pointer;" data-toggle="collapse" data-target="#certificate-content-{{ $key }}">Certificate #{{ $item->CertificateNumber }}</h3>
		<hr/>
		<div id="certificate-content-{{ $key }}" class="collapse">
			<div class="form-group">
				<label>A) Personalize by adding a message:</label>
			</div>
			<hr>
			<strong style="font-size:18px;">Value: {{ $symbol.$item->Value }}</strong>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<input type="hidden" class="form-control input-border" name="certificate_number[{{ $key }}]" value="{{ $key }}" />
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>* To (as it will appear on the gift certificate):</label>
								<input type="text" class="required-input form-control input-border" name="to_customer[{{ $key }}]" />
							</div>
							<div class="col-md-6">
								<label>* From (as it will appear on the gift certificate):</label>
								<input type="text" class="required-input form-control input-border" name="from_customer[{{ $key }}]" />
							</div>	
							<div class="clearfix"></div>
							<br/>
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter a message</label>
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
						<input class="collapse-button" data-toggle="collapse" data-target="#certificate-{{ $key }}-email" type="radio" name="sendType[{{ $key }}]" value=1 ><br/> Email
						<br/>
						<p>Instantly send it to the recipient's e-mail.</p>
					</div>
					<div class="col-md-4 delivery-type-content">
						<span style="font-size: 30px;margin-left: 12px" class="glyphicon glyphicon-print"></span>
						<br/>
						<input class="collapse-button" data-toggle="collapse" data-target="#certificate-{{ $key }}-print" type="radio" name="sendType[{{ $key }}]" value=2 ><br/> Print
						<br/>
						<p>Receive the gift certificate in your mail and print it off.</p>
					</div>
					<div class="col-md-4 delivery-type-content">
						<span style="font-size: 30px;margin-left: 12px" class="glyphicon glyphicon-home"></span>
						<br/>
						<input class="collapse-button" data-toggle="collapse" data-target="#certificate-{{ $key }}-hotel" type="radio" name="sendType[{{ $key }}]" value=3 ><br/> Hotel
						<br/>
						<p>Let us deliver your certificate at your recipient's hotel room*.</p>
					</div>
				</div>
				<div class="clearfix"></div>
				<div id="certificate-{{ $key }}-email" class="collapse col-md-12">
					<hr>
					<label>D) Enter delivery information</label>
					<p>Please provide the recipient's email addres</p>
					<div class="clearfix"></div>
					<div class="col-md-4">
						<div class="row">
							<table class="table table-responsive">
								<tbody>
									<tr>
										<td>
											<label>E-mail</label>
										</td>
										<td>
											<input type="email" name="delivery_email[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
									<tr>
										<td>
											<label>E-mail confirmation</label>
										</td>
										<td>
											<input type="email" name="delivery_email_confirmation[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
								</tbody>
							</table>	
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div id="certificate-{{ $key }}-print" class="collapse col-md-12">
					<hr>
					<p><strong>NOTA:</strong><br/>Your gift certificates will be sent to your e-mail account as soon as your order is complete.</p>
				</div>
				<div class="clearfix"></div>
				<div id="certificate-{{ $key }}-hotel" class="collapse col-md-12">
					<hr>
					<label>D) Enter delivery information</label>
					<p><strong>Important notes:</strong></p>
					<ul>
						<li>Certificates will be delivered only in hotels that have a Renova Spa.</li>
						<li>Certificates will be delivered at the recipient's room by Renova Spa within 12 hours after arrival, not at the hotel check-in.</li>
						<li>Certificated to be delivered for guests staying at the hotel by the time of purchase may need up to 24 hours for delivery.</li>
					</ul>
					<br/>
					<p><strong>Completing the following information will facilitate the location of the guest. Please provide at least one of the following:</strong></p>
					<br/>
					<div class="clearfix"></div>
					<div class="col-md-7">
						<div class="row">
							<table class="table table-responsive">
								<tbody>
									<tr>
										<td>
											<label>Hotel reservation number or travel agency</label>
										</td>
										<td>
											<input type="text" name="delivery_number_or_agency[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
									<tr>
										<td>
											<label>Companion name</label>
										</td>
										<td>
											<input type="text" name="delivery_company_name[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
									<tr>
										<td>
											<label>Departure date</label>
										</td>
										<td>
											<input type="text" name="delivery_departure_date[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
									<tr>
										<td>
											<label>Other information</label>
										</td>
										<td>
											<input type="text" name="delivery_other_info[{{ $key }}]" class="form-control input-border" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
		</div>
		@endforeach
		<div class="clearfix"></div>
		<br/>
		<br/>
		<div class="col-md-12">
			<p> 
				<input type="checkbox" id="accept_terms" name="terms"> 
				<a target="__blank" href="{{ URL::to('/') }}/privacy-policy#certificates">I have added gift certificate/s. I agree to the Privacy Policy</a>
			</p>
		</div>
		<div class="clearfix"></div>
		<br/>
		<div class="col-md-3">
			<div class="row">
				{{ csrf_field() }}
				<button type="submit" class="btn btn-primary">CONTINUE</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
	function validateTerms(){
		var pass = true;

		if (!$("#accept_terms").is(":checked")) {
			pass = false;
	    }

	    var requiredInputs = $('.required-input');

	    $.each(requiredInputs, function(key, value){
	    	if($(value).val() == "")
	    		pass = false;
	    });

	    
	    if(!pass){
	    	$("#errorMessageContent").fadeTo(2000, 500).slideUp(500, function(){
	            $("#errorMessageContent").slideUp(500);
	        });
	    }
	    return pass;
	}

    $(document).ready(function(){
        // hidden all collapse when 1 collapse is clicked and then open it
        $('.collapse-button').on('click', function () {
		  $('.collapse').collapse('hide')
		})
    });
</script>
@endsection

