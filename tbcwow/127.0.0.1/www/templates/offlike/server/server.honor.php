<style type="text/css">
#header        { COLOR: white; FONT-WEIGHT: bold; FONT-VARIANT: small-caps; TEXT-DECORATION: none; LETTER-SPACING: 4px;}
input.button  { background-color: transparent; border-style: none; }
.calendarDayHeading { width: 110px; height: 30px; color: FFFFFF; text-align: center; font-family: tahoma; font-weight: bold; background-image:url('/shared/wow-com/images/basics/raidcalendar/images/day.jpg');}
.calendarCell { width: 110px; height: 100px; vertical-align: top; color: dddddd; font-family: tahoma; font-weight: bold; }
.navigation{
    position: absolute;
    top:91px;
}
.button{
    color:#FFFFFF;
    font-size:9px;
    letter-spacing:-1px;
}
a.nav:link{   
    font-family: arial,verdana, sans-serif;
    color: CBA300;
    font-size: 11px;
    font-weight:normal;
}   
a.nav:visited{
    font-family: arial,verdana, sans-serif;
    color: CBA300;
    font-size: 11px;
    font-weight:normal;
}
a.nav:hover{ 
    font-family: arial,verdana, sans-serif;
    color: FFFFFF;
    font-size: 11px;
    font-weight:normal;
}
a.nav:active{ 
    font-family: arial,verdana, sans-serif;
    color: CBA300;
    font-size: 11px;
    font-weight:normal;
}
</style>
<center>
<div class="blogbody" style="background-image:url('<?php echo $config['template_href'];?>images/light.jpg');">
<?php if(empty($_GET['realm'])){ ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td width="24"><img src="<?php echo $config['template_href'];?>images/subheader-left-sword.gif" height="20" width="24"></td>
            <td bgcolor="#05374a" width="100%"><b style="color:white;"><?php echo $lang['choose_realm'];?>:</b></td>
            <td width="10"><img src="<?php echo $config['template_href'];?>images/subheader-right.gif" height="20" width="10"></td>
        </tr>
    </tbody>
</table>
<!--PlainBox Top-->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td width="3"><img src="<?php echo $config['template_href'];?>images/plainbox-top-left.gif" border="0" height="3" width="3"></td>
            <td background="<?php echo $config['template_href'];?>images/plainbox-top.gif" width="100%"></td>
            <td width="3"><img src="<?php echo $config['template_href'];?>images/plainbox-top-right.gif" border="0" height="3" width="3"></td>
        </tr>
        <tr>
            <td background="<?php echo $config['template_href'];?>images/plainbox-left.gif"></td>
            <td bgcolor="#cdb68d" valign="top">
<!--PlainBox Top-->
            <center>
                <table width="80%">
                    <tbody>
                        <tr>
                            <td valign="top" width="100%">
                                <span>
                                <?php
                                foreach($realm_list as $id=>$name){echo "<li><a href=\"index.php?n=server&sub=honor&realm=$id\"><b>$name</b></a></li> \n";}
                                ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center>
<!--PlainBox Bottom-->
            </td>
            <td background="<?php echo $config['template_href'];?>images/plainbox-right.gif"></td>
        </tr>
        <tr>
            <td><img src="<?php echo $config['template_href'];?>images/plainbox-bot-left.gif" border="0" height="3" width="3"></td>
            <td background="<?php echo $config['template_href'];?>images/plainbox-bot.gif"></td>
            <td><img src="<?php echo $config['template_href'];?>images/plainbox-bot-right.gif" border="0" height="3" width="3"></td>
        </tr>
    </tbody>
</table>
<!--PlainBox Bottom-->
<?php }elseif($_GET['realm']){ ?>
<style media="screen" title="currentStyle" type="text/css">
    #compcont, 
    #content, 
    #content-left, 
    #content-right, 
    #contentContainer, 
    #contentPadding,
    #main, 
    #main-bottom, 
    #mainWrapper, 
    #cnt-wrapper, 
    #cntMain, 
    #cnt-top, 
    #cnt-top div, 
    #cnt-top div div, 
    #cnt-bot, 
    #cnt-bot div, 
    #cnt-bot div div, 
    #cnt { background: #000 !important; }
    #compcont, 
    #cnt-wrapper{ padding-right:0px !important; padding-left:0px !important; }
    #honorbody select {background-color: #101010; color: #ffd200; font-family: tahoma, Arial,Helvetica,Sans-Serif; font-size: 11pt; font-weight: bold;}
    #honorbody a:visited { color: #ffba16; text-decoration: underline; font-weight: bold;}
    #honorbody a:hover { color: #ffffff; text-decoration: underline; font-weight: bold;}
    #honorbody span { font-family: tahoma, Arial,Helvetica,Sans-Serif; color: #ffffff; font-size: 9pt; }
    #honorbody td { font-family: tahoma, Arial,Helvetica,Sans-Serif; color: #ffffff; font-size: 7pt; }
</style>
<center>
<table border="0" cellpadding="0" cellspacing="0" width="100%" id="honorbody">
<tbody><tr>
    <td colspan="3">
        <table background="<?php echo $config['template_href'];?>images/ss-border-top-bg.gif" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody><tr>
            <td><img src="<?php echo $config['template_href'];?>images/ss-border-top-left.gif" height="14" width="113"></td>
            <td align="right"><img src="<?php echo $config['template_href'];?>images/ss-border-top-right.gif" height="14" width="113"></td>
        </tr></tbody>
        </table>
    </td>
</tr>
<tr>
    <td background="<?php echo $config['template_href'];?>images/ss-border-left.gif"><img src="<?php echo $config['template_href'];?>images/pixel_002.gif" height="1" width="21"></td>
    <!-- Main Content --> 
    <td style="padding-left: 6px; padding-right: 6px;" bgcolor="#000000">
        <span class="lite">
        <p>
            <b><font color="#ffe400" size="3">Realms PvP Rankings</font></b><br>
                Here you see top <?php echo $max_display_chars;?> fighters for each faction.
        </p>
        <p><small><font color="#ffffff"><?php echo $lang['choose_realm'];?>:</font></small><br>
            <table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
                <tr>
                <td nowrap="nowrap">
                    <select onchange="window.location.href = 'index.php?n=server&sub=honor&realm='+this.value;">
<?php
    foreach($realm_list as $id=>$name){echo '<option value="'.$id.'"'.($_GET['realm']==$id?' selected="selected"':'').'>'.$name.'</option>'."\n";}
?>
                    </select>&nbsp;&nbsp;
                </td>
                <td align="right" width="100%">
                    <!--<span>
                    <a class="menuFiller" href="#">All Realms</a> | 
                    <a class="menuFiller" href="#">Individual Realms</a>
                    </span>-->
                </td>
                </tr>
            </tbody></table>
        </p>
        </span>
        <table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
        <tr><td align="center" width="50%" valign="top">
        <img src="<?php echo $config['template_href'];?>images/alliance2.png">
            <div>
                <table border="0" cellpadding="2" cellspacing="0" width="100%" align="center">
                <tr>
                    <td align="right" width="20"><b>#</b></td>
                    <td width="20">Rank</td>
                    <td width="20">Race</td>
                    <td width="20">Class</td>
                    <td>Name</td>
                    <td align="center"><b>Lvl.</b></td>
                    <td align="center"><b>Honor</b></td>
                    <td align="center"><b>Kills</b></td>

                </tr>
<?php foreach($allhonor['alliance'] as $item){ $pos++; ?>
                <tr>
                    <td align="right" width="20" style="font-size:14px;"><b><?php echo $pos; ?></b></td>
                    <td width="20" align="center"><img src="<?php echo $item['rank_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['rank']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td width="20" align="center"><img src="<?php echo $item['race_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['race']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td width="20" align="center"><img src="<?php echo $item['class_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['class']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td style="font-size:14px;"><b><?php echo $item['name']; ?></b></td>
                    <td width="20" align="center" style="font-size:12px;"><b><?php echo $item['level']; ?></b></td>
                    <td align="center" style="font-size:12px;"><font color="green"><b><?php echo $item['honorable_kills']; ?></b></font></td>
                    <td align="center" style="font-size:12px;"><font color="red"><?php echo $item['dishonorable_kills']; ?></font></td>
                </tr>
<?php } $pos = 0; ?>
                </table>
            </div>
            <br>
        </td><td align="center" valign="top">
        <img src="<?php echo $config['template_href'];?>images/horde2.png">
            <div>
                <table border="0" cellpadding="2" cellspacing="0" width="100%" align="center">
                <tr>
                    <td align="right" width="20"><b>#</b></td>
                    <td width="20">Rank</td>
                    <td width="20">Race</td>
                    <td width="20">Class</td>
                    <td>Name</td>
                    <td align="center"><b>Lvl.</b></td>
                    <td align="center"><b>Honor</b></td>
                    <td align="center"><b>Kills</b></td>
                </tr>
<?php foreach($allhonor['horde'] as $item){ $pos++; ?>
                <tr>
                    <td align="right" width="20" style="font-size:14px;"><b><?php echo $pos; ?></b></td>
                    <td width="20" align="center"><img src="<?php echo $item['rank_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['rank']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td width="20" align="center"><img src="<?php echo $item['race_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['race']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td width="20" align="center"><img src="<?php echo $item['class_icon']; ?>" onmouseover="ddrivetip('<?php echo $item['class']; ?>','#ffffff')"; onmouseout="hideddrivetip()"></td>
                    <td style="font-size:14px;"><b><?php echo $item['name']; ?></b></td>
                    <td width="20" align="center" style="font-size:12px;"><b><?php echo $item['level']; ?></b></td>
                    <td align="center" style="font-size:12px;"><font color="green"><b><?php echo $item['honorable_kills']; ?></b></font></td>
                    <td align="center" style="font-size:12px;"><font color="red"><?php echo $item['dishonorable_kills']; ?></font></td>


                </tr>
<?php } unset($item,$pos); ?>
                </table>
            </div>
            <br>
        </td></tr>
        </table>
    </td>
    <td background="<?php echo $config['template_href'];?>images/ss-border-right.gif"><img src="<?php echo $config['template_href'];?>images/pixel_002.gif" height="1" width="21"></td>
</tr>
<tr>
    <td colspan="3">
        <table background="<?php echo $config['template_href'];?>images/ss-border-bot-bg.gif" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody><tr>
            <td valign="top"></td>
            <td align="center"><br><br></td>
            <td align="right" valign="top"></td>
    </tr></tbody>
        </table>
  </td>
</tr>
</tbody>
</table>
</center>
<?php } ?>
</div>
</center>
