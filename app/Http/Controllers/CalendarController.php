<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function show()
    {
        $today = Carbon::now();
        $year = $today->year;
        $month = $today->month;

        return view("calendar", [
            'year' => $year,
            'month' => $month,
            'days' => $this->makeCalendar($today)
        ]);
    }
    
    public function past($year = null, $month = null)
    {
        if (!isset($year) || !isset($month)) {
            return $this->show();
        }
        
       try {
            $baseDate = new Carbon("{$year}-{$month}-01");
        } catch (Exception $e) {
            $baseDate = Carbon::now();
        } finally {
            return view("calendar", [
                'year' => $baseDate->year,
                'month' => $baseDate->month,
                'days' => $this->makeCalendar($baseDate)
            ]);
        }
    }
    
    /**
     * カレンダーの中身を作る関数
     * @param Carbon
     * @return Array
     */
    private function makeCalendar($baseDate)
    {
        $days[] = $baseDate->copy()->startOfMonth();

        for ($i = 0; $i < $baseDate->daysInMonth - 1; $i++) {
            $days[] = $days[$i]->copy()->addDay();
        }
        return $days;
    }
}