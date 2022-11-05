<?php

use App\Http\Controllers\DbController;
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

Route::get('/', function () {
    // throw new Exception('My first error!');
    // return view('welcome');
});
Route::get("/db",[DbController::class ,"test"]);