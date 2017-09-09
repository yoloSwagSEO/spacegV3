<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 26/06/2017
 * Time: 13:36
 */

define("INSIDE",true);
require ('../../config.php');
$link = mysqli_connect($dbsettings['server'],$dbsettings['user'],$dbsettings['pass'],$dbsettings['name']);

$res = mysqli_query($link,"SELECT `name`,`coord_x`,`coord_y` FROM `xgp_planets` WHERE `planet` = 0");
$dataJson = array();
while($data = mysqli_fetch_object($res)){
    $dataJson[] = array('name'=>$data->name,'coords'=>array('x'=>($data->coord_x/1000)*3.335,'y'=>0,'z'=>($data->coord_y/1000)*4.95));
}

echo json_encode($dataJson);



