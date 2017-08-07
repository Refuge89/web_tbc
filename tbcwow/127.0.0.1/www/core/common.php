<?php
if(!function_exists('file_put_contents')){
    function file_put_contents($file,$data)
    {
    	$handle = fopen($file, "w+");
        if(!$handle){ 
            return false; 
        }else{
            fwrite($handle, $data);
            fclose($handle);
            return true;
        }
    }
}

//// Start Php Version functions //////
if (!function_exists("str_split")) {
    function str_split($string, $length = 1) {
        if ($length <= 0) {
            trigger_error(__FUNCTION__."(): The the length of each segment must be greater then zero:", E_USER_WARNING);
            return false;
        }
        $splitted  = array();
        $str_length = strlen($string);
        $i = 0;
        if ($length == 1) {
            while ($str_length--) {
                $splitted[$i] = $string[$i++];
            }
        } else {
            $j = $i;
            while ($str_length > 0) {
                $splitted[$j++] = substr($string, $i, $length);
                $str_length -= $length;
                $i += $length;
            }
        }
        return $splitted;
    }
}

if (!function_exists("utf8_encode")){
    function utf8_encode($s) {
        return iconv('iso-8859-1', 'utf-8', $s);
    }
}
if (!function_exists("escape_string")){
function escape_string($string)
{
   if (get_magic_quotes_gpc()) {
     $string = stripslashes($string);
   }

   return mysql_real_escape_string($string);
}
}
//// Stop Php Version functions //////

function sha_password($user,$pass){
$user = strtoupper($user);
$pass = strtoupper($pass);

return SHA1($user.':'.$pass);
}

function check_for_symbols($string){
$len=strlen($string);
$alowed_chars="abcdefghijklmnopqrstuvwxyzæøåABCDEFGHIJKLMNOPQRSTUVWXYZÆØÅ0123456789";
for($i=0;$i<$len;$i++)if(!strstr($alowed_chars,$string[$i]))return TRUE;
return FALSE;

}


function get_banned($account_id,$returncont){
    global $config, $realmd, $DB;

    $get_last_ip = $DB->selectRow("SELECT last_ip FROM account WHERE id='$account_id'");
	  $db_IP = $w['get_last_ip'];

	  $ip_check = $DB->selectRow("SELECT ip FROM `ip_banned` WHERE ip='$db_IP'");
	  if ($ip_check['ip'] == FALSE){
		    if ($returncont == "1"){
			      return FALSE;
		    }
	  }
	  else{
		    if ($returncont == "1"){
			      return TRUE;
		    }
		    else{
		        return $db_IP;
		    }
	  }

}

function add_pictureletter($word){
require "config.php";
$arr = str_split($word, 1);
$arr_lower = strtolower($arr[0]);
$img = "<img src='templates/offlike/images/letters/$arr_lower[0].gif' align='left'>";

foreach($arr as $array){
if ($i > 0){
$arrfinish .= $array;
}
$i++;
}
$output = "$img$arrfinish";

return $output;
}
function random_string($counts){
    $str = "abcdefghijklmnopqrstuvwxyz";//Count 0-25
    for($i=0;$i<$counts;$i++){
        if ($o == 1){
            $output .= rand(0,9);
            $o = 0;
        }else{
            $o++;
            $output .= $str[rand(0,25)];
        }

    }
    return $output;
}
function output_message($type,$text,$file='',$line=''){
    global $messages;

    if($file)$text .= "\n<br>in file: $file";
    if($line)$text .= "\n<br>on line: $line";
    $messages .= "\n<div class=\"".$type."_box\">$text</div> \n";
}
function redirect($linkto,$type=0,$wait_sec=0){
    if($linkto){
        if($type==0){
            global $redirect;
            $redirect = '<meta http-equiv=refresh content="'.$wait_sec.';url='.$linkto.'">';
        }else{
            header("location:".$linkto);
            exit('redirecting to: '.$linkto);
        }
    }
}

function loadSettings(){
    global $config, $realmd, $DB;
    if(file_exists('core/cache/config_cache.php')){
        require_once('core/cache/config_cache.php');
    }else{
        $rows = $DB->select("SELECT * FROM site_settings");
        foreach($rows as $r){
            settype($r['value'],$r['type']);
            $realmd[$r['key']] = $r['value'];
        }
    }
}
function loadLanguages(){
    global $config;
    global $realmd;
    global $mangos;
    global $languages;
    global $lang;
    $languages = array();
    $lang = array();
    if ($handle = opendir('lang/')) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "index.html") {
                $tmp = explode('.',$file);
                if($tmp[2]=='lang')$languages[$tmp[0]] = $tmp[1];
            }
        }
        closedir($handle);
        $langfile = @file_get_contents('lang/'.$config['default_lang'].'.'.$languages[$config['default_lang']].'.lang');
        $langfile = str_replace("\n",'',$langfile);
        $langfile = str_replace("\r",'',$langfile);
        $langfile = explode('|=|',$langfile);
        foreach($langfile as $langstr){
            $langstra = explode(' :=: ',$langstr);
            if(isset($langstra[1]))$lang[$langstra[0]] = $langstra[1];
        }
        if ($config['lang'] != $config['default_lang']) {
            $langfile = @file_get_contents('lang/'.$config['lang'].'.'.$languages[$config['lang']].'.lang');
            $langfile = str_replace("\n",'',$langfile);
            $langfile = str_replace("\r",'',$langfile);
            $langfile = explode('|=|',$langfile);
            foreach($langfile as $langstr){
                $langstra = explode(' :=: ',$langstr);
                if(isset($langstra[1]))$lang[$langstra[0]] = $langstra[1];
            }
        }
    }
    
}
function Lang($var){
    global $lang;
    echo $lang[$var];
    return $lang[$var];
}
function update_settings($key,$val){
    global $DB;
    $DB->query("UPDATE site_settings SET `value`=? WHERE `key`=? LIMIT 1",$val,$key);
}
function load_smiles($dir='images/smiles/'){
    $res = array();
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "index.html") {
                $res[] = $file;
            }
        }
        closedir($handle);
    }
    return $res;
}
function send_email($to_email,$to_name,$theme,$text_text,$text_html=''){
    global $config;
    if(!$config['smtp_adress']){
        output_message('alert','Set SMTP settings in config !');
        return false;
    }
    if(!$to_email){
        output_message('alert','Field "to" is empty.');
        return false;
    }
    set_time_limit(300);
    require_once 'core/mail/smtp.php';
    $mail = new SMTP;
    $mail->Delivery('relay');
    $mail->Relay($config['smtp_adress'],$config['smtp_username'],$config['smtp_password']);
    $mail->From($config['site_email'], $config['site_title']);
    $mail->AddTo($to_email, $to_name);
    $mail->Text($text_text);
    if($text_html)$mail->Html($text_html);
    $sent = $mail->Send($theme);
    return $sent;
}
function quote_smart($value){
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    if (!is_numeric($value)) {
        $value = mysql_real_escape_string($value);
    }
    return $value;
}
function my_preview($text,$userlevel=0){
    if($userlevel<1){$text = htmlspecialchars($text);if (get_magic_quotes_gpc()){$text = stripslashes($text);} }
    $text = nl2br($text);
    $text = preg_replace("/\[b\](.*?)\[\/b\]/s","<b>$1</b>",$text);
    $text = preg_replace("/\[i\](.*?)\[\/i\]/s","<i>$1</i>",$text);
    $text = preg_replace("/\[u\](.*?)\[\/u\]/s","<u>$1</u>",$text);
    $text = preg_replace("/\[s\](.*?)\[\/s\]/s","<s>$1</s>",$text);
    $text = preg_replace("/\[hr\]/s","<hr>",$text);
    $text = preg_replace("/\[code\](.*?)\[\/code\]/s","<code>$1</code>",$text);
    //$text = preg_replace("/\[blockquote\](.*?)\[\/blockquote\]/s","<blockquote>$1</blockquote>",$text);
    if (strpos($text, 'blockquote') !== false)
    {
        if(substr_count($text, '[blockquote') == substr_count($text, '[/blockquote]')){
            $text = str_replace('[blockquote]', '<blockquote><div>', $text);
            $text = preg_replace('#\[blockquote=(&quot;|"|\'|)(.*)\\1\]#sU', '<blockquote><span class="bhead">Quote: $2</span><div>', $text);
            $text = preg_replace('#\[\/blockquote\]\s*#', '</div></blockquote>', $text);
        }
    }
    // Blizz quote <small><hr color="#9e9e9e" noshade="noshade" size="1"><small class="white">Q u o t e:</small><br>Text<hr color="#9e9e9e" noshade="noshade" size="1"></small>
    $text = preg_replace("/\[img\](.*?)\[\/img\]/s","<img src=\"$1\" align=\"absmiddle\">",$text);
    $text = preg_replace("/\[attach=(\d+)\]/se","check_attach('\\1')",$text);
    $text = preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/s","<a href=\"$1\" target=\"_blank\">$2</a>",$text);
    $text = preg_replace("/\[size=(.*?)\](.*?)\[\/size\]/s","<font class='$1'>$2</font>",$text);
    $text = preg_replace("/\[align=(.*?)\](.*?)\[\/align\]/s","<p align='$1'>$2</p>",$text);
    $text = preg_replace("/\[color=(.*?)\](.*?)\[\/color\]/s","<font color=\"$1\">$2</font>",$text);
    $text = preg_replace("/[^\'\"\=\]\[<>\w]([\w]+:\/\/[^\n\r\t\s\[\]\>\<\'\"]+)/s"," <a href=\"$1\" target=\"_blank\">$1</a>",$text);
    return $text;
}
function my_previewreverse($text){
    $text = str_replace('<br />','',$text);
    $text = preg_replace("/<b>(.*?)<\/b>/s","[b]$1[/b]",$text);
    $text = preg_replace("/<i>(.*?)<\/i>/s","[i]$1[/i]",$text);
    $text = preg_replace("/<u>(.*?)<\/u>/s","[u]$1[/u]",$text);
    $text = preg_replace("/<s>(.*?)<\/s>/s","[s]$1[/s]",$text);
    $text = preg_replace("/<hr>/s","[hr]",$text);
    $text = preg_replace("/<code>(.*?)<\/code>/s","[code]$1[/code]",$text);
    //$text = preg_replace("/<blockquote>(.*?)<\/blockquote>/s","[blockquote]$1[/blockquote]",$text);
    if (strpos($text, 'blockquote') !== false)
    {
        if(substr_count($text, '<blockquote>') == substr_count($text, '</blockquote>')){
            $text = str_replace('<blockquote><div>', '[blockquote]', $text);
            $text = preg_replace('#\<blockquote><span class="bhead">\w+: (&quot;|"|\'|)(.*)\\1\<\/span><div>#sU', '[blockquote="$2"]', $text);
            $text = preg_replace('#<\/div><\/blockquote>\s*#', '[/blockquote]', $text);
        }
    }
    $text = preg_replace("/<img src=.([^'\"<>]+). align=.absmiddle.>/s","[img]$1[/img]",$text);
    $text = preg_replace("/(<a href=.*?<\/a>)/se","check_url_reverse('\\1')",$text);
    $text = preg_replace("/<font color=.([^'\"<>]+).>([^<>]*?)<\/font>/s","[color=$1]$2[/color]",$text);
    $text = preg_replace("/<font class=.([^'\"<>]+).>([^<>]*?)<\/font>/s","[size=$1]$2[/size]",$text);
    $text = preg_replace("/<p align=.([^'\"<>]+).>([^<>]*?)<\/p>/s","[align=$1]$2[/align]",$text);
    return $text;
}
function check_url_reverse($url){
    $url = stripslashes($url);
    if(eregi('attach',$url) && eregi('attid',$url)){
        $result = preg_replace("/<a href=\"[^\'\"]*attid=(\d+)[^\'\"]*\" target=\"_blank\">.*?<\/a>/s","[attach=$1]",$url);
    }else{
        $result = preg_replace("/<a href=\"([^'\"<>]+)\" target=\"_blank\">(.*?)<\/a>/s","[url=$1]$2[/url]",$url);
    }
    return $result;
}
function check_attach($attid){
    global $DB;
	$thisattach = $DB->selectRow("SELECT * FROM f_attachs WHERE attach_id=?d",$attid);
    $ext = strtolower(substr(strrchr($thisattach['attach_file'],'.'), 1));
    if($thisattach['attach_id']){
        $res  = '<a href="'.$config['site_href'].'index.php?n=forum&sub=attach&nobody=1&action=download&attid='.$thisattach['attach_id'].'">';
        $res .= '<img src="'.$config['site_href'].'images/mime/'.$ext.'.png" alt="" align="absmiddle">';
        $res .= ' Download: [ '.$thisattach['attach_file'].' ] '.return_good_size($thisattach['attach_filesize']).' </a>';
    }
	return $res;
}
function check_image($img_file){
  global $config;
  $maximgsize = explode('x',$config['imageautoresize']);
  $path_parts = pathinfo($img_file);
  $max_width = $maximgsize[0];
  $max_height = $maximgsize[1];
  $fil_scr_res = getimagesize(rawurldecode($img_file));
  if($fil_scr_res[0]>$max_width || $fil_scr_res[1]>$max_height){
    $n_img_file = $path_parts['dirname'].'/resized_'.$path_parts['basename'];
    if(!file_exists($n_img_file)){
      require_once('includes/class.image.php');
      $img = new IMAGE;
      ob_start();
      $res = $img->send_thumbnail($img_file,$max_width,$max_height,true);
      $imgcontent = ob_get_contents();
      @ob_end_clean();
      if ($res && (@$fp = fopen($n_img_file,'w+'))) 
      {
        fwrite($fp,$imgcontent);
        fclose($fp);
      }else{
        output_message('alert','Could not create preview!');
      }
    }
    $image = $n_img_file;
  }else{
    $image = $img_file;
  }
  return $image;
}
function return_good_size($n){
	$kb_divide = 1024;
	$mb_divide = 1024*1024;
	$gb_divide = 1024*1024*1024;

	if($n < $mb_divide){$res = round(($n/$kb_divide),2).' Kb';}
	elseif($n < $gb_divide){$res = round(($n/$mb_divide),2).' Mb';}
	elseif($n >= $gb_divide){$res = round(($n/$gb_divide),2).' Gb';}
	
	return $res;
}
function default_paginate($num_pages, $cur_page, $link_to){
  $pages = array();
  $link_to_all = false;
  if ($cur_page == -1)
  {
    $cur_page = 1;
    $link_to_all = true;
  }
  if ($num_pages <= 1)
    $pages = array('<b>[ 1 ]</b>');
  else
  {   
    $tens = floor($num_pages/10);
    for ($i=1;$i<=$tens;$i++)
    {
      $tp = $i*10;
      $pages[$tp] = "<a href='$link_to&p=$tp'>$tp</a>";
    }
    if ($cur_page > 3)
    {
      $pages[1] = "<a href='$link_to&p=1'>1</a>";
      if ($cur_page != 4){
      }
    }
    for ($current = $cur_page - 2, $stop = $cur_page + 3; $current < $stop; ++$current)
    {
      if ($current < 1 || $current > $num_pages)
        continue;
      else if ($current != $cur_page || $link_to_all)
        $pages[$current] = "<a href='$link_to&p=$current'>$current</a>";
      else
        $pages[$current] = '<b>[ '.$current.' ]</b>';
    }
    if ($cur_page <= ($num_pages-3))
    {
      if ($cur_page != ($num_pages-3)){
      }
      $pages[$num_pages] = "<a href='$link_to&p=$num_pages'>$num_pages</a>";
    }
  }
  $pages = array_unique($pages);
  ksort($pages);
  $pp = implode(' ', $pages);
  return $pp;
}
?>
