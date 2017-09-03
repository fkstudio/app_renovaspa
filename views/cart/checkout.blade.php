@extends('layout/baseLayout')

@section('title', 'Shopping cart / Checkout')

@section("content")

<!-- sign modal -->
<div id="dateInfoModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 700px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">INFORMATION</h4>
			</div>
			<div class="modal-body">
				<p style="line-height: 25px;" class="text-center">
					- You will be able to make a fixed appointment by choosing a specific date and time if you book with more than 48 hours advice.<br/><br/>
					- If you are unsure about the appointment, please, choose OPEN DATE and OPEN TIME and confirm your appointment at the spa directly.<br/><br/>
					- For reservations with less than 48 hours advice, you will have to choose OPEN DATE and OPEN TIME and confirm your appointment at the spa directly upon arrival to the hotel based on availability.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	@include('shared._breadcrumps')
	<hr/>
	<h3>{{ trans('titles.cart_checkout_title') }}</h3>
	<hr>
	<div class="row">
		<br/>
		<div class="col-md-12">
			<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please fill all fields and accept the terms.</p>
		    @include('shared._messages')
			<form onsubmit="return validateTerms()" action="{{ URL::to('/') }}/reservation/checkout" method="post">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
							<th>{{ trans('shared.service') }}</th>
							<th>{{ trans('shared.customer_name') }}</th>
							<th>
								{{ trans('shared.prefered_date') }}
								<span data-toggle="modal" data-target="#dateInfoModal" style="margin-left: 20px;cursor:pointer;" class="glyphicon glyphicon-question-sign"></span>
							</th>
							<th>{{ trans('shared.prefered_time') }}</th>
							@if(session('reservation_type') != 3)
							<th>{{ trans('shared.cabin_type') }}</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							# counter to iterate only over services
							$counter = 0;
							$packages = session('packages');
						@endphp
						@foreach($model->Items as $key => $item)
							@if($item->Service != null)
								@php
									$serviceCabin = $item->Service->Cabin;
								@endphp
								<tr>
									<td>
										<img style="max-width: 80px;" src="{{ config('app.admin_url') . '/images/categories/' . $item->Category->Photo->Path }}" class="img-responsive" />
									</td>
									<td class="padding-td">
										<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
										{{ ($item->PackageCategoryRelation != null ? $item->PackageCategoryRelation->WeddingPackage->Name.' - ' : '' ) . $item->Service->Name }}
									</td>
									<td class="padding-td">
										@php
											$parts = explode(", ", $item->CustomerName);
										@endphp

										@if($serviceCabin->Name == "Single")
											<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ $parts[0] }}" />
										@elseif ($serviceCabin->Name == "Double")
											<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ (isset($parts[0]) ? $parts[0] : '') }}" />
											<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="You will shared room with..." class="form-control required-input" value="{{ (isset($parts[1]) ? $parts[1] : '' ) }}" />
										@elseif ($serviceCabin->Name == "Package")
											@for($i = 0; $i < $serviceCabin->MaxCantPersons; $i ++)
												<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ (isset($parts[$i]) ? $parts[$i] : '' ) }}" />
											@endfor
										@endif
									</td>
									<td class="padding-td">
										<input type="text" name="prefered_date[]" value="{{ ( $item->PreferedDate != null ? $item->PreferedDate->format('m/d/Y') : '' ) }}" placeholder="Open date" id="prefered_date_{{ $key }}" data-index="{{ $counter }}" class="datepicker form-control" />
									</td>
									<td class="padding-td">
										@php
											$info = $item->Service->getProfile(session('hotel_id'), session('category_id'))->ServiceInformation;

											$beginHour = 9;
											$endingHour = 6;
											
											if($info != null)
											{
												$beginHour = ( $info->OpeningTime != null ? $info->OpeningTime->format('H') : 9 );
												$endingHour = ( $info->EndingTime != null ? $info->EndingTime->format('H') : 6 );
											}
										@endphp
										<select id="prefered_time_{{ $counter }}" disabled data-index="{{ $counter }}" class="blak-select form-control" name="prefered_time[]">
											@php
												$h = $beginHour;
												$f = 'am';
											@endphp
											@for($i = $beginHour; $i <= $endingHour; $i ++)
												@php
													if($h > 12){
														$h = 1;
														$f = 'pm';
													}

												@endphp
											<option value="{{ $h }}:00{{ $f }}">{{ $h }}:00{{ $f }}</option>
												@php
													$h++;
												@endphp
											@endfor
										</select>
										<!-- <input type="text" name="prefered_time[]" value="{{ ( $item->PreferedTime != null ? $item->PreferedTime->format('h:m') : '' )  }}" placeholder="Open time" id="prefered_time_{{ $counter }}" data-index="{{ $counter }}" readonly="" class="timepicker form-control" /> -->
									</td>
									
									@if(session('reservation_type') != 3)
										<td class="padding-td">
											@if($item->Service->Cabin->Name != "Package")
											<select class="form-control required-input blank-select" name="cabin_type[]">
												@foreach($cabins as $cabin)
													@if($cabin->Name != "Package")
														@if ($item->Service != null && $item->Service->Cabin->Id == $cabin->Id)
															<option selected value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
														@else 
															<option value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
														@endif
													@endif
												
												@endforeach
											</select>
											@else
												<select type="text" name="cabin_type[]" readonly class="disabled custom-select form-control required-input">
													<option value="{{ $item->Service->Cabin->Id }}">{{ $item->Service->Cabin->Name }}</option>
												</select>
												@endif
											</td>
										</tr>
									@endif
								@php
									$counter += 1;
								@endphp
							@else
								@php
									$packageRelation = $item->PackageCategoryRelation;
									$packageFeatures = $packageRelation->WeddingPackage->WeddingPackageFeatures;
									$data = ($packages != null ? $packages[$packageRelation->WeddingPackage->Id] : [] );
								@endphp
								
								@foreach($packageFeatures as $feature)
									<tr>
										<td class="padding-td">
											<img style="max-width: 80px;margin-left: 10px;margin-top: -15px;" src="{{ URL::to('/images/') }}/wedding_package_icon.png" class="img-responsive" /> 
										</td>
										<td class="padding-td">{{ $feature->Description }}</td>
										<td class="padding-td">--</td>
										<td class="padding-td">--</td>
										<td class="padding-td">--</td>
									</tr>
								@endforeach

								@foreach($packageRelation->WeddingPackage->WeddingPackageServices as $skey => $weddingPackageService)
									@php
										$serviceCabin = $weddingPackageService->Service->Cabin;
									@endphp
									<tr>
										<td class="padding-td">
											<img style="max-width: 80px;margin-left: 10px;margin-top: -15px;" src="{{ URL::to('/images/') }}/wedding_package_icon.png" class="img-responsive" /> 
										</td>
										<td class="padding-td">
											<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
											{{ ($packageRelation != null ? $packageRelation->WeddingPackage->Name.' - ' : '' ) .$weddingPackageService->Service->Name }}
										</td>
										<td class="padding-td">
											@php
												$parts = ( isset($data[$skey]) ? explode(", ", $data[$skey]['customer_name']) : []);
											@endphp

											@if($serviceCabin->Name == "Single")
												<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ ( isset($parts[0]) ? $parts[0] : '') }}" />
											@elseif ($serviceCabin->Name == "Double")
												<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ (isset($parts[0]) ? $parts[0] : '') }}" />
												<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="You will shared room with..." class="form-control required-input" value="{{ (isset($parts[1]) ? $parts[1] : '' ) }}" />
											@elseif ($serviceCabin->Name == "Package")
												@for($i = 0; $i < $serviceCabin->MaxCantPersons; $i ++)
													<input type="text" required name="customer_name[{{ $counter }}][]" placeholder="Complete name..." class="form-control required-input" value="{{ (isset($parts[$i]) ? $parts[$i] : '' ) }}" />
												@endfor
											@endif
										</td>
										<td class="padding-td">
											<input type="text" name="prefered_date[]" value="{{ ( isset($data[$skey]['prefered_date']) ? $data[$skey]['prefered_date']->format('m/d/Y') : '' ) }}" id="prefered_date_{{ $key }}"  placeholder="Open date" data-index="{{ $counter }}" class="datepicker form-control" />
										</td>
										<td class="padding-td">
											<input type="text" name="prefered_time[]" value="{{ ( isset($data[$skey]['prefered_time']) ? $data[$skey]['prefered_time']->format('h:m') : '' )  }}" id="prefered_time_{{ $counter }}" placeholder="Open time" data-index="{{ $counter }}" readonly="" class="timepicker form-control" />
										</td>
										
										@if(session('reservation_type') != 3)
											<td class="padding-td">
												@if($item->Service->Cabin->Name != "Package")
												<select class="form-control required-input blank-select" name="cabin_type[]">
													@foreach($cabins as $cabin)
														@if($cabin->Name != "Package")
															@if ($item->Service != null && $item->Service->Cabin->Id == $cabin->Id)
																<option selected value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
															@else 
																<option value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
															@endif
														@endif
													@endforeach
												</select>
												@else
													<select type="text" name="cabin_type[]" readonly class="disabled custom-select form-control required-input">
														<option value="{{ $item->Service->Cabin->Id }}">{{ $item->Service->Cabin->Name }}</option>
													</select>
												@endif
												</td>
											</tr>
										@endif
									</tr>
									@php
										$counter++
									@endphp
								@endforeach
							@endif
						@endforeach
						
					</tbody>
				</table>
				<div class="clearfix"></div>
				<div class="col-lg-4 col-lg-offset-8">
					<h4 class="pull-right">{{ trans('checkout.upon_availability') }}</h4>
					<div class="clearfix"></div>
					<p class="pull-right">
						<input type="checkbox" id="accept_terms" name="accept_terms">
						<a target="__blank" href="{{ URL::to('/') }}/privacy-policy">I have added a spa service and I agree...</a>
					</p>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group pull-right">
					{{ csrf_field() }}
					<a href="{{ URL::to('/') }}/shopping/cart" class="btn btn-default">{{ trans('shared.back_to_cart') }}</a>
					@if (count($model->Items) > 0)
						@if(session('reservation_type') == 3)
							<button type="submit" class="btn btn-primary">{{ trans('shared.reservation_form') }}</button>
						@else
							<button type="submit" class="btn btn-primary">{{ trans('shared.procced_to_payment') }}</button>
						@endif
					@else
						@if(session('reservation_type') == 3)
							<button type="submit" class="btn btn-primary">{{ trans('shared.reservation_form') }}</button>
						@else
							<button type="button" class="disabled btn btn-primary">{{ trans('shared.procced_to_payment') }}</button>
						@endif
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
	function validateTerms(){
		var pass = true;

		if (!$("#accept_terms").is(":checked")) {
			pass = false;
	    }

	    var requiredInputs = $('.required-input');

	    $.each(requiredInputs, function(key, value){
	    	if($(value).val() == "")
	    		pass = false;
	    });

	    
	    if(!pass){
	    	$("#errorMessageContent").fadeTo(2000, 500).slideUp(500, function(){
	            $("#errorMessageContent").slideUp(500);
	        });
	    }
	    return pass;
	}

	$(function() {
	    $('.datepicker').daterangepicker({
	    	locale: {
		      format: 'MM/D/YYYY'
		    },
	        minDate: moment('{{ session("arrival") }}').add('2', 'days'),
	        maxDate: moment('{{ session("departure") }}'),
	        singleDatePicker: true,
	        showDropdowns: true,
	        autoUpdateInput: false,
	        
		});

		$('.datepicker').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('MM/DD/YYYY'));
		});

		$('.timepicker').timepicker({
			interval: 60,
		    minTime: '08',
		    maxTime: '06pm',
		    defaultTime: '12',
		    startTime: '10:00'
		});

		$("#dateInfoModal").modal("show");

		$(".datepicker").blur(function(){
			var input = $(this);
			var index = input.attr("data-index");
			if(input.val() == ""){
				var s = $("#prefered_time_"+index).val('').attr('disabled');
			}
			else {
				var s = $("#prefered_time_"+index).removeAttr('disabled');
			}

		})
	});
</script>
@endsection
