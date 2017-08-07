<?php
$name = chop(ltrim($_POST["username"])); //entfernt Whitespaces am Ende und am Anfang
session_start();

include ("config.php"); // Externe Configdatei
include ("filtering.inc.php"); // Externe Filterfunktion
include ("tpl.inc.php"); // Template Klasse
$nameonline = "online.csv";  // Wer ist online?
$trenner = "¦"; // Trenner für die CSV Datei
$sek_seit70 = date("U");

// Initialisierung der TPL Klasse
$pet = new pet();
$pet->readFile($template."/anmeldung.tpl.htm");


if( $name !="" ){

	// Prüfung auf erlaubtre Zeichen ********************************
	$name = str_replace("&", "+", $name);
	$name = str_replace("<", "[", $name);
	$name = str_replace(">", "]", $name);
	$name = str_replace(";", ",", $name);
	
	$name = str_replace("'", "", $name);
	$name = str_replace("\"", "", $name);
	$name = str_replace("\\", "", $name);
	// Prüfung auf erlaubtre Zeichen ********************************

	$name = filtering($name);// Externe Filterfunktion
	$_SESSION["u"] = $name;


	$datei=fopen($nameonline,"r");
 	$groesse=filesize($nameonline);
	$data=fgetcsv($datei,$groesse,$trenner);
//echo $username."<br>";
	while($data!=false){
		if (($data[0]==$name)/* and ($sek_seit70-$data[5] < 300)*/) {
			$name_exists = "ja";
			}
		$data=fgetcsv($datei,$groesse,$trenner);
		}
	fclose($datei);
	}

if($name !="" and $name_exists!="ja" and $erlauben!="nein") {
	//$pet->assign("<body bgcolor=\"#92C8F2\" onload=\"sendeAbAnOnline()\">", "body");
	$pet->assign("<body onload=\"sendeAbAnOnline()\">", "body");
	$pet->assign("<input name=\"name\" type=\"hidden\" value=\"$name\">", "name");
	echo "<span class=\"normal\">Loading...</span>";
    $pet->parse();
    $pet->output();
    exit();
}
else {
	//@session_unset();
	//@session_destroy();

	$pet->assign("<body marginheight=\"0\" marginwidth=\"0\" topmargin=\"2\" leftmargin=\"0\">", "body");
}


 if($name_exists == "ja") $warnung="The name currently exists...";
 if($erlauben == "nein") {
	if($wieviel_nicht_erlaubt > 1) $warnung="You used not allowed characters.";
	else $warnung="You used a wrong character. \"$nicht_erlaubt\" is not allowed.";
	}
$pet->assign($warnung, "warnung");
  $pet->parse();
  $pet->output();
?>