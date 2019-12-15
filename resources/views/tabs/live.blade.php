<div class="carousel-item" id="tab-live">
    
    <h1 id="gamesheet-name" style="text-align: center;">Currently not playing ...</h1>
    <p id="gamesheet-info"></p>

    <h2 id="game-name">Maybe you want to <a href="#">create a game</a>?</h2>
    <p id="game-info"></p>

    <!-- TMP: TEST EXAMPLE -->
    <div id="live-game"></div>

    <button class="btn fetch-update fetch-sync" href="api/games/1" data-target="#live-game" data-parser="parseJsonGameTemplate" data-replace="true">Fetch !</button>

    <div id="edit-values">
        <form class="fetch-submit" action="api/games/1" method="POST">
            {{method_field('PATCH')}}
            <input type="text" name="name" value="Uno3">
            <input type="text" name="scores">
            <button type="submit">PATCH</button>
        </form>
    </div>

    <!-- 
        POSTMAN AND LIVE GAME OK
        {
            "name": "Uno2",
            "scores": "{\"0\": {\"0\": 17,\"1\": 7,\"2\": 2},\"1\": {\"0\": 53,\"1\": 29,\"2\": 333},\"2\": {\"0\": 22,\"1\": 101,\"2\": 102}}"
        }
    -->
</div>
