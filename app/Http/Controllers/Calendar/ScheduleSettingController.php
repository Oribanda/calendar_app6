<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\ScheduleSetting;

class ScheduleSettingController extends Controller
{
        function form()
    {
        //取得

        $setting = ScheduleSetting::firstOrNew();

        return view("calendar/schedule_setting_form", [
            "setting" => $setting,
            "FLAG_OPEN" => ScheduleSetting::OPEN,
            "FLAG_CLOSE" => ScheduleSetting::CLOSE,
        ]);
    }

    function update(Request $request)
    {

        //取得
        $setting = ScheduleSetting::firstOrNew();

        //更新
        $setting->update($request->all());

        return redirect()
            ->action("Calendar\ScheduleSettingController@form")
            ->withStatus("保存しました");
    }
}
