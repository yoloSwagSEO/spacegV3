<?php
define('INSIDE'  ,  TRUE);
define('INSTALL' , FALSE);
define('XGP_ROOT',	'./');

include(XGP_ROOT . 'global.php');

$UserSpyProbes  = $planetrow['spy_sonde'];
$UserRecycles   = $planetrow['recycler'];
$UserDeuterium  = $planetrow['deuterium'];
$UserMissiles   = $planetrow['interplanetary_misil'];

//On regarde deja si l'on as des transporteur sur la colonie en cours.
//print_r($planetrow);
$totalTransport = "";
$totalTransport += $planetrow[$resource[202]] * $pricelist[202]['capacity'];
$totalTransport += $planetrow[$resource[203]] * $pricelist[203]['capacity'];
echo $totalTransport;

//print_r($_GET);
//on regarde le nombre de ressource a recupéré
$sql = "SELECT metal, crystal, deuterium FROM {{table}} WHERE galaxy =".$_GET['galaxy']." AND system = ".$_GET['system']." AND planet=".$_GET['planet']."";
$targetPlanet = doquery($sql,"planets",true);
$targetRessources = 0;
for($i=0,$j=count($targetPlanet);$i<$j;$i++){
	$targetRessources += $targetPlanet[$i];
}
echo $targetRessources;
//on calcule le nombre de transporteur néséssaire.
if($targetRessources < $totalTransport){
	echo 'j\'ai asser de transporter';
}else{
	echo 'Il vas me manquer des transporter';
}
//on les envoie.

?>