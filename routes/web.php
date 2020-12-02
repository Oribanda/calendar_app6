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

    Route::get('/home', 'TeacherHomeController@index')->name('teacher_home');
});
Route::resource('teacher', 'TeacherController');


// カレンダー（Lesson）のルーティング
Route::get('/lesson', 'CalendarController@getLesson');
Route::post('/lesson', 'CalendarController@postLesson');
// 1日のレッスン日のルーティング
Route::get('/lesson/{id}', 'CalendarController@getLessonId');
// レッスン日の削除のルーティング
Route::delete('/lesson', 'CalendarController@deleteLesson');

// カレンダーのルーティング
Route::get('/calendar', 'CalendarController@index');

