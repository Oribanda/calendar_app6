<?php

namespace App\Calendar\Form;

use Carbon\Carbon;

use App\Calendar\CalendarWeek;
use App\Calendar\ScheduleSetting;

class CalendarWeekForm extends CalendarWeek
{
    /**
     * LessonSchedule[]
     */
    public $holidays = [];

    /**
     * @return CalendarWeekDayForm
     */
    function getDay(Carbon $date, ScheduleSetting $setting)
    {
        $day = new CalendarWeekDayForm($date);
        $day->checkHoliday($setting);

        if (isset($this->holidays[$day->getDateKey()])) {
            $day->lessonSchedule = $this->holidays[$day->getDateKey()];
        }

        return $day;
    }
}
