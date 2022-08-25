<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

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



 Route::get('/',function(){

    return redirect('weather');
 });

Route::get('weather', [ApiController::class, 'index'])->middleware('EnsureApiExists');
Route::post('weather', [ApiController::class, 'index'])->middleware('EnsureApiExists')->name('checkWeather');