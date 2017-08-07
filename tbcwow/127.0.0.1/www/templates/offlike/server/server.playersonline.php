<style type = "text/css">
  a.server { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; font-weight: bold; }
  td.serverStatus1 { font-size: 0.8em; border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; }
  td.serverStatus2 { font-size: 0.8em; border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
</style>
<center>

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
                                foreach($realm_list as $id=>$name){echo "<li><a href=\"index.php?n=server&sub=playersonline&realm=$id\"><b>$name</b></a></li> \n";}
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
<center>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody>
<tr>
  <td colspan='2'>
<div style='cursor: auto;' id='dataElement'>
<span>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
  <tbody>
  <tr>
    <td width='12'><img src='templates/offlike/images/metalborder-top-left.gif' height='12' width='12'></td>
    <td background='templates/offlike/images/metalborder-top.gif'></td>
    <td width='12'><img src='templates/offlike/images/metalborder-top-right.gif' height='12' width='12'></td>
  </tr>
  <tr>
    <td background='templates/offlike/images/metalborder-left.gif'></td>
    <td>
      <table cellpadding='3' cellspacing='0' width='100%'>
        <tbody>
        <tr>
          <td class='rankingHeader' align='center' colspan='6' nowrap='nowrap'><?php echo $realm_info['name']; ?></td>
        </tr>
        <tr>
          <td class='rankingHeader' align='center' nowrap='nowrap'>#</td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><?echo$lang['name'];?>&nbsp;</td> 
          <td class='rankingHeader' align='center' nowrap='nowrap'><?echo$lang['race'];?>&nbsp;</td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><?echo$lang['class'];?>&nbsp;</td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><?echo$lang['level_short'];?>&nbsp;</td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><?echo$lang['location'];?>&nbsp;</td>
        </tr>
        <?php foreach($res_info as $res){ ?>
        <tr>
          <td class="serverStatus<?php echo $res['res_color'] ?>" align='center'><b style='color: rgb(102, 13, 2);'><?php echo $res['number']; ?></b></td>
          <td class="serverStatus<?php echo $res['res_color'] ?>"><b class='smallBold' style='color: rgb(35, 67, 3);'><?php echo $res['name']; ?></b></td>
          <td class="serverStatus<?php echo $res['res_color'] ?>" align='center'><small style='color: rgb(102, 13, 2);'><img onmouseover="ddrivetip('<?php echo $site_defines['character_race'][$res['race']]; ?>','#ffffff')" onmouseout="hideddrivetip()" src='templates/offlike/images/icon/race/<?php echo $res['race'];?>-<?php echo $res['gender'];?>.gif' height='18' width='18'></small></td>
          <td class="serverStatus<?php echo $res['res_color'] ?>" align='center'><small style='color: (35, 67, 3);'><img onmouseover="ddrivetip('<?php echo $site_defines['character_class'][$res['class']]; ?>','#ffffff')" onmouseout="hideddrivetip()" src='templates/offlike/images/icon/class/<?php echo $res['class'];?>.gif' height='18' width='18'></small></td>
          <td class="serverStatus<?php echo $res['res_color'] ?>" align='center'><b style='color: rgb(102, 13, 2);'><?php echo $res['level']; ?></b></td>
          <td class="serverStatus<?php echo $res['res_color'] ?>" align='center'><b style='color: rgb(35, 67, 3);'><?php echo $res['pos'];?></b></td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </td>
    <td background='templates/offlike/images/metalborder-right.gif'></td>
  </tr>
  <tr>
    <td><img src='templates/offlike/images/metalborder-bot-left.gif' height='11' width='12'></td>
    <td background='templates/offlike/images/metalborder-bot.gif'></td>
    <td><img src='templates/offlike/images/metalborder-bot-right.gif' height='11' width='12'></td>
  </tr>
  </tbody>
</table>
</span>
</div>
</td>
</tr>
</tbody></table>
</center>
<?php } ?>
</center>
