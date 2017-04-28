<script src="js/gouv.js"></script>
<div id="content">
	<div id="list-bat">
            <div id="labelshipyard"><p>{profilName}</p></div>
			    <div id="profilEmblem">
				    {img}
						{edit}
				</div>
                <div id="profile_general">
                    <div id="over_profile_general">Informations générales</div>
                    <div id="profile_avatard">
                         <img src="styles/images/default_avatar.png" />
                    </div>
                    <div id="profile_info">
                        <div>Pseudo: {pseudo}</div>
                        <div>Sexe: {sexe}</div>
                        <div>Race: {race}</div>
                        <div>Alliance: <a href="game.php?page=alliance&mode=ainfo&a={allyId}">{alliance}</a></div>
                        <div>Planete mere: <a href="game.php?page=fleet&galaxy={g}&system={s}&planet={p}">{home}</a></div>
                    </div>
                </div>
                <div id="profil_medailles">
                    <div id="profil_medailles_over">Médailles</div>
                    <img src="styles/skins/xgproyect/medal/1.png" style="float:left;"/>
                    <img src="styles/skins/xgproyect/medal/2.png" style="float:left;"/>
                    <img src="styles/skins/xgproyect/medal/3.png" style="float:left;"/>
                </div>
            <div class="clear"></div>
            
	</div>
</div>