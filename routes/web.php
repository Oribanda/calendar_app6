<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::resource('user', 'UserController');



Route::prefix('teacher')->namespace('Teacher')->name('teacher.')->group(function () {
    Auth::routes();
    Route::get('/', 'TeacherController@index')->name('index');
    Route::get('/home', 'TeacherHomeController@index')->name('home');

    // Route::middleware(['auth', 'teacher'])->group(function () {
    //     Route::get('/', 'TeacherController@index')->name('index');
    //     Route::get('/teacher/home', 'TeacherHomeController@index')->name('home');
    // });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
