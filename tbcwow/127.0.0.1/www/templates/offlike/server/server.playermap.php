</br>
<?php if ($site_spesific_config[realm_info][multirealm] == 1) { ?>
        <p><small><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['choose_realm'];?>:</font></small>                 
 <select onchange="">
<?php
    foreach($realm_list as $id=>$name){echo '<option value="'.$id.'"'.($_GET['realm']==$id?' selected="selected"':'').'>'.$name.'</option>'."\n";}
?>
                    </select>
<?php } ?>

<style>
#cnt { width: 827px; height: auto; }
</style>
  <center>
  <iframe src="./components/pomm/pomm.php"
   height="528" width="784" frameborder="0" scrolling="no">
   Alternativer Text für Browser, die Inlineframes nicht unterstützen.
  </iframe>
  </center>