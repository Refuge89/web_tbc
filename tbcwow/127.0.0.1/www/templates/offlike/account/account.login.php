<?php
if($user['id']<=0){
?>
        <table align="center" width="100%"><tr><td align="center" width="100%">
      <form method="post" action="index.php?n=account&sub=login">
            <input type="hidden" name="action" value="login">
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
          <b><?php echo $lang['username'] ?></b> <input type="text" size="26" style="font-size:11px;" name="login">
        </div>
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
          <b><?php echo $lang['pass'] ?></b> <input type="password" size="26" style="font-size:11px;" name="pass">
        </div>
        <div style="background:none;margin:4px;padding:6px 9px 0px 9px;text-align:right;width:70%;">
          <input type="submit" size="16" class="button" style="font-size:12px;" value="<?php echo $lang['login'] ?>">
        </div>
      </form>
        </td></tr></table>
<?php
}
?>