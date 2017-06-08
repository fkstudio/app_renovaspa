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
		<img style="width: 100%;" src="http://renovaspa.com/images/voucher_header.jpg">
</div>
	<section>
		<p style="color:#3c2f21;font-size: 19px;">Dear {{ $customer_name }}</p>
		<p style="font-size: 14px;
				    text-align: justify;
				    color: #655a50;
				    line-height: 23px;"
		>
			Thank you for your purchase at <a style="color: #665b51;" href="http://renovaspa.com">Renovaspa.com</a> Your order has been processed and we are sending you this voucher as a confirmation. Attached you will find the gift certificate/s. <br/><br/>

			If you have chosen to have the <strong>Gift Certificate/s sent to you online in order to personally give it to the recipient/s:</strong> Please, print it/these out, give it/them to the recipient/s and instruct them to present it/them at the Renova spa in order to choose and schedule their treatments.<br/><br/>

			If you have chosen to have the <strong>Gift Certificate/s delivered to the recipient/s directly at the hotel:</strong> The Renova Spa staff will do so within 12 hours of the recipient's arrival. If the recipient/s is already staying at the hotel by the time of purchase, the staff will need up to 24 hours for delivery. The recipient/s will have to present the certificate it at Renova Spa in order to choose and schedule their treatments.<br/><br/>

			If you have chosen to have the <strong>Gift Certificate/s e-mailed to the recipient/s:</strong>
			We will contact the recipient/s with an explanation about the scheduling procedures.
			We highly recommend you to contact the recipient/s to make sure the Gift Certificate/s has been received.<br/><br/>

			We will be happy to assist you with any further information.
			Please, e-mail us at {{ $hotel_email }}<br/><br/>

			We hope the Gift Certificate's receiver/s enjoy(s) our spa services and look forward to welcoming them at Renova SPA!<br/><br/>

			Sincerely, <strong>{{ $customer_service_name }}</strong> - Customer Services <span  style="float: right;
																					   color: #b5b5b5;">{{ $current_date->format('F j, Y') }}</span>
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
	>Gift certificate information</span></h3>
	<table style="width: 100%;">
		<thead style="color: #584e46;
					  font-weight: bold;"
		>
			<tr>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">To</th>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Type</th>
				@if($details[0]['certificate_type'] == 'Service based')
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Services</th>
				@endif
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Delivery method</th>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Number</th>
				<th style="text-align: left;
					font-weight: normal;
					font-size: 16px;">
						@if($details[0]['certificate_type'] == 'Service based')
							{{ 'Discount' }}
						@else
							{{ 'Bono' }}
						@endif
					</th>
				<th style="text-align: left;
					font-weight: normal;
					font-size: 16px;">Price</th>
			</tr>
		</thead>
		<tbody>
			@foreach($details as $detail)
			<tr style="color: #545454;
					   font-size: 14px;"
			>
				
				<td>{{ $detail["real_customer_first_name"] . ' ' . $detail["real_customer_last_name"] }}</td>
				<td>{{ $detail['certificate_type'] }}</td>
				@if($detail['certificate_type'] == 'Service based')
				<td>
					@foreach($detail['services'] as $serviceName)
						{{ $serviceName }}</br>
					@endforeach
				</td>
				@endif
				<td>{{ $detail["delivery_method"] }}</td>
				<td>{{ $detail["certificate_number"] }}</td>
				<td>
				@if($detail['certificate_type'] == 'Service based')
					{{ $currency_symbol.( $detail["sub_total"] - $detail["price"] ) }}
				@else
					@php
						$bonus = $detail["price"] - $detail["sub_total"];
					@endphp
					{{ $currency_symbol.( $bonus ) }}
				@endif
				</td>
				<td>{{ $currency_symbol.$detail["sub_total"] }}</td>
				<td></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@foreach($details as $detail)
		@if($detail['delivery_method'] == 'Hotel')
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
	>Hotel delivery information Certificate #{{ $detail['certificate_number'] }}</span></h3>
	<table style="width: 100%;">
		<thead style="color: #584e46;
					  font-weight: bold;"
		>
			<tr>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Delivery number or agency</th>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Company name</th>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Check in</th>
				<th style="text-align: left;
font-weight: normal;
font-size: 16px;">Other information</th>
			</tr>
		</thead>
		<tbody>
			<tr style="color: #545454;
					   font-size: 14px;"
			>
				<td>{{ $detail["delivery_number_or_agency"] }}</td>
				<td>{{ $detail["delivery_company_name"] }}</td>
				<td>{{ $detail["delivery_departure_date"] }}</td>
				<td>{{ $detail["delivery_other_fields"] }}</td>
			</tr>
		</tbody>
	</table>
		@endif
	@endforeach
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
					<td><strong>Total</strong></td>
					@if($type == 2)
						@if($details[0]['certificate_type'] == 'Service based')
							<td><strong>{{ $currency_symbol.$total }}</strong></td>
						@else
							<td><strong>{{ $currency_symbol.$subtotal }}</strong></td>
						@endif
					@else
						<td><strong>{{ $currency_symbol.$total }}</strong></td>
					@endif
					
				</tr>
			</tbody>
		</table>
	</div>
	<section>
		<p><strong>GIFT CERTIFICATE REDEMPTION:</strong></p>
		<ul style=" color: #414141;
					line-height: 25px;"
			>
			<li>Customers must present a copy of the gift certificate at the selected Renova Spa in order to choose and schedule their services.</li>
			<li>A copy of the gift certificate is always sent to the purchaser after the payment process has been completed.</li>
			<li>Appointments are subject to availability and must be requested directly at the Spa's reception.</li>
			<li>If you do not use the full value on your initial visit, the spa partner will issue you a credit towards a future appointment, which needs to be redeemed during the stay. </li>
			<li>You can purchase spa treatments or products for the receiver and/or any other person.</li>
			<li>No partial refunds apply for unused amounts and these cannot be used for tips. </li>
			<li>All transactions are issued in US dollars (U$) or Euros (=E2=82=AC$), based on the location. When redeeming a Renova SPA gift certificate, the spa will convert the value into the currency of their respective country. It will buy a service or services of equivalent value.</li>
			<li>No refunds apply for unused Gift Certificates.</li>
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