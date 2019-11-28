    <header class="header">
            <div class="navbar-fixed">
                <nav class="nav">
                    <div class="nav-wrapper teal darken-3">
                        <a href="#" class="brand-logo left">qlf</a>

                        <ul class="right">
                            @auth
                                <li>
                                    {{ Auth::user()->name }}
                                </li>
                            @endauth
                            @guest
                                <li>
                                    Not connected
                                </li>
                            @endguest
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
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        ><i class="material-icons">exit_to_app</i>Log out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </header>