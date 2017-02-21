@inject("dbcontext", "App\Database\DbContext")


<nav class="navbar top-menu">
  <div class="container-fluid">
    <div class="collapse navbar-collapse navbar-right" id="navbar">
        <ul class="nav navbar-nav">
          <li><a>info@renovaspa.com</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.lang') }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/') }}/setlang/es">{{ trans('navbar.es') }}</a></li>
              <li><a href="{{ url('/') }}/setlang/en">{{ trans('navbar.en') }}</a></li>
            </ul>
          </li>
        </ul>
      </div>
  </div>
</nav>
<nav class="navbar navbar-default"  data-spy="affix" data-offset-top="36" style="margin-bottom: {{ (isset($margin) ? '-110px' : '0' ) }} !important;">
  <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="navbar" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">
          <img class="img-responsive" style="margin-top: -17px;" src="{{ URL::to('/') }}/images/logo-white-bg.png">
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-right" id="navbar">
        <ul class="nav navbar-nav">
          <li><a href="{{ route('home.home') }}">{{ trans('navbar.home') }} <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.destinations') }}</a>
            

            <ul class="dropdown-menu">
              @foreach($dbcontext->getEntityManager()->getRepository("App\Models\Test\CountryModel")->findAll() as $country)

                <li class="dropdown-submenu">
                <a class="dropdown-action" tabindex="-1" href="#">{{ $country->Name }}</a>
                <ul class="dropdown-menu dropdown-hide">
                  @foreach($country->Regions as $region)
                    <li class="dropdown-submenu">
                      <a href="#">{{ $region->Name }}</a>
                      <ul class="dropdown-menu">
                        @foreach($region->HotelRegions as $hotelRegion)
                          <li><a href="{{ URL::to('/') }}/hotel/details/{{ $hotelRegion->Hotel->Id }}" tabindex="-1" class="dropdown-submenu-item">{{ $hotelRegion->Hotel->Name }}</a></li>
                        @endforeach
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </li>
              @endforeach
              </ul>
          </li>
          <li><a href="{{ URL::to('/') }}/select/services">{{ trans('navbar.bookhere') }}</a></li>
          <li><a href="{{ URL::to('/') }}/select/certificates">{{ trans('navbar.gift_certificates') }}</a></li>
          <li class="dropdown">
            <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.weddings') }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ URL::to('/') }}/select/weddings">{{ trans('navbar.the_day') }}</a></li>
              <li><a href="#">{{ trans('navbar.faqs') }}</a></li>
            </ul>
          </li>
          <li><a href="{{ route('home.about') }}">{{ trans('navbar.about_us') }}</a></li>
          <li><a href="#">{{ trans('navbar.contact_us') }}</a></li>
        </ul>
      </div>

      <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@if (isset($categories))
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse navbar-right" id="navbar">
        <ul class="nav navbar-nav">
          @if(session('reservation_type') == 3)
          <li><a href="{{ URL::to('/') }}/wedding/services">RENOVA WEDDING PACKAGE</a></li>
          @endif
          @foreach($categories as $categoryRegion)
          <li><a href="{{ URL::to('/') }}/category/{{ $categoryRegion->Category->Id }}/services">{{ $categoryRegion->Category->Name }}</a></li>
          @endforeach
        </ul>
      </div>
  </div>
</nav>
@endif

