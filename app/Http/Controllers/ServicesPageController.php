<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\AboutImage;
use App\Models\Service;
use App\Models\Services_Title_Image;



class ServicesPageController extends Controller
{
    public function index(){
    $images=AboutImage::first();
    $schedules=Schedule::all();
    return view('services.mamogram-schedule',compact('images','schedules'));
}
   public function showServices()
   {

    $categories = Service::select('category')->distinct()->get();


    $services = Service::all();

    return view('services.services', compact('services', 'categories'));
}

public function showDetails($slug)
{

    $service = Service::where('slug', $slug)->firstOrFail();
    $images= Services_Title_Image::first();

    $service->content_images = json_decode($service->content_images);
    if (is_string($service->content_images)) {
        $service->content_images = [$service->content_images];
    }

    return view('services.service-details', compact('service','images'));
}
}
