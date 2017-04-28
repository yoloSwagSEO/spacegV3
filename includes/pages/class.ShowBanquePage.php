<?php

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowBanquePage
{

	public function __construct ($CurrentUser,&$CurrentPlanet)
	{
		global $lang, $resource, $reslist, $_GET, $_POST;
		
		$parse= "";
                
                
                if($CurrentPlanet['banque'] == 0){
                    display(parsetemplate(gettemplate('banque/noBanque_body'), $parse));
                    die();
                }
                
                $action = (isset($_GET['action']))?$_GET['action']:false;
                if($action == 'transfer' || $action == 'transferE'){
                    $error = false;
                    $valeurTrans = str_replace(' ','',$_POST['transfer_value']);
                    if(is_numeric($valeurTrans)){          
                        if($valeurTrans <= 0){
                            $error['error'] = 'Vous avez entrée un nombre négatif';
                            $parse['message'] = parsetemplate(gettemplate('general/erreur'), $error);  
                        }                       
                        if($valeurTrans > $CurrentPlanet['credit']){
                            $error['error'] = 'Vous n\'avez pas asser de crédits';
                            $parse['message'] = parsetemplate(gettemplate('general/erreur'), $error);
                        }
                        if($error == false){
                            if($action == 'transfer' ){
                                $this->moneyTransfer($CurrentPlanet, $_POST['recepteur'], $valeurTrans,true);
                            }elseif($action == 'transferE'){
                                echo 'hey hey hey';
                                $result = doquery("SELECT id FROM {{table}} WHERE galaxy = ".$_POST['secteur']." AND system = ".$_POST['sys']." AND planet = ".$_POST['planet']." AND control_type = 1 AND banque >= 1",'planets');
                                
                                if(mysqli_num_rows($result)>0){
                                    $data = mysqli_fetch_array($result);
                                    $this->moneyTransfer($CurrentPlanet, $data['id'], $valeurTrans);
                                }
                               
                            }
                        }
                    }else{
                            $error['error'] = 'Ce n\'est pas un nombre';
                            $parse['message'] = parsetemplate(gettemplate('general/erreur'), $error);
                    }
                }
                $colonieOk = doquery('SELECT id,name,galaxy,system,planet FROM {{table}} WHERE  id_owner = '.$CurrentUser['id'].' AND control_type = 1 AND banque >= 1', 'planets');
                while($data = mysqli_fetch_array($colonieOk)){
                    if($data['id'] != $CurrentPlanet['id']){
                        $parse['colonie'] .= '<option value="'.$data['id'].'">'.$data['name'].' ['.$data['galaxy'].':'.$data['system'].':'.$data['planet'].']</option>';
                    }     
                }
                $this->index($parse);  
		
	}
        public function index($parse){
            display(parsetemplate(gettemplate('banque/banque_body'), $parse));
        }
        public function moneyTransfer(&$CurrentPlanet,$crediteur,$amount,$intern=false){

            doquery('UPDATE {{table}} SET credit = credit - '.$amount.' WHERE id = '.$CurrentPlanet['id'], 'planets');
            doquery('UPDATE {{table}} SET credit = credit + '.$amount.' WHERE id = '.$crediteur,'planets');
            
            //FIX -- FUKING DEV XNOVA --
            $CurrentPlanet['credit'] = $CurrentPlanet['credit'] - $amount;
        }
}
?>