<!--
/*************************************************************************/
/* You may copy, spread the givenned project, 
/* in accordance with GNU GPL, however any change 
/* the code as a whole or a part of the code given project, 
/* advisable produce with co-ordinations of the author of the project
/*
/* (c) Sasha aka LordSc. lordsc@yandex.ru, updated by TGM and Peec
/*************************************************************************/
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $config['site_encoding'];?>">
<link rel="shortcut icon" href="<?php echo $config['template_href'];?>images/favicon.ico">
<title><?php echo $config['site_title'];?><?php echo $title_str;?></title>
<style media="screen" title="currentStyle" type="text/css">
    @import "<?php echo $config['template_href'];?>css/newhp.css";
    @import "<?php echo $config['template_href'];?>css/newhp_basic.css";
    @import "<?php echo $config['template_href'];?>css/newhp_icons.css";
    @import "<?php echo $config['template_href'];?>css/newhp_layout.css";
    @import "<?php echo $config['template_href'];?>css/newhp_specific.css";
    @import "<?php echo $config['template_href'];?>css/additional_optimisation.css";
</style>
<script language="javascript">
    var SITE_HREF = '<?php echo $config['site_href'];?>';
    var DOMAIN_PATH = '<?php echo $config['site_domain'];?>';
    var SITE_PATH = '<?php echo $config['site_href'];?>';
</script>
<script src="<?php echo $config['template_href'];?>js/detection.js" type="text/javascript"></script>
<script src="<?php echo $config['template_href'];?>js/functions.js" type="text/javascript"></script>
<script src="js/global.js" type="text/javascript"></script>
<script type="text/javascript" src="js/compressed/prototype.js"></script>
<!--<script type="text/javascript" src="js/compressed/scriptaculous.js?load=effects,slider"></script>-->
<script type="text/javascript" src="js/compressed/behaviour.js"></script>
<script type="text/javascript" src="js/core.js"></script>
<script type="text/javascript" src="<?php echo$config['template_href'];?>js/template_rules.js"></script>
<script type="text/javascript">
    //
    if (is_ie)
        document.write('<link rel="stylesheet" type="text/css" href="<?php echo $config['template_href'];?>css/additional_win_ie.css" media="screen, projection" />');
    if(is_opera)
        document.write('<link rel="stylesheet" type="text/css" href="<?php echo $config['template_href'];?>css/additional_opera.css" media="screen, projection" />');
    //
</script>
</head>
  <body>
  <!-- TOOLTIP start --> 
<div id="contents">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
  <td><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
  <td bgcolor="#000000"></td>
  <td><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
</tr>
<tr>
  <td bgcolor="#000000"></td>
  <td>
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
        <td width="1" height="1" bgcolor="#000000"></td>
        <td bgcolor="#D5D5D7" height="1"><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
        <td width="1" height="1" bgcolor="#000000"></td>
        </tr>
        <tr>
        <td bgcolor="#A5A5A5" width="1"><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
        <td valign="top" class="trans_div"><div id="tooltipText"></div></td> 
        <td bgcolor="#A5A5A5" width="1"><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
        </tr>
        <tr>
        <td width="1" height="1" bgcolor="#000000"></td>
        <td bgcolor="#4F4F4F"><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="2" alt="" /></td>
        <td width="1" height="1" bgcolor="#000000"></td>
        </tr>
      </table>
  </td>
  <td bgcolor="#000000"></td>
</tr>
<tr>
  <td><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
  <td bgcolor="#000000"></td>
  <td><img src="<?php echo $config['template_href'];?>images/pixel.gif" width="1" height="1" alt="" /></td>
</tr>
</table>
</div>
<script src="<?php echo $config['template_href'];?>js/tooltip.js" type="text/javascript"></script>
<!-- TOOLTIP end --> 
<?php 
// print something lile that when use redirect('link',0,3); <meta http-equiv=refresh content="'.$wait_sec.';url='.$linkto.'">
echo $redirect;
?>
    <div style="background: url(<?php echo $config['template_href'];?>images/page-bg-top.jpg) repeat-x 0 0; height: 88px; position: relative; width: 100%;"></div>
    <center>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <div id="hp">
              <div style="position:relative; z-index:99;">
                <div class="top-nav">
                  <form action="index.php?n=account&sub=login" method="post" id="topSearch">
                    <div id="searchBoxContainer">
                      <div class="searchBoxLeft"></div>
                      <div class="searchBoxBg">
                      <?php if($user['id']>0){ $userpm_num = $auth->check_pm(); ?>
                      <input type="hidden" name="action" value="logout">
                        <li class="searchBoxInput">
                            <b><?php echo $user['username'];?> | </b>
                            <a class="menuFiller" href="index.php?n=account&sub=pms"<?php echo($userpm_num>0?' style="color:red;"':'');?>><?php echo$userpm_num;?> <?php echo $lang['newpms'];?></a>
                            <a href="index.php?n=account&sub=manage"><img src="<?php echo $config['template_href'];?>images/button-profile.gif" align="absmiddle"></a> 
                            <input type="image" src="<?php echo $config['template_href'];?>images/button-logout.gif" align="absmiddle">
                        </li>
                      <?php }else{ ?>
                      <input type="hidden" name="action" value="login">
                          <li class="searchBoxInput">
                            <b>
                            Login: <input class="searchBoxForm" name="login" size="15" type="text"> 
                            Password: <input class="searchBoxForm" name="pass" size="15" type="password"> 
                            </b>
                                <input type="image" src="<?php echo $config['template_href'];?>images/button-login.gif" align="absmiddle">
                          </li>
                      <?php } ?>
                      </div>
                      <div class="searchBoxRight"></div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="top-nav-container">
                <div onMouseOver="myshow('countryDropDown');" OnMouseOut="myhide('countryDropDown');" style="position: absolute; right: 32px; top: 39px; z-index:99; width: 145px;">
                  <div style="overflow: hidden; visibility: inherit; display: block; cursor: default; background-color: transparent; background-image: url(<?php echo $config['template_href'];?>images/countrymenu-bg.gif); height: 19px; padding-left: 9px; padding-top: 2px;"><a class="menuFiller"><?php echo $lang['choose_lang']; ?>:</a><img src="<?php echo $config['template_href'];?>images/pixel.gif"></div>
                  <div id="countryDropDown" style="height: auto; padding-left: 9px; padding-bottom: 4px; background-color: #000; visibility:hidden; display: none;">
                    <?php foreach($languages as $lang_s=>$lang_name){ ?>
                    <a class="menuFiller" style="display:block;" href="javascript:setcookie('Language', '<?php echo $lang_s;?>'); window.location.reload();"><?php echo ($config['lang']==$lang_s?'> '.$lang_name:$lang_name);?></a> 
                    <?php } ?>
                  </div>
                </div>
                <div onMouseOver="myshow('contextDropDown');" OnMouseOut="myhide('contextDropDown');" style="position: absolute; right: 180px; top: 39px; z-index:99; width: 145px;">
                  <div style="overflow: hidden; visibility: inherit; display: block; cursor: default; background-color: transparent; background-image: url(<?php echo $config['template_href'];?>images/countrymenu-bg.gif); height: 19px; padding-left: 9px; padding-top: 2px;"><a class="menuFiller"><?php echo $lang['context_menu']; ?>:</a><img src="<?php echo $config['template_href'];?>images/pixel.gif"></div>
                  <div id="contextDropDown" style="height: auto; padding-left: 9px; padding-bottom: 4px; background-color: #000; visibility:hidden; display: none;">
                    <?php foreach($context_menu as $cmenuitem){ ?>
                    <a class="menuFiller" style="display:block;" href="<?php echo $cmenuitem['link'];?>"><?php echo $cmenuitem['title'];?></a> 
                    <?php } ?>
                  </div>
                </div>
                <div style="position: absolute; top: 0; left: 0; z-index: 20002;">
                  <div id="wow-logo">
                    <a href="./"><img title="World of Warcraft" alt="wowlogo" height="103" width="252" src="<?php echo $config['template_href'];?>images/pixel000.gif"></a>
                  </div>
                </div>
              </div>
              <div>
                <div id="hpWrapper">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top">
                        <div id="navWrapper">
                          <div id="nav">
                            <div id="ne-top-left"></div>
                            <div id="ne-center"></div>
                            <div id="ne-bottom-left"></div>
                            <div id="ne-nav-bg"></div>
                            <div id="leftMenu">
                              <div id="leftMenuContainer">
                                <?php build_main_menu(); ?>
                              </div>
                            </div>
                          </div>
                          <div style="clear: both;"></div>
                        </div>
                      </td><td valign="top">
                        <div id="mainWrapper">
                          <div id="main">
                            <div id="main-content-wrapper">
                              <div id="main-content">
                                <table cellspacing="0" cellpadding="0" border="0">
                                  <tr>
                                    <td>
                                      <div id="main-top">
                                        <div>
                                          <div></div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div id="contentPadding">
                                        <div id="cnt">
                                          <div id="cnt-wrapper">
                                            <div id="contentContainer">
                                              <table cellspacing="0" cellpadding="0" border="0" width="99%">
                                                <tr>
                                                  <td valign="top">
                                                    <div id="cntMain">
                                                      <div id="cnt-top">
                                                        <div>
                                                          <div></div>
                                                        </div>
                                                      </div>
                                                      <div id="content">
                                                        <div id="content-left">
                                                          <div id="content-right">
                                                            <div style="padding-right:10px; padding-left:10px;" id="compcont"> 
                                                            <div style="clear:both;display:block;position:relative;width:100%;margin-top:-4px;">
                                                            <!-- Pathway -->
                                                            <?php if(isset($_GET['n'])){ ?><div class="redBannerBg"><div class="redBannerLeft"></div><div class="redBannerLabel"><?php echo $pathway_str;?></div><div class="redBannerRight"></div></div><?php } ?>
                                                            <?php echo $messages; ?>
                                                            <!-- Component body BEGIN -->
                                                            