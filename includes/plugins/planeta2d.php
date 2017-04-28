<?php

if(!defined('INSIDE')){ die(header("location:../../"));}
 
#@author: LordPretender for xgproyect.fr
#@name: Planeta 2D
#@source : http://www.xgproyect.net/2-10-x-mods-en-desarrollo/11082-simple-mod-visual-de-edificios-en-2d.html
#@version : 1.1

class Planeta2D extends Plugin
{
	
	public function __construct($plugin_id)
	{
		$this->plugin_name = "Planeta 2D";
		$this->plugin_desc = "Affiche les bâtiments en 2D.";
		
		parent::__construct($plugin_id);
	}
	
	protected function load()
	{
		global $lang;
		
		//Ajout de nouvelles traductions
		$this->addLang('o2d_title', 'Planète 2D');
		
		//Ajout d'un lien dans le menu du jeu
		$this->addMenuLink("overview", "overview2d", $lang['o2d_title'], 'pageOverview2d');
	}
	
	public function pageOverview2d()
	{
		$parse["dpath"] = XGP_ROOT . "includes/plugins/" . $this->plugin_id . "/images/";

		$this->parseImages($parse);
		$this->parseNiveaux($parse);
		$this->parseNoms($parse);
		
		die(display(parsetemplate( $this->getPageTemplate('overview_body2d'), $parse ))); //Aunque display tiene un die() incluido, por si las moscas, otro die.
	}
	
	private function parseNoms(&$parse)
	{
		global $lang;
		
		$parse['nfo_mina_metalname']                   = $lang['info'][1]['name'];
		$parse['nfo_mina_cristalname']                 = $lang['info'][2]['name']; 
		$parse['nfo_mina_deuterioname']                = $lang['info'][3]['name'];
		$parse['nfo_mina_solarname']                    = $lang['info'][4]['name'];
		$parse['nfo_Fusionname']                       =$lang['info'][12]['name'];
		$parse['nfo_Robotsname']                          =$lang['info'][14]['name'];
		$parse['nfo_Nanobotsname']                     =$lang['info'][15]['name'];
		$parse['nfo_Hangarname']                       =$lang['info'][21]['name'];
		$parse['nfo_alma_metalname']                   =$lang['info'][22]['name'];
		$parse['nfo_alma_cristalname']                 =$lang['info'][23]['name'];
		$parse['nfo_alma_deuterioname']                =$lang['info'][24]['name'];
		$parse['nfo_Laboratorioname']                  =$lang['info'][31]['name'];
		$parse['nfo_Terraformername']                  =$lang['info'][33]['name'];
		$parse['nfo_depoaliname']                      =$lang['info'][34]['name'];
		$parse['nfo_siloname']                         =$lang['info'][44]['name'] ;
	}
	
	private function parseNiveaux(&$parse)
	{
		global $planetrow;
		
		$parse['metal_mine_n']			= $planetrow['metal_mine'];
		$parse['crystal_mine_n']		= $planetrow['crystal_mine'];
		$parse['deuterium_sintetizer_n']= $planetrow['deuterium_sintetizer'];
		$parse['solar_plant_n']			= $planetrow['solar_plant'];
		$parse['fusion_plant_n']		= $planetrow['fusion_plant'];
		$parse['robot_factory_n']		= $planetrow['robot_factory'];
		$parse['nano_factory_n']		= $planetrow['nano_factory'];
		$parse['hangar_n']				= $planetrow['hangar'];
		$parse['crystal_store_n']		= $planetrow['crystal_store'];
		$parse['deuterium_store_n']		= $planetrow['deuterium_store'];
		$parse['laboratory_n']			= $planetrow['laboratory'];
		$parse['terraformer_n']			= $planetrow['terraformer'];
		$parse['ally_deposit_n']		= $planetrow['ally_deposit'];
		$parse['mondbasis_n']			= $planetrow['mondbasis'];
		$parse['phalanx_n']				= $planetrow['phalanx'];
		$parse['sprungtor_n']			= $planetrow['sprungtor'];
		$parse['silo_n']				= $planetrow['silo'];
		$parse['metal_store_n']			= $planetrow['metal_store'];
	}
	
	private function parseImages(&$parse)
	{
		global $planetrow;
		
		if ($planetrow['metal_mine'] > 0 ) {
			$parse['metal_mine'] = "1";
		} else {
			$parse['metal_mine'] = "free";
		}
		
		if ($planetrow['crystal_mine'] > 0 ) {
			$parse['crystal_mine'] = "2";
		} else {
			$parse['crystal_mine'] = "free";
		}
		
		if ($planetrow['deuterium_sintetizer'] > 0 ) {
			$parse['deuterium_sintetizer'] = "3";
		} else {
			$parse['deuterium_sintetizer']  = "free";
		}
		
		if ($planetrow['solar_plant'] > 0 ) {
			$parse['solar_plant'] = "4";
		} else {
			$parse['solar_plant'] = "free";
		}
		
		if ($planetrow['fusion_plant'] > 0 ) {
			$parse['fusion_plant'] = "12";
		} else {
			$parse['fusion_plant'] = "free";
		}
		
		if ($planetrow['robot_factory'] > 0 ) {
			$parse['robot_factory'] = "14";
		} else {
			$parse['robot_factory'] = "free";
		}
		
		if ($planetrow['nano_factory'] > 0 ) {
			$parse['nano_factory'] = "15";
		} else {
			$parse['nano_factory'] = "free";
		}
		
		if ($planetrow['hangar'] > 0 ) {
			$parse['hangar'] = "21";
		} else {
			$parse['hangar'] = "free";
		}
		
		if ($planetrow['metal_store'] > 0 ) {
			$parse['metal_store'] = "22";
		} else {
			$parse['metal_store'] = "free";
		}
		
		if ($planetrow['crystal_store'] > 0 ) {
			$parse['crystal_store'] = "23";
		} else {
			$parse['crystal_store'] = "free";
		}
		if ($planetrow['deuterium_store'] > 0 ) {
			$parse['deuterium_store'] = "24";
		} else {
			$parse['deuterium_store'] = "free";
		}
		
		if ($planetrow['laboratory'] > 0 ) {
			$parse['laboratory'] = "31";
		} else {
			$parse['laboratory'] = "free";
		}
		
		if ($planetrow['terraformer'] > 0 ) {
			$parse['terraformer'] = "33";
		} else {
			$parse['terraformer'] = "free";
		}
		
		if ($planetrow['ally_deposit'] > 0 ) {
			$parse['ally_deposit'] = "34";
		} else {
			$parse['ally_deposit'] = "free";
		}

		if ($planetrow['silo'] > 0 ) {
			$parse['silo'] = "44";
		} else {
			$parse['silo'] = "free";
		}
		
		if ($planetrow['small_protection_shield'] > 0 ) {
			$parse['muralla'] = "muralla";
		} else {
			$parse['muralla'] = "free";
		}
		
		if ($planetrow['big_protection_shield'] > 0 ) {
			$parse['muralla2'] = "muralla2";
		} else {
			$parse['muralla2'] = "free";
		}    
	}
	
	protected function requestModifications(){}
	public function installSQL(){}
	public function uninstallSQL(){}
	
}
return new Planeta2D($plugin_id);

?>