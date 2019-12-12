@push('headScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush

<div class="carousel-item" id="tab-games">
    <!-- FETCH EXAMPLE -->

    <div id="fetch-test">
        Fetch Test
    </div>

    <button class="btn fetch-update" href="api/apiExample" data-target="#fetch-test" data-parser="test" data-replace="true">Fetch !</button>

    <!-- Modal Structure to create game -->
    <div id="formCreateGame" class="modal">
        <div class="modal-content">
            <form method="POST" action="{{ url('/gameCreate') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <select name="templateChoosen" id="optionsTemplates" class="materialSelect">
                    <option value="" disabled selected>Choose your option</option>
                    </select>
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
    <button id="showModal" class="btn fetch-update" href="api/getGameSheet" data-target="#optionsTemplates" data-parser="getTemplates" data-replace="false" data-inselect="true">Create a game !</button>
    
</div>
