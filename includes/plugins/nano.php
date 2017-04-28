<?php

if(!defined('INSIDE')){ die(header("location:../../"));}
 
#@author: LordPretender for xgproyect.fr
#@name: Université
#@source : http://www.xgproyect.fr/Thread-tuto-universit%C3%A9.html

class Universite extends Plugin
{
	public function __construct($plugin_id)
	{
		$this->plugin_name = "Université";
		$this->plugin_desc = "Ajout d'une nouvelle technologie qui réduit le temps de recherches.";
		
		parent::__construct($plugin_id);
	}
	
	protected function load()
	{
		global $resource, $requeriments, $pricelist, $reslist, $lang;
		
		//On déclare une nouvelle ressource de type bâtiment
		$resource[35] = "nano";
		$reslist['build'][] = 35;
		
		//Conditions d'accès...
		$requeriments[35] = array(  31 =>  25, 108 =>  26, 113 => 28, 604 =>   1);
		
		//Prix...
		$pricelist[35] = array ( 'metal' =>7500000, 'crystal' => 40000000, 'deuterium' => 11000000, 'energy' => 0, 'factor' => 2);
		
		//Traductions
		$this->addLangTech(35, 'Universit&eacute;');
		$this->addLangDescription(35, 'L\'Universit&eacute; sert &agrave; r&eacute;duire de moiti&eacute; le temps de recherche des technologies, ils co&ucirc;tent excessivement ch&egrave;re mais vu son effet il a de quoi.');
		$this->addLangInfo(35, 'Universit&eacute;', 'L`Universit&eacute; sert &agrave; r&eacute;duire de le temps de recherche des technologies.');
	}
	
	protected function requestModifications()
	{
		$this->requestAddAfter('
			$time         = (($cost_metal + $cost_crystal) / read_config ( \'game_speed\' )) / (($lablevel + 1) * 2);', '
			$time         = (($cost_metal + $cost_crystal) / read_config ( \'game_speed\' )) / (($lablevel + 1) * 2) * pow(0.4, $planet[$resource[\'35\']]);', 'includes/functions/GetBuildingTime.php');
	}
	
	public function installSQL()
	{
		//Ajout d'une colonne supplémentaire pour la nouvelle technologie.
		doquery("ALTER TABLE {{table}} ADD `nano` int(11) NOT NULL DEFAULT '0' AFTER `ally_deposit`", "planets");		
	}
	
	public function uninstallSQL()
	{
		//Suppression de la colonne nano
		doquery("ALTER TABLE {{table}} DROP `nano`", "planets");
		
	}
}
return new Universite($plugin_id);

?>