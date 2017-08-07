<?php

session_start();


	  include ("filtering.inc.php"); // Externe Filterfunktion
	  include ("tpl.inc.php"); // Template Klasse
	  include ("config.php"); // Template Klasse

      $name = "chat.csv";  // Filename to write in
	  $nameonline = "online.csv";  // Wer ist online?
	  $nameu = "gesperrt.csv"; // Blacklist
      $trenner = "¦"; // Trenner für die CSV Datei
	  $loechen_nach = $angezeigt_werden * 4;


	  $userip = $_SERVER['REMOTE_ADDR'];
	  $rnd = rand(1,999999999); // Die Message MUSS EINZIGARTIG sein!!!!!!!!!
	  $sek_seit70 = date("U");
	  $time = date("H:i");
	  $username = $_SESSION["u"];
	  $neu = $_POST['neu'];
	  $message = $_POST['message'];
	  if($_POST['privat']=="true") $privat_name = $_POST['privat_name'];
	  else $privat_name = "";



// ANFANG ### Textlayout ********************************

	// ANFANG ### FILTER HTML ********************************
	//$message = strip_tags($message); // No HTML Tags
	$username = filtering($username);
	$message = filtering($message);
	// ENDE ##### FILTER HTML ********************************

	// ANFANG ### USERNAME LEER **********************************
	if (empty($username)) {
	echo "ERROR! Während der Datenübermittlung ist ein Fehler aufgetreten. Versuchen Sie sich erneut anzumelden und überprüfen Sie ob die Cookies in Ihrem Browser aktiviert sind.<br><a href=\"anmeldung.php\">Zur Anmeldung >></a>";
	exit(); }
	// ENDE ##### USERNAME LEER **********************************


		$farbe = strip_tags($_POST['farbe']);
		$fett = strip_tags($_POST['fett']);
		$kursiv = strip_tags($_POST['kursiv']);

	if ($message != ""){
		if($kursiv=="true" and $fett=="true") $message = "<b><i><font color=\"#$farbe\" class=\"normal\">$message</font></i></b>";
		if($kursiv=="true" and $fett=="false") $message = "<i><font color=\"#$farbe\" class=\"normal\">$message</font></i>";
		if($kursiv=="false" and $fett=="true") $message = "<b><font color=\"#$farbe\" class=\"normal\">$message</font></b>";
		if($kursiv=="false" and $fett=="false") $message = "<font color=\"#$farbe\" class=\"normal\">$message</font>";
	}
// ENDE ##### Textlayout ********************************


//*********************************************************************************************
//****************** ANFANG Daten in CSV abspeichern ******************************************
//*********************************************************************************************
if ($message != "") {

 $bol=file_exists($name);
 if($bol){

 // ANFANG ### Anzahl der Datensätze bestimmen in CSV und in Löcharray einfügen
 	$datensaetze=0;
  	$datei=fopen($name,"r");
 	$groesse=filesize($name);
	$data=fgetcsv($datei,$groesse,$trenner);

	while($data!=false){
		$datensaetze++;
		$data=fgetcsv($datei,$groesse,$trenner);
		}
	fclose($datei);

	$vieviel_muss_leloescht_werden = $datensaetze - $loechen_nach; // Vieviel ist zu Löchen

//print("<br>vieviel_muss_leloescht_werden = ".$vieviel_muss_leloescht_werden);
//print("<br>datensaetze = ".$datensaetze);
//print("<br>loechen_nach = ".$loechen_nach);
//*****************************************************************

	if ($vieviel_muss_leloescht_werden > 0) {

  	$datei=fopen($name,"r");
 	$groesse=filesize($name);
	$data=fgetcsv($datei,$groesse,$trenner);

		for($i=0; $i<$vieviel_muss_leloescht_werden; $i++){
			$loeschen[$i]= $data[0].$trenner.$data[1].$trenner.$data[2].$trenner.$data[3].$trenner.$data[4].$trenner.$data[5].$trenner.$data[6]."\n";
			//echo "<br>array [$i] = $loeschen[$i]";
			$data=fgetcsv($datei,$groesse,$trenner);
			}
	//print("<br>i (zu löschen) = ".$i);
	fclose($datei);
 	}

if ($vieviel_muss_leloescht_werden < 1) $i = 0;
 // ENDE ##### Anzahl der Datensätze bestimmen in CSV und in Löcharray einfügen

 // ANFANG ### Löschung vornehmen
if ($vieviel_muss_leloescht_werden > 0) {
for($a=0;$a<$i;$a++){
$datei = fopen($name,"r");
$dateigroesse = filesize($name);
$inhalt = fread($datei,$dateigroesse);
fclose($datei);
//echo "<br>gelöscht array [$a]";
$ersetzen=str_replace($loeschen[$a],"",$inhalt); // Die Message MUSS EINZIGARTIG sein!!!!!!!!!

$datei = fopen($name,"w");
fwrite($datei,$ersetzen);
fclose($datei);}
}
 // ENDE ###### Löschung vornehmen

}
 $dat=fopen($name,"a");
        fwrite($dat,$userip.$trenner.$rnd.$trenner.$username.$trenner.$message.$trenner.$sek_seit70.$trenner.$time.$trenner.$privat_name."\n");
        fclose($dat);
}
//*********************************************************************************************
//****************** ENDE Daten in CSV abspeichern ********************************************
//*********************************************************************************************

?>