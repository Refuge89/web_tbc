<?php
if(INCLUDED!==true)exit;
require_once 'core/defines.php';
// ==================== //
$pathway_info[] = array('title'=>$lang['gm_online'],'link'=>'');
// ==================== //
$site_defines = Array(
'character_race' => Array(
		1 => $lang['Human'],
		2 => $lang['Orc'],
		3 => $lang['Dwarf'],
		4 => $lang['NightElf'],
		5 => $lang['Undead'],
		6 => $lang['Tauren'],
		7 => $lang['Gnome'],
		8 => $lang['Troll'],
		9 => $lang['Goblin'],
		10 => $lang['BloodElf'],
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
      1 => $lang['ar1'],
      2 => $lang['ar2'],
      3 => $lang['ar3'],
      4 => $lang['ar4'],
      5 => $lang['ar5'],
      6 => $lang['ar6'],
      7 => $lang['ar7'],
      8 => $lang['ar8'],
      9 => $lang['ar9'],
      10 => $lang['ar10'],
      11 => $lang['ar11'],
      12 => $lang['ar12'],
      13 => $lang['ar13'],
      14 => $lang['ar14']
    ),
    'horde' => Array(
      1 => $lang['hr1'],
      2 => $lang['hr2'],
      3 => $lang['hr3'],
      4 => $lang['hr4'],
      5 => $lang['hr5'],
      6 => $lang['hr6'],
      7 => $lang['hr7'],
      8 => $lang['hr8'],
      9 => $lang['hr9'],
      10 => $lang['hr10'],
      11 => $lang['hr11'],
      12 => $lang['hr12'],
      13 => $lang['hr13'],
      14 => $lang['hr14']
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
    {
        $WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['db_username'].":".$mangos['db_password']."@".$mangos['db_host'].":".$mangos['db_port']."/".$mangos['db_name']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$mangos['db_encoding']);
        if($WSDB)$query = $WSDB->select("SELECT name, race, class, data, position_x, position_y, position_z, map  FROM `characters` WHERE `online`='1' AND `gmstate`='1' ORDER BY `name`"); 
    }else{
        output_message('alert','Realm <b>'.$realm_info['name'].'</b> is offline <img src="./templates/offlike/images/downarrow2.gif" border="0" align="top">');
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
    unset($WSDB);
}else{
  $realm_list = realm_list();
}

?>
