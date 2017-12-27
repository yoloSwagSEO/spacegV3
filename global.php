<?php
require ( XGP_ROOT . 'vendor/autoload.php' );

global $debugbar;

//print_r($debugbarRenderer->render());
// SETEADO PARA EVITAR ERRORRES EN VERSION DE PHP MAYORES A 5.3.0
//error_reporting ( E_ALL & ~E_NOTICE );
ini_set('display_errors',1);
error_reporting(E_ALL); 
session_start();

$user          	= array();
$lang          	= array();
$link          	= "";
$IsUserChecked 	= FALSE;

include_once ( XGP_ROOT . 'includes/constants.php' );
include_once ( XGP_ROOT . 'includes/classes/class.Hook.php');

include_once ( XGP_ROOT . 'includes/GeneralFunctions.php' );
include_once ( XGP_ROOT . 'includes/classes/class.simple_html_dom.php' );
include_once ( XGP_ROOT . 'includes/classes/class.debug.php' );
include_once ( XGP_ROOT . 'includes/classes/class.xml.php' );
include_once ( XGP_ROOT . 'includes/classes/class.Format.php' );
include_once ( XGP_ROOT . 'includes/classes/class.NoobsProtection.php' );
include_once ( XGP_ROOT . 'includes/classes/class.Production.php' );
include_once ( XGP_ROOT . 'includes/classes/class.Fleets.php' );
include_once ( XGP_ROOT . 'includes/classes/class.Plugin.php' );
include_once ( XGP_ROOT . 'includes/classes/class.PluginsManager.php' );

//

$debug 		= new debug();
function ___d($debug){
	echo '<pre>';
	print_r($debug);
	echo '</pre>';
	die();
}
function _d($debug){
    echo '<pre>';
    print_r($debug);
    echo '</pre>';
}
if ( filesize ( XGP_ROOT . 'config.php' ) === 0 && ( ( !defined ( 'INSTALL' ) ) OR ( !INSTALL ) ) )
{
	exit ( header ( 'location:' . XGP_ROOT .  'install/' ) );
}

if ( filesize ( XGP_ROOT . 'config.php' ) != 0 )
{
	$game_version	=	read_config ( 'version' );

	define ( 'VERSION' , ( $game_version == '' ) ? "		  " : "v" . $game_version );
}

//Lecture de la langue configurée.
$game_lang	=	read_config ( 'lang' );
define ( 'DEFAULT_LANG'	, (	$game_lang  == '' ) ? "english" : $game_lang );

//Chargement des traductions communes.
includeLang ( 'COMMON' );

if ( INSTALL != TRUE )
{
         
	include ( XGP_ROOT . 'includes/vars.php' );
	include ( XGP_ROOT . 'includes/functions/CreateOneMoonRecord.php' );
	include ( XGP_ROOT . 'includes/functions/CreateOnePlanetRecord.php' );
	include ( XGP_ROOT . 'includes/functions/CreateOneSecteurRecord.php' );
	include ( XGP_ROOT . 'includes/functions/SendSimpleMessage.php' );
	include ( XGP_ROOT . 'includes/functions/calculateAttack.php' );
	include ( XGP_ROOT . 'includes/functions/formatCR.php' );
	include ( XGP_ROOT . 'includes/functions/GetBuildingTime.php' );
	include ( XGP_ROOT . 'includes/functions/HandleElementBuildingQueue.php' );
	include ( XGP_ROOT . 'includes/functions/HandleElementCasernQueue.php' );
	include ( XGP_ROOT . 'includes/functions/PlanetResourceUpdate.php' );

	includeLang ( 'INGAME' );

	if ( !isset ( $InLogin ) or $InLogin != TRUE )
	{
		include ( XGP_ROOT . 'includes/classes/class.CheckSession.php' );

		$Result        	= new CheckSession();
		$Result			= $Result->CheckUser ( $IsUserChecked );
		$IsUserChecked 	= $Result['state'];
		$user          	= $Result['record'];
		require ( XGP_ROOT . 'includes/classes/class.SecurePage.php' );
		SecurePage::run();

		if ( read_config ( 'game_disable' ) == 0 && $user['authlevel'] == 0 )
		{
			message ( stripslashes ( read_config ( 'close_reason' ) ) , '' , '' , FALSE , FALSE );
		}
	}

	//if ( ( time() >= ( read_config ( 'stat_last_update' ) + ( 60 * read_config ( 'stat_update_time' ) ) ) ) )
	//{
	//	include	( XGP_ROOT . 'adm/statfunctions.php' );
	//	$result	= MakeStats();
	//	update_config ( 'stat_last_update' , $result['stats_time'] );
	//}

	if ( !empty ( $user ) )
	{
		include ( XGP_ROOT . 'includes/classes/class.FlyingFleetHandler.php' );
		$_fleets = doquery ( "SELECT fleet_start_galaxy,fleet_start_system,fleet_start_planet,fleet_start_type FROM {{table}} WHERE `fleet_start_time` <= '" . time() . "' and `fleet_mess` ='0' order by fleet_id asc;" , 'fleets' ); // OR fleet_end_time <= ".time()

		while ( $row = mysqli_fetch_array ( $_fleets ) )
		{
			$array 					= array();
			$array['galaxy'] 		= $row['fleet_start_galaxy'];
			$array['system'] 		= $row['fleet_start_system'];
			$array['planet'] 		= $row['fleet_start_planet'];
			$array['planet_type'] 	= $row['fleet_start_type'];

			$temp = new FlyingFleetHandler ( $array );
		}

		mysqli_free_result ( $_fleets );

		$_fleets = doquery ( "SELECT fleet_end_galaxy,fleet_end_system,fleet_end_planet ,fleet_end_type FROM {{table}} WHERE `fleet_end_time` <= '" . time() . " order by fleet_id asc';" , 'fleets' ); // OR fleet_end_time <= ".time()

		while ( $row = mysqli_fetch_array ($_fleets ) )
		{
			$array 					= array();
			$array['galaxy'] 		= $row['fleet_end_galaxy'];
			$array['system'] 		= $row['fleet_end_system'];
			$array['planet'] 		= $row['fleet_end_planet'];
			$array['planet_type'] 	= $row['fleet_end_type'];

			$temp = new FlyingFleetHandler ( $array );
		}

		mysqli_free_result ( $_fleets);
		unset ( $_fleets );

		if ( defined ( 'IN_ADMIN' ) )
		{
			includeLang ( 'ADMIN' );
			include ( '../adm/AdminFunctions/Autorization.php' );

			define('DPATH' , "../". DEFAULT_SKINPATH );
		}
		else
		{
			define('DPATH' , ( ( !$user["dpath"] ) ? DEFAULT_SKINPATH : SKIN_PATH . $user["dpath"] . '/' ) );
		}
            
		include ( XGP_ROOT . 'includes/functions/SetSelectedPlanet.php' );
		SetSelectedPlanet ( $user );

		$planetrow = doquery ( "SELECT *, (SELECT COUNT(`id`) AS count FROM `{{table}}users` ) AS total_users
									FROM `{{table}}planets`
									WHERE `id` = '" . $user['current_planet'] . "';" , '' , TRUE );
               
		$_SESSION['userid'] = $user['id'];  
		// Include the plugin system 0.3
		include_once( XGP_ROOT . 'includes/action.php');
		PluginsManager::load();
                

	}
}
else
{
	define('DPATH' , "../". DEFAULT_SKINPATH );
}

?>
