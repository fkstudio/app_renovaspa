@if (isset($breadcrumps))
<p class="breadcrumps">
	@php
		$reservation_type = session('reservation_type');
		$label = "";
		$label_url = "";

		switch($reservation_type){
			case 1:
				$label = "SERVICES";
				$label_url = "/services";
				break;
			case 2:
				$label = "CERTIFICATES";
				$label_url = "/certificates";
				break;
			case 3:
				$label = "WEDDINGS";
				$label_url = "/weddings";
				break;
		}

	@endphp
	
	<a href="{{ URL::to('/') }}"> HOME</a>
	<a href="{{ URL::to('/') . $label_url }}"> {{ ( $label != null ? ' / '.$label : '') }}</a>
	@foreach($breadcrumps as $key => $value)
		@php
			if($value == "#fakelink")
				$newUrl = "#fakelink";
			else
				$newUrl = URL::to('/') . $value;
		@endphp
		<a href="{{ $newUrl }}"> / {{ $key }}</a>
	@endforeach
</p>
@endif