@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit status</h2>
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

    <form action="{{ route('statuses.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- status Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">status Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $status->name) }}"
                   class="form-control" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $status->description) }}</textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update status</button>
    </form>
</div>
@endsection
@section('js')
@endsection