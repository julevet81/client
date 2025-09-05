@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Client Details</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
<div class="container">
    <h2>Buy Accounts for {{ $client->name }}</h2>

    <form action="{{ route('clients.storePurchase', $client->id) }}" method="POST">
        @csrf

        {{-- Accounts Selection --}}
        <div id="accounts-wrapper">
            <div class="account-group mb-3">
                <label>Account</label>
                <select name="accounts[]" class="form-select account-select" required>
                    <option value="" disabled selected>-- Select Account --</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" data-price="{{ $account->price }}">
                            {{ $account->name }} ({{ $account->price }} $)
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" id="add-account" class="btn btn-sm btn-secondary mb-3">+ Add Another Account</button>

        {{-- Total --}}
        <div class="mb-3">
            <label>Total Price</label>
            <input type="text" id="total" class="form-control" readonly value="0">
        </div>

        {{-- Payment Method --}}
        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="" disabled selected>-- Select Payment Method --</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Complete Purchase</button>
    </form>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('accounts-wrapper');
    const addBtn = document.getElementById('add-account');
    const totalInput = document.getElementById('total');

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.account-select').forEach(select => {
            const price = select.options[select.selectedIndex]?.dataset?.price || 0;
            total += parseFloat(price);
        });
        totalInput.value = total;
    }

    wrapper.addEventListener('change', updateTotal);

    addBtn.addEventListener('click', () => {
        const firstGroup = wrapper.querySelector('.account-group');
        const clone = firstGroup.cloneNode(true);
        clone.querySelector('select').selectedIndex = 0;
        wrapper.appendChild(clone);
    });
});
</script>
@endsection

