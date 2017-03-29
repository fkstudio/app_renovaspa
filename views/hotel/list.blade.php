@extends('layout/baseLayout')

@section('title', 'Hotels')

@section("content")
<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr>
	<div class="row">
		@foreach($model as $hotelRegion)
		    @php
		    	$url = "";
			    
			    if ($reservationType == 2){
			    	$url = "/certificate/options/".$hotelRegion->Hotel->Id;
			    }
			    else {
			    	$url = "/hotel/".$hotelRegion->Hotel->Id."/categories";
			    }

			    $countryName = strtolower(str_replace(' ', '-', $hotelRegion->Region->Country->Name));
                $regionName = strtolower(str_replace(' ', '-', $hotelRegion->Region->Name));
                $hotelName = str_replace(' ', '-', $hotelRegion->Hotel->Name);

                $folderPath = '/images/hotels/'.$countryName .'/'. $regionName .'/'.$hotelName;
			    
			    $photoPath = '/noimage.jpg';

				if($region->Photo != null)
				{
					$photoPath = '/hotels/hotel-'.$hotelRegion->Hotel->Id.'/'.$hotelRegion->Hotel->getProfile();
				}
		    @endphp

	    <a style="font-size: 30px;color:white;" href="{{ URL::to('/').$url }}">
		    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" style="overflow: hidden;
		    														 margin-bottom: 20px;">
		    	<div style="background: url({{ URL::to('/') . $folderPath }}/photo-1.jpg);background-size: cover;" class="col-md-12 block-content" >
					<span>{{ $hotelRegion->Hotel->Name }}</span>
				</div>
		    </div>
		</a>
	    @endforeach
	</div>
</div>
@endsection

    