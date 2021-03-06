
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
										 height: 220px;">
</div>
<div id="vue-app" class="container-fluid">
	<h3 class="green-title">{{ trans('titles.complete_gift_certificate') }}</h3>
	<br/>
	<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please fill all fields and accept the terms.</p>
	<form onsubmit="return validateTerms()" action="{{ URL::to('/') }}/reservation/checkout" method="POST">
		
		@foreach($model as $key => $item)
		<h3 style="cursor: pointer;" data-toggle="collapse" data-target="#certificate-content-{{ $key }}">Certificate No. {{ $key }} (Click here to add your details)</h3>
		<hr/>
		<div id="certificate-content-{{ $key }}" class="collapse">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>A) {{ trans('giftcertificates.who_will_receive') }}</label>
					</div>
					<hr/>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
						<label>{{ trans('shared.first_name') }}</label>
						<input type="text" name="real_customer_first_name" class="form-control input-border" />
					</div>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
						<label>{{ trans('shared.last_name') }}</label>
						<input type="text" name="real_customer_last_name" class="form-control input-border" />
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr/>
			<div class="form-group">
				<label>B) {{ trans('giftcertificates.personalize_by_adding') }}</label>
			</div>
			@php
				$certTotal = 0;
			@endphp
			@foreach($item as $service)
			<p><strong>Service based value:</strong> {{ $service['quantity'] .' '. $service['name'] }}</p>
				@php
					$certTotal += $service['price'] * $service['quantity'];
				@endphp
			@endforeach
			<hr/>
			<strong style="font-size:18px;">Total: {{ $symbol.$certTotal }}</strong>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<input type="hidden" class="form-control required-input input-border" name="certificate_number[{{ $key }}]" value="{{ $key }}" />
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>* {{ trans('giftcertificates.to') }}</label>
								<input type="text" class="form-control required-input input-border" name="to_customer[{{ $key }}]" />
							</div>
							<div class="col-md-6">
								<label>* {{ trans('giftcertificates.from') }}</label>
								<input type="text" class="form-control required-input input-border" name="from_customer[{{ $key }}]" />
							</div>	
							<div class="clearfix"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label>{{ trans('giftcertificates.enter_message') }}</label>
									<textarea maxlength="170" name="message[{{ $key }}]" class="form-control input-border"></textarea>
								</div>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label>C) {{ trans('giftcertificates.select_delivery') }}</label>
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
				<div id="certificate-{{ $key }}-email" class="collapse col-md-12 collapse-delivery-option">
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
				<div id="certificate-{{ $key }}-print" class="collapse col-md-12 collapse-delivery-option">
					<hr>
					<p><strong>NOTA:</strong><br/>Your gift certificates will be sent to your e-mail account as soon as your order is complete.</p>
				</div>
				<div class="clearfix"></div>
				<div id="certificate-{{ $key }}-hotel" class="collapse col-md-12 collapse-delivery-option">
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
		</div>
		
		@endforeach
		<div class="clearfix"></div>
		<br/>
		<br/>
		<div class="col-md-12">
			<p> 
				<input type="checkbox" id="accept_terms" name="terms"> 
				<a target="__blank" style="color:#5fc7ae;" href="{{ URL::to('/') }}/privacy-policy">I have added gift certificate/s. I agree to the Privacy Policy</a>
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
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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

    $(document).ready(function(){
        // hidden all collapse when 1 collapse is clicked and then open it
        $('.collapse-button').on('click', function () {
		  $('.collapse-delivery-option').collapse('hide')
		})
    });

     $(function() {
	    $('.datepicker').daterangepicker({
	    	locale: {
		      format: 'MM/D/YYYY'
		    },
	        singleDatePicker: true,
	        showDropdowns: true,
	        
		});
	});
</script>
@endsection

