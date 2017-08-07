<?php 
function messageTimestamp($timestamp, $off){
	if ($off) return true;
	if (empty($_SESSION["zeit"])) $_SESSION["zeit"] = date("U");
	else{
		if(($timestamp-$_SESSION["zeit"]) > 0) return true;
		else return false;
		}
	}
?>