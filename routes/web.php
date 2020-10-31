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

// Userのルーティング
Route::resource('user', 'UserController');


// Teacherのルーティング
Route::prefix('teacher')->namespace('Teacher')->name('teacher.')->group(function () {
    Auth::routes();
    Route::resource('/', 'TeacherController');
    Route::get('/home', 'TeacherHomeController@index')->name('teacher_home');
});



// カレンダーのルーティング
Route::get('/calendar', 'CalendarController@show');

//臨時営業設定
Route::get('/lesson_schedule_setting', 'Calendar\LessonScheduleSettingController@form')->name("lesson_schedule_setting");
Route::post('/lesson_schedule_setting', 'Calendar\LessonScheduleSettingController@update')->name("update_lesson_schedule_setting");
