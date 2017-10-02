@extends('layout/baseLayout')

@section('title', 'The transaction has been canceled')

@section("content")
	<div class="container-fluid">
		<div class="container">
			@if(session('reservation_type') != 3)
			<p class="message-alert failure">{{ trans('messages.transaction_canceled') }}</p>
			@else
			<p class="message-alert failure">{{ trans('messages.wedding_canceled') }}</p>
			@endif
		</div>
	</div>
@endsection


	