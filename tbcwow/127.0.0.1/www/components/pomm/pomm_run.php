<?php
/*
 * Project Name: MiniManager for Mangos Server
 * Date: 17.10.2006 inital version (0.0.1a)
 * Author: Q.SA (thanks to mirage666 for the original idea) 
 * Copyright: Q.SA
 * Email: *****
 * License: GNU General Public License (GPL)
 */

require_once ("pomm_cfg.php");
require_once ("JsHttpRequest/Php.php");

$JsHttpRequest =& new Subsys_JsHttpRequest_Php("iso-8859-1");
$i = 0;

mysql_connect($characters_db['addr'], $characters_db['user'], $characters_db['pass']);
mysql_select_db($characters_db['name']);

$sql = "SELECT name,race,class,position_x,position_y,map,SUBSTRING_INDEX(SUBSTRING_INDEX(`data`, ' ', 35), ' ', -1),
		SUBSTRING_INDEX(SUBSTRING_INDEX(`data`, ' ', 37), ' ', -1)
		FROM `characters` WHERE `online`= 1";
$result = mysql_query($sql);

while($char = mysql_fetch_row($result)){
	$char_gender = str_pad(dechex($char[7]),8, 0, STR_PAD_LEFT);

	$pos = get_player_position($char[3],$char[4],$char[5]); 
 	$arr[$i]['x'] = $pos['x'];
	$arr[$i]['y'] = $pos['y'];
	$arr[$i]['name'] = $char[0];

	if (($char[5] == 1)||($char[5] == 0)||($char[5] == 530)) $arr[$i]['zone'] = get_zone_name($char[5], $char[3], $char[4]);
		else $arr[$i]['zone'] = get_map_name($char[5]);

	$arr[$i]['cl'] = $char[2];
	$arr[$i]['race'] = $char[1];
	$arr[$i]['level']= "level - ".$char[6];
	$arr[$i]['gender'] = $char_gender[3];
	$i++;
 	}

mysql_free_result($result);
mysql_close();

$_RESULT =$arr; 
?>