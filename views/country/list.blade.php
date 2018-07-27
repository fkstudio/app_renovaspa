@extends('layout/baseLayout')

@php
	$reservationType = session('reservation_type');
	$bgs[1] = "bookhere-bg.jpg";
	$bgs[2] = "certificates-bg.jpg";
	$bgs[3] = "weddings-bg.jpg";
@endphp

@if($reservationType == 1)
	@section('title', 'Book your treatment')
@elseif($reservationType == 2)
	@section('title', 'Treat someone')
@else
	@section('title', 'The day')
@endif

@section('meta')
	@if($reservationType == 1)
		<META NAME="Description" content="Renovaspa.com | Book Here | "Riu resort spa, couple massage, gazebo services"/>
		<meta name="keywords" content="massage, body wrap massage, spa package, haircut ladies, destination spa Caribbean, bikini waxing, facial, renova spa massage, spa manicure, moon light, classic pedicure, tropical wedding destinations, honeymoon, honeymooners offers"/>
	@elseif($reservationType == 2)
		<meta NAME="Description" content="Renovaspa.com | Git Certiticates | Give your loved ones an unforgettable gift"/>
		<meta name="keywords" content="git certificates hotels, git by Riu, git in the Caribbean, dream git, git on beach, beach git certificates, island git, best caribbean git certificates resorts, git certiticates in caribbean"/>
	@else
		<meta NAME="Description" content="Renovaspa.com | Weddings | Book your spa treatment in the best destinations"/>
		<meta name="keywords" content="Wedding hotels, Weddings by Riu, wedding in the Caribbean, dream wedding, weddings on beach, beach wedding, island wedding, best caribbean wedding resorts,destination weddings in caribbean"/>
	@endif
@endsection

@section('head')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/css') }}/hotel-datepicker.css" />
@endsection

@section("content")
<!-- sign modal -->
<div id="signModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			@if($reservationType == 2)
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">GIFT CERTIFICATES</h4>
			</div>
			<div class="modal-body">
				<p style="line-height: 25px;" class="text-center">
					Give your family, friends, clients or colleagues a unique relaxation experience.
					Renova Spa Gift Certificates make the perfect birthday, anniversary, wedding, 
					incentive or holiday gift. <br/><br/>
					* Value based or service based gift certificates are available: surprise that special someone 
					with a delicious treatment or give a Renova Spa credit, so the receiver can make the choice 
					at the spa.<br/><br/>
					* Obtain 10% on top of the paid value or a 10% discount on the treatment´s value.<br/><br/>

					* Send your gift certificate through e-mail, personally hand it to the receiver or have our
					Renova Spa staff deliver it at the hotel.
				</p>
			</div>
			@else
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">WEDDING PACKAGES</h4>
			</div>
			<div class="modal-body text-center">
				<p style="line-height: 25px;text-align: center;">
					RIU has included the following Spa services and benefits in their Wedding Packages. 
					If you have purchased any of these, our Renova Spa Online Concierge will assist you to schedule the included services and make additional reservations for you and your guests.
				</p>
				<h4>Riu Free Wedding Package and Riu Classic Wedding Packages Package.</h4>
				<p>
					- 10% discount on any Renova Spa Services for the wedding couple.<br/>
					- 10% discount on any Renova Spa services for attending guets (available only for online bookings) guests.<br/>
					- Surprise gift.
				</p>
				<h4>Riu Royal Wedding Package</h4>
				<p>
					- 10% discount on any Renova Spa Services for the wedding couple.<br/>
					- 10% discount on any Renova Spa services for attending guests (available only for online bookings).<br/>
					- 1 Romantic Couple's Massage for the wedding couple (2 Relaxing Massages for 25 Minutes).
				</p>
				<h4>Riu Caprice Wedding Package</h4>
				<p>
					- 10% discount on any Renova Spa Services for the wedding couple.<br/>
					- 10% discount on any Renova Spa services for attending guets (available only for online bookings).<br/>
					- 1 Romantic Couple's Massage for the wedding couple (2 Aromatherapy Massages for 60 min)<br/>
					- 1 Classic manicure for the bride or Groom<br/>
					- 1 Classic pedicure for the bride or Groom.<br/>
					- 1 Bride's Hairstyle.
				</p>
				<h4>Riu Indulgence Wedding Package</h4>
				<p>
					*Available only at Riu Palace Hotels.
				</p>
				<p>
					- 10% discount on any Renova Spa Services for the wedding couple<br/>
					- 10% discount on any Renova Spa services for attending guests (available only for online bookings)<br/>
					- 1 Romantic Couple's Massage for the wedding couple (2 Aromatherapy Massages for 60 min)<br/>
					- 2 Relaxing Massages for 25 minutes for the wedding couple.<br/>
					- 2 Body Scrubs for 25 minutes for the wedding couple.<br/>
					- 2 Classic Cleansing Facials for 50 minutes for the wedding couple.<br/>
					- 2 Spa Pedicures for the wedding couple.<br/>
					- 1 Bride's Hairstyle.
				</p>
				<h4>IMPORTANT</h4>
				<p>- These Riu Wedding Packages are offered by the hotel. These services will only be included if you purchased these packages.</p>
				<p>- In order to redeem included services, you will need to present a Gift Certificate that will de be provided to you by your Riu Wedding Coordinator on site upon arrival.</p>
			</div>
			@endif
		</div>
	</div>
</div>

<!-- why ask modal -->
<div id="whyAskModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">INFORMATION</h4>
			</div>
			<div class="modal-body">
				@if($reservationType == 1)
				<p style="line-height: 25px;text-align: center;">
					"Your traveling dates inform us when to expect you at the selected destination. You can make use of your reservations at any date between your arrival and your departure dates. Please consider the following: if your arrival date is within the following 48 hours, we invite you to make your reservations with and open date and time and confirm the appointment at the spa upon arrival to the hotel."
				</p>
				@elseif($reservationType == 2)
				<p style="line-height: 25px;text-align: center;">
					<strong>
						The receiver's traveling dates inform us when to expect them at the selected destination. The gift certificate holder can make use of it any date between their arrival and departure dates. Please consider the following if you select our "Delivery at the hotel" service:
					</strong>	
					<br/>
					Certificates will be delivered only in hotels that have a Renova Spa. View Renova Spa locations.
					Certificates will be delivered at the recipient's room by Renova Spa within 12 hours after arrival, not at the hotel check-in.
					Certificated to be delivered for guests staying at the hotel by the time of purchase may need up to 24 hours for delivery.
					Certificates to be delivered for guests staying at the hotel by the time
				</p>
				@else
				<p style="line-height: 25px;text-align: center;">
					Your traveling dates inform us when to expect you at the selected destination. You can make use of your reservations at any date between your arrival and your departure dates. Please consider the following: If your arrival date is within the following 48 hours, we invite you to make your appointments directly at Renova Spa upon arrival. We can not confirm appointments with less than 48 hours from now.
				</p>
				@endif
				</p>
			</div>
		</div>
	</div>
</div>

<div id="vue-app" class="container-fluid-full" style="background: url({{ URL::to('/')  }}/images/{{ $bgs[$reservationType]  }});background-size: cover;background-position: center center;">
	<div class="container-fluid-full" id="form-content" style="background: #F5F5F5;">
		<br/>
		<div class="container-fluid">
			@if($reservationType == 1)
			<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.book_your_treatment') }}</h2>
			@elseif($reservationType == 2)
			<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.treat_someone') }}</h2>
			@else
			<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.the_day') }}</h2>
			@endif
			<br/>
			<form action="{{ URL::to('/') }}/reservation/select/book" method="POST" class="form-inline text-center">
				<div class="col-lg-2 col-md-12 col-sm-12">
					<label class="custom-label">{{ trans('shared.country') }}</label>
					<div class="clearfix"></div>
					<select v-model='country_id' id='country_id' name="country_id" v-on:change='getRegions()' class="form-control custom-select">
						@foreach($model as $country)
						<option value="{{ $country->Id }}">{{ $country->Name }}</option>
						@endforeach
					</select>
				</div>

				<div class="clearfix hidden-lg"></div>
				<br class="hidden-lg" />

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
					<label class="custom-label">{{ trans('shared.destination') }}</label>
					<div class="clearfix"></div>
					<select v-model='region_id' v-on:change='getHotels()' id="region_id" name='region_id' class="form-control custom-select">
	                </select>
				</div>
				
				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
					<label class="custom-label">{{ trans('shared.hotel') }}</label>
					<div class="clearfix"></div>
					<select v-model='hotel_id' v-on:change='getWeddingPackages()' id="hotel_id" name='hotel_id' class="form-control custom-select">
	                </select>
				</div>

				<div class="clearfix hidden-lg"></div>
				<br class="hidden-lg" />

				<div class="{{ ($reservationType != 3 ? 'col-lg-3' : 'col-lg-2' ) }} col-md-12 col-sm-12 col-xs-12">
					<label class="custom-label">
						*{{ trans('shared.arrival') }} - *{{ trans('shared.departure') }} 

						@if($reservationType == 2)
						<span data-toggle="modal" data-target="#signModal" style="margin-left: 20px;cursor:pointer;" class="glyphicon glyphicon-question-sign"></span>
						@endif
					</label>
					<div class="clearfix"></div>
					<input type="text" id="arrival" name='arrival_departure' class="form-control custom-select" />
				</div>	

				<div class="clearfix hidden-lg"></div>
				<br class="hidden-lg" />

				@if($reservationType == 3)
				<div class="{{ ($reservationType != 3 ? 'col-lg-3' : 'col-lg-2' ) }}">
					<label class="custom-label">
						{{ trans('shared.wedding_package') }}
						@if($reservationType == 3)
						<span data-toggle="modal" data-target="#signModal" style="cursor:pointer;" class="glyphicon glyphicon-question-sign"></span>
						@endif
					</label>
					<div class="clearfix"></div>
					<select v-model='wedding_package_id' id="wedding_package_id" name='wedding_package_id' class="form-control custom-select">
	                </select>
				</div>
				@endif

				<div class="col-lg-2">
					<label class="custom-label"></label>
					<div class="clearfix"></div>
					{{ csrf_field() }}
					
					@if($reservationType == 1)
					<input type="hidden" name="reservation_type" value="1" />
					@elseif($reservationType == 2)
					<input type="hidden" name="reservation_type" value="2" />
					@else
					<input type="hidden" name="reservation_type" value="3" />
					@endif
					<button type="submit" class="btn-block btn-confirm-book btn btn-primary" style="margin-top: 10px;">{{ trans('shared.confirm') }}</button>
					<p data-toggle="modal" data-target="#whyAskModal" class="pull-right" style="margin-top: 20px;cursor: pointer;">Why we ask?</p>
				</div>
			</form>
			<div class="clerfix"></div>
			<div class="col-md-12">
				@include('shared._messages')
			</div>
		</div>
		
		<br/>
		<br/>
		<br/>
	</div>

	<p class="discount-message-reservation">
		@if(session('reservation_type') == 2)
			{{ trans('bookhere.online_certificate_discount_reservation') }}
		@else
			{{ trans('bookhere.online_discount_reservation') }}
		@endif
	</p>
</div>
@endsection

@section('scripts')
<!-- Moment JS-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
 -->
<script src="{{ URL::to('/js') }}/fecha.js"></script>
<script src="{{ URL::to('/js') }}/hotel-datepicker.min.js"></script>

<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
	function adjustSize(){
		var form = $("#form-content").height();
		var height = $(window).height();  //getting windows height

		var porcent = ( height - form ) / 2;

		$('#vue-app').css('padding-top',porcent+'px');   //and setting height of 
		$('#vue-app').css('padding-bottom',porcent+'px');
	}

	adjustSize();

	$(document).ready(function(){
		$(window).resize(function(){
			adjustSize();
		})
	});

	$(function() {
	 //    var date = $('.datepicker').daterangepicker({
	 //    	autoUpdateInput: false,
	 //    	locale: {
		//       format: 'MM/DD/YYYY',
		//       autoApply: true
		//     },
	 //        minDate: moment(),
	 //    });

	 //    date.on('apply.daterangepicker', function(ev, picker) {
		// 	$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
		// });

		var options = {autoClose: true, showTopbar: false, format: "MM/DD/YYYY"}
	    var hdpkr = new HotelDatepicker(document.getElementById('arrival'), options);
	});

	var vue = new Vue({
	    el: '#vue-app',
	    data: {
	        country_id: undefined,
	        region_id: undefined,
	        hotel_id: undefined,
	        wedding_package_id: undefined,
	        regions: [],
	        hotels: []
	    },
	    ready: function(){
	        this.getCountries();
	    },
	    computed: {

	    },
	    methods: {
	        getRegions: function(){
	            var self = this;
	            
	            $.ajax({
	                url: '{{ URL::to("/") }}/api/async/region/by/country/' + self.country_id,
	                method: 'GET'
	            }).done(function(response){
	                var regionList = JSON.parse(response);
	                var regionSelect = $("#region_id");
	                regionSelect.html("<option></option>");
	                $("#hotel_id").html("<option></option>");
	                $("#wedding_package_id").html("<option></option>");

	                for(var i in regionList){
	                    regionSelect.append("<option value='"+regionList[i].id+"'>"+regionList[i].name+"</option>");
	                }
	            });
	        },
	        getHotels: function(){
	            var self = this;

	            $.ajax({
	                url: '{{ URL::to("/") }}/api/async/hotel/by/region/' + self.region_id,
	                method: 'GET'
	            }).done(function(response){
	                var hotelList = JSON.parse(response);
	                var hotelSelect = $("#hotel_id");

	               	$("#hotel_id").html("<option></option>");
	                $("#wedding_package_id").html("<option></option>");

	                for(var i in hotelList){
	                    hotelSelect.append("<option value='"+hotelList[i].id+"'>"+hotelList[i].name+"</option>");
	                }
	            });
	        },
	        getWeddingPackages: function(){
	            var self = this;

	            $.ajax({
	                url: '{{ URL::to("/") }}/api/async/wedding/packages/by/hotel/' + self.hotel_id,
	                method: 'GET'
	            }).done(function(response){
	                var weddingPackages = JSON.parse(response);

	                var pacakgeSelect = $("#wedding_package_id");
	                pacakgeSelect.html("");
	                pacakgeSelect.append("<option value='nopackage'>No packages</option>");

	                for(var i in weddingPackages){
	                    pacakgeSelect.append("<option value='"+weddingPackages[i].id+"'>"+weddingPackages[i].name+"</option>");
	                }
	            });
	        }
	    }
	});
</script>
@endsection

   