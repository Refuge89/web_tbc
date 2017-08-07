<?php
if(INCLUDED!==true)exit;

$pathway_info[] = array('title'=>$lang['commands'],'link'=>'');
$items_per_page = 20;	// Output items limit
$defaultOpen    =  0;	// First N items that are "opened" by default.
$hl             = '';   // High lighted item
$startpage      = (isset($_GET['sp']) ? $_GET['sp'] : 1 );

$host = $mangos['db_host']; // HOST for Mangos database
$dbuser = $mangos['db_username']; // USER for Mangos database
$password = $mangos['db_password']; // PASS for Mangos database
$db = $mangos['db_name']; // NAME of Mangos database
$userlevel = ($user['gmlevel'] != '' ? $user['gmlevel'] : 0);

$WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$dbuser.":".$password."@".$host.":".$mangos['db_port']."/".$db."");
if($WSDB) {
	$WSDB->setErrorHandler('databaseErrorHandler');
	$WSDB->query("SET NAMES ".$config['db_encoding']);

	$maxtopics  = $WSDB->selectCell("
		SELECT COUNT(*)
		FROM command
		WHERE security <= $userlevel");

	$maxpages   = round($maxtopics / $items_per_page);
//	$maxpages   = 5;
	if ( ($maxpages * $items_per_page) < $maxtopics ) {
		$maxpages   += 1;
	}
	if ($startpage < 1) {
		$startpage   = 1;
	}
	if ($startpage > $maxpages) {
		$startpage   = $maxpages;
	}
	$sp   = ($startpage * $items_per_page ) - $items_per_page;
	$alltopics = $WSDB->select("
	    SELECT *
	    FROM command
	    WHERE security <= $userlevel
	    ORDER BY security ASC
	    LIMIT $sp , $items_per_page");
}

?>