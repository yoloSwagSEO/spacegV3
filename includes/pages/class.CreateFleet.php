<?php
if(!defined('INSIDE')){ die(header("location:../../"));}

class CreateFleet
{

    public function __construct ($CurrentUser, &$CurrentPlanet)
    {
        global $_GET;
        if(isset($_GET['action']) && $_GET['action'] == "saveFleet"){
            $this->saveFleet($CurrentUser,$CurrentPlanet);
        }else{
            $this->makeFleetPage($CurrentUser,$CurrentPlanet);
        }
    }

    public function saveFleet($CurrentUser,&$CurrentPlanet,$fleetId=FALSE){
        global $resource, $reslist;
        if($fleetId){//On est deja sur une flotte existante

        }else{//On crée une flotte

        }
        //___d($CurrentPlanet);
        //On controle que les vaisseaux sont bien sur la planete
        $arrFleet = array();
        $amount = 0;
        foreach ($_POST['ship'] as $key =>$ship){
            if(!is_numeric($key)){
                $key = str_replace('s_','',$key);
                if(in_array($key,$reslist['fleet'])){//C'est bien un vaisseaux
                    if($CurrentPlanet[$resource[$key]] < $ship){//Plus de vx demandé que de VX possaidé
                        die(header('Location:game.php?page=createFleet'));
                    }else{//Tout est good \o/
                        $amount += $ship;
                       $arrFleet[] = array('ship'=> $key,'nb' => $ship);
                    }
                }else{//Ce n'est pas un vaisseaux
                    die(header('Location:game.php?page=createFleet'));
                }
            }
        }
        ___d($arrFleet);
        ___d($CurrentPlanet);
        $arrFleet = serialize($arrFleet);
        $sql = 'INSERT INTO {{table}} (fleetName,fleetPosition, fleet_owner, fleet_statut, fleet_amount,fleet_array) 
                VALUES ("'.$_POST['fleetName'].'",'.$CurrentPlanet['id'].','.$CurrentUser['id'].',0,'.$amount.',\''.$arrFleet.'\')';

        echo $sql;
        //doquery($sql,'FleetsOrbit');
        //header('Location:game.php?page=fleet');
    }

    
    public function makeFleetPage($CurrentUser,&$CurrentPlanet){
        global $lang, $resource, $reslist, $_GET;

        $parse = array();

        $parse['shipRows'] = "";
        //Information sur la colo concernée
        $galaxy         = intval((isset($_GET['galaxy'])?$_GET['galaxy']:$CurrentPlanet['galaxy']));
        $system         = intval((isset($_GET['system'])?$_GET['system']:$CurrentPlanet['system']));
        $planet         = intval((isset($_GET['planet'])?$_GET['planet']:$CurrentPlanet['planet']));

        foreach ($reslist['fleet'] as $n => $i)
        {

            if ($CurrentPlanet[$resource[$i]] > 0)
            {
                //Les vaisseaux de colonisation et les satelites solaires sont esclue.
                if ( $i == 212 || $i == 208 )
                {
                    continue;
                }
                $ships['shipId']			= $i;
                $ships['ship']				= 	$lang['tech'][$i];
                $ships['amount']			= 	Format::pretty_number ( $CurrentPlanet[$resource[$i]] );
                $ships['i']					=	$i;
                $ships['maxship']			=	$CurrentPlanet[$resource[$i]];
                $ships['consumption']		=	Fleets::ship_consumption ( $i, $CurrentUser );
                $ships['speed']				=	Fleets::fleet_max_speed ("", $i, $CurrentUser );
                $ships['capacity']			=	Fleets::fleet_capacity($i,$CurrentUser);

                $parse['shipRows']          .=   parsetemplate(gettemplate('fleet/create_fleet_row'), $ships);
            }
            $have_ships = TRUE;
        }

        display(parsetemplate(gettemplate('fleet/create_fleet_body'), $parse));
    }
}