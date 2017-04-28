<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowUniversityPage
{

	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
		
		$parse= "";
		$this->showChoiseRecrut($CurrentPlanet, $CurrentUser);
		//display(parsetemplate(gettemplate('university/university_body'), $parse));
	}
	public function showChoiseRecrut(&$CurrentPlanet, $CurrentUser){
		//Le nombre de compétence pas dépendre du level
		global $nameList;
		
		$namePosible['homme'] = explode(' ',$nameList['first']['h']['human']);
		$namePosible['femme'] = explode(' ',$nameList['first']['f']['human']);
		//print_r($namePosible);
		$namePosibleLast = explode(' ',$nameList['last']['human']);
		//print_r($nameList['first']['human']);
		$type = $_GET['type'];
		$nbChoise = 3;
		$pourcentLevel = array(0=>80,1=>13,2=>5,3=>1,4=>1);
		
		$arrayPourcent = array();
		//On crée un tableau contenan toutes les possibilité
		for($i=0,$j=count($pourcentLevel);$i<$j;$i++){
			for($ii=0,$jj=$pourcentLevel[$i];$ii<$jj;$ii++){
				$arrayPourcent[] = $i;
			}
		}
		
		for($i=0;$i<$nbChoise;$i++){
			$randSexe = mt_rand(1,2);
			
			if($randSexe == 1){
				$sexe = 'homme';
			}else{
			    $sexe = 'femme';	
			}
			
			//print_r($namePosible[$sexe]);
            //echo 'je vais recruter un level :'.$arrayPourcent[mt_rand ( 0 , count($arrayPourcent)-1 )].' '.$namePosible[array_rand($namePosible)].' '.$namePosibleLast[array_rand($namePosibleLast)].'<br />';    			
		    $listC['name'] = $namePosible[$sexe][array_rand($namePosible[$sexe])].' '.$namePosibleLast[array_rand($namePosibleLast)];
			$listC['lvl'] = $arrayPourcent[mt_rand ( 0 , count($arrayPourcent)-1 )];
			$parse['choiseList'] .= parsetemplate(gettemplate('university/recrutList'), $listC) ;  
		}
		display2(parsetemplate(gettemplate('university/showChoiseRecrut'), $parse));
	}
	
	
	
}
?>