<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
      <div class="modal-body">
        <!-- Form for adding a new account -->
        <form action="{{ route('accounts.store') }}" method="POST">
          @csrf
          {{-- account Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">account Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>  

          {{-- Publication Price --}}
          <div class="mb-3">
            <label for="publication_price" class="form-label">Publication Price</label>
            <input type="number" class="form-control" id="publication_price" name="publication_price">
          </div>

          {{-- Weekly Price --}}
          <div class="mb-3">
            <label for="weekly_price" class="form-label">weekly_price</label>
            <input type="number" class="form-control" id="weekly_price" name="weekly_price">
          </div>

          {{-- Update Price --}}
          <div class="mb-3">
            <label for="update_price" class="form-label">Update Price</label>
            <input type="number" class="form-control" id="update_price" name="update_price">
          </div>

          {{-- Upload Price --}}
          <div class="mb-3">
            <label for="upload_price" class="form-label">Upload Price</label>
            <input type="number" class="form-control" id="upload_price" name="upload_price">
          </div>

      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save account</button>
      </div>
      </form>
    </div>
  </div>
</div>