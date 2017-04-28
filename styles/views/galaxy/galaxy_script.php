
<script language="JavaScript">
function galaxy_submit(value) {
	document.getElementById('auto').name = value;
	document.getElementById('galaxy_form').submit();
}
function fenster(target_url,win_name) {
	var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=640,height=480,top=0,left=0');
	new_win.focus();
}
</script>
<script language="JavaScript" src="js/tw-sack-min.js"></script>
<script language="JavaScript" src="js/galaxie.js"></script>
<script type="text/javascript">
var ajax = new sack();
var strInfo = ""
function whenResponse () {
	retVals   = this.response.split("|");
	Message   = retVals[0];
	Infos     = retVals[1];
	retVals   = Infos.split(" ");
	UsedSlots = retVals[0];
	SpyProbes = retVals[1];
	Recyclers = retVals[2];
	Missiles  = retVals[3];
	retVals   = Message.split(";");
	CmdCode   = retVals[0];
	strInfo   = retVals[1];
	if (CmdCode == 600){addToTable("done", "success");}  
	changeSlots( UsedSlots );
	setShips("probes", SpyProbes );
	setShips("recyclers", Recyclers );
	setShips("missiles", Missiles );
}
function doit (order, galaxy, system, planet, planettype, shipcount) {
	ajax.requestFile = "FleetAjax.php?action=send";
	ajax.runResponse = whenResponse;
	ajax.execute = true;
	ajax.setVar("thisgalaxy", {current_galaxy});
    ajax.setVar("thissystem", {current_system});
    ajax.setVar("thisplanet", {current_planet});
	ajax.setVar("thisplanettype", {planet_type});
	ajax.setVar("mission", order);
	ajax.setVar("galaxy", galaxy);
	ajax.setVar("system", system);
	ajax.setVar("planet", planet);
	ajax.setVar("planettype", planettype);
	if (order == 6)
		ajax.setVar("ship210", shipcount);
	if (order == 7) {
		ajax.setVar("ship208", 1);
		ajax.setVar("ship203", 2);
	}
	if (order == 8)
		ajax.setVar("ship209", shipcount);
    if (order == 16)
		ajax.setVar("ship225", shipcount);
	ajax.runAJAX();
		console.log("tptp");
        return false; 
}
function addToTable(strDataResult, strClass) {
	var e = document.getElementById('fleetstatusrow');
	var e2 = document.getElementById('fleetstatustable');
	e.style.display = '';
	if(e2.rows.length > 2) {
		e2.deleteRow(2);
	}
	var row = e2.insertRow(0);
	var td1 = document.createElement("td");
	var td1text = document.createTextNode(strInfo);
	td1.appendChild(td1text);
	var td2 = document.createElement("td");
	var span = document.createElement("span");
	var spantext = document.createTextNode(strDataResult);
	var spanclass = document.createAttribute("class");
	spanclass.nodeValue = strClass;
	span.setAttributeNode(spanclass);
	span.appendChild(spantext);
	td2.appendChild(span);
	row.appendChild(td1);
	row.appendChild(td2);
}
function changeSlots(slotsInUse) {
	var e = document.getElementById('slots');
	e.innerHTML = slotsInUse;
}
function setShips(ship, count) {
	var e = document.getElementById(ship);
	e.innerHTML = count;
}

jQuery(document).ready(function(){
	$('.doit').click(function(){
		console.log($(this).attr('data-param'));
		var data = $(this).attr('data-param').split('_');
		
			req = new Object();
			req.thisgalaxy = {current_galaxy};
			req.thissystem = {current_system};
			req.thisplanet = {current_planet};
			req.thisplanettype = {planet_type};
			req.mission = data[0];
			req.galaxy = data[1];
			req.system = data[2];
			req.planet = data[3];
			req.planettype = data[4];
		
		
		if (req.mission == 6)
			req.ship210 = data[5];
		if (req.mission == 7) {
			req.ship208 = 1;
		}
		if (req.mission == 8)
			req.ship209 = data[5];
		if (req.mission == 16)
			req.ship225 = data[5];
		
		console.log(req);
		//req = JSON.stringify(req);
		$.ajax({
            type: "POST",
            url: "FleetAjax.php?action=send",
            data: req
        }).done(function( id ) {
            console.log(id);
			console.log('hey');
        });
		return false;
	});
});

</script>