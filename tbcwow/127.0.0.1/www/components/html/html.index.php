<?php
if(INCLUDED!==true)exit;
// ==================== //
if($_GET['text']=='license'){
    $pathway_info[] = array('title'=>'License','link'=>'');
    if(file_exists('lang/'.$config['lang'].'.gnu_gpl.html'))
        $content = @file_get_contents('lang/'.$config['lang'].'.gnu_gpl.html');
    else
        $content = @file_get_contents('lang/'.$config['default_lang'].'.gnu_gpl.html');
}
?>