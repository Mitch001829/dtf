<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\LarvicideController;
use App\Http\Controllers\ContainerContoller;
use App\Http\Controllers\OVITrapController;
use App\Http\Controllers\InqiuriesController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\EmailSettingsController;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


use App\Models\Service;


Route::get('/', function () {
    $all_services = Service::all();
    return view('welcome', compact('all_services'));
});


Route::middleware('auth', 'verified')->group(function(){
    Route::get("/dashboard", [DashboardController::class, "index"])->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/**
 * Public Registration
 */
Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('/public/register', 'publicReg')->name('public.register');
});


/**
 * Admin Registration
 */
Route::middleware('auth')->controller(RegisteredUserController::class)->group(function(){
    Route::get('/register', 'create')->name('register');
});



/**
 * Map controllers
 */
Route::middleware('auth')->controller(MapController::class)->group(function(){
    Route::get('/map/index', 'index')->name('map.index');
    Route::get('/map/get-ovi-loc-data', 'getOVILocData')->name('map.getOVILocData');
});


/**
 * Record controllers
 */
Route::middleware('auth')->controller(RecordController::class)->group(function(){
    Route::get('/record/index', 'index')->name('record.index');
});


/**
 * Settings Controller
 */
Route::middleware('auth')->controller(SettingsController::class)->group(function(){
    Route::get('/settings/index', 'index')->name('settings.index');
});


// Roles And Permission Controller
Route::middleware('auth')->controller(RolesAndPermissionController::class)->group(function(){
    Route::get('/settings/roles-and-permissions/index', 'index')->name('settings.roles-and-permissions.index');
    Route::get('/settings/roles/permissions/{id}', 'getRolePermission')->name('settings.roles-and-permissions.getRolePermission');
    Route::post('/settings/roles/permissions/assign', 'assignPermission')->name('settings.roles-and-permissions.assignPermission');
    Route::post('/settings/roles/assign', 'assignRoleToUser')->name('settings.roles-and-permissions.assignRoleToUser');
    Route::post('/settings/roles/create', 'createRole')->name('settings.roles-and-permissions.createRole');
});


// App Settings
Route::middleware('auth')->controller(AppSettingsController::class)->group(function(){
    Route::get('/settings/app-settings/index', 'index')->name('settings.app-settings.index');
    Route::post('/settings/app-settings/update', 'update')->name('settings.app-settings.update');
});







// Participants
Route::middleware('auth')->controller(ParticipantController::class)->group(function(){
    Route::get('/record/participants/index', 'index')->name('record.participants.index');
    Route::post('/record/participants/store', 'store')->name('record.participants.store');
    Route::post('/record/participants/update', 'update')->name('record.participants.update');
    Route::delete('/record/participants/destroy/{id}', 'destroy')->name('record.participants.destroy');
    Route::post('/record/participants/export', 'exportCsv')->name('record.participants.export');
});



// Larvicide
Route::middleware('auth')->controller(LarvicideController::class)->group(function(){
    Route::get('/record/larvicide/index', 'index')->name('record.larvicide.index');
    Route::post('/record/larvicide/store', 'store')->name('record.larvicide.store');
    Route::post('/record/larvicide/update', 'update')->name('record.larvicide.update');
    Route::delete('/record/larvicide/destroy/{id}', 'destroy')->name('record.larvicide.destroy');
    Route::post('/record/larvicide/export', 'exportCsv')->name('record.larvicide.export');
});


// Containers
Route::middleware('auth')->controller(ContainerContoller::class)->group(function(){
    Route::get('/record/containers/index', 'index')->name('record.containers.index');
    Route::post('/record/containers/store', 'store')->name('record.containers.store');
    Route::post('/record/containers/update', 'update')->name('record.containers.update');
    Route::delete('/record/containers/destroy/{id}', 'destroy')->name('record.containers.destroy');
    Route::post('/record/containers/export', 'exportCsv')->name('record.containers.export');
});


// OVI Trap
Route::middleware('auth')->controller(OVITrapController::class)->group(function(){
    Route::get('/record/ovitrap/index', 'index')->name('record.ovitrap.index');
    Route::post('/record/ovitrap/store', 'store')->name('record.ovitrap.store');
    Route::post('/record/ovitrap/update', 'update')->name('record.ovitrap.update');
    Route::delete('/record/ovitrap/destroy/{id}', 'destroy')->name('record.ovitrap.destroy');
    Route::post('/record/ovitrap/export', 'exportCsv')->name('record.ovitrap.export');
});


// Inquiries
Route::middleware('auth')->controller(InqiuriesController::class)->group(function(){
    Route::get('/record/inquiries/index', 'index')->name('record.inquiries.index');
    Route::post('/record/inquiries/store', 'store')->name('record.inquiries.store');
    Route::post('/record/inquiries/update', 'update')->name('record.inquiries.update');
    Route::delete('/record/inquiries/destroy/{id}', 'destroy')->name('record.inquiries.destroy');
    Route::post('/record/inquiries/export', 'exportCsv')->name('record.inquiries.export');
});


// Services 
Route::middleware('auth')->controller(ServiceController::class)->group(function(){
    Route::get('/record/services/index', 'index')->name('record.services.index');
    Route::post('/record/services/store', 'store')->name('record.services.store');
    Route::post('/record/services/update', 'update')->name('record.services.update');
    Route::delete('/record/services/destroy/{id}', 'destroy')->name('record.services.destroy');
    Route::post('/record/services/export', 'exportCsv')->name('record.services.export');

    
    // Handle richtext editor image upload
    Route::post('/record/services/image-handler', 'serviceImageHandler')->name('record.services.serviceImageHandler');
});

// Public access to services
Route::get('/record/services/{id}', [ServiceController::class, "read"])->name('record.services.read');



Route::middleware('auth')->controller(EmailSettingsController::class)->group(function(){
    Route::get('/settings/email-settings/index', 'index')->name('settings.email-settings.index');
    Route::post('/settings/email-settings/test', 'test')->name('settings.email-settings.test');
});