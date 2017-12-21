<?php
define('INSIDE'  ,  TRUE);
define('INSTALL' , FALSE);
define('XGP_ROOT',	'./');

include(XGP_ROOT . 'global.php');

$UserSpyProbes  = $planetrow['spy_sonde'];
$UserRecycles   = $planetrow['recycler'];
$UserDeuterium  = $planetrow['deuterium'];
$UserMissiles   = $planetrow['interplanetary_misil'];
//print_r($_POST);
if($_POST['action'] == 'delete'){
    $sql = 'DELETE FROM {{table}} WHERE message_id = '.$_POST['id'].' AND message_owner = '.$user['id'].'';
    doquery( $sql, 'messages', false);
    echo $_POST['id'];
}
if($_POST['action'] == 'read'){
    $sql = 'UPDATE {{table}} SET `read` = 1 WHERE message_id = '.$_POST['id'].' AND message_owner = '.$user['id'].'';
    //echo $sql;
    doquery( $sql, 'messages', false);
    echo $_POST['id'];
}
?>