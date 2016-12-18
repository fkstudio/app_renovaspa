@inject("dbcontext", "App\Database\DbContext")

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Renovaspa</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id=navbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ route('home.home') }}">{{ trans('navbar.home') }} <span class="sr-only">(current)</span></a></li>
        <li><a href="#">{{ trans('navbar.bookhere') }}</a></li>
        <li><a href="#">{{ trans('navbar.gift_certificates') }}</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.weddings') }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">{{ trans('navbar.the_day') }}</a></li>
            <li><a href="#">{{ trans('navbar.faqs') }}</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.destinations') }} <span class="caret"></span></a>
            <ul class="dropdown-menu" style="width: 300px"> 
              @foreach($dbcontext->getEntityManager()->getRepository("App\Models\CountryModel")->findAll() as $country)
              <li class="dropdown-submenu">
                <a href="#fakelink" tabindex="-1" class="dropdown-submenu-item">{{ $country->Name }} <span class="caret"></span></a>
                <ul class="dropdown-submenu">
                  @foreach($country->Regions as $region)
                    <a href="#fakelink" tabindex="-1" class="dropdown-submenu-item">{{ $region->Name }} <span class="caret"></span></a>
                    <ul class="dropdown-submenu">
                      @foreach($region->Hotels as $hotel)

                        <li><a href="{{ route('hotel.details', [ 'id' => $hotel->Id ]) }}">{{ $hotel->Name }}</a></li>

                      @endforeach
                    </ul>
                  @endforeach
                </ul>
              </li>
              @endforeach 
            </ul>
        </li>
        <li><a href="#">{{ trans('navbar.about_us') }}</a></li>
        <li><a href="#">{{ trans('navbar.contact_us') }}</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('navbar.lang') }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/setlang/es') }}">{{ trans('navbar.es') }}</a></li>
            <li><a href="{{ url('/setlang/en') }}">{{ trans('navbar.en') }}</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
