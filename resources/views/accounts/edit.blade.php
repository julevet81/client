@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit account</h2>
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

    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- account Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">account Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $account->name) }}"
                   class="form-control" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $account->email) }}"
                   class="form-control" required>
        </div>

        {{-- Publication Price --}}
        <div class="mb-3">
            <label for="publication_price" class="form-label">Publication Price</label>
            <input type="number" name="publication_price" id="publication_price"
                   value="{{ old('publication_price', $account->publication_price) }}"
                   class="form-control">
        </div>

        {{-- Weekly Price --}}
        <div class="mb-3">
            <label for="weekly_price" class="form-label">Weekly Price</label>
            <input type="number" name="weekly_price" id="weekly_price"
                   value="{{ old('weekly_price', $account->weekly_price) }}"
                   class="form-control">
        </div>

        {{-- Update Price --}}
        <div class="mb-3">
            <label for="update_price" class="form-label">Update Price</label>
            <input type="number" name="update_price" id="update_price"
                   value="{{ old('update_price', $account->update_price) }}"
                   class="form-control">
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update account</button>
    </form>
</div>
@endsection
@section('js')
@endsection