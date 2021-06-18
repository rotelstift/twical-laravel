<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Twical</title>
    </head>
    <body>
        <h1>Twical</h1>
        <h2><a href="{{$prevYearPath}}"><</a> {{$year}}年 <a href="{{$nextYearPath}}">></a></h2>
        <h2><a href="{{$prevMonthPath}}"><</a> {{$month}}月 <a href="{{$nextMonthPath}}">></a></h2>
        <div id="calendar-table">
            <table>
                <th>
                    <tr>
                        <td>日</td>
                        <td>月</td>
                        <td>火</td>
                        <td>水</td>
                        <td>木</td>
                        <td>金</td>
                        <td>土</td>
                    </tr>
                </th>
                <tr>
                    @foreach ($days as $day)
                        @if ($loop->first)
                            @for ($i = 0; $i < $day->dayOfWeek; $i++)
                                <td></td>
                            @endfor
                        @endif
                        @if ($day->dayOfWeek === 0)
                            <tr>
                        @endif
                            <td>{{ $day->day }}</td>
                        @if ($day->dayOfWeek === 6)
                            </tr>
                        @endif
                        @if ($loop->last)
                            @for ($i = $day->dayOfWeek; $i < 6; $i++)
                                <td></td>
                            @endfor
                        @endif
                    @endforeach
                </tr>
            </table>
        </div>
    </body>
</html>