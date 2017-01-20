@if (isset($breadcrumps))
<p class="breadcrumps">
	@php
		$reservation_type = session('reservation_type');
		$label = "";
		$label_url = "";

		switch($reservation_type){
			case 1:
				$label = "SERVICES";
				$label_url = "/select/services";
				break;
			case 2:
				$label = "CERTIFICATES";
				$label_url = "/select/certificates";
				break;
			case 3:
				$label = "WEDDINGS";
				$label_url = "/select/weddings";
				break;
		}

	@endphp
	
	<a href="{{ URL::to('/') }}"> HOME</a>
	<a href="{{ URL::to('/') . $label_url }}"> / {{ $label }}</a>
	@foreach($breadcrumps as $key => $value)
		<a href="{{ URL::to('/') . $value }}"> / {{ $key }}</a>
	@endforeach
</p>
@endif