<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutImage;
use App\Models\Faq;
use App\Models\Covid;
use App\Models\PatientDocument;
use App\Models\Portal_Services;
use App\Models\Telemedicine;

class PatientsController extends Controller
{
    public function index()
    {
      $images=AboutImage::first();
      $files=PatientDocument::first();
      return view('patients.new-patients',compact('images','files'));
    }
    public function patientPortal(){
        $images=AboutImage::first();
        $faqs = Faq::all();
        $services=Portal_Services::all();
        return view ('patients.patient-portal',compact('faqs','images','services'));
    }
    public function covidData(){
        $covidData = Covid::first();
        $images=AboutImage::first();
        return view ('patients.covid-19',compact('covidData','images'));
    }
    public function telemedicineData(){
        $apps=Telemedicine::all();
        return view('patients.telemedicine',compact('apps'));
    }

}
