<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'publication_price' => 'required|numeric|min:0',
            'weekly_price' => 'required|numeric|min:0',
            'update_price' => 'required|numeric|min:0',
            'upload_price' => 'required|numeric|min:0',
        ]);

        Account::create($request->all());

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $account = Account::where('id', $account->id)->first();
        $accountData = [
            'Name' => $account->name,
            'Email' => $account->email,
            'Publication Price' => $account->publication_price,
            'Weekly Price' => $account->weekly_price,
            'Update Price' => $account->update_price,
            'Upload Price' => $account->upload_price,
            'Created At' => $account->created_at->format('Y-m-d H:i:s'),
            'Updated At' => $account->updated_at->format('Y-m-d H:i:s'),
        ];
        return view('accounts.show', compact('accountData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'publication_price' => 'required|numeric|min:0',
            'weekly_price' => 'required|numeric|min:0',
            'update_price' => 'required|numeric|min:0',
            'upload_price' => 'required|numeric|min:0',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }

    public function data(Account $account)
{
    return response()->json([
        'publication_price' => $account->publication_price,
        'weekly_price'      => $account->weekly_price,
        'update_price'      => $account->update_price,
        'upload_price'      => $account->upload_price,
    ]);
}
}
