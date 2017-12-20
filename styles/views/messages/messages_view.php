<div id="messageview">
	<div class="contentPageNavi"></div>
    <div class="row" id="header_message" >
        <div class="col-md-8">
            <span class="labelM">De :</span> {from}<br />
            <span class="labelM">A :</span>	{to}<br />
            <span class="labelM">Objet :</span> {objet}<br />
            <span class="labelM">Date :</span> {time}
        </div>
        <div id="action" class="col-md-4">
            <a href="game.php?page=createFleet" class="btns btn-116-24 right">Répondre</a>
            <a href="game.php?page=createFleet" class="btns btn-116-24 right">Supprimer</a>
        </div>
    </div>
	<div id="message_corp">
		{text}
	</div>
</div>