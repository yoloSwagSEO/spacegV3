<?php
if(!defined('INSIDE')){ die(header("location:../../"));}

	function IsElementLimit ($CurrentUser, $CurrentPlanet, $Element, $Incremental = TRUE, $ForDestroy = FALSE)
	{
		global $pricelist, $resource,$limit;

		if(isset($limit[$Element]) && $CurrentPlanet[$resource[$Element]] >= $limit[$Element]){
			
			return true;
		}else{
			return false;
		}
	}

?>