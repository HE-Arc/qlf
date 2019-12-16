@push('headScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush

<div class="carousel-item" id="tab-games">
    <!-- Modal Structure to create game -->
    <div id="formCreateGame" class="modal">
        <div class="modal-content">
            <h4 class="modal-title">Create a game</h4>

            <form method="POST" action="api/games" class="fetch-submit" data-callback="callback_updateModalCreate">
            <div class="row">
                <div class="input-field col s12">
                    <select name="templateChoosen" id="optionsTemplates" class="materialSelect"></select>
                    <label for="optionsTemplates">GameSheet Selection</label>
                </div>
                <div class="input-field col s12">
                    <input id="nameGame" type="text" name="nameGame">
                    <label for="nameGame">Game Name</label>
                </div>
                <button class="btn btn-large pink waves-effect" type="submit">Create</button>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Structure to join a game -->
    <div id="formJoinGame" class="modal">
        <div class="modal-content">
            <h4 class="modal-title">Join a game</h4>

            <form method="POST" action="api/joinAGame" class="fetch-submit" data-callback="callback_updateModalJoin">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nameJoinGame" type="text" name="nameJoinGame">
                    <label for="nameJoinGame">Game Name</label>
                </div>
                <button class="btn btn-large pink waves-effect" type="submit">Join</button>
            </div>
            </form>
        </div>
    </div>

    <section id="section-games-actions" class="section">
        <div class="center">
            <!-- Modal Trigger to create a game -->
            <button id="showModal" class="btn btn-large pink waves-effect fetch-update" href="api/gamesheets" data-target="#optionsTemplates" data-parser="getTemplates" data-replace="false" data-inselect="true">Create a game !</button>

             <!-- Button to join a game -->
            <button id="showModalJoin" class="btn btn-large pink waves-effect modal-trigger" data-target="formJoinGame">Join a game !</button>
        </div>
    </section>

    <section class="section">
        <h2 class="sub-title">Current games</h2>
        <div id="listGames" class="collection"></div>
    </section>

</div>
