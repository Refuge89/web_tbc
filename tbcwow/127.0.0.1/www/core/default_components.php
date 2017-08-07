<?php

$mainnav_links = array (
  '1-menuNews' => 
  array (
    0 => 
    array (
      0 => 'mainpage',
      1 => 'index.php',
      2 => '',
    ),
  ),
  '2-menuAccount' => 
  array (
    0 => 
    array (
      0 => 'account_manage',
      1 => 'index.php?n=account&sub=manage',
      2 => 'g_view_profile',
    ),
    1 => 
    array (
      0 => 'personal_messages',
      1 => 'index.php?n=account&sub=pms',
      2 => '',
    ),
    2 => 
    array (
      0 => 'account_create',
      1 => 'index.php?n=account&sub=register',
      2 => '',
    ),
    3 => 
    array (
      0 => 'retrieve_pass',
      1 => 'index.php?n=account&sub=restore',
      2 => '',
    ),
    4 => 
    array (
      0 => 'account_activate',
      1 => 'index.php?n=account&sub=activate',
      2 => '',
    ),
    5 =>
    array (
      0 => 'charcreate',
      1 => 'index.php?n=account&sub=charcreate',
      2 => '',
    ),
  ),
  '3-menuGameGuide' => 
  array (
    0 => 
    array (
      0 => 'howtoplay',
      1 => 'index.php?n=server&sub=howtoplay',
      2 => '',
    ),
  ),
  '4-menuInteractive' => 
  array (
    0 => 
    array (
      0 => 'realms_status',
      1 => 'index.php?n=server&sub=realmstatus',
      2 => '',
    ),
    1 => 
    array (
      0 => 'honor',
      1 => 'index.php?n=server&sub=honor&realm='.$site_spesific_config[realm_info][default_realm_id],
      2 => '',
    ),
    2 => 
    array (
      0 => 'players_online',
      1 => 'index.php?n=server&sub=playersonline&realm='.$site_spesific_config[realm_info][default_realm_id],
      2 => '',
    ),
    3 => 
    array (
      0 => 'chars',
      1 => 'index.php?n=server&sub=chars&realm='.$site_spesific_config[realm_info][default_realm_id],
      2 => '',
    ),
    4 => 
    array (
      0 => 'playermap',
      1 => 'index.php?n=server&sub=playermap',
      2 => '',
    ),
    5 => 
    array (
      0 => 'userlist',
      1 => 'index.php?n=account&sub=userlist',
      2 => '',    
    ),
    6 => 
    array (
      0 => 'statistic',
      1 => 'index.php?n=server&sub=statistic',
      2 => '',    
    ),
    7 =>
    array (
      0 => 'module_ah',
      1 => 'index.php?n=server&sub=ah',
      2 => '',
    ),
  ),
  '5-menuMedia' => 
  array (
    0 => 
    array (
      0 => 'wallp',
      1 => 'index.php?n=media&sub=wallp',
      2 => '',
    ),
    1 =>
    array (
      0 => 'screen',
      1 => 'index.php?n=media&sub=screen',
      2 => '',
    ),
    2 =>
    array (
      0 => 'UScreen',
      1 => 'index.php?n=media&sub=addgalscreen',
      2 => '',
    ),
    3 =>
    array (
      0 => 'UWallp',
      1 => 'index.php?n=media&sub=addgalwallp',
      2 => '',
    ),
  ),
  '6-menuForums' => 
  array (
    0 => 
    array (
      0 => 'forums',
      1 => 'index.php?n=forum',
      2 => '',
    ),
  ),
'7-menuCommunity' =>
  array (    
   0 => 
    array (
      0 => 'teamspeak',
      1 => 'index.php?n=community&sub=teamspeak',
      2 => '',
   ),

   1 => 
    array (
      0 => 'chat',
      1 => 'index.php?n=community&sub=chat',
      2 => '',
   ),
  ),

  '8-menuSupport' => 
  array (
    0 =>
    array (
      0 => 'commands',
      1 => 'index.php?n=server&sub=commands',
      2 => '',
    ),
    1 => 
    array (
      0 => 'bugs',
      1 => 'index.php?n=forum&sub=viewforum&fid=2',
      2 => '',
    ),
    2 => 
    array (
      0 => 'gmlist',
      1 => 'index.php?n=server&sub=gms',
      2 => '',
    ),
    3 => 
	array (
      0 => 'gm_online',
      1 => 'index.php?n=server&sub=gmonline&realm='.$site_spesific_config[realm_info][default_realm_id],
      2 => '',
    ),
  ),
);

$allowed_ext = array (
  0 => 'account',
  1 => 'admin',
  2 => 'ajax',
  3 => 'forum',
  4 => 'frontpage',
  5 => 'html',
  6 => 'server',
  7 => 'whoisonline',
  8 => 'community',
  9 => 'media',
);

// Main Forum Navigation Link
if ($site_spesific_config['forum']['frame_forum'] == 1 || $site_spesific_config['forum']['externalforum'] == 0)
{
}
else
{
    $mainnav_links['6-menuForums'][0][1] = $site_spesific_config['forum']['forum_external_link'];
}

//Bugs Tracker Navigation Link
$mainnav_links['8-menuSupport'][1][1] = 'index.php?n=forum&sub=viewforum&fid='.$site_spesific_config['forum']['bugs_forum_id'];
if ($site_spesific_config['forum']['frame_bugstracker'] == 1 || $site_spesific_config['forum']['externalbugstracker'] == 0)
{
}
else
{
    $mainnav_links['8-menuSupport'][1][1] = $site_spesific_config['forum']['bugstracker_external_link'];
}


if ($site_spesific_config[realm_info][multirealm] == 1)
{
	$mainnav_links['4-menuInteractive'][1][1] = 'index.php?n=server&sub=honor';
	$mainnav_links['4-menuInteractive'][2][1] = 'index.php?n=server&sub=playersonline';
	$mainnav_links['4-menuInteractive'][3][1] = 'index.php?n=server&sub=chars';
	$mainnav_links['8-menuSupport'][3][1] = 'index.php?n=server&sub=gmonline';
}


/*Media*/
if ($component_active['left_section']['Screenshots']=='no')
{
	$mainnav_links['5-menuMedia'][0][0] = '';
}
if ($component_active['left_section']['Wallpapers']=='no')
{
	$mainnav_links['5-menuMedia'][1][0] = '';
}
if ($component_active['left_section']['Upload_Screenshot']=='no')
{
	$mainnav_links['5-menuMedia'][2][0] = '';
}
if ($component_active['left_section']['Upload_Wallpaper']=='no')
{
	$mainnav_links['5-menuMedia'][3][0] = '';
}

/*Community*/
if ($component_active['left_section']['Teamspeak']=='no')
{
  $mainnav_links['7-menuCommunity'][0][0] = '';
}
if ($component_active['left_section']['chat']=='no')
{
	$mainnav_links['7-menuCommunity'][1][0] = '';
}


/*Workshop*/
if ($component_active['left_section']['Realms_status']=='no')
{
  $mainnav_links['4-menuInteractive'][0][0] = '';
}
if ($component_active['left_section']['Honor']=='no')
{
  $mainnav_links['4-menuInteractive'][1][0] = '';
}
if ($component_active['left_section']['Players_online']=='no')
{
  $mainnav_links['4-menuInteractive'][2][0] = '';
}
if ($component_active['left_section']['Characters']=='no')
{
  $mainnav_links['4-menuInteractive'][3][0] = '';
}
if ($component_active['left_section']['Playermap']=='no')
{
  $mainnav_links['4-menuInteractive'][4][0] = '';
}
if ($component_active['left_section']['Userlist']=='no')
{
  $mainnav_links['4-menuInteractive'][5][0] = '';
}

if ($component_active['left_section']['Statistic']=='no')
{
  $mainnav_links['4-menuInteractive'][6][0] = '';
}

if ($component_active['left_section']['ah_system']=='no')
{
  $mainnav_links['4-menuInteractive'][7][0] = '';
}


/*Support*/
if ($component_active['left_section']['Commands']=='no')
{
  $mainnav_links['8-menuSupport'][0][0] = '';
}
if ($component_active['left_section']['Bug_tracker']=='no')
{
  $mainnav_links['8-menuSupport'][1][0] = '';
}
if ($component_active['left_section']['In_Game_Support']=='no')
{
  $mainnav_links['8-menuSupport'][2][0] = '';
}
if ($component_active['left_section']['Online_GMs']=='no')
{
  $mainnav_links['8-menuSupport'][3][0] = '';
}
/*Account*/
if ($component_active['left_section']['Activate_account']=='no')
{
  $mainnav_links['2-menuAccount'][4][0] = '';
}
if ($component_active['left_section']['Character_copy']=='no')
{
  $mainnav_links['2-menuAccount'][5][0] = '';
}


?>
