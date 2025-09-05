@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
	<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
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
												<th class="border-bottom-0">Client</th>
												<th class="border-bottom-0">Accounts</th>
												<th class="border-bottom-0">Amount</th>
												<th class="border-bottom-0">Purchase Date</th>
											</tr>
										</thead>
										<tbody>
											@foreach($purchases as $purchase)
												<tr>
													<td>{{ $purchase->id }}</td>
													<td>{{ $purchase->client->name }}</td>
													<td>
														<ul>
															@foreach($purchase->accounts as $account)
																<li>
																	{{ $account->name }} - ${{ number_format($account->pivot->price, 2) }}
																</li>
															@endforeach
														</ul>
													</td>
													<td>
														${{ number_format($purchase->accounts->sum(fn($a) => $a->pivot->price), 2) }}
													</td>
													<td>{{ $purchase->created_at->format('Y-m-d') }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>						
					</div>					
				</div>
@endsection
@section('content')
	
@endsection
@section('js')
@endsection