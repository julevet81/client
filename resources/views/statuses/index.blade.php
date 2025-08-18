@extends('dashboard.layouts.master')
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					
				</div>
				
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
										Add status
									</button>
								</div>
							</div>
							<div>
								@if(session('success'))
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
								@endif
								@if($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">status Name</th>
												<th class="border-bottom-0">Description</th>
												<th class="border-bottom-0">Created at</th>
												<th class="border-bottom-0">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($statuses as $status)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $status->name }}</td>
												<td>{{ $status->description }}</td>
												<td>{{ $status->created_at }}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('statuses.show', $status->id) }}">show<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('statuses.edit', $status->id) }}">edit<i class="las la-pen"></i></a>
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$status->id}}">delete<i class="las la-trash"></i></a>
												</td>
											</tr>
											@include('statuses.delete')
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

						</div>
						
					</div>
					<!--/div-->
					@include('statuses.add')
				</div>
		<!-- Container closed -->
@endsection
@section('js')
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection