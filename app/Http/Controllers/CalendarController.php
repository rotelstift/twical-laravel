<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function show($year = null, $month = null)
    {
        $today = getdate();
        $month = $today['month'];
        $year = $today['year'];

        return view("calendar", [
            'year' => $year,
            'month' => $month
        ]);
    }
}