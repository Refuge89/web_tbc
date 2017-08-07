<?php
	require('./config.php');

	$category = $_POST["category"];

	$connection = mysql_connect($realmd['db_host'], $realmd['db_username'], $realmd['db_password'])
	 or die("No connection to the database!");

	mysql_select_db($realmd['db_name'], $connection);

	$sql2 = "SELECT category_id, extensions FROM site_category WHERE category = '$category'";
	$result2 = mysql_query($sql2, $connection);
   	while($zeile = mysql_fetch_array($result2))
	{
	   	$cat_id = $zeile['category_id'];
		$cat_ext_temp = $zeile['extensions'];
	}

	$cat_ext= explode(';', $cat_ext_temp);

      $file = "".  basename( $_FILES['uploadedfile']['name']);

	if ($cat_id==1) {
		$target_path = "uploads/screenshots/";
	}else{
		if ($cat_id==2) {
		$target_path = "uploads/programs/";
	}else{
		if ($cat_id==3) {
		$target_path = "uploads/art/";	
	}else
		$target_path = "uploads/";
	}}	
		$filename = $target_path . basename( $_FILES['uploadedfile']['name']);
	
		$file_ending = explode(".", $filename);
		$file_ending[1] = strtoupper($file_ending[1]);
	
		if ( in_array($_FILES['uploadedfile']['type'],$cat_ext) || $cat_ext_temp == "*" ){	
			if (file_exists($filename)) {
?>

<script type="text/javascript">
  window.location.href='./index.php?n=media&sub=upload&ok=-2&name=<?php echo $filename ?>';
</script>

<?php
		}
		else {
			/* Orginal Datei in Upload Pfad hinzufügen
			Result is "uploads/filename.extension" */
			$filename = str_replace(  ' ' , '_' , $filename );
			$target_path = $filename; 
?>
			<script type="text/javascript">
  window.location.href='./index.php?n=media&sub=upload&ok=1&name=<?php echo $target_path;?>';
</script>
<?php
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

			    $sql = "INSERT INTO site_upload (category_ref, filename)
			            VALUES ('".$cat_id."', '" . $filename . "')";

			    $result = mysql_query($sql, $connection);

			    mysql_close($connection);

			    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
			    " wurde hochgeladen";
?>

<script type="text/javascript">
  window.location.href='./index.php?n=media&sub=upload&ok=1&name=<?php echo $file?>';
</script>

<?php
			}
			else {
?>

<script type="text/javascript">
  window.location.href='./index.php?n=media&sub=upload&ok=-3&name=<?php echo $file?>';
</script>

<?php
			}
		}
	}
	else {
?>

<script type="text/javascript">
  window.location.href='./index.php?n=media&sub=upload&ok=-1&name=<?php echo $file?>';
</script>
<?php
	}
?>
