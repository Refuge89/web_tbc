<div id="module-container">
<?php 
if ($config[display_banner_flash] == '1')
{
$banner=1;

echo '
    <div id="flashcontainer">
        <!--[if !IE]> <-->
            <object data="./flash/loader.swf" height="312" type="application/x-shockwave-flash" width="502">
        <!--> <![endif]-->

        <!--[if IE]>
            <object type="application/x-shockwave-flash" width="502" height="312">
            
                <param name="movie" value="./flash/loader.swf" />
        <![endif]-->
                <param name="wmode" value="transparent">
                <param name="quality" value="high">
                <param name="base" value="./flash/en">
                <param name="flashvars" value="xmlname=./flash/en/news.xmls">
                <param name="bgcolor" value="#000000">
                <param name="menu" value="false">
            </object>
    </div>
';
echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>"; echo "<br/>";

}else{

echo "<img src='./templates/offlike/images/banner1.jpg' width=464>";
echo "<br/>"; echo "<br/>";
}
?>

<div class="module-container" <?php if ($banner==1) echo 'style="position: relative;"';?>>
<?php foreach($alltopics as $postanum => $topic){ 
    $postnum++;
    if($hl=='alt')$hl='';else $hl='alt';
?>                                                              
    <script type="text/javascript">
        var postId<?php echo$postnum;?>="<?php echo $topic['topic_id'];?>";
    </script>
    <div class="news-expand" id="news<?php echo $topic['topic_id'];?>">
      <div class="news-border-left"></div>
      <div class="news-border-right"></div>
      <div class="news-listing">
        <div onclick="javascript:toggleEntry('<?php echo $topic['topic_id'];?>','<?php echo$hl;?>')" onmouseout="javascript:this.style.background='none'" onmouseover="javascript:this.style.background='#EEDB99'" class="hoverContainer">
          <div>
            <div class="news-top">
              <ul>
                <li class="item-icon">
                  <img border="0" alt="new-post" src="<?php echo $config['template_href'];?>images/news-contests.gif"></li>
                <li class="news-entry">
                  <h1>
                    <a href="javascript:dummyFunction();"><?php echo $topic['topic_name'];?></a>
                  </h1>
                  <span class="user">Posted by: <b><?php echo $topic['poster'];?></b>|</span>&nbsp;<span class="posted-date"><?php echo date('d-m-Y',$topic['topic_posted']);?></span>
                </li>
                <li class="news-entry-date">
                  <span><strong><?php echo date('d-m-Y',$topic['topic_posted']);?> </strong></span>
                </li>
                <li class="news-toggle">
                  <a href="javascript:toggleEntry('<?php echo $topic['topic_id'];?>','<?php echo$hl;?>')"><img alt="" src="<?php echo $config['template_href'];?>images/pixel001.gif"></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="news-item">
        <blockquote>
          <dl>
            <dd>
              <ul>
                <li>
                  <div class="letter-box0"></div>
                  <div class="blog-post">
                    <description><?php echo $topic['message'];?></description>
                  <div align="right"><a href="<?php echo 'index.php?n=forum&sub=viewtopic&tid='.$topic['topic_id'].'&to=lastpost';?>"><?php echo $lang['lastcomment'];?></a>
                   <?php echo $lang['from'];?> <a href="<?php echo 'index.php?n=account&sub=view&action=find&name='.$topic['last_poster']; ?>"><?php echo $topic['last_poster']; ?></a></div>                
                </li>
              </ul>
            </dd>
          </dl>
        </blockquote>
      </div>
    </div>

    <script type="text/javascript">
    var position = <?php echo$postnum;?>;
    var localId = postId<?php echo$postnum;?>;
    var cookieState = getcookie("news"+localId);
    var defaultOpen = "<?php echo($postnum>$site_spesific_config[news][defaultOpen]?'0':'1');?>";
    if ((cookieState == 1) || (position==1 && cookieState!='0') || (defaultOpen == 1 && cookieState!='0')) {
    } else {
        document.getElementById("news"+localId).className = "news-collapse"+"<?php echo$hl;?>";       
    }
    </script>
<?php } ?>                                                                
</div>

<div class="news-archive-link" <?php if ($banner==1) echo 'style="position: relative;"';?>>
    <div class="news-archive-button">
      <a href="index.php?n=forum&sub=viewforum&fid=<?php echo $site_spesific_config[forum][news_forum_id]; ?>"><span>News Archives</span></a>
    </div>
</div>
      
<br>
