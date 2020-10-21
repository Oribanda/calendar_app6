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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

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

Route::get('/calendar', 'CalendarController@show');

//祝日設定
Route::get('/schedule_setting', 'Calendar\ScheduleSettingController@form')
    ->name("schedule_setting");
Route::post('/schedule_setting', 'Calendar\ScheduleSettingController@update')
    ->name("update_schedule_setting");


//臨時営業設定
Route::get('/lesson_schedule_setting', 'Calendar\LessonScheduleSettingController@form')->name("lesson_schedule_setting");
Route::post('/lesson_schedule_setting', 'Calendar\LessonScheduleSettingController@update')->name("update_lesson_schedule_setting");
