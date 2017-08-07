<html>
<body>	
<center><font color="red"><b><?echo $lang['Filesizes'];?></b></font></center><br>
<form method="post" action="index.php?n=media&sub=screen" enctype="multipart/form-data">
	<?PHP echo  $lang['Author'];?>&nbsp;<b><?echo $user['username']; ?></b><br>
        <?PHP echo  $lang['Comment'];?>&nbsp;<br>
	     <textarea name="message" cols="5" rows="5" id="textarea" style="width: 95%; height: 70px;"></textarea><br>
	     <?PHP echo  $lang['File'];?>&nbsp;<br>
	     <input type="hidden" name="postnewfile" value="POST">
       <input type="file" name="filename"><br> 
       <center><input type="submit" value="<?echo $lang['UScreen']; ?>" name="doadd"><br></center>
<form>

</body>
</html>
