@extends('layout/baseLayout')

@section('title', 'Regions')

@php
	$reservationType = session('reservation_type');
	$bgs[1] = "bookhere-bg.jpg";
	$bgs[2] = "certificates-bg.jpg";
	$bgs[3] = "weddings-bg.jpg";
@endphp

@section("content")
<div id="vue-app" class="container-fluid-full" style="background: url({{ URL::to('/')  }}/images/{{ $bgs[$reservationType]  }});background-size: cover;background-position: center center;padding-top: 300px;padding-bottom: 250px;">
	<div class="container-fluid-full" style="background: #F5F5F5;">
		<br/>
		@if($reservationType == 1)
		<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.book_your_treatment') }}</h2>
		@elseif($reservationType == 2)
		<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.treat_someone') }}</h2>
		@else
		<h2 style="color: #5fc7ae;" class="text-center">{{ trans('titles.the_day') }}</h2>
		@endif
		<br/>
		<form action="{{ URL::to('/') }}/reservation/select/book" method="POST" class="form-inline text-center">
			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.country') }}</label>
				<div class="clearfix"></div>
				<select v-model='country_id' id='country_id' name="country_id" v-on:change='getRegions()' class="form-control custom-select">
					@foreach($model as $country)
					<option value="{{ $country->Id }}">{{ $country->Name }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.destination') }}</label>
				<div class="clearfix"></div>
				<select v-model='region_id' v-on:change='getHotels()' id="region_id" name='region_id' class="form-control custom-select">
                </select>
			</div>
			
			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.hotel') }}</label>
				<div class="clearfix"></div>
				<select v-model='hotel_id' v-on:change='getWeddingPackages()' id="hotel_id" name='hotel_id' class="form-control custom-select">
                </select>
			</div>

			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.arrival') }}</label>
				<div class="clearfix"></div>
				<input type="text" id="arrival" name='arrival' class="datepicker form-control custom-select" />
			</div>

			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.departure') }}</label>
				<div class="clearfix"></div>
				<input type="text" id="departure" name='departure' class="datepicker form-control custom-select" />
			</div>

			@if($reservationType == 3)
			<div class="form-group text-left">
				<label class="custom-label">{{ trans('shared.wedding_package') }}</label>
				<div class="clearfix"></div>
				<select v-model='wedding_package_id' id="wedding_package_id" name='wedding_package_id' class="form-control custom-select">
                </select>
			</div>
			@endif

			<div class="form-group">
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
				<button type="submit" class="btn-confirm-book btn btn-primary" style="margin-top: 10px;">{{ trans('shared.confirm') }}</button>
			</div>
		</form>
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
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>


	$(function() {
	    $('.datepicker').daterangepicker({
	    	locale: {
		      format: 'MM/D/YYYY'
		    },
	        minDate: moment().add(3, "days"),
	        singleDatePicker: true,
	        showDropdowns: true,
	        
		});
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
	                url: '{{ URL::to("/") }}/async/region/by/country/' + self.country_id,
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
	                url: '{{ URL::to("/") }}/async/hotel/by/region/' + self.region_id,
	                method: 'GET'
	            }).done(function(response){
	                var hotelList = JSON.parse(response);
	                var hotelSelect = $("#hotel_id");
	                $("#wedding_package_id").html("<option></option>");

	                for(var i in hotelList){
	                    hotelSelect.append("<option value='"+hotelList[i].id+"'>"+hotelList[i].name+"</option>");
	                }
	            });
	        },
	        getWeddingPackages: function(){
	            var self = this;

	            $.ajax({
	                url: '{{ URL::to("/") }}/async/wedding/packages/by/hotel/' + self.hotel_id,
	                method: 'GET'
	            }).done(function(response){
	                var weddingPackages = JSON.parse(response);

	                console.log(weddingPackages);
	                
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

   