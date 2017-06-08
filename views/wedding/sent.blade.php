@extends('layout/baseLayout')

@section('title', 'The wedding quotation has been sent')

@section("content")
	<div class="container-fluid-full" style="background: url({{ URL::to('/')  }}/images/wedding_cover.jpg);
										     background-size: cover;
											 height: 540px;">
	</div>
	<br/>
	<div class="container-fluid">
		<div class="container">
			<div class="col-md-12">
				<p style="font-size: 18px;">
				{{ trans('messages.wedding_quotation_sent') }}
				</p>
			</div>
		</div>
		<br/>
		<div style="clear: both;"></div>
    	<p style="text-align: center;"><a href="{{ URL::to('/') }}">GO TO HOME</a></p>
	</div>
@endsection


	