<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PCMHomeController;
use App\Http\Controllers\MediaPageController;
use App\Http\Controllers\ServicesPageController;
use App\Http\Controllers\LocationPageController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\MenuController;

use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\PracticeController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\PortalController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\AboutImageController;
use App\Http\Controllers\Admin\CareerMainContentController;
use App\Http\Controllers\Admin\CareerServicesController;
use App\Http\Controllers\Admin\CareerJobsController;
use App\Http\Controllers\Admin\PCMMainContentController;
use App\Http\Controllers\Admin\PCMVideoLinkController;
use App\Http\Controllers\Admin\PCMOverviewController;
use App\Http\Controllers\Admin\NewPatientContentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MediaLinkController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\CovidController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SpecialistTitleImageController;
use App\Http\Controllers\Admin\ServicesTitleImageController;
use App\Http\Controllers\Admin\UpdateController;

use App\Http\Controllers\Admin\TelemedicineController;
use App\Http\Controllers\Admin\PortalServicesController;
use App\Http\Controllers\Admin\LocationController;


use App\Http\Controllers\LayoutController;
use App\Http\Controllers\Admin\TestingController;

Route::resource('admin/testings', TestingController::class);




Route::get('/layout', [LayoutController::class, 'index'])->name('layout');
Route::post('/save-layout', [LayoutController::class, 'save'])->name('save.layout');
Route::get('/layout/{id}', function($id) {
    return view('layout9');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');
Route::get('/team/{slug}', [AboutUsController::class, 'showDetails'])->name('team.details');
Route::get('/our-team', [AboutUsController::class, 'team'])->name('team.index');

Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/patient-centered-medical-home', [PCMHomeController::class, 'index'])->name('pcmHome.index');
Route::get('/new-patients', [PatientsController::class, 'index'])->name('new-patients.index');
Route::get('/patient-portal', [PatientsController::class, 'patientPortal'])->name('patient-portal.index');
Route::get('/telemedicine', [PatientsController::class, 'telemedicineData'])->name('telemedicine-data.index');
Route::get('/locations', [LocationPageController::class, 'index'])->name('locations.index');
Route::get('location-details/{slug}', [LocationPageController::class, 'show'])->name('location.details');

Route::get('/covid-19', [PatientsController::class, 'covidData'])->name('covid.index');
Route::get('/videos', [MediaPageController::class, 'index'])->name('media-links.index');
Route::get('/press-releases', [MediaPageController::class, 'pressRelease'])->name('press-releases.index');
Route::get('/press-releases/{slug}', [MediaPageController::class, 'showDetails'])->name('press.details');
Route::get('/mammogram-schedule', [ServicesPageController::class, 'index'])->name('mammogram-schedule.index');
Route::get('/services', [ServicesPageController::class, 'showServices'])->name('fields-medicine.index');
Route::get('/services/{slug}', [ServicesPageController::class, 'showDetails'])->name('service.details');


Route::prefix('admin/dashboard')->group(function() {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('admin.dashboard');


    Route::post('/specialists/{id}/toggle-status', [SpecialistController::class, 'toggleStatus'])
    ->name('specialists.toggle-status');

Route::resource('specialists', SpecialistController::class);
Route::resource('menu', MenuController::class);
Route::get('menu/{id}/subcategories', [MenuController::class, 'getSubcategories']);
    Route::resource('home-content', HomeContentController::class);
    Route::resource('info', InfoController::class);
    Route::resource('footer', FooterController::class);
    Route::resource('practices', PracticeController::class);
    Route::resource('portal-content', PortalController::class);
    Route::resource('portal-services', PortalController::class);
    Route::resource('mission', MissionController::class);
    Route::resource('about-images', AboutImageController::class);
    Route::resource('career-content', CareerMainContentController::class);
    Route::resource('career-services', CareerServicesController::class);
    Route::resource('career-jobs', CareerJobsController::class);
    Route::resource('pcm-content', PCMMainContentController::class);
    Route::resource('pcm-video-link', PCMVideoLinkController::class);
    Route::resource('pcm-overview', PCMOverviewController::class);
    Route::resource('patient-files', NewPatientContentController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('covid-19', CovidController::class);
    Route::resource('media-link', MediaLinkController::class);
    Route::resource('blog', BlogsController::class);
    Route::resource('services-schedule',ScheduleController::class);
    Route::resource('service',ServicesController::class);
    Route::resource('team-title-image',SpecialistTitleImageController::class);
    Route::resource('services-title-image',ServicesTitleImageController::class);
    Route::resource('telemedicine', TelemedicineController::class);
    Route::resource('patient-portal-services',PortalServicesController::class);
    Route::resource('location', LocationController::class);
    Route::resource('updates', UpdateController::class);




    Route::prefix('sliders')->name('admin.sliders.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::get('edit/{slider}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
        Route::delete('/delete/{slider}', [SliderController::class, 'destroy'])->name('destroy');
    });


});




