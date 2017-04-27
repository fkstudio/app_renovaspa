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
					 margin-top: -2px;" src="http://renovaspa.com/public/images/logo-white.png">
		<img style="width: 100%;
					margin-top: -132px;" src="http://renovaspa.com/public/images/content/Depositphotos_25639491_original.jpg">
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
			Please, e-mail us at info.aruba@renovaspa.com<br/><br/>

			We hope the Gift Certificate's receiver/s enjoy(s) our spa services and look forward to welcoming them at Renova SPA!<br/><br/>

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
				<th style="    text-align: left;
font-weight: normal;
font-size: 16px;">From</th>
				<th style="    text-align: left;
font-weight: normal;
font-size: 16px;">For.</th>
				<th style="    text-align: left;
font-weight: normal;
font-size: 16px;">Delivery method</th>
				<th style="    text-align: left;
font-weight: normal;
font-size: 16px;">Confirmation number</th>
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
				<td>{{ $detail["from_customer"] }}</td>
				<td>{{ $detail["to_customer"] }}</td>
				<td>{{ $detail["type"] }}</td>
				<td>{{ $detail["confirmation_number"] }}</td>
				<td>{{ $currency_symbol.$detail["price"] }}</td>
				<td></td>
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
					<td><strong>Total</strong></td>
					<td><strong>{{ $currency_symbol.$total }}</strong></td>
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