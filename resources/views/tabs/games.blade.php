<div class="carousel-item" id="tab-games">
    <!-- FETCH EXAMPLE -->

    <div id="fetch-test">
        Fetch Test
    </div>

    <button class="btn fetch-update" href="api/apiExample" data-target="#fetch-test" data-parser="test" data-replace="true">Fetch !</button>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <select>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name}}</option>
                    @endforeach
                    </select>
                    <label>Template Selection</label>
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
    
    <!-- Modal Trigger -->
    <button data-target="modal1" class="btn modal-trigger">Create a game !</button>
            

    
</div>
