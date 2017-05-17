@extends('layout/baseLayout')

@section('title', 'The wedding quotation has been sent')

@section("content")
	<div class="container-fluid">
		<div class="container">
			<p class="message-alert success">{{ trans('messages.wedding_quotation_sent') }}</p>
		</div>
		<div style="clear: both;"></div>
    	<p style="text-align: center;"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
	</div>
@endsection


	