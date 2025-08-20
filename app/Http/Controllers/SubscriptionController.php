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
            'email' => 'required|email',
            'publication_price' => 'required|numeric|min:0',
            'weekly_price' => 'required|numeric|min:0',
            'update_price' => 'required|numeric|min:0',
            'upload_price' => 'required|numeric|min:0', // New field for upload price
        ]);

        Subscription::create([
        'account_id' => $request->account_id,
        'status_id' => $request->status_id,
        'client_id' => $request->client_id,
        'email' => $request->email,
        'publication_price' => $request->publication_price,
        'weekly_price' => $request->weekly_price,
        'update_price' => $request->update_price,
        'upload_price' => $request->upload_price, // New field for upload price
        'publication_date' => $request->publication_date,
    ]);

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
            'email' => $subscription->email, // Assuming you want to show the account email
            'publication_price' => $subscription->publication_price,
            'weekly_price' => $subscription->weekly_price,
            'update_price' => $subscription->update_price,
            'upload_price' => $subscription->upload_price, // New field for upload price

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
            'email' => 'required|email',
            'publication_price' => 'required|numeric|min:0',
            'weekly_price' => 'required|numeric|min:0',
            'update_price' => 'required|numeric|min:0',
            'upload_price' => 'required|numeric|min:0',
        ]);

         $subscription->update([
            'account_id' => $request->account_id,
            'status_id' => $request->status_id,
            'client_id' => $request->client_id,
            'email' => $request->email,
            'publication_price' => $request->publication_price,
            'weekly_price' => $request->weekly_price,
            'update_price' => $request->update_price,
            'upload_price' => $request->upload_price, // New field for upload price
            'publication_date' => $request->publication_date,
        ]);

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
