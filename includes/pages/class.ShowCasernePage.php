<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowCasernPage
{
	//optimized by alivan & jstar
	private function GetMaxConstructibleElements ($Element, $Ressources)
    {
        global $pricelist;

        $Buildable=array();
        if ($pricelist[$Element]['metal'] != 0)
            $Buildable['metal']     = floor($Ressources["metal"] / $pricelist[$Element]['metal']);

        if ($pricelist[$Element]['crystal'] != 0)
            $Buildable['crystal']   = floor($Ressources["crystal"] / $pricelist[$Element]['crystal']);

        if ($pricelist[$Element]['deuterium'] != 0)
            $Buildable['deuterium'] = floor($Ressources["deuterium"] / $pricelist[$Element]['deuterium']);

        if ($pricelist[$Element]['energy'] != 0)
            $Buildable['energy']    = floor($Ressources["energy_max"] / $pricelist[$Element]['energy']);

        return max(min($Buildable),0);
    }

	private function GetElementRessources($Element, $Count)
	{
		global $pricelist;

		$ResType['metal']     = ($pricelist[$Element]['metal']     * $Count);
		$ResType['crystal']   = ($pricelist[$Element]['crystal']   * $Count);
		$ResType['deuterium'] = ($pricelist[$Element]['deuterium'] * $Count);

		return $ResType;
	}

	private function ElementBuildListBox ( $CurrentUser, $CurrentPlanet )
	{
            //print_r($_POST);
		global $lang, $pricelist;

		$ElementQueue 	= explode(';', $CurrentPlanet['b_casern_id']);
		$NbrePerType  	= "";
		$NamePerType  	= "";
		$TimePerType  	= "";
		$QueueTime		= 0;
		
		foreach($ElementQueue as $ElementLine => $Element)
		{
			if ($Element != '')
			{
				$Element 		= explode(',', $Element);
				$ElementTime  	= GetBuildingTime( $CurrentUser, $CurrentPlanet, $Element[0] );
				$QueueTime   	+= $ElementTime * $Element[1];
				
				$TimePerType 	.= "".$ElementTime.",";
				$NamePerType 	.= "'". html_entity_decode ( $lang['tech'][$Element[0]], ENT_COMPAT , "utf-8" ) ."',";
				$NbrePerType 	.= "".$Element[1].",";
			}
		}

		$parse 							= $lang;
		$parse['a'] 					= $NbrePerType;
		$parse['b'] 					= $NamePerType;
		$parse['c'] 					= $TimePerType;
		$parse['b_hangar_id_plus'] 		= $CurrentPlanet['b_casern'];
		$parse['pretty_time_b_hangar'] 	= Format::pretty_time($QueueTime - $CurrentPlanet['b_casern']);

		return parsetemplate(gettemplate('buildings/buildings_script'), $parse);
	}

	public function CasernBuildingPage ( &$CurrentPlanet, $CurrentUser )
	{
		global $lang, $resource, $reslist;
                //print_r($_POST);
		include_once(XGP_ROOT . 'includes/functions/IsTechnologieAccessible.php');
		include_once(XGP_ROOT . 'includes/functions/GetElementPrice.php');

		$parse = $lang;
		
		if (isset($_POST['fmenge']))
		{
			//echo 'je passe';
			
			$AddedInQueue = FALSE;

			foreach($_POST['fmenge'] as $Element => $Count)
			{
				if(($Element < 800 OR $Element > 1000) || !in_array($Element, $reslist['casern']))
				{
					continue;
				}

				$Element = intval($Element);
				$Count   = intval($Count);

				if ($Count > MAX_FLEET_OR_DEFS_PER_ROW)
				{
					$Count = MAX_FLEET_OR_DEFS_PER_ROW;
				}
                                
				if ($Count != 0)
				{
					if ( IsTechnologieAccessible ($CurrentUser, $CurrentPlanet, $Element) )
					{
						$MaxElements   = $this->GetMaxConstructibleElements ( $Element, $CurrentPlanet );

						if ($Count > $MaxElements)
							$Count = $MaxElements;

						$Ressource = $this->GetElementRessources ( $Element, $Count );

						if ($Count >= 1)
						{
							$CurrentPlanet['metal']          -= $Ressource['metal'];
							$CurrentPlanet['crystal']        -= $Ressource['crystal'];
							$CurrentPlanet['deuterium']      -= $Ressource['deuterium'];
							$CurrentPlanet['b_casern_id']    .= "". $Element .",". $Count .";";
                                                      
                                                       //die();
						}
					}
				}
			}
			header ("Location: game.php?page=buildings&mode=casern");

		}

		if ($CurrentPlanet[$resource[37]] == 0){
			message($lang['bd_casern_required'], '', '', TRUE);
			die();
		}
		$NotBuilding = TRUE;

		if ($CurrentPlanet['b_building_id'] != 0)
		{
			$CurrentQueue = $CurrentPlanet['b_building_id'];
                       
			if (strpos ($CurrentQueue, ";"))
			{
				// FIX BY LUCKY - IF THE SHIPYARD IS IN QUEUE THE USER CANT RESEARCH ANYTHING...
				$QueueArray		= explode (";", $CurrentQueue);

				for($i = 0; $i < MAX_BUILDING_QUEUE_SIZE; $i++)
				{
					$ListIDArray	= explode (",", $QueueArray[$i]);
					$Element		= $ListIDArray[0];

					if ( ($Element == 37 ) or ( $Element == 14 ) or ( $Element == 15 ) )
					{
						break;
					}
				}
				// END - FIX
			}
			else
			{
				$CurrentBuilding = $CurrentQueue;
			}

			if ( ( ( $CurrentBuilding == 37 ) or ( $CurrentBuilding == 14 ) or ( $CurrentBuilding == 15 ) ) or  (($Element == 21 ) or ( $Element == 14 ) or ( $Element == 15 )) ) // ADDED (or $Element == 21) BY LUCKY
			{
				$parse[message] = "<font color=\"red\">".$lang['bd_building_shipyard']."</font>";
				$NotBuilding = FALSE;
			}
		}

		$TabIndex 	= 0;
		$PageTable	= '';
		$BuildQueue	= '';
		foreach($lang['tech'] as $Element => $ElementName)
		{
			if (($Element > 800 && $Element <= 1000) && in_array($Element, $reslist['casern']))
			{
                            
				if (IsTechnologieAccessible($CurrentUser, $CurrentPlanet, $Element))
				{
					$CanBuildOne         			= IsElementBuyable($CurrentUser, $CurrentPlanet, $Element, FALSE);
					$BuildOneElementTime 			= GetBuildingTime($CurrentUser, $CurrentPlanet, $Element);
					$ElementCount        			= $CurrentPlanet[$resource[$Element]];
					$ElementNbre         			= ($ElementCount == 0) ? "" : " (". $lang['bd_available'] . Format::pretty_number($ElementCount) . ")";

					$parse['dpath']					= DPATH;
					$parse['add_element']			= '';
					$parse['element']				= $Element;
					$parse['element_name']			= $ElementName;
					$parse['element_description']	= $lang['res']['descriptions'][$Element];
					$parse['element_price']			= GetElementPrice($CurrentUser, $CurrentPlanet, $Element, FALSE);
					$parse['building_time']			= ShowBuildTime($BuildOneElementTime);
					$parse['element_nbre']			= $ElementNbre;

					if ($CanBuildOne && $NotBuilding)
					{
						$TabIndex++;
						$parse['add_element'] 	= "<input type=text name=fmenge[".$Element."] alt='".$lang['tech'][$Element]."' size=6 maxlength=6 value=0 tabindex=".$TabIndex."><input type=\"submit\" value=\"".$lang['bd_build_ships']."\">";
					}

					if($NotBuilding)
					{
						$parse['build_fleet'] 	= "<tr><td class=\"c\" colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"".$lang['bd_build_ships']."\"></td></tr>";
					}

					$PageTable .= parsetemplate(gettemplate('buildings/buildings_casern_row'), $parse);
				}
			}
		}

		if ($CurrentPlanet['b_casern_id'] != '')
			$BuildQueue .= $this->ElementBuildListBox( $CurrentUser, $CurrentPlanet );

		$parse['buildlist']    	= $PageTable;
		$parse['buildinglist'] 	= $BuildQueue;
		display(parsetemplate(gettemplate('buildings/buildings_casern'), $parse));
	}


}
?>