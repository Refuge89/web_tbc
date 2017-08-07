<?php
@session_start();
@session_unset();
@session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title><<< ET - Chat v2.1a &copy; >>></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<frameset rows="100%,*" cols="*" frameborder="NO" border="0" framespacing="0">

<frameset rows="*,80" cols="*" frameborder="NO" border="0" framespacing="0">
<frameset cols="*,180" frameborder="NO" border="0" framespacing="0">
  <frame src="lesen.php#bot" name="oben">
  <frame src="online.php" name="seite" scrolling="NO" noresize>
</frameset>
  <frame src="anmeldung.php" name="unten" scrolling="NO" noresize>
</frameset>

<frame src="reloader.php" name="reloader" scrolling="NO" noresize>
</frameset>
<noframes><body>

</body></noframes>
</html>