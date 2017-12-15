<script src="js/pages/createFleet.js" ></script>


<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Nouvelle flottes</p>
    </div>
    <div class="col-md-12 bgLR" id="buildlistingBatNew">
        <div class="row">
            <div class="col-md-3">
                Nom Flotte.
                Amiral
                Informations
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="col-md-9">
                        Nom de la flotte : <input type="text" id="fleetNameForm" name"fleetName" />
                    </div>
                    <div class="col-md-3">
                        <a href="#" id="submitFleet" class="btns btn-116-24">Créer la flotte</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <span>Vaisseaux de la flotte.</span>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Vaisseau</th>
                            <th>Nb</th>
                            <th>Vitesse</th>
                            <th>Consomation</th>
                            <th>Capacité</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="NewfleetList">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <span>Vaisseaux disponibles.</span>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Vaisseau</th>
                            <th>Nb</th>
                            <th>Vitesse</th>
                            <th>Consomation</th>
                            <th>Capacité</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="fleetList">
                        {shipRows}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form id="newFleetForm" action="game.php?page=createFleet&action=saveFleet" method="post">

        </form>
    </div>

</div>
