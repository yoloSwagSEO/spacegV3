<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowEntrepotPage
{

	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
                
		$CurrentPlanet['metal_max'] = Production::max_storable($CurrentPlanet[$resource[22]]);
		$CurrentPlanet['crystal_max'] = Production::max_storable($CurrentPlanet[$resource[23]]);
		$CurrentPlanet['deuterium_max'] = Production::max_storable($CurrentPlanet[$resource[24]]);

                $sql = 'SELECT e.*, i.*
                        FROM {{table}} AS e
                        LEFT join xgp_item AS i ON e.id_item = i.id
                        WHERE e.`id_planet` = '.$CurrentPlanet['id'];
                $result = doquery($sql,'entrepot');
                $item ='';
                while($array = mysqli_fetch_array($result)){
                    $item .= '<div class="item_gouv">
                                <div class="name">
                                    <div class="col1">
                                        <img src="styles/skins/xgproyect/gebaeude/items/ico/'.$array['id_item'].'.png" />
                                    </div>
                                    <div class="col2">
                                        <a href="game.php?page=infositem&amp;gid='.$array['id_item'].'" class="infoshow tooltipship">'.$array['nom'].'</a> <br />
                                        <i>En Stock ('.$array['qts'].')</i>
                                    </div>
                                     <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>';
                }

		
                $parse['metal']=intval($CurrentPlanet['metal']);
                $parse['cristal']=intval($CurrentPlanet['crystal']);
                $parse['deut']=intval($CurrentPlanet['deuterium']);
                 
                $parse['metalMax']=Production::max_storable($CurrentPlanet[$resource[22]]);
                $parse['cristalMax']=Production::max_storable($CurrentPlanet[$resource[23]]);
                $parse['deutMax']=Production::max_storable($CurrentPlanet[$resource[24]]);
                
                $parse['ApourcentMetal']   = intval(100 * $parse['metal'] / $parse['metalMax']);
                $parse['ApourcentCristal'] = intval(100 * $parse['cristal'] / $parse['cristalMax']);
                $parse['ApourcentDeut']    = intval(100 * $parse['deut'] / $parse['deutMax']);
                
                $parse['pourcentMetal'] = ($parse['ApourcentMetal'] > 100)?100:$parse['ApourcentMetal'];
                $parse['pourcentCristal'] = ($parse['ApourcentCristal'] > 100)?100:$parse['ApourcentCristal'];
                $parse['pourcentDeut'] = ($parse['ApourcentDeut'] > 100)?100:$parse['ApourcentDeut'];
                
                $parse['item']= $item;
                
		display(parsetemplate(gettemplate('entrepot/entrepot_body'), $parse));
	}
}
?>