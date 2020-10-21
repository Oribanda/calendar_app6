<?php

namespace App\Calendar\Output;

use Carbon\Carbon;

use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;

/**
 * 表示用
 */
class CalendarOutputView extends CalendarView
{


    /**
     * 日を描画する
     */
    protected function renderDay(CalendarWeekDay $day)
    {
        $html = [];

        $lessonSchedule = null;

        //臨時営業日設定で上書きを行う
        if (isset($this->holidays[$day->getDateKey()])) {
            $lessonSchedule = $this->holidays[$day->getDateKey()];
            if ($lessonSchedule->isOpen()) {
                $day->setHoliday(false);
            } else if ($lessonSchedule->isClose()) {
                $day->setHoliday(true);
            }
        }


        $html[] = '<td class="' . $day->getClassName() . '">';
        $html[] = $day->render();

        if ($lessonSchedule) {
            $html[] = '<p class="comment">' . e($lessonSchedule->comment) . '</p>';
        }
        $html[] = '</td>';

        return implode("", $html);
    }
}
