<?php
if(INCLUDED!==true)exit;

$pathway_info[] = array('title'=>$lang['playermap'],'link'=>'');

if(!$_GET['realm']){
    $realm_list = realm_list();
}elseif($_GET['realm']){
    $pos = 0;
    $realm_list = realm_list();
    $realm = $DB->selectRow("SELECT * FROM realmlist WHERE id=?d LIMIT 1",$_GET['realm']);
    
    $pathway_info[] = array('title'=>$realm['name'],'');
    
    $WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['db_username'].":".$mangos['db_password']."@".$mangos['db_host'].":".$mangos['db_port']."/".$mangos['db_name']."");
    if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
    if($WSDB)$WSDB->query("SET NAMES ".$mangos['db_encoding']);

    unset($WSDB);
    
}
function realm_list()
{
  global $DB;
  $res = $DB->selectCol("SELECT id AS ARRAY_KEY,name FROM realmlist ORDER BY name");
  return $res;
}
?>

