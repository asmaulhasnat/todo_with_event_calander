<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('include.header')
</head>
<body>
    <div id="app">
        @include('include.navbar')

        <main class="py-2">
            @include('include.common_success_error')
            @yield('content')
        </main>
    </div>
    @include('include.footer')
    @yield('script')
</body>
</html>
