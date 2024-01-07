<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\YearbookController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PdfController;





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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/getUser', [LoginController::class, 'getUser']);
//===================================================================================
Route::post('/uploadImage',[UploadController::class, 'uploadImage2']);
Route::post('/uploadAvatar',[UploadController::class, 'uploadAvatar']);
Route::post('/uploadBackGround',[UploadController::class, 'uploadBackGround']);
Route::post('/uploadCover',[UploadController::class, 'uploadCover']);
//===================================================================================
Route::get('/get_img/{file_name}',[UploadController::class, 'get_img']);
Route::get('/get_avatar/{file_name}',[UploadController::class, 'get_avatar']);
Route::get('/get_bg/{file_name}',[UploadController::class, 'get_bg']);
Route::get('/get_cover/{file_name}',[UploadController::class, 'get_cover']);
//===================================================================================
Route::post('/insertBackground',[BackgroundController::class, 'insertBackground']);
Route::post('/deleteBackground',[BackgroundController::class, 'deleteBackground']);
Route::post('/getBG',[BackgroundController::class, 'getBG']);
Route::get('/getBackground',[BackgroundController::class, 'getBackground']);
//===================================================================================
Route::post('/insertCover',[CoverController::class, 'insertCover']);
Route::post('/deleteCover',[CoverController::class, 'deleteCover']);
Route::get('/getCoverPage',[CoverController::class, 'getCoverPage']);
//===================================================================================
Route::post('/insertYearBook',[YearbookController::class, 'insertYearBook']);
Route::post('/specificYearBook',[YearbookController::class, 'specificYearBook']);
Route::post('/deleteYearbook',[YearbookController::class, 'deleteYearbook']);
Route::post('/RestoreYearbook',[YearbookController::class, 'RestoreYearbook']);
Route::get('/getYearbookCover',[YearbookController::class, 'getYearbookCover']);
Route::get('/getArchiveYearbook',[YearbookController::class, 'getArchiveYearbook']);
//===================================================================================
Route::get('/getAllTrack', [TrackController::class, 'getAllTrack']);
Route::post('/insertTrack',[TrackController::class, 'insertTrack']);
Route::post('/deleteTrack',[TrackController::class, 'deleteTrack']);
//===================================================================================
Route::get('/getAllSection', [SectionController::class, 'getAllSection']);
Route::post('/insertSection',[SectionController::class, 'insertSection']);
Route::post('/deleteSection',[SectionController::class, 'deleteSection']);
//===================================================================================
Route::get('/getAllRecords', [RecordsController::class, 'getAllRecords']);
Route::get('/getPerSectionRecords', [RecordsController::class, 'getPerSectionRecords']);
Route::get('/getTotalCount', [RecordsController::class, 'getTotalCount']);
Route::get('/getPerTrackYearRecords', [RecordsController::class, 'getPerTrackYearRecords']);
Route::post('/insertRecords',[RecordsController::class, 'insertRecords']);
Route::post('/deleteRecord',[RecordsController::class, 'deleteRecord']);
Route::post('/getLrnRecord',[RecordsController::class, 'getLrnRecord']);
//===================================================================================
Route::get('/backup', [BackupController::class, 'createBackup']);
//===================================================================================
Route::post('/LoginLogs',[LogsController::class, 'LoginLogs']);
Route::post('/DownloadLogs',[LogsController::class, 'DownloadLogs']);
Route::post('/ArchiveLogs',[LogsController::class, 'ArchiveLogs']);

Route::get('/getLogs', [LogsController::class, 'getLogs']);
//===================================================================================
Route::post('/generatePdf', [PdfController::class, 'generatePdf']);
Route::post('/testprint', [PdfController::class, 'testprint']);
//===================================================================================
Route::get('/{any?}', [SpaController::class, 'index'])->where('any', '.*');


