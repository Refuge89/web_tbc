<?php
if(INCLUDED!==true)exit;

require_once "core/ajax_lib/Php.php";
$JsHttpRequest =& new JsHttpRequest("$config[site_encoding]");

    switch ($sub) {
    case 'preview':
        $req_sub = "ajax.preview.php";
        break;
    case 'userlist':
        $req_sub = "ajax.userlist.php";
        break;
    case 'checkemail':
        $req_sub = "ajax.checkemail.php";
        break;
    case 'checklogin':
        $req_sub = "ajax.checklogin.php";
        break;
    case 'getquote':
        $req_sub = "ajax.getquote.php";
        break;
/*    case 'honor':
        $req_sub = "ajax.honor.php";
        break;*/
    default:
        $req_sub = false;
    }

if($req_sub!==false)require_once($req_sub);
?>