<style type = "text/css">
  a.server { border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; font-weight: bold; }
  td.serverStatus1 { font-size: 0.8em; border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; }
  td.serverStatus2 { font-size: 0.8em; border-style: solid; border-width: 0px 1px 1px 0px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
</style>

<style media="screen" title="currentStyle" type="text/css">
/*item quality CSS */
a.iqual0:link, a.iqual0:visited { background-color: transparent; color: #9e9e9e; }
a.iqual1:link, a.iqual1:visited { background-color: transparent; color: #eee; }
a.iqual2:link, a.iqual2:visited { background-color: transparent; color: #00ff10; }
a.iqual3:link, a.iqual3:visited { background-color: transparent; color: #0010ff; }
a.iqual4:link, a.iqual4:visited { background-color: transparent; color: #cc00dd; }
a.iqual5:link, a.iqual5:visited { background-color: transparent; color: #ff8810; }
a.iqual6:link, a.iqual6:visited { background-color: transparent; color: #e60000; }

a.iqual0:hover { color: #fff; }
a.iqual1:hover { color: #ff0000; }
a.iqual2:hover { color: #f00; }
a.iqual3:hover { color: #fff; }
a.iqual4:hover { color: #fff; }
a.iqual5:hover { color: #fff; }
a.iqual6:hover { color: #fff; }
/*End item qual CSS*/

/*Fixes/Defns for various table parts*/
td.rankingHeader {background-color: #0e0e0e;}
td.rankingHeader a:link,a:visited {color: #006677;}

tr.ahrow td {border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px; font-size: 0.8em; color: rgb(180, 180, 180);}

font.expired {font-weight:bold; font-size: 0.96em;color: rgb(170, 20, 20);}
/*End fixes/defns*/
  tr.ahrow {background: url('<?php echo "templates/offlike/images/ah_system/ah_tr_bg.jpg"; ?>') }
</style>



<?php
global $use_itemsite_url;
$use_itemsite_url = "http://www.wowhead.com/?item=";
//http://thottbot.com/i

global $current_time;
$current_time = time();

function item_manage_class($iclass) {
    //global $lang;
    
    //More Complete Names
    /*
    $iclass_names = array(
        'consumable',
        'container',
        'weapon',
        '',
        'armor',
        'reagent',
        'projectile',
        'trade_goods',
        '',
        'recipe',
        '',
        'ammo_container',
        'quest_item',
        'key',
        'misc_reins',
        'misc',
    );
    */
    
    //Two-ish-letter Names
    $iclass_names = array(
        'Cbl',
        'Cnt',
        'Weap',
        '',
        'Armr',
        'Rgt',
        'Prj',
        'TG',
        '',
        'Rcp',
        '',
        'Amo',
        'Ques',
        'Key',
        'MR',
        'Misc',
    );

    return $iclass_names[$iclass];
}
        

function parse_gold($number) {

	$gold = array();
	$gold['gold'] = intval($number/10000);
	$gold['silver'] = intval(($number % 10000)/100);
	$gold['copper'] = (($number % 10000) % 100);

	return $gold;
}

function print_gold($gold_array) {
	if($gold_array['gold'] > 0) {
		echo $gold_array['gold'];
		echo "<img src='templates/offlike/images/ah_system/gold.GIF'>";
	}
	if($gold_array['silver'] > 0) {
		echo $gold_array['silver'];
		echo "<img src='templates/offlike/images/ah_system/silver.GIF'>";
	}
	if($gold_array['copper'] > 0) {
		echo $gold_array['copper'];
		echo "<img src='templates/offlike/images/ah_system/copper.GIF'>";
	}
}

function ah_print_gold($var) {
	if($var == '---') {
		echo $var;
	}
	else {
		print_gold(parse_gold($var));
	}
}


function parse_time($number) {

	$time = array();
	$time['h'] = intval($number/3600);
	$time['m'] = intval(($number % 3600)/60);
	$time['s'] = (($number % 3600) % 60);

	return $time;
}

function print_time($time_array) {
	global $lang;
	$count = 0;
	if($time_array['h'] > 0) {
		echo $time_array['h'];
		echo $lang['ah_hours'];
		$count++;
	}
	if($time_array['m'] > 0) {
		if ($count > 0) echo ',';
		echo $time_array['m'];
		echo $lang['ah_minutes'];
		$count++;
	}
	if($time_array['s'] > 0) {
		if ($count > 0) echo ',';
		echo $time_array['s'];
		echo $lang['ah_seconds'];
	}
}

function ah_time_left($exp_time) {
	global $current_time;
	global $lang;

	$time_left = $exp_time - $current_time;

	if($time_left > 0) {
		print_time(parse_time($time_left));
	}
	else echo "<font class='expired'>" . $lang['ah_expired'] . "</font>";
}

function AHsortlink($clicked) {
	$link = "index.php";
	
	$cf = 0;

	foreach($_GET as $key => $value) {
		if ($key != 'd' && $key != 'sort') {
			if($cf == 0) {
				$link .= '?';
				$cf = 1;
			}
			else {$link .= '&';}
			$link .= $key . '=' . $value;
		}
		elseif ($key == 'sort') {
			if($clicked != null) {
				if($cf == 0) {
					$link .= '?';
					$cf = 1;
				}
				else {$link .= '&';}

				$link .= 'sort=' . $clicked;
				if($_GET['d']!='1' && $value == $clicked) {
					$link .= '&d=1';
				}
			}
		}
	}
	if(!$_GET['sort'] && $clicked != null) $link .= '&sort=' . $clicked;
	return $link;
}

function tableAH($ah_entry) { 
	$current_time = time();
	$time_subtract = 312497;
	$current_time -= $time_subtract;
	global $lang;
	global $use_itemsite_url;
?>
      <table cellpadding='3' cellspacing='0' width='100%' border = '1'>
        <tbody>   
         <tr> 
          <td class='rankingHeader' align='center' colspan='8' nowrap='nowrap'><?php echo $lang['ah_auctionhouse']; ?> <a href="<?php echo AHsortlink(null) . '">' . $lang['ah_reset']; ?></a><br>
          <a href="<?php echo AHsortlink(quality) . '">' . $lang['ah_sortbyquality']; ?></a></td>
        <tr>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('class') . '">' . $lang['ah_itemclass']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('itemname') . '">' . $lang['ah_itemname']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('quantity') . '">' . $lang['ah_quantity']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('seller') . '">' . $lang['ah_seller']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('time') . '">' . $lang['ah_time']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('buyer') . '">' . $lang['ah_buyer']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('currentbid') . '">' . $lang['ah_currentbid']; ?></a></td>
          <td class='rankingHeader' align='center' nowrap='nowrap'><a href="<?php echo AHsortlink('buyout') . '">' . $lang['ah_buyout']; ?></a></td>
        </tr>
        <?php foreach($ah_entry as $row){ ?>
        <tr class="ahrow">
          <td><?php echo item_manage_class($row['class']);?></td>
          <td><a class="iqual<?php echo $row['quality'];?>" href="<?php echo $use_itemsite_url; echo $row['item_entry'];?>"><?php echo $row['itemname']; ?></a></td>
          <td align='right'><?php echo $row['quantity']; ?></td>
          <td><?php echo $row['seller']; ?></td>
          <td align='right'><?php echo ah_time_left($row['time']); ?></td>
          <td><?php echo $row['buyer'] ?></td>
          <td align='right'><?php ah_print_gold($row['currentbid']);?></td>
          <td align='right'><?php ah_print_gold($row['buyout']); ?></td>
        </tr>
	<?php }  ?>
        </tbody>
      </table>

<?php
}

?>


<center>



<center>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tbody>
<tr>
  <td colspan='2'>
<div style='cursor: auto;' id='dataElement'>
<span>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
  <tbody>
  <tr>
    <td width='12'><img src='templates/offlike/images/metalborder-top-left.gif' height='12' width='12'></td>
    <td background='templates/offlike/images/metalborder-top.gif'></td>
    <td width='12'><img src='templates/offlike/images/metalborder-top-right.gif' height='12' width='12'></td>
  </tr>
  <tr>
    <td background='templates/offlike/images/metalborder-left.gif'></td>
    <td>
	<?php tableAH($ah_entry); ?>
    </td>
    <td background='templates/offlike/images/metalborder-right.gif'></td>
  </tr>
  <tr>
    <td><img src='templates/offlike/images/metalborder-bot-left.gif' height='11' width='12'></td>
    <td background='templates/offlike/images/metalborder-bot.gif'></td>
    <td><img src='templates/offlike/images/metalborder-bot-right.gif' height='11' width='12'></td>
  </tr>
  </tbody>
</table>
</span>
</div>
</td>
</tr>
</tbody></table>
</center>
