

<div class="item_batiment">
	<div class="img"> 
		<img src="{dpath}gebaeude/{tech_id}.gif" class="tooltipbat" title="{descriptions}" data-id="{tech_id}" style="border-radius: 7px;" />
		<div class="build">{tech_link}</div>
		<div class="name"><a href="game.php?page=infos&gid={tech_id}" class="infoshow tooltipbat">{tech_name}</a> </div>
		<div class="niveau"><center>{tech_level}</center></div>
		<div class="nobuild" style="{nobuild}"><a href="#" class="tooltipbat" title="{descriptions}" data-id="{tech_id}" ></a></div>
	</div>

<div class="clear"></div>
</div>

<div class="item_info" id="itemm_info_{tech_id}" style="display:none;">
{tech_descr}<br>
		{tech_price}
		{search_time}<br />
</div> 