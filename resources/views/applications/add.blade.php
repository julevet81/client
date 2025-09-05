<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add application</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div>
        
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
      <div class="modal-body">
        <!-- Form for adding a new application -->
        <form action="{{ route('applications.store') }}" method="POST">
          @csrf
          {{-- application Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">application Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <!-- Select Account -->
          <div class="mb-3">
            <label for="account_id">Account</label>
            <select id="account_id" name="account_id" class="form-control"
              data-url-template="{{ route('accounts.data', ['account' => '__ACCOUNT__']) }}">
              <option value="">-- Select Account --</option>
              @foreach($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- Device --}}
          <div class="mb-3">
            <label for="device_id" class="form-label">Device</label>
            <select name="device_id" id="device_id"
                    class="form-select @error('device_id') is-invalid @enderror" >
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

          {{-- Upload Date --}}
          <div class="mb-3">
            <label for="upload_date" class="form-label">Upload Date</label>
            <input type="date" class="form-control" id="upload_date" name="upload_date">
          </div>

          {{-- Start Test Date --}}
          <div class="mb-3">
            <label for="start_test_date" class="form-label">Start Test Date</label>
            <input type="date" class="form-control" id="start_test_date" name="start_test_date">
          </div>

          {{-- End Test Date --}}
          <div class="mb-3">
            <label for="end_test_date" class="form-label">End Test Date</label>
            <input type="date" class="form-control" id="end_test_date" name="end_test_date">
          </div>

          {{-- Status Dropdown --}}
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                @foreach($statuses as $status)
                  <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                      {{ str_replace('_', ' ', $status) }}
                  </option>
                @endforeach
            </select>
          </div>
          {{-- Testers as checkboxes --}}
          <div class="mb-3">
            <label class="form-label">Select Testers (max 20)</label>
            <div class="d-flex flex-wrap gap-3">
              @forelse($testers as $tester)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="testers[]" value="{{ $tester->id }}"
                    id="tester_{{ $tester->id }}" {{ in_array($tester->id, old('testers', [])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="tester_{{ $tester->id }}">
                    {{ $tester->name }} ({{ $tester->email }})
                  </label>
                </div>
              @empty
                <p class="text-muted">No available testers.</p>
              @endforelse
            </div>
            <small class="text-muted">You can select up to 20 testers.</small>
            @error('testers')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save application</button>
          </div>
      </form>
    </div>
  </div>
</div>