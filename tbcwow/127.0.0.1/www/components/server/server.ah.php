<?php
if(INCLUDED!==true)exit;

//Character Table Functions
function getPlayerNameByGuid($guid) {
	global $CHDB;
	$name = $CHDB->selectCell("select name from `characters` where guid = ? Limit 1", $guid);
	return $name;
}
function getPlayerAcctByGuid($guid) {
	global $CHDB;
	$account = $CHDB->selectCell("select account from `characters` where guid = ? Limit 1", $guid);
	return $account;
}
function getPlayerAcctByName($name) {
	global $CHDB;
	$account = $MGDB->selectCell("select account from `characters` where name = ? Limit 1", $name);
	return $account;
}
function getPlayerGuidByName($name) {
	global $CHDB;
	$guid = $CHDB->selectCell("select guid from `characters` where name = ? Limit 1", $name);
	return $guid;
}
function getCharGuidsByAcct($acct) {
	global $CHDB;
	$guids = $CHDB->selectCol("select guid from `characters` where account = ? Order by guid", $acct);
	return $guids;
}
function getCharNamesByAcct($acct) {
	global $CHDB;
	$names = $CHDB->selectCol("select name from `characters` where account = ? Order by name", $acct);
	return $names;
}

//Item Table Functions
function getItemNameByEntry($entry) {
	global $MGDB;
	$name = $MGDB->selectCell("select name from item_template where entry = ? Limit 1", $entry);
	return $name;
}

/*
function getItemNameByGuid($guid) {
	global $MGDB;
	$name = $MGDB->selectCell("select name from item_template where entry = ? Limit 1", $guid);
	return $name;
}
*/
function explodeItemData($itemguid) {
	global $CHDB;
			$data = $CHDB->selectCell("select data from `item_instance` where guid = ?", $itemguid);
			$data_e = explode(' ', $data);
			$item_explode = array();
			$item_explode['quantity'] = $data_e[14];
			return $item_explode;
}
//SELECT itemguid, item_template, itemowner, buyoutprice, `time`, buyguid, lastbid, startbid from `auctionhouse`

$pathway_info[] = array('title'=>$lang['module_ah'],'link'=>'');



global $MGDB, $CHDB;

$MGDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['db_username'].":".$mangos['db_password']."@".$mangos['db_host'].":".$mangos['db_port']."/".$mangos['db_name']."");
$CHDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");

$item = $_GET['iname'];
$option = $_GET['o'];

$more = $_GET['m'];
$s = $_GET['s'];

function auctionHouse() {
	global $MGDB, $CHDB;
//	$limit = "LIMIT ".$limit_start.",".$items_per_pages;

	$query = array();
	$query = $CHDB->select("SELECT itemguid, item_template, itemowner, buyoutprice, `time`, buyguid, lastbid, startbid from `auctionhouse`  $filter");

	$cc1 = 0;
	$ah_entries = array();
	foreach ($query as $result) {
		$itemplate_query = $MGDB->selectRow("SELECT name, class, quality from item_template where entry = ?", $result['item_template']);
		$ah_entries[$cc1]['itemname'] = $itemplate_query['name'];
		$ah_entries[$cc1]['class'] = $itemplate_query['class'];
		$ah_entries[$cc1]['quality'] = $itemplate_query['quality'];
		
		$ah_entries[$cc1]['item_entry'] = $result['item_template'];

		$itemdata = explodeItemData($result['itemguid']);
		$ah_entries[$cc1]['quantity'] = $itemdata['quantity'];

		$ah_entries[$cc1]['seller'] = getPlayerNameByGuid($result['itemowner']);

		$ah_entries[$cc1]['time'] = $result['time'];

		if($result['buyguid']==0) {
			$ah_entries[$cc1]['buyer'] = "---";
			$ah_entries[$cc1]['currentbid'] = $result['startbid'];
		}
		else {
			$ah_entries[$cc1]['buyer'] = getPlayerNameByGuid($result['buyguid']);
			$ah_entries[$cc1]['currentbid'] = $result['lastbid'];
		}

		if($result['buyoutprice']==0) {
			$ah_entries[$cc1]['buyout'] = "---";
		}
		else {
			$ah_entries[$cc1]['buyout'] = $result['buyoutprice'];
		}
		$cc1++;
	}


	if($_GET['sort']!=null) {
		usort($ah_entries, "ah_str_cmp");
	}


	return $ah_entries;
}

function ah_str_cmp ($a, $b) {
	$mod = 1;

	if($_GET['d']==1) {
		$mod *= -1;
	}
	elseif($a[$_GET['sort']] == "---" || $b[$_GET['sort']] == "---") {
		$mod *= -1;
	}

	return $mod * strnatcmp($a[$_GET['sort']], $b[$_GET['sort']]);
}

$ah_entry = auctionHouse()
?>
