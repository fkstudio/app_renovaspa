
@extends('layout/baseLayout')

@section('title', 'Complete certificate information')

@section("content")
<div id="vue-app" class="container-fluid">
	<div class="container">
		<h3 class="green-title">GIFT CERTIFICATE REGISTRATION</h3>
		<br/>
		<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please fill all fields and accept the terms.</p>
		<form onsubmit="return validateTerms()" action="{{ URL::to('/') }}/reservation/checkout" method="POST">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>A) Who will receive this gift certificate?</label>
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" class="form-control required-input input-border" name="first_name" />
					</div>
					<div class="form-group">
						<label>Last name</label>
						<input type="text" class="form-control required-input input-border" name="last_name" />
					</div>
				</div>
			</div>

			<div class="clearfix"></div>
			<hr>
			
			<div class="form-group">
				<label>B) Personalize by adding a message:</label>
			</div>
			@foreach($model as $key => $item)
			<h3>Certificate #{{ $key }}</h3>
			<hr>
				@foreach($item as $service)
				<p><strong>Service based value:</strong> {{ $service['quantity'] .' '. $service['name'] }}</p>
				@endforeach
			<hr>
			
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<input type="hidden" class="form-control required-input input-border" name="certificate_number[{{ $key }}]" value="{{ $key }}" />
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label> To (as it will appear on the gift certificate):</label>
								<input type="text" class="form-control required-input input-border" name="to_customer[{{ $key }}]" />
							</div>
							<div class="col-md-6">
								<label>* From (as it will appear on the gift certificate):</label>
								<input type="text" class="form-control required-input input-border" name="from_customer[{{ $key }}]" />
							</div>	
							<div class="clearfix"></div>
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

			
			<div class="clearfix"></div>
			<hr>
			@endforeach
			<div class="col-md-12 certificate-terms">
				<p> <input type="checkbox" id="accept_terms" name="terms"> {{ trans('shared.certificate_terms') }}</p>
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

