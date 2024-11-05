<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// use App\Models\Content;
use App\Models\Specialist;

// use App\Models\Practice;

use App\Models\Portal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        // $sliders = Slider::all();


        // $homeContent = Content::first();
        // $specialists=Specialist::all();
        // $footer=Footer::first();
        // $practice=Practice::first();
        // $info=Info::first();
        $portals=Portal::all();


        return view('home.index', compact('portals'));
    }
}
