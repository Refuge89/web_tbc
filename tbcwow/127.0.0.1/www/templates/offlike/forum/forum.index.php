<?php if($site_spesific_config[forum][externalforum] == 1)
{
if ($site_spesific_config[forum][frame_forum] == 1)
{
 echo "<center>";
 echo "</br>";
 echo "<iframe src=".$site_spesific_config[forum][forum_external_link]."
 height=\"1050\" width=\"640\" frameborder=\"0\" scrolling=\"yes\">
 Your browser does not support inlineframes.
 </iframe>";
}
else
echo'<meta http-equiv=refresh content="0;url=\''.$site_spesific_config[forum][forum_external_link].'\'">';
}
else {
?>
<style media="screen" title="currentStyle" type="text/css">
    
</style>
<div class="postContainerPlain">
<div class="postBody">
<center>
<img src="<?php echo $config['template_href'];?>images/illidan.png" border="0" width="100%" />
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
    <td width="12"><img src="<?php echo $config['template_href'];?>images/metalborder-top-left.gif" width="12" height="12"/></td>
    <td background="<?php echo $config['template_href'];?>images/metalborder-top.gif"/>
    <td width="12"><img src="<?php echo $config['template_href'];?>images/metalborder-top-right.gif" width="12" height="12"/></td>
</tr>
<tr>
    <td background="<?php echo $config['template_href'];?>images/metalborder-left.gif"/>
    <td>

<?php foreach($items as $catitem){ ?>
    <table cellspacing="0" cellpadding="2" border="0" width="100%" class="forum_category" >
    <thead style="background-image:url(<?php echo $config['template_href'];?>/images/light2.jpg); background-repeat:repeat-x;">
        <tr><td colspan="4"><h3><img src="<?php echo $config['template_href'];?>/images/nav_m.gif" /> <?php echo $catitem[0]['cat_name'];?></h3></td></tr>
    </thead>
    <tbody>
<?php foreach($catitem as $forumitem){ ?>
        <tr>
            <td class="col1"><?php if($forumitem['isnew']){ ?><img src="<?php echo $config['template_href'];?>images/<?php echo ($forumitem['closed']==1?'lock-icon.gif':'news-community.gif');?>"><?php } else {?><img src="<?php echo $config['template_href'];?>images/<?php echo ($forumitem['closed']==1?'lock-icon.gif':'no-news-community.gif');?>"><?php } ?></td>
            <td >
                <a class="title" href="<?php echo $forumitem['linktothis'];?>"><?php echo $forumitem['forum_name'];?></a><?php echo ($forumitem['hidden']==1?$lang['hidden']:'');?>
                <?php if($forumitem['isnew']){ ?><font color="red"><?php echo$lang['newmessages'];?></font><?php } ?>
                <span class="desc"><?php echo $forumitem['forum_desc'];?></span>            </td>
            <td rowspan="3" class="col3"><span style="color:#333333; font-size:12px;"><?php echo $forumitem['num_topics'];?></span> <span style="color:#333333; font-size:12px;"><?php echo declension($forumitem['num_topics'],array($lang['l_theme1'],$lang['l_theme2'],$lang['l_theme3'])); ?></span></td>
            <td rowspan="3" class="col4"><span style="color:#333333; font-size:12px;"><?php echo $forumitem['num_posts'];?></span> <span style="color:#333333; font-size:12px;"><?php echo declension($forumitem['num_posts'],array($lang['l_post1'],$lang['l_post2'],$lang['l_post3'])); ?></span></td>
        </tr>
        <tr>
            <td class="col1"><!--<img src="<?php echo $config['template_href'];?>images/icons/time.gif">--></td>
            <td><small style="color:#666666"><?php echo$lang['lastreplyin'];?> <a href="<?php echo $forumitem['linktolastpost'];?>" title="<?php echo $forumitem['topic_name'];?>"> <?php echo $forumitem['topic_name'];?></a></small></td>
        </tr>
        <tr>
            <td class="col1"><!--<img src="<?php echo $config['template_href'];?>images/icons/user_comment.gif">--></td>
            <td><small style="color:#666666"><?php echo$lang['from'];?> <a href="<?php echo $forumitem['linktoprofile'];?>"> <?php echo $forumitem['last_poster'];?></a> <?php echo $forumitem['last_post'];?></small></td>
		</tr>
		<tr style="background-image:url(<?php echo $config['template_href'];?>/images/metalborder-top.gif); background-repeat:repeat-x;" height="7">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
<?php } ?>
    </tbody>
    </table>
<?php } ?>
    </td>
    <td background="<?php echo $config['template_href'];?>images/metalborder-right.gif"/>
</tr>
<tr>
    <td><img src="<?php echo $config['template_href'];?>images/metalborder-bot-left.gif" width="12" height="11"/></td>
    <td background="<?php echo $config['template_href'];?>images/metalborder-bot.gif"/>
    <td><img src="<?php echo $config['template_href'];?>images/metalborder-bot-right.gif" width="12" height="11"/></td>
</tr>
</table>

<br />
<table id="iconLegend" border="1" cellpadding="0" cellspacing="0" width="50%">
  <tbody><tr>
    <td>
<table class="tb2" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-image:url(<?php echo $config['template_href'];?>/images/light2.jpg); background-repeat:repeat-x;">
    <tbody>	<tr>
      <td><img src="<?php echo $config['template_href'];?>images/news-community.gif" style="margin: 0pt 3px 0pt 2px;" alt="Unviewed Post" border="0"><small style="color:#333333">&nbsp;<?php echo $lang['newpost'] ?>&nbsp;</small></td>
      <td><img src="<?php echo $config['template_href'];?>images/no-news-community.gif" alt="Viewed Post" border="0"><small style="color:#333333">&nbsp;<?php echo $lang['nonewpost'] ?>&nbsp;</small></td>
      <td><img src="<?php echo $config['template_href'];?>images/lock-icon.gif" style="margin: 0pt 3px 0pt 2px;" alt="New Post" border="0"><small style="color:#333333">&nbsp;<?php echo $lang['postclose'] ?>&nbsp;</small></td>
      </tr>
</tbody></table></center></div>
</div></table><br /><br />
<?php } ?>
