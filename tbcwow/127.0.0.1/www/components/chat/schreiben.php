<?php session_start();


	  include ("filtering.inc.php"); // Externe Filterfunktion
	  include ("tpl.inc.php"); // Template Klasse
	  include ("config.php"); // Template Klasse

	  $name = "chat.csv";  // Filename to write in
	  $trenner = "¦"; // Trenner für die CSV Datei
	  $userip = $_SERVER['REMOTE_ADDR'];
	  $rnd = rand(1,999999999); // Die Message MUSS EINZIGARTIG sein!!!!!!!!!
	  $sek_seit70 = date("U");
	  $time = date("H:i");
	  $username = $_SESSION["u"];
	  $neu = $_POST['neu'];





// ANFANG ### WENN NEU
if ($neu == "ja" && !empty($username)) {
	$message = "<font color=\"#999999\"><i>comes into chat...</i> :-)</font>"; //Begrüssung für neue User
	$dat=fopen($name,"a");
    fwrite($dat,$userip.$trenner.$rnd.$trenner.$username.$trenner.$message.$trenner.$sek_seit70.$trenner.$time.$trenner."\n");
    fclose($dat);
	}


// ENDE ##### WENN NEU





	  // Initialisierung der TPL Klasse
$pet = new pet();
$pet->readFile($template."/schreiben.tpl.htm");


//************* Farben Auswahl ******************
foreach($farben_array as $einzelne_farbe){
if ($farbe==$einzelne_farbe) $str="<option value=\"$einzelne_farbe\" style=\"background-color:#$einzelne_farbe; color:#$einzelne_farbe\" selected>&nbsp;&nbsp;&nbsp;&nbsp;</option>";
else $str="<option value=\"$einzelne_farbe\" style=\"background-color:#$einzelne_farbe; color:#$einzelne_farbe\">&nbsp;&nbsp;&nbsp;&nbsp;</option>";
$options.=$str."\n";
}

$f="<input name=\"fett\" type=\"checkbox\" class=\"input1\" value=\"true\">";

$k="<input name=\"kursiv\" type=\"checkbox\" class=\"input1\" value=\"true\">";

if($privates_erlauben){
	if ($_POST['privat']) $privat_ausgabe="(Privat:<input name=\"privat\" type=\"checkbox\" class=\"input1\" value=\"true\" disabled=\"true\" checked>)";
	else $privat_ausgabe="(Privat:<input name=\"privat\" type=\"checkbox\" class=\"input1\" value=\"true\" disabled=\"true\">)";
	$pet->assign($privat_ausgabe, "privat");}

$pet->assign($options, "options");
$pet->assign($f, "f");
$pet->assign($k, "k");
$pet->parse();
$pet->output();
?>