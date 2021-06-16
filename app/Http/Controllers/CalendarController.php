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
            'month' => $month
        ]);
    }
    
    public function past($year = null, $month = null)
    {
        if (!isset($year) || !isset($month)) {
            $this->show();
        }
        
        try {
            $baseDate = new Carbon('{$year}-{$month]-01');
            $year = $baseDate->year;
            $month = $baseDate->month;
        } catch(Exception $e) {
            $today = Carbon::now();
            $year = $today->year;
            $month = $today->month;
        } finally {
            return view("calendar", [
                'year' => $year,
                'month' => $month
            ]);
        }
    }
}