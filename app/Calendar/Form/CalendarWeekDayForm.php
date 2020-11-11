<?php

namespace App\Calendar\Form;

use Carbon\Carbon;

use App\Calendar\CalendarWeekDay;
use App\Calendar\ScheduleSetting;
use App\Calendar\LessonSchedule;


class CalendarWeekDayForm extends CalendarWeekDay
{
    public $lessonSchedule = null;

    /**
     * @return
     */
    function render()
    {
        //selectの名前
        $select_form_name = "lesson_schedule[" . $this->carbon->format("Ymd") . "][date_flag]";

        //コメントのinputの名前
        $comment_form_name = "lesson_schedule[" . $this->carbon->format("Ymd") . "][comment]";

        //定休日設定の値
        $defaultValue = ($this->isHoliday) ? "" : "";

        //臨時休業が選択されているかどうか
        $isSelectedExtraClose = ($this->lessonSchedule && $this->lessonSchedule->isClose()) ? 'selected' : '';

        //臨時営業が選択されているかどうか
        $isSelectedExtraOpen = ($this->lessonSchedule && $this->lessonSchedule->isOpen()) ? 'selected' : '';

        //コメントの値
        $comment = ($this->lessonSchedule) ? $this->lessonSchedule->comment : '';

        //HTMLの組み立て
        $html = [];

        //日付
        $html[] = '<p class="day">' . $this->carbon->format("j") . '</p>';

        //臨時営業・臨時休業設定
        $html[] = '<select name="' . $select_form_name . '" class="form-control">';
        $html[] = '<option value="0">- ' . $defaultValue . '</option>';
        $html[] = '<option value="' . LessonSchedule::CLOSE . '" ' . $isSelectedExtraClose . '>レッスン</option>';
        $html[] = '<option value="' . LessonSchedule::OPEN . '" ' . $isSelectedExtraOpen . '>休み</option>';
        $html[] = '</select>';

        //コメント
        if ($isSelectedExtraClose || $isSelectedExtraOpen) {
            $html[] = '<input class="form-control" type="text" name="' . $comment_form_name . '" value="' . e($comment) . '" />';
        }

        return implode("", $html);
    }

    function getClassName()
    {
        $classNames = ["day-" . strtolower($this->carbon->format("D"))];
        if ($this->lessonSchedule) {
            if ($this->lessonSchedule->isClose()) {
                $classNames[] = "day-close"; //臨時営業
            }
        } else if ($this->isHoliday) {

            $classNames[] = "day-close";
        }
        return implode(" ", $classNames);
    }
}

