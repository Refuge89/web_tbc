<HTML>
<HEAD>
<TITLE>Administrationsbereich</TITLE>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>

<?php
//=================================================================
//============ Passwortabfrage ====================================
//=================================================================
 include ("config.php"); // Externe Configdatei

if (empty($_POST['id'])) $id=1;
else $id=$_POST['id']+1;

if ($_POST['pass'] != $pass_fuer_admin) {
	print("
	<title>Adminpanel - passwordrequest</title>
	<center>
	<h3>Adminpanel - passwordrequest</h3><br><br>
	Login try: $id <br>
	<form action=\"$PHP_SELF\" method=\"post\">
	<input name=\"pass\" type=\"password\">\n 
	<input name=\"id\" type=\"hidden\" value=\"$id\">\n
	<input name=\"ok\" type=\"submit\" value=\"   OK   \">
	</form>
	</center>"); 
	exit();
	}
//=================================================================
//============ ENDE Passwortabfrage ===============================
//=================================================================
?>
<BODY>
<table width="700" border="0" align="center">
  <tr>
    <td width="350" align="right" valign="top">

<?php 
//=================================================================
//============ WER IST IM CHAT ? ==================================
//=================================================================
	  $name = "online.csv";  // Filename to write in
      $trenner = "¦"; // Trenner für die CSV Datei
	  $sessionlaenge = 2 * ($refresh+1) + 2; // Sekunden
	  $sek_seit70 = date("U");
	  
	  
	$datei=fopen($name,"r");
 	$groesse=filesize($name);
	$data=fgetcsv($datei,$groesse,$trenner);

	while($data!=false){
		if (($sek_seit70-$data[1] < $sessionlaenge) and  ($data[0]!="")) { 
		
				$i++;
				$name_online[$i] = $data[0]."¦".$data[2];
			
			}
		$data=fgetcsv($datei,$groesse,$trenner);
		}
	fclose($datei);
	
	$eintraege = count($name_online);
	$name_online = @array_unique($name_online);
	
	
	print("<br><form name=\"sperren\" action=\"admin.php\" method=\"post\">\n
			<input name=\"pass\" type=\"hidden\" value=\"$pass_fuer_admin\">\n
  			<select name=\"usersperren\" size=\"4\">");
		
	for($i=0; $i < $eintraege+1; $i++){
	if ($name_online[$i]!=""){ 
		list($username,$ip)=explode("¦",$name_online[$i]);
		
		print("<option value=\"$ip\">$username - $ip</option>\n");
			
		}
	}
	print("</select>
			<input type=\"Submit\" value=\"Ban &gt;&gt;\">
			</form>");
?>
</td>
<td width="350" align="left" valign="top">
<?php 
$nameu = "gesperrt.csv";  // Filename to write in

if ($HTTP_POST_VARS["usersperren"] != "") 
	{
		$us = $HTTP_POST_VARS["usersperren"];
		$dat=fopen($nameu,"a");
        fwrite($dat,$us."\n");
        fclose($dat); 
	}
	

if ($HTTP_POST_VARS["userentsperren"] != "") 
	{
		$usent = $HTTP_POST_VARS["userentsperren"];
		
		$datei = fopen($nameu,"r");
		$dateigroesse = filesize($nameu);
		$inhalt = fread($datei,$dateigroesse);
		fclose($datei);

		$ersetzen=str_replace($usent."\n","",$inhalt);

		$datei = fopen($nameu,"w");
		fwrite($datei,$ersetzen);
		fclose($datei);
	}



	$datei=fopen($nameu,"r");
 	$groesse=filesize($nameu);
	$data=fgetcsv($datei,$groesse,";");
	
			print("<form name=\"entsperren\" action=\"admin.php\" method=\"post\">\n
				   <input name=\"pass\" type=\"hidden\" value=\"$pass_fuer_admin\">\n
  					Blacklist:<br><select name=\"userentsperren\" size=\"4\">");
			
	while($data!=false){
			print("<option value=\"$data[0]\">$data[0]</option>\n");
		$data=fgetcsv($datei,$groesse,";");
		}	
			print("</select>
			<input type=\"Submit\" value=\"Unban!\">
			</form>");
	fclose($datei);

?>	
</td>
</tr>
</table>
</BODY>
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</HTML>