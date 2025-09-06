@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')

  <div class="container">
      <h2>Edit application</h2>
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

      <form action="{{ route('applications.update', $application->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- application Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">application Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $application->name) }}" class="form-control" required>
          </div>
          {{-- Device --}}
          <div class="mb-3">
            <label for="device_id" class="form-label">Device</label>
            <select name="device_id" id="device_id" class="form-select @error('device_id') is-invalid @enderror" required>
              <option value="" disabled selected>-- Select Device --</option> @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                {{ $device->name }} ({{ $device->OS }})
              </option> @endforeach </select> @error('device_id')     <div class="invalid-feedback">{{ $message }}
                  </div>
                @enderror
          </div> 
          {{-- Upload Date --}} 

          <div class="mb-3">
            <label for="upload_date" class="form-label">Upload Date</label>
            <input type="date" class="form-control" id="upload_date" name="upload_date" 
            value="{{ old('upload_date', $application->upload_date) }}">
          </div>

          {{-- Start Test Date --}}
          <div class="mb-3">
            <label for="start_test_date" class="form-label">Start Test Date</label>
            <input type="date" class="form-control" id="start_test_date" name="start_test_date"
            value="{{ old('start_test_date', $application->start_test_date) }}">
          </div>

          {{-- End Test Date --}}
          <div class="mb-3">
            <label for="end_test_date" class="form-label">End Test Date</label>
            <input type="date" class="form-control" id="end_test_date" name="end_test_date"
            value="{{ old('end_test_date', $application->end_test_date) }}">
          </div>

          <!-- Status -->
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
              @foreach(['In_progress', 'In_upload', 'In_test', 'Activated', 'Deleted'] as $status)
                <option value="{{ $status }}" {{ $application->status === $status ? 'selected' : '' }}>
                  {{ $status }}
                </option>
              @endforeach
            </select>
          </div>
          <!-- Testers -->
          <div class="form-group">
            <label for="testers">Select Testers (max 20)</label><br>
            @foreach($testers as $tester)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="testers[]" value="{{ $tester->id }}" {{ in_array($tester->id, $application->testers ?? []) ? 'checked' : '' }}>
                <label class="form-check-label">
                  {{ $tester->name }} ({{ $tester->email }})
                </label>
              </div>
            @endforeach
          </div>

          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">Update application</button>
      </form>
  </div>
@endsection
@section('js')
@endsection