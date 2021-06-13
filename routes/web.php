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

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\ScheduleListController::class, 'index'])->name('scheduleList');
Route::group(['namespace' => 'App\Http\Controllers\Admin','prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'loginShow'])->name('admin.loginShow');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'adminView'])->name('admin.view');
        Route::resource('class-room', 'ClassRoomController');
        Route::resource('teacher', 'TeacherController');
        Route::resource('schedule', 'ScheduleController');
    });
});
