<?php

/*****!!!!!!!!!!!!!*********/
$dev = FALSE; // CHANGE THIS TO "FALSE"!!!!!!!!!!!
/*****!!!!!!!!!!!!!*********/

if ($dev == FALSE){ // Dont touch this.




/*
*  Here you modify REALM database information ( Site will not work if these values are not good )
*/
$realmd = array(
'db_type'     => 'mysql',
'db_host'            => '127.0.0.1',   //ip of db realm
'db_port'     => '3306',          //port
'db_username' => 'mangos',          //realm user
'db_password' => 'mangos',                      //realm password
'db_name'            => 'realmd',          //realm db name
'db_encoding' => 'utf8',        // don't change
);

/*
*  Here you modify WORLD database information ( Site will not work if these values are not good )
*/
$mangos = array(
'db_type'     => 'mysql',
'db_host'            => '127.0.0.1',   //ip of db world
'db_port'     => '3306',          //port
'db_username' => 'mangos',          //world user
'db_password' => 'mangos',                     //world password
'db_name'            => 'mangos',          //world db name
'db_encoding' => 'utf8',        // don't change
);

/*
*  Here you modify Characters database information ( Site will not work if these values are not good )
*/
$characters = array(
'db_type'     => 'mysql',
'db_host'            => '127.0.0.1',   //ip of db world
'db_port'     => '3306',          //port
'db_username' => 'mangos',          //world user
'db_password' => 'mangos',                     //world password
'db_name'            => 'characters',          //world db name
'db_encoding' => 'utf8',        // don't change
);



/*
*  Here you can modify general Config information.
*/
$config = array(
'template'                    => 'offlike',
'template_image_href'  => 'templates/offlike/', // Link where images are located - Not touch YET.
'default_lang'                => 'ru',                 //Default lang // Don't change
'lang'                        => 'ru',                 //Site Default lang
'copyright'            => 'All Images and Logos are copyright 2007 Blizzard Entertainment',  // Copyright Information for the footer of page
'display_banner_flash' => '1',                  // Do you want to display Flash Banners?  |  1=yes 0=Show normal picture
);

/*
*  Here you can configure the secret questions given out for password retrieve.
*/
$secret_question_arr = array(
'0' => 'Whats your mothers maiden name?',
'1' => 'What street did you grow up on?',
'2' => 'Whats the name of your first pet?',
'3' => 'Whats your favorite color?',
'4' => 'Whats your fathers maiden name?',
);


/*
*  This is an extended config section, in this section you can modify values, these values are optional to set but
*  some of the config values are very handy to set.
*/
$site_spesific_config = array(

    #Configuration for Realm
    'realm_info' => array(
        'default_realm_id'      =>   '1',     // default realmid - will be displayed right in the serverinfo
        'multirealm'            =>   '0',     // 0 - one realm        1 - Multirealm server
    ),


    #Configuration for news section.
    'news' => array(
        'items_per_page'         => '6',       // News-Output items limit
        'defaultOpen'            => '3',       // First N+1 items that are "opened" by default.
    ),


    #Configuration for forum's
    'forum' => array(
        'news_forum_id'       =>    '1',       // forum id for "news"
        'bugs_forum_id'       =>    '2',       // forum id for "bugtracker"
        'ql4_forum_id'        =>    '4',       // forum id for FAQ Forum/Quicklink4 in right menu

        // If you want to use external forums ( example Phpbb , you must configure these values)
        'externalforum'       =>    '0',       // 1 = Use external forum     |    0 = Dont use external forum
        'frame_forum'         =>    '0',       // 1 = Use Frame to external forum     |    0 = Redirect to external forum
        'forum_external_link' =>    '/forum',  // Url of external forum

        // If you want to use external bugs tracker ( example sourceforge.net , you must configure these values)
        'externalbugstracker'       =>    '0',       // 1 = Use external forum     |    0 = Dont use external Bugs Tracker
        'frame_bugstracker'         =>    '0',       // 1 = Use Frame to external forum     |    0 = Redirect to external Bugs Tracker
        'bugstracker_external_link' =>    '',  // Url of external Bugs Tracker
    ),
);




/*
* This is where you put the values to show information about your server rates.
* To display correct rates look in your MaNGOS config file for the values.
* Note! To show " Server rates " you must set "server_rates" to 'yes'.
*/
$server_rates = array(

   'regeneration' => array(
        'health' =>  '1.5',
        'mana'   =>  '1.5',
    ),

    'rates' => array(
        'Item_drop'          =>  '2',
        'Money_drop'         =>  '2',
        'Experiance_kill'    =>  '2',
        'Experiance_quest'   =>  '2',
        'Experiance_explore' =>  '2',
    ),

    'resting_points' => array(
        'Restingpoints_cityoftavern' => '3',
        'Restingpoints_ingame'       => '3',
        'Restingpoints_inwilderness' => '3',
    ),
);

/*
*  In this Config array you can configure what components on the site are visible.
*  'right_section' controls content for the rh column
*  'left_section' controls link content for the lh column
*  You type 'no' or 'yes'   -  'yes' means content visible.
*/
$component_active = array(

    'right_section' =>   array(
        'quicklinks'         => 'yes',
        'users_on_homepage'  => 'yes',
        'server_information' => 'yes',
        'server_rates'                 => 'yes',
        'media'              => 'yes',
        'newbguide'                         => 'no',
    ),

    'left_section' =>    array(
        //Community
        'Teamspeak'      => 'no', // If this is no the whole section will be disabled.
        'chat'           => 'yes',

        //Workshop
        'Realms_status'  => 'yes', // If this is no the whole section will be disabled.
        'Players_online' => 'yes',
        'Honor'          => 'yes',
        'Playermap'      => 'yes',
        'Characters'     => 'yes',
        'Userlist'       => 'yes',
        'Statistic'      => 'yes',
        'ah_system'      => 'yes',

        //Media
        'Screenshots'       => 'yes', // If this is no the whole section will be disabled.
        'Wallpapers'        => 'yes',
        'Upload_Wallpaper'  => 'yes',
        'Upload_Screenshot' => 'yes',

        //Support
        'Commands'       => 'yes', // If this is no the whole section will be disabled.
        'Bug_tracker'    => 'yes',
        'In_Game_Support'=> 'yes',
        'Online_GMs'     => 'yes',

        //Game Guide
        'How_to_play'    => 'yes', // If this is no the whole section will be disabled.

        //Account
        'Activate_account' => 'no',
        'Character_copy'   => 'no', // This require extra install of SQL and more config.
    ),
);


/*
* In this section you can configure the menu 'Character copy'.
* You have 2 things to configure: What account the horde characters is on and  what account the alliance characters is on.
*/
$character_copy_config = array(

    // Id's of horde and alliance account ( Find in realm.account table ->[guid] ) . THESE MUST BE SET OR !NOTHING! WILL WORK!!!!
    'accounts' => array(
        'horde'    => '0',
        'alliance' => '0',
    ),

    // General Config system
    'generalconfig' => array(
        'Player_Start_Money' => '2000000', // How much gold should player start with ? ( This value is in copper )
        'Player_Start_Level' => '70', // What level should the player start with ?
    ),
);

/** Dont change anything below **/
$templates = array('offlike');
}else{
include "../config.php";
}
?>
