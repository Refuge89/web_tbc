<?php
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
session_start();
include ("config.php"); // Externe Configdatei
include ("filtering.inc.php"); // Externe Filterfunktion
include ("plugins.inc.php");


$user = filtering($_SESSION["u"]);
if (empty($user)) $user = "<null>"; // Weil manche PHP5 Versionen sonst die Zeile data[0] mit dem zweiten Wert füllen

if(empty($user)) {$user = $_POST["name"]; $_SESSION["u"] = $_POST["name"];}
if(empty($_POST["name"]) && !empty($_SESSION["u"])) $_POST["name"] = $_SESSION["u"];

$rndalt = $_POST['r'];





	// ANFANG ### Blcklist Kontrolle ********************************
	$nameu = "gesperrt.csv"; // Blacklist
	$datei=fopen($nameu,"r");
 	$groesse=filesize($nameu);
	$data=fgetcsv($datei,$groesse,";");

	while($data!=false){
			if ($data[0] == $_SERVER['REMOTE_ADDR']) {
				@session_unset();
				@session_destroy();
				print ("Sie sind gesperrt. Bitte verlassen Sie den Chat.");
				exit();
				}
		$data=fgetcsv($datei,$groesse,";");
		}

	fclose($datei);
	// ENDE ##### Blcklist Kontrolle ********************************







//********************* In die online.csv schreiben *********************
	  $refresh=$refresh/1000; // Weil in Milisek.

	  $filename = "online.csv";
	  $sek_before_del = 2 * ($refresh+1) + 5; // MUSS grösser sein als ($sessionlaenge;) in online.php

	  $rnd = rand(1,999999999); // Die Message MUSS EINZIGARTIG sein!!!!!!!!!
	  $sek_seit70=date("U");
	  $userip = $_SERVER['REMOTE_ADDR'];
	  $host = gethostbyaddr($userip);
	  $client = getenv ('HTTP_X_FORWARDED_FOR');
	  $zeitaktuell=date("H:i:s");

 $bol=file_exists($filename);
 if($bol){
 	$datei=fopen($filename,"r");
 	$groesse=filesize($filename);
	$data=fgetcsv($datei,$groesse,"¦");

	while($data!=false){
		if (($data[1]+$sek_before_del) < date("U")) { $i++;
			$loeschen.= $data[0]."¦".$data[1]."¦".$data[2]."¦".$data[3]."¦".$data[4]."¦".$data[5]."\n";
			}
		$data=fgetcsv($datei,$groesse,"¦");
		}
	fclose($datei);


$datei = fopen($filename,"r");
$dateigroesse = filesize($filename);
$inhalt = fread($datei,$dateigroesse);
fclose($datei);

$ersetzen=str_replace($loeschen,"",$inhalt);

$datei = fopen($filename,"w");
fwrite($datei,$ersetzen);
fclose($datei);

 $dat=fopen($filename,"a");
        fwrite($dat,$user."¦".$sek_seit70."¦".$userip."¦".$host."¦".$rnd."¦".$zeitaktuell."\n");
        fclose($dat);

}






// ********************************* AUSLESEN aus CHAT.CSV ****************************
$name="chat.csv";
$trenner = "¦"; // Trenner für die CSV Datei
$angezeigt_werden--;

 $bol=file_exists($name);
 if($bol){
 	$datei=fopen($name,"r");
 	$groesse=filesize($name);
	$data=fgetcsv($datei,$groesse,$trenner);

	while($data!=false){
		// Prüft ob Timestamp gesetzt und sw.
		$ausgabe_erlauben = messageTimestamp($data[4], $sichbarkeit_der_alten_eintraege);
		if($ausgabe_erlauben && (empty($data[6]) || $data[6] == $user  || (!empty($data[6]) && $data[2] == $user))){
			$x++;
			if(($data[6] == $user && !empty($user)) || (!empty($data[6]) && $data[2] == $user)) $ausgabe[$x] = "<small>(".$data[5].")</small> <b><a href=\"javascript:parent.unten.sendTo('".$data[2]."')\" target=\"unten\">".$data[2]."</a> <small>(privat)</small>:</b> ".$data[3]."<br>\n";
			else $ausgabe[$x] = "<small>(".$data[5].")</small> <b><a href=\"javascript:parent.unten.sendTo('".$data[2]."')\" target=\"unten\">".$data[2]."</a>:</b> ".$data[3]."<br>\n";
			$ausgabe[$x] = stripcslashes($ausgabe[$x]); // entfernt (\) vor Sonderzeichen
			}
		$data=fgetcsv($datei,$groesse,$trenner);
		}
	fclose($datei);

if ($user == "<null>") $user = "";

echo "<font class=\"klein\"><b>$user</b> Welcome to our chat!   ".date("H:i")."   ".date("d.m.Y")."</font><hr width=\"380\" align=\"left\" size=\"1\" noshade>";

	if ($x > $angezeigt_werden) {
		for($a=$x-$angezeigt_werden; $a<$x+1; $a++) {echo $ausgabe[$a];}
		}
	else{
		for($a=0; $a<$x+1; $a++) {echo $ausgabe[$a];}
		}

}
// ********************************* ENDE AUSLESEN aus CHAT.CSV ****************************
?>