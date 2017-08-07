<center>
<div style="border: 2px dotted #1E4378;background:none;margin:4px;padding:6px 9px 6px 9px;text-align:left;width:70%;">
<?php
		$num_chars = 0;
		$rc = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,10=>0,11=>0);
    $realm_param = $_GET['realm'];
    $WSDB = DbSimple_Generic::connect("".$characters['db_type']."://".$characters['db_username'].":".$characters['db_password']."@".$characters['db_host'].":".$characters['db_port']."/".$characters['db_name']."");
    if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
    if($WSDB)$WSDB->query("SET NAMES ".$characters['db_encoding']);

		$r1 = $WSDB->select("SELECT `race` FROM `characters`");
    foreach($r1 as $data)
		{
			$num_chars++;
			$rc[$data['race']]++;
		}

    //Check if 0 entrys to avoid PHP warnings if 0 chars in database.
        if ($num_chars == 0){ echo "0 Characters";}else{
		    $num_ally = $rc[1]+$rc[3]+$rc[4]+$rc[7]+$rc[11];
		    $num_horde = $rc[2]+$rc[5]+$rc[6]+$rc[8]+$rc[10];
		    $pc_ally =  round($num_ally/$num_chars*100,2);
		    $pc_horde =  round($num_horde/$num_chars*100,2);
		    $pc_human = round($rc[1]/$num_chars*100,2);
		    $pc_orc = round($rc[2]/$num_chars*100,2);
	    	$pc_dwarf = round($rc[3]/$num_chars*100,2);
	    	$pc_ne = round($rc[4]/$num_chars*100,2);
	    	$pc_undead = round($rc[5]/$num_chars*100,2);
		    $pc_tauren = round($rc[6]/$num_chars*100,2);
		    $pc_gnome = round($rc[7]/$num_chars*100,2);
		    $pc_troll = round($rc[8]/$num_chars*100,2);
		    $pc_be = round($rc[10]/$num_chars*100,2);
		    $pc_dranei = round($rc[11]/$num_chars*100,2);

		//print_r($rc);

          echo "
          <center>
               <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"90%\">
                     <tbody>
                     <tr>
	                    <td width=\"24\"><img src=\"./templates/offlike/images/stat/subheader-left-sword.gif\" height=\"20\" width=\"24\"></td>
	                    <td bgcolor=\"#05374a\" width=\"100%\"><b class=\"white\">".$lang['statistic'].":</b></td>
	                    <td width=\"10\"><img src=\"./templates/offlike/images/stat/subheader-right.gif\" height=\"20\" width=\"10\"></td>
                     </tr>
                     </tbody></table>
               <table width=\"90%\">
                      <tr>
                          <td colspan=\"2\" align=\"left\" style=\"padding-left:20px;\">
                                      <img src=\"./templates/offlike/images/stat/battlegrounds-alliance.jpg\" alt=\"Alliance\">
                          </td>
                          <td colspan=\"2\" align=\"right\" style=\"padding-right:20px;\">
                                      <img src=\"./templates/offlike/images/stat/battlegrounds-horde.jpg\" alt=\"Horde\">
                          </td>
                      </tr>
                      <tr>
                          <td colspan=\"2\" align=\"left\" style=\"padding-left:20px;\">
                                      ".$lang['Alliance'].":".$num_ally."(".$pc_ally."%)
                          </td>
                          <td colspan=\"2\" align=\"right\" style=\"padding-right:20px;\">
                                      ".$lang['Horde'].":".$num_horde."(".$pc_horde."%)
                          </td>
                      </tr>
                      <tr>
                          <td align=\"left\">
                                 <img onmouseover=\"ddrivetip('$lang[Human]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/1-0.gif\" align=\"absmiddle\">
                          </td>
                          <td align=\"left\">
                              ".$rc[1]."(".$pc_human."%)
                          </td>
                          <td align=\"right\">
                              ".$rc[2]."(".$pc_orc."%)
                          </td>
                          <td align=\"right\">
                                 <img onmouseover=\"ddrivetip('$lang[Orc]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/2-0.gif\" align=\"absmiddle\">
                          </td>
                      </tr>
                      <tr>
                          <td align=\"left\">
                                 <img onmouseover=\"ddrivetip('$lang[Dwarf]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/3-0.gif\" align=\"absmiddle\">
                          </td>
                          <td align=\"left\">
                              ".$rc[3]."(".$pc_dwarf."%)
                          </td>
                          <td align=\"right\">
                              ".$rc[5]."(".$pc_undead."%)
                          </td>
                          <td align=\"right\">
                                 <img onmouseover=\"ddrivetip('$lang[Undead]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/5-0.gif\" align=\"absmiddle\">
                          </td>
                      </tr>
                      <tr>
                          <td align=\"left\">
                                 <img onmouseover=\"ddrivetip('$lang[Nightelf]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/4-0.gif\" align=\"absmiddle\">
                          <td align=\"left\">
                              ".$rc[4]."(".$pc_ne."%)
                          </td>
                          <td align=\"right\">
                              ".$rc[6]."(".$pc_tauren."%)
                          </td>
                          <td align=\"right\">
                                 <img onmouseover=\"ddrivetip('$lang[Tauren]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/6-0.gif\" align=\"absmiddle\">
                          </td>
                      </tr>
                      <tr>
                          <td align=\"left\">
                                 <img onmouseover=\"ddrivetip('$lang[Gnome]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/7-0.gif\" align=\"absmiddle\">
                          </td>
                          <td align=\"left\">
                              ".$rc[7]."(".$pc_gnome."%)
                          </td>
                          <td align=\"right\">
                              ".$rc[8]."(".$pc_troll."%)
                          </td>
                          <td align=\"right\">
                                 <img onmouseover=\"ddrivetip('$lang[Troll]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/8-0.gif\" align=\"absmiddle\">
                          </td>
                      </tr>
                      <tr>
                          <td align=\"left\">
                                 <img onmouseover=\"ddrivetip('$lang[Dranei]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/11-0.gif\" align=\"absmiddle\">
                          </td>
                          <td align=\"left\">
                              ".$rc[11]."(".$pc_dranei."%)
                          </td>
                          <td align=\"right\">
                              ".$rc[10]."(".$pc_be."%)
                          </td>
                          <td align=\"right\">
                                 <img onmouseover=\"ddrivetip('$lang[Bloodelf]')\" onmouseout=\"hideddrivetip()\" src=\"./templates/offlike/images/stat/10-0.gif\" align=\"absmiddle\">
                          </td>
                      </tr>
                      <tr>
                          <td colspan=\"2\" align=\"left\" style=\"padding-left:20px;\">
                          </td>
                          <td colspan=\"2\" align=\"right\" style=\"padding-right:20px;\">
                          </td>
                      </tr>
               </table>
          </center>";
        }
?>
</div>
</center>
