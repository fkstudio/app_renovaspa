@php
  $reservationType = session('reservation_type');
@endphp
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

        @if(count($mycart->Items) <= 0)
        <p style="text-align: center;">{{ trans('messages.there_is_no_items_in_cart') }}</p>
        @endif

        @foreach($mycart->Items as $item)

          <!-- individual services -->
          @if($item->Service != null && $item->CertificateNumber == null)
            <div class="col-md-3">
              <img style="max-width: 80px;" src="{{ config('app.admin_url') . '/images/categories/' . $item->Category->Photo->Path }}" class="img-responsive" /> 
            </div>
            <div class="col-md-8">
              <h5>{{ $item->Service->Name }}</h5>
              {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )
              <br/>
              @php
                $itemPrice = $item->Service->getPrice(session('hotel_id'));
                $itemPlanePrice = $item->Service->getPlanePrice(session('hotel_id'));
                $subtotal += $itemPlanePrice;
                $total += $itemPrice;
              @endphp
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemPlanePrice, 2) }} {{ $country->Currency->Name }}</span>
              <br/>
              <?php /*<span>{{ trans('shared.final_price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemPrice, 2) }} {{ $country->Currency->Name }}</span> */ ?>
            </div>
            <div class="col-md-1">
              <a style="margin-top: 20px" href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
            </div>
            <div class="clearfix"></div>
            <br/>
          <!-- Certificate services -->
          @elseif($item->CertificateNumber != null)

            <div class="col-md-3">
              <img style="max-width: 80px;" src="{{ URL::to('/images') . $item->Category->Photo->Path }}" class="img-responsive" /> 
            </div>
            <div class="col-md-8">
              <h5>
              {{ ( $item->Service != null ? $item->Service->Name . ' - ' : '' ) }} Certificate #{{ $item->CertificateNumber }}
              </h5>
              @if($item->Service != null)
              {{ trans("shared.cabin_type") }} ( {{ $item->Service->Cabin->Name }} )
              @else
              ( Value based )
              @endif
              <br/>
              @php
                if($item->Service != null){
                  $itemPrice = $item->Service->getPrice(session('hotel_id'));

                  $subtotal += $item->Service->getPlanePrice(session('hotel_id'));
                  $total += $itemPrice;
                }
                else {
                  $itemPrice = $item->Value;

                  $subtotal += $item->Value;
                  $total += $itemPrice;
                }
              @endphp
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemPrice, 2) }} {{ $country->Currency->Name }}</span>
            </div>
            <div class="col-md-1">
              <a style="margin-top: 20px" href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
            </div>
            <div class="clearfix"></div>
            <br/>
          <!-- wedding packages -->
          @else
            @php
              $packageRelation = $item->PackageCategoryRelation;
              $itemPrice = $packageRelation->getPrice();
              $itemSubTotal = $packageRelation->getPlanePrice();
            @endphp

            <div class="col-md-3">
              <img style="max-width: 80px;margin-left: 15px;" src="{{ URL::to('/') }}/images/wedding_package_icon.png" class="img-responsive" /> 
            </div>
            <div class="col-md-8">
              <h5>{{ $packageRelation->WeddingPackage->Name }}</h5>
              
              @php
                $subtotal += $itemSubTotal;
                $total += $itemPrice;
              @endphp
              <span>{{ trans('shared.price') }}: {{ $country->Currency->Symbol }}{{ number_format($itemSubTotal, 2) }} {{ $country->Currency->Name }}</span>
            </div>
            <div class="col-md-1">
              <a style="margin-top: 20px" href="{{ URL::to('/') }}/shopping/cart/remove/item/{{ $item->Id }}" type="button" class="btn btn-danger">X</a>
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
        @if ($reservationType == 1 || $reservationType == 3 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == true)
        <a href="{{ URL::to('/shopping/cart') }}" class="btn btn-default">{{ trans('shared.go_to_cart') }}</a>
        @elseif ($reservationType == 1 || session('current_certificate') >= session('certificate_quantity') && session('can_go_to_cart') == false)
        <a href="#fakelink" class="disabled btn btn-default">{{ trans('shared.complete_to_go_cart') }}</a>
        @else
        <a href="{{ URL::to('/') }}/hotel/{{ $hotel->Id }}/categories/{{ session('current_certificate') + 1 }}" class="btn btn-default">{{ trans('shared.go_to_next_certificate') }}</a>
        @endif

        @if ($reservationType == 1 || $reservationType == 3) 
          @if ($total > 0 || $reservationType == 3)
            <a href="{{ URL::to('/') }}/shopping/cart/checkout" class="btn btn-primary" >{{ trans('shared.checkout') }}</a>
          @else
            <a href="#fakelink" class="disabled btn btn-primary" >{{ trans('shared.checkout') }}</a>
          @endif

        @elseif ($reservationType == 2)
          @if ($total > 0)
            <a href="{{ URL::to('/') }}/certificate/registration" class="btn btn-primary" >{{ trans('shared.go_to_gift_registration') }}</a>
          @else
            <a href="#fakelink" class="disabled btn btn-primary" >{{ trans('shared.go_to_gift_registration') }}</a>
          @endif
        @endif
      </div>
    </div>

  </div>
</div>
@endif