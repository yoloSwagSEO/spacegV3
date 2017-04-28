<br />
<div id="content">
<div id="trie-button">
<button onclick="window.location.href='game.php?page=buildings&mode=fleet'" class="active">Vaisseaux</button> - <button onclick="window.location.href='game.php?page=buildings&mode=defense'">Defense</button>
</div>

	<div id="shipyardImg">
		<div id="labelshipyard"><p>Chantier spacial</p></div>
		<div id="buildlisting">{buildinglist}</div>
	</div>
    {message}
        <form action="" method="post">
            <div id="container_fleet_build">
                {buildlist}
                {build_fleet}
            </div>
        </form>
    
</div>