	@extends('layout/baseLayout')

	@section('title', 'Services')

	@section("content")
		<div class="container-fluid">
			<div class="container">
				<h3>{{ $region->Country->Name }} - {{ $region->Name }} - {{ $hotel->Name }} - {{ $category->Name }} - SERVICES</h3>
				<hr>
				<div class="row">
					<br/>
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Quantity</th>
								</tr>
							</thead>
							<tbody>
								@foreach($model as $categoryRegion)
								<tr>
									<td>{{ $categoryRegion->Service->Name }}</td>
									<td>{{ $categoryRegion->Service->ServicePrice->Price }}</td>
									<td>
										<input type="number" name="" class="form-control" />
									</td>
								</tr>
							    @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	@endsection
    