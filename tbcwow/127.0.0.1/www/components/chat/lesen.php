<?php
//@session_start();
include ("tpl.inc.php"); // Template Klasse
include ("config.php"); // Externe Configdatei

$pet = new pet();
$pet->readFile($template."/lesen.tpl.htm");
$pet->assign($refresh, "refresh");
$pet->parse();
$pet->output();
?>