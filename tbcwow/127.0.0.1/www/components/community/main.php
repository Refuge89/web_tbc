<?php
$com_content['community'] = array(
    'index' => array(
        '', // g_ option require for view     [0]
        'community', // loc name (key)                [1] 
        'index.php?n=community', // Link to                 [2]
        '', // main menu name/id ('' - not show)        [3]
        0 // show in context menu (1-yes,0-no)          [4]
    ),

    'chat' => array(
        '', 
        'chat', 
        'index.php?n=community&sub=chat',
        '7-menuCommunity',
        0
    ),

    'teamspeak' => array(
        '', 
        'teamspeak', 
        'index.php?n=community&sub=teamspeak',
        '7-menuCommunity',
        0
    ),
);
?>