<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowStargatePage
{

	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
		
		$parse= "";
		display(parsetemplate(gettemplate('stargate/stargate_body'), $parse));
	}
}
?>