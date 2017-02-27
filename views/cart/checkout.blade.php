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
					<p id="errorMessageContent" class="message-alert failure" style="display:none;">Please fill all fields and accept the terms.</p>
				    @include('shared._messages')
					<form onsubmit="return validateTerms()" action="{{ URL::to('/') }}/reservation/checkout" method="post">
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
								@php
									# counter to iterate only over services
									$counter = 0;
								@endphp
								@foreach($model->Items as $key => $item)
									@if($item->Service != null)
										@php
											$serviceCabin = $item->Service->Cabin;
										@endphp
										<tr>
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
												<input type="text" name="prefered_date[]" value="{{ ( $item->PreferedDate != null ? $item->PreferedDate->format('mm/dd/yyyy') : '' ) }}" class="datepicker form-control required-input" />
											</td>
											<td class="padding-td">
												<input type="text" name="prefered_time[]" value="{{ ( $item->PreferedTime != null ? $item->PreferedTime->format('h:m') : '12:00pm' )  }}" class="timepicker form-control required-input" />
											</td>
											
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
										@php
											$counter += 1;
										@endphp
									@else
										@php
											$packageRelation = $item->PackageCategoryRelation;
											$packageFeatures = $packageRelation->WeddingPackage->WeddingPackageFeatures;
										@endphp
										
										@foreach($packageFeatures as $feature)
											<tr>
												<td>{{ $feature->Description }}</td>
												<td>--</td>
												<td>--</td>
												<td>--</td>
												<td>--</td>
											</tr>
										@endforeach

										@foreach($packageRelation->WeddingPackage->WeddingPackageServices as $skey => $weddingPackageService)
											@php
												$serviceCabin = $weddingPackageService->Service->Cabin;
											@endphp
											<tr>
												<td class="padding-td">
													<input type="hidden" name="id[]" value="{{ $item->Id }}" /> 
													{{ ($packageRelation != null ? $packageRelation->WeddingPackage->Name.' - ' : '' ) .$weddingPackageService->Service->Name }}
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
													<input type="text" name="prefered_date[]" value="{{ ( $item->PreferedDate != null ? $item->PreferedDate->format('mm/dd/yyyy') : '' ) }}" class="datepicker form-control required-input" />
												</td>
												<td class="padding-td">
													<input type="text" name="prefered_time[]" value="{{ ( $item->PreferedTime != null ? $item->PreferedTime->format('h:m') : '12:00pm' )  }}" class="timepicker form-control required-input" />
												</td>
												
												<td class="padding-td">
													@if($weddingPackageService->Service->Cabin->Name != "Package")
													<select class="form-control required-input blank-select" name="cabin_type[]">
														@foreach($cabins as $cabin)
															@if($cabin->Name != "Package")
																@if ($weddingPackageService->Service != null && $weddingPackageService->Service->Cabin->Id == $cabin->Id)
																	<option selected value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
																@else 
																	<option value="{{ $cabin->Id }}" >{{ $cabin->Name }}</option>
																@endif
															@endif
														
														@endforeach
													</select>
													@else
													<select type="text" name="cabin_type[]" readonly class="disabled custom-select form-control required-input">
														<option value="{{ $weddingPackageService->Service->Cabin->Id }}">{{ $weddingPackageService->Service->Cabin->Name }}</option>
													</select>
													@endif
												</td>
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
								<a href="#fakielink">I have added a spa service and I agree...</a>
							</p>	
						</div>
						<div class="clearfix"></div>
						<div class="form-group pull-right">
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
		        minDate: moment('{{ session("arrival") }}'),
		        maxDate: moment('{{ session("departure") }}'),
		        singleDatePicker: true,
		        showDropdowns: true,
		        
			});

			$('.timepicker').timepicker();
		});
	</script>
	@endsection
    