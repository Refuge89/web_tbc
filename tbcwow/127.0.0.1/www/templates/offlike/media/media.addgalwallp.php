<html>
<body>	
<center><font color="red"><b><?echo $lang['Filesizew'];?></b></font></center><br>
<form method="post" action="index.php?n=media&sub=wallp" enctype="multipart/form-data">
	<?PHP echo  $lang['Author'];?>&nbsp;<b><?echo $user['username']; ?></b><br>
        <?PHP echo  $lang['File'];?>&nbsp;<br>
       <input type="hidden" name="postnewfile" value="POST">
       <input type="file" name="filename"><br> 
       <center><input type="submit" value="<?echo $lang['UWallp']; ?>" name="doadd"><br></center>
<form>

</body>
</html>
