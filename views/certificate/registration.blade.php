
@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div id="vue-app" class="container-fluid">
	<div class="container">
		<h3>GIFT CERTIFICATE REGISTRATION</h3>
		<hr>
		<form action="{{ URL::to('/') }}/reservation/checkout" method="POST">
			<div class="form-group">
				<label>A) Who will receive this gift certificate?</label>
			</div>
			<div class="form-group">
				<label>First name</label>
				<input type="text" class="form-control" name="first_name" />
			</div>
			<div class="form-group">
				<label>Last name</label>
				<input type="text" class="form-control" name="last_name" />
			</div>
			<hr>
			<div class="form-group">
				<label>B) Personalize by adding a message:</label>
			</div>
			@foreach($model as $key => $item)
			<h3>Certificate #{{ $key }}</h3>
			<hr>
				@foreach($item as $service)
				<p><strong>Service based value:</strong> {{ $service['quantity'] .' '. $service['name'] }}</p>
				@endforeach
			<hr>
			<div class="form-group">
				<input type="hidden" class="form-control" name="certificate_number[{{ $key }}]" value="{{ $key }}" />
			</div>
			<div class="form-group">
				<label> To (as it will appear on the gift certificate):</label>
				<input type="text" class="form-control" name="to_customer[{{ $key }}]" />
			</div>
			<div class="form-group">
				<label>* From (as it will appear on the gift certificate):</label>
				<input type="text" class="form-control" name="from_customer[{{ $key }}]" />
			</div>
			<div class="form-group">
				<label>Enter a message</label>
				<textarea  name="message[{{ $key }}]" class="form-control"></textarea>
			</div>
			<div class="col-md-3">
				<input type="radio" name="sendType[{{ $key }}]" value=1 > Email
			</div>
			<div class="col-md-3">
				<input type="radio" name="sendType[{{ $key }}]" value=2 > Print
			</div>
			<div class="col-md-3">
				<input type="radio" name="sendType[{{ $key }}]" value=3 > Hotel
			</div>
			<div class="clearfix"></div>
			<hr>
			@endforeach
			<div class="col-md-3">
				{{ csrf_field() }}
				<button type="submit" class="btn btn-primary">CONTINUE</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/js') }}/vuejs.js"></script>
<script>
    $(document).ready(function(){
        var vue = new Vue({
            el: '#vue-app',
            data: {
               quantity: 0,
               type: 1,
               value_based: [ ]
            },
            ready: function(){
            },
            computed: {

            },
            methods: {
                add_certificate(){
                	this.value_based = [];
                	for($i = 1; $i <= this.quantity; $i++){
                		this.value_based.push({ value: 0 });
                	}
                }
            }
        });
    });
</script>
@endsection

