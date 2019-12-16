
<div id="modal-help" class="modal">
    <div class="modal-content">
        <div class="center">
            <h4 class="modal-title">Help</h4>
            @auth
            <p>To join a game, enter the name of the game created by your friend.</p>
            @endauth
            @guest
            <p>You have to create an account in order to use this application.</p>
            @endguest
        </div>
    </div>
</div>

<div id="modal-about" class="modal">
    <div class="modal-content">
        <div class="center">
            <h4 class="modal-title">About</h4>
            <p>© qfl {{ date('Y') }}</p>
            <p>Web Development Project</p>
            <p>Haute-École ARC - Neuchâtel</p>
            <p>Bouthiller de Baumont François</p>
            <p>Jurasz Loïc</p>
            <p>Vallat Quentin</p>
        </div>
    </div>
</div>
