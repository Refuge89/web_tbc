<?php if(isset($_GET['id']) && $_GET['id']>0 && $profile){ ?>
<style type="text/css">
<!--
.style9 {font-size: 3em}
-->
</style>

    <table align="center" width="100%" style="font-size:0.8em;"><tr><td align="center">
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <a href="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=dodeleteacc" onClick="return confirm('Are you sure?');"><b>[ <font color="red">Delete account</font> ]</b></a><br>
            <b>Forum posts:</b> <?php echo$profile['forum_posts'];?><br>
            <b>Registered:</b> <?php echo$profile['joindate'];?><br>
            <b>Registration IP:</b> <?php echo$profile['registration_ip'];?><br>
            <b>Last login (game):</b> <?php echo$profile['last_login'];?><br>
            <hr>
            <?php if($act ==1){ ?>
            <a href="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=unban"><b>[<font color="red">Unban</font>]</b></a>
            <?php }elseif($act ==0){ ?>
            <a href="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=ban"><b>[<font color="green">Ban</font>]</b></a>
            <?php } ?>
        </div>
        <form method="post" action="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=changepass">
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <b>New password</b> <input type="password" size="22" name="new_pass">
            <input type="submit" value="Change password" class="button" style="font-size:11px;">
        </div>
        </form>
        <form method="post" action="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=change" enctype="multipart/form-data">
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <div align="right"><b><span class="style9"><?php $active=1;if ($act){echo "BANNED!";}else{echo "ACTIVE" ; }?></span><br>
              </b>
              <b>Username (login)</b> 
              <input type="text" disabled="disabled" name="profile[username]" size="24" value="<?php echo$profile['username'];?>" style="margin:1px;"> 
              <br>
              <b>Email</b> 
              <input type="text" name="profile[email]" size="24" value="<?php echo$profile['email'];?>" style="margin:1px;"> 
              <br>
              <?php if($user['gmlevel']==3){ ?>
              <b>GM level</b> 
              <input type="text" name="profile[gmlevel]" size="1" value="<?php echo$profile['gmlevel'];?>" style="margin:1px;"> 
              <br>
              <?php } ?>
              <b>Locked</b> 
              <input type="text" name="profile[locked]" size="1" value="<?php echo$profile['locked'];?>" style="margin:1px;"> 
              <br>
            </div>
        </div>
        <div style="background:none;margin:4px;padding:6px 9px 0px 9px;text-align:right;width:70%;">
            <input type="reset" size="16" class="button" style="font-size:12px;" value="Reset"> &nbsp; 
            <input type="submit" size="16" class="button" style="font-size:12px;" value="Change">
        </div>
        </form>
        <form method="post" action="index.php?n=admin&sub=members&id=<?php echo$_GET['id'];?>&action=change2" enctype="multipart/form-data">
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <b>Group</b> 
            <select name="profile[g_id]" style="margin:1px;">
                <?php foreach($allgroups as $group_id=>$group_name){ ?>
                <option value="<?php echo$group_id;?>"<?php if($profile['g_id']==$group_id)echo' selected';?>><?php echo$group_name;?></value>
                <?php } ?>
            </select>  <br>
            <?php if((bool)$config['change_template']===true) { ?>
            <b>Theme (Template)</b> 
            <select name="profile[theme]" style="margin:1px;">
                <?php foreach($templates as $template_s){ ?>
                <option value="<?php echo$template_s;?>"<?php if($profile['theme']==$template_s)echo' selected';?>><?php echo$template_s;?></value>
                <?php } ?>
            </select>  <br>
            <?php } ?>
            <b>Hide email?</b> 
            <select name="profile[hideemail]" style="margin:1px;">
                <option value="0"<?php if($profile['hideemail']==0)echo' selected';?>>No</value>
                <option value="1"<?php if($profile['hideemail']==1)echo' selected';?>>Yes</value>
            </select>  <br>
            <b>Hide profile?</b> 
            <select name="profile[hideprofile]" style="margin:1px;">
                <option value="0"<?php if($profile['hideprofile']==0)echo' selected';?>>No</value>
                <option value="1"<?php if($profile['hideprofile']==1)echo' selected';?>>Yes</value>
            </select>  <br>
            <b>Gender</b> <select name="profile[gender]"> 
                <option value="0"<?php if($profile['gender']==0)echo' selected';?>>- - - - - - - -</value>
                <option value="1"<?php if($profile['gender']==1)echo' selected';?>>Male</value>
                <option value="2"<?php if($profile['gender']==2)echo' selected';?>>Female</value>
            </select> <img src="<?php echo $templategenderimage[$profile['gender']];?>"> <br>
            <b>WWW</b> <input type="text" size="36" name="profile[homepage]" style="margin:1px;" value="<?php echo$profile['homepage'];?>"> <br>
            <b>ICQ</b> <input type="text" size="36" name="profile[icq]" style="margin:1px;" value="<?php echo$profile['icq'];?>"> <br>
            <b>MSN</b> <input type="text" size="36" name="profile[msn]" style="margin:1px;" value="<?php echo$profile['msn'];?>"> <br>
            <b>From</b> <input type="text" size="36" name="profile[location]" style="margin:1px;" value="<?php echo$profile['location'];?>"> <br>
        </div>
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <?php if($profile['avatar']) { ?>
            <b>Avatar</b> &nbsp;<br> <img src="images/avatars/<?php echo$profile['avatar'];?>" style="margin:1px;"> <br>
            <input type="hidden" name="avatarfile" value="<?php echo$profile['avatar'];?>">
            Delete ? <input type="checkbox" size="36" name="deleteavatar" style="margin:1px;" value="1"> <br> 
            <?php }else{ ?>
            MaxFileSize: <?php echo$config['max_avatar_file'];?> bytes, MaxResolution <?php echo$config['max_avatar_size'];?> px. <br>
            <b>Upload Avatar</b> <input type="file" size="36" name="avatar" style="margin:1px;"> <br>
            <?php } ?>
        </div>
        <div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:right;width:70%;">
            <b>Signature</b> <br>
            <textarea name="profile[signature]" maxlength="255" rows="4" style="width:98%;"><?php echo$profile['signature'];?></textarea>
        </div>
        <div style="background:none;margin:4px;padding:6px 9px 0px 9px;text-align:right;width:70%;">
            <input type="reset" size="16" class="button" style="font-size:12px;" value="Reset"> &nbsp; 
            <input type="submit" size="16" class="button" style="font-size:12px;" value="Change">
        </div>
        </form>
    </td></tr></table>
<?php }else{ ?>
<table border="0" cellspacing="1" cellpadding="4" align="center" width="100%" class="bordercolor" style="font-size:0.8em;">
  <tbody>
    <tr>
      <td colspan="8" class="titlebg">
      Tasks: 
      <a href="index.php?n=admin&sub=members&action=deleteinactive" onClick="return confirm('Are you sure?');"><b>[ <font color="red">Delete all not activated accounts, older then <?php echo ($oldInactiveTime/3600/24); ?> days </font> ]</b></a>
      
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="bordercolor"style="font-size:1em;">
          <tbody><tr>
            <td><?php echo $lang['post_pages'];?>: <?php echo $pages_str; ?></td>
            <td align="right">
              <b>
              <a href="index.php?n=admin&sub=members"><?php echo $lang['all'];?></a> | 
              <a href="index.php?n=admin&sub=members&char=1">#</a> 
              <a href="index.php?n=admin&sub=members&char=a">A</a> 
              <a href="index.php?n=admin&sub=members&char=b">B</a> 
              <a href="index.php?n=admin&sub=members&char=c">C</a> 
              <a href="index.php?n=admin&sub=members&char=d">D</a> 
              <a href="index.php?n=admin&sub=members&char=e">E</a> 
              <a href="index.php?n=admin&sub=members&char=f">F</a> 
              <a href="index.php?n=admin&sub=members&char=g">G</a> 
              <a href="index.php?n=admin&sub=members&char=h">H</a> 
              <a href="index.php?n=admin&sub=members&char=i">I</a> 
              <a href="index.php?n=admin&sub=members&char=j">J</a> 
              <a href="index.php?n=admin&sub=members&char=k">K</a> 
              <a href="index.php?n=admin&sub=members&char=l">L</a> 
              <a href="index.php?n=admin&sub=members&char=m">M</a> 
              <a href="index.php?n=admin&sub=members&char=n">N</a> 
              <a href="index.php?n=admin&sub=members&char=o">O</a> 
              <a href="index.php?n=admin&sub=members&char=p">P</a> 
              <a href="index.php?n=admin&sub=members&char=q">Q</a> 
              <a href="index.php?n=admin&sub=members&char=r">R</a> 
              <a href="index.php?n=admin&sub=members&char=s">S</a> 
              <a href="index.php?n=admin&sub=members&char=t">T</a> 
              <a href="index.php?n=admin&sub=members&char=u">U</a> 
              <a href="index.php?n=admin&sub=members&char=v">V</a> 
              <a href="index.php?n=admin&sub=members&char=w">W</a> 
              <a href="index.php?n=admin&sub=members&char=x">X</a> 
              <a href="index.php?n=admin&sub=members&char=y">Y</a> 
              <a href="index.php?n=admin&sub=members&char=z">Z</a>              </b>            </td>
          </tr>
        </tbody></table>      </td>
    </tr>
    <tr class="catbg3">
      <td width="20"> </td>
      <td style="width: auto;" nowrap="nowrap"><?php echo $lang['user_name'];?></td>
      <td width="25" align="center">Email</td>
      <td width="25" align="center"><?php echo $lang['homepage'];?></td>
      <td width="25" align="center">ICQ</td>
      <td width="25" align="center">MSN</td>
      <td width="125" align="center"><?php echo $lang['date_reg'];?></td>
      <td width="35" align="center"><?php echo $lang['active_ban'];?></td>
    </tr>
    <?php foreach($items as $item){ ?>
    <tr style="text-align: center;">
      <td class="windowbg2">
        <a href="index.php?n=account&sub=pms&action=add&to=<?php echo $item['username']; ?>" title="<?php echo $lang['personal_message'];?>"><img src="<?php echo$config['template_href'];?>images/icons/email.gif" alt="[PM]" align="middle"></a>      </td>
      <td class="windowbg" align="left"><a href="index.php?n=admin&sub=members&id=<?php echo $item['id']; ?>" title="<?php echo $lang['viewedit_profile'];?> <?php echo $item['username']; ?>"><?php echo $item['username']; ?></a></td>
      <td class="windowbg2"><a href="mailto:<?php echo $item['email']; ?>"><img src="./templates/offlike/images/icons/email_open.gif" alt="[Email]" title="Email" border="0" /></a></td>
      <td class="windowbg"><?php if($item['homepage']){ ?><a href="<?php echo $item['homepage']; ?>" target="_blank"><img src="<?php echo$config['template_href'];?>images/icons2/weblink.png" alt="WWW" border="0" /></a><?php } ?></td>
      <td class="windowbg2"><?php echo $item['icq']; ?></td>
      <td class="windowbg2"><?php echo $item['msn']; ?></td>
      <td class="windowbg" align="left"><?php echo $item['joindate']; ?></td>
      <td class="windowbg" align="center"><b><?php echo ($item['locked']==1?'<font color=red>0</font>':'<font color=green>1</font>'); ?> / <?php echo ($item['banned']==1?'<font color=red>1</font>':'<font color=green>0</font>'); ?></b></td>
    </tr>
    <?php } ?>
    <tr>
      <td class="titlebg" colspan="8"><?php echo $lang['post_pages'];?>: <?php echo $pages_str; ?> </td>
    </tr>
  </tbody>
</table>
<?php } ?>