<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['personal_messages'],'link'=>'index.php?n=account&sub=pms');
// ==================== //
if($user['id']<=0){
  redirect('index.php?n=account&sub=login',1);
}else{

if(!$_GET['action']){$_GET['action']='view';$_GET['dir']='in';}

$items = array();
if($_GET['action']=='view' && $_GET['dir']=='in'){
    if($_POST['deletem']=='deletem' && is_array($_POST['checkpm'])){
      $DB->query("DELETE FROM pms WHERE owner_id=? AND id IN (?a)",$user['id'],$_POST['checkpm']);
      redirect('index.php?n=account&sub=pms',1);
    }
  $pathway_info[] = array('title'=>$lang['inbox'],'link'=>'');
    //===== Calc pages =====//
    $items_per_pages = 16;
    $itemnum = $DB->selectCell("SELECT count(*) FROM pms WHERE owner_id=?d",$user['id']);
    $pnum = ceil($itemnum/$items_per_pages);
    $limit_start = ($p-1)*$items_per_pages;
  $items = $DB->select("SELECT pms.*, account.username AS sender FROM pms LEFT JOIN account ON pms.sender_id=account.id WHERE owner_id=?d ORDER BY posted DESC LIMIT ?d, ?d",$user['id'],$limit_start,$items_per_pages);
}elseif($_GET['action']=='view' && $_GET['dir']=='out'){
/*
  $pathway_info[] = array('title'=>'Outgoing','link'=>'');
  $items = $DB->select("SELECT * FROM `pms` WHERE `sender_id`=?d AND `showed`='0' ORDER BY `posted` DESC",$user['id']);
    */
}elseif($_GET['action']=='viewpm' && $_GET['iid']){
    $pathway_info[] = array('title'=>$lang['post_view'],'link'=>'');
  $item = $DB->selectRow("SELECT * FROM pms WHERE owner_id=?d AND id=?d LIMIT 1",$user['id'],$_GET['iid']);
    $senderinfo = $auth->getprofile($item['sender_id']);
  if($item['id']>0 && $item['showed']!=1){
    $DB->query("UPDATE pms SET showed=1 WHERE id=?",$item['id']);
  }
}elseif($_GET['action']=='add'){
    $content['message'] = '';
    $content['subject'] = '';
    $content['sender'] = '';
    if($_POST['owner'] && $_POST['title'] && $_POST['message']){
      $title = trim($_POST['title']);
      $message = my_preview($_POST['message']);
      $sender_id = $user['id'];
      $sender_ip = $user['ip'];
      $owner_id = $auth->getid($_POST['owner']);
      if($owner_id > 0){
        $DB->query("INSERT INTO `pms` (`owner_id`,`subject`,`message`,`sender_id`,`posted`,`sender_ip`) 
            VALUES (?d,?,?,?d,?d,?)",$owner_id,$title,$message,$sender_id,time(),$sender_ip);
        redirect('index.php?n=account&sub=pms',1);
      }else{
        output_message('alert',$lang['no_such_addr']);
      }
    }
  if($_GET['reply']){
    $content = $DB->selectRow("SELECT pms.*, account.username AS sender FROM pms LEFT JOIN account ON pms.sender_id=account.id WHERE owner_id=?d AND pms.id=?d",$user['id'],$_GET['reply']);
    $content['message'] = '[blockquote="'.$content['sender'].' | '.date('d-m-Y, H:i:s',$content['posted']).'"] '.my_previewreverse($content['message']).'[/blockquote]';
    $pathway_info[] = array('title'=>$lang['post_reply_to'].'"'.$content['subject'].'"','link'=>'');
    $content['subject'] = '[re:] '.$content['subject'];
  }else{
    $pathway_info[] = array('title'=>$lang['newmessage'],'link'=>'');
    if($_GETVARS['to'])$content['sender'] = $_GETVARS['to'];
        if($_GETVARS['topic'])$content['subject'] = $_GETVARS['topic'];
  }
}

}
?>