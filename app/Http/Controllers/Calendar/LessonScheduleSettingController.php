<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Calendar\Form\CalendarFormView;
use App\Calendar\LessonSchedule;

class LessonScheduleSettingController extends Controller
{
    public function form(Request $request)
    {
        //クエリーのdateを受け取る
        $date = $request->input("date");

        //dateがYYYY-MMの形式かどうか判定する
        if ($date && strlen($date) == 7) {
            $date = strtotime($date . "-01");
        } else {
            $date = null;
        }

        //取得出来ない時は現在(=今月)を指定する
        if (!$date) $date = time();

        //フォームを表示
        $calendar = new CalendarFormView($date);

        return view('calendar/lesson_schedule_setting_form', [
            "calendar" => $calendar
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->get("lesson_schedule");
        $ym = $request->input("ym");
        $date = $request->input("date");

        LessonSchedule::updateLessonScheduleWithMonth($ym, $input);
        return redirect()
            ->action("Calendar\LessonScheduleSettingController@form", ["date" => $date])
            ->withStatus("保存しました");
    }
}
