<script src="js/university.js"></script>
<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Université</p>
        <div id="trie-button">
            <button onclick="window.location.href='game.php?page=buildings&mode=fleet'" class="active">Spécialiste</button>
            <button onclick="window.location.href='game.php?page=buildings&mode=defense'">Recrutement</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        <center>L'université vous permet de formét l'élite de votre empire, c'est ici que vous pourez choisir de formé vos gouverneur, amiraux, scientifique, ministre... <br />Plus votre université sera évoluer et plus vous aurez de choix pour formé une nouvelle recrut</center>


        <div class="row">
            <div class="col-md-12">
                <div class="row innerHeader">
                    <div class="col-md-6 title">
                        Spécialistes disponible
                    </div>
                    <div class="col-md-6">
                        <div id="trie-button">
                            <button class="all active">Tous</button>
                            <button class="politique">Politique</button>
                            <button class="science">Science</button>
                            <button class="spacial">Spacial</button>
                            <button class="militaire">Militaire</button>
                        </div>
                    </div>
                </div>
                <div class="row innerContent">
                    <div class="col-md-4 itemRecrut">
                        <div class="col-md-4 imgRecrut">
                            <img src="styles/images/default_avatar.png" />
                        </div>
                        <div class="col-md-8 detailRecrut">
                            <div class="function row">
                                <div class="col-md-8">Gouverneur</div>
                                <div class="col-md-4 text-right">Age</div>
                            </div>
                            <div class="name row">
                                <div class="col-md-8">Nom Prenom</div>
                                <div class="col-md-4 text-right">xx</div>
                            </div>
                            <div class="lvl">Lvl:
                                <i class="fa fa-star star-gold" aria-hidden="true"></i>
                                <i class="fa fa-star star-gold" aria-hidden="true"></i>
                                <i class="fa fa-star star-gold" aria-hidden="true"></i>
                                <i class="fa fa-star star-gold" aria-hidden="true"></i>
                                <i class="fa fa-star star-gold" aria-hidden="true"></i>
                            </div>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



