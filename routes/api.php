<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserMaintenanceController;
use App\Mail\TestMail;

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


Route::post('/insertUser', [LoginController::class, 'insertUser']);
Route::post('/loginUser', [LoginController::class, 'loginUser']);
Route::post('/VerifyLrn', [LoginController::class, 'VerifyLrn']);
Route::post('/VerifyPinCode', [LoginController::class, 'VerifyPinCode']);
Route::post('/ChangePassword', [LoginController::class, 'ChangePassword']);
Route::post('/GeneratePinCode', [LoginController::class, 'GeneratePinCode']);
Route::post('/addAvatar', [LoginController::class, 'addAvatar']);





Route::get('/getUser',[UserMaintenanceController::class, 'getUsers']);
Route::post('/deleteUser',[UserMaintenanceController::class, 'deleteUser']);
Route::post('/updateStatus',[UserMaintenanceController::class, 'updateStatus']);
Route::post('/updateUserInfo',[UserMaintenanceController::class, 'updateUserInfo']);
Route::post('/updateSecurityInfo',[UserMaintenanceController::class, 'updateSecurityInfo']);
Route::post('/updateContactInfo',[UserMaintenanceController::class, 'updateContactInfo']);
Route::post('/updateOrInsert',[UserMaintenanceController::class, 'updateOrInsert']);






Route::post('/mail/store', function(Request $request){
    try {
        \DB::beginTransaction();
        $from =  (object)[];
        $from->email =  'no-reply@gmail.com';
        $from->name =  $request->From;

        $to = $request->ToMail;
        $pin_number = strval($request->PinCode);

        Mail::to($to)->send(new TestMail($from, $pin_number));
        \DB::commit();
    } catch (\Exception $e) {

        \DB::rollback();
        return $e->getMessage();
    }
    return 'Done!';
});
