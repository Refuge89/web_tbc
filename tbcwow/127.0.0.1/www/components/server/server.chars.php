<?php
if(INCLUDED!==true)exit;
require_once 'core/defines.php';
// ==================== //
$pathway_info[] = array('title'=>$lang['chars'],'link'=>'');

	//===== Calc pages1 =====//
	$items_per_pages = $config['users_per_page'];
 	$limit_start = ($p-1)*$items_per_pages;

// ==================== //
$site_defines = Array(
  'character_race' => Array(
		1 => $lang['Human'],
		2 => $lang['Orc'],
		3 => $lang['Dwarf'],
		4 => $lang['Nightelf'],
		5 => $lang['Undead'],
		6 => $lang['Tauren'],
		7 => $lang['Gnome'],
		8 => $lang['Troll'],
		9 => $lang['Goblin'],
		10 => $lang['Bloodelf'],
		11 => $lang['Dranei'],
	),
	'character_class' => Array(
		1 => $lang['Warrior'],
		2 => $lang['Paladin'],
		3 => $lang['Hunter'],
		4 => $lang['Rogue'],
		5 => $lang['Priest'],
		7 => $lang['Shaman'],
		8 => $lang['Mage'],
		9 => $lang['Warlock'],
		11 => $lang['Druid'],
	),

  'character_gender' => Array(
    0 => $lang['Male'],
    1 => $lang['Female'],
    2 => 'None',
  ),
  'character_rank' => Array(
    'alliance' => Array(
      1 => 'Private',
      2 => 'Corporal',
      3 => 'Sergeant',
      4 => 'Master Sergeant',
      5 => 'Sergeant Major',
      6 => 'Knight',
      7 => 'Knight-Lieutenant',
      8 => 'Knight-Captain',
      9 => 'Knight-Champion',
      10 => 'Lieutenant Commander',
      11 => 'Commander',
      12 => 'Marshal',
      13 => 'Field Marshal',
      14 => 'Grand Marshal'
    ),
    'horde' => Array(
      1 => 'Scout',
      2 => 'Grunt',
      3 => 'Sergeant',
      4 => 'Senior Sergeant',
      5 => 'First Sergeant',
      6 => 'Stone Guard',
      7 => 'Blood Guard',
      8 => 'Legionnare',
      9 => 'Centurion',
      10 => 'Champion',
      11 => 'Lieutenant General',
      12 => 'General',
      13 => 'Warlord',
      14 => 'High Warlord'
    )
  )
);


function realm_list()
{
  global $DB;
  $res = $DB->selectCol("SELECT id AS ARRAY_KEY,name FROM realmlist ORDER BY name");
  return $res;
}
function get_realm_byid($id)
{
  global $DB;
  $search_q = $DB->selectRow("SELECT * FROM `realmlist` WHERE `id`=?d",$id);
  return $search_q;
}
function check_port_status($ip, $port)
{
    if($fp1=fsockopen($ip, $port, $ERROR_NO, $ERROR_STR,(float)1.0)){
        return true;fclose($fp1);
    }else{
        return false;
    }
}
function get_zone_name($mapid, $x, $y){
global $maps_a, $zone;
if (!empty($maps_a[$mapid]))
  {
  $zmap=$maps_a[$mapid];
  if (($mapid==0) or ($mapid==1) or ($mapid==530))
    {
    $i=0; $c=count($zone[$mapid]);
    while ($i<$c)
      {
  if ($zone[$mapid][$i][2] < $x  AND $zone[$mapid][$i][3] > $x AND $zone[$mapid][$i][1] < $y  AND $zone[$mapid][$i][0] > $y) $zmap=$zone[$mapid][$i][4];
      $i++;
      }
    }
  } else $zmap=$lang['Unknownzone'];
return $zmap;
}

if($_GET['realm']){

  $res_info = array();
  $query = array();
  $realm_info = get_realm_byid($_GET['realm']);
  $cc = 0;
    if(check_port_status($realm_info['address'], $realm_info['port'])===true)
    {        $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);
        if($WSDB)$query = $WSDB->select("SELECT name, race, class, data, position_x, position_y, position_z, map FROM `characters` ORDER BY `name` LIMIT $limit_start,$items_per_pages");
    }else{
        $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['user'].":".$characters['password']."@".$characters['host'].":".$characters['port']."/".$characters['db']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);
        if($WSDB)$query = $WSDB->select("SELECT name, race, class, data, position_x, position_y, position_z, map FROM `character` ORDER BY `name` LIMIT $limit_start,$items_per_pages");
        output_message('alert','Realm <b>'.$realm_info['name'].'</b> is offline <img src="images/downarrow2.gif" border="0" align="top">');
    }

    foreach ($query as $result) {
        if($res_color==1)$res_color=2;else$res_color=1;
        $cc++;
        $res_race = $site_defines['character_race'][$result['race']];
        $res_class = $site_defines['character_class'][$result['class']];
        //      $res_pos = "<b>x:</b>$result[position_x] <b>y:</b>$result[position_y] <b>z:</b>$result[position_z]";
        $res_pos=get_zone_name($result['map'], $result['position_x'], $result['position_y']);
        $char_data = explode(' ',$result['data']);

        $char_gender = dechex($char_data[36]);
        $char_gender = str_pad($char_gender,8, 0, STR_PAD_LEFT);
        $char_gender = $char_gender{3};

        $res_info[$cc]["number"] = $cc;
        $res_info[$cc]["res_color"] = $res_color;
        $res_info[$cc]["name"] = $result['name'];
        $res_info[$cc]["race"] = $result['race'];
        $res_info[$cc]["class"] = $result['class'];
        $res_info[$cc]["gender"] = $char_gender;
        $res_info[$cc]["level"] = $char_data[34];
        $res_info[$cc]["pos"] = $res_pos;
    }

// array´s
 $query1 = array();
 $query2 = array();
 $cc1 = 0;
 $cc2 = 0;

## output_message('alert',$filter);



	//===db connect 1===//
        $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);



     //===== Filter ==========//
    if($_GET['char'] && preg_match("/[a-z]/",$_GET['char'])){
        $filter = "WHERE `name` LIKE '".$_GET['char']."%'";
    }elseif($_GET['char']==1){
        $filter = "WHERE `name` REGEXP '^[^A-Za-z]'";
    }else{
        $filter = '';
      }


         $query1 =  $WSDB->select("SELECT * FROM `character`  $filter  ORDER BY `name`  LIMIT $limit_start,$items_per_pages");



 foreach ($query1 as $result1) {
        if($res_color==1)$res_color=2;else$res_color=1;
        $cc1++;
        $res_race = $site_defines['character_race'][$result1['race']];
        $res_class = $site_defines['character_class'][$result1['class']];
        //      $res_pos = "<b>x:</b>$result1[position_x] <b>y:</b>$result1[position_y] <b>z:</b>$result1[position_z]";
        $res_pos=get_zone_name($result1['map'], $result1['position_x'], $result1['position_y']);
        $char_data = explode(' ',$result1['data']);

        $char_gender = dechex($char_data[36]);
        $char_gender = str_pad($char_gender,8, 0, STR_PAD_LEFT);
        $char_gender = $char_gender{3};
        $item_res[$cc1]["number"] = $cc1;
        $item_res[$cc1]["name"] = $result1['name'];
        $item_res[$cc1]["res_color"] = $res_color;
        $item_res[$cc1]["race"] = $result1['race'];
        $item_res[$cc1]["class"] = $result1['class'];
        $item_res[$cc1]["gender"] = $char_gender;
        $item_res[$cc1]["level"] = $char_data[34];
        $item_res[$cc1]["pos"] = $res_pos;


    }


$query2 =  $WSDB->select("SELECT * FROM `character`  $filter  ORDER BY `name`  ");
 foreach ($query2 as $result2) {
        $cc2++;
        $item_res1[$cc2]["number"] = $cc2;

    }
	//===== Calc pages2 =====//
	$pnum = ceil($cc2/$items_per_pages);
	$pages_str = default_paginate($pnum, $p, "index.php?n=server&sub=chars&realm=".$_GET['realm']."&char=".$_GET['char']);



##  output_message('alert',$pages_str);


	unset($WSDB);
	unset($WSDBTWO);
}else{
  $realm_list = realm_list();
}
?>




