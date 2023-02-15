<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function create()
    {
        return view('contents.createmap');
    }
    
    public function store(Request $request)
    {
        $location = new Location;
        $location->name = $request->input('name');
        $location->address = $request->input('address');
        $location->latitude = $request->input('latitude');
        $location->longitude = $request->input('longitude');
        $location->save();
        
        return redirect()->route('locations.create')->with('success', 'Location saved successfully');
    }
}
