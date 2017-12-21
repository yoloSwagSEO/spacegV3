<script src="js/main.js" type="text/javascript"></script>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-10 bgLR bdDotted" id="colonie_background" style="background:url('{dpath}planeten/{planet_image}.jpg')">
				<div class="row">
					<div id="colonie_name" class="col-md-5">
						<span class="glow-box"></span><a class="OverInfo" href="game.php?page=overview&mode=renameplanet" title="{Planet_menu}">{Planet} "{planet_name}"</a> ({user_username})
					</div>
				</div>
				<div class="row" style="    margin-top: 83px;">
					<div id="colonie_gouv" class="col-md-3">
            			<center>Gouverneur</center>
						<div class="gouverneur_content">
			    
						</div>
					</div>
					<div id="colonie_info" class="col-md-6 col-md-offset-3">
						<u>Position :</u> [{galaxy_galaxy}:{galaxy_system}:{galaxy_planet}]<br />
						<u>Type :</u> Tellurique<br />
						<u>{ov_diameter} :</u> {planet_diameter} km <br />
						<u>{ov_temperature} :</u> {ov_temp_from} {planet_temp_min}{ov_temp_unit} {ov_temp_to} {planet_temp_max}{ov_temp_unit}<br />
						<u>Classe :</u> C<br />
						<u>Nombre de lune :</u> 0<br />
						<u>Distance de l'etoile:</u> 2,596 Md de Km<br />
						<u>Date de colonisation :</u>  11/06/2012 a 16h30<br />
					</div>

					<div class="col-md-12" id="case_bar">
						<div style="position: absolute;">Cases occupées
							<font color="#CCF19F">{case_pourcentage}</font></div>
							<div  id="CaseBarre" style="background-color: {case_barre_barcolor}; width: {case_barre}px;float:left;height: 13px;">
		
							</div>
					</div>
				</div>
			</div>
			<div class="col-md-2 bdDotted" id="colonie_lune">
				<div id="lune_col">Orbite(s)</div>
				{moon_img}<br>{moon}
			</div> 
		</div>
		<div class="row">
		    <div class="col-md-12 "><div id="event_header"></div></div>
			<div class="col-md-8 bgLR bdDotted" id="over_message">
				<div id="over_message_name">Messagerie</div>
                <div class="scrollbar scroll-1">
                    <table>
                        {message}
                    </table>
                </div>
			</div>
			<div class="col-md-4 bgLR bdDotted" id="over_fleet">
				<div id="over_control_name">Tour de contrôle</div>
				    <div class="scrollbar scroll-1">
                        <table>
						    {fleet_list}
                        </table>
                    </div>
				</div>
		</div>
	</div>
</div>