<?php

/**
 * @project XG Proyect
 * @version 0.0.1
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class PluginsManager
{
	protected static $_instance;
	protected static $plugins = array();
	
	/**
	* This is just a test in order to know if user is on the plugin management page.
	* 
	* @return boolean
	*/
	public static function isAdminPage()
	{
		$file = pathinfo($_SERVER['PHP_SELF']);

		if (version_compare(PHP_VERSION, '5.2.0', '<'))
		{
			$file['filename'] = substr($file['basename'], 0, strlen($file['basename']) - strlen($file['extension']) - 1);
		}

		if (basename(XGP_ROOT) != '.')
		{
			$phpself = basename($file['dirname']).'/'.$file['filename'];
		}
		else
		{
			$phpself = $file['filename'];
		}
		
		return ($phpself == 'adm/SettingsPage') && $_GET['modo'] == 'plugins';
	}
	
	/**
	* This method is used to know if a plugin is currently active or not.
	* 
	* @param string $name
	* 
	* @return boolean
	*/
	public static function isPluginActive($name)
	{
		$SELECT = doquery("SELECT 1 FROM {{table}} WHERE `plugin` = '" . $name . "' AND `status` = 1 LIMIT 1;", "plugins");
		
		return mysqli_num_rows($SELECT) > 0;
	}
	
	/**
	* This method is used to know if a method name exists in an object Class.
	* 
	* @param string $FileName File name
	* @param string $method Method name
	* 
	* @return boolean
	*/
	private static function isMethodExists($FileName, $method)
	{
		$retour = FALSE;
		
		if(array_key_exists($FileName, self::$plugins) && method_exists(self::$plugins[$FileName], $method))
		{
			
			$retour = TRUE;
			
		}
		
		return $retour;
	}
	
	/**
	* This method is used to change a plugin status to active one.
	* 
	* @param string $name
	*/
	private static function setPluginActive($name)
	{
		//This is just a SELECT in order to know if the plugin exists in db or not.
		$SELECT = doquery("SELECT 1 FROM {{table}} WHERE `plugin` = '" . $name . "' LIMIT 1;", "plugins");
		
		//Si le plugin existe déjà en base, on UPDATE. Sinon, on INSERT.
		if(mysqli_num_rows($SELECT) > 0)
		{
			doquery("UPDATE {{table}} SET `status` = 1 WHERE `plugin`='". $name ."'", "plugins");
		}else{
			doquery("INSERT INTO {{table}} (`plugin`, `status`) VALUES ('$name', 1)", "plugins");
		}
	}
	
	/**
	* Generate HTML code which lists all declared plugins.
	* 
	* @return string
	*/
	private static function getHTMLPlugins()
	{
		global $lang;
		$config_line = "";
		
		foreach(self::$plugins as $file_name => $instance)
		{
			$title			= $instance->plugin_name;
			$description	= htmlentities($instance->plugin_desc, ENT_QUOTES);
			
			if($title != "")
			{
				$config_line	.= '
					<tr>
						<td class="b" style=\"color:#FFFFFF\"><a href="#" onMouseOver=\'return overlib("' . $description . '", CENTER, OFFSETX, 120, OFFSETY, -40, WIDTH, 250);\' onMouseOut=\'return nd();\'>' . $title . '</a></td>
						
						<td class="b" width="100px"><a href="SettingsPage.php?modo=plugins&plugin=' . $file_name . '&mode=s_install">' . $lang['plg_install'] . '</a></td>
						<td class="b" width="100px"><a href="SettingsPage.php?modo=plugins&plugin=' . $file_name . '&mode=s_uninstall">' . $lang['plg_uninstall'] . '</a></td>
				';
				
			    if(self::isPluginActive($file_name))
			    { //if the plugin is on
			    	$config_line .= '
						<td class="b" width="100px"><a href="SettingsPage.php?modo=plugins&plugin=' . $file_name . '&mode=desactivate" style="color:green">' . $lang['plg_active'] . '</a></td>
					';
			    }
				else
				{ //if the plugin is off
			    	$config_line .= '
						<td class="b" width="100px"><a href="SettingsPage.php?modo=plugins&plugin=' . $file_name . '&mode=activate" style="color:red">' . $lang['plg_inactive'] . '</a></td>
					';
			    }
				
			    $config_line .= "</tr>";
			}
		}
		
		return $config_line;
	}
	
	/**
	* Generate an HTML code in order to display a message.
	* 
	* @param string $string content of the message to display
	* @param string $color color to use.
	* 
	* @return string
	*/
	private static function getHTMLMessage($string, $color = "lime")
	{
		return '
		<style>
			table.lic{background:url(../styles/images/Adm/blank.gif);border:2px ' . $color . ' solid;}
			th.lic{border:0px;}
		</style>
		
		<table width="90%" class="lic">
		<tbody><tr>
		    <th class="lic">' . $string . '</th>
		</tr>
		</tbody></table>
		';
	}
	
	/**
	* Méthode qui crée l'unique instance de la classe
	* si elle n'existe pas encore puis la retourne.
	*
	* @param void
	* @return Singleton
	*/
	public static function getInstance()
	{
		if(!isset(self::$instance))
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}
	
	/**
	* Used to read the content of the plugin folder in order to make includes.
	*/
	private static function loadIncludes()
	{
		$plugins_path 		= XGP_ROOT . 'includes/plugins/';
		
		// open all files inside plugins folder

		$dir = opendir($plugins_path);

		while (($file = readdir($dir)) !== FALSE)
		{
			// we check if the file is a include file
			$extension = '.' . substr($file, -3);
			
			// and include once the file
			if ($extension == '.php')
			{
				//L'identifiant du plugin correspond au nom du fichier PHP.
				$plugin_id	= str_replace(".php", "", $file);
				
				//On effectue l'inclusion du plugin
				$instance	= include $plugins_path . $file;
				
				//Si nous sommes dans une page du plugin, on récupère le callback et on appelle la méthode.
				$callback = $instance->getPageCallback();
				if($callback != "")$instance->$callback();
				
				//On mémorise l'instance
				self::$plugins[$plugin_id] = $instance;
			}
		}

		closedir($dir);
	}
	
	/**
	* If the method passed by parameter exists, it will be called.
	* 
	* @param string $FileName Filename where the class has been declared.
	* @param string $method Name of the static method to call.
	* 
	* @return boolean
	*/
	private static function loadMethod($FileName, $method)
	{
		//On commence par tester l'existence de la méthode à appeler
		$retour = self::isMethodExists($FileName, $method);
		
		//On appelle la méthode...
		if($retour)self::$plugins[$FileName]->$method();
		
		return $retour;
	}
	
	public static function load()
	{
		global $lang;
		self::getInstance();
		
		self::loadIncludes();
		
		/**
		*Plugins admin panel
		*This is a little plugin integrated in the system
		*for control the others plugins.
		*@author adri93
		*/
		if ( defined('IN_ADMIN') )
		{
			//Ajout du lien vers la page de gestion des plugins
			$lang['mu_settings'] 	.= '</a></th></tr><tr><th ".$onMouseOverIE." class="ForIE"><a href="SettingsPage.php?modo=plugins" target="Hauptframe">Config. plugins';
			
			if ( ! defined ( 'DPATH' ) ) 
			{
				define ( 'DPATH' , "../" . DEFAULT_SKINPATH );
			}
			
			$page					= isset ( $_GET['modo'] ) ? $_GET['modo'] : NULL;
			$info					= '';
			
			if(self::isAdminPage())
			{
				//Si ces deux paramètres sont renseinés, c'est que l'admin souhate effectuer une opération sur un plugin.
				if(isset($_GET['plugin']) && isset($_GET['mode']))
				{
					//Nom du plugin concerné
					$plugin = $_GET['plugin'];
					$title	= self::$plugins[$plugin]->plugin_name;
					
					switch($_GET['mode'])
					{
						case 's_install':
							if(self::loadMethod($plugin, 'installSQL'))
							{
								$info = self::getHTMLMessage($lang['plg_msg_db_installed']);
							} else {
								$info = self::getHTMLMessage($lang['plg_msg_db_installed_nok'], "red");
							}

							break;
							
						case 's_uninstall':
							if(self::loadMethod($plugin, 'uninstallSQL'))
							{
								$info = self::getHTMLMessage($lan['plg_msg_db_uninstalled_ok']);
							} else {
								$info = self::getHTMLMessage($lang['plg_msg_db_uninstalled_nok'], "red");
							}

							break;
							
						case 'activate':
							if(self::loadMethod($plugin, 'onActivation'))
							{
								self::setPluginActive($plugin);
								
								$info = self::getHTMLMessage(sprintf($lang['plg_msg_activated_ok'], $title));
							} else {
								$info = self::getHTMLMessage(sprintf($lang['plg_msg_activated_nok'], $title), "red");
							}

							break;
							
						case 'desactivate':
							if(self::loadMethod($plugin, 'onDesactivation'))
							{
								//Désactivation du plugin
								doquery("UPDATE {{table}} SET `status` = 0 WHERE `plugin`='$plugin'", "plugins");
								
								$info = self::getHTMLMessage(sprintf($lang['plg_msg_desactivated_ok'], $title));
							} else {
								$info = self::getHTMLMessage(sprintf($lang['plg_msg_desactivated_nok'], $title), "red");
							}

							break;
						
						default:
							$info = self::getHTMLMessage("This mode ({$_GET['mode']}) name does not exists.", "red");
					}
					
				}
		
				$settingsplug	='       <br><br>';
				$settingsplug 	.= $info;
				$settingsplug 	.=' <br>
					<table width="70%">
						<tr>
							<td class="c" colspan="4">' . $lang['plg_title'] . '</td>
						</tr>
						<tr>
							<td class="c">' . $lang['plg_name'] . '</td>
							<td class="c" colspan="2">' . $lang['plg_db'] . '</td>
							<td class="c">' . $lang['plg_status'] . '</td>
						</tr>
				';
				$settingsplug 	.= self::getHTMLPlugins();
				$settingsplug 	.=' </table>';

				display ( $settingsplug , FALSE , '' , TRUE , FALSE );
			}
		}
	}
	
	protected function __construct() { }
	protected function __clone() { }
}

?>