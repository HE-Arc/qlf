<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>qlf</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="favicon.ico">

        <!-- STYLES -->
        <link rel="stylesheet" href="{{ URL::asset('/css/materialize.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/css/frontend.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body>
        <header class="header">
            <div class="navbar-fixed">
                <nav class="nav">
                    <div class="nav-wrapper">
                        <a href="#" class="brand-logo left">qlf</a>
                        <ul class="right">
                            <li><a href="#"><i class="material-icons">create</i></a></li>
                            <li><a href="#"><i class="material-icons">power_settings_new</i></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main class="main">

            <div class="tabs-content carousel carousel-slider">
                <div class="carousel-item blue" id="tab-live"></div>
                <div class="carousel-item red" id="tab-games"></div>
                <div class="carousel-item green" id="tab-market"></div>
                <div class="carousel-item yellow" id="tab-settings"></div>
            </div>

        </main>

        <footer class="footer">
            <ul id="app-tabs-swipe" class="tabs">
                <li class="tab"><a href="#tab-live">Live</a></li>
                <li class="tab"><a href="#tab-games" class="active">Games</a></li>
                <li class="tab"><a href="#tab-market">Market</a></li>
                <li class="tab"><a href="#tab-settings">Settings</a></li>
            </ul>
        </footer>

        <!-- SCRIPTS -->
        <script src="{{ URL::asset('/js/vue.js') }}"></script>
        <script src="{{ URL::asset('/js/app.js') }}"></script>
        <script src="{{ URL::asset('/js/materialize.js') }}"></script>

    </body>
</html>
