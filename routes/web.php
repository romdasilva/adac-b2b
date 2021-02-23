<?php

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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/main', 'App\Http\Controllers\MainController@show');
Route::get('/', 'App\Http\Controllers\MainController@homePage');
Route::post('/result', 'App\Http\Controllers\MainController@result');
Route::patch('/result',[
    'as' => 'result',
    'uses' => 'MainController@result'
]);
