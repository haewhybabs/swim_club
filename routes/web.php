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
Route::get('/', 'App\Http\Controllers\LoginController@index');
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
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
    Route::get('/race-performance', 'App\Http\Controllers\RacePerformanceController@viewPerformance');
    Route::get('/gala-event','App\Http\Controllers\GalaEventController@viewEvent');
    
});

Route::middleware(['role:admin,coaches'])->group(function () {
    // specifically to admin and coaches go here
    Route::get('/admin/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::post('/handle-create-performance', 'App\Http\Controllers\RacePerformanceController@handleCreatePerformance');
});


Route::middleware(['role:admin'])->group(function () {
    //specifically for admin goes here
    Route::get('/admin/create-parent','App\Http\Controllers\ParentController@adminCreateParent');
    Route::get('/admin/create-coach','App\Http\Controllers\CoachController@loadCoaches');
    Route::post('/admin/handle-create-coach','App\Http\Controllers\CoachController@createCoach');
    Route::post('/admin/handle-update-coach','App\Http\Controllers\CoachController@updateCoach');
    Route::get('/admin/handle-delete-coach/{id}','App\Http\Controllers\CoachController@deleteCoach');
    Route::get('/admin/create-squad','App\Http\Controllers\SquadController@loadSquad');
    Route::post('/admin/handle-create-squad','App\Http\Controllers\SquadController@createSquad');
    Route::post('/admin/update-squad','App\Http\Controllers\SquadController@updateSquad');
    Route::post('/admin/handle-create-event','App\Http\Controllers\GalaEventController@createEvent');
    // Route::post('/handle-create-performance', 'App\Http\Controllers\RacePerformanceController@handleCreatePerformance');

});

