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
        {{-- Device --}}
          <div class="mb-3">
            <label for="device_id" class="form-label">Device</label>
            <select name="device_id" id="device_id"
                    class="form-select @error('device_id') is-invalid @enderror" required>
                <option value="" disabled selected>-- Select Device --</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                        {{ $device->name }} ({{ $device->OS }})
                    </option>
                @endforeach
            </select>
            @error('device_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $account->email) }}"
                   class="form-control" required>
        </div>

        {{-- Phone --}}
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="phone" class="form-control" id="phone" name="phone" required>
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
        {{-- Upload Price --}}
        <div class="mb-3">
            <label for="upload_price" class="form-label">Upload Price</label>
            <input type="number" name="upload_price" id="upload_price"
                   value="{{ old('upload_price', $account->upload_price) }}"
                   class="form-control">
        </div>

        {{-- Purchase Price --}}
          <div class="mb-3">
            <label for="price" class="form-label">Purchase Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $account->price) }}">
          </div>

          {{-- Open Date --}}
          <div class="mb-3">
            <label for="open_date" class="form-label">Open Date</label>
            <input type="date" class="form-control" id="open_date" name="open_date" value="{{ old('open_date', $account->open_date) }}">
          </div>

          {{-- Activation Date --}}
          <div class="mb-3">
            <label for="activation_date" class="form-label">Activation Date</label>
            <input type="date" class="form-control" id="activation_date" name="activation_date" value="{{ old('activation_date', $account->activation_date) }}">
          </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update account</button>
    </form>
</div>
@endsection
@section('js')
@endsection