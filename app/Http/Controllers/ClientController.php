<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:clients,email',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client = Client::where('id', $client->id)->first();
        $clientData = [
            'Name' => $client->name,
            'Phone' => $client->phone,
            'Email' => $client->email,
            'Created At' => $client->created_at->format('Y-m-d H:i:s'),
            'Updated At' => $client->updated_at->format('Y-m-d H:i:s'),
        ];

        return view('clients.show', compact('clientData'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function data(Client $client)
    {
        return response()->json([
            'email' => $client->email,
        ]);
    }

    public function buy(Client $client)
    {
        $accounts = Account::where('is_sold', false)->get();
        return view('clients.buy', compact('client', 'accounts'));
    }

    public function storePurchase(Request $request, Client $client)
    {
        $validated = $request->validate([
            'accounts' => 'required|array|min:1',
            'accounts.*' => 'exists:accounts,id',
            'payment_method' => 'required|string',
        ]);

        // Calculate total
        $accounts = Account::whereIn('id', $validated['accounts'])->where('is_sold', false)->get();
        $total = $accounts->sum('price'); // adjust if you use another price column

        // Create purchase
        $purchase = Purchase::create([
            'client_id' => $client->id,
            'total_price' => $total,
            'payment_method' => $validated['payment_method'],
        ]);

        // Attach accounts and mark as sold
        foreach ($accounts as $account) {
            $purchase->accounts()->attach($account->id, ['price' => $account->price]);
            $account->update(['is_sold' => true]);
        }

        return redirect()->route('purchass.index')->with('success', 'Purchase completed successfully.');
    }
}