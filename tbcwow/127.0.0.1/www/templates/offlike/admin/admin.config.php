<div class="sections clearfix">
<?php if(empty($_GET['action'])){ ?>
<form method="post" action="index.php?n=admin&sub=config&action=change" enctype="multipart/form-data">
<div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:left;width:94%;">
    <?php foreach($items as $item){ ?>
        <label><?php echo ($lang[$item['key']]?$lang[$item['key']]:'there is no desc for this lang'); ?></label><br />
        <?php
            if($item['type']=='string')echo'<input name="'.$item['key'].'" type="text" value="'.$item['value'].'" size="40" style="margin:1px;">';
            elseif($item['type']=='int')echo'<input name="'.$item['key'].'" type="text" value="'.$item['value'].'" size="10"  style="margin:1px;">';
            elseif($item['type']=='bool')echo'<input name="'.$item['key'].'" type="radio" value="1" '.($config[$item['key']]===true?'checked="checked"':'').' /> '.$lang['yes'].' <br /><input name="'.$item['key'].'" type="radio" value="0" '.($config[$item['key']]===true?'':'checked="checked"').' /> '.$lang['no'];
        ?>
        <div class="divhr"></div>
    <?php } ?>
</div>
<div style="background:none;margin:4px;padding:6px 9px 0px 9px;text-align:right;width:94%;">
    <input type="reset" size="16" class="button" style="font-size:12px;" value="<?php echo $lang['doreset'] ?>"> &nbsp; 
    <input type="submit" size="16" class="button" style="font-size:12px;" value="<?php echo $lang['dochange'] ?>">
</div>
</form>
<?php } ?>
</div>