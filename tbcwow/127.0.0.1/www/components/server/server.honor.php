<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['honor'],'link'=>'index.php?n=server&sub=honor');
// ==================== //
// some config //
$max_display_chars = 40; // Only top 40 in stats

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


//Functions
function realm_list()
{
  global $DB;
  $res = $DB->selectCol("SELECT id AS ARRAY_KEY,name FROM realmlist ORDER BY name");
  return $res;
}
function get_rank_numending($n)
{
  $n = substr("$n", -1);
  if($n==1)return 'st';
  elseif($n==2)return 'nd';
  elseif($n==3)return 'rd';
  elseif($n>=4)return 'th';
}
function calc_character_rank($honor_points){
    $rank = 0;
    if($honor_points <= 0){
        $rank = 0;
    }else{
        if($honor_points < 2000) $rank = 1;
        else $rank = ceil($honor_points / 5000) + 1;
    }
    return $rank;
}
function zehohonorfilter($var){
    return ($var>0);
}



if(!$_GET['realm']){
    $realm_list = realm_list();
}elseif($_GET['realm']){
    $pos = 0;
    $realm_list = realm_list();
    $realm = $DB->selectRow("SELECT * FROM realmlist WHERE id=?d LIMIT 1",$_GET['realm']);

    $pathway_info[] = array('title'=>$realm['name'],'');

    $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");
    if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
    if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);

     if($WSDB)$honor = $WSDB->select("SELECT guid, CAST( SUBSTRING_INDEX(SUBSTRING_INDEX(`data`, ' ', 1421), ' ', -1) AS UNSIGNED) AS honor FROM `characters`;");

        foreach($honor as $res_row)
    {
         if($res_row['type']==0){
            $honor_arr[$res_row['guid']] += $res_row['honor'];
        }elseif($res_row['type']==2){
            $honor_arr[$res_row['guid']] -= $res_row['honor'];
        }
    }
    unset($honor);
    if(!is_array($honor_arr))$honor_arr = array();
    $honor_arr = array_filter($honor_arr,"zehohonorfilter");
    arsort($honor_arr);
    $honor_arr = array_slice($honor_arr,0,$max_display_chars,true);
    $allhonor['alliance'] = array();
    $allhonor['horde'] = array();
    $charinfo_arr = array();
    $precharinfo_arr = array();
    if(count($honor_arr)>0)$precharinfo_arr = $WSDB->select("SELECT character.guid AS ARRAY_KEY,character.guid,character.data,character.name,character.race,character.class FROM `characters` WHERE guid IN(?a)",array_keys($honor_arr));
    foreach ($honor_arr as $honor_uid=>$honor_val){
        $charinfo_arr[$honor_uid] = $precharinfo_arr[$honor_uid];
    }
    unset($precharinfo_arr);
    // Prepair data ...
    foreach($charinfo_arr as $charinfo_item){
        $char_data = explode(' ',$charinfo_item['data']);
        $char_gender = dechex($char_data[36]);
        $char_gender = str_pad($char_gender,8, 0, STR_PAD_LEFT);
        $char_gender = $char_gender{3};
        $char_rank_id = calc_character_rank($honor_arr[$charinfo_item['guid']]);
        if($charinfo_item['race']==1 || $charinfo_item['race']==3 || $charinfo_item['race']==4 || $charinfo_item['race']==7 || $charinfo_item['race']==11)$faction = 'alliance';
        else$faction = 'horde';
        $character = array(
            'name'   => $charinfo_item['name'],
            'race'   => $site_defines['character_race'][$charinfo_item['race']],
            'class'  => $site_defines['character_class'][$charinfo_item['class']],
            'gender' => $site_defines['character_gender'][$char_gender],
            'rank'   => $site_defines['character_rank'][$faction][$char_rank_id],
            'level'  => $char_data[34],
            'honor_points'       => $honor_arr[$charinfo_item['guid']],
            'honorable_kills'    => $char_data[1420],
            'dishonorable_kills' => $char_data[1376],
            'race_icon'   => $config['template_href'].'images/icon/race/'.$charinfo_item['race'].'-'.$char_gender.'.gif',
            'class_icon'   => $config['template_href'].'images/icon/class/'.$charinfo_item['class'].'.gif',
            'rank_icon'   => $config['template_href'].'images/icon/pvpranks/rank'.$char_rank_id.'.gif',
        );
        $allhonor[$faction][] = $character;
    }

    unset($honor_arr);
    unset($charinfo_arr);
    unset($WSDB);

}
?>
