@extends('layout/baseLayout')

@section('title', 'The transaction has been canceled')

@section("content")
	<div class="container-fluid">
		<div class="container">
			<p class="message-alert failure">{{ trans('messages.transaction_canceled') }}</p>
		</div>
	</div>
@endsection


	