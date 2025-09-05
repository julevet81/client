<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Application;
use App\Models\Device;
use App\Models\Tester;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $applications = Application::with('testers')->get();
        foreach ($applications as $application) 
        {
            $application->testerEmails = Tester::whereIn('id', $application->testers ?? [])->pluck('email')->toArray();
        }
        $statuses = ['In_progress','In_upload','In_test','Activated','Deleted'];
        $devices = Device::all();
        $accounts = Account::all();
        $testers = Tester::whereDoesntHave('applications')->get();
        return view('applications.index', compact('applications', 'devices', 'statuses', 'testers', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = ['In_progress','In_upload','In_test','Activated','Deleted'];
        $accounts = Account::all();
        $testers = Tester::whereDoesntHave('applications')->get();
        $applications = Application::with('testers')->get();
        return view('applications.add', compact('statuses', 'accounts', 'testers', 'applications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'            => 'required|string',
            'account_id'      => 'required|exists:accounts,id',
            'upload_date'     => 'nullable|date',
            'start_test_date' => 'nullable|date',
            'end_test_date'   => 'nullable|date',
            'acceptation_date'=> 'nullable|date',
            'status'          => 'required|in:In_progress,In_upload,In_test,Activated,Deleted',
            'testers.*'       => 'exists:testers,id',
        ]);

        $application = Application::create($validated );

        if ($request->has('testers')) 
        {
            $application->testers()->attach($request->testers);
        }

        $application->testers()->sync($request->testers);

        // Attach testers to pivot
        $application->testers()->attach($validated['testers']);

        return redirect()->route('applications.index')->with('success', 'Application created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
