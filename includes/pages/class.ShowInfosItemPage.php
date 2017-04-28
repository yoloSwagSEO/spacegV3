<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowInfosItemPage
{
    public function __construct ($CurrentUser, $CurrentPlanet, $BuildID, $item=false)
    {
        global $lang, $resource, $pricelist, $CombatCaps;

        $GateTPL              = '';
        $DestroyTPL           = '';
        $TableHeadTPL         = '';
        $sql = 'SELECT * FROM {{table}} WHERE `id` = '.$BuildID;
        //echo $sql;
        $result = doquery($sql, 'item', TRUE);
        //print_r($result);
        $parse                = $lang;
        $parse['dpath']       = DPATH;
        $parse['name']        = $result['nom'];
        $parse['image']       = $BuildID;
        $parse['description'] = $result['description'];


        
        $page = parsetemplate(gettemplate('infos/info_item'),$parse);
 
        display2($page);
    }
}