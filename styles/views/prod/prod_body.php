<script src="js/pages/ressources.js"></script>
<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Rapport de ressources</p>
        <div id="trie-button">
            <button class="btabsE active" data-tabs="all">Tous</button>
            <button class="btabsE" data-tabs="1">Batiments</button>
            <button class="btabsE" data-tabs="2">Ministre & Bonus</button>
            <button class="btabsE" data-tabs="3">Materiels</button>
            <button class="btabsE" data-tabs="4">Total</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        <form action="" method="post">
            <table class="table table-striped">
                <tr>
                    <td class="c">Productions des batiments de la colonie</td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-striped table-hover">
                            <tr>
                                <td colspan="2"></td>
                                <th>Etat</th>
                                <th>Metal</th>
                                <th>Cristal</th>
                                <th>Uradium</th>
                                <th>Cr&eacute;dits</th>
                                <th>Energie</th>
                            </tr>
                            {batiment_line}
                            <tr class="sTabs sTabs-2">
                                <td class="c" colspan="8">Productions ministres et bonus</td>
                            </tr>
                            {bonus_line}
                            <tr class="sTabs sTabs-3">
                                <td class="c" colspan="8">Productions materiels</td>
                            </tr>
                            {material_line}
                            <tr class="sTabs sTabs-4">
                                <td class="c" colspan="8">Total / Pr&eacute;visionel</td>
                            </tr>

                            {total}
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>