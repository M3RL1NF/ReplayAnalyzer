<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <b-navbar toggleable="lg" type="dark">
                <b-navbar-brand href="{{ route('index') }}">
                    <div style="width=100%;">
                        <img width="10%" height="auto" src="{{ asset('img/icon.ico') }}">
                        <img width="70%" height="auto" src="{{ asset('img/title.png') }}">
                    </div>
                </b-navbar-brand>
            </b-navbar>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        @yield('js')

    </body>
</html>