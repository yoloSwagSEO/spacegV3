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
        <center>L'université vous permet de formét l'élite de votre empire, c'est ici que vous pourez choisir de formé vos gouverneur, amiraux, scientifique, ministre... <br />Plus votre université sera évoluer et plus vous aurez de choix pour formé une nouvelle recrut</center>


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




