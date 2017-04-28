<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */


if(!defined('INSIDE')){die(header("location:../../"));}

function CreateOneSecteurRecord($Galaxy,$System,$Position,$PlanetOwnerID,$PlanetName = '',$HomeWorld = FALSE)
{
   global $lang, $user;

      $planet = PlanetSizeRandomiser($Position,$HomeWorld);
      $planet['metal'] = 0;
      $planet['crystal'] = 0;
      $planet['deuterium'] = 0;
      $planet['metal_perhour'] = read_config ( 'metal_basic_income' );
      $planet['crystal_perhour'] = read_config ( 'crystal_basic_income' );
      $planet['deuterium_perhour'] = read_config ( 'deuterium_basic_income' );
      $planet['metal_max'] = BASE_STORAGE_SIZE;
      $planet['crystal_max'] = BASE_STORAGE_SIZE;
      $planet['deuterium_max'] = BASE_STORAGE_SIZE;
	  $QryUpdatePlanet  = "UPDATE {{table}} SET";
	  $QryUpdatePlanet .= "`id_owner` = '" . $PlanetOwnerID . "', ";
	  $QryUpdatePlanet .= "`control_type` = '2', ";
	  $QryUpdatePlanet .= "`metal_perhour` = '" . $planet['metal_perhour'] . "', ";
	  $QryUpdatePlanet .= "`crystal_perhour` = '" . $planet['crystal_perhour'] . "', ";
	  $QryUpdatePlanet .= "`deuterium_perhour` = '" . $planet['deuterium_perhour'] . "', ";
	  $QryUpdatePlanet .= "`metal_max` = '" . $planet['metal_max'] . "', ";
	  $QryUpdatePlanet .= "`crystal_max` = '" . $planet['crystal_max'] . "', ";
	  $QryUpdatePlanet .= "`deuterium_max` = '" . $planet['deuterium_max'] . "',";
	  $QryUpdatePlanet .= "`metal` = '" . $planet['metal'] . "', ";
	  $QryUpdatePlanet .= "`crystal` = '" . $planet['crystal'] . "', ";
          $QryUpdatePlanet .= "`deuterium` = '" . $planet['deuterium'] . "', ";
          $QryUpdatePlanet .= "`credit` = '0', ";
          $QryUpdatePlanet .= "`last_update` = '".time()."' ";
	  $QryUpdatePlanet .= "WHERE `galaxy` ='".$Galaxy."' AND `system` ='".$System."' AND `planet` = '".$Position."'";
      doquery($QryUpdatePlanet,'planets');

      $QrySelectPlanet = "SELECT `id` ";
      $QrySelectPlanet .= "FROM {{table}} ";
      $QrySelectPlanet .= "WHERE ";
      $QrySelectPlanet .= "`galaxy` = '" . $planet['galaxy'] . "' AND ";
      $QrySelectPlanet .= "`system` = '" . $planet['system'] . "' AND ";
      $QrySelectPlanet .= "`planet` = '" . $planet['planet'] . "' AND ";
      $QrySelectPlanet .= "`id_owner` = '" . $planet['id_owner'] . "';";
      $GetPlanetID = doquery($QrySelectPlanet,'planets',TRUE);

      $QrySelectGalaxy = "SELECT * ";
      $QrySelectGalaxy .= "FROM {{table}} ";
      $QrySelectGalaxy .= "WHERE ";
      $QrySelectGalaxy .= "`galaxy` = '" . $planet['galaxy'] . "' AND ";
      $QrySelectGalaxy .= "`system` = '" . $planet['system'] . "' AND ";
      $QrySelectGalaxy .= "`planet` = '" . $planet['planet'] . "';";
      $GetGalaxyID = doquery($QrySelectGalaxy,'galaxy',TRUE);

      if($GetGalaxyID)
      {
         $QryUpdateGalaxy = "UPDATE {{table}} SET ";
         $QryUpdateGalaxy .= "`id_planet` = '" . $GetPlanetID['id'] . "' ";
         $QryUpdateGalaxy .= "WHERE ";
         $QryUpdateGalaxy .= "`galaxy` = '" . $planet['galaxy'] . "' AND ";
         $QryUpdateGalaxy .= "`system` = '" . $planet['system'] . "' AND ";
         $QryUpdateGalaxy .= "`planet` = '" . $planet['planet'] . "';";
         doquery($QryUpdateGalaxy,'galaxy');
      }

      $RetValue = TRUE;

   return $RetValue;
}
?>