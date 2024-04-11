<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\user\PermissionController;
use App\Http\Controllers\api\user\RoleController;
use App\Http\Controllers\api\AdrReportController;
use App\Http\Controllers\api\ReactionFromDrugController;
use App\Http\Controllers\api\ReactionFromMedicalDeviceController;








/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::group(['prefix' => 'v1/auth'], function ($router) {
    //auth
    Route::post('login',[AuthController::class,'login']);
    Route::post('publicRegistration',[AuthController::class,'publicRegistration']);
});


Route::group(['middleware' => ['api','auth'],'prefix' => 'v1/auth'], function ($router) {

    //auth
    // Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('me',[AuthController::class,'me']);

});



Route::group(['middleware' => ['api','auth'],'prefix' => 'v1'], function ($router) {

    //AdrReportFormSave=ConsumerSideEffectFormSave
    Route::post('AdrReportFormSave',[AdrReportController::class,'AdrReportFormSave']);
    
    //AdrReportFormSave=ConsumerSideEffectFormSave
    Route::post('ConsumerSideEffectFormSave',[ReactionFromDrugController::class,'ConsumerSideEffectFormSave']);
    Route::post('SeriousAefiCaseNotificationFormSave',[ReactionFromDrugController::class,'SeriousAefiCaseNotificationFormSave']);
    Route::post('VoluntryReportingFormSave',[ReactionFromDrugController::class,'VoluntryReportingFormSave']);
    Route::post('ConsumerMedicalDeviceFormSave',[ReactionFromDrugController::class,'ConsumerMedicalDeviceFormSave']);
    Route::get('getAdverseEventList',[ReactionFromDrugController::class,'getAdverseEventList']);
    Route::get('getMedicineAdviserList',[ReactionFromDrugController::class,'getMedicineAdviserList']);


    Route::post('ConsumerMedicalDeviceFormSave',[ReactionFromMedicalDeviceController::class,'ConsumerMedicalDeviceFormSave']);
    Route::get('VoluntryMedicalDeviceFormSave',[ReactionFromMedicalDeviceController::class,'VoluntryMedicalDeviceFormSave']);





    
    



});





// Route::get('test',[AuthController::class,'test']);

Route::middleware(['api','auth'])->prefix('v1/user')->group(function ($router) {
 
    //permission
    Route::post('updatePermission',[PermissionController::class,'updatePermission']);
    Route::post('createPermission',[PermissionController::class,'createPermission']);
    Route::post('showPermission',[PermissionController::class,'showPermission']);
    //role
    Route::post('createRole',[RoleController::class,'createRole']);
    Route::post('updateRole',[RoleController::class,'updateRole']);
    Route::post('showRole',[RoleController::class,'showRole']);
  
});


