<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;
use App\Lesson;

class CalendarController extends Controller
{


    public function index(Request $request)
    {
        $list = Lesson::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month, $request->year);
        return view('calendar.index', ['cal_tag' => $tag]);
        // return view('calendar.index');
    }

    public function getLesson(Request $request)
    {
        // Lessonデータ取得
        $data = new Lesson();
        $list = Lesson::all();
        return view('calendar.lesson', ['list' => $list, 'data' => $data]);
    }

    public function getLessonId($id)
    {
        // Lessonデータ取得
        $data = new Lesson();
        if (isset($id)) {
            $data = Lesson::where('id', '=', $id)->first();
        }
        $list = Lesson::all();
        return view('calendar.lesson', ['list' => $list, 'data' => $data]);
    }

    public function deleteLesson(Request $request)
    {
        // DELETEで受信したレッスンのデータの削除
        if (isset($request->id)) {
            $lesson = Lesson::where('id', '=', $request->id)->first();
            $lesson->delete();
        }
        // Lessonデータ取得
        $data = new Lesson();
        $list = Lesson::all();
        return view('calendar.lesson', ['list' => $list, 'data' => $data]);
    }

    public function postLesson(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);

        // POSTで受信したLessonデータの登録
        if (isset($request->id)) {
            $lesson = Lesson::where('id', '=', $request->id)->first();
            $lesson->day = $request->day;
            $lesson->description = $request->description;
            $lesson->save();
        } else {
            $lesson = new Lesson();
            $lesson->day = $request->day;
            $lesson->description = $request->description;
            $lesson->save();
        }

        // Lessonデータ取得
        $data = new Lesson();
        $list = Lesson::all();
        return view('calendar.lesson', ['list' => $list, 'data' => $data]);
    }


}
