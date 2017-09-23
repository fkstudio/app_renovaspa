@extends('layout/baseLayout')

@section('title', $model->Name)

@section('content')
<!-- services and prices modal -->
<div id="servicesAndPricesModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 700px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">SERVICES AND PRICES</h4>
            </div>
            <div class="modal-body">
                @foreach($categoryCountries as $categoryCountry)
                    <div class="text-center">
                        <a href="#fakelink" style="cursor: pointer;" data-toggle="collapse" data-target="#category_collapse_{{ $categoryCountry->Category->Id }}">{{ $categoryCountry->Category->Name }}</a>
                    </div>

                    <div id="category_collapse_{{ $categoryCountry->Category->Id }}" class="collapse">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Duración</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categoryCountry->Category->IsDeleted != true && $categoryCountry->Category->IsActive == true)
                                    @foreach($categoryCountry->ServiceCategoryHotels as $serviceCategoryHotel)
                                        @if($serviceCategoryHotel->Service->IsActive == true && $serviceCategoryHotel->Service->IsDeleted == false)
                                        <tr>
                                            <td>{{ $serviceCategoryHotel->Service->Name }}</td>
                                            <td>{{ ( $serviceCategoryHotel->ServiceInformation != null ? $serviceCategoryHotel->ServiceInformation->Duration : '') }}</td>
                                            <td>{{ $region->Country->Currency->Symbol.number_format($serviceCategoryHotel->Service->getPlanePrice($serviceCategoryHotel->Hotel->Id), 2) }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                @endforeach
            </div>
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
                <p style="line-height: 25px;text-align: center;">
                    "Your traveling dates inform us when to expect you at the selected destination. You can make use of your reservations at any date between your arrival and your departure dates. Please consider the following: if your arrival date is within the following 48 hours, we invite you to make your reservations with and open date and time and confirm the appointment at the spa upon arrival to the hotel."
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('shared._breadcrumps')
    <hr/>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <!-- Top part of the slider -->
            <div class="row">
                <div class="col-lg-12 col-sm-12" id="carousel-bounding-box">
                    <div class="carousel slide" id="hotel-carousel">        
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            @php
                                $showActive = true;
                            @endphp
                            <!-- Carousel items -->
                            @foreach($model->Photos as $key => $photo)
                                    @php
                                      $active = ($showActive ? 'active' : '');
                                    @endphp
                                    <div  class="{{ $active }} item" data-slide-number="{{ $key }}">
                                        <img src="{{ config("app.admin_url") .'/images/hotels/'. $photo->Path }}">
                                    </div>
                                    @php
                                        $showActive = false;
                                    @endphp
                            @endforeach
                        </div>
                        <!-- Carousel nav -->
                        <a class="left carousel-control" href="#hotel-carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#hotel-carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row visible-lg">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    @foreach($model->Photos as $key => $photo)
                            @php

                            $active = ($key == 0 ? 'active' : '');

                            @endphp
                            <li class="col-lg-4 col-sm-3 col-xs-4">
                                <a style="background: url({{ config("app.admin_url") .'/images/hotels/' . $photo->Path }});background-size: cover;background-position: center center;" class="thumbnail thumbnail-carousel" id="carousel-selector-{{ $key }}">
                                    <!-- <img src=""> -->
                                </a>
                            </li>
                    @endforeach
                </ul>   
            </div>
        </div>
        <div class="clearfix hidden-lg hidden-md"></div>
        <br class="hidden-lg hidden-md" />
        <div class="col-lg-6 col-md-6">
            <h2 class="details-hotel-title">{{ $model->Name }}</h2>
            <div class="clearfix"></div>
            <div class="under-title-line"></div>
            <span><a href="#fakelink" data-toggle="modal" data-target="#servicesAndPricesModal">SERVICES AND PRICES</a></span>
            <div class="clearfix"></div>
            <br/>
            <p><strong>{{ trans("hotel.address") }}</strong>: {!! $model->Address !!}<br/>
               <strong>{{ trans("hotel.hours") }}</strong>: {{ date('h:i a', strtotime($model->OpenAt->format("H:i a"))) }} - {{  date('h:i a', strtotime($model->ClosetAt->format("H:i"))) }}</p>
            @if (empty($model->Description))
            <p>No description to show</p>
            @else
            <span style="font-size: 12px;">
            {!! $model->Description !!}
            </span>
            @endif
        </div>
    </div>
</div>  
<div class="clearfix"></div>
<br/>
<br/>
<div class="container-fluid-full" id="form-content" style="background: #F5F5F5;">
    <br/>
    <div class="container-fluid">
        
        <form action="{{ URL::to('/') }}/reservation/select/book" method="POST" class="form-inline text-center">
            <h2 style="color: #5fc7ae;" class="text-center">
            Choose: <input type="radio" checked value="1" name="reservation_type">  Book your treatment  <input type="radio" value="2" name="reservation_type"> Gift Certificate
            </h2>
            <br/>
            <div class="col-lg-2 col-md-12 col-sm-12">
                <label class="custom-label">{{ trans('shared.country') }}</label>
                <div class="clearfix"></div>
                <select id='country_id' name="country_id" v-on:change='getRegions()' class="form-control custom-select">
                    <option selected value="{{ $region->Country->Id }}">{{ $region->Country->Name }}</option>
                </select>
            </div>

            <div class="clearfix hidden-lg"></div>
            <br class="hidden-lg" />

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                <label class="custom-label">{{ trans('shared.destination') }}</label>
                <div class="clearfix"></div>
                <select id="region_id" name='region_id' class="form-control custom-select">
                    <option selected value="{{ $region->Id }}">{{ $region->Name }}</option>
                </select>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                <label class="custom-label">{{ trans('shared.hotel') }}</label>
                <div class="clearfix"></div>
                <select id="hotel_id" name='hotel_id' class="form-control custom-select">
                    <option selected value="{{ $model->Id }}">{{ $model->Name }}</option>
                </select>
            </div>

            <div class="clearfix hidden-lg"></div>
            <br class="hidden-lg" />

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <label class="custom-label">
                    *{{ trans('shared.arrival') }} - *{{ trans('shared.departure') }} 
                </label>
                <div class="clearfix"></div>
                <input type="text" id="arrival" name='arrival_departure' class="datepicker form-control custom-select" />
            </div>  

            <div class="clearfix hidden-lg"></div>
            <br class="hidden-lg" />

            <div class="col-lg-2">
                <label class="custom-label"></label>
                <div class="clearfix"></div>
                {{ csrf_field() }}
                
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
<div class="clearfix"></div>
@endsection

@section('scripts')
<!-- lighbox -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>

<!-- Moment JS-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
$(document).ready(function($) {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $(function() {
        var date = $('.datepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
              format: 'MM/DD/YYYY'
            },
            minDate: moment(),
        });

        date.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
    });
 
    $('#hotel-carousel').carousel({
            interval: 5000
    });

    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            $('#hotel-carousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
    // When the carousel slides, auto update the text
    $('#hotel-carousel').on('slid.bs.carousel', function (e) {
             var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
    });
});
</script>
@endsection