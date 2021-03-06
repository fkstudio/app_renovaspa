
@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<!-- sign modal -->
<div id="pricingModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">VIEW A PRICING GUIDE</h4>
			</div>
			<div class="modal-body">
				<table class="table table-responsive" id="pricing-guide-table">
					<tr>
						<td>
							$100
						</td>
						<td>
							Great choice for a one hour spa service such as a basic massage, a facial, a hand and foot or a body treatment
						</td>
					</tr>
					<tr>
						<td>
							$100 - $150
						</td>
						<td>
							Great choice for an upgraded massage, facial or a body treatment
						</td>
					</tr>
					<tr>
						<td>
							$200 - $300
						</td>
						<td>
							Great choice for a combination of two treatments or a half day of spa-ing
						</td>
					</tr>
					<tr>
						<td>
							$500
						</td>
						<td>
							Ideal for an indulgent day at the spa that offers many choices of spa treatments
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- service based -->
<div id="serviceBasedModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">SERVICE BASED CERTIFICATE</h4>
			</div>
			<div class="modal-body">
				<P>Service Based Gift Certificates are for a specific spa treatment/s or spa package/s and include a 10% discount.<br/><br/>
					Will schedule the selected treatment/s at the spa directly upon arrival to the hotel.
					<h6><strong>PROCEDURE TO PURCHASE VALUE BASED GIFT CERTIFICATES</strong></h6>
					<ul style="list-style: number;">
						<li>Select the amount of gift certificate/s</li>
						<li>Make your selection of treatments ( one or more per gift certificate)</li>
						<li>Go to your CART and proceed with the Gift Certificate Registration</li>
						<li>Enter the gift certificate details:
							<ul>
								<li>* who will receive it</li>
								<li>* include personal message</li>
								<li>* select delivery method</li>
							</ul>
						</li>
					</ul>
					<h6><strong>IMPORTANT</strong></h6>
					Very important: for multiple Value Based Gift Certificates, the selection of treatments and registration will be done one after the other.<br/>
					<h6>You will have to select the treatment/s for Gift Certificate 1 and complete registration for </h6>
					<h6>Gift Certificate 1 prior to continuing with the selection of treatments and registration for the 
following Gift Certificates/s.</h6>
				</P>
			</div>
		</div>
	</div>
</div>

<!-- value based -->
<div id="valueBasedModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">VALUED BASED CERTIFICATE</h4>
			</div>
			<div class="modal-body">
				<P>Value Based Gift Certificates are Renova Spa Credits in a specific currency amount of your choice.
					<ul>
						<li>Can purchase spa treatments or spa products for him/herself or any other</li>
						<li>Will make his/her choice of treatment and schedule it at the spa directly upon arrivalto the hotel</li>
						<li>Will obtain a 10% bonus on top of the paid value.</li>
					</ul>
					<h6><strong>PROCEDURE TO PURCHASE VALUE BASED GIFT CERTIFICATES</strong></h6>
					<ul>
						<li>Select the amount of gift certificate/s</li>
						<li>Select the value for each gift certificate/s</li>
						<li>Enter the gift certificate/s details:</li>
						<li>Who will receive it</li>
						<li>Include personal message</li>
						<li>Select delivery method</li>
						<li>Complete your purchase: pay for your gift certificate/s and receive an instant 
confirmation of purchase and a copy of the gift certificate/s online.</li>
					</ul>
				</P>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
		@include('shared._breadcrumps')
		<br/>
</div>
<div class="container-fluid-full" style="background: url({{ URL::to('/images') }}/certificate_cover.jpg);
										 background-size: cover;
										 background-position: center center;
										 height: 220px;"	>
</div>
<div id="vue-app" class="container-fluid">
	
	<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please select at least one certificate.</p>
	<h3 class="green-title">GIFT CERTIFICATE OPTIONS</h3>
	<br/>
	<div class="col-md-12">
		<form onsubmit="return validateForm()" action="{{ URL::to('/') }}/certificate/check/option" method="POST">
			<div class="form-group">
				<label>A) What type of gifts are you interested in?</label>
				<p>Choose between value-based or service-based gift certificates</p>
			</div>
			<div class="row">
				<div class="col-md-5 col-xs-12">
					<input type="radio" name="type" value="1" v-model='type' /> <strong>SERVICE BASED</strong>  (No price will be shown) 
					<span data-toggle="modal" data-target="#serviceBasedModal" style="margin-left: 20px;cursor:pointer;" class="glyphicon glyphicon-question-sign"></span>
				</div>
				<div class="clearfix visible-xs"></div>
				<br class="visible-xs" />
				<div class="col-md-3 col-xs-12">
					<input type="radio" name="type" value="2" v-model='type' /> <strong>VALUE BASED</strong>
					<span data-toggle="modal" data-target="#valueBasedModal" style="margin-left: 20px;cursor:pointer;" class="glyphicon glyphicon-question-sign"></span>
				</div>
				<div class="clearfix visible-xs"></div>
				<br class="visible-xs" />
				<div class="col-md-2">
					How many?
				</div>
				<div class="col-md-2">
					<input type="number" min=0 class="form-control input-border" v-on:change='add_certificate()' v-model='quantity' id="quantity" name="quantity" />
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
			<div v-if='type == 2' class="col-md-12">
				<div class="row">
					<div class="form-group">
						<label>B) Select your gifts amount</label>
						<p><strong>Valued-Based Gifts</strong>
					</div>
					<div class="clearfix"></div>
					<div v-for='certificate in value_based' class="col-md-12">
						<div class="col-md-3">
							Value certificate
						</div>
						<div class="col-md-3">
							USD
						</div>
						<div class="col-md-3">
							<select name="value[]" class="values" v-model='certificate.value'>
								<option selected value="0">Select a gift amount</option>
								<option value="50" >$ 50 + bonus discount</option>
								<option value="100" >$ 100 + bonus discount</option>
								<option value="150" >$ 150 + bonus discount</option>
								<option value="200" >$ 200 + bonus discount</option>
								<option value="250" >$ 250 + bonus discount</option>
								<option value="300" >$ 300 + bonus discount</option>
								<option value="350" >$ 350 + bonus discount</option>
								<option value="400" >$ 400 + bonus discount</option>
								<option value="450" >$ 450 + bonus discount</option>
								<option value="500" >$ 500 + bonus discount</option>
							</select>
						</div>	
					</div>
					<div class="clearfix"></div>
					<br/>
					<a style="color:#5fc7ae;" href="#fakelink" data-toggle="modal" data-target="#pricingModal">View a pricing guide</a>
				</div>
			</div>
			<div class="form-group">
				{{ csrf_field() }}
				<button type="submit" class="pull-right btn btn-primary">CONTINUE</button>
				<div class="clearfix"></div>
			</div>
			<hr>
		</form>	
	</div>

</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
	function validateForm(){
		var pass = true;

		if(parseInt($('#quantity').val()) <= 0)
			pass = false;
		
		var values = $('.values');
		
		if(values != null){
			$.each(values, function(key, value){
				var current_value = $(value);
				
				if(parseInt(current_value.val()) <= 0){
					pass = false;
				}
			});
		}
	    
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

