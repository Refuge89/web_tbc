<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['retrieve_pass'],'link'=>'');
// ==================== //
if($_POST['retr_login'] && $_POST['retr_email'] && $_POST[secretq1] && $_POST[secretq2] && $_POST[secreta1] && $_POST[secreta2]){
/*Check 1*/
$username = $_POST['retr_login'];
if (check_for_symbols($username) == TRUE){
  $return = FALSE;
}
if ($DB->query("SELECT id FROM `account` WHERE username='$username'")==false){
  $username == FALSE;
  $return = FALSE;
}else{
  $d = $DB->selectRow("SELECT * FROM `account` WHERE username='$username'");
  $username = $d['id'];
  $username_name = $d['username'];
  $email = $d['email'];
  $return = TRUE;
}

/*Check 2*/
if (check_for_symbols($_POST['secreta1']) == FALSE && check_for_symbols($_POST['secreta2']) == FALSE){
  $secreta1 = $_POST['secreta1'];
  $secreta2 = $_POST['secreta2'];
  $return = TRUE;
}else{
$return = FALSE;
}


if ($return == FALSE){
output_message('alert','<b>'.$lang['fail_restore_pass'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=restore">');
}elseif($return == TRUE){
$we = $DB->selectRow("SELECT account_id FROM `account_extend` WHERE account_id='$username' AND secretq1='$_POST[secretq1]' AND secretq2='$_POST[secretq2]' AND secreta1='$_POST[secreta1]' AND secreta2='$_POST[secreta2]'");
if ($we == false){
$we = $DB->selectRow("SELECT account_id FROM `account_extend` WHERE account_id='$username' AND secretq1='$_POST[secretq2]' AND secretq2='$_POST[secretq1]' AND secreta1='$_POST[secreta2]' AND secreta2='$_POST[secreta1]'");
}
  if($we == true){
    $pas = random_string(7);
    $c_pas = sha_password($username_name,$pas);
    $DB->query("UPDATE `account` SET I='$c_pas' WHERE id='$username'");
    $DB->query("UPDATE `account` SET sessionkey=NULL WHERE id='$username'");
    output_message('notice','<b>'.$lang['restore_pass_ok'].'<br /> New password: '.$pas.'</b>');
  }else{
 output_message('alert','<b>'.$lang['fail_restore_pass'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=restore">');
  }
}

}

?>
