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
            <!-- header -->
            <b-navbar type="dark" style="background-color: #131212" sticky>
                <b-container>
                    <b-row>
                        <b-col cols="10" class="mt-1">
                            <h1>
                                <b-link href="{{ route('index') }}">
                                    <b style="text-decoration: none; color: white;">
                                        <img width="50%" height="130%" src="{{ asset('img/title.png') }}">
                                    </b>
                                </b-link>
                            </h1>
                        </b-col>

                        <b-col cols="2" class="mt-1">
                            <h1>
                                <b-link href="https://eu.wargaming.net/">
                                    <b style="text-decoration: none; color: white;">
                                        <img width="80%" height="80%" src="{{ asset('img/wargaming.png') }}">
                                    </b>
                                </b-link>
                            </h1>
                        </b-col>
                    <b-row>
                </b-container>
            </b-navbar>

            <!-- content -->
            <main class="py-4">
                @yield('content')
            </main>

            <!-- footer -->
            <b-navbar type="dark" style="background-color: #131212">
                <b-navbar-nav class="mx-auto">
                    <b-nav-item href="{{ route('imprint') }}">Imprint</b-nav-item>
                    <b-nav-item href="{{ route('privacyPolicy') }}">Privacy Policy</b-nav-item>
                    <b-nav-item href="{{ route('donations') }}">Donations</b-nav-item>
                    <b-nav-item href="{{ route('info') }}">Info</b-nav-item>
                    <b-nav-item href="#"><b>Inlayne</b></b-nav-item>
                </b-navbar-nav>
            </b-navbar>

            <b-navbar type="dark" style="background-color: #131212">
                <b-navbar-nav class="mx-auto">
                    <p style="font-size: 70%;">
                        World of tanks Maps is a free web service for <a href="https://eu.wargaming.net/en/games/wot" style="color: white;"><u>World of Tanks</u></a>. 
                        World of tanks Maps is not an official website of Wargaming.net or any of its services. 
                        World of Tanks is a trademark of <a href="https://eu.wargaming.net/en" style="color: white;"><u>Wargaming.net</u></a>.
                    </p>
                </b-navbar-nav>
            </b-navbar>
        </div>

        @yield('js')

    </body>
</html>