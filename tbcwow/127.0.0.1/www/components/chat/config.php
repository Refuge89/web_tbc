<?php
// Config Datei von ET-Chat v2.1a
// Hier k�nnen sie die individuellen Anpassungen vornehmen.
//--------------------------------------------------------------------
$angezeigt_werden = 22;
// Wie viele Messages im Chat angezeigt werden
// Mehr als 50 sind wegen der Performance nicht zu empfehlen!
//--------------------------------------------------------------------
$refresh = 4000;
// in Millisekunden. Aktuallisierung der Messages im Ruhestand.
// es darf im Bereich von 1000 bis 10000 Millisekunden liegen
//--------------------------------------------------------------------
$sichbarkeit_der_alten_eintraege = true;
// Bei TRUE sind f�r die neuen Chatg�ste alle alten Eintr�ge sichtbar.
// Bei FALSE werden nur die Eintr�ge angezeigt, die seit der Ankunft
// des Anwenders erstellt wurden.
//--------------------------------------------------------------------
$privates_erlauben = true;
// Bei TRUE k�nnen von allen Benutzern private Messages versandt werden.
// Bei FALSE werden private Messges f�r alle untersagt.
//--------------------------------------------------------------------
$pass_fuer_admin = $config['chat_adminpass']; // hier w�hlen Sie das Passwort f�r den admin.php
// Um unerw�nschte Chatteilnehmer zu sperren, rufen Sie die Datei admin.php auf ihrem Server auf
// z.B: http://www.meineseite.de/et-chat-ordner/admin.php
// Loggen Sie sich mit dem Adminkennwort ein und sperren Sie von dort aus den Anwender.
//--------------------------------------------------------------------
$farben_array = array("000000", "0000ab", "0000ff", "ff00ff", "ab0000", "ff0000", "ffc600", "00cc00", "008f00", "00c9cb");
// Farben in der Eingabeleiste. K�nnen ver�ndert oder hinzugef�gt werden
//--------------------------------------------------------------------
$template = "grey_tpl"; // Auswahl des Layouts / Skin's (Verzeichnisname)
// ******************************************************** //
// Die Nichtbeachtung der oben aufgef�hrten Regeln f�hrt zu //
// Fehlern im Programm und Server�berlastung!!!!            //
// ******************************************************** //
?>