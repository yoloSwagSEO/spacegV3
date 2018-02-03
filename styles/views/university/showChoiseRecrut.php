<script src="js/university.js"></script>
<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Université</p>
        <div id="trie-button">
            <button onclick="window.location.href='game.php?page=university'">Spécialiste</button>
            <button onclick="window.location.href='game.php?page=university&mode=recrut'" class="active">Recrutement</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        <center>Le doyen a selectionée pour nous une liste de talent prométeur qui pourrais rejoindre notre gouvernement.</center>


        <div class="row">
            <div class="col-md-12">
                <div class="row innerHeader">
                    <div class="col-md-6 title">
                        Sélection des recrutements
                    </div>
                </div>
                <div class="row innerContent">
                    {choiseList}
                </div>
            </div>
        </div>

    </div>
</div>




