<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerContent;
use App\Models\AboutImage;
use App\Models\CareerServices;
use App\Models\CareerJob;


class CareerController extends Controller
{
public function index(){
    $careerContent=CareerContent::first();
    $images=AboutImage::first();
    $careerServices=CareerServices::all();
    $jobs = CareerJob::latest()->get();
    return view('about-us.careers',compact('careerContent','images','careerServices','jobs'));
}}
