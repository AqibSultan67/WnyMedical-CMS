<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Missions;
use App\Models\AboutImage;
use App\Models\Specialist;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class AboutUsController extends Controller
{
    public function index()
    {
        $missions = Missions::first();
        $images = AboutImage::first();

        return view('about-us.about', compact('missions', 'images'));
    }

    public function team()
    {
        $images = AboutImage::first();
        $teams = Specialist::all();
        return view('about-us.team', compact('teams', 'images'));
    }

    public function showDetails($slug)
{
    $images = Team::first();
    $specialist = Specialist::where('slug', $slug)->first();
    $transformedName = $specialist->specialist_name;


    return view('about-us.team-details', compact('specialist', 'transformedName'));
}


}
