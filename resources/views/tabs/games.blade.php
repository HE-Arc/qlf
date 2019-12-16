@push('headScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush

<div class="carousel-item" id="tab-games">
    <!-- Modal Structure to create game -->
    <div id="formCreateGame" class="modal">
        <div class="modal-content">
            <form method="POST" action="api/games" class="fetch-submit">
            <div class="row">
                <div class="input-field col s12">
                    <select name="templateChoosen" id="optionsTemplates" class="materialSelect"></select>
                    <label>GameSheet Selection</label>
                </div>
                <div>
                    <label> Name of the game </label>
                    <input id="nameGame" type="text" name="nameGame">
                </div>
                <div>
                    <button class="btn" type="submit" name="action">Create</button>
                    <!-- TODO put a cancel button, and maybe close the modal when create a game -->
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Trigger to create a game -->
    <button id="showModal" class="btn fetch-update" href="api/getGameSheet" data-target="#optionsTemplates" data-parser="getTemplates" data-replace="false" data-inselect="true">Create a game !</button>

     <!-- Button to join a game -->
    <button id="" class="btn fetch-update" href="" data-target="" data-parser="" data-replace="" data-inselect="">Join a game !</button>
    
    <br>
    <div class="collection" id="listGames">
    </div>
</div>
