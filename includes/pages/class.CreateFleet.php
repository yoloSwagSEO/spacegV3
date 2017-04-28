<?php
if(!defined('INSIDE')){ die(header("location:../../"));}

class CreateFleet
{

    public function __construct ($CurrentUser, &$CurrentPlanet)
    {
        global $lang, $resource, $reslist, $_GET;

        $parse = array();

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
    public function addShipToFleet($fleetId,$sheep){

    }
    public function saveFleet($fleetId=FALSE){
        if($fleetId){//On est deja sur une flotte existante

        }else{//On crée une flotte

        }
    }
}