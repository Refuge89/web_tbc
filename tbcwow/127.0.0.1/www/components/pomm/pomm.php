<?php
/*	POMM
	Player Online Map for MangOs
	16.09.2006
	Created by mirage666 (c) (mailto:mirage666@pisem.net icq# 152263154)
	
	Optimized and Edited In order to fit MMM framework by Q.SA.
	TBC support by Q.SA.
*/

require_once ("pomm_cfg.php");

$realm_name = get_realm_name();
?>

<HTML><HEAD><title><?php echo $realm_name ?></title>
<link rel="stylesheet" href="pomm.css" type="text/css">
</HEAD>
<script language="JavaScript" src="JsHttpRequest/Js.js"></script>
<script language="javascript" TYPE="text/javascript">

var time = <?php echo $time ?>;
var race_name = {
		1: '<?php echo $lang_id_tab['human'] ?>',
		2: '<?php echo $lang_id_tab['orc'] ?>',
		3: '<?php echo $lang_id_tab['dwarf'] ?>',
		4: '<?php echo $lang_id_tab['nightelf'] ?>',
		5: '<?php echo $lang_id_tab['undead'] ?>',
		6: '<?php echo $lang_id_tab['tauren'] ?>',
		7: '<?php echo $lang_id_tab['gnome'] ?>',
		8: '<?php echo $lang_id_tab['troll'] ?>',
		9: '<?php echo $lang_id_tab['goblin'] ?>',
		10: '<?php echo $lang_id_tab['bloodelf'] ?>',
		11: '<?php echo $lang_id_tab['draenei'] ?>'
}

var class_name = {
		1: '<?php echo $lang_id_tab['warrior'] ?>',
		2: '<?php echo $lang_id_tab['paladin'] ?>',
		3: '<?php echo $lang_id_tab['hunter'] ?>',
		4: '<?php echo $lang_id_tab['rogue'] ?>',
		5: '<?php echo $lang_id_tab['priest'] ?>',
		7: '<?php echo $lang_id_tab['shaman'] ?>',
		8: '<?php echo $lang_id_tab['mage'] ?>',
		9: '<?php echo $lang_id_tab['warlock'] ?>',
		11: '<?php echo $lang_id_tab['druid'] ?>'
}

function tip(header,text) { 
var t; 
t=document.getElementById("tip"); 

if (window.opera) { 
x=window.event.clientX+15; 
y=window.event.clientY-10; 
} else if (navigator.appName=="Netscape") {
document.onmousemove=function(e) { x = e.pageX+15; y = e.pageY-10; return true}
} else { 
x=window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft + 15; 
y=window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop - 10; 
} 

t.innerHTML='<table width="80" border="0" cellspacing="0" cellpadding="0"\><tr class=\'tip_header\'\><td\>'+header+'</td\></tr\><tr class=\'tip_text\'\><td\>'+text+'</td\></tr\><\/table\>';
if (screen.width-x<150) x-=150; 
t.style.left=x + "px"; 
t.style.top=y + "px"; 
} 

function h_tip() { 
var t; 
t=document.getElementById("tip"); 
t.innerHTML=""; 
t.style.left="-1000px"; 
t.style.top="-1000px"; 
} 

function show(data) {
i=0;
text='';
if (data) {
while (i<data.length) {
	if (data[i].race==2 || data[i].race==5 || data[i].race==6 || data[i].race==8 || data[i].race==10) 
											{point="img/h_point.gif";} else
											{point="img/a_point.gif";}
	text=text+'<img src="'+point+'" style="position: absolute; border: 0px; left: '+data[i].x+'px; top: '+data[i].y+'px;" onMouseMove="tip(\''+data[i].name+'\',\''+data[i].zone+'<br\><img src=\\\'img/'+data[i].race+'-'+data[i].gender+'.gif\\\' style=\\\'float:center\\\' border=0 width=18 height=18\> <img src=\\\'img/'+data[i].cl+'.gif\\\' style=\\\'float:center\\\' border=0 width=18 height=18\><br\>'+race_name[data[i].race]+'<br/>'+class_name[data[i].cl]+'<br/>'+data[i].level+'\');" onMouseOut="h_tip();"\>';
i++;
}
}
document.getElementById("points").innerHTML=text;
document.getElementById("server_info").innerHTML='Total users Online : '+i+' on <?php echo $realm_name ?><br>&nbsp;';
}

function load_data() {
var req = new Subsys_JsHttpRequest_Js();
req.onreadystatechange = function() {
	if (req.readyState == 4) {show(req.responseJS);}
    }
    req.open('GET', 'pomm_run.php', true);
    req.send({ });
}

function reset() {
var ms = 0;
then = new Date();
then.setTime(then.getTime()-ms);
load_data();
}

function display() {
now = new Date();
ms = now.getTime() - then.getTime();
ms = time*1000-ms;
if  (time!=0) {document.getElementById("timer").innerHTML=(Math.round(ms/1000));}
if (ms<=0) {
	reset();
	}
if (time!=0) {setTimeout("display();", 500);}
}

function start() {
reset();
display();
if (navigator.appName=="Netscape") {
document.onmousemove=function(e) { x = e.pageX+15; y = e.pageY-10; return true}
}
}
</SCRIPT>
<BODY onload="start();">
<div id="tip"></div><div ID="points"></div><div ID="world"></div><div ID="info"><center><table border="0" cellspacing="0" cellpadding="0" height="20"><tr><td valign="top" id="timer"></td></tr></table>
<table border="0" cellspacing="0" cellpadding="0" height="470" width="1">
<tr><td></td></tr></table>
<table border="0" cellspacing="0" cellpadding="0" height="35" width="100%">
<tr><td align="center" valign="top" id="server_info"></td></tr></table></center>
</div></BODY></HTML>
