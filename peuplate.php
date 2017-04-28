<?php
ini_set('memory_limit', '1024M');
//mysql_connect('localhost','spaceg','lolita1122');
//mysql_select_db('spaceg');
$array_secteur = array(1 =>array('x'=>array(0,100),  'y'=>array(0,100),'density_min'=>60,'density_max'=>180),
		       2 =>array('x'=>array(101,200),'y'=>array(0,100),'density_min'=>70,'density_max'=>190),
		       3 =>array('x'=>array(201,300),'y'=>array(0,100),'density_min'=>100,'density_max'=>220),
    
		       4 =>array('x'=>array(0,100),'y'=>array(101,200),'density_min'=>110,'density_max'=>230),
		       5 =>array('x'=>array(101,200),'y'=>array(101,200),'density_min'=>120,'density_max'=>240),
		       6 =>array('x'=>array(201,300),'y'=>array(101,200),'density_min'=>110,'density_max'=>230),
					   //7 =>array('x'=>array(601,700),'y'=>array(0,100),'density_min'=>100,'density_max'=>220),
					   //8 =>array('x'=>array(701,800),'y'=>array(0,100),'density_min'=>60,'density_max'=>190),
					   //9 =>array('x'=>array(801,900),'y'=>array(0,100),'density_min'=>70,'density_max'=>180),
					   //
					   //10=>array('x'=>array(0,100),  'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //11=>array('x'=>array(101,200),'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //12=>array('x'=>array(201,300),'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //13=>array('x'=>array(301,400),'y'=>array(101,200),'density_min'=>130,'density_max'=>240),
					   //14=>array('x'=>array(401,500),'y'=>array(101,200),'density_min'=>140,'density_max'=>250),
					   //15=>array('x'=>array(501,600),'y'=>array(101,200),'density_min'=>130,'density_max'=>240),
					   //16=>array('x'=>array(601,700),'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //17=>array('x'=>array(701,800),'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //18=>array('x'=>array(801,900),'y'=>array(101,200),'density_min'=>120,'density_max'=>230),
					   //
					   //19=>array('x'=>array(0,100),  'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //20=>array('x'=>array(101,200),'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //21=>array('x'=>array(201,300),'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //22=>array('x'=>array(301,400),'y'=>array(201,300),'density_min'=>160,'density_max'=>280),
					   //23=>array('x'=>array(401,500),'y'=>array(201,300),'density_min'=>180,'density_max'=>300),
					   //24=>array('x'=>array(501,600),'y'=>array(201,300),'density_min'=>160,'density_max'=>280),
					   //25=>array('x'=>array(601,700),'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //26=>array('x'=>array(701,800),'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //27=>array('x'=>array(801,900),'y'=>array(201,300),'density_min'=>140,'density_max'=>260),
					   //
					   //28=>array('x'=>array(0,100),  'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //29=>array('x'=>array(101,200),'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //30=>array('x'=>array(201,300),'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //31=>array('x'=>array(301,400),'y'=>array(301,400),'density_min'=>130,'density_max'=>240),
					   //32=>array('x'=>array(401,500),'y'=>array(301,400),'density_min'=>140,'density_max'=>250),
					   //33=>array('x'=>array(501,600),'y'=>array(301,400),'density_min'=>130,'density_max'=>240),
					   //34=>array('x'=>array(601,700),'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //35=>array('x'=>array(701,800),'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //36=>array('x'=>array(801,900),'y'=>array(301,400),'density_min'=>120,'density_max'=>230),
					   //
					   //37=>array('x'=>array(0,100),  'y'=>array(401,500),'density_min'=>60,'density_max'=>180),
					   //38=>array('x'=>array(101,200),'y'=>array(401,500),'density_min'=>70,'density_max'=>190),
					   //39=>array('x'=>array(201,300),'y'=>array(401,500),'density_min'=>100,'density_max'=>210),
					   //40=>array('x'=>array(301,400),'y'=>array(401,500),'density_min'=>110,'density_max'=>220),
					   //41=>array('x'=>array(401,500),'y'=>array(401,500),'density_min'=>120,'density_max'=>240),
					   //42=>array('x'=>array(501,600),'y'=>array(401,500),'density_min'=>110,'density_max'=>220),
			           //43=>array('x'=>array(601,700),'y'=>array(401,500),'density_min'=>100,'density_max'=>210),
					   //44=>array('x'=>array(701,800),'y'=>array(401,500),'density_min'=>70,'density_max'=>190),
					   //45=>array('x'=>array(801,900),'y'=>array(401,500),'density_min'=>60,'density_max'=>180),
					   );
$array_soleil = array(1=> array(0=>array('label'=>'Naine blanche','pourcent'=>30,'modif_temp'=>-30,'img'=>array('naineblanche1','naineblanche2','naineblanche3','naineblanche4','naineblanche5','naineblanche6')),
							    1=>array('label'=>'Naine jaune','pourcent'=>120,'modif_temp'=>0,'img'=>array('nainejaune1','nainejaune2','nainejaune3','nainejaune4','nainejaune5','nainejaune6','nainejaune7')),
							    2=>array('label'=>'Naine rouge','pourcent'=>600,'modif_temp'=>-10,'img'=>array('nainerouge1','nainerouge2','nainerouge3','nainerouge4')),
							    3=>array('label'=>'Naine brune','pourcent'=>30,'modif_temp'=>-20,'img'=>array('nainebrune1','nainebrune2','nainebrune3','nainebrune4')),
							    4=>array('label'=>'Naine noire','pourcent'=>30,'modif_temp'=>-40,'img'=>array('nainenoire1','nainenoire2','nainenoire3')),
							    5=>array('label'=>'Geante rouge','pourcent'=>90,'modif_temp'=>20,'img'=>array('geanterouge1','geanterouge2','geanterouge3')),
							    6=>array('label'=>'Geante bleu','pourcent'=>30,'modif_temp'=>60,'img'=>array('geantebleu1','geantebleu2','geantebleu3','geantebleu4','geantebleu5')),
							    7=>array('label'=>'Supergeante rouge','pourcent'=>40,'modif_temp'=>50,'img'=>array('supergeanterouge1','supergeanterouge2')),
							    8=>array('label'=>'Etoile a neutron','pourcent'=>20,'modif_temp'=>30,'img'=>array('neutron1','neutron2','neutron3','neutron4')),
							    9=>array('label'=>'Trou noir','pourcent'=>20,'modif_temp'=>-60,'img'=>array('trounoir1','trounoir2','trounoir3','trounoir4','trounoir5'))),
					  2=> array(0=>array('label'=>'Naine blanche','pourcent'=>40),
							    1=>array('label'=>'Naine jaune','pourcent'=>160),
								2=>array('label'=>'Naine rouge','pourcent'=>700),
								3=>array('label'=>'Naine brune','pourcent'=>40),
								4=>array('label'=>'Naine noire','pourcent'=>40),
								5=>array('label'=>'Geante rouge','pourcent'=>10),
								6=>array('label'=>'Geante bleu','pourcent'=>10)));
$array_planete =  array(0=>array('label'=>'Telurique',						'pourcent'=>array(0=>75,1=>10,2=>6, 3=>5 ,4=>10),'classe'=>array('H1','H2','H3','H4','H5')),
						1=>array('label'=>'Jovienne',						'pourcent'=>array(0=>10,1=>6 ,2=>10,3=>45,4=>35),'classe'=>array('B1','B2','B3','B4','B5')),
						2=>array('label'=>'Habitable',						'pourcent'=>array(0=>5,	1=>72,2=>75,3=>30,4=>5)	,'classe'=>array('C1','C2','C3','C4','C5')),
						3=>array('label'=>'Nuange de gaz',					'pourcent'=>array(0=>0,	1=>2 ,2=>5, 3=>10,4=>20),'classe'=>array('X1','X2','X3','X4','X5')),
						4=>array('label'=>'Champ d\'asteroide metalique',	'pourcent'=>array(0=>5,	1=>5 ,2=>2, 3=>5 ,4=>15),'classe'=>array('Z1','Z2','Z3','Z4','Z5')),
						5=>array('label'=>'Champ d\'asteroide alcalin',		'pourcent'=>array(0=>5,	1=>5 ,2=>2, 3=>5 ,4=>15),'classe'=>array('Z1','Z2','Z3','Z4','Z5')));		  
						
$array_temp = array(0=> array('temp_min'=>260,'temp_max'=>300,  'taille_min'=>95, 'taille_max'=>108	,'dist_min'=>30		,'dist_max'=>34),//trés proche
					1=> array('temp_min'=>230,'temp_max'=>270,  'taille_min'=>97, 'taille_max'=>110	,'dist_min'=>35		,'dist_max'=>40),//trés proche
					2=> array('temp_min'=>220,'temp_max'=>260,  'taille_min'=>98, 'taille_max'=>137	,'dist_min'=>41		,'dist_max'=>45),//trés proche
					3=> array('temp_min'=>210,'temp_max'=>250,  'taille_min'=>107,'taille_max'=>147	,'dist_min'=>46		,'dist_max'=>50),//trés proche
					4=> array('temp_min'=>160,'temp_max'=>200,  'taille_min'=>108,'taille_max'=>149	,'dist_min'=>51		,'dist_max'=>55),//trés proche
					5=> array('temp_min'=>150,'temp_max'=>190,  'taille_min'=>110,'taille_max'=>154	,'dist_min'=>75		,'dist_max'=>80),//proche
					6=> array('temp_min'=>140,'temp_max'=>180,  'taille_min'=>112,'taille_max'=>157	,'dist_min'=>85		,'dist_max'=>90),//proche
					7=> array('temp_min'=>130,'temp_max'=>170,  'taille_min'=>115,'taille_max'=>159	,'dist_min'=>91		,'dist_max'=>100),//proche
					8=> array('temp_min'=>120,'temp_max'=>160,  'taille_min'=>116,'taille_max'=>166	,'dist_min'=>101	,'dist_max'=>110),//proche
					9=> array('temp_min'=>100,'temp_max'=>140,  'taille_min'=>118,'taille_max'=>170	,'dist_min'=>111	,'dist_max'=>115),//proche
					10=>array('temp_min'=>80,'temp_max'=>120,   'taille_min'=>121,'taille_max'=>198	,'dist_min'=>121	,'dist_max'=>125),//Medium
					11=>array('temp_min'=>50,'temp_max'=>90,    'taille_min'=>123,'taille_max'=>212	,'dist_min'=>126	,'dist_max'=>130),//Medium
					12=>array('temp_min'=>40,'temp_max'=>80,    'taille_min'=>129,'taille_max'=>249	,'dist_min'=>131	,'dist_max'=>135),//Medium
					13=>array('temp_min'=>30,'temp_max'=>70,    'taille_min'=>147,'taille_max'=>256	,'dist_min'=>136	,'dist_max'=>140),//Medium
					14=>array('temp_min'=>20,'temp_max'=>60,    'taille_min'=>167,'taille_max'=>237	,'dist_min'=>141	,'dist_max'=>150),//Medium
					15=>array('temp_min'=>-10,'temp_max'=>30,   'taille_min'=>182,'taille_max'=>348	,'dist_min'=>151	,'dist_max'=>160),//Medium
					16=>array('temp_min'=>-20,'temp_max'=>20,   'taille_min'=>179,'taille_max'=>325	,'dist_min'=>161	,'dist_max'=>180),//Medium
					17=>array('temp_min'=>-30,'temp_max'=>10,   'taille_min'=>154,'taille_max'=>297	,'dist_min'=>181	,'dist_max'=>210),//Medium
					18=>array('temp_min'=>-40,'temp_max'=>0,    'taille_min'=>142,'taille_max'=>223	,'dist_min'=>211	,'dist_max'=>240),//Medium
					19=>array('temp_min'=>-50,'temp_max'=>-10,  'taille_min'=>131,'taille_max'=>330	,'dist_min'=>241	,'dist_max'=>300),//Medium
					20=>array('temp_min'=>-70,'temp_max'=>-30,  'taille_min'=>125,'taille_max'=>412	,'dist_min'=>350	,'dist_max'=>420),//eloigné
					21=>array('temp_min'=>-90,'temp_max'=>-50,  'taille_min'=>162,'taille_max'=>437	,'dist_min'=>421	,'dist_max'=>510),//eloigné
					22=>array('temp_min'=>-100,'temp_max'=>-60, 'taille_min'=>179,'taille_max'=>412	,'dist_min'=>520	,'dist_max'=>630),//eloigné
					23=>array('temp_min'=>-110,'temp_max'=>-70, 'taille_min'=>212,'taille_max'=>348	,'dist_min'=>650	,'dist_max'=>750),//eloigné
					24=>array('temp_min'=>-120,'temp_max'=>-80, 'taille_min'=>179,'taille_max'=>239	,'dist_min'=>760	,'dist_max'=>890),//eloigné
					25=>array('temp_min'=>-130,'temp_max'=>-90, 'taille_min'=>112,'taille_max'=>214	,'dist_min'=>1060	,'dist_max'=>1270),//Trés éloigné
					26=>array('temp_min'=>-140,'temp_max'=>-100,'taille_min'=>97, 'taille_max'=>195	,'dist_min'=>1311	,'dist_max'=>1589),//Trés éloigné
					27=>array('temp_min'=>-150,'temp_max'=>-110,'taille_min'=>81, 'taille_max'=>167	,'dist_min'=>1645	,'dist_max'=>1926),//Trés éloigné
					28=>array('temp_min'=>-160,'temp_max'=>-120,'taille_min'=>64, 'taille_max'=>149	,'dist_min'=>2301	,'dist_max'=>2915),//Trés éloigné
					29=>array('temp_min'=>-170,'temp_max'=>-130,'taille_min'=>41, 'taille_max'=>121	,'dist_min'=>3000	,'dist_max'=>4000));//Trés éloigné);

$array_temp_hab = array(0=> array('temp_min'=>40,'temp_max'=>80,  'taille_min'=>95, 'taille_max'=>108	,'dist_min'=>30		,'dist_max'=>34),//trés proche
					    1=> array('temp_min'=>40,'temp_max'=>85,  'taille_min'=>97, 'taille_max'=>110	,'dist_min'=>35		,'dist_max'=>40),//trés proche
					    2=> array('temp_min'=>35,'temp_max'=>70,  'taille_min'=>98, 'taille_max'=>137	,'dist_min'=>41		,'dist_max'=>45),//trés proche
					    3=> array('temp_min'=>35,'temp_max'=>75,  'taille_min'=>107,'taille_max'=>147	,'dist_min'=>46		,'dist_max'=>50),//trés proche
					    4=> array('temp_min'=>30,'temp_max'=>65,  'taille_min'=>108,'taille_max'=>149	,'dist_min'=>51		,'dist_max'=>55),//trés proche
					    5=> array('temp_min'=>30,'temp_max'=>60,  'taille_min'=>110,'taille_max'=>154	,'dist_min'=>75		,'dist_max'=>80),//proche
					    6=> array('temp_min'=>25,'temp_max'=>60,  'taille_min'=>112,'taille_max'=>157	,'dist_min'=>85		,'dist_max'=>90),//proche
					    7=> array('temp_min'=>25,'temp_max'=>55,  'taille_min'=>115,'taille_max'=>159	,'dist_min'=>91		,'dist_max'=>100),//proche
					    8=> array('temp_min'=>20,'temp_max'=>55,  'taille_min'=>116,'taille_max'=>166	,'dist_min'=>101	,'dist_max'=>110),//proche
					    9=> array('temp_min'=>20,'temp_max'=>50,  'taille_min'=>118,'taille_max'=>170	,'dist_min'=>111	,'dist_max'=>115),//proche
					    10=>array('temp_min'=>15,'temp_max'=>45,   'taille_min'=>121,'taille_max'=>198	,'dist_min'=>121	,'dist_max'=>125),//Medium
					    11=>array('temp_min'=>15,'temp_max'=>45,    'taille_min'=>123,'taille_max'=>212	,'dist_min'=>126	,'dist_max'=>130),//Medium
					    12=>array('temp_min'=>10,'temp_max'=>40,    'taille_min'=>129,'taille_max'=>249	,'dist_min'=>131	,'dist_max'=>135),//Medium
					    13=>array('temp_min'=>10,'temp_max'=>40,    'taille_min'=>147,'taille_max'=>256	,'dist_min'=>136	,'dist_max'=>140),//Medium
					    14=>array('temp_min'=>5,'temp_max'=>35,    'taille_min'=>167,'taille_max'=>237	,'dist_min'=>141	,'dist_max'=>150),//Medium
					    15=>array('temp_min'=>5,'temp_max'=>35,   'taille_min'=>182,'taille_max'=>348	,'dist_min'=>151	,'dist_max'=>160),//Medium
					    16=>array('temp_min'=>0,'temp_max'=>30,   'taille_min'=>179,'taille_max'=>325	,'dist_min'=>161	,'dist_max'=>180),//Medium
					    17=>array('temp_min'=>0,'temp_max'=>30,   'taille_min'=>154,'taille_max'=>297	,'dist_min'=>181	,'dist_max'=>210),//Medium
					    18=>array('temp_min'=>-5,'temp_max'=>25,    'taille_min'=>142,'taille_max'=>223	,'dist_min'=>211	,'dist_max'=>240),//Medium
					    19=>array('temp_min'=>-5,'temp_max'=>20,  'taille_min'=>131,'taille_max'=>330	,'dist_min'=>241	,'dist_max'=>300),//Medium
					    20=>array('temp_min'=>-10,'temp_max'=>15,  'taille_min'=>125,'taille_max'=>412	,'dist_min'=>350	,'dist_max'=>420),//eloigné
					    21=>array('temp_min'=>-15,'temp_max'=>10,  'taille_min'=>162,'taille_max'=>437	,'dist_min'=>421	,'dist_max'=>510),//eloigné
					    22=>array('temp_min'=>-20,'temp_max'=>5, 'taille_min'=>179,'taille_max'=>412	,'dist_min'=>520	,'dist_max'=>630),//eloigné
					    23=>array('temp_min'=>-25,'temp_max'=>0, 'taille_min'=>212,'taille_max'=>348	,'dist_min'=>650	,'dist_max'=>750),//eloigné
					    24=>array('temp_min'=>-30,'temp_max'=>-10, 'taille_min'=>179,'taille_max'=>239	,'dist_min'=>760	,'dist_max'=>890),//eloigné
					    25=>array('temp_min'=>-40,'temp_max'=>-15, 'taille_min'=>112,'taille_max'=>214	,'dist_min'=>1060	,'dist_max'=>1270),//Trés éloigné
					    26=>array('temp_min'=>-50,'temp_max'=>-20,'taille_min'=>97, 'taille_max'=>195	,'dist_min'=>1311	,'dist_max'=>1589),//Trés éloigné
					    27=>array('temp_min'=>-60,'temp_max'=>-25,'taille_min'=>81, 'taille_max'=>167	,'dist_min'=>1645	,'dist_max'=>1926),//Trés éloigné
					    28=>array('temp_min'=>-70,'temp_max'=>-30,'taille_min'=>64, 'taille_max'=>149	,'dist_min'=>2301	,'dist_max'=>2915),//Trés éloigné
					    29=>array('temp_min'=>-80,'temp_max'=>-35,'taille_min'=>41, 'taille_max'=>121	,'dist_min'=>3000	,'dist_max'=>4000));//Trés éloigné);
								
$img = array(   0=>'normaltempplanet01',
                1=>'normaltempplanet02',
                2=>'normaltempplanet03',
                3=>'normaltempplanet04',
                4=>'normaltempplanet05',
                5=>'normaltempplanet06',
                6=>'normaltempplanet07',
                7=>'trockenplanet01',
                8=>'trockenplanet02',
                9=>'trockenplanet03',
                10=>'trockenplanet04',
                11=>'trockenplanet05',
                12=>'trockenplanet06',
                13=>'trockenplanet07',
                14=>'trockenplanet08',
                15=>'trockenplanet09',
                16=>'trockenplanet10',
                17=>'wasserplanet01',
                18=>'wasserplanet02',
                19=>'wasserplanet03',
                20=>'wasserplanet04',
                21=>'wasserplanet05',
                22=>'wasserplanet06',
                23=>'wasserplanet07',
                24=>'wasserplanet08',
                25=>'wasserplanet09',
                26=>'wuestenplanet01',
                27=>'wuestenplanet02',
                28=>'wuestenplanet03',
                29=>'wuestenplanet04',
                30=>'gasplanet01',
                31=>'gasplanet02',
                32=>'gasplanet03',
                33=>'gasplanet04',
                34=>'gasplanet05',
                35=>'gasplanet06',
                36=>'gasplanet07',
                37=>'gasplanet08',
                38=>'eisplanet01',
                39=>'eisplanet02',
                40=>'eisplanet03',
                41=>'eisplanet04',
                42=>'eisplanet05',
                43=>'eisplanet06',
                44=>'eisplanet07',
                45=>'eisplanet08',
                46=>'eisplanet09',
                47=>'eisplanet10',
                48=>'dschjungelplanet01',
                49=>'dschjungelplanet02',
                50=>'dschjungelplanet03',
                51=>'dschjungelplanet04',
                52=>'dschjungelplanet05',
                53=>'dschjungelplanet06',
                54=>'dschjungelplanet07',
                55=>'dschjungelplanet08',
                56=>'dschjungelplanet09',
                57=>'dschjungelplanet10');	


$couleur = array(
    1=>'red',
    2=>'blue',
    3=>'green',
    4=>'black',
    5=>'yellow',
    6=>'pink'
);
function calcul_distance_etoile($position){
	global $array_temp;
	$rand1 = mt_rand($array_temp[($position-1)]['dist_min'],$array_temp[($position-1)]['dist_max']);
	$rand2 = mt_rand(100000,900000);
	return number_format($rand1.$rand2,0,'','.').'km';
}
					
function select_soleil($array_soleil,$index){
	$arr_ok = array();
	for($i=0,$j=count($array_soleil[$index]);$i<$j;$i++){
		for($k=0,$l=$array_soleil[$index][$i]['pourcent'];$k<$l;$k++){
			$arr_ok[] = $array_soleil[$index][$i]['label'];
			if($index != 2){
				$arr_ok2[] = $array_soleil[$index][$i]['modif_temp'];
			}
		}
	}
	$rand = mt_rand(0,count($arr_ok)-1);
	if($index != 2){
		return array($arr_ok[$rand],$arr_ok2[$rand]);	
	}else{
		return $arr_ok[$rand];
	}
}
function calcul_case($position){
	global $modificateur_case,$array_temp ;
	$modificateur = 0;
	$rand = mt_rand(1,2);
	$valeurmodif = mt_rand($modificateur_case[0],$modificateur_case[1]);
	if($rand == 1){
		$modificateur = 0-$valeurmodif;
	}else{
		$modificateur = $valeurmodif;
	}
	$case_min = $array_temp[($position-1)]['taille_min']+$modificateur;
	$case_max = $array_temp[($position-1)]['taille_max']+$modificateur;
	if ($case_min <= 0){
         $case_min = mt_rand(10,25);
    }
	if ($case_max < $case_min){
         $case_max = $case_min+mt_rand(40,80);
    }
	$case = mt_rand($case_min,$case_max);
	return $case;
}
function calcul_diametre($case,$type){
	if($type="Jovienne"){
		$modificateur = mt_rand(8,15);
	}elseif($type="Telurique"){
		$modificateur = mt_rand(1,5);
	}elseif($type="Habitable"){
		$modificateur = mt_rand(1,3);
	}elseif($type="Nuange de gaz"){
		$modificateur = mt_rand(18,25);
	}else{
		$modificateur = mt_rand(15,26);
	}	
	
		$base = (($case*mt_rand(2,4))*mt_rand(4,10))*$modificateur;
	return $base;
}
function calcul_temp($position,$modif_soleil,$hab=false){
	global $array_temp,$array_temp_hab,$pourcent_variation_temp;
	if($hab == false){
		//echo 'je ne suis pas habitable<br />';
		$posneg = mt_rand(1,2);
		$variation = $pourcent_variation_temp[mt_rand(0,3)];
		if($posneg == 1){//positif!
			$temp_min = ($array_temp[($position-1)]['temp_min'])+($array_temp[($position-1)]['temp_min']*$variation)+(($modif_soleil*$variation)+($modif_soleil));
		}else{//negatif!
			$temp_min = ($array_temp[($position-1)]['temp_min'])-($array_temp[($position-1)]['temp_min']*$variation)-(($modif_soleil*$variation)+($modif_soleil));
		}
		if($posneg == 1){//positif!
			$temp_max = ($array_temp[($position-1)]['temp_max'])+($array_temp[($position-1)]['temp_max']*$variation)+(($modif_soleil*$variation)+($modif_soleil));
		}else{//negatif!
			$temp_max = ($array_temp[($position-1)]['temp_max'])-($array_temp[($position-1)]['temp_max']*$variation)-(($modif_soleil*$variation)+($modif_soleil));
		}
	}else{
		//echo 'je suis habitable<br />';
		$posneg = mt_rand(1,2);
		$variation = $pourcent_variation_temp[mt_rand(0,3)];
		if($posneg == 1){//positif!
			$temp_min = ($array_temp_hab[($position-1)]['temp_min'])+($array_temp_hab[($position-1)]['temp_min']*$variation)+(($modif_soleil*$variation)+($modif_soleil));
		}else{//negatif!
			$temp_min = ($array_temp_hab[($position-1)]['temp_min'])-($array_temp_hab[($position-1)]['temp_min']*$variation)-(($modif_soleil*$variation)+($modif_soleil));
		}
		if($posneg == 1){//positif!
			$temp_max = ($array_temp_hab[($position-1)]['temp_max'])+($array_temp_hab[($position-1)]['temp_max']*$variation)+(($modif_soleil*$variation)+($modif_soleil));
		}else{//negatif!
			$temp_max = ($array_temp_hab[($position-1)]['temp_max'])-($array_temp_hab[($position-1)]['temp_max']*$variation)-(($modif_soleil*$variation)+($modif_soleil));
		}
	}
	
	return array($temp_min,$temp_max);
}
function generate_planete($array_planete,$position){
	global $pourcent_orbite_vide;

	if(mt_rand(0,100)<= $pourcent_orbite_vide){
		return 'vide';
	}
	if($position <= 5){//trés proche 1-5 
		$index = 0;
	}elseif(($position > 5)&&($position <= 10)){//proche 6-10
		$index = 1;
	}elseif(($position > 10)&&($position <= 20)){//Medium 11 - 20
		$index = 2;
	}elseif(($position > 20)&&($position <= 25)){//eloigné 21 - 25
		$index = 3;
	}elseif(($position > 25)&&($position <= 30)){//Trés éloigné 26 - 30
		$index = 4;
	}else{
	
	}
	$arr_ok = array();
	for($i=0,$j=count($array_planete);$i<$j;$i++){
		for($k=0,$l=$array_planete[$i]['pourcent'][$index];$k<$l;$k++){
			$arr_ok[] = $array_planete[$i]['label'];
		}
	}
	return $arr_ok[mt_rand(0,count($arr_ok)-1)];	
}

$nbsysteme = 0;
$nbTroueNoir = 0;
$sysUnique = 0;
$sysBi = 0;
$sysTri = 0;
$sysQua = 0;
$sysQuin = 0;
$coordd = array();
$aff = '';
$result = array();
$orbite_systeme = 30;
$pourcent_binaire = 20;
$pourcent_ternaire = 8;
$pourcent_quadruple = 2;
$pourcent_quintuple = 1;
$pourcent_orbite_vide = 50;
$pourcent_variation_temp = array(0,0.1,0.2,0.3);
$planette = '';
$resultat = '';
$nbcolonie = 0;
$requette_b =     'INSERT INTO `xgp_planets` (`name`, `id_owner`, `galaxy`, `system`,`planet`,`last_update`,`planet_type`,`image`,`diameter`,`field_max`,`temp_min`,`temp_max`,`coord_x`,`coord_y,`stargate`) VALUE';
$requette_gal_b = 'INSERT INTO `xgp_galaxy` (`galaxy`, `system`, `planet`, `id_planet`,`coord_x`,`coord_y`) VALUE';

$modificateur_case = array(0,40);
for ($i=1,$j=count($array_secteur);$i<=$j;$i++){
        $color = rand(000,999);
	for($k=1,$l=mt_rand($array_secteur[$i]['density_min'],$array_secteur[$i]['density_max']);$k <= $l;$k++){
		
		$rand_x = mt_rand($array_secteur[$i]['x'][0],$array_secteur[$i]['x'][1] );
		$rand_y = mt_rand($array_secteur[$i]['y'][0],$array_secteur[$i]['y'][1] );
		if(in_array($rand_x.'|'.$rand_y, $result)){
			$k = $k-1;
			continue;
		}
		$result[] = $rand_x.'|'.$rand_y;
		$aff .= '<div style="background:#000;width:1px;height:1px;position:absolute;top:'.$rand_y.';left:'.$rand_x.'"></div>';
		$planette = '';
		$position = 0;
		$modif_temps = 0;
		for($m=0,$n=$orbite_systeme;$m<=$n;$m++){
			//Le premier élément est TOUJOUR un soleil;
			
			if($m == 0){
				$results_1 = select_soleil($array_soleil,1);
				$soleil = $results_1[0].' Modificateur de temp: '.$results_1[1];
				$modif_temps = $results_1[1];
				$position = 0;
				$result_s = $results_1[0];
				if($result_s == "Trou noir"){$nbTroueNoir++;}
				$plan = false;
			}
			//Cas particulier on peux avoir des systeme binaire :)
			if($m == 1){
				$rand_binaire = mt_rand(1,100);
				if($rand_binaire <= $pourcent_binaire){//C'est un systeme binaire!!!!
					
					$bin = true;
					$position++;
					
				$result_s = select_soleil($array_soleil,2);
				if($result_s == "Trou noir"){$nbTroueNoir++;}
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$result_s.'</li>';
				}else{//Ce n'est pas un systeme binaire!
				$plan = true;
					$bin = false;
					$retour = generate_planete($array_planete,$m);
					if($retour == 'vide'){
						
						continue;
					}
					$position++;
					$hab=false;
					if($retour == 'Habitable'){$nbcolonie++;$hab=true;}
					$temp = calcul_temp($m,$modif_temps,$hab);
					
					$case = calcul_case($m);
					$diametre_p = calcul_diametre($case,$retour);
					$stargate = (mt_rand(1,2)==1)?1:0;
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$retour.' | Temp: min->'.$temp[0].'&deg; max->'.$temp[1].'&deg; | taille : '.$case.' | diametre : '.$diametre_p.'km | distance etoile => '.calcul_distance_etoile($m).'</li>';
					
				}
			}
			//encorre plus rare des systemes de 3
			if($m == 2){
				$rand_ternaire = mt_rand(1,100);
				if(($bin == true)&&($rand_ternaire <= $pourcent_ternaire)){
					$ter = true;
					$position++;
						$result_s = select_soleil($array_soleil,2);
						if($result_s == "Trou noir"){$nbTroueNoir++;}
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$result_s.'</li>';
				}else{
				$plan = true;
					$ter = false;
					$retour = generate_planete($array_planete,$m);
					if($retour == 'vide'){
						
						continue;
					}
					$position++;
					$hab=false;
					if($retour == 'Habitable'){$nbcolonie++;$hab=true;}
					$temp = calcul_temp($m,$modif_temps,$hab);
					$case = calcul_case($m);
					$diametre_p = calcul_diametre($case,$retour);
					$stargate = (mt_rand(1,2)==1)?1:0;
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$retour.' | Temp: min->'.$temp[0].'&deg; max->'.$temp[1].'&deg; | taille : '.$case.' | diametre : '.$diametre_p.'km | distance etoile => '.calcul_distance_etoile($m).'</li>';
				}
			}
			if($m == 3){
				$rand_quadruple = mt_rand(1,100);
				if(($ter == true)&&($rand_quadruple <= $pourcent_quadruple)){
					$qua = true;
					$position++;
						$result_s = select_soleil($array_soleil,2);
						if($result_s == "Trou noir"){$nbTroueNoir++;}
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$result_s.'</li>';
				}else{
					$plan = true;
					$qua = false;
					$retour = generate_planete($array_planete,$m);
					if($retour == 'vide'){
						
						continue;
					}
					$position++;
					$hab=false;
					if($retour == 'Habitable'){$nbcolonie++;$hab=true;}
					$temp = calcul_temp($m,$modif_temps,$hab);
					$case = calcul_case($m);
					$diametre_p = calcul_diametre($case,$retour);
					$stargate = (mt_rand(1,2)==1)?1:0;
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$retour.' | Temp: min->'.$temp[0].'&deg; max->'.$temp[1].'&deg; | taille : '.$case.' | diametre : '.$diametre_p.'km | distance etoile => '.calcul_distance_etoile($m).'</li>';
				}
			}
			if($m == 4){
				$rand_quintuple = mt_rand(1,100);
				if(($qua == true)&&($rand_quintuple <= $pourcent_quintuple)){
					$qui = true;
					$position++;
						$result_s = select_soleil($array_soleil,2);
						if($result_s == "Trou noir"){$nbTroueNoir++;}
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$result_s.'</li>';
				}else{
					$plan = true;
					$qui = false;
					$retour = generate_planete($array_planete,$m);
					if($retour == 'vide'){
						
						continue;
					}
					$position++;
					$hab=false;
					if($retour == 'Habitable'){$nbcolonie++;$hab=true;}
					$temp = calcul_temp($m,$modif_temps,$hab);
					$case = calcul_case($m);
					$diametre_p = calcul_diametre($case,$retour);
					$stargate = (mt_rand(1,2)==1)?1:0;
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$retour.' | Temp: min->'.$temp[0].'&deg; max->'.$temp[1].'&deg; | taille : '.$case.' | diametre : '.$diametre_p.'km | distance etoile => '.calcul_distance_etoile($m).'</li>';
				}
			}
			if($m>4){
				$plan = true;
				$retour = generate_planete($array_planete,$m);
				if($retour == 'vide'){
					
					continue;
				}
				$position++;
				$hab=false;
					if($retour == 'Habitable'){$nbcolonie++;$hab=true;}
					$temp = calcul_temp($m,$modif_temps,$hab);
					$case = calcul_case($m);
					$diametre_p = calcul_diametre($case,$retour);
					$stargate = (mt_rand(1,2)==1)?1:0;
					$planette .= '<li>'.$i.':'.$k.':'.$position.' =>'.$retour.' | Temp: min->'.$temp[0].'&deg; max->'.$temp[1].'&deg; | taille : '.$case.' | diametre : '.$diametre_p.'km | distance etoile => '.calcul_distance_etoile($m).'</li>';
			}
			if ($plan){
				if($retour == 'Habitable'){
					$type_p = 1;
					$images = $img[mt_rand(0,57)];
				}elseif($retour == 'Jovienne'){
					$type_p = 4;
					$images = $img[mt_rand(0,57)];
				}elseif($retour == 'Telurique'){
					$type_p = 5;
					$images = $img[mt_rand(0,57)];
				}elseif($retour == 'Nuange de gaz'){
					$type_p = 6;
					$images = $img[mt_rand(0,57)];
				}elseif($retour == 'Champ d\'asteroide metalique'){
					$type_p = 7;
					$images = $img[mt_rand(0,57)];
				}else{
					$type_p = 8;
					$images = $img[mt_rand(0,57)];
				}
			}else{
				if($result_s == 'Naine blanche'){
					$count = count($array_soleil[1][0]['img'])-1;
					$images = $array_soleil[1][0]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Naine jaune'){
					$count = count($array_soleil[1][1]['img'])-1;
					$images = $array_soleil[1][1]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Naine rouge'){
					$count = count($array_soleil[1][2]['img'])-1;
					$images = $array_soleil[1][2]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Naine brune'){
					$count = count($array_soleil[1][3]['img'])-1;
					$images = $array_soleil[1][3]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Naine noire'){
					$count = count($array_soleil[1][4]['img'])-1;
					$images = $array_soleil[1][4]['img'][mt_rand(0,$count)];;
				}elseif($result_s == 'Geante rouge'){
					$count = count($array_soleil[1][5]['img'])-1;
					$images = $array_soleil[1][5]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Geante bleu'){
					$count = count($array_soleil[1][6]['img'])-1;
					$images = $array_soleil[1][6]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Supergeante rouge'){
					$count = count($array_soleil[1][7]['img'])-1;
					$images = $array_soleil[1][7]['img'][mt_rand(0,$count)];
				}elseif($result_s == 'Etoile a neutron'){
					$count = count($array_soleil[1][8]['img'])-1;
					$images = $array_soleil[1][8]['img'][mt_rand(0,$count)];
				}else{
					$count = count($array_soleil[1][9]['img'])-1;
					$images = $array_soleil[1][9]['img'][mt_rand(0,$count)];
				}
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			if ($plan){               //(`name`, `id_owner`, `galaxy`, `system`,`planet` ,`last_update`,`planet_type`,    `diameter`,   `field_max`,`temp_min`,      `temp_max`,  `coord_x`,`coord_y`) VALUE';
				$requette = "('".addslashes ($retour)."', '0', '".$i."', '".$k."','".$position."','".time()."','".$type_p."','".$images."','".$diametre_p."','".$case."','".$temp[0]."','".$temp[1]."','".$rand_x.sprintf('%03d',$position)."','".$rand_y.sprintf('%03d',$position)."','".$stargate."')";		
			}else{
				$requette = "('".addslashes ($result_s)."', '0', '".$i."', '".$k."','".$position."','".time()."','0','".$images."','0','0','0','0','".$rand_x.sprintf('%03d',$position)."','".$rand_y.sprintf('%03d',$position)."',0)";		
			}
			
			//echo $requette_b.$requette.'<br />';
			//-->mysql_query($requette_b.$requette) or die(mysql_error());
			//$requette_gal = "('".$i."', '".$k."', '".$position."', '".mysql_insert_id()."','".$rand_x.sprintf('%03d',$position)."','".$rand_y.sprintf('%03d',$position)."')";

			//echo $requette_gal_b.$requette_gal.'<br />';
			//->mysql_query($requette_gal_b.$requette_gal) or die(mysql_error());
			//mysql_query();
		}
		
		$resultat .='<ul><li>'.$i.':'.$k.' x='.$rand_x.'/y='.$rand_y.'</li><li><ul><li>'.$i.':'.$k.':0 =>'.$soleil.'</li>'.$planette.'</ul></li></ul>';
		
		$nbsysteme ++;
	}
}
//file_put_contents('req_colo.sql',$requette);
//echo $requette;
?>
<div style="float:left;width:400px;height:230px"><?=$aff?></div>

<div style="width:410px;">
Nombre de systeme: <?=$nbsysteme?><br />
Nombre de plantes colonisable : <?=$nbcolonie?><br />
Nombre de trou noir : <?=$nbTroueNoir?></div>
Liste des coordonee;
<pre>
<?=$resultat ?>
</pre>