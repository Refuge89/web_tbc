<style type = "text/css">
  td.serverStatus1 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; }
  td.serverStatus2 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
</style>
<center>
<div class="blogbody" style="background-image:url('<?php echo $config['template_href'];?>images/light.jpg');">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
    <td colspan="2" style="padding:10px 20px 10px 20px;">
    <span>
        <?php Lang('realmstatus_desc'); ?>
    <br><br>
    </span>
    </td>
</tr>
<tr>
    <td colspan="2">
    </td>
</tr>
<tr>
    <td colspan="2">
<center>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
    <td width="24"><img src="<?php echo $config['template_href'];?>images/subheader-left-sword.gif" height="20" width="24"></td>
    <td bgcolor="#05374a" width="100%"><b style="color:white;">Realm Status:</b></td>
    <td width="10"><img src="<?php echo $config['template_href'];?>images/subheader-right.gif" height="20" width='10'></td>
</tr>
</tbody></table>
<div style="cursor: auto;" id="dataElement">
<span>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td width="12"><img src="<?php echo $config['template_href'];?>images/metalborder-top-left.gif" height="12" width="12"></td>
        <td background="<?php echo $config['template_href'];?>images/metalborder-top.gif"></td>
        <td width="12"><img src="<?php echo $config['template_href'];?>images/metalborder-top-right.gif" height="12" width="12"></td>
    </tr>
    <tr>
        <td background='<?php echo $config['template_href'];?>images/metalborder-left.gif'></td>
        <td>
            <table cellpadding="3" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td class="rankingHeader" align="left" nowrap="nowrap" width="60">Status</td>
                    <td class="rankingHeader" align="left" nowrap="nowrap">Realm Name&nbsp;</td>
                    <td class="rankingHeader" align="center" nowrap="nowrap" width="120">Type&nbsp;</td>
                    <td class="rankingHeader" align="center" nowrap="nowrap" width="120">Population&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5" background="<?php echo $config['template_href'];?>images/shadow.gif">
                     <img src="<?php echo $config['template_href'];?>images/pixel.gif" height="1" width="1">
                    </td>
                </tr>
                <?php foreach($items as $item){ ?>
                <tr>
                    <td class="serverStatus<?php echo $item['res_color'] ?>" align="center"><img src="<?php echo $item['img']; ?>" height='18' width='18'></td>
                    <td class="serverStatus<?php echo $item['res_color'] ?>"><b style='color: rgb(35, 67, 3);'><?php echo $item['name']; ?></b></td>
                    <td class="serverStatus<?php echo $item['res_color'] ?>" align="center"><b style='color: rgb(102, 13, 2);'><?php echo $item['type']; ?></b></td>
                    <td class="serverStatus<?php echo $item['res_color'] ?>" align="center"><b style='color: rgb(35, 67, 3);'><?php echo $item['pop'][1]." (".$item['pop'][2].")"; ?></b></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
        <td background="<?php echo $config['template_href'];?>images/metalborder-right.gif"></td>
    </tr>
    <tr>
        <td><img src="<?php echo $config['template_href'];?>images/metalborder-bot-left.gif" height="11" width="12"></td>
        <td background="<?php echo $config['template_href'];?>images/metalborder-bot.gif"></td>
        <td><img src="<?php echo $config['template_href'];?>images/metalborder-bot-right.gif" height="11" width="12"></td>
    </tr>
    </tbody>
</table>
</span>
</center>
</div>
</td>
</tr>
</tbody></table>
</center>