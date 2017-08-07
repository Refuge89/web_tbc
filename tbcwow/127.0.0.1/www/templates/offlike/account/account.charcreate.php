<?php if($user['id']>0  && $profile){ ?>
<style type = "text/css">
  tr.serverStatus1 { border-style: solid; border-width: 1px 0px 0px 1px; border-color: #D8BF95; }
  tr.serverStatus2 { border-style: solid; border-width: 1px 0px 0px 1px; border-color: #D8BF95; background-color: #C3AD89; }
  td.rankingHeader { color: #C7C7C7; font-size: 10pt; font-family: arial,helvetica,sans-serif; font-weight: bold; background-color: #2E2D2B; border-style: solid; border-width: 1px; border-color: #5D5D5D #5D5D5D #1E1D1C #1E1D1C; padding: 3px;}
	input.name_input{ background-color: black; color:white;};
</style>
<style type = "text/css">



   	   #heads { position: absolute;
			top: -90px;
			left: -26px;
			z-index: 100;
       }

   	   #text { position: absolute;
			top: 61px;
			left: 165px;
			z-index: 100;
       }



		#wrapper { position: relative;
			z-index: 100;
       }

		#wrapper99 { position: relative;
			z-index: 99;
       }

</style>

<table cellspacing = "0" cellpadding = "0" border = "0" width = "100%" style = "background: url('<?php echo $config['template_image_href'];?>images/header-charcopy.jpg'); background-position: left; background-repeat: no-repeat; background-color: #000000;">
  <tr>
  <td width = "1"><div id = "wrapper"><div id = "heads"><img src = "<?php echo $config['template_image_href'];?>images/header-charcopy-top.gif"></div></div></td>
	<td width = "1"><div id = "wrapper"><div id = "text"><img src = "<?php echo $config['template_image_href'];?>images/header-charcopy-bot.gif"></div></div></td>
	<td width = "100%"><img src = "<?php echo $config['template_image_href'];?>images/pixel.gif" width = "1" height = "121"></td>
  </tr>
</table>

<table cellspacing = "0" cellpadding = "0" border = "0" width = "100%" background = "<?php echo $config['template_image_href'];?>images/banner-bottom.jpg">
  <tr>
    <td width = "100%"><img src = "<?php echo $config['template_image_href'];?>images/pixel.gif" height = "18"></td>
  </tr>
</table>


<?php
if ($component_active['left_section']['Character_copy'] == 'yes'){
?>
<table>
  <tr>
  <td>
  <img align="left" src="<?php echo $config['template_image_href'];?>images/letters/t.gif">his page allows you to copy a World of Warcraft character to our server realm.
	To copy a character, simply find the character you wish to copy and click on the red "Copy Character" button next to that character.<br /><br />
	</td><td align="left"><img src="<?php echo $config['template_image_href'];?>images/worlds-copy.jpg"></td>
  </tr>
</table>
<div style="cursor: auto;" id="dataElement">
<span>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td width="12"><img src="<?php echo $config['template_image_href'];?>images/metalborder-top-left.gif" height="12" width="12"></td>
        <td background="<?php echo $config['template_image_href'];?>images/metalborder-top.gif"></td>
        <td width="12"><img src="<?php echo $config['template_image_href'];?>images/metalborder-top-right.gif" height="12" width="12"></td>
    </tr>
    <tr>
        <td background='<?php echo $config['template_image_href'];?>images/metalborder-left.gif'></td>
        <td>
            <table cellpadding="3" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td class="rankingHeader" align="left" nowrap="nowrap" width="100">Class</td>
                    <td class="rankingHeader" align="left" nowrap="nowrap">Faction&nbsp;</td>
                    <td class="rankingHeader" align="center" nowrap="nowrap" width="120">Race&nbsp;</td>
                    <td class="rankingHeader" align="center" nowrap="nowrap" width="120">Wanted name&nbsp;</td>
                		<td class="rankingHeader" align="center" nowrap="nowrap" width="120">Create Char&nbsp;</td>
								</tr>
                <tr>
                    <td colspan="5" background="<?php echo $config['template_image_href'];?>images/shadow.gif">
                     <img src="<?php echo $config['template_image_href'];?>images/pixel.gif" height="1" width="1">
                    </td>
                </tr>
<?php
$site_defines = Array(
	'character_class_output' => Array(
		1 => 'warrior',
		2 => 'paladin',
		3 => 'hunter',
		4 => 'rogue',
		5 => 'priest',
		7 => 'shaman',
		8 => 'mage',
		9 => 'warlock',
		11 => 'druid',
	),
  'character_race' => Array(
		1 => $lang['Human'],
		2 => $lang['Orc'],
		3 => $lang['Dwarf'],
		4 => $lang['Nightelf'],
		5 => $lang['Undead'],
		6 => $lang['Tauren'],
		7 => $lang['Gnome'],
		8 => $lang['Troll'],
		9 => $lang['Goblin'],
		10 => $lang['Bloodelf'],
		11 => $lang['Dranei'],
	),
	'character_class' => Array(
		1 => $lang['Warrior'],
		2 => $lang['Paladin'],
		3 => $lang['Hunter'],
		4 => $lang['Rogue'],
		5 => $lang['Priest'],
		7 => $lang['Shaman'],
		8 => $lang['Mage'],
		9 => $lang['Warlock'],
		11 => $lang['Druid'],
	),

  'character_gender' => Array(
    0 => $lang['Male'],
    1 => $lang['Female'],
    2 => 'None',
  ),
);
    $WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['db_username'].":".$mangos['db_password']."@".$mangos['db_host'].":".$mangos['db_port']."/".$mangos['db_name']."");
    if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
    if($WSDB)$WSDB->query("SET NAMES ".$mangos['db_encoding']);

    //Declares
	  $userid=$user['id'];


		// Main Get and assign values to inputs.
    $alliance_cop = $character_copy_config[accounts][alliance];
    $horde_cop = $character_copy_config[accounts][horde];
    $query = $WSDB->select("SELECT * FROM `characters` WHERE account='$alliance_cop' or account='$horde_cop'  ORDER BY account");

    if ($query == FALSE){
      echo "There is no characters to copy. Please define 'Copy Characters' in config file.";
    }else{
    foreach($query as $data)
		{
			$race = $data['race'];
			$class = $data['class'];
      if ($race == 1 || $race == 3 || $race == 4 || $race == 7 || $race == 11){ $output_race = 'alliance';}else{ $output_race = 'horde';}
      $output_class = $site_defines['character_class_output'][$class];
      $classe = $site_defines['character_class'][$class];
      $race = $site_defines['character_race'][$race];
      /*****DECLARE RACE AND CLASS ******/
echo<<<EOT
	<form action="index.php?n=account&sub=charcreate&action=createchar" method="POST">
	<input type="hidden" name="createchar_id" value="$userid">
	<input type="hidden" name="createchar_faction" value="$output_race">
	<input type="hidden" name="createchar_class" value="$output_class">
	<input type="hidden" name="character_copy_char" value="$data[guid]">
EOT;
				if ($i == 1)
				{
         	echo"<tr class='serverStatus2'>";
					$i++;
				}
				else
				{
					echo"<tr class='serverStatus1'>";
				}
echo<<<EOT
	<td><b>$classe</b></td>
	<td>$output_race</td>
	<td>$race</td>
	<td><input class="name_input" type="text" maxlength="12" name="createchar_name"></td>
	<td><input type="image" src="$config[template_href]images/button-copy-character.gif" name="createchar" value="[GET NOW]"></td>
	</tr>
	</form>
EOT;
					if ($i == 2)
					{
						$i = 0;
					}
					else
					{
						$i++;
					}
		}
}
echo<<<EOT
                </tbody>
            </table>
        </td>
        <td background="$config[template_href]images/metalborder-right.gif"></td>
    </tr>
    <tr>
        <td><img src="$config[template_href]images/metalborder-bot-left.gif" height="11" width="12"></td>
        <td background="$config[template_href]images/metalborder-bot.gif"></td>
        <td><img src="$config[template_href]images/metalborder-bot-right.gif" height="11" width="12"></td>
    </tr>
    </tbody>
</table>
</span>
</div>
EOT;
?>

<?php
	}
}
?>

