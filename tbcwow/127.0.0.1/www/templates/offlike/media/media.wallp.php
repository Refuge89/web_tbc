<?php
    $img=$_FILES["filename"]["name"];
    $comment=$_POST['message'];
    $autor=$user['username'];
    $date=date("Y-m-d");
    if ($_POST['doadd'] != ''){
     if($_FILES["filename"]["size"] > 1024*0.2*1024) {
     echo $lang['Filesizes'];
     exit; }
     if($_FILES["filename"]["type"]!="image/jpeg") {
     echo $lang['Filetype'];
     echo ("<br>"); }
     if($DB->selectCell("SELECT img FROM `gallery` WHERE img='$img' AND cat='wallpaper'") == $img){
     echo $lang['ErrorFilename'];
     exit;
     }
     if(copy($_FILES["filename"]["tmp_name"],
     "./images/wallpapers/".$_FILES["filename"]["name"])) {
     $DB->query("INSERT INTO gallery (img,comment,autor,date,cat) VALUES('$img','$comment','$autor','$date','wallpaper')");
     } else {
     echo $lang['Uploaderror']; }
    }
?>
<?php
$gal = $DB->selectCell("SELECT count(*) FROM `gallery` WHERE cat='wallpaper'");
?>


<table border = 0 width=100%>
<?php if($user['id']>=1){ ?>
<tr><td ><img src="<?php echo $config['template_href']; ?>images/edit-button.gif"><a href="././index.php?n=media&sub=addgalwallp"><?echo $lang['Addimage'];?></a></td>
<td align=right><?echo $lang['Totalingallery'];?> <?php echo $gal; ?></td></tr>
</table>
<?php }else{ ?>
<td align=right><?echo $lang['Totalingallery'];?> <?php echo $gal; ?></td></tr>
</table>
<style type = "text/css">
  td.serverStatus1 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; }
  td.serverStatus2 { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
</style>
<?php } ?>
<center>
<table border=0>
<tr>
<?php
$sql = $DB->select("SELECT * FROM gallery WHERE cat='wallpaper'");
foreach($sql as $tablerows){
?>

<TR>
<TD ROWSPAN=3 align="center">

<table style="margin: 7px;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td><img src="./templates/offlike/images/gallery/lt.png" class="png" style="width: 9px; height: 9px;" border="0" height="9" width="9"></td>
<td background="./templates/offlike/images/gallery/_t.gif"><img src="/i/_.gif" height="1" width="1"></td>
<td><img src="./templates/offlike/images/gallery/rt.png" class="png" style="width: 11px; height: 9px;" border="0" height="9" width="11"></td>
</tr>
<tr>
<td background="./templates/offlike/images/gallery/_l.gif"><img src="/i/_.gif" height="1" width="1"></td>
<td>
<a style="cursor: pointer;" onclick="javascript:void(window.open('./images/wallpapers/<?php echo $tablerows['img'];?>'))" target="_blank"><img style="width: 235px; height: 175px;" alt="<?php echo  $tablerows['comment'];?>"src="./images/wallpapers/<?PHP echo  $tablerows['img'];?>" border="0"></a>
</td>
<td background="./templates/offlike/images/gallery/_r.gif"><img src="/i/_.gif" height="1" width="1"></td>
</tr>
<tr>
<td><img src="./templates/offlike/images/gallery/lb.png" class="png" style="width: 9px; height: 12px;" border="0" height="12" width="9"></td>
<td background="./templates/offlike/images/gallery/_b.gif"><img src="/i/_.gif" height="1" width="1"></td>
<td><img src="./templates/offlike/images/gallery/rb.png" class="png" style="width: 11px; height: 12px;" border="0" height="12" width="11"></td>
</tr>
</tbody>
</table>

</TD>
<td><?PHP echo  $lang['Comment']." ".$tablerows['comment'];?></td>
</TR><TR>
<td><?PHP echo $lang['Author']." ".$tablerows['autor'];?></td>
</TR><TR>
<td><?PHP echo $lang['Date']." ".$tablerows['date'];?></td>
</TR>
<TR>
<td colspan=2><?PHP echo "";?></td>
</TR>
<?PHP } mysql_close(); ?>
</tr>
</table>
</center>

  




