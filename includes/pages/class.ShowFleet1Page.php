<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header ( 'location:../../' ));}

class ShowFleet1Page
{
	function __construct ( $CurrentUser , $CurrentPlanet )
	{
		global $resource, $pricelist, $reslist, $lang, $transportable,$debugbar;

		#####################################################################################################
		// SOME DEFAULT VALUES
		#####################################################################################################
		// QUERYS
		$getCurrentAcs      = doquery ( "SELECT * FROM {{table}} ;" , 'aks' ); 

		// ARRAYS
		$speed_values		= array(10 => 100,9 => 90,8 => 80,7 => 70,6 => 60,5 => 50,4 => 40,3 => 30,2 => 20,1 => 10);
		$planet_type		= array ( 'fl_planet' , 'fl_debris' , 'fl_moon' );

		// LOAD TEMPLATES REQUIRED
		$inputs_template			= gettemplate ( 'fleet/fleet1_inputs' );
		$options_template			= gettemplate ( 'fleet/fleet_options' );
		$shortcut_row_template		= gettemplate ( 'fleet/fleet1_shortcuts_row' );
		$shortcut_noshortcuts 		= gettemplate ( 'fleet/fleet1_shortcuts_noshortcuts_row' );
		$shortcut_acs_row			= gettemplate ( 'fleet/fleet1_shortcut_acs_row' );

		// LANGUAGE
		$parse 						= $lang;

		// COORDS
		$g 					= ( ( $_POST['galaxy'] == '' ) ? $CurrentPlanet['galaxy'] : $_POST['galaxy'] );
		$s 					= ( ( $_POST['system'] == '' ) ? $CurrentPlanet['system'] : $_POST['system'] );
		$p 					= ( ( $_POST['planet'] == '' ) ? $CurrentPlanet['planet'] : $_POST['planet'] );
		$t 					= ( ( $_POST['planet_type'] == '' ) ? $CurrentPlanet['planet_type'] : $_POST['planet_type'] );

		// OTHER VALUES
		$value				= 0;
		$FleetHiddenBlock  	= '';
		#####################################################################################################
		// END DEFAULT VALUES
		#####################################################################################################

		#####################################################################################################
		// LOAD SHIPS INPUTS
		#####################################################################################################
		$fleet['fleetlist']	= '';
		$fleet['amount']   	= 0;
		$fleetSpeed = array();
		$consomation = 0;
		$capacite = 0;
		$liste_fleet ='';
		foreach ( $reslist['fleet'] as $n => $i )
		{
			if ( $i >= 201 && $i <= 230 && isset($_POST["ship$i"]) && $_POST["ship$i"] > "0" )
			{
				
				if ( ( $_POST["ship$i"] > $CurrentPlanet[$resource[$i]]) OR (!ctype_digit( $_POST["ship$i"] )))
				{
					header ( 'location:game.php?page=fleet' );
				}
				else
				{
				
					$fleet['fleetarray'][$i]   	= $_POST["ship$i"];
					$fleet['fleetlist']        .= $i . "," . $_POST["ship$i"] . ";";
					$fleet['amount']           += $_POST["ship$i"];
					$fleet['i']				   	= $i;
					$fleet['consumption']		= Fleets::ship_consumption ( $i, $CurrentUser );
					$fleet['speed']				= Fleets::fleet_max_speed ( "", $i, $CurrentUser );
					$fleet['capacity']			= $pricelist[$i]['capacity'];
                    $fleet['transportVx']       = $pricelist[$i]['transportVx']*$_POST["ship$i"];
                    $fleet['transportTr']		= $pricelist[$i]['transportTr']*$_POST["ship$i"];
					$fleet['ship']				= $_POST["ship$i"];
					$consomation 			   += $fleet['consumption']*$fleet['ship'];
					$fleetSpeed[] = $fleet['speed'];
					$capacite 				   += $fleet['capacity']*$fleet['ship'];
					//print_r($fleet);
					$speedalls[$i]             = Fleets::fleet_max_speed ( "", $i, $CurrentUser);
					$FleetHiddenBlock		  .= parsetemplate ( $inputs_template , $fleet );
					$transportVx              += $fleet['transportVx'];
					$transportTr			  += $fleet['transportTr'];	
					$liste_fleet 			  .= '<tr>
														<th>'.$lang['tech'][$i].'</th><th>'.$fleet['ship'].'</th><th>'.$fleet['consumption']*$fleet['ship'].'</th><th>'.$fleet['speed']	.'</th><th>'.$fleet['capacity']*$fleet['ship'].'</th>
												  </tr>';
				
				}
			}
		}
                //je peux transporter des vaisseaux
               
                if($transportVx > 0){
                    $transportables = '';
                    $iii=0;
                    foreach($transportable['chasseur'] AS $key=>$value){
                        if($CurrentPlanet[$resource[$value]]){
                            if(isset($_POST["ship$value"])){
                                $dispo = $CurrentPlanet[$resource[$value]] - $_POST["ship$value"];
                            }else{
                                $dispo = $CurrentPlanet[$resource[$value]];
                            }
                            if ($iii > 0 && $iii % 2 == 0){
                                $transportables .= '</tr><tr>';
                            }
                            
                            $transportables .= "<th>";
                            $transportables .= $lang['tech'][$value].'|('.$dispo.')';
                            $transportables .= "</th>";
                            $transportables .= "<th>";
                            $transportables .= '<input type="text" class="fighter-emport" data-max="'.$dispo.'" id="fight-'.$value.'" name="fleetFighter['.$value.']" style="width: 39px;" value="0" />';
                            $transportables .= "</th>";
                             $iii++;
                            //echo $lang['tech'][$value].'|('.$dispo.')<br />';
                        }
                    }
                    $transportables .= "</tr>";
                }
                 $transportables .= '</table>';
                 
                 if($transportTr > 0){
                 	$transportables_units = '';
                 	$iii=0;
                 	foreach($reslist['casern'] AS $key=>$value){
                 		if($CurrentPlanet[$resource[$value]]){
                 			
                 			if(isset($_POST["ship$value"])){
                 				$dispo = $CurrentPlanet[$resource[$value]] - $_POST["ship$value"];
                 			}else{
                 				$dispo = $CurrentPlanet[$resource[$value]];
                 			}
                 			if ($iii > 0 && $iii % 2 == 0){
                 				$transportables_units .= '</tr><tr>';
                 			}
                 			
                 			$transportables_units .= "<th>";
                 			$transportables_units .= $lang['tech'][$value].' ('.$dispo.')';
                 			$transportables_units .= "</th>";
                 			$transportables_units .= "<th>";
                 			$transportables_units .= '<input type="text" class="unit-emport" data-max="'.$dispo.'" id="units-'.$value.'" name="unitTroupes['.$value.']" style="width: 39px;" value="0" />';
                 			$transportables_units .= "</th>";
                 			$iii++;
                 			//echo $lang['tech'][$value].'|('.$dispo.')<br />';
                 		}
                 	}
                 	$transportables_units .= "</tr>";
                 }
                 $transportables_units .= '</table>';                 
		//print_r($fleetSpeed);
		if ( !isset($fleet['fleetlist']) )
		{
			header ( 'location:game.php?page=fleet' );
		}

		else
		{
			$speedallsmin = min ( $speedalls );
		}

		#####################################################################################################
		// LOAD PLANET TYPES OPTIONS
		#####################################################################################################
		$parse['options_planettype']	= '';

		foreach ( $planet_type as $type )
		{
			$value++;
			
			$options['value']			=	$value;

			if ( $value == $t )
			{
				$options['selected']	=	'SELECTED';
			}
			else
			{
				$options['selected']	=	'';
			}

			$options['title']			=	$lang[$type];


			$parse['options_planettype'] .= parsetemplate ( $options_template , $options );
		}

		#####################################################################################################
		// LOAD SPEED OPTIONS
		#####################################################################################################
		$parse['options']	= '';

		foreach ( $speed_values as $value => $porcentage )
		{
			$speed_porcentage['value']		=	$value;
			$speed_porcentage['selected']	=	'';
			$speed_porcentage['title']		=	$porcentage;

			$parse['options'] .= parsetemplate ( $options_template , $speed_porcentage );
		}
		//print_r($CurrentPlanet);
		#####################################################################################################
		// PARSE THE REST OF THE OPTIONS
		#####################################################################################################
		$SpeedFactor    = read_config ( 'fleet_speed' ) / 2500;
		$parse['mission']				= $_POST['mission'];
		$parse['fleetblock'] 			= $FleetHiddenBlock;
		$parse['speedallsmin'] 			= $speedallsmin;
		$parse['fleetarray'] 			= str_rot13(base64_encode(serialize($fleet['fleetarray'])));
		$parse['galaxy'] 				= $CurrentPlanet['galaxy'];
		$parse['system'] 				= $CurrentPlanet['system'];
		$parse['planet'] 				= $CurrentPlanet['planet'];
		$parse['galaxy_post'] 			= intval($_POST['galaxy']);
		$parse['system_post'] 			= intval($_POST['system']);
		$parse['planet_post'] 			= intval($_POST['planet']);
		$parse['speedfactor'] 			= GetGameSpeedFactor();
		$parse['consobase']				= $consomation;
		$parse['distance']				= Fleets::target_distance($CurrentPlanet['galaxy'], $_POST['galaxy'], $CurrentPlanet['system'], $_POST['system'], $CurrentPlanet['planet'], $_POST['planet']);
		$duree							= Fleets::mission_duration ( $parse['speedfactor'] , min($fleetSpeed) , $parse['distance'] , $SpeedFactor);
		 
		$s = $duree	%60;
		$m = floor(($duree	%3600)/60);
		$h = floor(($duree	%86400)/3600);
		$parse['duration'] = $h.':'.$m.':'.$s;
		$parse['maxspeed']				= min($fleetSpeed);
		
		$parse['consomation']			= Fleets::fleet_consumption($fleet['fleetarray'], (read_config ( 'fleet_speed' ) / 2500), $duree, $parse['distance'], min($fleetSpeed), $CurrentUser);
		$parse['capacity']			= $capacite-$parse['consomation'];
		$parse['transportFighter']              = $transportVx ;
                $parse['transportable']                 = $transportables;
                $parse['transportables_units'] = $transportables_units;
                        
                $parse['list_fleet']			= $liste_fleet;
		
		$parse['planet_type'] 			= $CurrentPlanet['planet_type'];
		$parse['metal'] 				= floor($CurrentPlanet['metal']);
		$parse['crystal'] 				= floor($CurrentPlanet['crystal']);
		$parse['deuterium'] 			= floor($CurrentPlanet['deuterium']);
		$parse['g'] 					= $_POST['galaxy'];
		$parse['s'] 					= $_POST['system'];
		$parse['p'] 					= $_POST['planet'];

		#####################################################################################################
		// LOAD FLEET SHORTCUTS
		#####################################################################################################
		if ( $CurrentUser['fleet_shortcut'] )
		{
			$scarray 	= explode ( ";" , $CurrentUser['fleet_shortcut'] );

			foreach ( $scarray as $a => $b )
			{
				if ( $b != "" )
				{
					$c 	= explode ( ',' , $b );

					$shortcut['description']   		= $c[0] ." ". $c[1] .":". $c[2] .":". $c[3] . " ";

					switch ( $c[4] )
					{
						case 1:
							$shortcut['description'] .= $lang['fl_planet_shortcut'];
						break;
						case 2:
							$shortcut['description'] .= $lang['fl_debris_shortcut'];
						break;
						case 3:
							$shortcut['description'] .= $lang['fl_moon_shortcut'];
						break;
						default:
							$shortcut['description'] .= '';
						break;
					}

					$shortcut['selected']			= '';
					$shortcut['value']			   	= $c['1'].';'.$c['2'].';'.$c['3'].';'.$c['4'];
					$shortcut['title']			   	= $shortcut['description'];
					$shortcut['shortcut_options']  .= parsetemplate( $options_template , $shortcut );
				}
			}

			$parse['shortcut'] 				= parsetemplate ( $shortcut_row_template , $shortcut );
		}
		else
		{
			$parse['fl_shorcut_message']	= $lang['fl_no_shortcuts'];
			$parse['shortcut'] 				= parsetemplate ( $shortcut_noshortcuts , $parse );
		}

		#####################################################################################################
		// LOAD COLONY SHORTCUTS
		#####################################################################################################
		$colonies	= SortUserPlanets ( $CurrentUser );

		if ( mysqli_num_rows ( $colonies ) > 1 )
		{
			while ( $row = mysqli_fetch_array ( $colonies ) )
			{
				if ( $CurrentPlanet['galaxy'] <> $row['galaxy'] or
					 $CurrentPlanet['system'] <> $row['system'] or
					 $CurrentPlanet['planet'] <> $row['planet'] or
					 $CurrentPlanet['planet_type'] <> $row['planet_type'] )
				{
					if ( $row['planet_type'] == 3 )
					{
						$row['name'] .= " " . $lang['fl_moon_shortcut'];
					}

					$colony['selected']				= '';
					$colony['value']			   	= $row['galaxy'].';'.$row['system'].';'.$row['planet'].';'.$row['planet_type'];
					$colony['title']			   	= $row['name'] ." ". $row['galaxy'] .":". $row['system'] .":". $row['planet'];
					$colony['shortcut_options']    .= parsetemplate( $options_template , $colony );
				}

				$parse['colonylist']				= parsetemplate ( $shortcut_row_template , $colony );
			}
		}
		else
		{
			$parse['fl_shorcut_message']			= $lang['fl_no_colony'];
			$parse['colonylist']					= parsetemplate ( $shortcut_noshortcuts , $parse );
		}

		#####################################################################################################
		// LOAD SAC SHORTCUTS
		#####################################################################################################
		$acs_fleets	= '';

		while ( $row = mysqli_fetch_array ( $getCurrentAcs ) )
		{
			$members 	= explode ( "," , $row['eingeladen'] );

			foreach ( $members as $a => $b )
			{
				if ( $b == $CurrentUser['id'] )
				{
					$acs['galaxy']		=	$row['galaxy'];
					$acs['system']		=	$row['system'];
					$acs['planet']		=	$row['planet'];
					$acs['planet_type']	=	$row['planet_type'];
					$acs['id']			=	$row['id'];
					$acs['name']		=	$row['name'];

					$acs_fleets 	   .= parsetemplate ( $shortcut_acs_row , $acs );
				}
			}
		}

		$parse['asc'] 				= $acs_fleets;
		$parse['maxepedition'] 		= $_POST['maxepedition'];
		$parse['curepedition'] 		= $_POST['curepedition'];
		$parse['target_mission'] 	= $_POST['target_mission'];

		display ( parsetemplate ( gettemplate ( 'fleet/fleet1_table' ) , $parse ) );
	}
}
?>