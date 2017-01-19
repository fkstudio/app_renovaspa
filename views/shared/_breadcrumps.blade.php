@if (isset($breadcrumps))
<p class="breadcrumps">
	<a href="{{ URL::to('/') }}"> HOME</a>
	@foreach($breadcrumps as $key => $value)
		<a href="{{ URL::to('/') }}{{ $value }}"> / {{ $key }}</a>
	@endforeach
</p>
@endif