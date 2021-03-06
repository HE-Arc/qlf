
<footer class="footer">
    <ul id="app-tabs-swipe" class="tabs teal darken-1">
        @auth
            <li class="tab"><a href="#tab-live" class="white-text">Live</a></li>
            <!-- DEFAULT ACTIVE TAB -->
            <li class="tab"><a href="#tab-games" class="white-text active">Games</a></li>
            <li class="tab"><a href="#tab-market" class="white-text">Market</a></li>
            <li class="tab"><a href="#tab-settings" class="white-text">Settings</a></li>
        @endauth
        @guest
            <li class="tab"><a href="#tab-login" class="white-text {{ request()->route()->getName() != 'register' ? 'active' : '' }}">Login</a></li>
            <li class="tab"><a href="#tab-register" class="white-text {{ request()->route()->getName() == 'register' ? 'active' : '' }}">Register</a></li>
        @endguest
    </ul>
</footer>
