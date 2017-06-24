<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowUniversityPage
{

	public $tirage = array();
	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
		
		$parse= "";
		if($this->hasTirage($CurrentPlanet)){

			$this->showExistingRecrut($this->tirage);
		}else{
			$this->showChoiseRecrut($CurrentPlanet, $CurrentUser);
		}

		//display(parsetemplate(gettemplate('university/university_body'), $parse));
	}
	public function showChoiseRecrut(&$CurrentPlanet, $CurrentUser){
		//Le nombre de compétence pas dépendre du level
		global $nameList;

		$parse = array('choiseList'=>'');
		$save = array();
		$namePosible['homme'] = explode(' ',$nameList['first']['h']['human']);
		$namePosible['femme'] = explode(' ',$nameList['first']['f']['human']);

		$namePosibleLast = explode(' ',$nameList['last']['human']);

		//TODO Type du personel, gouverneur, science, amiral...
		//$type = $_GET['type'];


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
			$listC['lvl'] = ($arrayPourcent[mt_rand ( 0 , count($arrayPourcent)-1 )]+1);

			$save[$i]['name'] = $listC['name'];
			$save[$i]['lvl'] = $listC['lvl'];
			$save[$i]['sexe'] = $sexe;

			$parse['choiseList'] .= parsetemplate(gettemplate('university/recrutList'), $listC) ;
		}
		$save = addslashes (serialize($save));
		$time = time() + (24*60*60);

		doquery('INSERT INTO {{table}} (`array_tirage`,`idPlanet`,`validite`) VALUE ("'.$save.'", '.$CurrentPlanet['id'].','.$time.')','recrutment');
		display(parsetemplate(gettemplate('university/showChoiseRecrut'), $parse));
	}

	public function showExistingRecrut($tirage){

		$tirage = $tirage[0];
		$listC = array();
		$parse = array('choiseList'=>'');
		for($i=0,$j=count($tirage);$i<$j;$i++){
			$listC['name'] = $tirage[$i]['name'];
			$listC['lvl'] = $tirage[$i]['lvl'];
			$parse['choiseList'] .= parsetemplate(gettemplate('university/recrutList'), $listC) ;
		}
		display(parsetemplate(gettemplate('university/showChoiseRecrut'), $parse));
	}
	//vrai si j'ai deja un tirage valide
	//Faux si je n'ais pas de tirage
	public function hasTirage(&$CurrentPlanet){
		$hasTirage = doquery('SELECT * FROM {{table}} WHERE idPlanet = '.$CurrentPlanet['id'].' AND validite > '.time(),'recrutment');
		if($hasTirage->num_rows > 0){
			$retunData = array();

			while($data = mysqli_fetch_array($hasTirage)){
				//echo $data['array_tirage'];
				$returnData[] = unserialize(stripslashes($data['array_tirage']));
			}
			$this->tirage = $returnData;
			return true;
		}else{
			$this->sanatizeTirage($CurrentPlanet['id']); //on netoie les tirages au cas ou...
			return false;
		}
	}

	public function sanatizeTirage($idColonie){
		doquery('DELETE FROM {{table}} WHERE idPlanet = '.$idColonie,'recrutment');
	}
}
?>