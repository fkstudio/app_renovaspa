@if(isset($mycart))
<!-- Modal -->
<div id="shoppingCartModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('titles.my_cart_title') }}</h4>
      </div>
      <div class="modal-body">
        @php
          $subtotal = 0;
          $total = 0;
        @endphp

        @foreach($mycart->Items as $item)
          <!-- individual services -->
          @if($item->Service != null && $item->CertificateNumber == null)
            <div class="col-md-3">
              <img style="max-width: 80px;" src="{{ URL::to('/') }}/images/services/collagen-puls-facial.jpg" class="img-responsive" /> 
            </div>
            <div class="col-md-9">
              <h5>{{ $item->Service->Name }}</h5>
              {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )
              <br/>
              @php
                $itemPrice = $item->Service->getPrice(session('hotel_id'));

                $subtotal += $item->Service->getPlanePrice(session('hotel_id'));
                $total += $itemPrice;
              @endphp
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemPrice, 2) }} {{ $country->Currency->Name }}</span>
            </div>
            <div class="clearfix"></div>
            <br/>
          <!-- Certificate services -->
          @elseif($item->CertificateNumber != null)
            <div class="col-md-3">
              <img style="max-width: 80px;" src="{{ URL::to('/') }}/images/services/collagen-puls-facial.jpg" class="img-responsive" /> 
            </div>
            <div class="col-md-9">
              <h5>{{ $item->Service->Name }} - Certificate #{{ $item->CertificateNumber }}</h5>
              {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )
              <br/>
              @php
                $itemPrice = $item->Service->getPrice(session('hotel_id'));

                $subtotal += $item->Service->getPlanePrice(session('hotel_id'));
                $total += $itemPrice;
              @endphp
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($item->Service->getPrice(session('hotel_id')), 2) }} {{ $country->Currency->Name }}</span>
            </div>
            <div class="clearfix"></div>
            <br/>
          <!-- wedding packages -->
          @else
            @php
              $packageRelation = $item->PackageCategoryRelation;
              $itemPrice = $packageRelation->getPrice();
            @endphp

            <div class="col-md-3">
              <img style="max-width: 80px;" src="{{ URL::to('/') }}/images/wedding_package_icon.png" class="img-responsive" /> 
            </div>
            <div class="col-md-9">
              <h5>{{ $packageRelation->WeddingPackage->Name }}</h5>
              
              @foreach($packageRelation->WeddingPackage->WeddingPackageServices as $packageService)
                @php
                  $subtotal += $itemPrice;
                  $total += $itemPrice;
                @endphp
              @endforeach
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemPrice, 2) }} {{ $country->Currency->Name }}</span>
            </div>

            <div class="clearfix"></div>
            <br/>
          @endif
      @endforeach
      <div class="clearfix"></div>
      <hr/>
      <table class="table table-borderless">
        <h4>{{ trans('titles.cart_total') }}</h4>
        <tbody style="font-size: 15px;">
          <tr>
            <td>Subtotal</td>
            <td>{{ $country->Currency->Symbol }}{{ number_format($subtotal, 2) }}</td>
          </tr>
          @if ($hotel_region->ActiveDiscount)
          <tr>
            <td><span style="font-size: 15px;font-weight: bold;" class="discount">-{{ $hotel_region->Discount }}% {{ trans('shared.online_discount_available') }}</span></td>
          </tr>
          @endif
          <tr>
            <td><strong>Total</strong></td>
            <td><strong>{{ $country->Currency->Symbol }}{{ number_format($total, 2) }}</strong></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <a href="{{ URL::to('/') }}/shopping/cart" class="btn btn-default" >{{ trans('shared.go_to_cart') }}</a>
        <a href="{{ URL::to('/') }}/shopping/cart/checkout" class="btn btn-primary" >{{ trans('shared.checkout') }}</a>
      </div>
    </div>

  </div>
</div>
@endif