<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowUniversityPage
{

	public $tirage = array();
	public function __construct (&$CurrentPlanet, $CurrentUser)
	{
		global $lang, $resource, $reslist, $_GET;
		
		$parse= "";

        if(!isset($_GET['mode']) || empty($_GET['mode'])){
            $this->dispoInColo($CurrentUser,$CurrentPlanet);
        }elseif($_GET['mode'] == 'recrut'){
            if($this->hasTirage($CurrentUser)){

            	$this->showExistingRecrut($this->tirage);
            }else{
            	$this->showChoiseRecrut($CurrentPlanet, $CurrentUser);
            }
        }elseif($_GET['mode'] == 'embauche'){
            $this->embaucheRecrut($CurrentPlanet, $CurrentUser, $_GET['id']);
        }
	}


	public function dispoInColo($CurrentPlanet,$CurrentUser){
        $sql = 'SELECT * FROM {{table}} WHERE idPlanet = '.$CurrentPlanet['id'];

        $recrut = doquery($sql,'perso');
        $parse = array();
        $parse['choiseList'] = "";
        if($recrut->num_rows > 0){
            $row = array();
            while ($data = mysqli_fetch_array($recrut)){

                $row['role'] = $data['type'];
                $row['name'] = $data['name'];
                $row['age'] = $data['age'];

                $row['lvl'] = "";
                for($ii=0;$ii<=$data['lvl'];$ii++){
                    $row['lvl'] .= '<i class="fa fa-star star-gold" aria-hidden="true"></i>';
                    $ii++;
                }
                $tempBonus = unserialize($data['serialized']);

                $row['bonus'] = '';
                foreach ($tempBonus as $bonus){

                    $row['bonus'] .= '<img src="styles/skins/xgproyect/img/bonus/'.$bonus.'.png" />';
                }

                $parse['choiseList'] .= parsetemplate(gettemplate('university/persoList'), $row) ;
            }
        }
        //_d($recrut);

        display(parsetemplate(gettemplate('university/university_body'), $parse));
    }

    public function embaucheRecrut($CurrentUser, $CurrentPlanet, $recrutId){

       // _d($CurrentUser);
        if($this->hasTirage($CurrentPlanet)){
            if($CurrentPlanet['id_owner'] == $CurrentUser['id']){
                _d($this->tirage);
                $tirage = $this->tirage[0];
                $tempRecrut = array();
                $tempGood = array();
                foreach($tirage as $recrut){
                    if($recrut['id'] == $recrutId){

                        _d($recrut);
                        $tempGood['name'] = $recrut['name'];
                        $sql = '
                            INSERT INTO {{table}}
                            (idPlanet,name,sexe,age,type,lvl,xp,serialized)
                            VALUES
                            ('.$CurrentPlanet['id'].',
                            "'.$recrut['name'].'",
                            "'.$recrut['sexe'].'",
                            "'.$recrut['age'].'",
                            "'.$recrut['role'].'",
                            "'.$recrut['lvl'].'",
                            "0",
                            "'.addslashes(serialize($recrut['bonus'])).'")
                        ';

                        doquery($sql,'perso');

                        //echo 'je recrute => '.$recrut['name'];
                    }else{
                        $tempRecrut[] = $recrut;
                    }
                }
                //_d($tempRecrut);
                doquery('UPDATE {{table}} SET `array_tirage` = "'.addslashes(serialize($tempRecrut)).'" WHERE `idPlanet` = '.$CurrentPlanet['id'],'recrutment');





                header('location:game.php?page=university&mode=recrut');

                //echo 'UPDATE {{table}} SET `array_tirage` = "'.serialize($tempRecrut).'" WHERE `idPlanet` = '.$CurrentPlanet['id'];
            }else{
                exit(message('Vous n\'avez pas le droit de faire ca'));
            }
        }else{
            exit(message('Vous n\'avez pas de recrut disponible'));
        }
    }

	public function showChoiseRecrut(&$CurrentPlanet, $CurrentUser){
		//Le nombre de compétence pas dépendre du level
		global $nameList, $arrayUniversity;

		$parse = array('choiseList'=>'');
		$save = array();
		$namePosible['homme'] = explode(' ',$nameList['first']['h']['human']);
		$namePosible['femme'] = explode(' ',$nameList['first']['f']['human']);

		$namePosibleLast = explode(' ',$nameList['last']['human']);

		//TODO Type du personel, gouverneur, science, amiral...
		//$type = $_GET['type'];


		$nbChoise = floor ($CurrentUser['university'] / 3)+3;
        if($nbChoise < 3){
            $nbChoise = 3;
        }
		$pourcentLevel = $arrayUniversity['lvlMax'][$CurrentUser['university']];
        $role = array();
		foreach($arrayUniversity['capability'] as $key=>$value){
		    if($CurrentUser['university'] >= $value){
		        $role[] = $key;
            }else{
                break;
            }
        }

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


			$tempLvl = ($arrayPourcent[mt_rand ( 0 , count($arrayPourcent)-1 )]+1);


            $listC['lvl'] = "";

            for($ii=0;$ii<=$tempLvl;$ii++){
                $listC['lvl'] .= '<i class="fa fa-star star-gold" aria-hidden="true"></i>';
                $ii++;
            }

            $listC['bonus'] = $this->setGouverneurBonus($tempLvl);


            $listC['role'] = $role[array_rand($role,1)];

            $listC['age'] = mt_rand(17,41);
            $save[$i]['id'] = $i;
			$save[$i]['name'] = $listC['name'];
			$save[$i]['lvl'] = $tempLvl;
			$save[$i]['sexe'] = $sexe;
            $save[$i]['age'] = $listC['age'];
            $save[$i]['role'] = $listC['role'];
            $save[$i]['bonus'] = $listC['bonus'];
			//$parse['choiseList'] .= parsetemplate(gettemplate('university/recrutList'), $listC) ;
		}

		$save = addslashes (serialize($save));
		$time = time() + (24*60*60);


		//_d($CurrentPlanet);
       doquery('INSERT INTO {{table}} (`array_tirage`,`idPlanet`,`validite`) VALUE ("'.$save.'", '.$CurrentUser['id'].','.$time.')','recrutment',FALSE,TRUE);

        header('location:game.php?page=university&mode=recrut');
        //$this->showExistingRecrut($this->tirage);

		//display(parsetemplate(gettemplate('university/showChoiseRecrut'), $parse));
	}

	public function showExistingRecrut($tirage){

		$tirage = $tirage[0];

		$listC = array();
		$parse = array('choiseList'=>'');
		for($i=0,$j=count($tirage);$i<$j;$i++){
            $listC['id'] = $tirage[$i]['id'];
			$listC['name'] = $tirage[$i]['name'];
            $listC['lvl'] = "";
            $listC['bonus'] = "";
            $listC['sexe'] = $tirage[$i]['sexe'];
            $listC['age'] = $tirage[$i]['age'];
            $listC['role'] = $tirage[$i]['role'];


			for($ii=0;$ii<$tirage[$i]['lvl'];$ii++){
                $listC['lvl'] .= '<i class="fa fa-star star-gold" aria-hidden="true"></i>';
                $ii++;
			}

            //_d($tirage[$i]['bonus']);
			foreach ($tirage[$i]['bonus'] as $bonus){
                $listC['bonus'] .= '<img src="styles/skins/xgproyect/img/bonus/'.$bonus.'.png" />';
            }
			$parse['choiseList'] .= parsetemplate(gettemplate('university/recrutList'), $listC) ;
		}
		display(parsetemplate(gettemplate('university/showChoiseRecrut'), $parse));
	}
	//vrai si j'ai deja un tirage valide
	//Faux si je n'ais pas de tirage
	public function hasTirage(&$CurrentPlanet){

	    //_d($CurrentPlanet);
	    //die();
		$hasTirage = doquery('SELECT * FROM {{table}} WHERE idPlanet = '.$CurrentPlanet['id'].' AND validite > '.time(),'recrutment');

		//echo 'je passe';
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



	public function setGouverneurBonus($lvl){
	    global $arrayUniversity;
        $temArray = $arrayUniversity['bonus']['gouverneur'];
        $bonnus = array();
        for($i=0;$lvl > $i;$i++){

          $tempCat  = array_rand($temArray);
	      $category = $temArray[$tempCat];

          $tempType = array_rand($category);
	      $type = $category[$tempType];

	      $tempBonus = array_rand($type);
	      $bonus = $type[$tempBonus];
            $bonnus[] = $tempCat.'_'.$tempType.'-'.$bonus;
        }
        return array_unique ($bonnus);
    }


}
?>