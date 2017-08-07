<?php
if(INCLUDED!==true)exit;
$site_defines = Array(
	'character_race' => Array(
		1 => 'Human',
		2 => 'Orc',
		3 => 'Dwarf',
		4 => 'Night Elf',
		5 => 'Undead',
		6 => 'Tauren',
		7 => 'Gnome',
		8 => 'Troll',
		9 => 'Goblin',
	     10 => 'Blood Elf',
           11 => 'Draenie',

	),
	'character_class' => Array(
		1 => 'Warrior',
		2 => 'Paladin',
		3 => 'Hunter',
		4 => 'Rogue',
		5 => 'Priest',
		7 => 'Shaman',
		8 => 'Mage',
		9 => 'Warlock',
		11 => 'Druid',
	),
	
	'character_gender' => Array(
		0 => 'Male',
		1 => 'Female',
		2 => 'None'
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
$realm = $DB->selectRow("SELECT * FROM realmlist WHERE id=?d LIMIT 1",$_GET['realmid']);
$WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['user'].":".$mangos['password']."@".$mangos['host']."/".$mangos['db']."");
$WSDB->setErrorHandler('databaseErrorHandler');
$WSDB->query("SET NAMES ".$mangos['db_encoding']);

$honor = $WSDB->select("SELECT * FROM character_kill ORDER BY guid");
foreach($honor as $res_row)
{
    if($res_row['type']==1){
        $honor_arr[$res_row['guid']] += $res_row['honor'];
    }elseif($res_row['type']==2){
        $honor_arr[$res_row['guid']] -= $res_row['honor'];
    }
}
unset($honor);
$honor_arr = array_filter($honor_arr,"zehohonorfilter");
arsort($honor_arr);
$honor_arr = array_slice($honor_arr,0,40,true);
$charinfo_arr = array();
$allhonor = array();
$charinfo_arr = $WSDB->select("SELECT character.guid,character.data,character.name,character.race,character.class FROM `characters` WHERE guid IN(?a)",array_keys($honor_arr));
// Prepair for sending data ...
foreach($charinfo_arr as $charinfo_item){
    $char_data = explode(' ',$charinfo_item['data']);
    $char_gender = dechex($char_data[36]);
    $char_gender = str_pad($char_gender,8, 0, STR_PAD_LEFT);
    $char_gender = $char_gender{3};
    $char_rank_id = calc_character_rank($honor_arr[$charinfo_item['guid']]);
    if($charinfo_item['race']==1 || $charinfo_item['race']==3 || $charinfo_item['race']==4 || $charinfo_item['race']==7)$faction = 'alliance';
    else$faction = 'horde';
    $character = array(
        'name'   => $charinfo_item['name'],
        'race'   => $site_defines['character_race'][$charinfo_item['race']],
        'class'  => $site_defines['character_class'][$charinfo_item['class']],
        'gender' => $site_defines['character_gender'][$char_gender],
        'rank'   => $site_defines['character_gender'][$faction][$char_rank_id],
        'level'  => $char_data[34],
        'lifetime_honorable_kills'    => $char_data[1193],
        'lifetime_dishonorable_kills' => $char_data[1194],
        'race_icon'   => $config['template_href'].'images/icon/race/'.$charinfo_item['race'].'-'.$char_gender.'.gif',
        'class_icon'   => $config['template_href'].'images/icon/class/'.$charinfo_item['class'].'.gif',
        'rank_icon'   => $config['template_href'].'images/icon/pvpranks/'.$charinfo_item['class'].'.gif',
    );
    $allhonor[$faction][] = $character;
}    
echo'<table>';
foreach($allhonor[$_GET['faction']]){
    
}
echo'</table>';
// Output(send) data
// echo'<pre>';
// print_r($allhonor);
// echo'</pre>';
unset($honor_arr);
unset($charinfo_arr);
unset($WSDB);
function calc_character_rank($honor_points){
    $rank = 0;
    if($honor_points <= 0){
        $rank = 0; 
    }else{
        if($honor_points < 2000) $rank = 1;
        else $rank = ($honor_points / 5000) + 1;
    }
    return $rank;
}
function zehohonorfilter($var){
    return ($var>0);
}
?>
