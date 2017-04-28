<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowResourcesPage
{
	function __construct ( $CurrentUser , $CurrentPlanet )
	{
		global $lang, $ProdGrid, $resource, $reslist, $itemDb, $pricelist;
                
                $ArrayScreen = array();
                
		$parse 					= 	$lang;
		$game_metal_basic_income		=	read_config ( 'metal_basic_income' );
		$game_crystal_basic_income		=	read_config ( 'crystal_basic_income' );
		$game_deuterium_basic_income            =	read_config ( 'deuterium_basic_income' );
		$game_energy_basic_income		=	read_config ( 'energy_basic_income' );
		$game_resource_multiplier		=	read_config ( 'resource_multiplier' );
                $game_credit_basic_income               =       read_config ( 'credit_basic_income');
		
                if($CurrentPlanet['planet_type'] == 1 && $CurrentPlanet['control_type'] == 2){
                        $game_credit_basic_income       = 0;
                }elseif ($CurrentPlanet['planet_type'] == 3){
			$game_metal_basic_income    	= 0;
			$game_crystal_basic_income   	= 0;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}elseif($CurrentPlanet['planet_type'] == 4){
			$game_metal_basic_income    	= 2;
			$game_crystal_basic_income   	= 10;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}elseif($CurrentPlanet['planet_type'] == 5){
			$game_metal_basic_income    	= 20;
			$game_crystal_basic_income   	= 2;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}elseif($CurrentPlanet['planet_type'] == 6){
			$game_metal_basic_income    	= 0;
			$game_crystal_basic_income   	= 10;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}elseif($CurrentPlanet['planet_type'] == 7){
			$game_metal_basic_income    	= 40;
			$game_crystal_basic_income   	= 0;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}elseif($CurrentPlanet['planet_type'] == 8){
			$game_metal_basic_income    	= 30;
			$game_crystal_basic_income   	= 20;
			$game_deuterium_basic_income 	= 0;
                        $game_credit_basic_income       = 0;
		}
                $ArrayScreen['bonus']['basic_income'] = array(
                    'name'      =>  'Productions de base',
                    'metal'     =>  $game_metal_basic_income,
                    'cristal'   =>  $game_crystal_basic_income,
                    'deuterium' =>  $game_deuterium_basic_income,
                    'credit'    =>  $game_credit_basic_income
                );
		
                
                $CurrentPlanet['metal_max']	= Production::max_storable ( $CurrentPlanet[ $resource[22] ]);
		$CurrentPlanet['crystal_max']   = Production::max_storable ( $CurrentPlanet[ $resource[23] ]);
		$CurrentPlanet['deuterium_max'] = Production::max_storable ( $CurrentPlanet[ $resource[24] ]);
                $CurrentPlanet['credit_max']    = 0;
                
                $ArrayScreen['storage'] = array(
                    'metal'     =>  $CurrentPlanet['metal_max'],
                    'cristal'   =>  $CurrentPlanet['crystal_max'],
                    'deuterium' =>  $CurrentPlanet['deuterium_max'],
                    'credit'    =>  $CurrentPlanet['credit_max']                    
                );
                
                $ArrayScreen['production_level'] = 100;
                
		$parse['production_level'] 	= 100;		

		$post_porcent 				= Production::max_production ( $CurrentPlanet['energy_max'] , $CurrentPlanet['energy_used'] );


		$parse['resource_row']           	= '';
		$parse['metal_max']             	= '';
		$parse['crystal_max']           	= '';
		$parse['deuterium_max']                 = '';
		$CurrentPlanet['metal_perhour']  	= 0;
		$CurrentPlanet['crystal_perhour']	= 0;
		$CurrentPlanet['deuterium_perhour']	= 0;
                $CurrentPlanet['credit_perhour']	= 0;
		$CurrentPlanet['energy_max']     	= 0;
		$CurrentPlanet['energy_used']    	= 0;
                $CurrentPlanet['credit_max']		= 0;
                $BuildEnergy            = $CurrentUser["energy_tech"];

				// BOOST
		$geologe_boost		= ( $CurrentUser['rpg_geologue']  * GEOLOGUE );
		$geologieTech_boost	= ( $CurrentUser['geologie_tech'] * 0.02);
		$energiseTech_boost	= ( $CurrentUser['energy_tech'] * 0.04);
		$engineer_boost		= ( $CurrentUser['rpg_ingenieur'] * ENGINEER_ENERGY );
                
                
		$BuildTemp                       	= $CurrentPlanet[ 'temp_max' ];
		$ResourcesRowTPL			= gettemplate('resources/resources_row');
		foreach($reslist['prod'] as $ProdID)
		{
			if ($CurrentPlanet[$resource[$ProdID]] > 0 && isset($ProdGrid[$ProdID]))
			{
				$BuildLevelFactor	= $CurrentPlanet[ $resource[$ProdID]."_porcent" ];
				$BuildLevel		= $CurrentPlanet[ $resource[$ProdID] ];
				
				if($CurrentPlanet['control_type'] == 1){
					// PRODUCTION FORMULAS
					$metal_prod		= eval ( $ProdGrid[$ProdID]['formule']['metal'] );
					$crystal_prod		= eval ( $ProdGrid[$ProdID]['formule']['crystal'] );
					$deuterium_prod		= eval ( $ProdGrid[$ProdID]['formule']['deuterium'] );
					$energy_prod		= eval ( $ProdGrid[$ProdID]['formule']['energy'] );
	

                                        // PRODUCTION
					$metal	= $metal_prod + Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost );
                                        $crystal = $crystal_prod + Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost );
                                        $deuterium	= $deuterium_prod + Production::production_amount ( $deuterium_prod , $geologe_boost );
                                        
                                        
					if ( $ProdID >= 4 )
					{
                                               
						$energy			= $energy_prod+Production::production_amount ( $energy_prod , $engineer_boost , TRUE )+Production::production_amount ( $energy_prod , $energiseTech_boost , TRUE );
					

                                        }
					else
					{
                                                
						$energy			= Production::production_amount ( $energy_prod , 1 , TRUE );
					
                                        }
                                        

					if ( $energy > 0 )
					{
						$CurrentPlanet['energy_max']    += $energy;
					}
					else
					{
						$CurrentPlanet['energy_used']   += $energy;
					}
                                        
				}elseif($CurrentPlanet['control_type'] == 2){//on est sur un secteurs
					if($CurrentPlanet['planet_type'] == 1){//Habitable
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 10+(20*$CurrentPlanet['module_minier']);
							$crystal_prod				= 10+(10*$CurrentPlanet['module_minier']);
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= Production::current_production ( $metal_prod+Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent);
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
							$energy						= 0;
						}
					}elseif($CurrentPlanet['planet_type'] == 4){//Jovienne
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 2+(2*$CurrentPlanet['module_minier']);
							$crystal_prod				= 10+(15*$CurrentPlanet['module_minier']);
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= (Production::current_production ( $metal_prod+Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
						$energy						= 0;
						}
					}elseif($CurrentPlanet['planet_type'] == 5){//Telurique
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 20+(28*$CurrentPlanet['module_minier']);
							$crystal_prod				= 2+(2*$CurrentPlanet['module_minier']);
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= (Production::current_production ( $metal_prod+Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
						$energy						= 0;
						}
					}elseif($CurrentPlanet['planet_type'] == 6){//Nuange de gaz
						
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 0;//Il n'y as pas de metal dans un nuange de gaz
							$crystal_prod				= 10+(30*$CurrentPlanet['module_minier']);
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= 0;//(Production::current_production ( Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
						$energy						= 0;
						}
					}elseif($CurrentPlanet['planet_type'] == 7){//Asteroide Metalique
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 40+(40*$CurrentPlanet['module_minier']);
							$crystal_prod				= 0;//Pas de crystal sur des asteroide metalique
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= (Production::current_production ( $metal_prod+Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
						$energy						= 0;
						}
					}elseif($CurrentPlanet['planet_type'] == 8){//Asteroide Alcalin
						if( $ProdID == 204 && $CurrentPlanet['module_minier'] > 0){//uniquement les modules minier
							$metal_prod				= 30+(30*$CurrentPlanet['module_minier']);
							$crystal_prod				= 20+(25*$CurrentPlanet['module_minier']);
							$deuterium_prod				= 0;//un secteur ne produit pas de deut pour le moment
							$energy_prod				= 0;//un secteur ne produit pas d'energie les module minier sont autoalimenté
							$metal		+= (Production::current_production ( $metal_prod+Production::production_amount ( $metal_prod , $geologe_boost )+Production::production_amount ( $metal_prod , $geologieTech_boost ) , $post_porcent));
							$crystal	+= Production::current_production ( $crystal_prod+Production::production_amount ( $crystal_prod , $geologe_boost )+Production::production_amount ( $crystal_prod , $geologieTech_boost ) , $post_porcent);
							$deuterium	+= Production::current_production ( $deuterium_prod+Production::production_amount ( $deuterium_prod , $geologe_boost ) , $post_porcent);
						$energy						= 0;
						}
					}
				}
                                $ArrayScreen['bonus']['geologue']['name'] = "Ministres de la g&eacute;ologie";
                                $ArrayScreen['bonus']['engineer']['name'] = "Ministre de l'&eacute;nergie";
                                $ArrayScreen['bonus']['geologie']['name'] = "Technologie g&eacute;ologie";
                                $ArrayScreen['bonus']['energie']['name'] = "Technologie &eacute;nergie";
                                
                                $ArrayScreen['bonus']['geologue']['metal'] += Production::production_amount ( $metal_prod , $geologe_boost );
                                $ArrayScreen['bonus']['geologie']['metal'] += Production::production_amount ( $metal_prod , $geologieTech_boost );

                                $ArrayScreen['bonus']['geologue']['cristal'] += Production::production_amount ( $crystal_prod , $geologe_boost );
                                $ArrayScreen['bonus']['geologie']['cristal'] += Production::production_amount ( $crystal_prod , $geologieTech_boost );
                                
                                $ArrayScreen['bonus']['geologue']['deuterium'] += Production::production_amount ( $deuterium_prod , $geologe_boost );
                                
                                if ($energy_prod > 0){//Le bonus ne prend en compte QUE la production, on n'augmente pas la consomation x)
                                    $ArrayScreen['bonus']['engineer']['energie']  +=  Production::production_amount ( $energy_prod , $engineer_boost , TRUE );
                                    $ArrayScreen['bonus']['energie']['energie']   +=  Production::production_amount ( $energy_prod , $energiseTech_boost , TRUE );
                                }
                                
                                $CurrentPlanet['metal_perhour']     += $metal;
				$CurrentPlanet['crystal_perhour']   += $crystal;
				$CurrentPlanet['deuterium_perhour'] += $deuterium;

				$metal                               = Production::current_production ( $metal , $post_porcent );
				$crystal                             = Production::current_production ( $crystal , $post_porcent );
				$deuterium                           = Production::current_production ( $deuterium , $post_porcent );
				$energy                              = Production::current_production ( $energy , $post_porcent );
				$Field                               = $resource[$ProdID] ."_porcent";
				$CurrRow                             = array();
				$CurrRow['name']                     = $resource[$ProdID];
				$CurrRow['porcent']                  = $CurrentPlanet[$Field];
				$CurrRow['option']		     = $this->build_options ( $CurrRow['porcent'] );
				$CurrRow['type']                     = $lang['tech'][$ProdID];
				$CurrRow['level']                    = ($ProdID > 200) ? $lang['rs_amount'] : $lang['rs_lvl'];
				$CurrRow['level_type']               = $CurrentPlanet[ $resource[$ProdID] ];
				$CurrRow['metal_type']               = Format::pretty_number ( $metal     );
				$CurrRow['crystal_type']             = Format::pretty_number ( $crystal   );
				$CurrRow['deuterium_type']           = Format::pretty_number ( $deuterium );
				$CurrRow['energy_type']              = Format::pretty_number ( $energy    );
				$CurrRow['metal_type']               = Format::color_number ( $CurrRow['metal_type']     );
				$CurrRow['crystal_type']             = Format::color_number ( $CurrRow['crystal_type']   );
				$CurrRow['deuterium_type']           = Format::color_number ( $CurrRow['deuterium_type'] );
				$CurrRow['energy_type']              = Format::color_number ( $CurrRow['energy_type']    );
				$parse['resource_row']              .= parsetemplate ($ResourcesRowTPL , $CurrRow );
                                
                                
                                $ArrayScreen['batiments'][$ProdID] = array(
                                    'name'      =>  $resource[$ProdID],
                                    'type'      =>  $lang['tech'][$ProdID],
                                    'level'     =>  ($ProdID > 200) ? $lang['rs_amount'] : $lang['rs_lvl'],
                                    'level_type'=>  $CurrentPlanet[ $resource[$ProdID] ],
                                    'metal'     =>  floor($metal_prod),
                                    'cristal'   =>  floor($crystal_prod), 
                                    'deuterium' =>  floor($deuterium_prod), 
                                    'energie'   =>  floor($energy_prod), 
                                    'field'     =>  $Field,
                                );
			}
		}
                
                //--DEBUT-- GESTION DES CREDITS
                foreach ($reslist['build'] as $IdBat) {
                    $BuildLevelFactor			= $CurrentPlanet[ "credit_porcent" ];
                    $BuildLevel				= $CurrentPlanet[ $resource[$IdBat] ];
                   //on ne peux produire des credits que sur les colonies, les exploitation ne sont pas imposé (pour le moment)
                   if($CurrentPlanet['control_type'] == 1){ 
                       $credit_prod = $pricelist[$IdBat]['factor_cred'] * $BuildLevel * pow(1.2,$BuildLevel);
                       
                       $credits  	= (Production::current_production ($credit_prod , $post_porcent));
                       if(array_key_exists($IdBat,$ArrayScreen['batiments'])){
                           $ArrayScreen['batiments'][$IdBat]['credits'] = floor($credits);
                       }else{
                       	
                            $ArrayScreen['batiments'][$IdBat] = array(
                                    'name'      =>  $resource[$IdBat],
                                    'type'      =>  $lang['tech'][$IdBat],
                                    'level'     =>  $lang['rs_lvl'],
                                    'level_type'=>  $CurrentPlanet[ $resource[$IdBat] ],
                                    'metal'     =>  0,
                                    'cristal'   =>  0, 
                                    'deuterium' =>  0, 
                                    'energie'   =>  0, 
                                    'field'     =>  0,
                                    'credits'   =>  floor($credits)
                             ); 
                       }
                       
                   }					        
                }
             
                //--FIN-- GESTION DES CREDITS
                
                
                //Gestions des objets
                
                $ArrayScreen['matos'] = array();
                $sql = 'SELECT * FROM {{table}} WHERE id_planet = '.$CurrentPlanet['id'].' AND id_item in ('.implode(',',$itemDb['energie']).')';

                $result = doquery($sql,'entrepot');
                while ($data = mysqli_fetch_array($result)){
                    $CurrentPlanet['energy_max'] += ($itemDb['production']['energie'][$data['id_item']]['production'] * $data['qts']);
                    $CurrRow                             = array();
		    $CurrRow['name']                     = $itemDb['name'][$data['id_item']];
                    $CurrRow['type']                     = $itemDb['name'][$data['id_item']];
                    $CurrRow['level_type']               = $data['qts'];
                    $CurrRow['metal_type']               = 0;
                    $CurrRow['crystal_type']             = 0;
                    $CurrRow['deuterium_type']           = 0;
                    $CurrRow['energy_type']              = ($itemDb['production']['energie'][$data['id_item']]['production'] * $data['qts']);
                    
                    $ArrayScreen['matos'][$data['id_item']] =array(
                        'name'          =>  $itemDb['name'][$data['id_item']],
                        'type'          =>  $itemDb['name'][$data['id_item']],
                        'level_type'    =>  $data['qts'],
                        'metal'         =>  0,
                        'cristal'       =>  0,
                        'deuterium'     =>  0,
                        'credit'        =>  0,
                        'energie'       =>  ($itemDb['production']['energie'][$data['id_item']]['production'] * $data['qts'])
                    );
                    $parse['resource_row']              .= parsetemplate (gettemplate('resources/item_row') , $CurrRow );
                
                    
                }
		$parse['Production_of_resources_in_the_planet'] = str_replace('%s', $CurrentPlanet['name'], $lang['rs_production_on_planet']);

		$parse['production_level']	 = $this->prod_level ( $CurrentPlanet['energy_used'] , $CurrentPlanet['energy_max'] );
		$parse['metal_basic_income']     = $game_metal_basic_income;
		$parse['crystal_basic_income']   = $game_crystal_basic_income;
		$parse['deuterium_basic_income'] = $game_deuterium_basic_income;
		$parse['energy_basic_income']    = $game_energy_basic_income;
		$parse['metal_max']             .= $this->resource_color ( $CurrentPlanet['metal'] , $CurrentPlanet['metal_max'] );
		$parse['crystal_max']           .= $this->resource_color ( $CurrentPlanet['crystal'] , $CurrentPlanet['crystal_max'] );
		$parse['deuterium_max']         .= $this->resource_color ( $CurrentPlanet['deuterium'] , $CurrentPlanet['deuterium_max'] );

		$parse['metal_total']           = Format::color_number( Format::pretty_number( floor( ( ($CurrentPlanet['metal_perhour']     * 0.01 * $parse['production_level'] ) + $parse['metal_basic_income']))));
		$parse['crystal_total']         = Format::color_number( Format::pretty_number( floor( ( ($CurrentPlanet['crystal_perhour']   * 0.01 * $parse['production_level'] ) + $parse['crystal_basic_income']))));
		$parse['deuterium_total']       = Format::color_number( Format::pretty_number( floor( ( ($CurrentPlanet['deuterium_perhour'] * 0.01 * $parse['production_level'] ) + $parse['deuterium_basic_income']))));
		$parse['energy_total']          = Format::color_number( Format::pretty_number( floor( ( $CurrentPlanet['energy_max'] + $parse['energy_basic_income']    ) + $CurrentPlanet['energy_used'] ) ) );
                
                
                        
                //echo $CurrentPlanet['energy_max'] ;
		$parse['daily_metal']			= $this->calculate_daily ( $CurrentPlanet['metal_perhour'] , $parse['production_level'] , $parse['metal_basic_income'] );
		$parse['weekly_metal']			= $this->calculate_weekly ( $CurrentPlanet['metal_perhour'] , $parse['production_level'] , $parse['metal_basic_income'] );


		$parse['daily_crystal']			= $this->calculate_daily ( $CurrentPlanet['crystal_perhour'] , $parse['production_level'] , $parse['crystal_basic_income'] );
		$parse['weekly_crystal']		= $this->calculate_weekly ( $CurrentPlanet['crystal_perhour'] , $parse['production_level'] , $parse['crystal_basic_income'] );


		$parse['daily_deuterium']		= $this->calculate_daily ( $CurrentPlanet['deuterium_perhour'] , $parse['production_level'] , $parse['deuterium_basic_income'] );
		$parse['weekly_deuterium']		= $this->calculate_weekly ( $CurrentPlanet['deuterium_perhour'] , $parse['production_level'] , $parse['deuterium_basic_income'] );

              
  
		$parse['daily_metal']           = Format::color_number(Format::pretty_number($parse['daily_metal']));
		$parse['weekly_metal']          = Format::color_number(Format::pretty_number($parse['weekly_metal']));

		$parse['daily_crystal']         = Format::color_number(Format::pretty_number($parse['daily_crystal']));
		$parse['weekly_crystal']        = Format::color_number(Format::pretty_number($parse['weekly_crystal']));

		$parse['daily_deuterium']       = Format::color_number(Format::pretty_number($parse['daily_deuterium']));
		$parse['weekly_deuterium']      = Format::color_number(Format::pretty_number($parse['weekly_deuterium']));


		$ValidList['percent'] = array (  0,  10,  20,  30,  40,  50,  60,  70,  80,  90, 100 );
		$SubQry               = "";

		if ($_POST)
		{
			foreach($_POST as $Field => $Value)
			{
				$FieldName = $Field."_porcent";
				if ( isset( $CurrentPlanet[ $FieldName ] ) )
				{
					if ( ! in_array( $Value, $ValidList['percent']) )
					{
						header("Location: game.php?page=resources");
						exit;
					}

					$Value                        = $Value / 10;
					$CurrentPlanet[ $FieldName ]  = $Value;
					$SubQry                      .= ", `".$FieldName."` = '".$Value."'";
				}
			}

			$QryUpdatePlanet  = "UPDATE {{table}} SET ";
			$QryUpdatePlanet .= "`id` = '". $CurrentPlanet['id'] ."' ";
			$QryUpdatePlanet .= $SubQry;
			$QryUpdatePlanet .= "WHERE ";
			$QryUpdatePlanet .= "`id` = '". $CurrentPlanet['id'] ."';";
			doquery( $QryUpdatePlanet, 'planets');

			header("Location: game.php?page=resources");
		}
                return display($this->buildTable($ArrayScreen));
		//return display(parsetemplate( gettemplate('resources/resources'), $parse));
	}
        
        private function buildTable($ArrayScreen){
            
            $totalProd = array();
            $totalProd['metal']     =   0;
            $totalProd['cristal']   =   0;
            $totalProd['deuterium'] =   0;
            $totalProd['credit']    =   0;
            
            foreach ($ArrayScreen['batiments'] as $key ) {
            	//echo $key['credits'].'<br />';
                if($key['metal'] > 0 || $key['cristal'] > 0 || $key['deuterium'] > 0 || $key['credits'] != 0){
                    $line['name'] = $key['type'];
                    $line['level'] = $key['level_type'];
                    $line['etat'] = "100";
                    $line['metal'] = Format::color_number(Format::pretty_number($key['metal']));
                    $line['cristal'] = Format::color_number(Format::pretty_number($key['cristal']));
                    $line['deuterium'] = Format::color_number(Format::pretty_number($key['deuterium']));
                    $line['credit'] =  Format::color_number(Format::pretty_number((isset($key['credits']))?$key['credits']:0));
                    $line['energie'] = Format::color_number(Format::pretty_number((isset($key['energie']))?$key['energie']:0));
                    
                
                    $parse['batiment_line'] .=  parsetemplate( gettemplate('prod/prod_batiment_line'), $line);
                }
                $totalProd['metal']     += $key['metal'];
                $totalProd['cristal']   += $key['cristal'];
                $totalProd['deuterium'] += $key['deuterium'];
                $totalProd['credit']    += $key['credits'];
                $totalProd['energie']   += $key['energie'];
            }
            foreach ($ArrayScreen['bonus'] as $key){    
                $pordBonus['name'] = (isset($key['name']))?$key['name']:0;
                $pordBonus['metal'] = Format::color_number(Format::pretty_number((isset($key['metal']))?$key['metal']:0));
                $pordBonus['cristal'] = Format::color_number(Format::pretty_number((isset($key['cristal']))?$key['cristal']:0));
                $pordBonus['deuterium'] = Format::color_number(Format::pretty_number((isset($key['deuterium']))?$key['deuterium']:0));
                $pordBonus['credit'] = Format::color_number(Format::pretty_number((isset($key['credit']))?$key['credit']:0));
                $pordBonus['energie'] = Format::color_number(Format::pretty_number((isset($key['energie']))?$key['energie']:0));
                $parse['bonus_line'] .= parsetemplate( gettemplate('prod/prod_bonus_line'),$pordBonus);
                
                $totalProd['metal']     += $key['metal'];
                $totalProd['cristal']   += $key['cristal'];
                $totalProd['deuterium'] += $key['deuterium'];
                $totalProd['credit']    += $key['credit']; 
                $totalProd['energie']   += $key['energie'];
            }
            foreach ($ArrayScreen['matos'] as $key){
                $matosBonus['name'] = (isset($key['name']))?$key['name']:0;
                $matosBonus['level'] = (isset($key['level_type']))?$key['level_type']:0;
                $matosBonus['metal'] = Format::color_number(Format::pretty_number((isset($key['metal']))?$key['metal']:0));
                $matosBonus['cristal'] = Format::color_number(Format::pretty_number((isset($key['cristal']))?$key['cristal']:0));
                $matosBonus['deuterium'] = Format::color_number(Format::pretty_number((isset($key['deuterium']))?$key['deuterium']:0));
                $matosBonus['credit'] = Format::color_number(Format::pretty_number((isset($key['credit']))?$key['credit']:0));
                $matosBonus['energie'] = Format::color_number(Format::pretty_number((isset($key['energie']))?$key['energie']:0));
                $parse['material_line'] .= parsetemplate( gettemplate('prod/prod_matos_line'),$matosBonus);
                
                $totalProd['metal']     += $key['metal'];
                $totalProd['cristal']   += $key['cristal'];
                $totalProd['deuterium'] += $key['deuterium'];
                $totalProd['credit']    += $key['credit'];  
                $totalProd['energie']   += $key['energie']; 
            }
            
                $totalF['name']      = 'Production horaire :';
                $totalF['metal']     = Format::color_number(Format::pretty_number($totalProd['metal']));
                $totalF['cristal']   = Format::color_number(Format::pretty_number($totalProd['cristal']));
                $totalF['deuterium'] = Format::color_number(Format::pretty_number($totalProd['deuterium']));
                $totalF['credit']    = Format::color_number(Format::pretty_number($totalProd['credit']));
                $totalF['energie']   = Format::color_number(Format::pretty_number($totalProd['energie']));
                $parse['total'] = parsetemplate( gettemplate('prod/prod_total'),$totalF);
                
                $totalF['name']      = 'Production journaliere :';
                $totalF['metal']     = Format::color_number(Format::pretty_number($totalProd['metal']*24));
                $totalF['cristal']   = Format::color_number(Format::pretty_number($totalProd['cristal']*24));
                $totalF['deuterium'] = Format::color_number(Format::pretty_number($totalProd['deuterium']*24));
                $totalF['credit']    = Format::color_number(Format::pretty_number($totalProd['credit']*24));
                $totalF['energie']   = Format::color_number(Format::pretty_number($totalProd['energie']));
                $parse['total'] .= parsetemplate( gettemplate('prod/prod_total'),$totalF);
                
                $totalF['name']      = 'Production hebdomadaire :';
                $totalF['metal']     = Format::color_number(Format::pretty_number($totalProd['metal']*24*7));
                $totalF['cristal']   = Format::color_number(Format::pretty_number($totalProd['cristal']*24*7));
                $totalF['deuterium'] = Format::color_number(Format::pretty_number($totalProd['deuterium']*24*7));
                $totalF['credit']    = Format::color_number(Format::pretty_number($totalProd['credit']*24*7));
                $totalF['energie']   = Format::color_number(Format::pretty_number($totalProd['energie']));
                $parse['total'] .= parsetemplate( gettemplate('prod/prod_total'),$totalF);
                
                $totalF['name']      = 'Production mensuelle :';
                $totalF['metal']     = Format::color_number(Format::pretty_number($totalProd['metal']*24*7*4));
                $totalF['cristal']   = Format::color_number(Format::pretty_number($totalProd['cristal']*24*7*4));
                $totalF['deuterium'] = Format::color_number(Format::pretty_number($totalProd['deuterium']*24*7*4));
                $totalF['credit']    = Format::color_number(Format::pretty_number($totalProd['credit']*24*7*4));
                $totalF['energie']   = Format::color_number(Format::pretty_number($totalProd['energie']));
                $parse['total'] .= parsetemplate( gettemplate('prod/prod_total'),$totalF);
                
            return parsetemplate( gettemplate('prod/prod_body'),$parse);
        }
	/**
	 * method build_options
	 * param $current_porcentage
	 * return porcentage options for the select element
	 */
	private function build_options ( $current_porcentage )
	{
		$option_row	= '';

		for ( $option = 10 ; $option >= 0 ; $option-- )
		{
			$opt_value			= $option * 10;

			if ( $option == $current_porcentage )
			{
				$opt_selected	= " selected=selected";
			}
			else
			{
				$opt_selected	= "";
			}

			$option_row .= "<option value=\"" . $opt_value . "\"" . $opt_selected . ">" . $opt_value . "%</option>";
		}

		return $option_row;
	}

	/**
	 * method calculate_daily
	 * param1 $prod_per_hour
	 * param2 $prod_level
	 * param3 $basic_income
	 * return production per day
	 */
	private function calculate_daily ( $prod_per_hour , $prod_level , $basic_income )
	{
		return floor ( ( $basic_income + ( $prod_per_hour * 0.01 * $prod_level ) ) * 24 );
	}

	/**
	 * method calculate_weekly
	 * param1 $prod_per_hour
	 * param2 $prod_level
	 * param3 $basic_income
	 * return production per week
	 */
	private function calculate_weekly ( $prod_per_hour , $prod_level , $basic_income )
	{
		return floor ( ( $basic_income + ( $prod_per_hour * 0.01 * $prod_level ) ) * 24 * 7 );
	}

	/**
	 * method resource_color
	 * param1 $current_amount
	 * param2 $max_amount
	 * return color depending on the current storage capacity
	 */
	private function resource_color ( $current_amount , $max_amount )
	{
		if ( $max_amount < $current_amount )
		{
			return ( Format::color_red ( Format::pretty_number ( $max_amount / 1000 ) . 'k' ) );
		}
		else
		{
			return ( Format::color_green ( Format::pretty_number ( $max_amount / 1000 ) . 'k' ) );
		}
	}

	/**
	 * method prod_level
	 * param1 $energy_used
	 * param2 $energy_max
	 * return the production level based on the energy consumption
	 */
	private function prod_level ( $energy_used , $energy_max )
	{
		if ( $energy_max == 0 && $energy_used > 0 )
		{
			$prod_level	= 0;
		}
		elseif ( $energy_max > 0 && abs ( $energy_used ) > $energy_max )
		{
			$prod_level	= floor ( ( $energy_max ) / ( $energy_used * -1 ) * 100 );
		}
		elseif ($energy_max == 0 && abs ( $energy_used ) > $energy_max )
		{
			$prod_level = 0;
		}
		else
		{
			$prod_level = 100;
		}

		if ( $prod_level > 100 )
		{
			$prod_level	= 100;
		}

		return $prod_level;
	}
}
?>