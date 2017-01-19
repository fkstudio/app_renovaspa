	@extends('layout/baseLayout')

	@section('title', 'Checkout')

	@section("content")
		<div class="container-fluid">
			@include('shared._breadcrumps')
			<hr/>
			<h3>CHECKOUT ITEMS</h3>
			<hr>
			<div class="row">
				<br/>
				<div class="col-md-12">
				    @if (session('status'))
					<p>{{ session('status') }}</p>
					@endif
					<form action="{{ URL::to('/') }}/reservation/checkout" method="post">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Service</th>
									<th>Customer name</th>
									<th>Prefered date</th>
									<th>Prefered time</th>
									<th>Cabin type</th>
								</tr>
							</thead>
							<tbody>
								@foreach($model->Items as $item)
									@for($i = 0; $i < $item->Quantity; $i++)
										<tr>
											<td>
												<input type="hidden" name="id[]" value="{{ $item->Service->Id }}" /> 
												{{ $item->Service->Name }}
											</td>
											<td>
												<input type="text" name="customer_name[]" placeholder="Ej. Jhon Doe" class="form-control" value="" />
											</td>
											<td>
												<input type="date" name="prefered_date[]" class="datepicker form-control" />
											</td>
											<td>
												<input type="time" name="prefered_time[]" class="datepicker form-control" />
											</td>
											
											<td>
												<select class="form-control" name="cabin_type[]">
													@foreach($cabins as $cabin)
													<option value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
													@endforeach
												</select>
											</td>
										</tr>
									@endfor
								
							    @endforeach
							</tbody>
						</table>
						<div class="clearfix"></div>
						<div class="form-group">
							{{ csrf_field() }}
							<a href="{{ URL::to('/') }}/shopping/cart" class="btn btn-default">BACK TO CART</a>
							<button type="submit" class="btn btn-primary">PROCEED TO PAYMENT</button>
						</div>	
					</form>
				</div>
			</div>
		</div>
	@endsection

	@section('scripts')

	<!-- Moment JS-->
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

	<script>
		$(function() {
		    $('.datepicker').daterangepicker({
		        singleDatePicker: true,
		        showDropdowns: true
			});
		});
	</script>
	@endsection
    