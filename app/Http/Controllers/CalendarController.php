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
            'days' => $this->calendar($today),
            'nextYearPath' => $this->nextYearPath($today->copy()),
            'prevYearPath' => $this->prevYearPath($today->copy()),
            'nextMonthPath' => $this->nextMonthPath($today->copy()),
            'prevMonthPath' => $this->prevMonthPath($today->copy())
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
                'days' => $this->calendar($baseDate),
                'nextYearPath' => $this->nextYearPath($baseDate->copy()),
                'prevYearPath' => $this->prevYearPath($baseDate->copy()),
                'nextMonthPath' => $this->nextMonthPath($baseDate->copy()),
                'prevMonthPath' => $this->prevMonthPath($baseDate->copy())

            ]);
        }
    }
    
    /**
     * カレンダーの中身を作る関数
     * @param Carbon
     * @return Array
     */
    private function calendar($baseDate)
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
    private function nextYearPath($baseDate)
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
    private function prevYearPath($baseDate)
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
    private function nextMonthPath($baseDate)
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
    private function prevMonthPath($baseDate)
    {
        $prevMonthDate = $baseDate->subMonthNoOverflow();
        
        $prevMonthsYear = $prevMonthDate->year;
        $prevMonth = sprintf('%02d', $prevMonthDate->month);
        
        return "/{$prevMonthsYear}/{$prevMonth}";
    }
}