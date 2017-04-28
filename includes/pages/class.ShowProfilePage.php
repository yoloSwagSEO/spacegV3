<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowProfilePage
{

	public function __construct ($CurrentUser){
            global $lang, $resource, $reslist, $_GET;
            if(isset($_GET['userId'])){
            	$info = doquery('SELECT id,username,ally_name,galaxy,system,planet,ally_id 
            			         FROM {{table}} WHERE id='.$_GET['userId'], 'users',true);
            	$parse = array();
				$parse['profilName'] = $info['username'];
            	$parse['img'] = file_exists ('styles/images/emblem/'.$info['id'].'.png')?'<img src="styles/images/emblem/'.$info['id'].'.png" />':'<img src="styles/images/emblem/none.png" />'; 
            	$parse['pseudo'] = $info['username'];
				$parse['sexe'] = 'Homme';
            	$parse['race'] = 'Humain';
            	$parse['alliance'] = $info['ally_name'];
            	$parse['g'] = $info['galaxy'];
            	$parse['s'] = $info['system'];
            	$parse['p'] = $info['planet'];
            	$parse['allyId'] = $info['ally_id'];
            	$parse['home'] = $info['galaxy'].':'.$info['system'].':'.$info['planet'];
				$parse['edit'] = "";
            	display(parsetemplate(gettemplate('profil/profil_body'), $parse));
            }else{
            	$parse = array();
				$parse['profilName'] = "Mon profil";
				$parse['img'] = file_exists ('styles/images/emblem/'.$CurrentUser['id'].'.png')?'<img src="styles/images/emblem/'.$CurrentUser['id'].'.png" />':'<img src="styles/images/emblem/none.png" />'; 
            	$parse['pseudo'] = $CurrentUser['username'];
            	$parse['sexe'] = 'Homme';
            	$parse['race'] = 'Humain';
            	$parse['alliance'] = $CurrentUser['ally_name'];
            	$parse['g'] = $CurrentUser['galaxy'];
            	$parse['s'] = $CurrentUser['system'];
            	$parse['p'] = $CurrentUser['planet'];
            	$parse['allyId'] = $CurrentUser['ally_id'];
            	$parse['home'] = $CurrentUser['galaxy'].':'.$CurrentUser['system'].':'.$CurrentUser['planet'];
			    $parse['edit'] = '<div id="edit"><a href="modules/flag/" class="iframeShow">editer</a></div>';
            	display(parsetemplate(gettemplate('profil/profil_body'), $parse));
            }
	}
}
?>