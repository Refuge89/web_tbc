<?php
$com_content['server'] = array(
    'index' => array(
        '', // g_ option require for view     [0]
        'server', // loc name (key)                [1]
        'index.php?n=server', // Link to                 [2]
        '', // main menu name/id ('' - not show)        [3]
        0 // show in context menu (1-yes,0-no)          [4]
    ),
    'commands' => array(
        '', 
        'Availaible Commands(InGame)', 
        'index.php?n=server&sub=commands',
        '8-menuSupport',
        0
    ),
	'gmonline' => array(
        '', 
        'gm_online', 
        'index.php?n=server&sub=gmonline',
        '8-menuSupport',
        0
    ),
    'chars' => array(
        '', 
        'Characters on the server', 
        'index.php?n=server&sub=chars&realm=1',
        '4-menuInteractive',
        0
    ),
    'realmstatus' => array(
        '', 
        'realms_status', 
        'index.php?n=server&sub=realmstatus',
        '4-menuInteractive',
        0
    ),
    'honor' => array(
        '', 
        'honor', 
        'index.php?n=server&sub=honor',
        '4-menuInteractive',
        0
    ),
    'playersonline' => array(
        '', 
        'players_online', 
        'index.php?n=server&sub=playersonline',
        '4-menuInteractive',
        0
    ),
    'bugtracker' => array(
        '', 
        'bugs', 
        'index.php?n=server&sub=bugtracker',
        '4-menuInteractive',
        0
    ),
    'playermap' => array(
        '', 
        'Player Map', 
        'index.php?n=server&sub=playermap',
        '4-menuInteractive',
        0
    ),
    'gms' => array(
        '', 
        'gmlist', 
        'index.php?n=server&sub=gms',
        '8-menuSupport',
        0
    ),
    'statistic' => array(
        '', 
        'statistic', 
        'index.php?n=server&sub=statistic',
        '4-menuInteractive',
        0
    ),
    'howtoplay' => array(
        '', 
        'howtoplay', 
        'index.php?n=server&sub=howtoplay',
        '3-menuGameGuide',
        0
    ),
    'ah' => array(
        '',
        'ah',
        'index.php?n=server&sub=ah',
        '4-menuGameGuide',
        0
    ),
);
?>
