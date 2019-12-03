<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- 
            qlf
                François Bouthillier
                Loïc Jurasz
                Quentin Vallat

                He-Arc - 2019
        -->
        <meta charset="utf-8">
        <title>qlf</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="favicon.ico">

        <!-- STYLES -->
        <link rel="stylesheet" href="{{ URL::asset('/css/materialize.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/css/frontend.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        @stack('styles')

    </head>
    <body>
        
        <!-- navigation bar -->
        @include('partials.nav')

        <!-- content -->
        <main class="main grey darken-3 white-text">

            <div class="tabs-content carousel carousel-slider">
                    @yield('main')
            </div>
        @yield('test')
        </main>

        <!-- navigation bar -->
        @include('partials.footer')

        <!-- SCRIPTS -->
        <!--script src="{{ URL::asset('/js/vue.js') }}"></script-->
        <script src="{{ URL::asset('/js/app.js') }}"></script>
        <script src="{{ URL::asset('/js/fetch.js') }}"></script>
        <script src="{{ URL::asset('/js/materialize.js') }}"></script>
        @stack('scripts')

    </body>
</html>
