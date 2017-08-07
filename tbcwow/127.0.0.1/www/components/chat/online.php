<?php
include ("tpl.inc.php"); // Template Klasse
include ("config.php"); // Externe Configdatei

$pet = new pet();
$pet->readFile($template."/online.tpl.htm");
$pet->assign($refresh*2, "refresh");
$pet->parse();
$pet->output();
?>