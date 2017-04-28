<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if ( defined('INSIDE'))
{

	$resource = array(
	  1 => "metal_mine",
	  2 => "crystal_mine",
	  3 => "deuterium_sintetizer",
	  4 => "solar_plant",
	 10 => "metacity",
	 12 => "fusion_plant",
	 14 => "robot_factory",
	 15 => "nano_factory",
	 21 => "hangar",
	 22 => "metal_store",
	 23 => "crystal_store",
	 24 => "deuterium_store",
	 
	 30 => "commande_center",
	 31 => "laboratory",
     32 => "techcenter",
	 33 => "terraformer",
	 34 => "ally_deposit",
         36 => "university",
	 37 => "caserne",
	 38 => "diffcul",
         39 => "banque",
        
	 41 => "mondbasis",
	 42 => "phalanx",
	 43 => "sprungtor",
	 44 => "silo",
     
	 51 => "stargate",


	106 => "spy_tech",
	108 => "computer_tech",
	109 => "military_tech",
	110 => "defence_tech",
	111 => "shield_tech",
        112 => "canticcomputer_tech",
	113 => "energy_tech",
	114 => "hyperspace_tech",
	115 => "combustion_tech",
	117 => "impulse_motor_tech",
	118 => "hyperspace_motor_tech",
	120 => "laser_tech",
	121 => "ionic_tech",
	122 => "buster_tech",
	123 => "intergalactic_tech",
	124 => "expedition_tech",
	125 => "geologie_tech",
	199 => "graviton_tech",

	202 => "small_ship_cargo",
	203 => "big_ship_cargo",
	204 => "module_minier",
	//205 => "heavy_hunter",
	//206 => "crusher",
	//207 => "battle_ship",
	208 => "colonizer",
	209 => "recycler",
	210 => "spy_sonde",
	211 => "bomber_ship",
	212 => "solar_satelit",
	213 => "destructor",
	214 => "dearth_star",
	215 => "battleship",
	//début rajout
	216 => "falcon_l",
	217 => "owl",
	218 => "vulture",
	219 => "raven",
	220 => "falcon_m",
	221 => "omul",
	222 => "stiller",
	223 => "promethium",
	224 => "edi",
        225 => "explorer",
	226 => "malestrom",
	//225 => "cougar",
	//226 => "sword",
	//227 => "wakizashi",
	//228 => "tiger",
	//229 => "t5_trm_sword",
	//230 => "lion_mk2",
	//231 => "bear",
	//232 => "lynx_mk2",
	//233 => "maned_wolk",
	//234 => "stegosaurus",
	//235 => "ankylosaurus",
	//236 => "triceratops",
	//237 => "thor",
	//238 => "baldr",
	//239 => "spinosaurus",
	//240 => "",
	//241 => "",
	//242 => "",
	//243 => "",
	//244 => "",
	//245 => "",
	//246 => "",
	//247 => "",
	//248 => "",
	//249 => "",
	//250 => "",

	401 => "misil_launcher",
	402 => "small_laser",
	403 => "big_laser",
	404 => "gauss_canyon",
	405 => "ionic_canyon",
	406 => "buster_canyon",
	407 => "small_protection_shield",
	408 => "big_protection_shield",
	502 => "interceptor_misil",
	503 => "interplanetary_misil",

	601 => "rpg_geologue",
	602 => "rpg_amiral",
	603 => "rpg_ingenieur",
	604 => "rpg_technocrate",
	605 => "rpg_geologue",
	606 => "rpg_politique_d_expansion",
	607 => "rpg_empire_tentaculaire",
	608 => "rpg_entrainement_flotte_tir",
	609 => "rpg_entrainement_flotte_esquive",
	610 => "rpg_astro-planetologie",
	611 => "rpg_etude-geologique",
	612 => "rpg_administration-economique",
	613 => "rpg_police-commerciale",
	614 => "rpg_navigation",
	615 => "rpg_ingenieur",
	616 => "rpg_technocrate",
	617 => "rpg_geologue",
	618 => "rpg_amiral",
	619 => "rpg_ingenieur",
	620 => "rpg_technocrate",
            
        801 => "marines",
        802 => "catransporter",
        803 => "tank"
	);
	
        $batimentCategory = array(
	  1 => "ressource",
	  2 => "ressource",
	  3 => "ressource",
	  4 => "ressource",

         10 => "civil",
	 12 => "ressource",
	 14 => "civil",
	 15 => "civil",
	 21 => "militaire",
	 22 => "ressource",
	 23 => "ressource",
	 24 => "ressource",
	 30 => "civil",
	 31 => "scientifique",
         32 => "scientifique",
	 33 => "ressource",
	 34 => "militaire",
         36 => "scientifique",
	 37 => "militaire",
	 38 => "civil",
         39 => "civil",
        
	 41 => "mondbasis",
	 42 => "phalanx",
	 43 => "sprungtor",
	 44 => "militaire",

     51 => "exo"
        );
    $limit = array(
		1 => 5
	);  
	$requeriments = array(
		 12 => array(   3 =>   5, 113 =>   3),
		 15 => array(  14 =>  10, 108 =>  10),
		 21 => array(  14 =>   2),
                 32 => array(  31 =>   4),
		 33 => array(  15 =>   1, 113 =>  12),
                 36 => array( 31 => 1),
                 37 => array( 36 => 2),
                 39 => array( 36 => 4),
            
                 10 => array( 36 => 5,31=>5,15=>2,108=>5,112=>2),
		 42 => array(  41 =>   1),
		 43 => array(  41 =>   1, 114 =>   7),
		 44 => array(  21 =>   1),

		106 => array(  31 =>   3),
		108 => array(  31 =>   1),
		109 => array(  31 =>   4),
		110 => array( 113 =>   3,  31 =>   6),
		111 => array(  31 =>   2),
                112 => array(  31 =>   5),
		113 => array(  31 =>   1),
		114 => array( 113 =>   5, 110 =>   5,  31 =>   7),
		115 => array( 113 =>   1,  31 =>   1),
		117 => array( 113 =>   1,  31 =>   2),
		118 => array( 114 =>   3,  31 =>   7),
		120 => array(  31 =>   1, 113 =>   2),
		121 => array(  31 =>   4, 120 =>   5, 113 =>   4),
		122 => array(  31 =>   5, 113 =>   8, 120 =>  10, 121 =>   5),
		123 => array(  31 =>  10, 108 =>   8, 114 =>   8),
		124 => array(  31 =>   3, 108 =>   4, 117 =>   3),
		125 => array(	1 =>   1,   2 =>   1),
		199 => array(  31 =>  12),

		202 => array(  21 =>   2, 115 =>   2),
		203 => array(  21 =>   4, 115 =>   6),
		204 => array(  21 =>   1, 125 =>   2),
		//205 => array(  21 =>   3, 111 =>   2, 117 =>   2),
		//206 => array(  21 =>   5, 117 =>   4, 121 =>   2),
		//207 => array(  21 =>   7, 118 =>   4),
		208 => array(  21 =>   4, 117 =>   3),
		209 => array(  21 =>   4, 115 =>   6, 110 =>   2),
		210 => array(  21 =>   3, 115 =>   3, 106 =>   2),
		211 => array( 117 =>   6,  21 =>   8, 122 =>   5),
		212 => array(  21 =>   1),
		213 => array(  21 =>   9, 118 =>   6, 114 =>   5),
		214 => array(  21 =>  12, 118 =>   7, 114 =>   6,  199 =>   1),
		215 => array( 114 =>   5, 120 =>  12, 118 =>   5,   21 =>   8),
		//début rajout
		216 => array(),
		217 => array(), 
		218 => array(), 
		219 => array(), 
		220 => array(), 
		221 => array(), 
		222 => array(), 
		223 => array(), 
		224 => array(), 
		226 => array(109=>15,110=>15,114=>10),
		//225 => array(); 
		//226 => array(); 
		//227 => array(); 
		//228 => array(); 
		//229 => array(); 
		//230 => array(); 
		//231 => array(); 
		//232 => array(); 
		//233 => array(); 
		//234 => array(); 
		//235 => array(); 
		//236 => array(); 
		//237 => array(); 
		//238 => array(); 
		//239 => array(); 
		
		401 => array(  21 =>   1),
		402 => array( 113 =>   1,  21 =>   2, 120 =>   3),
		403 => array( 113 =>   3,  21 =>   4, 120 =>   6),
		404 => array(  21 =>   6, 113 =>   6, 109 =>   3, 110 =>   1),
		405 => array(  21 =>   4, 121 =>   4),
		406 => array(  21 =>   8, 122 =>   7),
		407 => array( 110 =>   2,  21 =>   1),
		408 => array( 110 =>   6,  21 =>   6),
		502 => array(  44 =>   2,  21 =>   1),
		503 => array(  44 =>   4,  21 =>   1, 117 =>   1),
	);


	$pricelist = array(
            //--DEBUT-- BATIMENTS            
		  1 => array ( 'metal' =>      60, 'crystal' =>      15, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2, 'factor_cred' => -0.4),
		  2 => array ( 'metal' =>      48, 'crystal' =>      24, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 1.6, 'factor_cred' => -0.4),
		  3 => array ( 'metal' =>     225, 'crystal' =>      75, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2, 'factor_cred' => -0.6),
		  4 => array ( 'metal' =>      75, 'crystal' =>      30, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2, 'factor_cred' => 1),
                 12 => array ( 'metal' =>     900, 'crystal' =>     360, 'credit'=>     0, 'deuterium' =>     180, 'energy' =>    0, 'factor' => 1.8, 'factor_cred' => 1),
		 14 => array ( 'metal' =>     400, 'crystal' =>     120, 'credit'=>     0, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => 1),
		 15 => array ( 'metal' =>  500000, 'crystal' =>  250000, 'credit'=>     0, 'deuterium' =>   50000, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => 1),
		 21 => array ( 'metal' =>     400, 'crystal' =>     200, 'credit'=>     0, 'deuterium' =>     100, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => 1),
		 22 => array ( 'metal' =>    2000, 'crystal' =>       0, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => -1),
		 23 => array ( 'metal' =>    2000, 'crystal' =>    1000, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => -1),
		 24 => array ( 'metal' =>    2000, 'crystal' =>    2000, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => -1),
		 30 => array ( 'metal' =>    6000, 'crystal' =>    6000, 'credit'=>  2000, 'deuterium' =>    2000, 'energy' =>  100, 'factor' =>   2, 'factor_cred' => 160),
		 31 => array ( 'metal' =>     200, 'crystal' =>     400, 'credit'=>     0, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => 1),
		 32 => array ( 'metal' =>     600, 'crystal' =>    1200, 'credit'=>     0, 'deuterium' =>     800, 'energy' =>    0, 'factor' =>   2, 'factor_cred' => 1),
		 33 => array ( 'metal' =>       0, 'crystal' =>   50000, 'credit'=>     0, 'deuterium' =>  100000, 'energy_max' => 1000, 'factor' =>   2, 'factor_cred' => 1),
		 34 => array ( 'metal' =>   20000, 'crystal' =>   40000, 'credit'=>     0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 1),
		 36 => array ( 'metal' =>     400, 'crystal' =>     300, 'credit'=>     0, 'deuterium' =>      50, 'energy' =>   0, 'factor' => 2.1, 'factor_cred' => 1), 
                 37 => array ( 'metal' =>     460, 'crystal' =>     390, 'credit'=>     0, 'deuterium' =>     150, 'energy' =>   0, 'factor' => 3.1, 'factor_cred' => 1), 
                 38 => array ( 'metal' =>     320, 'crystal' =>     210, 'credit'=>     0, 'deuterium' =>     150, 'energy' =>   0, 'factor' => 2.2, 'factor_cred' => 1), 
                 39 => array ( 'metal' =>    5000, 'crystal' =>     210, 'credit'=>     0, 'deuterium' =>     150, 'energy' =>   0, 'factor' => 2.2, 'factor_cred' => 25), 
                 41 => array ( 'metal' =>   20000, 'crystal' =>   40000, 'credit'=>     0, 'deuterium' =>   20000, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 0),
		 42 => array ( 'metal' =>   20000, 'crystal' =>   40000, 'credit'=>     0, 'deuterium' =>   20000, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 0),
		 43 => array ( 'metal' => 2000000, 'crystal' => 4000000, 'credit'=>     0, 'deuterium' => 2000000, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 0),
		 10 => array ( 'metal' =>   20000, 'crystal' =>   20000, 'credit'=>     0, 'deuterium' =>    1000, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 1),
                 44 => array ( 'metal' =>   15000, 'crystal' =>   30000, 'credit'=>     0, 'deuterium' =>   12000, 'energy' =>    0, 'factor' =>   2,'factor_cred' => 1),
		51 => array ( 'metal' =>   0, 'crystal' =>   0, 'credit'=>     0, 'deuterium' =>   0, 'energy' =>    0, 'factor' =>   0,'factor_cred' => 0),
            //--FIN-- BATIMENTS
		106 => array ( 'metal' =>     200, 'crystal' =>    1000, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2),
		108 => array ( 'metal' =>       0, 'crystal' =>     400, 'deuterium' =>     600, 'energy' =>    0, 'factor' =>   2),
		109 => array ( 'metal' =>     800, 'crystal' =>     200, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2),
		110 => array ( 'metal' =>     200, 'crystal' =>     600, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2),
		111 => array ( 'metal' =>    1000, 'crystal' =>       0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2),
                112 => array ( 'metal' =>   10000, 'crystal' =>    1200, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2),
		113 => array ( 'metal' =>       0, 'crystal' =>     800, 'deuterium' =>     400, 'energy' =>    0, 'factor' =>   2),
		114 => array ( 'metal' =>       0, 'crystal' =>    4000, 'deuterium' =>    2000, 'energy' =>    0, 'factor' =>   2),
		115 => array ( 'metal' =>     400, 'crystal' =>       0, 'deuterium' =>     600, 'energy' =>    0, 'factor' =>   2),
		117 => array ( 'metal' =>    2000, 'crystal' =>    4000, 'deuterium' =>    600, 'energy' =>    0, 'factor' =>   2),
		118 => array ( 'metal' =>   10000, 'crystal' =>   20000, 'deuterium' =>    6000, 'energy' =>    0, 'factor' =>   2),
		120 => array ( 'metal' =>     200, 'crystal' =>     100, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2),
		121 => array ( 'metal' =>    1000, 'crystal' =>     300, 'deuterium' =>     100, 'energy' =>    0, 'factor' =>   2),
		122 => array ( 'metal' =>    2000, 'crystal' =>    4000, 'deuterium' =>    1000, 'energy' =>    0, 'factor' =>   2),
		123 => array ( 'metal' =>  240000, 'crystal' =>  400000, 'deuterium' =>  160000, 'energy' =>    0, 'factor' =>   2),
		124 => array ( 'metal' =>    4000, 'crystal' =>    8000, 'deuterium' =>    4000, 'energy' =>    0, 'factor' =>   2),
		125 => array ( 'metal' =>     270, 'crystal' =>    1110, 'deuterium' =>     380, 'energy' =>    0, 'factor' =>   2),
		199 => array ( 'metal' =>       0, 'crystal' =>       0, 'deuterium' =>       0, 'energy_max' => 300000, 'factor' =>   3),

		202 => array ( 'metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  ,'transportVx'=>10,'transportTr'=>100, 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 ),
		203 => array ( 'metal' =>     6000, 'crystal' =>     6000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 25  , 'consumption2' => 25  ,'transportVx'=>50,'transportTr'=>500, 'speed' =>      7500, 'speed2' =>      7500, 'capacity' =>    25000 ),
		204 => array ( 'metal' =>      500, 'crystal' =>      200, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  ,'transportVx'=>0, 'speed' =>     24000, 'speed2' =>     28000, 'capacity' =>       500 ),
		//205 => array ( 'metal' =>     6000, 'crystal' =>     4000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 30  , 'consumption2' => 30  , 'speed' =>     10000, 'speed2' =>     15000, 'capacity' =>      100 ),
		//206 => array ( 'metal' =>    20000, 'crystal' =>     7000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1, 'consumption' => 150 , 'consumption2' => 150 , 'speed' =>     15000, 'speed2' =>     15000, 'capacity' =>      800 ),
		//207 => array ( 'metal' =>    45000, 'crystal' =>    15000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 250 , 'consumption2' => 250 , 'speed' =>     10000, 'speed2' =>     10000, 'capacity' =>     1500 ),
		208 => array ( 'metal' =>    10000, 'crystal' =>    20000, 'deuterium' =>   10000, 'energy' => 0, 'factor' => 1, 'consumption' => 500 , 'consumption2' => 500 ,'transportVx'=>100,'transportTr'=>1000, 'speed' =>      2500, 'speed2' =>      2500, 'capacity' =>     7500 ),
		209 => array ( 'metal' =>    10000, 'crystal' =>     6000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1, 'consumption' => 150 , 'consumption2' => 150 ,'transportVx'=>0,'transportTr'=>0, 'speed' =>      2000, 'speed2' =>      2000, 'capacity' =>    20000 ),
		210 => array ( 'metal' =>        0, 'crystal' =>     1000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   ,'transportVx'=>0,'transportTr'=>0, 'speed' => 100000000, 'speed2' => 100000000, 'capacity' =>        5 ),
		211 => array ( 'metal' =>    50000, 'crystal' =>    25000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 500 , 'consumption2' => 500 ,'transportVx'=>0,'transportTr'=>0, 'speed' =>      4000, 'speed2' =>      5000, 'capacity' =>      500 ),
		212 => array ( 'metal' =>        0, 'crystal' =>     2000, 'deuterium' =>     500, 'energy' => 0, 'factor' => 1, 'consumption' => 0   , 'consumption2' => 0   ,'transportVx'=>0,'transportTr'=>0, 'speed' =>         0, 'speed2' =>         0, 'capacity' =>        0 ),
		213 => array ( 'metal' =>    60000, 'crystal' =>    50000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 500 , 'consumption2' => 500 ,'transportVx'=>0,'transportTr'=>0, 'speed' =>      5000, 'speed2' =>      5000, 'capacity' =>     2000 ),
		214 => array ( 'metal' =>  5000000, 'crystal' =>  4000000, 'deuterium' => 1000000, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   ,'transportVx'=>0,'transportTr'=>0, 'speed' =>       100, 'speed2' =>       100, 'capacity' =>  1000000 ),
		215 => array ( 'metal' =>    30000, 'crystal' =>    40000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 125 , 'consumption2' => 125 ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     10000, 'speed2' =>     10000, 'capacity' =>      750 ),
	

		216 => array('metal' =>     3000, 'crystal' =>     1000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     12500, 'speed2' =>     12500, 'capacity' =>       20 ),
		217 => array('metal' =>     3300, 'crystal' =>     1650, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 18  , 'consumption2' => 24  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     15000, 'speed2' =>     16000, 'capacity' =>       30 ),
		218 => array('metal' =>     3400, 'crystal' =>     1300, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 12  , 'consumption2' => 12  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     13000, 'speed2' =>     13000, 'capacity' =>       15 ),
		219 => array('metal' =>     3600, 'crystal' =>     1450, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 18  , 'consumption2' => 18  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     14000, 'speed2' =>     14000, 'capacity' =>       20 ),
		220 => array('metal' =>     3800, 'crystal' =>     1800, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 20  , 'consumption2' => 22  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     16000, 'speed2' =>     18000, 'capacity' =>       30 ),
		221 => array('metal' =>     1500, 'crystal' =>      500, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' =>  5  , 'consumption2' =>  5  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>      9000, 'speed2' =>      9000, 'capacity' =>       10 ),
		222 => array('metal' =>     1000, 'crystal' =>      400, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' =>  5  , 'consumption2' =>  5  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>      8000, 'speed2' =>      8000, 'capacity' =>       10 ),
		223 => array('metal' =>     4000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 15  , 'consumption2' => 25  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     20000, 'speed2' =>     22000, 'capacity' =>       50 ),
		224 => array('metal' =>     4500, 'crystal' =>     2500, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 20  , 'consumption2' => 28  ,'transportVx'=>0,'transportTr'=>0, 'speed' =>     25000, 'speed2' =>     29000, 'capacity' =>       50 ),
		225 => array('metal' =>        0, 'crystal' =>     1000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   ,'transportVx'=>0,'transportTr'=>0, 'speed' => 100000000, 'speed2' => 100000000, 'capacity' =>        5 ),
		226 => array('metal' => 10000000, 'crystal' => 20000000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   ,'transportVx'=>50000,'transportTr'=>150000, 'speed' => 100000, 'speed2' => 1000000, 'capacity' =>        500000 ),
		
		//225 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//226 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//227 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//228 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//229 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//230 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//231 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//232 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//233 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//234 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//235 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//236 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//237 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//238 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		//239 => array('metal' =>     2000, 'crystal' =>     2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 10  , 'consumption2' => 10  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>     5000 );
		
		401 => array ( 'metal' =>    2000, 'crystal' =>       0, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),
		402 => array ( 'metal' =>    1500, 'crystal' =>     500, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),
		403 => array ( 'metal' =>    6000, 'crystal' =>    2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),
		404 => array ( 'metal' =>   20000, 'crystal' =>   15000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1 ),
		405 => array ( 'metal' =>    2000, 'crystal' =>    6000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),
		406 => array ( 'metal' =>   50000, 'crystal' =>   50000, 'deuterium' =>   30000, 'energy' => 0, 'factor' => 1 ),
		407 => array ( 'metal' =>   10000, 'crystal' =>   10000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),
		408 => array ( 'metal' =>   50000, 'crystal' =>   50000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ),

		502 => array ( 'metal' =>    8000, 'crystal' =>    0, 'deuterium' =>       2000, 'energy' => 0, 'factor' => 1 ),
		503 => array ( 'metal' =>   12500, 'crystal' =>    2500, 'deuterium' =>   10000, 'energy' => 0, 'factor' => 1 ),
 
		601 => array ( 'darkmatter' => 	  5000, 'max' =>  1),
		602 => array ( 'darkmatter' =>    5000, 'max' =>  1),
		603 => array ( 'darkmatter' =>   12500, 'max' =>  1),
		604 => array ( 'darkmatter' =>   10000, 'max' =>  1),
            
        801 => array('metal' =>     3000, 'crystal' =>     1000, 'deuterium' =>       0,'credit'=>     200, 'energy' => 0, 'factor' => 1,  'speed' =>     12500, 'speed2' =>     12500, 'capacity' =>       20 ),
		802 => array('metal' =>     5000, 'crystal' =>     3000, 'deuterium' =>       0,'credit'=>     800, 'energy' => 0, 'factor' => 1,  'speed' =>     12500, 'speed2' =>     12500, 'capacity' =>       8000 ),
		803 => array('metal' =>     7000, 'crystal' =>     6000, 'deuterium' =>       0,'credit'=>     1200, 'energy' => 0, 'factor' => 1, 'speed' =>     12500, 'speed2' =>     12500, 'capacity' =>       120 ),
		
	);

	$CombatCaps = array(
		202 => array ( 'shield' =>    10, 'attack' =>      5, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		203 => array ( 'shield' =>    25, 'attack' =>      5, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		204 => array ( 'shield' =>     1, 'attack' =>     5,   'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    0, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		//205 => array ( 'shield' =>    25, 'attack' =>    150, 'sd' => array (202 =>   3, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		//206 => array ( 'shield' =>    50, 'attack' =>    400, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   6, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>  10, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		//207 => array ( 'shield' =>   200, 'attack' =>   1000, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   8, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		208 => array ( 'shield' =>   100, 'attack' =>     50, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		209 => array ( 'shield' =>    10, 'attack' =>      0, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		210 => array ( 'shield' =>     0, 'attack' =>      0, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    0, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		211 => array ( 'shield' =>   500, 'attack' =>   1000, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>  20, 402 =>  20, 403 =>  10, 404 =>   0, 405 =>  10, 406 =>   0, 407 =>   0, 408 =>   0)),
		212 => array ( 'shield' =>    10, 'attack' =>      0, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    1, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		213 => array ( 'shield' =>   500, 'attack' =>   2000, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   2, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  10, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		214 => array ( 'shield' => 50000, 'attack' => 200000, 'sd' => array (202 => 250, 203 => 250, 204 => 200, 205 => 100, 206 =>  33, 207 =>  30, 208 => 250, 209 => 250, 210 => 1250, 211 =>  25, 212 => 1250, 213 =>   5, 214 =>   0, 215 =>  15, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 => 200, 402 => 200, 403 => 100, 404 =>  50, 405 => 100, 406 =>   0, 407 =>   0, 408 =>   0)),
		215 => array ( 'shield' =>   400, 'attack' =>    700, 'sd' => array (202 =>   3, 203 =>   3, 204 =>   0, 205 =>   4, 206 =>   4, 207 =>   7, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
        225 => array ( 'shield' =>     0, 'attack' =>      0, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    0, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		
		216 => array(  'shield' => 	  10, 'attack' => 	  50, 'sd' => array (202 =>   2, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   2, 210 =>    6, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   3, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),    
		217 => array(  'shield' => 	  15, 'attack' => 	  55, 'sd' => array (202 =>   2, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   2, 210 =>    6, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   0, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   3, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		218 => array(  'shield' => 	  20, 'attack' => 	  60, 'sd' => array (202 =>   3, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   2, 210 =>    6, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   3, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),		
		219 => array(  'shield' => 	  30, 'attack' => 	  80, 'sd' => array (202 =>   3, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   2, 210 =>    6, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   3, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		220 => array(  'shield' => 	  37, 'attack' => 	  89, 'sd' => array (202 =>   2, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   2, 210 =>    6, 211 =>   0, 212 =>    5, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   2, 222 =>   3, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		221 => array(  'shield' => 	   5, 'attack' => 	  15, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   0, 210 =>    8, 211 =>   0, 212 =>    8, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   4, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		222 => array(  'shield' => 	   7, 'attack' => 	  15, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   0, 210 =>    8, 211 =>   0, 212 =>    8, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   4, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		223 => array(  'shield' => 	  42, 'attack' => 	  92, 'sd' => array (202 =>   3, 203 =>   2, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   3, 210 =>    6, 211 =>   0, 212 =>    6, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   4, 223 =>   0, 224 =>   2, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),  
		224 => array(  'shield' => 	  48, 'attack' => 	  98, 'sd' => array (202 =>   2, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   3, 210 =>    6, 211 =>   0, 212 =>    6, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   5, 223 =>   2, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		226 => array(  'shield' => 	  4000, 'attack' => 	  15000, 'sd' => array (202 =>   2, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   2, 209 =>   3, 210 =>    6, 211 =>   0, 212 =>    6, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   2, 217 =>   2, 218 =>   2, 219 =>   2, 220 =>   2, 221 =>   3, 222 =>   5, 223 =>   2, 224 =>   0, 401 =>   0, 402 =>   0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0)),
		
		401 => array ( 'shield' =>      20, 'attack' =>   80, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		402 => array ( 'shield' =>      25, 'attack' =>  100, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		403 => array ( 'shield' =>     100, 'attack' =>  250, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		404 => array ( 'shield' =>     200, 'attack' => 1100, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		405 => array ( 'shield' =>     500, 'attack' =>  150, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		406 => array ( 'shield' =>     300, 'attack' => 3000, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		407 => array ( 'shield' =>    2000, 'attack' =>    1, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),
		408 => array ( 'shield' =>   10000, 'attack' =>    1, 'sd' => array (202 =>   0, 203 =>   0, 204 =>   0, 205 =>   0, 206 =>   0, 207 =>   0, 208 =>   0, 209 =>   0, 210 =>    5, 211 =>   0, 212 =>    0, 213 =>   0, 214 =>   0, 215 =>   0, 216 =>   0, 217 =>   0, 218 =>   0, 219 =>   0, 220 =>   0, 221 =>   0, 222 =>   0, 223 =>   0, 224 =>   0, 401 =>   0, 402 =>  0, 403 =>   0, 404 =>   0, 405 =>   0, 406 =>   0, 407 =>   0, 408 =>   0) ),

		502 => array ( 'shield' =>     1, 'attack' =>      1 ),
		503 => array ( 'shield' =>     1, 'attack' =>  12000 ),
			
		801 => array ( 'shield' =>     0, 'attack' => 200),
		802 => array ( 'shield' =>   300, 'attack' =>  20),
		803 => array ( 'shield' =>   300, 'attack' =>1500),
				
	);

	$ProdGrid = array(

		1   => array( 'metal' =>   40, 'crystal' =>   10, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
			'formule' => array(
				'metal'     => 'return   (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
				'crystal'   => 'return   "0";',
				'deuterium' => 'return   "0";',
				'energy'    => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);'),
                                'population' => 'return   "0";'
		),

		2   => array( 'metal' =>   30, 'crystal' =>   15, 'deuterium' =>    0, 'energy' => 0, 'factor' => 1.6,
			'formule' => array(
				'metal'     => 'return   "0";',
				'crystal'   => 'return   (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
				'deuterium' => 'return   "0";',
				'population' => 'return   "0";',
                                'energy'    => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
		),

		3   => array( 'metal' =>  150, 'crystal' =>   50, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
			'formule' => array(
				'metal'     => 'return   "0";',
				'crystal'   => 'return   "0";',
				'deuterium' => 'return  ((10 * $BuildLevel * pow((1.1), $BuildLevel)) * (-0.002 * $BuildTemp + 1.28))  * (0.1 * $BuildLevelFactor);',
				'population' => 'return   "0";',
                                'energy'    => 'return - (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
                ),

		4   => array( 'metal' =>   50, 'crystal' =>   20, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
			'formule' => array(
				'metal'     => 'return   "0";',
				'crystal'   => 'return   "0";',
				'deuterium' => 'return   "0";',
                                'population' => 'return   "0";',
                                'energy'    => 'return   (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
		),
		12  => array( 'metal' =>  500, 'crystal' =>  200, 'deuterium' =>  100, 'energy' => 0, 'factor' => 1.8,
                        'formule' => array(
                                'metal'     => 'return   "0";',
                                'crystal'   => 'return   "0";',
                                'deuterium' => 'return - (10 * $BuildLevel * pow(1.1,$BuildLevel) * (0.1 * $BuildLevelFactor));',
                                'population' => 'return   "0";',
                                'energy'    => 'return   (30 * $BuildLevel * pow((1.05 + $BuildEnergy * 0.01), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
                ),

		212 => array( 'metal' =>    0, 'crystal' => 2000, 'deuterium' =>  500, 'energy' => 0, 'factor' => 0.5,
			'formule' => array(
				'metal'     => 'return   "0";',
				'crystal'   => 'return   "0";',
				'deuterium' => 'return   "0";',
                                'population' => 'return   "0";',
				'energy'    => 'return  (($BuildTemp / 4) + 20) * $BuildLevel * (0.1 * $BuildLevelFactor);')
		),
		204 => array( 'metal' =>   40, 'crystal' =>   10, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
			'formule' => array(
				'metal'     => 'return   (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
				'crystal'   => 'return   "0";',
				'deuterium' => 'return   "0";',
                                'population' => 'return   "0";',
				'energy'    => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
		)
	);
	//Amélioration de la gestion des propultion pour ne pas ce faire chier a l'ajout d'un VX.
	$reslist['propVx']   =array(
		0=>array(202),
		1=>array(203,204,209,210,216,217,218,219,220,221,222),
		2=>array(205,206,208,223,224),
		3=>array(211),
		4=>array(217,213,214,215,226)
	);
	
	$messageColor		 =array(0=>'#F93',1=>'none',2=>'none',3=>'#F30',4=>'#5F9EA0',5=>'green',99=>'#033');
	$reslist['build']    = array (   1,   2,   3,   4, 12,  14,  15,  21,  22,  23,  24,  30,  31, 32,  33,  34,  36,  37,  39,  10, 41,  42,  43, 44,51);
	$reslist['tech']     = array ( 106, 108, 109, 110, 111,112, 113, 114, 115, 117, 118, 120, 121, 122, 123, 124, 125, 199);
	$reslist['casern']   = array ( 801, 802, 803);
	$reslist['fleet']    = array ( 202, 203,204, 208, 209, 210, 211, 212, 213, 214, 215,216,217,218,219,220,221,222,223,224,225,226 );
	$reslist['defense']  = array ( 401, 402, 403, 404, 405, 406, 407, 408, 502, 503 );
	$reslist['officier'] = array ( 601, 602, 603, 604);
	
	$reslist['prod']     = array (   1,   2,   3,   4,  12, 212,204 );

    $nameList['first']['h']['human'] = "John Brian Peter Adam James William Jacob Christopher Joshua Michael Ethan Joseph Matthew Anthony Daniel Ryan Samuel Kevin David Logan Carter Benjamin Andrew Henry Nicholas Gavin Owen Jack Wyatt Wayne Walter Charles Louis Merritt Earl Alfred Vernon Edward Donald George Paul Greg Thomas Robert Gene Glen Hugh Ronald Francis Stephen Jon Richard Mark Marcus Scott Duncan Douglas Keith Howard Russell Clayton Lee Steve Tom Clay Oliver Kenneth Ralph Andy Tony Tyrone Lawrence Patrick Harry Alan Eugene Frank Craig Jason Martin Jonathan Harrison Connor Gaylord Sean Cooper Stanley Calhoun Neil Jeffrey Harold Raymond Fred Marshall Silas Roy Jesse Ken Bruce Norris Horatio Clarence Lloyd Duane Mortimer Ben Ernest Warren Graham Marvin Orson Dennis Jackson Dwight Harlan Arthur Percival Montgomery Clyde Rodney Gerald Franklin Jake Horace Irving Seth Randolph Floyd Carl  Brent Cliff Malcolm Timothy Wallace Pierce Edmund Gary Tony Nathan Eric Albert Robin Geoffrey Larry Ian Leonard Gordon Derek Maxwell Alec Bernard Stuart Rupert Dean Philip Ross Colin Darren Melvin Justin Zack Elliot Simon Morgan Clark Xavier Jared Edgar Crispin Nelson Emmett Trevor Travis Lance Adrian Desmond Brendan Brett Ambrose Basil Kieran Conan Dermot Dudley Felix Finn Oscar Sidney Aaron Vincent Angus Grant Luke Miles Morton Randall Reginald Herbert Wesley Nigel Alexander Dominic Bradley Liam Dirk Vance Kyle Chester Alexander Vladimir Boris Tiberius Theobald Valerian Maximus Lucius Ivan Nikolai Boris Vladimir Pyotr Alexei Dmitri Sergei Viktor Roman Igor Mikhail Vasily Pavel Fyodor Nikita Valery Vladislav Leonid Maxim Yuri Oleg Andrei Konstantin Vyacheslav Aleksandr Stanislav Anatoli Miroslav Artyom Bogdan Branislav Ilya Jaroslav Radomir Kirill Radoslav Lubomir Ratimir Yegor An Bao Bo Cai Cheng De Dong Feng Gang Guo Hu Hui Jian Jie Kang Li Liang Long Meng Ning Peng Qiang Shi Song Tao Tian Wei  You Yong Yi Xiong Wu Karl Wilhelm Otto Heinrich Friedrich Paul Hans Gustav Max Ernst Hermann Walter Werner Günther Wolfgang Helmuth Kurt Rolf Peter Klaus Gerhard Heinz Horst Manfred Uwe Jürgen Dieter Andreas Thomas Stefan Lukas Felix Martin Fritz Johann Erich Arnold Bruno Franz Rudolf Erhard Jörg Axel Emil Gerhardt Gottfried Holger Joachim Konrad Lothar Ludwig Matthias Moritz Reinhard Sigismund Ulrich Udo Philippe Pierre Jean-Marie Marcel Francois Hubert Paul Antoine Michel Henri Marc Jean Maurice René Claude Yves Jacques Simon Olivier Joseph Robert Georges André Raymond Gaston Charles Thierry Guy Patrice Mathieu Jean-Francois Lucien Jean-Paul Daniel Thibault Luc Dominic Sébastien Hugo Hiroto Hikaru Takumi Tsubasa Ren Minato Shota Yuuto Sota Yuma Takeru Rikuto Tatsuki Ryuto Haru Yushin Kosei Yoshinobu Jiro Hiroshi Yoshida Mitsue Keisuke Saburo Junichi Yoshi Koshiro Kentaro Koichiro Aarav Vivaan Aditya Arjun Reyansh Arnav Krishna Ishaan Shaurya Atharv Advik Pranav Advaith Dhruv Kabir Ritvik Aarush Kayaan Darsh Veer Rahul Mahesh Shyam Raj Kumar Palash Rakesh Nishant Neeraj Prathamesh Shubham Diego Luis Pedro Joaquin José Emilio Eduardo Alejandro Carlos Fernando Francisco Julio Juan Ignacio Manuel Pablo Miguel Ramón Raimundo Santiago Ricardo Marcelo Javier Gaspar Alfonso Lorenzo Enrique Ernesto Gerardo Guillermo Jesús Salvadore Sergio Roberto Esteban Abdullah Abbas Abed Ahmad Ahmed Ali Ammar Amir Hamza Hassan Hydar Ibrahim Jamal Kareem Khathem Khalil Khalid Malik Mahdi  Hussein Mohamed Mohammad Mohammed Muhammad Muhammed Nasir Omar Rashad Rashid Samir Tariq Yahir Yasin Yusuf Barak Faraji Imamu Jelani Jengo Jumaane Khamisi Kibwe Mosi Mwenye Sefu Simba Tendaji Zuberi Abasi Annan Azizi Badru Bakari Bwana Chane Chuma Enzi Faraji Hanisi Idi Issa Jabari Akani Aluwanip Ayanda Bambanani Bheka Bhekithemba Bhekizizwe Butholezwe Dikotsi  Dzingai Esaia Hangwani Humbe Kabelo Khathu Khumbu Kutlwano Kwanele Lentswe Lesebo Letswalo Lutendo Mahlubandile Makalo Mareka  Masingita Moeketsi Molapo Mosemotsane Motlalentwa Mothusi Msizi Mzwamadoda Nthofeela Oagile Paseka Phahamo Poloko Qukeza Refilwe  Sanele S'bu Sehlolo Sekgolokhane Sibusiso Sizwe Teboho Thabiso Themba Thuso Tsebo T'sehla Tshawe Unathi Wandile Mbutu Kofi Mario Luigi Giovanni Guiseppe Antonio Roberto Andrea Stefano Marco Franscesco Angelo Vincenzo Pietro Salvatore Carlo Franco Domenico Bruno Paulo Michele Giorgio Sergio Luciano Alessandro Alfonso Benito Fabrizio Cesare Enrico Gustavo Silvio Umberto Nicola Matteo Ignazio Camillo Daniele Cristian Alberto Guido Lorenzo Tommaso Fabio";
	$nameList['first']['f']['human'] = "Olivia Emily Sophie Jessica Alice Scarlett Emma Daisy Eve Phoebe Sienna Anna Mary Megan Elizabeth Amy Darcy Matilda Erin Lucy Grace Evelyn Amber Harriet Caitlyn Jasmine Madison Kate Eleanor Alexandra Sarah Martha Bethany Rebecca Victoria Gabriella Naomi Lauren Clara Laura Kayla Nicole Skye Eliza Patricia Linda Barbara Jennifer Maria Susan Margaret Dorothy Lisa Nancy Helen Sandra Donna Carol Ruth Sharon Michelle Kimberly Deborah Amelia Charlotte Isabella Ruby Addison Alyssa Abigail Julia Samantha Brooklyn Ashley Natalie Brianna Chloe Hailey Lillian Judith Alison Amanda Angela Audrey Beatrice Brenda Bridget Caroline Cassandra Charity Cecilia Anne Clarissa Christabel Cheryl Cynthia Cadence Cordelia Daphne Deanna Denise Dolores Doreen Drusilia Edith Edna Eleonor Eileen Edwina Ellen Estelle Ethel Felicity Fiona Genevieve Gertie Gwen Gwendolyn Henrietta Imogen Iris Imelda Jacqueline Jane Jenna Joanna Josephine Julianne Kathleen Kierra Kaylee Leah Lois Loretta Lorna Louisa Lynnette Lucinda Mabel Marcia Marilyn Marissa Marjorie Maud Melanie Myrna Mavis Nadine Paula Penelope Philippa Priscilla Rhonda Rita Roberta Rosamund Rosemary Roxanne Sabrina Selma Selina Sibyl Suzanne Tara Tabitha Thelma Teresa Tiffany Vanessa Vivian Melissa Wanda Wendy Winifred Victoria Yvette Vera Zelda Joan Pamela Sherry Adrienne Monica Irene Heather Lindsay Gillian Kristen Odette Felicia Christina Candace Arlene Tisha Majel Fran Doris Julie Courtney Shelly Frances Mandy Mindy Rachel Miranda Virginia Gina Karla Tricia Diane Phyllis Sally Elaine Kara Shannon Susie Elle Gail Ann Kathryn Tina Carrie Miriam Vivica Tamara Judy Willow Hilary Claire Danielle Teri Jackie Kelly Bonnie Holly Janice Brittney Bianca Stephanie Natasha Lydia Mona Meredith Lynda Erica Heidi Paige Carmen Hayden Mallory Mercedes Marion Winona Jill Molly Constance Jenny Penny Meryl Jodie Veronica April Sigourney Jillian Honor Theodora Fatima Miranda Cordelia Svetlana Anastasia Valentina Henrietta Anna Yelena Olga Oksana Tatyana Svetlana Nadya Yekaterina Irina Galina Miroslava Anastasia Vera Polina Lyudmila Elena Marina Darya Irma Ksenia Alexandra Nadesja Valentina Arina Alya Galenka Katya Ljuba Radmila Natacha Vlada Nadezhda Tatiana Sonia Mira Ai Bi Cui Chan Dai Dan Fang Hong Hua Huan Jiao Ju Juan Lan Lian Lin Mei Na Ni Qian Qiao Qing Shan Shu Ting Wen Xia Xian Xiang Xiu Xue Yan Ying Yu Yuan Yun Zhen Zhi Zhu Zi Anna Elsa Emma Helga Ursula Gisela Ingrid Ilse Jessika Sandra Stefanie Andrea Anja Katrin Birgit Martina Heike Sabine Erika Edith Lena Lisa Katharina Claudia Silvia Tina Annike Renate Bettina Wibke Sara Lina Julia Marith Heidi Angelika Christel Gretchen Hilde Hildegard Gertrude Wilhelmina Lisbeth Kerstin Johanna Anita Chloe Inés Manon Camille Clara Juliette Clémence Jeanne Charlotte Marie Nina Julia Elise Justine Yasmine Elina Andrea Eleonore Clarisse Fanny Selma Leila Veronique Sophie Helena Daphne Suzanne Melanie Bernadette Maud Angeline Celine Jessica Pauline Viviane Jeanette Haruna Sakura Misaki Aoi Mihane Miyu Rin Nanami Yui Hina Honoka Riko Yuna Koharu Hinata Mei Saki Ichika Hiyori Yusuki Shiori Natsuki Ayane Kaho Hana Momoka Himari Yume Aomame Noriko Kazumi Kimiko Saanvi Aanya Aadhya Aaradhya Ananya Pari Anika Navya Diya Avani Myra Ira Aahana Anvi Prisha Riya Aarohi Anaya Akshara Shanaya Kyra Siya Priyanka Divya Mahima Shivangi Juvina Anoushka Anushri Apoorva Sanjana Hortensia Isabel Valentina Alejandra Alicia Antonia Carla Carmen Catalina Dolores Estefania Eva Fernanda Florencia  Gabriela Grizelda Maria Lorena Magdalena Mercedes Miriam Paulina Sofia Yolanda Camila Luciana Valeria Mariana Daniela Martina Julieta Antonella Renata Agustina Constanza Fabiana Alma Amani Amira Aisha Fatima Hala Hana Hasti Imani Jana Jaliyah Jazmin Jenna Kaliyah Layan Leen Leila Lydia Malak Maryam  Maritza Mina Naima Noor Salma Samira Sanaa Yesenia Zahra Satayesh Zeinab Reihaneh Mobina Narges Ma'soumeh Sakineh Aya Asha Abla Adhra Adila Aeeshah Afiya Chausiku Eshe Furaha Imani Kamaria Marjani Mchumba Mwanajuma Nia Nuru Sanaa Sauda Subira  Zuri Aizivaishe Anatswanashe Anodiwa Anokosha Awande Bokang Bongani Dikeledi Edzai Fikile Gugu Kagiso Keneuwe Koketso Langalibalele Lerato Lindidwe Litsoanelo Lulama Majobo Maletsatsi Matshediso Mbali Mmaabo Mncedisi Mohau Moratuoa Muambiwa Nnyadzeni Nofoto Nthati Ntsebo Ntswaki Phathu Reneilwe Rudzani Shandu Sinethemba Sizani Thanduxolo Tshanduko Tungu Zinhle Maria Anna Guiseppina Rosa Angela Giovanna Teresa Lucia Carmela Caterina Francesca Antonietta Carla Elena Concetta Rita Margherita Franca Paola Vittoria Arianna Orietta Nicoletta Clara Stefania Gisella Claudia Lorenza Gabriella Isabella Valeria Lucrezia Dina Benedetta Pietra";
	$nameList['last']['human'] = "Smith Jones Williams Taylor Brown Davies Evans Wilson Johnson Robinson Wright Thompson Evans Walker White Roberts Green Hall Wood Jackson Clark Lewis Mason Mitchell Cox Campbell Stewart Quinn Murphy Hamilton Moore Murray McLaughlin Martin O'Neill Anderson Scott MacDonald Reid Ross Watson Patterson Morrison Sanders Harris Hughes Driscoll Price Jenkins Morgan Moss Sinclair Simpson Zimmerman Young York Youngfellow Winters Worley Woodard Whitley Wheeler Wentworth West Weaver Webb Welsh Sparks Spencer Stafford Stanley Steel Sterling Stevens Stone Stewart Sullivan Swanson Sweeney Swift Sykes Terrell Thornton Tipton Turner Tyler Underwood Vincent Voight Wade Washington Watts O'Connor O'Donnell O'Hara Owens Page Palmer Parker Perry Parson Paxton Payne Perkins Peters Pershing Phillips Pitt Potter Reynolds Reaves Reese Richardson Rivers Robbins Robertson Roswell Ryan Salinger Samuels Sandler Savage Saxton Schneider Scowley Sedgwick Shannon Flint Sibbett Silverman Silverstone Smart Snow Kruger Landau Lawrence Lawson Lee Leonard Little Lowell Michaels McGillis McKinnon McSwain McCoy McCarthy McCormick McCreary Marshall Lynch Miller Montgomery Morris Nash Newman Nichols North Masterson Mayfield McCall Hansen Harrington Hart Hendricks Holmes Higgins Hoffman Hood Hutchinson Hyland Knight Kirk King Kenway Kennedy Kelly Kane Nathanson Jennings Jacobs Jefferies Irwin Gilbert Glass Glover Goldberg Goldstein Goodman Goodwin Graham Grant Graves Gray Greenberg Gorney Griffin Halley Hunter Holloway Hoover Hutchins Hill Hines Holden Harvey Handler Cohen Collins Conrad Conroy Cook Conley Compton Cody Crouch Crosby Curtis Fields Farrell Felton Fisher Fleming Forrest Foster Fox Freeman Futterman Gardner Garrett Gates Garfield Gabriel Daniels Darling Easterbrook Edwards Edelstein Elliott Emerson Ericson Duncan Dickinson Alexander Allen Austin Bauer Bancroft Baker Bailey Banks Barks Bassett Brewster Brooks Breckenridge Booth Bloom Sherman Sheridan Billingsley Billings Bergman Bates Becker Bell Bellflower Bains Bean Cartwright Carpenter Buckland Burness Burnett Bush Butler French England Carroll Carter Cavanaugh Chaffin Chase Channing Chapman Arnold Fry Milton Sharp Durston Howell Mead Poole Ashton Brockbank Cooper Cursham Dixon Baxter Drake Garland Wells Hargreaves Houghton Haygarth Hurst Kingsford Lindsay Rawson Walden Walters Whitfield Bennett Cross Buxton Dyson McMillan Russell Scott Beauclerk Ward Howard Lloyd Tanner Nicholas Matthews Ellis Whyting Whittaker Barton Hawkins Garrovick Spector Reeves Vernon McNiven Rowley Sandford Fawcett Lockhart Lang Oliphant Wilkins Balfour Appleby Buchanan Yardley Shaw Stokes Allenby Cockburn Mundy Franklin Armstrong Chamberlain Powell Abbott Blair Burnside Schofield Farnsworth Ford Warner Porter Barksdale Polk Gibbons Archer Pickett Houston Whitfield Pearson Lucas Horner Bainbridge Rollins Casey Cochrane Merchant Bowden Douglas Muldoon Wickham Milligan Bradley Findley Spooner Harper Shepard Kingston Knox Colbeck Shields Burns Gibson Burton Crutchley Gilligan Bridges Richter Fowler Novak Longfield Seabrook Hazelton Kingsley Doggart Wilcox Hudson Hooks Hicks Cameron Hammond Knotts Jefferson Coffey Adams Babcock Baldwin Bannister Purcell Baumgartner Birch Blackwood Blake Bolander Bolton Brock Brannigan Burke Weyland Burrows Cairns Carlyle Carson Charlesworth Church Clancy Cullen Dufresne Bixby Featherstone Ferguson Foley Funk Gorman Haddock Grisdale Grimes Hoffmeyer Holt Ingram Kaiser Kearns Keeler Kellerman Kinnear Kurtz Kyle Laidlaw Lankshear Lessard Lowe MacKenzie MacNevin MacInnis Madigan Maloney Marsh McAllister McBain Myers Nicholson Olsen O'Malley Peacock Peckham Murdoch Prefontaine Pratt Popovic Pritchard Quackenbush Penebscott Pfaffenbach Ramsey Quincey Reilly Reinhart Renaud Rolston Shoebottom Skinner Sloan Snell Snider Sorensen Spiller Spurgeon Stanfield Stackhouse Stiles Sutherland Sutton Taggart Townsend Traynor Stark Strudwick MacArthur Barnes Atkins Ballard Biggs Baird Fredericks Humphry Colt Dillard Cunningham DeStefano Finks Fletcher Galloway Kirby Sutter Preston Tucker Kowalski Rabinowitz Feldman Katz Roykirk Decker Grishina Fedorov Komarov Pushkov Petrenko Shatalov Ivanov Kamensky Vasiliev Ulanov Volkov Gryaznov Dudnik Yerzov Zhirov Zhivenkov Kazakov Krutov Ivannikov Kolosov Kuzin Larionov Maksimushkin Markov Ostrovsky Polachev Rychenkov Romanov Sayanovich Statnik Sorokin Turgenev Titov Tvardovsky Antonov Skobelev Lazarev Makarov Dragomirov Alexseyev Liang Luo Kuang Lu Zheng Lin Xu Xie Wang Zhu Yang Mao Shen Hu Tan He Deng Wu Cheng Gao Wan Kong Pan Sima Zhuge Ouyang Situ Huang Zhao Zhang Müller Schmidt Schneider Fischer Weber Meyer Wagner Schulz Becker Hoffmann Bauer Brinkmann Brill Dietrich Erhard Grasser Dreyer Wolf Klein Richter Schäfer Neumann Braun Schwarz Krüger Stein Keller Schubert Baumann Ziegler Brandt Sauer Kreutz Bergmeister Andbert Martin Bernard Dubois Durand Leroy Moreau Lambert Dupont Leclerc Laurent Renard Tremblay Gagnon Roy Bouchard Gauthier Morin Lavoie Fortin Gagne Duval Hébert Deville Gerard Duchaine Jauvin Gilbert Bergeron Paquette Pelletier Rémy Giroud Bosquet Lebouef Péllissier Deveraux Sato Suzuki Takahashi Tanaka Watanabe Ito Nakamura Kobayashi Yamamoto Kato Yoshida Yamada Sasaki Yamaguchi Matsumoto Inoue Kimura Shimizu Hayashi Saito Yamazaki Nakajima Mori Abe Ikeda Hashimoto Ishikawa Yamashita Ogawa Ishii Hasegawa Goto Okada Fujita Sakamoto Murakami Nishimura Nakagawa Harada Okamoto Miura Takaya Amano Higuchi Ota Kumar Moorthi Shastri Prasad Acharya Swamy Pillai Gowda Nayak Desmukh Bhat Bhandary Poojary Upadhyay Chowta Naik Kulkarni Dodamani Patil Gupta Sharma Namboodiri Pannikar Potti Kutty Varma Sondharam Sooriyaprakash Chandran Vijay Venktaesan Puttappa Garcia Martinez Rodriguez Fernandez Sanchez Lopez Martin Perez Gonzalez Alvarez Gomez Diaz Dominguez Hernandez Ramirez Mendez Perez Vasquez Ruiz Aguera Alonso Batista Esguerra Flores Ibanez Moralez Riveros Rosario Velazco Torres Quesada Saldana Salazar Ortega Ortiz Solano Romero Barakat Abbas Abboud al-Ahdal al-Ajlani al-Bariqi al-Mubarak Adwam Akkad Alawi al-Asiri al-Atrash al-Dimashqi Bakir Hussein al-Hazmi al-Bishi El-Baz Ibrahim Ishak Ismail El-Farouk Hassan El-Ghazali Bilal Nadir Juhani Jawahir Hamidi al-Jazari al-Samarrai Salman Qasim Qudsi Qaderi al-Qadi Farrokhzad Madani Sassani Turani Khadem Ghorbani Jamshidi Rahimi Azikiwe Awolowo Balewa Akintola Nzeogwu Onwuatuegwu Okeke Okonkwo Babangida Buhari Dimka Ibori Jomo-Gbomo Iwu Bamgboshe Biobaku Tinibu Akinjide Akiloye Adeyemi Sekibo Bankole Nnamani Okadigbo Ironsi Ojukwu Chukwumereije Iweala Okonjo Gbadamosi Olanrewaju Madaki Oyinlola Onyejekwe Jakande Ngige Uba Ohakim Alakija Onobanjo Mbanefo Mbadinuju Ekwensi Gowon Saro-Wiwa Naidoo Swanepoel  Msibi Ngobese Ngema Masuku Khonjwayo Khumalo Kwayi Mambi Mbanjwa Mkhwemte Mtakwenda Ngwanya Nkwali Thwane Skhosana Tshangisa  Tshonyane Xhamela Xoko Zangwa Ndungwane Bhukhwana Dzana Gatyeni Gxarha Jwarha Khawuta Rossi Russo Ferrari Bianchi Ricci Marino Costa Giordano Mancini Rizzo Lombardi Moretti Ravelli Conti Gallo Bello Albricci Badoglio Cappello Garibaldi Saletta Pallavicino Pianelli Mambretti Marcuzzi Valeri Pezzaglia Balletti Bianconelli Antonelli Corsini D'Alessandro D'Agostino Delvecchio D'Antoni Fazio Fabbrini Gambadori Galvani Marchetti Mazzitelli Olivieri Pacini Quadrini";
	
	$transportable['chasseur'] = array(216,217,218,219,220,221,222,223,224);
        //$transportable['troupes'] = array(216,217,218,219,220,221,222,223,224);
        
        
        
        //Les items disponible dans le jeu qui on des actions si possédé!
        $itemDb['energie']  =   array(0=>1,1=>2);
        
        $itemDb['name']  = array(1=>"Generateur V1",2=>"Generateur V2"); ;
        $itemDb['noBuildable'] = array(51);
        $itemDb['production']=array();
        $itemDb['production']['energie'][1] = array('production'=>150);
        $itemDb['production']['energie'][2] = array('production'=>300);
}
?>