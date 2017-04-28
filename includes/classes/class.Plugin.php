<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

abstract class Plugin
{
	protected $myLinks;
	protected $modifications = array();
	
	protected $plugin_id;
	public $plugin_name;
	public $plugin_desc;
		
	/**
	* For information plugin classes or not instanciated in the Plugin page (admin).
	* 
	* @param string $plugin_id Name of the plugin
	*/
	public function __construct($plugin_id)
	{
		$this->myLinks = array();
		$this->plugin_id = $plugin_id;
		
		if(PluginsManager::isPluginActive($plugin_id))
		{
			$this->load();
			
			//Links injection.
			if(count($this->myLinks) > 0)$this->injectLinks();
		}
	}
	
	/**
	* This method MUST exists in order to load the plugin.
	* Please do not create the constructor or do not forget to call, in the end, the parent constructor.
	*/
	abstract protected function load();
	
	/**
	* Add in $lang only if the translation to add does not yet exists.
	* Usefull in order to let developpers to add their own translation directly on the INGAME.php file.
	* 
	* @param string $key
	* @param string $value
	*/
	public function addLang( $key, $value, $override = FALSE )
	{
		global $lang;
		
		if(!array_key_exists($key, $lang) || $override)$lang[$key] = $value;
	}
	
	/**
	* Add in $lang['tech'] only if the ID to add does not yet exists.
	* Usefull in order to let developpers to add their own translation directly on the INGAME.php file.
	* 
	* @param int $ID
	* @param string $libelle
	*/
	public function addLangTech($ID, $libelle)
	{
		global $lang;
		
		if(!array_key_exists($ID, $lang['tech']))
		{
			$lang['tech'][$ID] = $libelle;
			ksort($lang['tech']);
		}
	}
	
	/**
	* Add in $lang['res']['descriptions'] only if the ID to add does not yet exists.
	* Usefull in order to let developpers to add their own translation directly on the INGAME.php file.
	* 
	* @param int $ID
	* @param string $libelle
	*/
	public function addLangDescription($ID, $libelle)
	{
		global $lang;
		
		if(!array_key_exists($ID, $lang['res']['descriptions']))
			$lang['res']['descriptions'][$ID] = $libelle;
	}
	
	/**
	* Add in $lang['info'] only if the ID to add does not yet exists.
	* Usefull in order to let developpers to add their own translation directly on the INGAME.php file.
	* 
	* @param int $ID
	* @param string $libelle
	*/
	public function addLangInfo($ID, $name, $description)
	{
		global $lang;
		
		if(!array_key_exists($ID, $lang['info']))
		{
			$lang['info'][$ID]['name']			= $name;
			$lang['info'][$ID]['description']	= $description;
		}
	}
	
	/**
	* Add a new link into the game menu.
	* 
	* @param string $after Link will be added below this page name.
	* @param string $pagename Page name of the new link.
	* @param string $langname Name of the link which will be displayed.
	*/
	public function addMenuLink($after, $pagename, $langname, $callback)
	{
		$this->myLinks[$pagename] = array($after, $langname, $callback);
	}
	
	/**
	* hack Lang vars in order to add new links in the game menu.
	*/
	private function injectLinks()
	{
        global $lang;
		
		foreach($this->myLinks as $pagename => $tableau)
		{
			$after = $tableau[0];
			$langname = $tableau[1];
			
	        $add = $lang['lm_'.$after] . "</a>
    </font></div>
  </td>
 </tr>


 <tr>
  <td>

   <div align=\"center\"><font color=\"#FFFFFF\">
     <a href='game.php?page=$pagename'>$langname";
	        
			$this->addLang("lm_$after", $add, TRUE);
		}
    }
    
    public function onPage ($pname) 
    {
            
        if($pname == $_GET['page'])
            return true;
        else
            return false;
    }
	
	public function getPageCallback()
	{
		$callback = "";
		
		foreach($this->myLinks as $pagename => $tableau)
		{
			if($this->onPage($pagename))
			{
				$callback = $tableau[2];
				break;
			}
		}
		
		return $callback;
	}
	
	public function getPageTemplate($file)
	{
		return @file_get_contents ( XGP_ROOT . "includes/plugins/" . $this->plugin_id . "/views/$file.php" );
	}
	
	/**
	* Method called by PluginManager in order to modify files if needed.
	*/
	public function onActivation(){
		//On récupère toutes les modifications de fichier à effectuer.
		$this->requestModifications();
		
		$this->requestApply();
	}
	
	/**
	* Method called by PluginManager in order to unmodify files if needed.
	*/
	public function onDesactivation(){
		//On récupère toutes les modifications de fichier à effectuer.
		$this->requestModifications();
		
		$this->requestApply(TRUE);
	}
	
	/**
	* To use in order to declare a file modification replacement.
	* 
	* @param string $search 	String to replace
	* @param string $replace	String replacement
	* @param string $file		File to modify
	*/
	protected function requestReplace($search, $replace, $file)
	{
		$this->modifications[] = array(1, $search, $replace, $file);
	}
	
	/**
	* To use in order to add lines (after) in a specific file.
	* 
	* @param string $search 	String to find
	* @param string $replace	String to add after.
	* @param string $file		File to modify
	*/
	protected function requestAddAfter($search, $replace, $file)
	{
		$this->modifications[] = array(2, $search, $replace, $file);
	}
	
	/**
	* To use in order to add lines (before) in a specific file.
	* 
	* @param string $search 	String to find
	* @param string $replace	String to add after.
	* @param string $file		File to modify
	*/	
	protected function requestAddBefore($search, $replace, $file)
	{
		$this->modifications[] = array(3, $search, $replace, $file);
	}
	
	/**
	* After having defined the file modifications. This method is called in order to apply modification (or to revert).
	* 
	* @param boolean $revert Do you need to apply or revert modifications ?
	*/
	private function requestApply($revert = FALSE)
	{
		$fichiers = array();
		
		//On commence par ouvrir les fichiers, récupérer le contenu et modifier.
		foreach($this->modifications as $modification)
		{
			$type 		= $modification[0];
			$search 	= $modification[1];
			$replace	= $modification[2];
			$file 		= XGP_ROOT . $modification[3];
			
			//En fonction du type de modification, on va modifier la variable de remplacement.
			switch($type)
			{
				case 1 : //Contenu remplacé... On ne fait rien car la variable de remplacement est comme il faut.
					break;
					
				case 2 : //Ajouter après
					$replace = "$search\n$replace\n";
					break;
					
				case 3 : //Ajouter avant
					$replace = "$replace\n$search\n";
					break;					
			}
			
			//Si on a demandé à annuler les modifications, il faut intervertir le contenu des deux variables.
			if($revert)
			{
				$search 	= $replace;
				$replace	= $modification[1];
			}
			
			//Si le fichier a déjà été ouvert, on récupère son contenu. Sinon, on va aller lire le contenu.
			if(array_key_exists($file, $fichiers))
			{
				$contenu = $fichiers[$file];
			} elseif(file_exists($file)) {
				$contenu = file_get_contents($file);
			} else $contenu = "";
			
			//On effectue les modifications (qu'on mémorise)
			$fichiers[$file] = str_replace($search, $replace, $contenu);
		}
		
		//Dernière étape : l'enregistrement des fichiers modifiés
		foreach($fichiers as $chemin => $script)
		{
			file_put_contents($chemin, $script);
		}
	}
	
	abstract protected function requestModifications();
	abstract protected function installSQL();
	abstract protected function uninstallSQL();
}

?>