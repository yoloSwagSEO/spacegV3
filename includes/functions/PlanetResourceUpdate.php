<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */
if (!defined('INSIDE')) {
    die(header("location:../../"));
}

function PlanetResourceUpdate($CurrentUser, &$CurrentPlanet, $UpdateTime, $Simul = FALSE) {
    global $ProdGrid, $resource, $reslist, $itemDb, $pricelist;

    $game_resource_multiplier = read_config('resource_multiplier');
    $game_metal_basic_income = read_config('metal_basic_income');
    $game_crystal_basic_income = read_config('crystal_basic_income');
    $game_deuterium_basic_income = read_config('deuterium_basic_income');
    $game_credit_basic_income = read_config('credit_basic_income');

    if ($CurrentPlanet['planet_type'] == 3) {
        $game_metal_basic_income = 0;
        $game_crystal_basic_income = 0;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    } elseif ($CurrentPlanet['planet_type'] == 4) {
        $game_metal_basic_income = 2;
        $game_crystal_basic_income = 10;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    } elseif ($CurrentPlanet['planet_type'] == 5) {
        $game_metal_basic_income = 20;
        $game_crystal_basic_income = 2;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    } elseif ($CurrentPlanet['planet_type'] == 6) {
        $game_metal_basic_income = 0;
        $game_crystal_basic_income = 10;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    } elseif ($CurrentPlanet['planet_type'] == 7) {
        $game_metal_basic_income = 40;
        $game_crystal_basic_income = 0;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    } elseif ($CurrentPlanet['planet_type'] == 8) {
        $game_metal_basic_income = 30;
        $game_crystal_basic_income = 20;
        $game_deuterium_basic_income = 0;
        $game_credit_basic_income = 0;
    }

    $CurrentPlanet['metal_max'] = Production::max_storable($CurrentPlanet[$resource[22]]);
    $CurrentPlanet['crystal_max'] = Production::max_storable($CurrentPlanet[$resource[23]]);
    $CurrentPlanet['deuterium_max'] = Production::max_storable($CurrentPlanet[$resource[24]]);

    $MaxMetalStorage = $CurrentPlanet['metal_max'];
    $MaxCristalStorage = $CurrentPlanet['crystal_max'];
    $MaxDeuteriumStorage = $CurrentPlanet['deuterium_max'];
    
    $Caps = array();
    $BuildTemp = $CurrentPlanet['temp_max'];

    $parse['production_level'] = 100;

    $post_porcent = Production::max_production($CurrentPlanet['energy_max'], $CurrentPlanet['energy_used']);
    $Caps['metal_perhour'] = 0;
    $Caps['crystal_perhour'] = 0;
    $Caps['deuterium_perhour'] = 0;
    $Caps['credit_perhour'] = 0;
    $Caps['energy_used'] = 0;
    $Caps['energy_max'] = 0;
    $Caps['credit_max'] = 0;

    $BuildEnergy = $CurrentUser["energy_tech"];

    // BOOST
    $geologe_boost = ( $CurrentUser['rpg_geologue'] * GEOLOGUE );
    $geologieTech_boost = ( $CurrentUser['geologie_tech'] * 0.02);
    $energiseTech_boost = ( $CurrentUser['energy_tech'] * 0.04);
    $engineer_boost = ( $CurrentUser['rpg_ingenieur'] * ENGINEER_ENERGY );

    for ($ProdID = 0; $ProdID < 300; $ProdID++) {
        if (in_array($ProdID, $reslist['prod'])) {
            $BuildLevelFactor = isset($CurrentPlanet[$resource[$ProdID] . "_porcent"])?$CurrentPlanet[$resource[$ProdID] . "_porcent"]:100;
            $BuildLevel = $CurrentPlanet[$resource[$ProdID]];

            // PRODUCTION
            //on est sur une colonie
            if ($CurrentPlanet['control_type'] == 1) {
                // PRODUCTION FORMULAS
                $metal_prod = eval($ProdGrid[$ProdID]['formule']['metal']);
				
                $crystal_prod = eval($ProdGrid[$ProdID]['formule']['crystal']);
                $deuterium_prod = eval($ProdGrid[$ProdID]['formule']['deuterium']);
                $energy_prod = eval($ProdGrid[$ProdID]['formule']['energy']);

                $Caps['metal_perhour'] += (Production::current_production($metal_prod+Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                $Caps['crystal_perhour'] += Production::current_production($crystal_prod+Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent);
                $Caps['deuterium_perhour'] += Production::current_production($deuterium_prod+Production::production_amount($deuterium_prod, $geologe_boost), $post_porcent);

                if ($ProdID >= 4) {
                    if ($ProdID == 12 && $CurrentPlanet['deuterium'] == 0) {
                        continue;
                    }
                    $Caps['energy_max'] += $energy_prod+Production::production_amount($energy_prod, $engineer_boost, TRUE) + Production::production_amount($energy_prod, $energiseTech_boost, TRUE);
                } else {
                    $Caps['energy_used'] += Production::production_amount($energy_prod, 1, TRUE);
                }
            } elseif ($CurrentPlanet['control_type'] == 2) {//on est sur un secteurs
                if ($CurrentPlanet['planet_type'] == 1) {//Habitable
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 10 + (20 * $CurrentPlanet['module_minier']);
                        $crystal_prod = 10 + (10 * $CurrentPlanet['module_minier']);
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += ($metal_prod+Production::current_production(Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                } elseif ($CurrentPlanet['planet_type'] == 4) {//Jovienne
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 2 + (2 * $CurrentPlanet['module_minier']);
                        $crystal_prod = 10 + (15 * $CurrentPlanet['module_minier']);
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += ($metal_prod+Production::current_production(Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                } elseif ($CurrentPlanet['planet_type'] == 5) {//Telurique
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 20 + (28 * $CurrentPlanet['module_minier']);
                        $crystal_prod = 2 + (2 * $CurrentPlanet['module_minier']);
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += ($metal_prod+Production::current_production(Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                } elseif ($CurrentPlanet['planet_type'] == 6) {//Nuange de gaz
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 0; //Il n'y as pas de metal dans un nuange de gaz
                        $crystal_prod = 10 + (30 * $CurrentPlanet['module_minier']);
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += 0; //(Production::current_production ( Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                } elseif ($CurrentPlanet['planet_type'] == 7) {//Asteroide Metalique
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 40 + (40 * $CurrentPlanet['module_minier']);
                        $crystal_prod = 0; //Pas de crystal sur des asteroide metalique
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += ($metal_prod+Production::current_production(Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                } elseif ($CurrentPlanet['planet_type'] == 8) {//Asteroide Alcalin
                    if ($ProdID == 204 && $CurrentPlanet['module_minier'] > 0) {//uniquement les modules minier
                        $metal_prod = 30 + (30 * $CurrentPlanet['module_minier']);
                        $crystal_prod = 20 + (25 * $CurrentPlanet['module_minier']);
                        $deuterium_prod = 0; //un secteur ne produit pas de deut pour le moment
                        $energy_prod = 0; //un secteur ne produit pas d'energie les module minier sont autoalimenté
                        $Caps['metal_perhour'] += ($metal_prod+Production::current_production(Production::production_amount($metal_prod, $geologe_boost) + Production::production_amount($metal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['crystal_perhour'] += ($crystal_prod+Production::current_production(Production::production_amount($crystal_prod, $geologe_boost) + Production::production_amount($crystal_prod, $geologieTech_boost), $post_porcent));
                        $Caps['deuterium_perhour'] += 0;
                    }
                }
            }
        }
    }
    
    //Si l'on est sur une lune on remets toutes les prods a zero (pour le moment)
    if ($CurrentPlanet['planet_type'] == 3) {
        $game_metal_basic_income = 0;
        $game_crystal_basic_income = 0;
        $game_deuterium_basic_income = 0;
        $CurrentPlanet['metal_perhour'] = 0;
        $CurrentPlanet['crystal_perhour'] = 0;
        $CurrentPlanet['deuterium_perhour'] = 0;
        $CurrentPlanet['energy_used'] = 0;
        $CurrentPlanet['energy_max'] = 0;
    } else {
        $CurrentPlanet['metal_perhour'] = $Caps['metal_perhour']+$game_metal_basic_income;
        $CurrentPlanet['crystal_perhour'] = $Caps['crystal_perhour']+$game_crystal_basic_income;
        $CurrentPlanet['deuterium_perhour'] = $Caps['deuterium_perhour']+$game_deuterium_basic_income;
        $CurrentPlanet['energy_used'] = $Caps['energy_used'];
        $CurrentPlanet['energy_max'] = $Caps['energy_max'];
    }
	
	//echo $Caps['metal_perhour']+$game_metal_basic_income;
    //Jouon avec les crédits
    //TODO encours ------------------------
    // Rajout de la générations des crédits V1
    // A EQUILIBRE
    //-------------------------------------
    //On passe par un foreach au lieu d'un for, ca nous évite des passage inutile.
    foreach ($reslist['build'] as $IdBat) {


        $BuildLevelFactor = $CurrentPlanet["credit_porcent"];
        $BuildLevel = $CurrentPlanet[$resource[$IdBat]];

        // BOOST
        //Boost d'un ministaire a prévoir

        //on ne peux produire des credits que sur les colonies, les exploitation ne sont pas imposé (pour le moment)
        if ($CurrentPlanet['control_type'] == 1) {
            $credit_prod = $pricelist[$IdBat]['factor_cred'] * $BuildLevel * pow(1.2, $BuildLevel);
            //echo $resource[$IdBat].'=>'.$credit_prod.'<br />';
            $Caps['credit_perhour'] += (Production::current_production($credit_prod, $post_porcent));
        }
    }
    
    $CurrentPlanet['credit_perhour'] = $Caps['credit_perhour']+$game_credit_basic_income;

    //on regarde si on a des items de production!
    $sql = 'SELECT * FROM {{table}} WHERE id_planet = ' . $CurrentPlanet['id'] . ' AND id_item in (' . implode(',', $itemDb['energie']) . ')';
    doquery("UNLOCK TABLES", "");
    $result = doquery($sql, 'entrepot');
    while ($data = mysqli_fetch_array($result)) {
        //pour le moment les items ne peuvent produire que des boosts d'énergie.

        $CurrentPlanet['energy_max'] += ($itemDb['production']['energie'][$data['id_item']]['production'] * $data['qts']);
    }


            
    $ProductionTime = ($UpdateTime - $CurrentPlanet['last_update']);
    $CurrentPlanet['last_update'] = $UpdateTime;

    if ($CurrentPlanet['energy_max'] == 0 && $CurrentPlanet['control_type'] == 1) {
        $CurrentPlanet['metal_perhour'] = $game_metal_basic_income;
        $CurrentPlanet['crystal_perhour'] = $game_crystal_basic_income;
        $CurrentPlanet['deuterium_perhour'] = $game_deuterium_basic_income;
        $production_level = 100;
    } elseif ($CurrentPlanet["energy_max"] >= $CurrentPlanet["energy_used"]) {
        $production_level = 100;
    } else {
        $production_level = floor(($CurrentPlanet['energy_max'] / $CurrentPlanet['energy_used']) * 100);
    }
    if ($production_level > 100) {
        $production_level = 100;
    } elseif ($production_level < 0) {
        $production_level = 0;
    }
    if ($CurrentPlanet['control_type'] == 1) {
        $CreditProduction = (($ProductionTime * ($CurrentPlanet['credit_perhour'] / 3600))) * (0.01 * $production_level);
        $CreditBaseProduc = (($ProductionTime * ($game_credit_basic_income / 3600 )));
        $creditTotal = $CurrentPlanet['credit'] + $CreditProduction + $CreditBaseProduc;
        $CurrentPlanet['credit'] = $creditTotal;
    } else {
        $CurrentPlanet['credit'] = 0;
        $CurrentPlanet['credit_perhour'] = 0;
    }
    if ($CurrentPlanet['metal'] <= $MaxMetalStorage) {
        $MetalProduction = (($ProductionTime * ($CurrentPlanet['metal_perhour'] / 3600))) * (0.01 * $production_level);
        $MetalBaseProduc = (($ProductionTime * ($game_metal_basic_income / 3600 )));
        $MetalTheorical = $CurrentPlanet['metal'] + $MetalProduction + $MetalBaseProduc;
        if ($MetalTheorical <= $MaxMetalStorage) {
            $CurrentPlanet['metal'] = $MetalTheorical;
        } else {
            $CurrentPlanet['metal'] = $MaxMetalStorage;
        }
    }

    if ($CurrentPlanet['crystal'] <= $MaxCristalStorage) {
        $CristalProduction = (($ProductionTime * ($CurrentPlanet['crystal_perhour'] / 3600))) * (0.01 * $production_level);
        $CristalBaseProduc = (($ProductionTime * ($game_crystal_basic_income / 3600 )));
        $CristalTheorical = $CurrentPlanet['crystal'] + $CristalProduction + $CristalBaseProduc;
        if ($CristalTheorical <= $MaxCristalStorage) {
            $CurrentPlanet['crystal'] = $CristalTheorical;
        } else {
            $CurrentPlanet['crystal'] = $MaxCristalStorage;
        }
    }

    if ($CurrentPlanet['deuterium'] <= $MaxDeuteriumStorage) {
        $DeuteriumProduction = (($ProductionTime * ($CurrentPlanet['deuterium_perhour'] / 3600))) * (0.01 * $production_level);
        $DeuteriumBaseProduc = (($ProductionTime * ($game_deuterium_basic_income / 3600 )));
        $DeuteriumTheorical = $CurrentPlanet['deuterium'] + $DeuteriumProduction + $DeuteriumBaseProduc;
        if ($DeuteriumTheorical <= $MaxDeuteriumStorage) {
            $CurrentPlanet['deuterium'] = $DeuteriumTheorical;
        } else {
            $CurrentPlanet['deuterium'] = $MaxDeuteriumStorage;
        }
    }

    if ($CurrentPlanet['metal'] < 0) {
        $CurrentPlanet['metal'] = 0;
    }

    if ($CurrentPlanet['crystal'] < 0) {
        $CurrentPlanet['crystal'] = 0;
    }

    if ($CurrentPlanet['deuterium'] < 0) {
        $CurrentPlanet['deuterium'] = 0;
    }

    //parti maj dans DB Si l'on n'est pas dans une simulation.
    if ($Simul == FALSE) {
        $Builded = HandleElementBuildingQueue($CurrentUser, $CurrentPlanet, $ProductionTime);
        $Builded2 = HandleElementCasernQueue($CurrentUser, $CurrentPlanet, $ProductionTime);
        $QryUpdatePlanet = "UPDATE {{table}} SET ";
        $QryUpdatePlanet .= "`metal` = '" . $CurrentPlanet['metal'] . "', ";
        $QryUpdatePlanet .= "`crystal` = '" . $CurrentPlanet['crystal'] . "', ";
        $QryUpdatePlanet .= "`deuterium` = '" . $CurrentPlanet['deuterium'] . "', ";
        $QryUpdatePlanet .= "`credit` = '" . $CurrentPlanet['credit'] . "', ";
        $QryUpdatePlanet .= "`last_update` = '" . $CurrentPlanet['last_update'] . "', ";
        $QryUpdatePlanet .= "`b_hangar_id` = '" . $CurrentPlanet['b_hangar_id'] . "', ";
        $QryUpdatePlanet .= "`b_casern_id` = '" . $CurrentPlanet['b_casern_id'] . "', ";
        $QryUpdatePlanet .= "`metal_perhour` = '" . $CurrentPlanet['metal_perhour'] . "', ";
        
        $QryUpdatePlanet .= "`metal_max` = '" . $CurrentPlanet['metal_max'] . "', ";
        $QryUpdatePlanet .= "`crystal_max` = '" . $CurrentPlanet['crystal_max'] . "', ";
        $QryUpdatePlanet .= "`deuterium_max` = '" . $CurrentPlanet['deuterium_max'] . "', ";
        
        $QryUpdatePlanet .= "`crystal_perhour` = '" . $CurrentPlanet['crystal_perhour'] . "', ";
        $QryUpdatePlanet .= "`deuterium_perhour` = '" . $CurrentPlanet['deuterium_perhour'] . "', ";
        $QryUpdatePlanet .= "`credit_perhour` = '" . $CurrentPlanet['credit_perhour'] . "', ";
        $QryUpdatePlanet .= "`energy_used` = '" . $CurrentPlanet['energy_used'] . "', ";
        $QryUpdatePlanet .= "`energy_max` = '" . $CurrentPlanet['energy_max'] . "', ";
        if ($Builded != '') {
            foreach ($Builded as $Element => $Count) {
                if ($Element <> '')
                    $QryUpdatePlanet .= "`" . $resource[$Element] . "` = '" . $CurrentPlanet[$resource[$Element]] . "', ";
            }
        }
        if ($Builded2 != '') {
            foreach ($Builded2 as $Element => $Count) {
                if ($Element <> '')
                    $QryUpdatePlanet .= "`" . $resource[$Element] . "` = '" . $CurrentPlanet[$resource[$Element]] . "', ";
            }
        }
        $QryUpdatePlanet .= "`b_hangar` = '" . $CurrentPlanet['b_hangar'] . "', ";
        $QryUpdatePlanet .= "`b_casern` = '" . $CurrentPlanet['b_casern'] . "' ";
        $QryUpdatePlanet .= "WHERE ";
        $QryUpdatePlanet .= "`id` = '" . $CurrentPlanet['id'] . "';";
        doquery($QryUpdatePlanet, 'planets');
    }
}

?>