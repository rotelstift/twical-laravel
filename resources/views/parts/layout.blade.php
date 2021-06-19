<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('parts.head')
    </head>
    <body>
        <div class="container p-0">
            @include('parts.header')
            @yield('content')
            @include('parts.footer')
        </div>
    </body>
</html>