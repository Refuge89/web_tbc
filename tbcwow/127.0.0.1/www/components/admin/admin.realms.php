<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['realms_manage'],'link'=>'index.php?n=admin&sub=realms');
// ==================== //
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

if(!$_GET['action']){

    $items = $DB->select("SELECT * FROM realmlist ORDER BY `name`");

}elseif($_GET['action']=='edit' && $_GET['id']){
    $pathway_info[] = array('title'=>$lang['editing'],'link'=>'');
    $item = $DB->selectRow("SELECT * FROM realmlist WHERE `id`=?d",$_GET['id']);
}elseif($_GET['action']=='update' && $_GET['id']){
    $DB->query("UPDATE realmlist SET ?a WHERE id=?d LIMIT 1",$_POST,$_GET['id']);
    redirect('index.php?n=admin&sub=realms',1);
}elseif($_GET['action']=='create'){
    $DB->query("INSERT INTO realmlist SET ?a",$_POST);
    redirect('index.php?n=admin&sub=realms',1);
}elseif($_GET['action']=='delete' && $_GET['id']){
    $DB->query("DELETE FROM realmlist WHERE id=?d LIMIT 1",$_GET['id']);
    redirect('index.php?n=admin&sub=realms',1);
}

?>