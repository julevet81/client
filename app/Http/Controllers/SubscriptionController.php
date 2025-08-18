<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use App\Models\Status;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all(); // Assuming you want to pass statuses to the view
        $clients = Client::all(); // Assuming you want to pass clients to the view
        $accounts = Account::all(); // Assuming you want to pass accounts to the view
        $subscriptions = Subscription::with(['account', 'client', 'status']) // Eager load relationships
            ->orderBy('created_at', 'desc') // Order by creation date
            ->get();
        return view('subscriptions.index', compact('subscriptions', 'accounts', 'statuses', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all(); // Assuming you want to pass statuses to the view
        $clients = Client::all(); // Assuming you want to pass clients to the view
        $accounts = Account::all(); // Assuming you want to pass accounts to the view
        return view('subscriptions.add', compact('statuses', 'clients', 'accounts'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            
            'account_id' => 'required|exists:accounts,id',
            'status_id' => 'required|exists:statuses,id',
            'client_id' => 'required|exists:clients,id',
            'publication_date' => 'required|date',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('account', 'client', 'status'); // Eager load relationships
        $subscriptionData = [
            'id' => $subscription->id,
            'account' => $subscription->account->name,
            'client' => $subscription->client->name,
            'status' => $subscription->status->name,
            'publication_date' => $subscription->publication_date,
            'email' => $subscription->account->email, // Assuming you want to show the account email
            'publication_price' => $subscription->account->publication_price,
            'weekly_price' => $subscription->account->weekly_price,
            'update_price' => $subscription->account->update_price,

        ];

        return view('subscriptions.show', compact('subscriptionData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $statuses = Status::all(); // Assuming you want to pass statuses to the view
        $clients = Client::all(); // Assuming you want to pass clients to the view
        $accounts = Account::all(); // Assuming you want to pass accounts to the view
        $status = $subscription->status; // Get the current status of the subscription
        return view('subscriptions.edit', compact('subscription', 'accounts', 'statuses', 'clients', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'status_id' => 'required|exists:statuses,id',
            'client_id' => 'required|exists:clients,id',
            'publication_date' => 'required|date',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
