<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowFleetPage
{
	/**
	 * ShowFleetPage constructor.
	 * @param $CurrentUser
	 * @param $CurrentPlanet
     */
	function __construct ($CurrentUser , $CurrentPlanet )
	{

		global $lang, $reslist, $resource, $pricelist;

		#####################################################################################################
		// SOME DEFAULT VALUES
		#####################################################################################################
		// QUERYS
		$count				= doquery ( "SELECT
											(SELECT COUNT(fleet_owner) AS `actcnt`
												FROM {{table}}fleets
												WHERE `fleet_owner` = '" . intval ( $CurrentUser['id'] ) . "') AS max_fleet,
											(SELECT COUNT(fleet_owner) AS `expedi`
												FROM {{table}}fleets
													WHERE `fleet_owner` = '" . intval ( $CurrentUser['id'] ) . "'
														AND `fleet_mission` = '15') AS max_expeditions" , '' , TRUE);



		// Chargement des templates requis
		$inputs_template			= gettemplate ( 'fleet/fleet_inputs' );
		$ships_row_template			= gettemplate ( 'fleet/fleet_row_ships' );

		// LANGUAGE
		$parse 						= $lang;

		$MaxFlyingFleets    		= $count['max_fleet'];//flotes en vol
		$MaxExpedition      		= $CurrentUser[$resource[124]];//

		if ($MaxExpedition >= 1)
		{
			$ExpeditionEnCours  	= $count['max_expeditions'];
			$EnvoiMaxExpedition 	= Fleets::get_max_expeditions ( $MaxExpedition );
		}
		else
		{
			$ExpeditionEnCours 		= 0;
			$EnvoiMaxExpedition 	= 0;
		}

		$MaxFlottes		= Fleets::get_max_fleets ( $CurrentUser[$resource[108]] , $CurrentUser['rpg_amiral'] );
		$missiontype	= Fleets::get_missions();


		$galaxy         = intval((isset($_GET['galaxy'])?$_GET['galaxy']:$CurrentPlanet['galaxy']));
		$system         = intval((isset($_GET['system'])?$_GET['system']:$CurrentPlanet['system']));
		$planet         = intval((isset($_GET['planet'])?$_GET['planet']:$CurrentPlanet['planet']));
		$planettype     = intval((isset($_GET['planettype'])?$_GET['planettype']:$CurrentPlanet['planet_type']));
		$target_mission = intval((isset($_GET['target_mission'])?$_GET['target_mission']:NULL));

		$ShipData       = '';

		$parse['flyingfleets']			= $MaxFlyingFleets;
		$parse['maxfleets']				= $MaxFlottes;
		$parse['currentexpeditions']	= $ExpeditionEnCours;
		$parse['maxexpeditions']		= $EnvoiMaxExpedition;
		$i  							= 0;
		$flying_fleets					= '';
		$ships_row						= '';
		$ship_inputs 					= '';

		//Si on as des flottes en vol OU des expéditions en cours
		if ( $count['max_fleet'] != 0 || $MaxExpedition != 0 )
		{
			$fq = doquery("SELECT * FROM {{table}} WHERE fleet_owner='".intval($CurrentUser['id'])."'", "fleets");

			while ( $f = mysqli_fetch_array ( $fq ) )
			{
				$i++;

				$parse['num']				=	$i;
				$parse['fleet_mission']		=	$missiontype[$f['fleet_mission']];

				if (($f['fleet_start_time'] + 1) == $f['fleet_end_time'])
				{
					$parse['tooltip']		=	$lang['fl_returning'];
					$parse['title']			=	$lang['fl_r'];
				}
				else
				{
					$parse['tooltip']		=	$lang['fl_onway'];
					$parse['title']			=	$lang['fl_a'];
				}

				$fleet 						= 	explode ( ";" , $f['fleet_array'] );
				$e 							= 	0;
				$parse['fleet'] 			= '';

				foreach ( $fleet as $a => $b )
				{
					if ( $b != '' )
					{
						$e++;
						$a 					= explode(",", $b);
						$parse['fleet']    .= $lang['tech'][$a[0]]. ":". $a[1] ."\n";

						if ($e > 1)
						{
							$parse['fleet'].= "\t";
						}
					}
				}

				$parse['fleet_amount']		=	Format::pretty_number ( $f['fleet_amount'] );
				$parse['fleet_start']		=	"[".$f['fleet_start_galaxy'].":".$f['fleet_start_system'].":".$f['fleet_start_planet']."]";
				$parse['fleet_start_time']	=	date ( "d M Y H:i:s" , $f['fleet_start_time'] );
				$parse['fleet_end']			=	"[".$f['fleet_end_galaxy'].":".$f['fleet_end_system'].":".$f['fleet_end_planet']."]";
				$parse['fleet_end_time']	=	date ( "d M Y H:i:s" , $f['fleet_end_time'] );
				$parse['fleet_arrival']		=	Format::pretty_time ( floor ( $f['fleet_end_time'] + 1 - time() ) );

				//now we can view the call back button for ships in maintaing position (2)
				if ($f['fleet_mess'] == 0 or $f['fleet_mess'] == 2)
				{
					$parse['inputs']  = "<form action=\"SendFleetBack.php\" method=\"post\">";
					$parse['inputs'] .= "<input name=\"fleetid\" value=\"". $f['fleet_id'] ."\" type=\"hidden\">";
					$parse['inputs'] .= "<input value=\"".$lang['fl_send_back']."\" type=\"submit\" name=\"send\">";
					$parse['inputs'] .= "</form>";

					if ($f['fleet_mission'] == 1)
					{
						$parse['inputs'] .= "<form action=\"game.php?page=fleetACS\" method=\"post\">";
						$parse['inputs'] .= "<input name=\"fleetid\" value=\"". $f['fleet_id'] ."\" type=\"hidden\">";
						$parse['inputs'] .= "<input value=\"".$lang['fl_acs']."\" type=\"submit\">";
						$parse['inputs'] .= "</form>";
					}
				}
				else
				{
					$parse['inputs'] = "&nbsp;-&nbsp;";
				}

				$flying_fleets	.= parsetemplate ( gettemplate ( 'fleet/fleet_row_fleets' ) , $parse );
			}
		}else{

			$parse['num']				=	'-';
			$parse['fleet_mission']		=	'-';
			$parse['title']				=	'-';
			$parse['fleet_amount']		=	'-';
			$parse['fleet_start']		=	'-';
			$parse['fleet_start_time']	=	'-';
			$parse['fleet_end']			=	'-';
			$parse['fleet_end_time']	=	'-';
			$parse['fleet_arrival']		=	'-';
			$parse['inputs']			=	'-';

			$flying_fleets	.= parsetemplate ( gettemplate ( 'fleet/fleet_row_fleets' ) , $parse );
		}

		$parse['fleetpagerow'] = $flying_fleets;

		//$OrbitFleet = doquery(SELECT);
		if ($MaxFlottes == $MaxFlyingFleets)//Nombre max de flotte en vol
		{
			$parse['message_nofreeslot'] .= parsetemplate ( gettemplate ( 'fleet/fleet_noslots_row' ) , $parse );
		}

		if (!$CurrentPlanet)
		{
			header("location:game.php?page=fleet");
		}

		$ships	=	$lang;

		foreach ($reslist['fleet'] as $n => $i)
		{
			if ($CurrentPlanet[$resource[$i]] > 0)
			{
				if ( $i == 212 )
				{
					$ships['fleet_max_speed'] 	= 	'-';
				}
				else
				{
					$ships['fleet_max_speed']	= 	Fleets::fleet_max_speed ( "" , $i , $CurrentUser );
				}

				$ships['ship']					= 	$lang['tech'][$i];
				$ships['amount']				= 	Format::pretty_number ( $CurrentPlanet[$resource[$i]] );
				$inputs['i']					=	$i;
				$inputs['maxship']				=	$CurrentPlanet[$resource[$i]];
				$inputs['consumption']			=	Fleets::ship_consumption ( $i, $CurrentUser );
				$inputs['speed']				=	Fleets::fleet_max_speed ("", $i, $CurrentUser );
				$inputs['capacity']				=	$pricelist[$i]['capacity'];

				if ($i == 212)
				{
					$ships['max_ships']			=	'';
					$ships['set_ships']			=	'';
				}
				else
				{
					$ships['max_ships'] 	   	= "<a href=\"javascript:maxShip('ship". $i ."'); shortInfo();\">".$lang['fl_max']."</a>";
					$ships['set_ships'] 		= "<input name=\"ship". $i ."\" size=\"10\" value=\"0\" onfocus=\"javascript:if(this.value == '0') this.value='';\" onblur=\"javascript:if(this.value == '') this.value='0';\" alt=\"". $lang['tech'][$i] . $CurrentPlanet[$resource[$i]] ."\" onChange=\"shortInfo()\" onKeyUp=\"shortInfo()\" />";
				}

				$ship_inputs	.=	parsetemplate ( $inputs_template , $inputs );
				$ships_row		.= 	parsetemplate ( $ships_row_template , $ships );
			}
			$have_ships = TRUE;
		}

		if (!$have_ships)
		{
			$parse['noships_row']	=	parsetemplate ( gettemplate ( 'fleet/fleet_noships_row' ) , $lang );
		}
		else
		{
			if ( $MaxFlottes > $MaxFlyingFleets )
			{
				$parse['none_max_selector']	=	parsetemplate ( gettemplate ( 'fleet/fleet_selectors' ) , $lang );
				$parse['continue_button']	=	parsetemplate ( gettemplate ( 'fleet/fleet_button' ) , $lang );
			}
		}

		$fleetOrbit = doquery(
		    'SELECT f.fleetName as fleetName,
                           f.fleet_owner as fleet_owner,
                           f.fleet_statut as fleet_statut,
                           f.fleet_id as id ,
                           f.fleet_array as ship,
                           f.fleetPosition as pos,
                           u.username as username 
                           FROM xgp_FleetsOrbit as f
                           LEFT JOIN xgp_users as u on u.id = f.fleet_owner

            WHERE f.fleetPosition = '.$CurrentPlanet['id'].' AND f.fleet_owner <> '.$CurrentPlanet['id_owner'],'FleetsOrbit');


		$ii = 1;
        $parse['fleetOrbitpagerow'] = "";
        $parseOrbit = array();
		while($data = mysqli_fetch_array($fleetOrbit)){
		    $parseOrbit['num'] = $ii;

		    $parseOrbit['fleet_name'] = $data['fleetName'];

		    $parseOrbit['fleet_proprio'] = $data['username'];
		    $parseOrbit['fleet_statut'] = $lang['fleetOrbitStatut'][$data['fleet_statut']];

		    $parseOrbit['fleet_ships'] = '';
            $vaisseaux = unserialize($data['ship']);
            //___d($vaisseaux);
            for($i=0,$j=count($vaisseaux);$i<$j;$i++){
               $parseOrbit['fleet_ships'] .= '<li>'.$lang['tech_rc'][$vaisseaux[$i]['ship']].' x '.$vaisseaux[$i]['nb'].'</li>';
            }
            $ii++;
		    $parse['fleetOrbitpagerow'] .= parsetemplate(gettemplate('fleet/fleet_orbit_row'),$parseOrbit);
        }

        $fleetDispo = doquery(
            'SELECT f.fleetName as fleetName,
                           f.fleet_owner as fleet_owner,
                           f.fleet_statut as fleet_statut,
                           f.fleet_id as id ,
                           f.fleet_array as ship,
                           u.username as username 
                           FROM xgp_FleetsOrbit as f
                           LEFT JOIN xgp_users as u on u.id = f.fleet_owner

            WHERE fleetPosition = '.$CurrentPlanet['id'].' AND f.fleet_owner = '.$CurrentPlanet['id_owner'],'FleetsOrbit');

		$ii = 0;
        $parse['fleetDisponibleRow'] = '';
        $parseDispo = array();
        while($data = mysqli_fetch_array($fleetDispo)){
            $parseDispo['num'] = $ii;
            $parseDispo['fleet_name'] = $data['fleetName'];
            $parseDispo['id'] = $data['id'];
            $parseDispo['fleet_proprio'] = $data['username'];
            $parseDispo['fleet_statut'] = $lang['fleetOrbitStatut'][$data['fleet_statut']];

            $parseDispo['fleet_ships'] = '';
            $vaisseaux = unserialize($data['ship']);
            //___d($vaisseaux);
            for($i=0,$j=count($vaisseaux);$i<$j;$i++){
                $parseDispo['fleet_ships'] .= '<li>'.$lang['tech_rc'][$vaisseaux[$i]['ship']].' x '.$vaisseaux[$i]['nb'].'</li>';
            }
            $ii++;
            $parse['fleetDisponibleRow'] .= parsetemplate(gettemplate('fleet/fleet_dispo_row'),$parseDispo);
        }



        //___d($fleetOrbit);
        $parse['body'] 					= $ships_row;
		$parse['shipdata'] 				= $ship_inputs;
		$parse['galaxy']				= $galaxy;
		$parse['system']				= $system;
		$parse['planet']				= $planet;
		$parse['planettype']			= $planettype;
		$parse['target_mission']		= $target_mission;
		$parse['envoimaxexpedition']	= $EnvoiMaxExpedition;
		$parse['expeditionencours']		= $ExpeditionEnCours;
		$parse['target_mission']		= $target_mission;

		display(parsetemplate(gettemplate('fleet/fleet_table'), $parse));
	}
}
?>