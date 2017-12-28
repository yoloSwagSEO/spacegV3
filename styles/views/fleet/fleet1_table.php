<script type="text/javascript" src="js/flotten2.js"></script>
<script type="text/javascript">
function getStorageFaktor() {
	return 1
}
function returnValue(param) {
/* By lucky - required for the new select box */
var string = shortcuts.options[shortcuts.selectedIndex].value;
	if(string!=0){
		var array=string.split(";");
		return array[param];
	}else{
		return null;
	}
}

$(document).ready(function($){
    $('.fighter-emport').bind('change',function(){
        var count = 0;
        var dispo = parseInt($('#capaciteV').html());
        $('.fighter-emport').each(function(){
            
            if(parseInt($(this).val()) > parseInt($(this).attr('data-max'))){
                $(this).val($(this).attr('data-max'));
            }
            count = count+parseInt($(this).val());
            //dispo = dispo-count;
        });
        //console.log(count);
        var trans = 0;
        if(count > dispo){
            //console.log('OVERLOARD '+count+' '+dispo);
            trans = count-dispo;
             $(this).val(parseInt($(this).val())-trans);
            
        }
    });
});
</script>
<form action="game.php?page=fleet3" method="post" name="gofleet" onsubmit='this.submit.disabled = true;'>


    <div class="row" id="rowBuilding">
        <div id="spacioport" class="col-md-12 bgLR">
            <div class="row">
                <div class="col-md-4">
                    <div class="row" style="margin-bottom: 8px">
                        <div class="col-md-6">
                            <a href="game.php?page=fleet" class="btns btn-116-24">Annuler</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" onclick="gofleet.submit()" class="btns btn-116-24">Continuer</a>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <td colspan="2" class="c">Recapitulatif</td>
                        </tr>
                        <tr>
                            <th>Destination</th>
                            <th>
                                {g} : {s} : {p}
                                <select name="planettype" onChange="shortInfo()" onKeyUp="shortInfo()">
                                    {options_planettype}
                                </select>

                            </th>
                        </tr>
                        <tr>
                            <th>Distance</th>
                            <th>
                                <div id="distance">{distance}</div>
                            </th>
                        </tr>
                        <tr>
                            <th>Vitesse Max</th>
                            <th>
                                <div id="vitessemax">{maxspeed}</div>
                            </th>
                        </tr>
                        <tr>
                            <th>Dur&eacute;e</th>
                            <th>
                                <div id="duree">{duration}</div>
                            </th>
                        </tr>
                        <tr>
                            <th>Consomation</th>
                            <th>
                                <div id="consomation">{consomation}</div>
                            </th>
                        </tr>
                        <tr>
                            <th>Capacit&eacute;</th>
                            <th>
                                <div id="capacite">{capacity}</div>
                            </th>
                        </tr>
                        <tr>
                            <th>Capacit&eacute; Chasseur</th>
                            <th>
                                <div id="capaciteV">{transportFighter}</div>
                            </th>
                        </tr>
                    </table>
                    <table class="table table-striped">
                        <tr height="20">
                            <td colspan="2" class="c">Option</td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                Ne pas débarqu&eacute; les troupes au sol <input type="checkbox" name="debarq" value="0" />
                            </th>
                        </tr>
                        <tr>
                            <th>Facteur de vitesse :
                                <select name="speed" id="speed_factor">
                                    <option value="10">100%</option>
                                    <option value="9">90%</option>
                                    <option value="8">80%</option>
                                    <option value="7">70%</option>
                                    <option value="6">60%</option>
                                    <option value="5">50%</option>
                                    <option value="4">40%</option>
                                    <option value="3">30%</option>
                                    <option value="2">20%</option>
                                    <option value="1">10%</option>
                                </select>
                            </th>
                            <th></th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tr height="20">
                            <td colspan="3" class="c">Emporter</td>
                        </tr>
                        <tr>
                            <th>Metal : <input type="text" name="metal_e" id="metal_e" value="0" style="width: 80px;"/></th>
                            <th>Cristal : <input type="text" name="cristal_e" id="crital_e" value="0" style="width: 80px;" /></th>
                            <th>Uradium : <input type="text" name="uradium_e" id="uradium_e" value="0"  style="width: 80px;"/></th>
                        </tr>
                    </table>
                    <table class="table table-striped">
                        <tr height="20">
                            <td colspan="4" class="c">Emport de chasseur</td>
                        </tr>
                        {transportable}
                    </table>
                    <table class="table table-striped">
                        <tr height="20">
                            <td colspan="4" class="c">Emport de troupes</td>
                        </tr>
                        {transportables_units}
                    </table>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td colspan="5" class="c">Liste</td>
                            </tr>
                            <tr>
                                <th>Nom</th>
                                <th>Nb</th>
                                <th>Conso</th>
                                <th>Vitesse</th>
                                <th>Capacite</th>
                            </tr>
                            {list_fleet}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {fleetblock}
    <input type="hidden" name="fleetSelectedId" value="{fleetSelectedId}" />
    <input type="hidden" name="speedallsmin"   value="{speedallsmin}" />
    <input type="hidden" name="usedfleet"      value="{fleetarray}" />
    <input type="hidden" name="thisgalaxy"     value="{galaxy}" />
    <input type="hidden" name="thissystem"     value="{system}" />
    <input type="hidden" name="thisplanet"     value="{planet}" />
    <input type="hidden" name="galaxyend"      value="{galaxy_post}" />
    <input type="hidden" name="systemend"      value="{system_post}" />
    <input type="hidden" name="planetend"      value="{planet_post}" />
    <input type="hidden" name="speedfactor"   id="speedfactor" value="{speedfactor}" />
    <input type="hidden" name="thisplanettype" value="{planet_type}" />
    <input type="hidden" name="thisresource1"  id="metal_in" value="{metal}" />
    <input type="hidden" name="thisresource2"  id="crital_in" value="{crystal}" />
    <input type="hidden" name="thisresource3"  id="uradium_in" value="{deuterium}" />
    <input type="hidden" name="totalTransportable"  id="transportFighter" value="{transportFighter}" />
	<input type="hidden" name="consobase" id="consobase"  value="{consobase}" />
	<input type="hidden" name="galaxy"     value="{g}" />
    <input type="hidden" name="system"     value="{s}" />
    <input type="hidden" name="planet"     value="{p}" />
	<input type="hidden" name="usedsoute" id="usedsoute"  value="0" />
	<input type="hidden" name="mission" value="{mission}" />
    <input name="fleet_group" type="hidden" onChange="shortInfo()" onKeyUp="shortInfo()" value="0" />
    <input name="acs_target_mr" type="hidden" onChange="shortInfo()" onKeyUp="shortInfo()" value="0:0:0" />

	<input name="fleet_group" type="hidden" onChange="shortInfo()" onKeyUp="shortInfo()" value="0" />
    <input name="acs_target_mr" type="hidden" onChange="shortInfo()" onKeyUp="shortInfo()" value="0:0:0" />
    <input type="hidden" name="maxepedition" value="{maxepedition}" />
    <input type="hidden" name="curepedition" value="{curepedition}" />
    <input type="hidden" name="target_mission" value="{target_mission}" />
</form>