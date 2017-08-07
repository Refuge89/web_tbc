<table align="center" width="100%" style="font-size:0.8em;"><tr><td align="left">

<div id="container-community">
<div class="phatLootBox-top">
<h2 class="community">
<span class="hide">Registration</span>
</h2>
<span class="phatLootBox-visual comm"></span>
</div>
<div class="phatLootBox-wrapper">
<div style="background: url(<?php echo $config['template_href'];?>images/phatlootbox-top-parchment.jpg) repeat-y top right; height: 7px; width: 456px; margin-left: 2px; font-size: 1px;"></div>
<div class="community-cnt">
<?php
    if(isset($_POST['step']) && $_POST['step'] == 3 && $allow_reg === true)
    {
      if($reg_succ === true){
        if($config['req_reg_act']===true){
          echo $lang['email_sent_act'];
        }else{
          echo $lang['reg_succ'].'<meta http-equiv=refresh content="3;url='.$config['site_href'].'">';
        }
      }
    }
    elseif(isset($_POST['step']) && $_POST['step'] == 2 && $allow_reg === true)
    {
?>
<script type="text/javascript">
<!--
var MIN_LOGIN_L = <?php echo $regparams['MIN_LOGIN_L']; ?>;
var MAX_LOGIN_L = <?php echo $regparams['MAX_LOGIN_L']; ?>;
var MIN_PASS_L  = <?php echo $regparams['MIN_PASS_L']; ?>;
var MAX_PASS_L  = <?php echo $regparams['MAX_PASS_L']; ?>;
var SUCCESS = false;
function check_login(){
    if (!document.regform.r_login.value || document.regform.r_login.value.length > MAX_LOGIN_L || document.regform.r_login.value.length < MIN_LOGIN_L || !document.regform.r_login.value.match(/^[A-Za-z0-9_]+$/)) {
        $('t_login').innerHTML ='<?php echo sprintf($lang['reg_checklogin'],$regparams['MIN_LOGIN_L'],$regparams['MAX_LOGIN_L']) ?> ! ';
        $('t_login').show();
        SUCCESS = false;
    } else {
        $('t_login').hide();
        try
        {
            var request = new Ajax.Request(
                SITE_HREF+'index.php?n=ajax&sub=checklogin&nobody=1&ajaxon=1',
                {
                    method: 'get',
                    parameters: 'q=' + encodeURIComponent($F('r_login')),
                    onSuccess: function(reply){
                        if (reply.responseText == 'false') {
                            $('t_login').innerHTML ='<?php Lang('reg_checkloginex');?> ! ';
                            $('t_login').show();
                            SUCCESS = false;
                        } else {
                            SUCCESS = true;
                        }
                    }
                }
            );
        }
        catch (e)
        {
            alert('Error: ' + e.toString());
        }
    }
}
function check_pass(){
    if (!document.regform.r_pass.value || document.regform.r_pass.value.length > MAX_PASS_L || document.regform.r_pass.value.length < MIN_PASS_L) {
        $('t_pass').innerHTML = '<?php echo sprintf($lang['reg_checkpass'],$regparams['MIN_PASS_L'],$regparams['MAX_PASS_L']) ?> ! ';
        $('t_pass').show();
        SUCCESS = false;
    } else {
        $('t_pass').hide();
        SUCCESS = true;
    }
}
function check_cpass(){
    if (!document.regform.r_cpass.value || document.regform.r_pass.value!=document.regform.r_cpass.value) {
        $('t_cpass').innerHTML ='<?php Lang('reg_checkcpass');?> ! ';
        $('t_cpass').show();
        SUCCESS = false;
    } else {
        $('t_cpass').hide();
        SUCCESS = true;
    }
}
function check_email(){
    if (document.regform.r_email.value.length < 1 || !document.regform.r_email.value.match(/^[A-Za-z0-9_\-\.]+\@[A-Za-z0-9_\-\.]+\.\w+$/)) {
        $('t_email').innerHTML ='<?php Lang('reg_checkemail');?> ! ';
        $('t_email').show();
        SUCCESS = false;
    } else {
        $('t_email').hide();
        try
        {
            var request = new Ajax.Request(
                SITE_HREF+'index.php?n=ajax&sub=checkemail&nobody=1&ajaxon=1',
                {
                    method: 'get',
                    parameters: 'q=' + encodeURIComponent($F('r_email')),
                    onComplete: function(reply){
                        if (reply.responseText == 'false') {
                            $('t_email').innerHTML ='<?php Lang('reg_checkemailex');?> ! ';
                            $('t_email').show();
                            SUCCESS = false;
                        } else {
                            SUCCESS = true;
                        }
                    }
                }
            );
        }
        catch (e)
        {
            alert('Error: ' + e.toString());
        }
    }
}
function check_all(){
    check_login();
    check_pass();
    check_cpass();
    check_email();
    return SUCCESS;
}
// -->
</script>
<style media="screen" title="currentStyle" type="text/css">
p.nm, p.wm { 
        margin: 0.5em 0 0.5em 0; 
        padding: 3px; }
        
    p.nm { 
        background-color: #FEF5DA; 
        border-right: 1px solid #D0CBAF;
        border-bottom: 1px solid #D0CBAF; 
        color: #605033; }
    
    p.wm { 
        background-color: #FBD8D7; 
        border-right: 1px solid #DCBFB4;
        border-bottom: 1px solid #DCBFB4; 
        color: #6A0D0B; }
#regform label {
    display: block;
    margin-top: 1em;
}
p.nm, p.wm { 
    margin: 0px;
    margin-top: 3px;
}
</style>
    <div style="padding-left:8px;">
        <form method="post" name="regform" id="regform" onsubmit="return check_all();">
        <input type='hidden' name='r_key' value='<?php echo$_POST['r_key'];?>'>
        <input type='hidden' name='step' value='3'>
        <label for="r_login"><b><?php Lang('username');?>:</b></label><input type="text" id="r_login" name="r_login" size="40" maxlength="16" onblur="check_login();">
        <p id="t_login" style="display:none;" class="wm"></p>

        <label for="r_pass"><b><?php Lang('pass');?>:</b></label><input type="password" id="r_pass" name="r_pass" size="40" maxlength="16" onblur="check_pass();">
        <p id="t_pass" style="display:none;" class="wm"></p>

        <label for="r_cpass"><b><?php Lang('cpass');?>:</b></label><input type="password" id="r_cpass" name="r_cpass" size="40" maxlength="16" onblur="check_cpass();">
        <p id="t_cpass" style="display:none;" class="wm"></p>

        <label for="r_email"><b>Email:</b></label><input type="text" id="r_email" name="r_email" size="40" maxlength="50" onblur="check_email();">
        <p id="t_email" style="display:none;" class="wm"></p>

	  <laberl for="r_tbc"></br></br><b>Account type:</label>
	  </br>
	  <input id="r_tbc" name="r_tbc" value="0" type="radio">World of Warcraft</input>
	  </br>
	  <input id="r_tbc" name="r_tbc" value="1" type="radio" checked="checked">The Burning Crusade</input>
	  <p id="t_tbc" style="display:none;" class="wm"></p>

        <p></br><input type="submit" class="button" value="<?php Lang('register');?>"></p>
        </form>
    </div>
<?php
    }
    elseif((isset($_POST['step']) && $_POST['step']==1 || $config['req_reg_key'] !== true) && $allow_reg === true)
    {
?>
      <form method='post'>
      <input type='hidden' name='step' value='2'>
      <input type='hidden' name='r_key' value='<?php echo$_POST['r_key'];?>'>
        <div style="margin:4px;padding:6px 9px 6px 9px;text-align:left;">
        <h2 style="margin:2px;"> <?php echo $lang['rules_agreement'] ?> </h2>
        <font color="red"><?php echo $lang['warn_email'] ?></font>
        <?php Lang('acc_create_rules'); ?>
        </div>
        <div style="margin:4px;padding:6px 9px 0px 9px;text-align:left;">
        <input type='button' class='button' value="<?php echo $lang['disagree']; ?>" onClick="location.href='index.php'"> &nbsp;&nbsp;
        <input type='submit' class='button' value="<?php echo $lang['agree']; ?>">
        </div>
      </form>
<?php
    }
    elseif(empty($_POST['step']) && $config['req_reg_key'] === true && $allow_reg === true)
    {
?>
      <form method='post'>
      <input type='hidden' name='step' value='1'>
        <div style="margin:4px;padding:6px 9px 6px 9px;text-align:left;">
        <b><?php echo $lang['reg_key'];?>:</b> <input type='text' name='r_key' size='45' maxlength='50'>
        </div>
        <div style='background:none;margin:4px;padding:6px 9px 0px 9px;text-align:left;'>
        <input type='submit' class='button' value="<?php echo $lang['next'] ?>">
        </div>
      </form>
<?php
    }
?>
<br>
</div>
</div>
<div class="phatLootBox-bottom">
</div>
</div>

</td></tr></table>