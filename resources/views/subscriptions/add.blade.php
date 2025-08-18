<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subscription</h1>
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
                <!-- Form for adding a new status -->
                <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf

                    <!-- Select Account -->
                    <div class="mb-3">
                        <label for="account_id">Account</label>
                        <select id="account_id" name="account_id" class="form-control">
                            <option value="">-- Select Account --</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Account Email -->
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <!-- Publication Price -->
                    <div class="mb-3">
                        <label for="publication_price">Publication Price</label>
                        <input type="number" id="publication_price" name="publication_price" class="form-control">
                    </div>

                    <!-- Weekly Price -->
                    <div class="mb-3">
                        <label for="weekly_price">Weekly Price</label>
                        <input type="number" id="weekly_price" name="weekly_price" class="form-control">
                    </div>

                    <!-- Update Price -->
                    <div class="mb-3">
                        <label for="update_price">Update Price</label>
                        <input type="number" id="update_price" name="update_price" class="form-control">
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status_id">Status</label>
                        <select id="status_id" name="status_id" class="form-control">
                            <option value="">-- Select Status --</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Client -->
                    <div class="mb-3">
                        <label for="client_id">Client</label>
                        <select id="client_id" name="client_id" class="form-control">
                            <option value="">-- Select Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Publication Date -->
                    <div class="mb-3">
                        <label for="publication_date">Start Date</label>
                        <input type="date" id="publication_date" name="publication_date" class="form-control">
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Subscription</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#account_id').change(function () {
        let accountId = $(this).val();
        if (accountId) {
            $.get('/accounts/' + accountId + '/data', function (data) {
                $('#email').val(data.email);
                $('#publication_price').val(data.publication_price);
                $('#weekly_price').val(data.weekly_price);
                $('#update_price').val(data.update_price);
            });
        }
    });
</script>

