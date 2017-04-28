<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowActionPage
{

	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
		
		$parse= "";
		display(parsetemplate(gettemplate('profil/profil_body'), $parse));
	}
}
?>