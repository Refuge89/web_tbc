<?php 
define('SMARTY_DIR', 'smarty/smarty/'); 
if(!file_exists(SMARTY_DIR.'Smarty.class.php'))
	trigger_error("You need Smarty for this example!", E_USER_ERROR);	
require(SMARTY_DIR . 'Smarty.class.php'); 
$smarty = new Smarty;

require_once("cache.php");
require_once("smarty/block.cache.php");

$cache = new Cache(".");
$smarty->cache = &$cache;
$smarty->register_block("cache","smarty_block_cache");

$smarty->template_dir = 'smarty'; 
$smarty->compile_dir = 'smarty'; 
$smarty->config_dir = 'smarty'; 
$smarty->cache_dir = 'smarty'; 

$smarty->assign('date',date("H:i:s")); 

$smarty->display('test_06_smarty.tpl');

?>