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
                    <div class="nav-wrapper teal darken-3">
                        <a href="#" class="brand-logo left">qlf</a>

                        <ul class="right">

                            <!-- TEMPORAIRE: TEST -->
                            <li><a class="btn" onclick="toast('Salut pétole !', TOAST.INFO);">TOAST</a></li>


                            <li>
                                <a href="#"><i class="material-icons">power_settings_new</i></a>
                            </li>
                            <li>
                                <a class='dropdown-trigger' href='#' data-target='header-dropdown'><i class="material-icons">menu</i></a>
                                <ul id='header-dropdown' class='dropdown-content'>
                                    <li>
                                        <a href="#!"><i class="material-icons">help</i>Help</a>
                                    </li>
                                    <li>
                                        <a href="#!"><i class="material-icons">info</i>About</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </header>

        <main class="main grey darken-3 white-text">

            <div class="tabs-content carousel carousel-slider">
                <div class="carousel-item" id="tab-live">
                    @include('partials.tabs.live')
                </div>
                <div class="carousel-item" id="tab-games">
                    @include('partials.tabs.games')
                </div>
                <div class="carousel-item" id="tab-market">
                    @include('partials.tabs.market')
                </div>
                <div class="carousel-item" id="tab-settings">
                    @include('partials.tabs.settings')
                </div>
            </div>

        </main>

        <footer class="footer">
            <ul id="app-tabs-swipe" class="tabs teal darken-1">
                <li class="tab"><a href="#tab-live" class="white-text">Live</a></li>
                <li class="tab"><a href="#tab-games" class="white-text active">Games</a></li>
                <li class="tab"><a href="#tab-market" class="white-text">Market</a></li>
                <li class="tab"><a href="#tab-settings" class="white-text">Settings</a></li>
            </ul>
        </footer>

        <!-- SCRIPTS -->
        <!--script src="{{ URL::asset('/js/vue.js') }}"></script-->
        <script src="{{ URL::asset('/js/app.js') }}"></script>
        <script src="{{ URL::asset('/js/fetch.js') }}"></script>
        <script src="{{ URL::asset('/js/materialize.js') }}"></script>

    </body>
</html>
