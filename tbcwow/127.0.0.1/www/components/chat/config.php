<?php
// Config Datei von ET-Chat v2.1a
// Hier können sie die individuellen Anpassungen vornehmen.
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
// Bei TRUE sind für die neuen Chatgäste alle alten Einträge sichtbar.
// Bei FALSE werden nur die Einträge angezeigt, die seit der Ankunft
// des Anwenders erstellt wurden.
//--------------------------------------------------------------------
$privates_erlauben = true;
// Bei TRUE können von allen Benutzern private Messages versandt werden.
// Bei FALSE werden private Messges für alle untersagt.
//--------------------------------------------------------------------
$pass_fuer_admin = $config['chat_adminpass']; // hier wählen Sie das Passwort für den admin.php
// Um unerwünschte Chatteilnehmer zu sperren, rufen Sie die Datei admin.php auf ihrem Server auf
// z.B: http://www.meineseite.de/et-chat-ordner/admin.php
// Loggen Sie sich mit dem Adminkennwort ein und sperren Sie von dort aus den Anwender.
//--------------------------------------------------------------------
$farben_array = array("000000", "0000ab", "0000ff", "ff00ff", "ab0000", "ff0000", "ffc600", "00cc00", "008f00", "00c9cb");
// Farben in der Eingabeleiste. Können verändert oder hinzugefügt werden
//--------------------------------------------------------------------
$template = "grey_tpl"; // Auswahl des Layouts / Skin's (Verzeichnisname)
// ******************************************************** //
// Die Nichtbeachtung der oben aufgeführten Regeln führt zu //
// Fehlern im Programm und Serverüberlastung!!!!            //
// ******************************************************** //
?>