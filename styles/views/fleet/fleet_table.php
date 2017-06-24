<script language="JavaScript" src="js/flotten-min.js"></script>
<script language="JavaScript" src="js/ocnt-min.js"></script>
<div id="content">
	<div id="list-bat">
		<table class="table table-striped">
			<tr>
				<td class="c">Liste des flottes en vol</td>
			</tr>
			<tr>
				<td>
					<table class="table table-striped">
						<tr>
							<td>{fl_number}</td>
							<td>{fl_mission}</td>
							<td>{fl_ammount}</td>
							<td>{fl_beginning}</td>
							<td>{fl_departure}</td>
							<td>{fl_destiny}</td>
							<td>{fl_objective}</td>
							<td>{fl_arrival}</td>
							<td>{fl_order}</td>
						</tr>
						{fleetpagerow}
						{message_nofreeslot}
					</table>
				</td>
			</tr>
			<tr>
				<td class="c">
                   Liste des flottes disponible <a href="game.php?page=createFleet" class="btns btn-116-24 right">Créer une flotte</a>
                </td>
			</tr>
			<tr>
				<td>
					<table class="table table-striped">
						<tr>
							<td>Id</td>
							<td>Nom</td>
                            <td>Proprietaire</td>
							<td>Composition</td>
							<td>Statut</td>
						</tr>
						{fleetOrbitpagerow}
						{message_nofreeslot}
					</table>
				</td>
			</tr>
		</table>
	{acs_members}
<form action="game.php?page=fleet1" method="POST">
	<div style="float:left;width:241px">
		<table width="240" border="0" cellpadding="0" cellspacing="1">
			<tr height="20">
				<td class="c" colspan="2">Mission</td>
			</tr>
			<tr>
				<th>Cible</th>
				<th><input type="text" name="galaxy" value="{galaxy}" style="float: left;width: 30px;margin-right: 3px;"/>
					<input type="text" name="system" value="{system}"  style="float: left;width: 30px;margin-right: 3px;"/>
					<input type="text" name="planet" value="{planet}" style="float: left;width: 30px;margin-right: 3px;" />
					<select name="planet_type">
						<option value="1">Planete</option>
						<option value="2">Cdr</option>
						<option value="3">Lune</option>
					</select>
				</th>
			</tr>
			<tr>
				<th>Mission</th>
				<th>
					<select name="mission">
						<option value="3">Transporter</option>
						<option value="4">Stationner</option>
						<option value="1">Attaquer</option>
						<option value="6">Espionner</option>
						<option value="7">Coloniser</option>
						<option value="8">Recycler</option>
						<option value="11">Exploit&eacute;</option>
						<option value="12">Invasion</option>
						<option value="16">Analiser</option>
					</select>
				</th>
			</tr>
		</table>
	</div>
	{shipdata}
	<input type="hidden" name="thisgalaxy" value="{target_mission}" />
	<input type="hidden" name="thissystem" value="{target_mission}" />
	<input type="hidden" name="thisplanet" value="{target_mission}" />

	<input type="hidden" name="maxepedition" value="{envoimaxexpedition}" />
	<input type="hidden" name="curepedition" value="{expeditionencours}" />
	<input type="hidden" name="target_mission" value="{target_mission}" />
</form>
</div>
</div>

</div>
</div>