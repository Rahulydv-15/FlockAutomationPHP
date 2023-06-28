<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\events_trackingController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/custom/AllKycCron', function () {
//     require_once app_path('Custom/AllKycCron.php');
//     });

Route::get('/sendMessage',[events_trackingController::class,'sendMessage']);

 