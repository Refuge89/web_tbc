<style media="screen" title="currentStyle" type="text/css">
    .postContainerPlain {
        font-family:arial,palatino, georgia, verdana, arial, sans-serif;
        color:#000000;
        padding:5px;
        margin-bottom: 4px;
        font-size: x-small;
        font-weight: normal;
        background-color: #E7CFA3;
        background-image: url('<?php echo $config['template_href'];?>images/light.jpg');
        border-style: solid; border-color: #000000; border-width: 0px; border-bottom-width:1px; border-top-width:1px;
        line-height:140%;
  }
    .postBody {
        padding:10px;
        line-height:140%;
        font-size: small;
  }
    .title {
        font-family: palatino, georgia, times new roman, serif;
        font-size: 13pt;
        color: #640909;
    }
</style>
<img src="<?php echo $config['template_href'];?>images/gms.jpg" border="0" />
<table align="center" width="100%"><tr>
<td align="center">
<?php foreach($gm_groups as $gm_group_id=>$gm_group){ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="postContainerPlain"	>
  <tr>
    <td width="20%"><div align="center"><img src="<?php echo $config['template_href'];?>images/GM-gnome.gif" width="86" height="133" /></div></td>
    <td width="80%"><div style="margin-right: 0pt;"  align="left">
      <h3 class="title"><?php echo $gmlevel_w[$gm_group_id];?></h3>
      <div class="postBody" style="list-style:square;">
        <?php foreach($gm_group as $gm_name){ ?>
        <li><?php echo $gm_name;?></li>
        <?php } ?>
      </div>
    </div></td>
  </tr>
</table>

<?php } ?>
</td>
</tr></table>    