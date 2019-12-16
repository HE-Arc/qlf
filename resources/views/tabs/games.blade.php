@push('headScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush

<div class="carousel-item" id="tab-games">
    <!-- Modal Structure to create game -->
    <div id="formCreateGame" class="modal">
        <div class="modal-content">
            <form method="POST" action="{{ url('/games') }}">
            <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <button class="btn"formaction="{{ route('home') }}">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Trigger to create game -->
    <button id="showModal" class="btn fetch-update" href="api/gamesheets" data-target="#optionsTemplates" data-parser="getTemplates" data-replace="false" data-inselect="true">Create a game !</button>
    
    <div id="listGames"></div>
</div>
