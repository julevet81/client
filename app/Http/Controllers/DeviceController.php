<?php

namespace App\Http\Controllers;

use App\Models\device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();
        return view("devices.index", compact("devices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("devices.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'OS' => 'required',
        'owner_name' => 'required'
       ]) ;
       $device = new Device();
       $device->name = $request->name;
       $device->OS = $request->OS;
       $device->owner_name = $request->owner_name;
       $device->save();
       return redirect()->route('devices.index')->with("success","Device created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(device $device)
    {
        $device = Device::where('id', $device->id)->first();
        $deviceData = [
            'Name' => $device->name,
            'OS' => $device->OS,
            'owner_name' => $device->owner_name
        ];
        return view('devices.show', compact('deviceData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view("devices.edit", compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        
        $request->validate([
        'name' => 'required',
        'OS'=> 'required',
        'owner_name'=> 'required',
       ]) ;
       $device->update([
        'name' => $request->name,
        'OS' => $request->OS,
        'owner_name' => $request->owner_name
       ]);
       return redirect()->route('devices.index')->with('success','Device updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $device = Device::find($request->id);
        $device->delete();
        return redirect()->route('devices.index')->with('success','Device deleted successfully');
    }
}