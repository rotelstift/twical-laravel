<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function show()
    {
        $today = Carbon::now();

        return view("calendar", [
            'year' => $today->year,
            'month' => $today->month,
            'days' => $this->makeCalendar($today),
            'nextYearPath' => $this->makeNextYearPath($today->copy()),
            'prevYearPath' => $this->makePrevYearPath($today->copy()),
            'nextMonthPath' => $this->makeNextMonthPath($today->copy()),
            'prevMonthPath' => $this->makePrevMonthPath($today->copy())
        ]);
    }
    
    public function past($year = null, $month = null)
    {
        if (!isset($year) || !isset($month)) {
            return $this->show();
        }
        
        try {
            $baseDate = new Carbon("{$year}-{$month}-01 00:00");
        } catch (Exception $e) {
            $baseDate = Carbon::now();
        } finally {
                return view("calendar", [
                'year' => $baseDate->year,
                'month' => $baseDate->month,
                'days' => $this->makeCalendar($baseDate),
                'nextYearPath' => $this->makeNextYearPath($baseDate->copy()),
                'prevYearPath' => $this->makePrevYearPath($baseDate->copy()),
                'nextMonthPath' => $this->makeNextMonthPath($baseDate->copy()),
                'prevMonthPath' => $this->makePrevMonthPath($baseDate->copy())

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
    
    /**
     * 次の年のリンクを作る関数
     * @param Carbon
     * @return String
     */
    private function makeNextYearPath($baseDate)
    {
        $nextYearDate = $baseDate->addYearNoOverflow();
        
        $nextYear = $nextYearDate->year;
        $month = sprintf('%02d', $nextYearDate->month);
        
        return "/{$nextYear}/{$month}";
    }
    
    /**
     * 
     * 
     */
    private function makePrevYearPath($baseDate)
    {
        $prevYearDate = $baseDate->subYearNoOverflow();

        $prevYear = $prevYearDate->year;
        $month = sprintf('%02d', $prevYearDate->month);
        
        return "/{$prevYear}/{$month}";
    }
    
    /**
     * 次の月のリンクを作る関数
     * @param Carbon
     * @return String
     */
    private function makeNextMonthPath($baseDate)
    {
        $nextMonthDate = $baseDate->addMonthNoOverflow();
        
        $nextMonthsYear = $nextMonthDate->year;
        $nextMonth = sprintf('%02d', $nextMonthDate->month);
        
        return "/{$nextMonthsYear}/{$nextMonth}";
    }
    
    /**
     * 前の月のリンクを作る関数
     * @param Carbon
     * @return String
     */
    private function makePrevMonthPath($baseDate)
    {
        $prevMonthDate = $baseDate->subMonthNoOverflow();
        
        $prevMonthsYear = $prevMonthDate->year;
        $prevMonth = sprintf('%02d', $prevMonthDate->month);
        
        return "/{$prevMonthsYear}/{$prevMonth}";
    }
}