@inject("dbcontext", "App\Database\DbContext")
@php
  $subtotal = 0;
  $total = 0;

  $hotel_id = $model->Hotel->Id;
  $hotel_region = $dbcontext->getEntityManager()->getRepository("App\Models\Test\HotelRegionModel")->findOneBy([ 'Hotel' => $hotel_id, 'Region' => $model->Region->Id ]);
@endphp

<div id="container" style="color: #7f7f7f !important;width:80%;margin:0 auto;">
        <div class="col-md-12" style="margin-bottom: -20px;">
          <img src="{{ URL::to('/images') }}/quotation_header.jpg" style="width: 100%;" />
        </div>
        <h3 style="background: #5fc7ae;
        padding: 15px;
        color: white;
        font-size: 20px;
        text-align: center;">{{ trans('titles.wedding_reservation') }}</h3>
        <br/>
        <h3 style="font-family: inherit;
font-weight: 500;
font-size: 24px;
line-height: 1.1;
color: inherit">Personal information</h3>
        <hr style="margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee" />
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">First name</label>
            <br>
            {{ $model->CertificateFirstName }}
          </div>
        </div>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Last name</label>
            <br>
            {{ $model->CertificateLastName }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <div style="width: 100%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">E-mail</label>
            <br>
            {{ $model->Email }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <br/>
        <h3 style="font-family: inherit;
font-weight: 500;
font-size: 24px;
line-height: 1.1;
color: inherit">Couple information</h3>
        <hr style="margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee" />
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Bride</label>
            <br>
            {{ $model->BrideName }}
          </div>
        </div>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Groom</label>
            <br>
            {{ $model->GroomName }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <br/>
        <h3 style="font-family: inherit;
font-weight: 500;
font-size: 24px;
line-height: 1.1;
color: inherit">Reservation information</h3>
        <hr style="margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee" />
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Country</label>
            <br>
            {{ $model->Region->Country->Name }}
          </div>
        </div>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Destionation</label>
            <br>
            {{ $model->Region->Name }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <div style="width: 100%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">Hotel</label>
            <br>
            {{ $model->Hotel->Name }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">{{ trans('shared.arrival') }}</label>
            <br>
            {{ $model->Arrival->format('F j, Y') }}
          </div>
        </div>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">{{ trans('shared.departure') }}</label>
            <br>
             {{ $model->Departure->format('F j, Y') }}
          </div>
        </div>
        <div style="clear: both"></div>
        <br/>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">{{ trans('shared.wedding_date') }}</label>
            <br>
            {{ $model->WeddingDate->format('F j, Y') }}
          </div>
        </div>
        <div style="width: 25%;float:left;" >
          <div class="form-group">
            <label style="display: inline-block;
max-width: 100%;
margin-bottom: 5px;
font-weight: 700">{{ trans('shared.wedding_time') }}</label>
            <br>
             {{ $model->WeddingTime->format('h:m a') }}
          </div>
        </div>
        <div style="clear: both;"></div>
        <div style="clear: both;"></div>
        <h3 style="background: #5fc7ae;
        padding: 15px;
        color: white;
        font-size: 20px;
        text-align: center;">QUOTATION</h3>
        <h3 style="font-family: inherit;
font-weight: 500;
font-size: 24px;
line-height: 1.1;
color: inherit">Services's information</h3>
        <hr style="margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee" />

        @foreach($cart->Items as $item)
      @php
        $packageRelation = $item->PackageCategoryRelation;
      @endphp
      @if($item->Service != null)
        @php
          $subtotal += $item->Service->getPlanePrice($model->Hotel->Id);
          $total += $item->Service->getPrice($model->Hotel->Id);
        @endphp
        <div>
              <h5>1 {{ $item->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )</h5>
              <span>{{ trans('checkout.booked_to') }} {{ ($item->PreferedDate != null ? $item->PreferedDate->format('F j, Y') : "Open date") }} {{ trans('checkout.at_time') }} {{ ($item->PreferedTime != null ? $item->PreferedTime->format('h:m a') : "Open time") }}, {{ $item->CustomerName }}</span>
          @if($item->Service->hasDiscount($hotel_id))
          @php
            $discount = $item->Service->getDiscount($hotel_id)
          @endphp
          <br>
                <span style="color: #5fc7ae;font-size: 12px;">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
          @endif

          @if ($item->Service->hasHotelDiscount($hotel_id))
          <br>
                <span style="color: #5fc7ae;font-size: 12px;">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
          @elseif ($hotel_region->ActiveDiscount)
          <br>
                <span style="text-decoration: line-through;
                 color: #dc5046;
                 font-size:12px;">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount') }}</span>
          @endif

              <br/>
              <span>{{ trans('shared.price') }}: {{ $model->Region->Country->Currency->Symbol.number_format($item->Service->getPlanePrice($hotel_id), 2) }}</span>
              <br>
              <?php /* <span>{{ trans('shared.final_price') }}: <strong>{{ $model->Region->Country->Currency->Symbol.number_format($item->Service->getPrice($hotel_id), 2) }}</strong></span> */ ?>
            </div>
        <div style="clear: both;"></div>
        <hr style="margin-top: 20px;
                 margin-bottom: 20px;
                 border: 0;
                 border-top: 1px solid #eee" />
      @else
        @php
          $packages = session('packages');
          $data = null;

          $weddingPackage = $packageRelation->WeddingPackage;

          if($packages != null){
            $data = $packages[$packageRelation->WeddingPackage->Id];
          }

          $subtotal += $packageRelation->getPlanePrice();
          $total += $packageRelation->getPrice();
        @endphp
        <div>
              <h5 style="margin-top: 10px;margin-bottom: 10px">{{ $weddingPackage->Name }}</h5>
              @if($packageRelation->ActiveDiscount)
                @php
                  $discount = $packageRelation->Discount;
                @endphp
                <span style="color: #5fc7ae;font-size: 12px;">{{ "-".$discount. "% ".trans('shared.discount') }}</span>
                <br/>
              @endif
              <span>{{ trans('shared.price') }}: {{ $model->Region->Country->Currency->Symbol.number_format($packageRelation->getPlanePrice(), 2) }}</span>
              <br>
              <?php /* <span>{{ trans('shared.final_price') }}: <strong>{{ $model->Region->Country->Currency->Symbol.number_format($packageRelation->getPrice(), 2) }}</strong></span> */ ?>
              <ul style="list-style: none;">
                @foreach($weddingPackage->WeddingPackageFeatures as $feature)
          <li>{{ $feature->Description }}</li>
          @endforeach  
          @foreach($packageRelation->WeddingPackage->WeddingPackageServices as $key => $packageService)
            <li>
                    <div>
                      <h5 style="margin-top: 10px;margin-bottom: 10px">1  {{ $packageService->Service->Name }} - {{ trans("shared.cabin_type") }} ( {{ $packageService->Service->Cabin->Name }} )</h5>
                      <span>{{ trans('checkout.booked_to') }} {{ ($data != null &&$data[$key]['prefered_date'] != null ? $data[$key]['prefered_date']->format('F j, Y') : "Open date") }} {{ trans('checkout.at_time') }} {{ ($data != null && $data[$key]['prefered_time'] != null ? $data[$key]['prefered_time']->format('h:m a') : "Open time") }}, {{ $data[$key]['customer_name'] }}</span>
                    </div>
                  </li>
          @endforeach
              </ul>
            </div>
        <div style="clear: both;"></div>
        <hr style="margin-top: 20px;
                   margin-bottom: 20px;
                   border: 0;
                   border-top: 1px solid #eee" />
      @endif
    @endforeach
        <h3 style="font-family: inherit;
                  font-weight: 500;
                  font-size: 24px;
                  line-height: 1.1;
                  color: inherit">CART TOTAL</h3>
        <table style="font-size: 20px;width: 100%;">
            <tbody>
              <tr>
                <td>Subtotal</td>
                <td><span style="float:right;">{{ $model->Region->Country->Currency->Symbol }}{{ $subtotal }}</span></td>
              </tr>
              @if ($hotel_region->ActiveDiscount)
        <tr>
        <td>
        <span style="font-size: 15px;font-weight: bold;color: #5fc7ae;font-size: 12px;">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
        </tr>
        @endif
              <tr>
                <td><strong>Total</strong></td>
                <td><strong style="float:right;">{{ $model->Region->Country->Currency->Symbol }}{{ $total }}</strong></td>
              </tr>
            </tbody>
        </table>
        <hr style="margin-top: 20px;
                   margin-bottom: 20px;
                   border: 0;
                   border-top: 1px solid #eee" />
        <p style="color: red;"><strong>50% down payment will be required by the wedding concierge in order to confirm this reservation once this request has been checked out and approved within the next 24 hours For any questions, please, contact: info@renovaspa.com</strong></p>
        <h3 style="font-family: inherit;
                   font-weight: 500;
                   font-size: 24px;
                   line-height: 1.1;
                   color: inherit">Payment information</h3>
        <div style="clear: both;"></div>
        @include('shared._messages')
        <hr style="margin-top: 20px;
                   margin-bottom: 20px;
                   border: 0;
                   border-top: 1px solid #eee" />
        @php
      $delivery = $model->WeddingBillDelivery;
    @endphp
        @if($delivery == 2)
    <p>Send one bill including all the services.</p>
    @elseif ($delivery == 3)
    <p>Send one bill including the wedding couples services and other for each person of the wedding party</p>
    @else 
    <p>Send separate bills for each person.</p>
    @endif
        <label style="display: inline-block;
                      max-width: 100%;
                      margin-bottom: 5px;
                      font-weight: 700">Remarks</label>
        <br/>
        <p>{{ $model->Remarks }}</p>
        <hr style="margin-top: 20px;
                   margin-bottom: 20px;
                   border: 0;
                   border-top: 1px solid #eee" />
    </div>
    <div style="clear: both;"></div>
    <p style="text-align: center;"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>