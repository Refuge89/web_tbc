<!--
Wowhead Talent Calculator
© 2006 Wowhead
 -->
<html>
<head>
<title>Wowhead Talent Calculator</title>
<script>var _, isIE = 0, isIE6 = 0</script><!--[if lte IE 6]>
<script>isIE6 = 1</script><![endif]--><!--[if IE]>
<script>isIE = 1</script><![endif]-->
<script src="common.js"></script>

<link rel="stylesheet" type="text/css" href="talent.css"><!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="talentie.css"><![endif]-->
<script src="talent19.js"></script>

<script>
var params = (window.location ? location.search.substr(location.search.lastIndexOf('?') + 1).split(';') : 0);

if(params.length > 1)
{
	if(params[1].indexOf('http://') != -1)
		document.write('<link rel="stylesheet" type="text/css" href="' + params[1] + '">');
}
</script>
</head>
<body style="margin: 0; padding: 0; overflow: hidden" bgcolor="black">

<table cellpadding="0" cellspacing="0" border="0" align="center" id="mtwtc">
 <tr>
  <td>
   <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
     <td style="padding-bottom: 4px" onmousedown="return false" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
      <div style="width: 141px; height: 26px">
       <div style="width: 1px; position: absolute; z-index: 2">
        <div id="mtwtcMenu1">
         <table style="border:3px solid #232323" border="0" cellpadding="0" cellspacing="0">
          <tr>
           <td>
            <div id="mtwtcMenu2">
             <table id="mtwtcMenu3" border="0" cellpadding="0" cellspacing="0" onmouseover="mtwtc.MenuOver()" onmouseout="mtwtc.MenuOut()">
              <tr><td style="padding-left: 2px"><div><b>Escolha a classe:</b></div></td></tr>
              <tr><td style="background: #232323; height:3px"></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(0)">Druid</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(1)">Hunter</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(2)">Mage</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(3)">Paladin</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(4)">Priest</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(9)">Rogue 1.12</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(5)">Rogue</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(6)">Shaman</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(7)">Warlock</a></div></td></tr>
              <tr><td><div><a href="javascript:;" onmouseup="mtwtc.ChooseClass(8)">Warrior</a></div></td></tr>
             </table>
            </div>
           </td>
          </tr>
         </table>
         <div id="mtwtcMenu4" onmouseover="mtwtc.MenuOver()" onmouseout="mtwtc.MenuOut()" onmousedown="mtwtc.ToggleMenu()"></div>
        </div>
       </div>
      </div>
     </td>
     <td align="right" class="mt" style="padding-right: 1px">
      Patch 1.11 (June 2006)
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td id="mtwtcContainer">
   <table border="0" cellpadding="0" cellspacing="0">
    <tr>
     <td height="456" onmousedown="return false" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" valign="top">
      <table cellpadding="0" cellspacing="0" border="0" width="300" height="456" id="mtwtcTrees"><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr><tr style="display: none"><td></td><td></td><td></td></tr></table>
     </td>
    </tr>
    <tr>
     <td id="mtwtcStats" style="background: black">
      <table width="100%" cellpadding="0" cellspacing="1" border="0">
       <tr>
        <td>
         <a href="javascript:;" onmousedown="return false" onclick="mtwtc.ResetAll()">Resetar Tudo</a>
        </td>
        <td align="right">
         Level Requerido: <span>1</span>
        </td>
       </tr>
       <tr>
        <td>
         Pontos usuados: <span>0/0/0</span>
        </td>
        <td align="right">
         Pontos sobrando: <span>51</span>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td id="mtwtcTabs" style="display: none" onmousedown="return false" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
     <td width="33%" valign="top" align="left"><div onmouseup="mtwtc.TabClick(0, this, event)" onmouseover="mtwtc.TabOver(0, this)" onmouseout="mtwtc.HideTooltip()" oncontextmenu="mtwtc.TabContext(0, this)">&nbsp;</div></td>
     <td width="33%" valign="top" align="center"><div onmouseup="mtwtc.TabClick(1, this, event)" onmouseover="mtwtc.TabOver(1, this)" onmouseout="mtwtc.HideTooltip()" oncontextmenu="mtwtc.TabContext(1, this)">&nbsp;</div></td>
     <td width="33%" valign="top" align="right"><div onmouseup="mtwtc.TabClick(2, this, event)" onmouseover="mtwtc.TabOver(2, this)" onmouseout="mtwtc.HideTooltip()" oncontextmenu="mtwtc.TabContext(2, this)">&nbsp;</div></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td style="padding-top: 10px" align="center">
   <table cellspacing="0" cellpadding="2" border="0" width="300">
    <tr>
     <td class="mt2">
      <a href="/?talent" target="_blank" id="mtwtcLink"><?php echo $lang['talent_index']; ?></a>
     </td>
     <td class="mt2" align="center">
      <a href="javascript:;" onmousedown="return false" onclick="mtwtc.ShowSummary(0)"><?php echo $lang['talent_summary']; ?></a>
     </td>
     <td class="mt2" align="right">
      <a href="javascript:;" onmousedown="return false" onclick="mtwtc.ShowSummary(1)"><?php echo $lang['Printable version']; ?></a>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td style="padding-top: 4px" align="center">
   <table cellspacing="0" cellpadding="2" border="0" width="300">
    <tr>
     <td class="mt2">
      <a href="javascript:;" onmousedown="return false" onclick="mtwtc.ImportBlizz()"><?php echo $lang['talent_import']; ?></a>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td style="padding-top: 4px" align="center">
   <table cellspacing="0" cellpadding="2" border="0" width="300">
    <tr>
     <td class="mt">
	 </td>
	</tr>
   </table>
  </td>
 </tr>
</table>



<div id="mtwtcTooltip" style="display: none">
 <table cellspacing="0" cellpadding="0" border="0">
  <tr>
   <td><div></div></td>
   <th style="background-position: top right"></th>
  </tr>
  <tr>
   <th style="background-position: bottom left"></th>
   <th style="background-position: bottom right"></th>
  </tr>
 </table>
</div>

<!-- Templates -->
<div style="display: none">

<div id="mtwtcTreeTemplate"><table class="mtwtcTree" cellpadding="0" cellspacing="0" border="0">
 <tr>
  <th rowspan="8"></th>
  <th colspan="4"></th>
  <th rowspan="8"></th>
 </tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr><td></td><td></td><td></td><td></td></tr>
 <tr>
  <th colspan="6"></th>
 </tr>
</table></div>

<div id="mtwtcArrowsTemplate">

<div class="mtwtcArrow"><table border="0" cellpadding="0" cellspacing="0" class="mtwtcArrowDown">
  <tr><td></td></tr>
  <tr><td style="background-position: bottom; height: 100%"></td></tr>
 </table>
</div>

<div class="mtwtcArrow"><table border="0" cellpadding="0" cellspacing="0" class="mtwtcArrowLeftDown">
  <tr>
   <td style="background-position: left; width: 100%"></td>
   <td style="background-position: right"></td>
  </tr>
  <tr><th style="background-position: bottom left; background-repeat: no-repeat; height: 100%" colspan="2"></th></tr>
 </table>
</div>

<div class="mtwtcArrow"><table border="0" cellpadding="0" cellspacing="0" class="mtwtcArrowRightDown">
  <tr>
   <td style="background-position: left"></td>
   <td style="background-position: right; width: 100%"></td>
  </tr>
  <tr><th style="background-position: bottom right; background-repeat: no-repeat; height: 100%" colspan="2"></th></tr>
 </table>
</div>

<div class="mtwtcArrow"><table border="0" cellpadding="0" cellspacing="0" class="mtwtcArrowRight">
  <tr>
   <td style="background-position: left"></td>
   <td style="background-position: right; width: 100%"></td>
  </tr>
 </table>
</div>

</div>

</div><!-- ^End templates -->

<!-- Preloading -->
<div style="visibility: hidden; position: absolute; left: 0; top: -1000px">

<iframe name="mtwtcDataFrame" onload="mtwtc.ProcessData()"></iframe>
<script>mtwtc.Initialize()</script>

<script>
var sc_date, sc_time, sc_time_difference, sc_img;
var EXs, EXb, EXd, EXjv, EXw;
</script>


</div><!-- ^End preloading -->

</body>
</html>
