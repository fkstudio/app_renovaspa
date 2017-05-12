<br/>
	<div style="width: 90%;
				max-width: 800px;
    			margin: 0 auto;
    			font-size: 14px;
    			padding: 16px;
    			background: white;
    			border-radius: 12px;
    			color:#655a50;
    			font-family: sans-serif;"
    >
    	<div style="height: 133px;
    				overflow: hidden;
    				margin-bottom: 30px;
    				border-radius: 12px 12px 0px 0px;"
    	>
    		<img  style="border-radius: 0px 0 4px 4px;
    					 position: absolute;
    					 margin-left: 19px;
    					 margin-top: -2px;" src="http://renovaspa.com/images/logo-white.png">
    		<img style="width: 100%;" src="http://renovaspa.com/images/Depositphotos_25639491_original.jpg">
    </div>
		<section>
			<p style="color:#3c2f21;font-size: 19px;">Dear {{ $customer_name }}</p>
			<p style="font-size: 14px;
					    text-align: justify;
					    color: #655a50;
					    line-height: 23px;"
			>
				Thank you for using <a style="color: #665b51;" href="http://renovaspa.com">Renovaspa.com</a> to make your reservations.<br/>
				Your order has been processed and we are sending you this voucher as a confirmation.<br/>
				Please, print the voucher and present it at Renova Spa 20 minutes prior to your scheduled appointment time. <br/>
				We will be happy to assist you with any further information. <br/>
				Please, e-mail us at {{ $hotel_email }} <br/>
				We hope you enjoy our spa services and look forward to receiving you at Renova Spa! <br/>
				<br/>
				Sincerely, <strong>{{ $customer_service_name }}</strong> - Customer Services <span  style="float: right;
    																					   color: #b5b5b5;">{{ $current_date->format("Y/m/d") }}</span>
			</p>
		</section>
		<h3 style=" margin-top: 25px;
					padding-bottom: 7px;
				    font-size: 15px;
				    color: white;
				    border-bottom: solid 3px #8a7c71;
				    background: #a79689;
				    padding-top: 8px;
				    border-radius: 4px 4px 0 0;"
    	><span style="padding: 7px;
    				  border-radius: 4px 4px 0 0;
    				  font-size: 12px;"
    	>Purchase information</span></h3>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td><strong>Confirmation number:</strong></td>
					<td style="float: right;">{{ $confirmation_number }}</td>
				</tr>
				<tr>
					<td><strong>Payment:</strong></td>
					<td style="float: right;">{{ $card_type }}</td>
				</tr>
				<tr>
					<td><strong>Email:</strong></td>
					<td style="float: right;">{{ $customer_email }}</td>
				</tr>
				<tr>
					<td><strong>Billing details:</strong></td>
					<td style="float: right;">{{ $billing_details }}</td>
				</tr>
			</tbody>
		</table>
		<h3 style=" margin-top: 25px;
					padding-bottom: 7px;
				    font-size: 15px;
				    color: white;
				    border-bottom: solid 3px #8a7c71;
				    background: #a79689;
				    padding-top: 8px;
				    border-radius: 4px 4px 0 0;"
    	><span style="background: #a79689;
    				  padding: 7px;
    				  border-radius: 4px 4px 0 0;
    				  font-size: 12px;"
    	>Travel information</span></h3>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td><strong>Destination:</strong></td>
					<td style="float: right;">{{ $hotel_name }}</td>
				</tr>
				<tr>
					<td><strong>Check in:</strong></td>
					<td style="float: right;">{{ $check_in }}</td>
				</tr>
				<tr>
					<td><strong>Check out:</strong></td>
					<td style="float: right;">{{ $check_out }}</td>
				</tr>
			</tbody>
		</table>
		<h3 style=" margin-top: 25px;
					padding-bottom: 7px;
				    font-size: 15px;
				    color: white;
				    border-bottom: solid 3px #8a7c71;
				    background: #a79689;
				    padding-top: 8px;
				    border-radius: 4px 4px 0 0;"
    	><span style="background: #a79689;
    				  padding: 7px;
    				  border-radius: 4px 4px 0 0;
    				  font-size: 12px;"
    	>Payment information</span></h3>
		<table style="width: 100%;">
			<thead style="color: #584e46;
    					  font-weight: bold;"
    		>
				<tr>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Name</th>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Qty.</th>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Service</th>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Appointment</th>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Preferences</th>
					<th style="    text-align: left;
    font-weight: normal;
    font-size: 16px;">Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($details as $detail)
				<tr style="color: #545454;
    					   font-size: 14px;"
    			>
					<td>{{ $detail["name"] }}</td>
					<td>{{ $detail["quantity"] }}</td>
					<td>{{ $detail["service"] }}</td>
					<td>{{ $detail["appointment_and_time"] }}</td>
					<td>{{ $detail["details"] }}</td>
					<td>{{ $detail["total"] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div style="text-align: right;
				    width: 100%;
				    height: 100px;
				    margin-top: 25px;
				    border-top: solid 1px #efefef;"
    	>
			<table style="text-align: left;
    					  float: right;
					      margin-top: 17px;
					      width: 26%;
					      margin-right: -26px;"
    		>
				<tbody>
					<tr>
						<td>Subtotal</td>
						<td>{{ $currency_symbol.number_format($subtotal, 2) }}</td>
					</tr>
					<tr>
						<td>Discount</td>
						<td>{{ $currency_symbol.$discount }}</td>
					</tr>
					<tr>
						<td><strong>Total</strong></td>
						<td><strong>{{ $currency_symbol.$total }}</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="padding: 7px;
				    background: #8a7c71;
				    color: white;
				    border-radius: 4px;
				    text-align: center;"
    	>
			All taxes included
		</div>
		<section>
			<p>Appointments and cancellation policy: </p>
			<ul style=" color: #414141;
    					line-height: 25px;"
   			>
				<li>When choosing open date or time for any service, therapist gender, room type and appointment (date and time) will be subject to availability.</li>
				<li>We highly recommend you to come to the spa soon upon arrival to the hotel, in order to schedule your treatments.</li>
				<li>For cancellations of services with an open date, the arrival date will be taken as a deadline.</li>
				<li>Cancellations with more than 24 hours: No cancellation fee.</li>
				<li>Cancellations with less than 24 hours: 50% cancellation fee of the total purchase amount.</li>
				<li>No shows: 100% cancellation fee of the total purchase amount.</li>
				<li>Delays: If you arrive 15 minutes or more after your scheduled appointment time, it will be considered a no show situation. For some treatments, you will have the option of a reduced service time.</li>
			</ul>
		</section>
		<br/>
		<p>Thank you again for using <a style="color: #665b51;" href="http://renovaspa.com">Renovaspa.com</a> </p>
		<p>Please contact us at {{ $hotel_email }} if you request any further information or changes. </p>
		<br/>
		<div style="text-align: center;">
			<p>Follow us</p>
			<a target="_blank" href="https://www.facebook.com/RenovaSpa/"><i style="padding-left: 17px;padding-right: 17px" class="social-icon fa fa-facebook"></i></a>
	        <a target="_blank" href="https://twitter.com/renovaspas"><i class="social-icon fa fa-twitter"></i></a>
	        <a target="_blank" href="https://www.instagram.com/renova.spa/"><i class="social-icon fa fa-instagram"></i></a>
	        <a target="_blank" href="https://es.pinterest.com/renovaspa/"><i class="social-icon fa fa-pinterest"></i></a>
		</div>
		<div class="clearfix"></div>
		<br/>
		<p class="text-center"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
	</div>