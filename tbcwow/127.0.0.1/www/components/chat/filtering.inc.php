<?php
// FILTERUNG der Eingabewerte
function filtering($m){

	//$m = str_replace("& ", "&amp; " , $m);
	$m = str_replace("<", "&lt;" , $m);
	$m = str_replace(">", "&gt;" , $m);
	/*
	$m = str_replace("/", "&#47;" , $m);
	$m = str_replace("ä", "&auml;" , $m);
	$m = str_replace("ü", "&uuml;" , $m);
	$m = str_replace("ö", "&ouml;" , $m);
	$m = str_replace("Ä", "&Auml;" , $m);
	$m = str_replace("Ö", "&Ouml;" , $m);
	$m = str_replace("Ü", "&Uuml;" , $m);
	$m = str_replace("ß", "&szlig;" , $m);
	$m = str_replace(" ", "&nbsp;" , $m);*/


	// ANFANG Smilies!!!!!!!!! :-)
	$m = str_replace(":-))", "<img src=\"smilies/biggrin.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-?", "<img src=\"smilies/confused.gif\" width=\"15\" height=\"22\">" , $m);
	$m = str_replace("8-)", "<img src=\"smilies/cool.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-0", "<img src=\"smilies/crying.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace("8-0", "<img src=\"smilies/eek.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-%", "<img src=\"smilies/evil.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-(", "<img src=\"smilies/frown.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace("*-(", "<img src=\"smilies/mad.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-]", "<img src=\"smilies/pleased.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace("|-0", "<img src=\"smilies/redface.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-|", "<img src=\"smilies/rolleyes.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-)", "<img src=\"smilies/smile.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(":-~", "<img src=\"smilies/tongue.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace("[-)", "<img src=\"smilies/tongue2.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace(";-)", "<img src=\"smilies/wink.gif\" width=\"15\" height=\"15\">" , $m);
	$m = str_replace("=-)", "<img src=\"smilies/happy.gif\" width=\"15\" height=\"15\">" , $m);
	// ENDE   Smilies!!!!!!!!! :-)

	// Diese Funktion wandelt die URL in Links um
	$m = eregi_replace("(http://[^ )\r\n]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $m);


	// Bad Word Filter
	if (file_exists("bad_words.txt")){

		$inhalt_des_bad_word_files = file("bad_words.txt");

		foreach($inhalt_des_bad_word_files as $bad_word_array){

			list($bad_word, $good_word) = explode(">", $bad_word_array);
			$bad_word = chop(trim($bad_word));
			$good_word = chop(trim($good_word));
			$m = eregi_replace($bad_word, $good_word , $m);
			}
		}
	// ENDE Bad Word Filter

	return $m;
	}
?>