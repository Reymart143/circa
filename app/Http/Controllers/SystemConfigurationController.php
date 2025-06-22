<?php

namespace App\Http\Controllers;

use App\Models\SystemConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Auth;

class SystemConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('system_configuration.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function appearanceupdate(Request $request)
    {
       
        $user = Auth::user();

        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'system_color' => 'required|string',
        ]);

        $data = ['system_color' => $request->system_color];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $filename);
        
            $path = 'logos/' . $filename;
            $data['logo'] = $path;
        }

        $user->preference()->updateOrCreate(['user_id' => $user->id], $data);

        return back()->with('success', 'System Appearance Updated!');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemConfiguration $systemConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemConfiguration $systemConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemConfiguration $systemConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemConfiguration $systemConfiguration)
    {
        //
    }
}
