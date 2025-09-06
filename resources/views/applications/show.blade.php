@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ application Details</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

<div class="container">
    <h2>Application Details</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $application->id }}</p>
            <p><strong>Status:</strong> {{ $application->status }}</p>
            <p><strong>Upload Date:</strong> {{ $application->upload_date }}</p>
            <p><strong>Start Test Date:</strong> {{ $application->start_test_date }}</p>
            <p><strong>End Test Date:</strong> {{ $application->end_test_date }}</p>
            <p><strong>Acceptation Date:</strong> {{ $application->acceptation_date }}</p>
        </div>
    </div>

    <h4>Assigned Testers</h4>
    @if($testers->count())
        <ul>
            @foreach($testers as $tester)
                <li>{{ $tester->name }} ({{ $tester->email }})</li>
            @endforeach
        </ul>
    @else
        <p>No testers assigned.</p>
    @endif

    <a href="{{ route('applications.index') }}" class="btn btn-secondary mt-3">Back to Applications</a>
</div>


@endsection
@section('js')
@endsection