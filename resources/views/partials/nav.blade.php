
<header class="header">
    <div class="navbar-fixed">
        <nav class="nav">
            <div class="nav-wrapper teal darken-3">
                <a href="#" class="brand-logo left">qlf</a>

                <ul class="right">
                    @auth
                        <li id="user-username">
                            {{ Auth::user()->name }}
                        </li>
                    @endauth
                    @guest
                        <li>
                            Not connected
                        </li>
                    @endguest
                    <li>
                        <a onclick="randomDice()"><i class="material-icons">crop_square</i></a>
                    </li>
                    <li>
                        <a class='dropdown-trigger' href='#' data-target='header-dropdown'><i class="material-icons">menu</i></a>
                        <ul id='header-dropdown' class='dropdown-content'>
                            <li>
                                <a class="modal-trigger" href="#modal-help"><i class="material-icons">help</i>Help</a>
                            </li>
                            <li>
                                <a class="modal-trigger" href="#modal-about"><i class="material-icons">info</i>About</a>
                            </li>
                            @auth
                                <li>
                                    <a
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        <i class="material-icons">exit_to_app</i>
                                        Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</header>
