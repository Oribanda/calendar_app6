<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;

use Yasumi\Yasumi;

class ScheduleSetting extends Model
{
    const OPEN = 1;
    const CLOSE = 2;

    protected $table = "schedule_setting";

    protected $fillable = [
        "flag_mon",
        "flag_tue",
        "flag_wed",
        "flag_thur",
        "flag_fri",
        "flag_sat",
        "flag_sun",
        "flag_holiday",
    ];

    function isOpenMonday()
    {
        return $this->flag_mon == ScheduleSetting::OPEN;
    }
    function isOpenTuesday()
    {
        return $this->flag_tue == ScheduleSetting::OPEN;
    }
    function isOpenWednesday()
    {
        return $this->flag_wed == ScheduleSetting::OPEN;
    }
    function isOpenThursday()
    {
        return $this->flag_thur == ScheduleSetting::OPEN;
    }
    function isOpenFriday()
    {
        return $this->flag_fri == ScheduleSetting::OPEN;
    }
    function isOpenSaturday()
    {
        return $this->flag_sat == ScheduleSetting::OPEN;
    }
    function isOpenSunday()
    {
        return $this->flag_sun == ScheduleSetting::OPEN;
    }
    function isOpenHoliday()
    {
        return $this->flag_holiday == ScheduleSetting::OPEN;
    }
    function isCloseMonday()
    {
        return $this->flag_mon == ScheduleSetting::CLOSE;
    }
    function isCloseTuesday()
    {
        return $this->flag_tue == ScheduleSetting::CLOSE;
    }
    function isCloseWednesday()
    {
        return $this->flag_wed == ScheduleSetting::CLOSE;
    }
    function isCloseThursday()
    {
        return $this->flag_thur == ScheduleSetting::CLOSE;
    }
    function isCloseFriday()
    {
        return $this->flag_fri == ScheduleSetting::CLOSE;
    }
    function isCloseSaturday()
    {
        return $this->flag_sat == ScheduleSetting::CLOSE;
    }
    function isCloseSunday()
    {
        return $this->flag_sun == ScheduleSetting::CLOSE;
    }
    function isCloseHoliday()
    {
        return $this->flag_holiday == ScheduleSetting::CLOSE;
    }

    private $holidays = null;

    function loadHoliday($year)
    {
        $this->holidays = Yasumi::create("Japan", $year, "ja_JP");
    }

    function isHoliday($date)
    {
        if (!$this->holidays) return false;
        return $this->holidays->isHoliday($date);
    }
}
