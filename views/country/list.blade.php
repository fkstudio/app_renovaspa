@extends('layout/baseLayout')

@section('title', 'Regions')

@php
	$reservationType = session('reservation_type');
@endphp

@section("content")
<div id="vue-app" class="container-fluid-full" style="background: url(https://www.renovaspa.com/images/content/Depositphotos_3784443_original.jpg);background-size: cover;padding-top: 150px;padding-bottom: 150px;" id="details-hotel-container-book">
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
</div>
<div class="container-fluid">
	<h3 class="text-center">{{ strtoupper(trans('navbar.destinations')) }}</h3>
	<hr>
	<div class="row">
	@foreach($model as $country)
		@php
			$photoPath = '/noimage.jpg';

			if($country->Photo != null)
			{
				$photoPath = '/countries/country-'.$country->Id.'/'.$country->Photo->Path;
			}

		@endphp
		<a style="font-size: 30px;color:white;" href="{{ URL::to('/') }}/country/{{ $country->Id }}/regions">
		    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		    	<div style="background: url({{ URL::to('/images') . $photoPath }});background-size: cover;" class="col-md-12 block-content" >
					<span>{{ $country->Name }}	</span>
				</div>
		    </div>
		</a>
    @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>

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
	                var pacakgeSelect = $("#wedding_package_id");

	                for(var i in weddingPackages){
	                    pacakgeSelect.append("<option value='"+weddingPackages[i].id+"'>"+weddingPackages[i].name+"</option>");
	                }
	            });
	        }
	    }
	});
</script>
@endsection

   