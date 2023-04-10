<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::get('/register', 'App\Http\Controllers\LoginController@register');
Route::post('/register', 'App\Http\Controllers\LoginController@handleRegister');

Route::middleware(['auth'])->group(function () {
    // Authenticated routes go here
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::get('/load-info', 'App\Http\Controllers\PersonalInfoController@loadInfo');
    Route::post('/save-info', 'App\Http\Controllers\PersonalInfoController@saveUserInfo');
    Route::get('/my-squad', 'App\Http\Controllers\SquadController@mySquad');
    Route::get('/my-parent', 'App\Http\Controllers\ParentController@myParent');
    Route::post('/create-parent', 'App\Http\Controllers\ParentController@createParent');
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout');
});

Route::middleware(['role:admin','role:coach'])->group(function () {
    // specifically to admin goes here
    Route::get('/admin/dashboard', 'App\Http\Controllers\DashboardController@index');
});


Route::middleware(['role:coach'])->group(function () {
    // Authenticated routes go here
    // Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/create-parent','App\Http\Controllers\ParentController@adminCreateParent');
    Route::get('/admin/create-coach','App\Http\Controllers\CoachController@loadCoaches');
    Route::post('/admin/handle-create-coach','App\Http\Controllers\CoachController@createCoach');
    Route::get('/admin/create-squad','App\Http\Controllers\SquadController@loadSquad');
    Route::post('/admin/handle-create-squad','App\Http\Controllers\SquadController@createSquad');
});

