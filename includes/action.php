<?php
/**
 * Created by Florian Laffont.
 * User: Florian Laffont
 * Date: 26/04/2017
 * Time: 10:13
 * Description : Fichier regroupant les actions utiliser par le système de hook.
 * Documentation : https://github.com/edouardl/php_hooks
 *
 * ------GLOBAL POSSIBLE------
 * $planetrow => Planete courante
 * $user => Joueur
 * $lang => Fichier de langue
 *
 * ------ACTIONS------
 * ------Building------
 * pre-building-end
 *    (int) @element : Id de l'éléments construit
 *    (int) @lvl : Niveau du batiment APRES la construction.
 *
 *    Description: Call a la fin de la construction du batiment mais avant sont enregistrement en DB
 *
 * pre-building-destroy-end
 *    (int) @element : Id de l'éléments construit
 *    (int) @lvl : Niveau du batiment APRES la destruction.
 *
 *    Description: Call a la fin de la destruction du batiment mais avant sont enregistrement en DB
 *
 * post-building-end
 *    (int) @element : Id de l'éléments construit
 *    (int) @lvl : Niveau du batiment APRES la construction.
 *    (bool)@destruc : si c'est une destruction
 *
 *    Description: Call a la fin de la construction/destruction d'un batiment aprés l'enregistrement en DB
 *
 * pre-research-end
 *   (int) @element : Id de l'éléments rechercher
 *   (int) @lvl : Niveau de la technologie APRES la recherche.
 *
 *   Description: Call a la fin de la recherche d'une technologie AVANT l'envoi en DB
 *
 */

//add_action( 'pre-building-end', 'an_action_function' );


add_action('post-building-end','add_building_to_prompteur');

function add_building_to_prompteur($param){
    global $lang;
    if(!$param['destruc']){
        //echo $lang['tech'][$param['element']].'('.$param['lvl'].')'.$lang['prompteur']['end_construct'];
        $_SESSION['prompteur'][time()] =  array('type'=>'build','event'=>$lang['tech'][$param['element']].'('.$param['lvl'].')'.$lang['prompteur']['end_construct']);
    }
}


