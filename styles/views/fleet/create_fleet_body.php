<div id="content">
	<div id="list-bat">
        <div class="row">
            <div class="col-md-12">Nouvelle flottes</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Nom Flotte.
                Amiral
                Informations
            </div>

            <div class="col-md-9">
                <div class="col-md-12">Nom de la flotte : <input type="input" name"fleetName" /></div>
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
		<div class="clear"></div>
	</div>
</div>