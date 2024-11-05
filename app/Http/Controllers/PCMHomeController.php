<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutImage;
use App\Models\PcmContent;
use App\Models\PcmVideoLink;
use App\Models\PcmOverview;
class PCMHomeController extends Controller
{
    public function index(){
        $images=AboutImage::first();
        $pcmContent=PcmContent::first();
        $link=PcmVideoLink::first();
        $overviews=PcmOverview::all();
    return view('about-us.pcm_home',compact('images','pcmContent','link','overviews'));
}}
