<?php
/// FIX ME: Im not working perfect. I can not copy other than characters first bag's content and not others bag content!


if(INCLUDED!==true)exit;
// ==================== //
$pathway_info[] = array('title'=>$lang['charcreate'],'link'=>'');
// ==================== //
if($user['id']<=0){
    redirect('index.php?n=account&sub=charcreate',1);
}
else
{
/*************** START LEVLEUP ACTION ****************/
    if(!$_GET['action'])
        {
            $profile = $auth->getprofile($user['id']);
            $profile['signature'] = str_replace('<br />','',$profile['signature']);
        }
    elseif($_GET['action']=='createchar'){

        $WSDB = DbSimple_Generic::connect("".$mangos['db_type']."://".$mangos['db_username'].":".$mangos['db_password']."@".$mangos['db_host'].":".$mangos['db_port']."/".$mangos['db_name']."");
        if($WSDB)$WSDB->setErrorHandler('databaseErrorHandler');
        if($WSDB)$WSDB->query("SET NAMES ".$mangos['db_encoding']);

        //Checks the lastest number and make it +1! Remember that we have a dummy character for safe creation.
        $last_id_cell = $WSDB->selectCell("SELECT data FROM `characters` WHERE guid='1' ORDER BY data desc LIMIT 0,1");
        $lastest_accountid_modifyed = $last_id_cell+1;
        $WSDB->query("UPDATE `characters` SET data=?d WHERE guid='1'",$lastest_accountid_modifyed);

        //Post declare:
        $class = $_POST["createchar_class"];
        $faction = $_POST["createchar_faction"];
        $character_copy_to = $_POST["character_copy_char"];
        //Main Declare.....
        $guid = $lastest_accountid_modifyed;
        $account_id = $_POST["createchar_id"];
        $name = $checknamestring = ucfirst(strtolower(escape_string($_POST['createchar_name'])));
        $loggedin = 0;

        //Checks if wanted name exsits.
        $name_check = $WSDB->selectCell("SELECT guid from `characters` WHERE name='$name'");
        if ($name_check == FALSE){
            $classexists = false;
        }else{
            $classexists = true;
        }


        //Checks if user is logged on
        $loggedin = $DB->selectCell("SELECT online FROM account WHERE id='$account_id'");
        //Another check if user is logged on.
        if ($loggedin == '0'){
            $loggedin = $WSDB->selectCell("SELECT online FROM `characters` WHERE account='$account_id'");
        }
        //Checks if user has MAX players.
        $numchars = $DB->selectCell("SELECT numchars FROM realmcharacters WHERE acctid='$account_id' AND realmid='1'");


        /******** FORM CHECKS ********/
        if ($class == false){}
        elseif ($faction == false){}
        elseif ($classexists == true)
        {
            output_message('alert','<b>'.$lang['charcreate_nameinuse'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=charcreate">');
        }
        elseif ($name == false)
        {
            output_message('alert','<b>'.$lang['charcreate_invalidname'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=charcreate">');
        }
        elseif ($loggedin == 1)
        {
            output_message('alert','<b>'.$lang['peec_loggedin'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=charcreate">');
        }
        elseif(check_for_symbols($checknamestring) == TRUE)
        {
            output_message('alert','<b>'.$lang['charcreate_nameissymbols'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=charcreate">');
        }
        elseif($numchars == 9)
        {
            output_message('alert','<b>'.$lang['charcreate_tomanychars'].'</b><meta http-equiv=refresh content="3;url=index.php?n=account&sub=charcreate">');
        }
        else
        {
        //Here is the main section for character creation. You define your values.
        // You create a character in-game, look up the ID in character table.

        /*******************  MAIN COPY ******************/
        // Tables wich is going to be copied.
        #character
        #character_action
        #character_homebind
        #character_reputation
        #character_spell
        #character_tutorial
        #character_inventory
        #item_instance

        /*Character*/
        $query = $WSDB->select("SELECT * FROM `characters` WHERE guid='$character_copy_to'");
        foreach($query as $d){

            $change_data = str_replace("$character_copy_to" , "$guid", $d[data]);


            $wp = $WSDB->query("INSERT INTO `characters` (
            `guid`,
            `account`,
            `data`,
            `name`,
            `race`,
            `class`,
            `position_x`,
            `position_y`,
            `position_z`,
            `map`,
            `orientation`,
            `taximask`,
            `online`,
            `cinematic`,
            `totaltime`,
            `leveltime`,
            `logout_time`,
            `is_logout_resting`,
            `rest_bonus`,
            `resettalents_cost`,
            `resettalents_time`,
            `trans_x`,
            `trans_y`,
            `trans_z`,
            `trans_o`,
            `transguid`,
            `gmstate`,
            `stable_slots`,
            `rename`)
             VALUES
            ($guid, $account_id, '$change_data', '$name', $d[race], $d[class], $d[position_x], $d[position_y], $d[position_z], $d[map], $d[orientation], '$d[taximask]', $d[online], $d[cinematic], $d[totaltime], $d[leveltime], $d[logout_time], $d[is_logout_resting],
            $d[rest_bonus], $d[resettalents_cost], $d[resettalents_time], $d[trans_x], $d[trans_y], $d[trans_z], $d[trans_o], $d[transguid], $d[gmstate], $d[stable_slots], $d[rename])");
        }

        /*`character_action` */
        $query = $WSDB->select("SELECT * FROM `character_action` WHERE guid='$character_copy_to'");

        foreach($query as $d){
            $WSDB->query("INSERT INTO `character_action` (
            `guid`,
            `button`,
            `action`,
            `type`,
            `misc`)
             VALUES
            ($guid , '$d[button]', '$d[action]', '$d[type]', '$d[misc]')");
        }
        
        /*`character_homebind` */
        $query = $WSDB->select("SELECT * FROM `character_homebind` WHERE guid='$character_copy_to'");

        foreach($query as $d){
            $WSDB->query("INSERT INTO `character_homebind` (
            `guid`,
            `map`,
            `zone`,
            `position_x`,
            `position_y`,
            `position_z`)
             VALUES
            ($guid , '$d[map]', '$d[zone]', '$d[position_x]', '$d[position_y]', '$d[position_z]')");
        }

        /*`character_reputation` */
        $query = $WSDB->select("SELECT * FROM `character_reputation` WHERE guid='$character_copy_to'");

        foreach($query as $d){
            $WSDB->query("INSERT INTO `character_reputation` (
            `guid`,
            `faction`,
            `standing`,
            `flags`)
             VALUES
            ($guid, $d[faction], $d[standing], $d[flags])");
        }
        /*`character_spell` */
        $query = $WSDB->select("SELECT * FROM `character_spell` WHERE guid='$character_copy_to'");

        foreach($query as $d){
            $WSDB->query("INSERT INTO `character_spell` (
            `guid`,
            `spell`,
            `slot`,
            `active`)
             VALUES
            ($guid, $d[spell], $d[slot], $d[active])");
        }

            /*``character_tutorial` ` */
        $query = $WSDB->select("SELECT * FROM `character_tutorial` WHERE guid='$character_copy_to'");

        foreach($query as $d){
            $WSDB->query("INSERT INTO `character_tutorial` (
            `guid`,
            `tut0`,
            `tut1`,
            `tut2`,
            `tut3`,
            `tut4`,
            `tut5`,
            `tut6`,
            `tut7`)
             VALUES
            ($guid, $d[tut0], $d[tut1], $d[tut2], $d[tut3], $d[tut4], $d[tut5], $d[tut6], $d[tut7])");
        }
        /*``character_inventory` ` */
        ///////////////

        $q = $WSDB->select("SELECT * FROM `item_instance` WHERE owner_guid='$character_copy_to'");
        foreach($q as $h){

            $query = $WSDB->select("SELECT * FROM `character_inventory` WHERE item='$h[guid]'");
            
            foreach($query as $character_inventory){
                $bag = $character_inventory[bag];
                $slot = $character_inventory[slot];
                $item_template = $character_inventory[item_template];
                $olditem = $d[item];
            }
            // First we need to check what is the lastest id

            $item_character_inventory = $WSDB->selectCell("SELECT item_template FROM `character_inventory` WHERE guid='0' AND bag='1' ORDER BY item desc LIMIT 0,1");
            $item = $item_character_inventory+1;

            /****UPDATE character inventory****/
            $update_inv_count = $WSDB->query("UPDATE `character_inventory` SET item_template='$item' WHERE guid='0' AND bag='1'");


            // Start modify data fields to what it should be.
            $increguid = $item;
            $data = explode(" ", $h[data]);
            $data['0'] = $increguid;
            $data['6'] = $guid;
            $data['8'] = $guid;
            $update_implode_data_field = implode(" ", $data);
            /////////////MAIN QUERY START
            $WSDB->query("INSERT INTO `item_instance` (
            `guid`,
            `owner_guid`,
            `data`)
             VALUES
            ($increguid, $guid, '$update_implode_data_field')");

            $WSDB->query("INSERT INTO `character_inventory` (
            `guid`,
            `bag`,
            `slot`,
            `item`,
            `item_template`)
            VALUES
            ($guid, $bag, $slot, $item, $item_template");
            ////////////MAIN QUERY END

            // Now, we need to replace Data FOR EACH field within the new values used, as items.
            $datafield_query = $WSDB->select("SELECT data FROM `characters` WHERE guid='$guid'");
            
            foreach($datafield_query as $newfunction){
                $data = $newfunction[data];
                $dataone = str_replace("$h[guid]", "$increguid", $data);
                $WSDB->query("UPDATE `characters` SET data='$dataone' WHERE guid='$guid'");
            }
            // TODO: We need to copy bags content into the right places .... Long process
        }// END WHILE CHARACTER_INSTANCE

        ////// HERE WE DO LAST STEPS BEFORE WE ARE FINISHED //////
        $row = $WSDB->selectRow("SELECT data FROM `characters` WHERE guid='$guid'");
        $data = explode(" ", $row["data"]);
        $data[1326] = $character_copy_config['generalconfig']['Player_Start_Money'];
        $data[1420] = $character_copy_config['generalconfig']['Player_Start_Level'];
        $data[1244] = $$character_copy_config['generalconfig']['Player_Start_Level']-9;
        $update = implode(" ", $data);
        $WSDB->query("UPDATE `characters` set data = '$update' WHERE guid='$guid'");
        /**********GET READY, UPDATE CHARACTER COUNT**************/
        $query = $DB->selectCell("SELECT count FROM `site_levelup` where account_id='$_POST[createchar_id]'");
        $now = $query+1;
        $DB->query("UPDATE `site_levelup` SET count='$now' WHERE account_id='$_POST[createchar_id]'");
        //Also update reamcharacters
        $query = $DB->selectCell("SELECT numchars FROM `realmcharacters` WHERE acctid='$_POST[createchar_id]'");
        $now = $query+1;
        $DB->query("UPDATE `realmcharacters` SET numchars='$now' WHERE acctid='$_POST[createchar_id]'");

        //Gogo message
        output_message('notice','<b>'.$lang['charcreate_charcreated'].'</b><meta http-equiv=refresh content="5;url=index.php?n=account&sub=charcreate">');

    }//Stops if all cases returns false, then apply data fields.
}
/*************** STOP LEVLEUP ACTION ****************/
unset($WSDB);
}
?>
