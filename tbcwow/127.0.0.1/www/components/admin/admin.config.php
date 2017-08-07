<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['site_config'],'link'=>'');
// ==================== //

$items = $DB->select("SELECT * FROM site_settings ORDER BY `type`,`key`");

if($_GET['action']){
    chmod('core/cache/',0777);
    $cache_str = "<?php\n";
    foreach($items as $item){
    $DB->query("UPDATE site_settings SET `value`=? WHERE `key`=? LIMIT 1",$_POST[$item['key']],$item['key']);
        $typedvalue = $_POST[$item['key']];
        if($item['type']=='string'){$typedvalue = '\''.$typedvalue.'\'';}
        elseif($item['type']=='bool'){$typedvalue = $typedvalue==1?'true':'false';}
        elseif($item['type']=='int'){$typedvalue = (INT)$typedvalue;}
        $cache_str .= '$config[\''.$item['key'].'\'] = '.$typedvalue.';'."\n";
    }
    $cache_str .= "?>";
    file_put_contents('core/cache/config_cache.php',$cache_str);
    redirect('index.php?n=admin&sub=config',1);
}
?>