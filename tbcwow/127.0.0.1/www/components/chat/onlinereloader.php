<?php
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
include ("config.php"); // Externe Configdatei

//=================================================================
//============ WER IST IM CHAT ? ==================================
//=================================================================

	  $name = "online.csv";  // Filename to write in
      $trenner = "¦"; // Trenner für die CSV Datei
	  $sessionlaenge = 3 * (($refresh/1000)+1) + 2; // Sekunden
	  $sek_seit70 = date("U");


	$datei=fopen($name,"r");
 	$groesse=filesize($name);
	$data=fgetcsv($datei,$groesse,$trenner);

	while($data!=false){
		if (($sek_seit70-$data[1] < $sessionlaenge) && ($data[0]!="<null>")) {

				$i++;
				$name_online[$i] = $data[0];

			}
		$data=fgetcsv($datei,$groesse,$trenner);
		}
	fclose($datei);

	$eintraege = count($name_online);
	$name_online = @array_unique($name_online);

	if ($i=="") $user_im_chat=0;
	else $user_im_chat = count($name_online);

	@array_multisort($name_online); // User Alphabetisch sortieren für die Ausgabe

	echo"
	<span class=\"normal\">User in Chat: $user_im_chat</span>
	<hr width=\"100\" align=\"middle\" size=\"1\" noshade><br>";

	for($i=0; $i < $eintraege+1; $i++){
		if ($name_online[$i]!=""){
			echo "<b><a href=\"javascript:parent.unten.sendTo('".$name_online[$i]."')\" target=\"unten\">".$name_online[$i]."</a><b><br>\n";
		}
	}

?>