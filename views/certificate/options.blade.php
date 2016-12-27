
@extends('layout/baseLayout')

@section('title', 'Regions')

@section("content")
<div id="vue-app" class="container-fluid">
	<div class="container">
		<h3>CERTIFICATE OPTIONS</h3>
		<hr>
		<form action="{{ URL::to('/') }}/certificate/check/option" method="POST">
			<div class="form-group">
				<label>A) What type of gifts are you interested in?</label>
				<p>Choose between value-based or service-based gift certificates</p>
			</div>
			<div class="col-md-3">
				<input type="radio" name="type" value="1" v-model='type' />  (No price will be shown)
			</div>
			<div class="col-md-3">
				<input type="radio" name="type" value="2" v-model='type' /> Value based
			</div>
			<div class="col-md-3">
				<input type="number" class="form-control" v-on:change='add_certificate()' v-model='quantity' name="quantity" /> How many?
			</div>
			<hr>
			<div v-if='type == 2' class="col-md-12">
				<div class="row">
					<div class="form-group">
						<label>B) Select your gifts</label>
						<p><strong>Valued-Based Gifts</strong><br/>Choose between value-based or service-based gift certificates</p>
					</div>
					<div class="clearfix"></div>
					<div v-for='certificate in value_based' class="col-md-12">
						<div class="col-md-3">
							Value certificate
						</div>
						<div class="col-md-3">
							USD
						</div>
						<div class="col-md-3">
							<select name="value[]" v-model='certificate.value'>
								<option selected value="0">Select a gift amount</option>
								<option value="50" >$ 50 + descuento</option>
								<option value="100" >$ 100 + descuento</option>
							</select>
						</div>	
					</div>
					
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
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
