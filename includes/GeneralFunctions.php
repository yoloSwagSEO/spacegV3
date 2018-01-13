<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

function unset_vars ( $prefix )
{
	$vars = array_keys ( $GLOBALS );

	for( $n = 0, $i = 0;  $i < count($vars);  $i ++ )
	{
		
		if ( strpos ( $vars[$i] , $prefix ) === 0 )
		{
			unset ( $GLOBALS[$vars[$i]] );

			$n ++;
		}
	}

	return  $n;
}

// READS CONFIGURATIONS
function read_config ( $config_name = '' , $all = FALSE )
{
	$configs		= xml::getInstance ( 'config.xml' );

	if ( $all )
	{
		return $configs->get_configs ();
	}
	else
	{
		return $configs->get_config ( $config_name );
	}

}

// WRITES CONFIGURATIONS
function update_config ( $config_name, $config_value )
{
	$configs		= xml::getInstance ( 'config.xml' );

	$configs->write_config ( $config_name , $config_value );
}

// DETERMINES IF THE PLAYER IS WEAK
function is_weak ( $current_points , $other_points )
{
    
    return NoobsProtection::getInstance()->is_weak ( $current_points , $other_points );
}

// DETERMINES IF THE PLAYER IS STRONG
function is_strong ( $current_points , $other_points )
{
	return NoobsProtection::getInstance()->is_strong( $current_points , $other_points );
}

// DETERMINES IF IS AN EMAIL
function valid_email ( $address )
{
	return ( !preg_match ( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix" , $address ) ) ? FALSE : TRUE;
}

function message ( $mes , $dest = "" , $time = "3" , $topnav = FALSE , $menu = TRUE )
{
	$parse['mes']   = $mes;

	$page 			= parsetemplate ( gettemplate ( 'general/message_body' ) , $parse );

	if ( !defined ( 'IN_ADMIN' ) )
	{
		display ( $page , $topnav , ( ( $dest != "" ) ? "<meta http-equiv=\"refresh\" content=\"$time;URL=$dest\">" : "") , FALSE , $menu );
	}
	else
	{
		display ( $page , $topnav , ( ( $dest != "" ) ? "<meta http-equiv=\"refresh\" content=\"$time;URL=$dest\">" : "") , TRUE , FALSE );
	}

}

function display ($page, $topnav = TRUE, $metatags = '', $AdminPage = FALSE, $menu = TRUE)
{
	global $link, $debug, $user, $planetrow, $CurrentUser;
	
	if (!$AdminPage)
		$DisplayPage  = StdUserHeader($metatags);
	else
		$DisplayPage  = AdminUserHeader($metatags);

		
		
		
	$pageToDisplay = $page;	
	$parse = array();
	
	if ($topnav)
	{
		include_once(XGP_ROOT . 'includes/functions/ShowTopNavigationBar.php');
		$DisplayPage .= ShowTopNavigationBar( $user, $planetrow );

		
		
		//$parse['planetlist'] 			= '<div id="coloHeader">Colonies</div>';
		$ThisUsersPlanets    			= SortUserPlanets ( $user );
		$gid							= isset ( $_GET['gid'] ) ? $_GET['gid'] : NULL;
		$page							= isset ( $_GET['page'] ) ? $_GET['page'] : NULL;
		$mode							= isset ( $_GET['mode'] ) ? $_GET['mode'] : NULL;
		$parse['planetlist'] = "";
		while ($CurPlanet = mysqli_fetch_array($ThisUsersPlanets))
		{
			if ($CurPlanet["destruyed"] == 0 && $CurPlanet['planet_type'] != 3)
			{
				$parse['planetlist'] .= '<div class="row">';
				$parse['planetlist'] .= '<div class="col-md-3 colPlanet">
                                             <img class="img-responsive" src="styles/skins/xgproyect/planeten/small/s_'.$CurPlanet['image'].'.jpg" />
                                         </div>';
				$parse['planetlist'] .= '<div class="col-md-9 colName">
                                             <div class="coloname">
                                                 <a href="game.php?page='.$page.'&gid='.$gid.'&cp='.$CurPlanet['id'].'&mode='.$mode.'&re=0">'.$CurPlanet['name'].'</a>
                                                <br />&nbsp;['.$CurPlanet['galaxy'].':'.$CurPlanet['system'].':'.$CurPlanet['planet'].']
                                             </div></div>';
				//$parse['planetlist'] .= '<div class="col-md-2"></div>';
				$parse['planetlist'] .= '</div>';
// </div>
// <div class=\"colo_action\">
// <a href=\"game.php?page=fleet&galaxy=".$CurPlanet['galaxy']."&system=".$CurPlanet['system']."&planet=".$CurPlanet['planet']."\"><img src=\"styles/images/target.png\" /></a>
// 											<a href=\"recolteAjax.php?galaxy=".$CurPlanet['galaxy']."&system=".$CurPlanet['system']."&planet=".$CurPlanet['planet']."\" class=\"recolte\"><img src=\"styles/images/recolte.png\" /></a></div>";
// 				$parse['planetlist'] .= "<div class=\"clear\"></div>";
// 				$parse['planetlist'] .= '</div>';
			}
		}
		
		//$parse['planetlist'] 			.= '<div id="SecteurHeader">Exploitations</div>';
		$ThisUsersSecteurs    			= SortUserSecteurs ( $user );

		$parse['sectors'] = "";
 		while ($CurSecteur = mysqli_fetch_array($ThisUsersSecteurs))
 		{
 			if ($CurSecteur["destruyed"] == 0)
 			{
				$parse['sectors'] .= '<div class="row">';
				$parse['sectors'] .= '<div class="col-md-3 colPlanet">
                                             <img class="img-responsive" src="styles/skins/xgproyect/planeten/small/s_'.$CurSecteur['image'].'.jpg" />
                                         </div>';
				$parse['sectors'] .= '<div class="col-md-9 colName">
                                             <div class="coloname">
                                                 <a href="game.php?page='.$page.'&gid='.$gid.'&cp='.$CurSecteur['id'].'&mode='.$mode.'&re=0">'.$CurSecteur['name'].'</a>
                                                <br />&nbsp;['.$CurSecteur['galaxy'].':'.$CurSecteur['system'].':'.$CurSecteur['planet'].']
                                             </div></div>';
				//$parse['sectors'] .= '<div class="col-md-2"></div>';
				$parse['sectors'] .= '</div>';
 			}
 		}
        
		$DisplayPage .= '<div class="col-md-3" id="newPlanetList" >
                             <div id="trie-button2">
                                 <button class="coloCh active">Colonies</button>
                                 <button class="sectorsCh">Secteurs</button>
                             </div>
                             <div class="menuColo scrollbar scroll-1">'.$parse['planetlist'].'</div>
                             <div class="menuSecteur scrollbar scroll-1" style="display:none;">'.$parse['sectors'].'</div>
                          </div>';
		$DisplayPage .=  '<div class="col-md-9">'.$pageToDisplay.'</div>';
	}else{
		$DisplayPage .= $page;	
	}
			
	//echo $DisplayPage;
		//include_once(XGP_ROOT . 'includes/functions/ShowLeftMenu.php');
		
	
	
	if(!defined('LOGIN') && isset($_GET['page']))
		$DisplayPage .= parsetemplate ( gettemplate ( 'general/footer' ) , $parse );

	if ( isset ( $user['authlevel'] ) && $user['authlevel'] == 3 && read_config ( 'debug' ) == 1 && !$AdminPage )
	{
		// Convertir a objeto dom
		//$DisplayPage = str_get_html($DisplayPage);

		// Modificar div#content
		//$content = $DisplayPage->find("div#content", 0);

		// Contenido debug
		//$content->innertext .= $debug->echo_log();
	}

	echo $DisplayPage;

	if ( isset ( $user['authlevel'] ) && $user['authlevel'] == 3 && read_config ( 'debug' ) == 1 && $AdminPage && !defined('NO_DEBUG') )
	{

		echo "<center>";
		echo $debug->echo_log();
		echo "</center>";
	}

	if ( $link )
	{
		mysqli_close ( $link );
	}

	//die();
}




if (!function_exists('mysql_result')) {
	function mysql_result($result, $number, $field=0) {
		mysqli_data_seek($result, $number);
		$row = mysqli_fetch_array($result);
		return $row[$field];
	}
}

function display2 ($page)
{
	global $link, $debug, $user, $planetrow, $CurrentUser;

		$DisplayPage  = StdInfoHeader();
	

	$DisplayPage .=  $page;



	echo $DisplayPage;
	if ( $link )
	{
		mysqli_close ( $link );
	}

	//die();
}



function StdUserHeader ($metatags = '',$bgStyle="")
{
	//global $debugbarRenderer;
	
	
	$parse['-title-']	= read_config ( 'game_name' );
	$parse['-favi-']	= "<link rel=\"shortcut icon\" href=\"./favicon.ico\">\n";
	$parse['-meta-']	= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">\n";
	$parse['class'] 	= $_GET['page']??'login';
	if(isset($_GET['mode'])){
		$parse['class'] = $_GET['page']." ".$_GET['page']."_".$_GET['mode'];
	}
	if(!defined('LOGIN'))
	{
		$parse['-style-']	= "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/css/default.css\">\n";
		$parse['-style-']  .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/css/formate.css\">\n";
		$parse['-style-']  .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"". DPATH ."formate.css\" />\n";
		$parse['-meta-']   .= "<script type=\"text/javascript\" src=\"js/overlib-min.js\"></script>\n";
	}
	else
	{
		$parse['-style-']	= "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/css/styles.css\">\n";
	}
    
	$parse['-meta-']	.= ($metatags) ? $metatags : "";
	
	

	return parsetemplate ( gettemplate ( 'general/simple_header' ) , $parse );
}
function StdInfoHeader ($metatags = '')
{
	$parse['-title-']	= read_config ( 'game_name' );
	$parse['-meta-']	= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">\n";

	if(!defined('LOGIN'))
	{
		$parse['-style-']	= "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/css/default.css\">\n";
		$parse['-style-']  .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/css/formate.css\">\n";
		$parse['-style-']  .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"". DPATH ."formate.css\" />\n";
		$parse['-meta-']   .= "<script type=\"text/javascript\" src=\"js/overlib-min.js\"></script>\n";
	}

	$parse['-meta-']	.= ($metatags) ? $metatags : "";

	return parsetemplate ( gettemplate ( 'general/info_header' ) , $parse );
}
function AdminUserHeader ($metatags = '')
{
	if (!defined('IN_ADMIN'))
	{
		$parse['-title-']	= "XG Proyect - Install";
	}
	else
	{
		$parse['-title-']	= read_config ( 'game_name' ) . " - Admin CP";
	}


	$parse['-favi-']	= 	"<link rel=\"shortcut icon\" href=\"./../favicon.ico\">\n";
	$parse['-style-']	=	"<link rel=\"stylesheet\" type=\"text/css\" href=\"./../styles/css/admin.css\">\n";
	$parse['-meta-']	= 	"<script type=\"text/javascript\" src=\"./../js/overlib-min.js\"></script>\n";
	$parse['-meta-']   .= ($metatags) ? $metatags : "";

	return parsetemplate ( gettemplate ( 'adm/simple_header' ) , $parse );
}

function CalculateMaxPlanetFields (&$planet)
{
	global $resource;
	$fild = $planet["field_max"] + ($planet[ $resource[33] ] * FIELDS_BY_TERRAFORMER) + ($planet[ $resource[10] ]*50);
        //echo $fild.'<br />';
        return $fild;
}

function GetGameSpeedFactor ()
{
	return read_config ( 'fleet_speed' ) / 2500;
}

function ShowBuildTime($time)
{
	global $lang;
	return "<br>". $lang['fgf_time'] . Format::pretty_time($time);
}

function parsetemplate ( $template , $array )
{
// 	return preg_replace ( '#\{([a-z0-9\-_]*?)\}#Ssie' ,
// 			              '( ( isset($array[\'\1\']) ) ? 
//                            $array[\'\1\'] : \'\' );' , $template );
	//Fix PHP7
	@$template = preg_replace_callback( '#\{([a-z0-9\-_]*?)\}#Ssi',
			function($match) use ($array){
				return (isset($array[$match[1]]))?$array[$match[1]]: '';
			},$template);
	return  $template;
}

function gettemplate ( $templatename )
{
	return @file_get_contents ( XGP_ROOT . TEMPLATE_DIR . '/' . $templatename . '.php' );
}

function includeLang ( $filename, $language = DEFAULT_LANG )
{
	global $lang;

	include ( XGP_ROOT . "language/" . $language ."/". $filename . '.php' );
}

function GetStartAdressLink ( $FleetRow, $FleetType )
{
	$Link  = "<a href=\"game.php?page=galaxy&mode=3&galaxy=".$FleetRow['fleet_start_galaxy']."&system=".$FleetRow['fleet_start_system']."\" ". $FleetType ." >";
	$Link .= "[".$FleetRow['fleet_start_galaxy'].":".$FleetRow['fleet_start_system'].":".$FleetRow['fleet_start_planet']."]</a>";
	return $Link;
}

function GetTargetAdressLink ( $FleetRow, $FleetType )
{
	$Link  = "<a href=\"game.php?page=galaxy&mode=3&galaxy=".$FleetRow['fleet_end_galaxy']."&system=".$FleetRow['fleet_end_system']."\" ". $FleetType ." >";
	$Link .= "[".$FleetRow['fleet_end_galaxy'].":".$FleetRow['fleet_end_system'].":".$FleetRow['fleet_end_planet']."]</a>";
	return $Link;
}

function BuildPlanetAdressLink ( $CurrentPlanet )
{
	$Link  = "<a href=\"game.php?page=galaxy&mode=3&galaxy=".$CurrentPlanet['galaxy']."&system=".$CurrentPlanet['system']."\">";
	$Link .= "[".$CurrentPlanet['galaxy'].":".$CurrentPlanet['system'].":".$CurrentPlanet['planet']."]</a>";
	return $Link;
}

function doquery ( $query , $table , $fetch = FALSE )
{
	global $link, $debug,$numqueries,$debug,$debugbar;

	
	//$debugbar["messages"]->addMessage("SQL");
	
	require ( XGP_ROOT . 'config.php' );

	$link = mysqli_connect($dbsettings["server"],$dbsettings["user"],$dbsettings["pass"],$dbsettings["name"]);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = str_replace ( "{{table}}" , $dbsettings["prefix"] . $table , $query );
	//$debugbar["messages"]->addMessage($sql);
	$retour = mysqli_query($link,$sql);
	$numqueries++;
	if (!$retour)
	{
		echo $sql.'<br />';
		echo("Error description: " . mysqli_error($link)); 
	}else{
		if ( $fetch )
		{
			return @mysqli_fetch_array($retour);
		}else{
			return $retour;
		}
	}
	
	mysqli_close($link);

}

function mysql_escape_value ( $inp ) 
{ 
	/* By feedr
	http://www.php.net/manual/en/function.mysql-real-escape-string.php#101248
	*/

	if ( is_array ( $inp ) )
	{
		return array_map ( __METHOD__ , $inp );	
	}  
	
	if ( ! empty ( $inp ) && is_string ( $inp ) ) 
	{ 
		return str_replace ( array ( '\\' , "\0" , "\n" , "\r" , "'" , '"' , "\x1a" ) , array ( '\\\\' , '\\0' , '\\n' , '\\r' , "\\'" , '\\"' , '\\Z' ) , $inp ); 
	} 
	
	return $inp; 
}


?>