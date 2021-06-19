@extends('parts.layout')
@section('content')
    @include('parts.tweets')
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
    <div id="calendar-table" class="p-2">
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
                                    <a herf="#" data-bs-toggle="modal" class=" btn btn-outline-primary" data-bs-target="#tweetsModal">43</a>
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
@endsection