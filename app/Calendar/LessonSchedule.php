<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    const OPEN = 1;
    const CLOSE = 2;

    protected $table = "lesson_schedule_setting";

    protected $fillable = [
        "date_flag",
        "comment"
    ];

    function isClose()
    {
        return $this->date_flag == LessonSchedule::CLOSE;
    }

    function isOpen()
    {
        return $this->date_flag == LessonSchedule::OPEN;
    }

    /**
     * 指定した月の臨時営業・休業を取得する
     * @return LessonSchedule[]
     */
    public static function getLessonScheduleWithMonth($ym)
    {
        return LessonSchedule::where("date_key", 'like', $ym . '%')->get()->keyBy("date_key");
    }

    /**
     * 一括で更新する
     */
    public static function updateLessonScheduleWithMonth($ym, $input)
    {
        $lessonSchedules = self::getLessonScheduleWithMonth($ym);



        foreach ($input as $date_key => $array) {

            if (isset($lessonSchedules[$date_key])) {    //既に作成済の場合
                $lessonSchedule = $lessonSchedules[$date_key];
                $lessonSchedule->fill($array);

                //CloseかOpen指定の場合は上書き
                if ($lessonSchedule->isClose() || $lessonSchedule->isOpen()) {
                    $lessonSchedule->save();

                    //指定なしを選択している場合は削除
                } else {
                    $lessonSchedule->delete();
                }

                continue;
            }

            $lessonSchedule = new LessonSchedule();
            $lessonSchedule->date_key = $date_key;
            $lessonSchedule->fill($array);

            //CloseかOpen指定の場合は保存
            if ($lessonSchedule->isClose() || $lessonSchedule->isOpen()) {
                $lessonSchedule->save();
            }
        }
    }
}
