<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Twical</title>
    </head>
    <body>
        <h1>Twical</h1>
        <h2>{{$year}}年 {{$month}}月</h2>
        <div id="calendar-table">
            <table>
                <th>
                    <tr>日</tr>
                    <tr>月</tr>
                    <tr>火</tr>
                    <tr>水</tr>
                    <tr>木</tr>
                    <tr>金</tr>
                    <tr>土</tr>
                </th>
            </table>
        </div>
    </body>
</html>