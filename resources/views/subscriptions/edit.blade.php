@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit Subscription</h2>
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

    <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

         <!-- Select Account -->
                    <div class="mb-3">
                        <label for="account_id">Account</label>
                        <select id="account_id" name="account_id" class="form-control">
                            <option value="">-- Select Account --</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{old('account_id', $subscription->account_id) == $account->id ? 'selected' : '' }}>{{ $account->name }}</option>
                                    
                            @endforeach
                        </select>
                    </div>

                    <!-- Account Email -->
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $subscription->account->email) }}">
                    </div>

                    <!-- Publication Price -->
                    <div class="mb-3">
                        <label for="publication_price">Publication Price</label>
                        <input type="number" id="publication_price" name="publication_price" class="form-control" value="{{ old('publication_price', $subscription->account->publication_price) }}">
                    </div>

                    <!-- Weekly Price -->
                    <div class="mb-3">
                        <label for="weekly_price">Weekly Price</label>
                        <input type="number" id="weekly_price" name="weekly_price" class="form-control" value="{{ old('weekly_price', $subscription->account->weekly_price) }}">
                    </div>

                    <!-- Update Price -->
                    <div class="mb-3">
                        <label for="update_price">Update Price</label>
                        <input type="number" id="update_price" name="update_price" class="form-control" value="{{ old('update_price', $subscription->account->update_price) }}">
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status_id">Status</label>
                        <select id="status_id" name="status_id" class="form-control" >
                            <option value="">-- Select Status --</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $status->id == old('status_id', $subscription->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                                    {{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Client -->
                    <div class="mb-3">
                        <label for="client_id">Client</label>
                        <select id="client_id" name="client_id" class="form-control">
                            <option value="">-- Select Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $client->id == old('client_id', $subscription->client_id) ? 'selected' : '' }}>{{ $client->name }}</option>
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
@endsection
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

