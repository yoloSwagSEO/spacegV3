<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowFleet3Page
{
	function __construct($CurrentUser, $CurrentPlanet)
	{
		global $resource, $pricelist, $reslist, $lang, $transportable,$debugbar;

		include_once ( XGP_ROOT . 'includes/functions/IsVacationMode.php' );
		$parse	=	$lang;

		if ( IsVacationMode ( $CurrentUser ) )//mode vacansse, donc pas d'envoie de flottes
		{
			exit ( message ( $lang['fl_vacation_mode_active'] , "game.php?page=overview" , 2 ) );
		}

		$fleet_group_mr = 0;

		if ( $_POST['fleet_group'] > 0 )
		{
			if ( $_POST['mission'] == 2  )
			{
				$target = 	"g" .
							intval ( $_POST["galaxy"] ) .
							"s" .
							intval ( $_POST["system"] ) .
							"p" . intval ( $_POST["planet"] ) .
							"t" . intval ( $_POST["planettype"] );

				if ( $_POST['acs_target_mr'] == $target )
				{
					$aks_count_mr = doquery ( "SELECT COUNT(*)
												FROM {{table}}
												WHERE id = '" . intval ( $_POST['fleet_group'] ) . "'" , 'aks' );

					if ($aks_count_mr > 0)
					{
						$fleet_group_mr = $_POST['fleet_group'];
					}
				}
			}
		}

		if(($_POST['fleet_group'] == 0) && ($_POST['mission'] == 2))
		{
			$_POST['mission'] = 1;
		}

		$TargetPlanet  		= doquery("SELECT `id_owner`,`id_level`,`destruyed`,`ally_deposit` FROM {{table}} WHERE `galaxy` = '". intval($_POST['galaxy']) ."' AND `system` = '". intval($_POST['system']) ."' AND `planet` = '". intval($_POST['planet']) ."';", 'planets', TRUE);
		$MyDBRec       		= doquery("SELECT `id`,`onlinetime`,`ally_id`,`urlaubs_modus` FROM {{table}} WHERE `id` = '". intval($CurrentUser['id'])."';", 'users', TRUE);
		
		//Ne pas attaquer les colo sans proprio
		if(($_POST['mission'] == 1 || $_POST['mission'] == 12) && $TargetPlanet['id_owner'] == 0){
				message ("<font color=\"red\"><b>".$lang['fl_attk_no_colo']."</b></font>", "game.php?page=fleet", 2);
				exit();
		}

		//----------------------------------------------
        // Nouveau système de flotes
        //----------------------------------------------


        $selectedFleet = doquery('SELECT * FROM {{table}} WHERE fleet_id = '.$_POST['fleetSelectedId'],'FleetsOrbit',true);

        //on vérifie que la flotte apartien bien au joueur
		if($selectedFleet['fleet_owner'] != $CurrentUser['id']){
            message ("<font color=\"red\"><b>Cette flote de nous apartien pas</b></font>", "game.php?page=fleet", 2);
            exit();
        }

        //----------------------------------------------
        // Nouveau système de flotes
        //----------------------------------------------

        $tempFleet = unserialize($selectedFleet['fleet_array']);


		$fleetarray  = array();

		foreach($tempFleet as $ship){
            $fleetarray[$ship['ship']] = $ship['nb'];
        }

		
				//-------------------------------------------------
				//Gestion chasseur
				//-------------------------------------------------
                $fleetFighter = $_POST['fleetFighter'];
                //print_r($fleetFighter);
                $fighter = array();
                $totalFight = 0;
                $FleetSubQRY2="";


                foreach($fleetFighter AS $key => $value){


                    if(in_array($key, $transportable['chasseur'])){
                        if($value > ($CurrentPlanet[$resource[$key]]-$fleetarray[$key]) && $value > 0){
                            exit ( header ( "Location: game.php?page=fleet" ) );
                        }else{
                        	$totalFight += $value;
                        	$fighter[$key]= $value;
                        	$FleetSubQRY2     .= "`".$resource[$key] . "` = `" . $resource[$key] . "` - " . $value . ", ";
                        }
                    }
                }
                if($_POST['totalTransportable'] < $totalFight){
                    echo 'la?'; die();
                    exit ( header ( "Location: game.php?page=fleet" ) );
                }
                $fighterSerialize = serialize($fighter);
               
                $fleetTroupes = $_POST['unitTroupes'];
                $troupes = array();
                $totalTroupes = 0;
                $FleetSubQRY3 = "";
                foreach($fleetTroupes AS $key => $value){
                	if(in_array($key,$reslist['casern'])){
                		if($value > $CurrentPlanet[$resource[$key]]){
                			exit (header("Location: game.php?page=fleet"));
                		}else{
                			$totalTroupes += $value;
                			$troupes[$key] = $value;
                			$FleetSubQRY3 .= "`".$resource[$key]."`=`".$resource[$key]."` - ".$value.", ";
                		}
                	}
                }
                $troupesSerialize = serialize($troupes);
		//if ( $TargetPlanet["destruyed"] != 0 )
		//{
		//	echo 'ereur 1';
		//	exit();
		//	//exit ( header ( "Location: game.php?page=fleet" ) );
		//}

		//Ce n'est pas un array donc un sousi
		if ( !is_array ( $fleetarray ) )
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

        //TODO a fixé un jour
		//foreach ( $fleetarray as $Ship => $Count )
		//{
		//	$Count = intval ( $Count );
		//	//hum hum on a plus de vx que de Vx présent sur la planette?
		//	if ($Count > $CurrentPlanet[$resource[$Ship]])
		//	{
		//		exit ( header ( "Location: game.php?page=fleet" ) );
		//	}
		//}

		$error              = 0;
		$galaxy             = intval($_POST['galaxy']);
		$system             = intval($_POST['system']);
		$planet             = intval($_POST['planet']);
		$planettype         = intval($_POST['planettype']);
		$fleetmission       = intval($_POST['mission']);

		//Si on veux coloniser... il faut des vaisseaux de colonisation...
		if ( $fleetmission == 7 && !isset($fleetarray[208]) )
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		//On ne peux pas attaquer une planete non coloniser...
		if ( ($fleetmission == 1 || $fleetmission == 2) && $TargetPlanet['id_owner'] == 0 )
		{
			message ("<font color=\"red\"><b>Vous ne pouvez pas attaquer une planète sans proprietaire.</b></font>", "game.php?page=fleet", 2);
			exit ();
		}
		
		
		//Si on veux exploité... il faut des modules minier...
		if ( $fleetmission == 11 && !isset($fleetarray[204]) )
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		//fix invisible debris like ogame by jstar
		if ($fleetmission == 8)
		{
			$YourPlanet = FALSE;
			$UsedPlanet = FALSE;
			$select     = (array) doquery("SELECT * FROM {{table}} WHERE galaxy = '". $galaxy ."' AND system = '". $system ."' AND planet = '". $planet ."'", "planets");
			$select2    = doquery("SELECT invisible_start_time, metal, crystal FROM {{table}} WHERE galaxy = '". $galaxy ."' AND system = '". $system ."' AND planet = '". $planet ."'", "galaxy",TRUE);
			if($select2['metal'] == 0 && $select2['crystal'] == 0)
			{
			echo 'ereur 6';
			exit();
			//exit ( header ( "Location: game.php?page=fleet" ) );
			}
		}
		else
		{
			$YourPlanet = FALSE;
			$UsedPlanet = FALSE;
			if($planettype == 3){
				$planettypeSql =  "AND planet_type = '". $planettype ."'";
			}else{
				$planettypeSql =  "";
			}
			$select = (array) doquery("SELECT * FROM {{table}} WHERE galaxy = '". $galaxy ."' AND system = '". $system ."' AND planet = '". $planet ."' ".$planettypeSql."", "planets");
		}

		//Et non on ne peux pas envoyer de la flotte sur ca meme planete :p by by les ghost a la ng
		if ($CurrentPlanet['galaxy'] == $galaxy AND $CurrentPlanet['system'] == $system AND $CurrentPlanet['planet'] == $planet )
		{
			
			message ("<font color=\"red\"><b>Vous ne pouvez pas envoyer une flote sur la meme planète.</b></font>", "game.php?page=fleet", 2);
			exit();
		}

		if ($_POST['mission'] != 15)//Es que c'est une expedition?
		{
			if (count($select) < 1 && $fleetmission != 7)
			{
			echo 'ereur 8';
			exit();
			//exit ( header ( "Location: game.php?page=fleet" ) );
			}
			elseif ($fleetmission == 9 && count($select) < 1)
			{
			echo 'ereur 9';
			exit();
			//exit ( header ( "Location: game.php?page=fleet" ) );
			}
		}
		else
		{
			$MaxExpedition      = $CurrentUser[$resource[124]];

			if ($MaxExpedition >= 1)
			{
				$maxexpde  			= doquery("SELECT COUNT(fleet_owner) AS `expedi` FROM {{table}} WHERE `fleet_owner` = '".intval($CurrentUser['id'])."' AND `fleet_mission` = '15';", 'fleets', TRUE);
				$ExpeditionEnCours  = $maxexpde['expedi'];
				$EnvoiMaxExpedition = Fleets::get_max_expeditions ( $MaxExpedition );
			}
			else
			{
				$ExpeditionEnCours 	= 0;
				$EnvoiMaxExpedition = 0;
			}

			if($EnvoiMaxExpedition == 0 )
			{
				message ("<font color=\"red\"><b>".$lang['fl_expedition_tech_required']."</b></font>", "game.php?page=fleet", 2);
				exit();
			}
			elseif ($ExpeditionEnCours >= $EnvoiMaxExpedition )
			{
				message ("<font color=\"red\"><b>".$lang['fl_expedition_fleets_limit']."</b></font>", "game.php?page=fleet", 2);
				exit();
			}
		}	
		//$select = mysql_fetch_array($select);

		if ($select['id_owner'] == $CurrentUser['id'])
		{
			$YourPlanet = TRUE;
			$UsedPlanet = TRUE;
		}
		elseif (!empty($select['id_owner']))
		{
			$YourPlanet = FALSE;
			$UsedPlanet = TRUE;
		}
		else
		{
			$YourPlanet = FALSE;
			$UsedPlanet = FALSE;
		}
		
		//TODO Faire un check pour les invasion ici
		if($fleetmission == 12){//Donc c'est une invasion
			if($YourPlanet){ //le joueur esaye d'inva ca propre planete hum hum
				message ("<font color=\"red\"><b>Vous ne pouvez pas lancer une invasion sur une de vos planete</b></font>", "game.php?page=fleet", 2);
				exit();
			}else if(!$UsedPlanet){//Le joueur lance une inva sur une planete sans proprio
				message ("<font color=\"red\"><b>Vous ne pouvez pas lancer une invasion sur une planete sans proprietaire</b></font>", "game.php?page=fleet", 2);
				exit();
			}else{//Le joueur lance une inva sur une planete éligible
				$select = doquery("SELECT * FROM {{table}} WHERE planete_id = ".$select['id']."", "invasion");
				if(count($select) == 0){//Il n'y as pas d'autre invasion en cour
					
				}else{//Il y as deja une invasion en cour :/
					message ("<font color=\"red\"><b>Il y as deja une invasion sur la planete cibler</b></font>", "game.php?page=fleet", 2);
					exit();
				}
			}
		}
		if($fleetmission == 11 && $select['id_owner'] != 0){
			message ("<font color=\"red\"><b>Vous ne pouvez pas exploit&eacutes; une planete déja prise</b></font>", "game.php?page=fleet", 2);
			exit();
		}
		//On ne detruit pas pour le moment!
		//if($fleetmission == 9)
		//{
		//	$countfleettype = count ( $fleetarray );
        //
		//	if($YourPlanet or !$UsedPlanet or $planettype != 3)
		//	{
		//	echo 'ereur 10';
		//	exit();
		//	//exit ( header ( "Location: game.php?page=fleet" ) );
		//	}
		//	elseif($countfleettype==1 && !(isset($fleetarray[214])))
		//	{
		//	echo 'ereur 11';
		//	exit();
		//	//exit ( header ( "Location: game.php?page=fleet" ) );
		//	}
		//	elseif($countfleettype==2 && !(isset($fleetarray[214])))
		//	{
		//	echo 'ereur 12';
		//	exit();
		//	//exit ( header ( "Location: game.php?page=fleet" ) );
		//	}
		//	elseif($countfleettype>2)
		//	{
		//	echo 'ereur 13';
		//	exit();
		//	//exit ( header ( "Location: game.php?page=fleet" ) );
		//	}
		//}

		if (empty($fleetmission))
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if ($TargetPlanet['id_owner'] == '')
		{
			$HeDBRec = $MyDBRec;
		}
		elseif ($TargetPlanet['id_owner'] != '')
		{
			$HeDBRec = doquery("SELECT `id`,`onlinetime`,`ally_id`,`urlaubs_modus` FROM {{table}} WHERE `id` = '". intval($TargetPlanet['id_owner']) ."';", 'users', TRUE);
		}

		$UserPoints    = doquery("SELECT `total_points` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". intval($MyDBRec['id']) ."';", 'statpoints', TRUE);
		$User2Points   = doquery("SELECT `total_points` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". intval($HeDBRec['id']) ."';", 'statpoints', TRUE);

		$MyGameLevel  = $UserPoints['total_points'];
		$HeGameLevel  = $User2Points['total_points'];

		if($HeDBRec['onlinetime'] >= (time()-60 * 60 * 24 * 7))
		{
			if ( is_weak ( $MyGameLevel , $HeGameLevel ) &&
					$TargetPlanet['id_owner'] != '' &&
					($_POST['mission'] == 1 or $_POST['mission'] == 6 or $_POST['mission'] == 9))
			{
				message("<font color=\"lime\"><b>".$lang['fl_week_player']."</b></font>", "game.php?page=fleet", 2);
				exit();
			}

			if ( is_strong ( $MyGameLevel , $HeGameLevel ) &&
					$TargetPlanet['id_owner'] != '' &&
					($_POST['mission'] == 1 or $_POST['mission'] == 5 or $_POST['mission'] == 6 or $_POST['mission'] == 9))
			{
				message("<font color=\"red\"><b>".$lang['fl_strong_player']."</b></font>", "game.php?page=fleet", 2);
				exit();
			}
		}

		if ($HeDBRec['urlaubs_modus'] && $_POST['mission'] != 8)
		{
			message("<font color=\"lime\"><b>".$lang['fl_in_vacation_player']."</b></font>", "game.php?page=fleet", 2);
			exit();
		}

		$FlyingFleets = mysqli_fetch_assoc(doquery("SELECT COUNT(fleet_id) as Number FROM {{table}} WHERE `fleet_owner`='".intval($CurrentUser['id'])."'", 'fleets'));
		$ActualFleets = $FlyingFleets["Number"];

		if ((Fleets::get_max_fleets ( $CurrentUser[$resource[108]] , $CurrentUser['rpg_amiral'] ) ) <= $ActualFleets)
		{
			message($lang['fl_no_slots'], "game.php?page=fleet", 1);
			exit();
		}

		//if ($_POST['metal_e'] + $_POST['cristal_e'] + $_POST['uradium_e'] < 1 && $_POST['mission'] == 3)
		//{
		//	message("<font color=\"lime\"><b>".$lang['fl_empty_transport']."</b></font>", "game.php?page=fleet", 1);
		//}

		if ($_POST['mission'] != 15)
		{
			//on fait des choses sur un joueur qui n'existe pas...
			if ($TargetPlanet['id_owner'] == '' && $_POST['mission'] < 7)
			{
				exit ( header ( "Location: game.php?page=fleet" ) );
			}

			if ($TargetPlanet['id_owner'] != 0 && $_POST['mission'] == 7)
			{
				message ("<font color=\"red\"><b>".$lang['fl_planet_populed']."</b></font>", "game.php?page=fleet", 2);
				exit();
			}
			
			//Modif stationée chez tous le monde
			//if ($HeDBRec['ally_id'] != $MyDBRec['ally_id'] && $_POST['mission'] == 4)
			//{
			//	message ("<font color=\"red\"><b>".$lang['fl_stay_not_on_enemy']."</b></font>", "game.php?page=fleet", 2);
			//}

			if (($TargetPlanet["id_owner"] == $CurrentPlanet["id_owner"]) && (($_POST["mission"] == 1) or ($_POST["mission"] == 6)))
			{
				exit ( header ( "Location: game.php?page=fleet" ) );
			}

			//Modif stationée chez tous le monde
			//if (($TargetPlanet["id_owner"] != $CurrentPlanet["id_owner"]) && ($_POST["mission"] == 4))
			//{
			//	message ("<font color=\"red\"><b>".$lang['fl_deploy_only_your_planets']."</b></font>","game.php?page=fleet", 2);
			//}

			if($_POST['mission'] == 5)
			{
				$buddy = doquery ( "SELECT COUNT( * ) AS buddys
										FROM  `{{table}}`
											WHERE (
												(
													sender ='" . intval($CurrentPlanet['id_owner']) . "'
													AND owner ='" . intval($TargetPlanet['id_owner']) . "'
												)
												OR (
													sender ='" . intval($TargetPlanet['id_owner']) . "'
													AND owner ='" . intval($CurrentPlanet['id_owner']) . "'
												)
											)
											AND active =1" , 'buddy' , TRUE );

				if ( $HeDBRec['ally_id'] != $MyDBRec['ally_id'] && $buddy['buddys'] < 1 )
				{
					message ("<font color=\"red\"><b>".$lang['fl_stay_not_on_enemy']."</b></font>", "game.php?page=fleet", 2);
					exit();
				}
			}
		}

		$missiontype	= Fleets::get_missions();
		$speed_possible	= array(10, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		$AllFleetSpeed	= Fleets::fleet_max_speed ($fleetarray, 0, $CurrentUser);
		$GenFleetSpeed  = $_POST['speed'];
		$SpeedFactor    = read_config ( 'fleet_speed' ) / 2500;
		$MaxFleetSpeed  = min($AllFleetSpeed);

		if (!in_array($GenFleetSpeed, $speed_possible))
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if ($MaxFleetSpeed != $_POST['speedallsmin'])
		{

			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if (!$_POST['planettype'])
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}
		
		$maxGalaxy = mysqli_fetch_array(doquery("SELECT max(`galaxy`) FROM {{table}}", 'planets'));
		
		$maxSystem = mysqli_fetch_array(doquery("SELECT max(`system`) FROM {{table}} WHERE `galaxy` = ".$_POST['galaxy']."", 'planets'));
		$maxPlanet = mysqli_fetch_array(doquery("SELECT max(`planet`) FROM {{table}} WHERE `galaxy` = ".$_POST['galaxy']." AND `system` = ".$_POST['system']."", 'planets'));
		if (!$_POST['galaxy'] || !is_numeric($_POST['galaxy']) || $_POST['galaxy'] > $maxGalaxy[0] || $_POST['galaxy'] < 1)
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if (!$_POST['system'] || !is_numeric($_POST['system']) || $_POST['system'] > $maxSystem[0] || $_POST['system'] < 1)
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if (!$_POST['planet'] || !is_numeric($_POST['planet']) || $_POST['planet'] > ($maxPlanet[0]) || $_POST['planet'] < 1)
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if ($_POST['thisgalaxy'] != $CurrentPlanet['galaxy'] |
			$_POST['thissystem'] != $CurrentPlanet['system'] |
			$_POST['thisplanet'] != $CurrentPlanet['planet'] |
			$_POST['thisplanettype'] != $CurrentPlanet['planet_type'])
		{
			echo 'ereur 23';
			exit();
			//exit ( header ( "Location: game.php?page=fleet" ) );
		}

		if (!isset($fleetarray))
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		$distance      = Fleets::target_distance($_POST['thisgalaxy'], $_POST['galaxy'], $_POST['thissystem'], $_POST['system'], $_POST['thisplanet'], $_POST['planet']);
		$duration      = Fleets::mission_duration($GenFleetSpeed, $MaxFleetSpeed, $distance, $SpeedFactor);
		$consumption   = Fleets::fleet_consumption($fleetarray, $SpeedFactor, $duration, $distance, $MaxFleetSpeed, $CurrentUser);

		$fleet['start_time'] = $duration + time();
        $fleet['end_time']   = (2 * $duration) + time();
		
        // START CODE BY JSTAR
        if ($_POST['mission'] == 15)
        {
            $StayDuration    = floor($_POST['expeditiontime']);

            if ( $StayDuration > 0 )
            {
                $StayDuration    = $StayDuration  * 3600;
                $StayTime        = $fleet['start_time'] + $StayDuration;
                $fleet['end_time']   = $StayDuration + (2 * $duration) + time();
            }
            else
            {
			echo 'ereur 25';
			exit();
			//exit ( header ( "Location: game.php?page=fleet" ) );
            }
        } // END CODE BY JSTAR
        elseif ($_POST['mission'] == 5)
        {
            $StayDuration    = $_POST['holdingtime'] * 3600;
            $StayTime        = $fleet['start_time'] + $_POST['holdingtime'] * 3600;
            $fleet['end_time']   = $StayDuration + (2 * $duration) + time();
        }
        else
        {
            $StayDuration    = 0;
            $StayTime        = 0;
        }
		
		$FleetStorage        = 0;
		$FleetShipCount      = 0;
		$fleet_array         = "";
		$FleetSubQRY         = "";

		//fix by jstar
		$haveSpyProbos		= FALSE;

		foreach ($fleetarray as $Ship => $Count)
		{
			$Count = intval($Count);

			if($Ship == 210)
			{
				$haveSpyProbos = TRUE;
			}

			$FleetStorage    += $pricelist[$Ship]["capacity"] * $Count;
			$FleetShipCount  += $Count;
			$fleet_array     .= $Ship .",". $Count .";";
			$FleetSubQRY     .= "`".$resource[$Ship] . "` = `" . $resource[$Ship] . "` - " . $Count . ", ";
		}

		if(!$haveSpyProbos AND $_POST['mission'] == 6)
		{
			exit ( header ( "Location: game.php?page=fleet" ) );
		}

		$FleetStorage        -= $consumption;
		$StorageNeeded        = 0;
		
		//patch octal
		if(substr ( $_POST['metal_e'] , 0 ,1) == 0 && strlen($_POST['metal_e']) > 1){
			message ("<font color=\"red\"><b>Valeur de metal erronée</b></font>", "game.php?page=fleet", 2);
			exit ();
		}
		if(substr ( $_POST['cristal_e'] , 0 ,1) == 0 && strlen($_POST['cristal_e']) > 1 ){
			message ("<font color=\"red\"><b>Valeur de cristal erronée</b></font>", "game.php?page=fleet", 2);
			exit ();
		}
		if(substr ( $_POST['uradium_e'] , 0 ,1) == 0 && strlen($_POST['uradium_e']) > 1 ){
			message ("<font color=\"red\"><b>Valeur de d'uradium erronée</b></font>", "game.php?page=fleet", 2);
			exit ();
		}
		$_POST['metal_e'] = max(0, (int)trim($_POST['metal_e']));
		$_POST['cristal_e'] = max(0, (int)trim($_POST['cristal_e']));
		$_POST['uradium_e'] = max(0, (int)trim($_POST['uradium_e']));

		if ($_POST['metal_e'] < 1)
		{
			$TransMetal      = 0;
		}
		else
		{
			$TransMetal      = $_POST['metal_e'];
			$StorageNeeded  += $TransMetal;
		}

		if ($_POST['cristal_e'] < 1)
		{
			$TransCrystal    = 0;
		}
		else
		{
			$TransCrystal    = $_POST['cristal_e'];
			$StorageNeeded  += $TransCrystal;
		}
		if ($_POST['uradium_e'] < 1)
		{
			$TransDeuterium  = 0;
		}
		else
		{
			$TransDeuterium  = $_POST['uradium_e'];
			$StorageNeeded  += $TransDeuterium;
		}

		$StockMetal      = $CurrentPlanet['metal'];
		$StockCrystal    = $CurrentPlanet['crystal'];
		$StockDeuterium  = $CurrentPlanet['deuterium'];
		$StockDeuterium -= $consumption;

		$StockOk         = FALSE;

		if ($StockMetal >= $TransMetal)
		{
			if ($StockCrystal >= $TransCrystal)
			{
				if ($StockDeuterium >= $TransDeuterium)
				{
					$StockOk         = TRUE;
				}
			}
		}

		if (!$StockOk)
		{
			message ("<font color=\"red\"><b>". $lang['fl_no_enought_deuterium'] . Format::pretty_number($consumption) ."</b></font>", "game.php?page=fleet", 2);
			exit();
		}

		if ( $StorageNeeded > $FleetStorage)
		{
			message ("<font color=\"red\"><b>". $lang['fl_no_enought_cargo_capacity'] . Format::pretty_number($StorageNeeded - $FleetStorage) ."</b></font>", "game.php?page=fleet", 2);
			exit();
		}

		if ($TargetPlanet['id_level'] > $CurrentUser['authlevel'] && read_config ( 'adm_attack' ) == 1)
		{
			message($lang['fl_admins_cannot_be_attacked'], "game.php?page=fleet",2);
			exit();
		}

		if ($fleet_group_mr != 0)
		{
			$AksStartTime = doquery("SELECT MAX(`fleet_start_time`) AS Start FROM {{table}} WHERE `fleet_group` = '". $fleet_group_mr . "';", "fleets", TRUE);

			if ($AksStartTime['Start'] >= $fleet['start_time'])
			{
				$fleet['end_time']        += $AksStartTime['Start'] -  $fleet['start_time'];
				$fleet['start_time']     = $AksStartTime['Start'];
			}
			else
			{
				$QryUpdateFleets = "UPDATE {{table}} SET ";
				$QryUpdateFleets .= "`fleet_start_time` = '". $fleet['start_time'] ."', ";
				$QryUpdateFleets .= "`fleet_end_time` = fleet_end_time + '".($fleet['start_time'] - $AksStartTime['Start'])."' ";
				$QryUpdateFleets .= "WHERE ";
				$QryUpdateFleets .= "`fleet_group` = '". $fleet_group_mr ."';";
				doquery($QryUpdateFleets, 'fleets');
				$fleet['end_time']         += $fleet['start_time'] -  $AksStartTime['Start'];
			}
		}
		
		$QryInsertFleet  = "INSERT INTO {{table}} SET ";
		$QryInsertFleet .= "`fleet_owner` = '". intval($CurrentUser['id']) ."', ";
		$QryInsertFleet .= "`fleet_mission` = '".intval($_POST['mission'])."',  ";
		$QryInsertFleet .= "`fleet_amount` = '". intval($FleetShipCount) ."', ";
		$QryInsertFleet .= "`fleet_array` = '". $fleet_array ."', ";
		$QryInsertFleet .= "`fleet_start_time` = '". $fleet['start_time'] ."', ";
		$QryInsertFleet .= "`fleet_start_galaxy` = '". intval($_POST['thisgalaxy']) ."', ";
		$QryInsertFleet .= "`fleet_start_system` = '". intval($_POST['thissystem']) ."', ";
		$QryInsertFleet .= "`fleet_start_planet` = '". intval($_POST['thisplanet']) ."', ";
		$QryInsertFleet .= "`fleet_start_type` = '". intval($_POST['thisplanettype']) ."', ";
		$QryInsertFleet .= "`fleet_end_time` = '". intval($fleet['end_time']) ."', ";
		$QryInsertFleet .= "`fleet_end_stay` = '". intval($StayTime) ."', ";
		$QryInsertFleet .= "`fleet_end_galaxy` = '". intval($_POST['galaxy']) ."', ";
		$QryInsertFleet .= "`fleet_end_system` = '". intval($_POST['system']) ."', ";
		$QryInsertFleet .= "`fleet_end_planet` = '". intval($_POST['planet']) ."', ";
		$QryInsertFleet .= "`fleet_end_type` = '". intval($_POST['planettype']) ."', ";
		$QryInsertFleet .= "`fleet_resource_metal` = '". $TransMetal ."', ";
		$QryInsertFleet .= "`fleet_resource_crystal` = '". $TransCrystal ."', ";
		$QryInsertFleet .= "`fleet_resource_deuterium` = '". $TransDeuterium ."', ";
                $QryInsertFleet .= "`fleet_fighter` = '". $fighterSerialize  ."', ";
                $QryInsertFleet .= "`fleet_troupes` = '".$troupesSerialize."',";
		$QryInsertFleet .= "`fleet_target_owner` = '". intval($TargetPlanet['id_owner']) ."', ";
		$QryInsertFleet .= "`fleet_group` = '".intval($fleet_group_mr)."',  ";
		$QryInsertFleet .= "`no_debarq` = '".intval((isset($_POST['debarq']))?1:0)."',  ";
		$QryInsertFleet .= "`fleet_name` = '". $selectedFleet['fleetName'] ."', ";

		$QryInsertFleet .= "`start_time` = '". time() ."';";
		doquery( $QryInsertFleet, 'fleets');

		$QryUpdatePlanet  = "UPDATE `{{table}}` SET ";
                $QryUpdatePlanet .= $FleetSubQRY2;
                $QryUpdatePlanet .= $FleetSubQRY3;
		$QryUpdatePlanet .= "`metal` = `metal` - ". $TransMetal .", ";
		$QryUpdatePlanet .= "`crystal` = `crystal` - ". $TransCrystal .", ";
		$QryUpdatePlanet .= "`deuterium` = `deuterium` - ". ($TransDeuterium + $consumption) ." ";




		$QryUpdatePlanet .= "WHERE ";
		$QryUpdatePlanet .= "`id` = ". intval($CurrentPlanet['id']) ." LIMIT 1;";

		doquery ($QryUpdatePlanet, "planets");

		 doquery('DELETE FROM {{table}} WHERE fleet_id = '.$_POST['fleetSelectedId'],'FleetsOrbit',true);

		$parse['mission'] 		= $missiontype[$_POST['mission']];
		$parse['distance'] 		= Format::pretty_number($distance);
		$parse['speedallsmin'] 	= Format::pretty_number($_POST['speedallsmin']);
		$parse['consumption'] 	= Format::pretty_number($consumption);
		$parse['from']	 		= $_POST['thisgalaxy'] .":". $_POST['thissystem']. ":". $_POST['thisplanet'];
		$parse['destination']	= $_POST['galaxy'] .":". $_POST['system'] .":". $_POST['planet'];
		$parse['start_time'] 	= date("M D d H:i:s", $fleet['start_time']);
		$parse['end_time'] 		= date("M D d H:i:s", $fleet['end_time']);

		$ships_row_template		= gettemplate ( 'fleet/fleet3_ships_row' );
		$ships_list				= '';

		foreach ( $fleetarray as $Ship => $Count )
		{
			$fleet_list['ship']		=	$lang['tech'][$Ship];
			$fleet_list['amount']	=	Format::pretty_number ( $Count );

			$ships_list			   .=	parsetemplate ( $ships_row_template , $fleet_list );
		}

		$parse['fleet_list'] 	= $ships_list;

		display ( parsetemplate ( gettemplate ( 'fleet/fleet3_table' ) , $parse ) , FALSE );
	}
}
?>