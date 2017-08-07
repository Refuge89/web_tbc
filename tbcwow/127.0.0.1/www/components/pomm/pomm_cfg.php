<?php
/*
 * Project Name: MiniManager for Mangos Server
 * Date: 17.10.2006 inital version (0.0.1a)
 * Author: Q.SA (thanks to mirage666 for the original idea) 
 * Copyright: Q.SA
 * Email: *****
 * License: GNU General Public License (GPL)
 */

require_once("id_tab.php");
require("../../config.php");

$realm_db = Array(
	'addr' => $realmd['db_host'].":".$realmd['db_port'],	//SQL server IP:port this realmd located on
	'user' => $realmd['db_username'],			//SQL server login this realmd located on
	'pass' => $realmd['db_password'],			//SQL server pass this realmd located on
	'name' => $realmd['db_name'],			//realmd DB name
	);

$mangos_db = Array(
	'id' => $site_spesific_config['realm_info']['default_realm_id'],					//Realm ID
	'addr' => $mangos['db_host'].":".$mangos['db_port'],	//SQL server IP:port this realmd located on
	'user' => $mangos['db_username'],			//SQL server login this realmd located on
	'pass' => $mangos['db_password'],			//SQL server pass this realmd located on
	'name' => $mangos['db_name'],			//characters DB name
	);

$characters_db = Array(
	'addr' => $characters['db_host'].":".$characters['db_port'],	//SQL server IP:port this realmd located on
	'user' => $characters['db_username'],			//SQL server login this realmd located on
	'pass' => $characters['db_password'],			//SQL server pass this realmd located on
	'name' => $characters['db_name'],			//characters DB name
	);

$time = 30;	// Update time (seconds), 0 - not update.


function get_player_position($x,$y,$map) {
 global $zone_530;

 $xpos = round(($x / 1000)*17.7,0);
 $ypos = round(($y / 1000)*17.7,0);
 switch ($map){
   case 1:
    $pos['x'] = 152 - $ypos;
    $pos['y'] = 259 - $xpos;
    break;
   case 0:
    $pos['x'] = 569 - $ypos;
    $pos['y'] = 175 - $xpos;
	break;
	
	case 530:
	$zone_id = 0;
	for ($i=0; $i < count($zone_530); $i++)
		if (($zone_530[$i][2] < $x) && ($zone_530[$i][3] > $x) && ($zone_530[$i][1] < $y) && ($zone_530[$i][0] > $y)){
			$zone_id =  $zone_530[$i][5];
			break;
			}
	if (($zone_id == 3525) || ($zone_id == 3557) || ($zone_id == 3524)){
		$pos['x'] = -162 - $ypos;
		$pos['y'] = 75 - $xpos;
	} else if (($zone_id == 3487) || ($zone_id == 3433) || ($zone_id == 3430)){
				$pos['x'] = 528 - $ypos;
				$pos['y'] = 218 - $xpos;
				} else {
						$pos['x'] = 484 - $ypos;
						$pos['y'] = 272 - $xpos;
				}
	break;

case 70:
    $pos['x'] = 610;
	$pos['y'] = 305;
break;
case 43:
    $pos['x'] = 190;
	$pos['y'] = 275;
break;
case 229:
	$pos['x'] = 582;
	$pos['y'] = 300;
break;
case 230:
	$pos['x'] = 582;
	$pos['y'] = 300;
break;
case 409:
	$pos['x'] = 582;
	$pos['y'] = 302;
break;
case 469:
	$pos['x'] = 582;
	$pos['y'] = 301;
break;
case 489:
    $pos['x'] = 185;
	$pos['y'] = 237;
break;
case 369:
	$pos['x'] = 582;
	$pos['y'] = 265;
break;
case 451:
	$pos['x'] = 435;
	$pos['y'] = 75;
break;
case 34:
	$pos['x'] = 560;
	$pos['y'] = 335;
break;
case 209:
   	$pos['x'] = 200;
	$pos['y'] = 370;
break;
case 35:
	$pos['x'] = 561;
	$pos['y'] = 336;
break;
case 449:
	$pos['x'] = 560;
	$pos['y'] = 335;
break;
case 47:
    $pos['x'] = 190;
	$pos['y'] = 340;
break;
case 531:
    $pos['x'] = 120;
	$pos['y'] = 410;
break;
case 509:
    $pos['x'] = 125;
	$pos['y'] = 410;
break;
case 90:
	$pos['x'] = 560;
	$pos['y'] = 270;
break;
case 389:
	$pos['x'] = 227;
	$pos['y'] = 230;
break;
case 450:
	$pos['x'] = 227;
	$pos['y'] = 228;
break;
case 533:
   	$pos['x'] = 640;
	$pos['y'] = 130;
break;
case 532:
   $pos['x'] = 605;
   $pos['y'] = 365;
break;
case 550:
   $pos['x'] = 455;
   $pos['y'] = 216;
break;
case 552:
   $pos['x'] = 455;
   $pos['y'] = 216;
break;
case 553:
   $pos['x'] = 455;
   $pos['y'] = 216;
break;
case 554:
   $pos['x'] = 455;
   $pos['y'] = 216;
break;
case 540:
   $pos['x'] = 425;
   $pos['y'] = 275;
break;
case 542:
   $pos['x'] = 425;
   $pos['y'] = 275;
break;
case 543:
   $pos['x'] = 425;
   $pos['y'] = 275;
break;
case 544:
   $pos['x'] = 425;
   $pos['y'] = 275;
break;
case 555:
   $pos['x'] = 380;
   $pos['y'] = 330;
break;
case 556:
   $pos['x'] = 380;
   $pos['y'] = 330;
break;
case 557:
   $pos['x'] = 380;
   $pos['y'] = 330;
break;
case 558:
   $pos['x'] = 380;
   $pos['y'] = 330;
break;
case 545:
   $pos['x'] = 338;
   $pos['y'] = 290;
break;
case 546:
   $pos['x'] = 338;
   $pos['y'] = 290;
break;
case 547:
   $pos['x'] = 338;
   $pos['y'] = 290;
break;
case 548:
   $pos['x'] = 338;
   $pos['y'] = 290;
break;
case 249:
   $pos['x'] = 215;
   $pos['y'] = 340;
break;
case 329:
   $pos['x'] = 630;
   $pos['y'] = 115;
break;
case 289:
   $pos['x'] = 612;
   $pos['y'] = 150;
break;
case 565:
   $pos['x'] = 375;
   $pos['y'] = 210;
break;
case 269:
   $pos['x'] = 225;
   $pos['y'] = 410;
break;
case 189:
   $pos['x'] = 580;
   $pos['y'] = 120;
break;
case 33:
   $pos['x'] = 540;
   $pos['y'] = 175;
break;
case 109:
   $pos['x'] = 640;
   $pos['y'] = 352;
break;
case 36:
   $pos['x'] = 545;
   $pos['y'] = 310;
break;
case 48:
   $pos['x'] = 135;
   $pos['y'] = 185;
break;
case 129:
    $pos['x'] = 195;
	$pos['y'] = 340;
break;
case 309:
    $pos['x'] = 605;
	$pos['y'] = 385;
break;
case 429:
    $pos['x'] = 135;
	$pos['y'] = 325;
break;
case 349:
    $pos['x'] = 100;
	$pos['y'] = 275;
break;
case 560:
   $pos['x'] = 225;
   $pos['y'] = 410;
break;
case 534:
   $pos['x'] = 225;
   $pos['y'] = 410;
break;

   default:
    $pos['x'] = -1;
    $pos['y'] = -1;
 }
 return $pos;
}


function get_realm_name(){
 global $realm_db, $mangos_db, $characters_db;

 mysql_connect($realm_db['addr'], $realm_db['user'], $realm_db['pass']);
 mysql_select_db($realm_db['name']);

 $result = mysql_query("SELECT name FROM `realmlist` WHERE id = '{$mangos_db['id']}'");
 $realm_name = mysql_result($result, 0);

 mysql_free_result($result);
 mysql_close();
 if ($realm_name) return $realm_name;
	else return "";
}


?>
