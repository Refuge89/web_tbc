<?php
if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['register'],'link'=>'');

if ($config['site_register'] == 0)
{
      output_message('alert','Registration: Locked');
}
else
{
$regparams = array(
            'MIN_LOGIN_L' => 3,
            'MAX_LOGIN_L' => 16,
            'MIN_PASS_L'  => 4,
            'MAX_PASS_L'  => 16
            );
// ==================== //
if($user['id']>0){
    redirect('index.php?n=account&sub=manage',1);
}
$allow_reg = true;
if($_POST['step'] && (bool)$config['req_reg_key'] === true){
  if($auth->isvalidregkey($_POST['r_key'])!==true){
    output_message('alert',$lang['bad_reg_key']);
    $allow_reg = false;
  }
}
if($config['max_accounts_per_ip']>0){
    $count_ip = $DB->selectCell("SELECT count(*) FROM account_extend WHERE registration_ip=?",$_SERVER['REMOTE_ADDR']);
    if($count_ip>=$config['max_accounts_per_ip']){
        output_message('alert',$lang['reg_acclimit']);
    $allow_reg = false;
    }
}
if($_POST['step']==3){
  if($allow_reg === true){
    if($auth->register(array('username'=>$_POST['r_login'],'sha_pass_hash'=>sha_password($_POST[r_login],$_POST['r_pass']),'I2'=>sha_password($_POST[r_login],$_POST['r_cpass']),'email'=>$_POST['r_email'],'tbc'=>$_POST['r_tbc']))===true){
      if((bool)$config['req_reg_key'] === true)$auth->delete_key($_POST['r_key']);
      if((bool)$config['req_reg_act']!==true)$auth->login(array('username'=>$_POST['r_login'],'sha_pass_hash'=>sha_password($_POST[r_login],$_POST['r_pass'])));
      $reg_succ = true;
    }else{
      output_message('alert',$lang['ref_fail']);
      $reg_succ = false;
    }
  }
}
}
?>
