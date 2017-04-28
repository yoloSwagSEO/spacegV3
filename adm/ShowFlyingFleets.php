<?php
define('INSIDE'  , TRUE);
define('INSTALL' , FALSE);
define('IN_ADMIN', TRUE);
define('XGP_ROOT', './../');

include(XGP_ROOT . 'global.php');
include(XGP_ROOT . 'includes/classes/class.FlyingFleetsTable.php');
include('AdminFunctions/Autorization.php');

if ($Observation != 1) die();

$parse				= $lang;
$FlyingFleetsTable 	= new FlyingFleetsTable();
$parse['flt_table'] = $FlyingFleetsTable->BuildFlyingFleetTable();

display(parsetemplate(gettemplate('adm/fleet_body'), $parse), FALSE, '', TRUE, FALSE);
?>