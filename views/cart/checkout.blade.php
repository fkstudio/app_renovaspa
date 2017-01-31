	@extends('layout/baseLayout')

	@section('title', 'Checkout')

	@section("content")
		<div class="container-fluid">
			@include('shared._breadcrumps')
			<hr/>
			<h3>{{ trans('titles.cart_checkout_title') }}</h3>
			<hr>
			<div class="row">
				<br/>
				<div class="col-md-12">
				    @include('shared._messages')
					<form action="{{ URL::to('/') }}/reservation/checkout" method="post">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>{{ trans('shared.service') }}</th>
									<th>{{ trans('shared.customer_name') }}</th>
									<th>{{ trans('shared.prefered_date') }}</th>
									<th>{{ trans('shared.prefered_time') }}</th>
									<th>{{ trans('shared.cabin_type') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($model->Items as $item)
									@for($i = 0; $i < $item->Quantity; $i++)
										<tr>
											<td class="padding-td">
												<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
												{{ $item->Service->Name }}
											</td>
											<td class="padding-td">
												<input type="text" name="customer_name[]" placeholder="Ej. Jhon Doe" class="form-control" value="{{ $item->CustomerName }}" />
											</td>
											<td class="padding-td">
												<input type="date" name="prefered_date[]" value="{{ ( $item->PreferedDate != null ? $item->PreferedDate->format('dd/mm/yyyy') : '' ) }}" class="datepicker form-control" />
											</td>
											<td class="padding-td">
												<input type="time" name="prefered_time[]" value="{{ ( $item->PreferedTime != null ? $item->PreferedTime->format('h:m') : '12:00pm' )  }}" class="timepicker form-control" />
											</td>
											
											<td class="padding-td">
												<select class="form-control blank-select" name="cabin_type[]">
													@foreach($cabins as $cabin)
														@if ($item->Cabin != null && $item->Cabin->Id == $cabin->Id)
															<option selected value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
														@else 
															<option value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
														@endif
													
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
							<a href="{{ URL::to('/') }}/shopping/cart" class="btn btn-default">{{ trans('shared.back_to_cart') }}</a>
							@if (count($model->Items) > 0)
								<button type="submit" class="btn btn-primary">{{ trans('shared.procced_to_payment') }}</button>
							@else
								<button type="button" class="disabled btn btn-primary">{{ trans('shared.procced_to_payment') }}</button>
							@endif
						</div>	
					</form>
				</div>
			</div>
		</div>
	@endsection

	@section('scripts')

	<!-- Moment JS-->
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<!-- Timepicker -->
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/jquery.timepicker.css">
	<script type="text/javascript" src="{{ URL::to('/') }}/js/jquery.timepicker.js"></script>

	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

	<script>
		$(function() {
		    $('.datepicker').daterangepicker({
		        minDate: moment().add(2, "days"),
		        singleDatePicker: true,
		        showDropdowns: true,
		        
			});

			$('.timepicker').timepicker();
		});
	</script>
	@endsection
    