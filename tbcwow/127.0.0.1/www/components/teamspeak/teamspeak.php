<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="teamspeak.css" rel="stylesheet" type="text/css">
		<link href="/teamspeakdisplay/teamspeakdisplay.css" rel="stylesheet" type="text/css">
<?php
	if (isset($_GET['autorefresh'])) {
		$autorefresh = $_GET['autorefresh'];
	} else {
		$autorefresh = 0;
	}
	if ($autorefresh == 1) {
		echo("		<meta http-equiv=\"refresh\" content=\"10; URL=" . $_SERVER["PHP_SELF"] . "?autorefresh=1\">\n");
	}
?>
	</head>
	<body>
<?php
	// The code between the 2 lines below turns on PHPs error handlers.
	// Uncomment it for debugging purposes, but leave commented in live
	// environments. Having your script running in a live environment with the
	// error handlers turned on, decreases your sites security as a warning may
	// reveal information used to exploit security holes in your site.
	//================== BEGIN OF ERROR REPORTING CODE ====================
	//echo("<span style=\"color: #dd0000; font-weight: bold\">Error reporting ");
	//echo("is currently on. Turn it off in live environments !</span><br><br>\n");
	//error_reporting(E_ALL);
	//ini_set("display_errors", "1");
	//ini_set("display_startup_errors", "1");
	//ini_set("ignore_repeated_errors", "0");
	//ini_set("ignore_repeated_source", "0");
	//ini_set("report_memleaks", "1");
	//ini_set("track_errors", "1");
	//ini_set("html_errors", "1");
	//ini_set("warn_plus_overloading", "1");
	//================== END OF ERROR REPORTING CODE ======================
	
	// Load the Teamspeak Display:
	require("teamspeakdisplay/teamspeakdisplay.php");
	
	// Get the default settings
	$settings = $teamspeakDisplay->getDefaultSettings();
	
	//================== BEGIN OF CONFIGURATION CODE ======================
	
	// Set the teamspeak server IP or Hostname below (DO NOT INCLUDE THE
	// PORT NUMBER):
	$settings["serveraddress"] = $config['ts_ip'];
	
	// If your you use another port than 8767 to connect to your teamspeak
	// server using a teamspeak client, then uncomment the line below and
	// set the correct teamspeak port:
	$settings["serverudpport"] = $config['ts_port_udp'];
	
	// If your teamspeak server uses another query port than 51234, then
	// uncomment the line below and set the teamspeak query port of your
	// server (look in the server.ini of your teamspeak server for this
	// portnumber):
	//$settings["serverqueryport"] = 51234;
	
	// If you want to limit the display to only one channel including it's
	// players and subchannels, uncomment the following line and set the
	// exact name of the channel. This feature is case-sensitive!
	//$settings["limitchannel"] = "";
	
	// If your teamspeak server uses another set of forbidden nickname
	// characters than "()[]{}" (look in your server.ini for this setting),
	// then uncomment the following line and set the correct set of
	// forbidden nickname characters:
	//$settings["forbiddennicknamechars"] = "()[]{}";
	
	//================== END OF CONFIGURATION CODE ========================
	
	// Is the script improperly configured?
	if ($settings["serveraddress"] == "") { die("You need to configure this script as described inside the CONFIGURATION CODE block in " . $_SERVER["PHP_SELF"] . "<br>\n"); }
	
	// Display the Teamspeak server
	$teamspeakDisplay->displayTeamspeakEx($settings);
?>
	</body>
</html>
