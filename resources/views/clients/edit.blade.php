@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit client</h2>
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

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- client Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">client Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $client->name) }}"
                   class="form-control" required>
        </div>

        {{-- Phone --}}
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone"
                   value="{{ old('phone', $client->phone) }}"
                   class="form-control" required>
        </div>
        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $client->email) }}"
                   class="form-control" required>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update client</button>
    </form>
</div>
@endsection
@section('js')
@endsection