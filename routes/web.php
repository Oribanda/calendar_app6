<?php

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
Route::get('teacher', 'TeacherController@index');
// Route::resource('teacher', 'TeacherController');

// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('teacher', 'TeacherController');
// });


Route::prefix('teacher')->namespace('Teacher')->name('teacher.')->group(function () {
    Auth::routes();

    Route::get('/home', 'TeacherHomeController@index')->name('teacher_home');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
