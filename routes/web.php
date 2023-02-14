<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;


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

Route::resource('users', UserController::class);

// Route::get('/get-cities', 'CityController@getCities');

Route::get('/get-cities', 'App\Http\Controllers\CityController@getCities');
Route::get('/get-skills', 'App\Http\Controllers\SkillController@getSkills');

// Route::get('/users/{id}/delete', 'App\Http\Controllers\UserController@delete');

Route::delete('/users/{id}', 'UserController@delete')->name('users.delete');
// 

// Route::get('/get-cities', [CityController::class, 'getCities']);


