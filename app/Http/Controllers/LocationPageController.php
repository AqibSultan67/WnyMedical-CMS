<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationPageController extends Controller
{
    public function index()
    {

        $locations = Location::all()->map(function ($location) {
         
            $location->days = json_decode($location->days, true) ?? [];
            $location->times = json_decode($location->times, true) ?? [];
            return $location;
        });

        return view('locations.locations', compact('locations'));
    }
    public function show($slug)
{
    $location = Location::where('slug', $slug)->firstOrFail();
    return view('locations.location-details', compact('location'));
}
}
