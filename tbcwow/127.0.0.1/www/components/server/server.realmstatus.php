<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['realms_status'],'link'=>'');
// ==================== //
error_reporting(E_ERROR);
function population_view($n)
{
    $low=100; $medium=200; $high=300;
    if($n < $low){return '<font color="green">Low</font>';}
    elseif($n >= $low && $n < $medium){return '<font color="orange">Medium</font>';}
    elseif($n >= $high){return '<font color="red">High</font>';}
}
function check_port_status($ip, $port)
{
    if($fp1=fsockopen($ip, $port, $ERROR_NO, $ERROR_STR,(float)1.0)){
        return true;fclose($fp1); 
    }else{
        return false;
    } 
}
$realm_type_def = array(
    0 => 'Normal',
    1 => 'PVP',
    4 => 'Normal',
    6 => 'RP',
    8 => 'RPPVP'
);
$realm_timezone_def = array(
    1 => 'English',
    2 => 'Deutsch',
    3 => 'French',
    4 => 'Others'
);
$items = array();
$items = $DB->select("SELECT * FROM `realmlist` ORDER BY `name`");
$i = 0;
foreach($items as $i => $result)
{
    $population=0;
    if($res_color==1)$res_color=2;else$res_color=1;
    $realm_type = $realm_type_def[$result['icon']];
    if(check_port_status($result['address'], $result['port'])===true)
    {
        $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);
        $res_img = './templates/offlike/images/uparrow2.gif';
        if($WSDB)$population = $WSDB->selectCell("SELECT count(*) FROM `characters` WHERE online=1");
        $population_str = population_view($population);
    }
    else
    {
        $res_img = './templates/offlike/images/downarrow2.gif';
        $population_str = 'n/a';
    }
        $items[$i]['res_color'] = $res_color;
        $items[$i]['img'] = $res_img;
        $items[$i]['name'] = $result['name'];
        $items[$i]['type'] = $realm_type;
        $items[$i]['pop'][1] = $population_str;
        $items[$i]['pop'][2] = $population;

    unset($WSDB);
}
?>
