@extends('layout/baseLayout')

@section('title', 'Bookhere')

@section('content')
    <div id="vue-app" class="container-fluid" style="height:600px;background: url({{ URL::to('/images') }}/bookhere-bg.jpg);background-size: cover;">
    	<div class="row" style="margin-top: 250px">
            <div class="container-fluid content-form">
                <div class="container">
                    <div class="row" style="text-align: center">
                        <h3>Book your treatment</h3>
                        <br />
                        <br />
                        <div class="row" style="text-align: center;">
                            <form>
                                <div class="col-md-2">
                                    <select v-model='country_id' v-on:change='getRegions()' name='country_id' class="form-control" >
                                        <option selected>-- Country --</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->Id }}">{{ $country->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @verbatim
                                <div class="col-md-2">
                                    <select v-model='region_id' v-on:change='getHotels()' name='region_id' class="form-control">
                                        <option selected>-- Destination --</option>
                                        <option v-for='(region, index) in regions' value="{{ region.id }}">{{ region.name }}</option>

                                    </select>
                                </div>         
                                <div class="col-md-2">
                                    <select v-model='hotel_id' name='hotel_id' class="form-control">
                                        <option selected>-- Hotel --</option>
                                        <option v-for='(hotel, index) in hotels' value="{{ hotel.id }}">{{ hotel.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input v-model='arrival' type="date" name='arrival_date' class="form-control"  />
                                </div>
                                <div class="col-md-2">
                                    <input v-model='departure' type="date" name='departure_date' class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary">CONFIRM</button>
                                </div>
                                @endverbatim
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
    $(document).ready(function(){
        var vue = new Vue({
            el: '#vue-app',
            data: {
                country_id: '',
                region_id: '',
                hotel_id: '',
                arrival: '',
                departure: '',
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
                    self.regions = [];
                    
                    $.ajax({
                        url: '{{ URL::to("/") }}/region/all/' + this.country_id,
                        method: 'GET'
                    }).done(function(response){
                        var regionList = JSON.parse(response);
                        console.log(response);
                        for(var i in regionList){
                            self.regions.push({ id: regionList[i].id, name: regionList[i].name });
                        }
                    });
                },
                getHotels: function(){
                    var self = this;
                    self.hotels = [];
                    
                    $.ajax({
                        url: '{{ URL::to("/") }}/hotel/all/' + this.region_id,
                        method: 'GET'
                    }).done(function(response){
                        var hotelList = JSON.parse(response);
                        console.log(hotelList);
                        for(var i in hotelList){
                            self.hotels.push({ id: hotelList[i].id, name: hotelList[i].name });
                        }
                    });
                }
            }
        });
    });
</script>
@endsection