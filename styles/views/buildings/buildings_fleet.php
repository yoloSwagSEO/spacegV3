<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Chantier spacial</p>
        <div id="trie-button">
            <button onclick="window.location.href='game.php?page=buildings&mode=fleet'" class="active">Vaisseaux</button>
            <button onclick="window.location.href='game.php?page=buildings&mode=defense'">Defense</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        {buildinglist}
    </div>
    <div class="col-md-12 bgLR" id="buildlistingBatNew">
        {message}
        <form action="" method="post">
            {buildlist}
            {build_fleet}
        </form>
    </div>
</div>