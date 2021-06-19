<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Twical</title>
    </head>
    <body>
        <div class="container bg-info-50">
            <h1 class="text-center text-primary display-1">
                <a href="/" class="text-decoration-none">Twical</a>
            </h1>
            <h2 class="text-center">
                <div class="badge bg-primary text-wrap">
                    <a href="{{$prevYearPath}}" class="link-light text-decoration-none"><</a>
                </div>
                {{$year}}年
                <div class="badge bg-primary text-wrap">
                    <a href="{{$nextYearPath}}" class="link-light text-decoration-none">></a>
                </div>
            </h2>
            <h2 class="text-center">
                <div class="badge bg-primary text-wrap">
                    <a href="{{$prevMonthPath}}" class="link-light text-decoration-none"><</a>
                </div>
                {{$month}}月
                <div class="badge bg-primary text-wrap">
                    <a href="{{$nextMonthPath}}" class="link-light text-decoration-none">></a>
                </div>
            </h2>
            <div id="calendar-table">
                <table class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <td>日</td>
                            <td>月</td>
                            <td>火</td>
                            <td>水</td>
                            <td>木</td>
                            <td>金</td>
                            <td>土</td>
                        </tr>
                    </thead>
                    <tbody>
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
                                    <td class="p-0">
                                        <div class="text-end me-1">
                                             {{ $day->day }}
                                        </div>
                                        <div class="text-center mb-3">
                                            43
                                        </div>
                                    </td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>