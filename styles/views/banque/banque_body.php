<script src="js/gouv.js"></script>
<script src="js/batiments.js"></script>
{BuildListScript}
<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Centre bancaire</p>
        <div id="trie-button">
            <button class="Btabs active" data-tabs="1">Livre des comptes</button>
            <button class="Btabs" data-tabs="2">Opérations</button>
            <button class="Btabs" data-tabs="3">Banque inter-planetaires</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        {message}
        <div id="tabs-1" class="sTabs">
            <p>Prochainement</p>
        </div>
        <div id="tabs-2" class="sTabs" style="display:none;">
            <form action="?page=banque&action=transfer" method="POST" />
            <table width="519" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr height="20">
                    <td colspan="3" class="c">Transfert de fonds interne</td>
                </tr>
                <tr height="20">
                    <th>Montant</th>
                    <th>Colonie</th>
                    <th>-</th>
                </tr>
                <tr height="20">
                    <th><input type="text" name="transfer_value" /></th>
                    <th>
                        <select name="recepteur">
                            {colonie}
                        </select>
                    </th>
                    <th><input type="submit" name="go" value="Go" /></th>
                </tr>
                </tbody>
            </table>
            </form>
            <form action="?page=banque&action=transferE" method="POST" />
            <table width="519" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
                <tbody>
                <tr height="20">
                    <td colspan="4" class="c">Transfert de fonds externes</td>
                <tr height="20">
                    <th>Montant</th>
                    <th>Colonie</th>
                    <th>-</th>
                <tr height="20">
                    <th><input type="text" name="transfer_value" /></th>
                    <th>
                        <input type="text" name="secteur" placeholder="SEC" style="width: 31px" />:<input type="text" name="sys" placeholder="SYS" style="width: 31px" />:<input type="text" name="planet" placeholder="PLN" style="width: 31px" />
                    </th>
                    <th><input type="submit" name="go" value="Go" /></th>
                </tr>
                </tr>
                </tr>
                </tbody>
            </table>
            </form>
        </div>
        <div id="tabs-3" class="sTabs" style="display:none;">
            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
        </div>

    </div>
</div>
