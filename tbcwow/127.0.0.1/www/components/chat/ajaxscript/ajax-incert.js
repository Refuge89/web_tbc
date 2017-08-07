// Hier kommt AJAX Aufruf des Serverinhaltes.
    var http_request = false;
    var i=0;

    function macheRequest(url) {

        http_request = false;

        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
                // zu dieser Zeile siehe weiter unten
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }

        if (!http_request) {
            alert('Ende :( Kann keine XMLHTTP-Instanz erzeugen');
            return false;
        }

		http_request.open('POST', url, true);
		http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		http_request.onreadystatechange = alertInhalt;

// Datenversand

var send_fett = document.forms[0].fett.checked ? true : false;
var send_kursiv = document.forms[0].kursiv.checked ? true : false;
try {var send_privat = document.forms[0].privat.checked ? true : false;}
catch(e){}
var send_message = encodeURIComponent(document.forms[0].message.value);

http_request.send('message='+send_message+'&privat_name='+document.forms[0].privat_name.value+'&farbe='+document.forms[0].farbe.value+'&fett='+send_fett+'&kursiv='+send_kursiv+'&privat='+send_privat);
    }

function alertInhalt() {

        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                //alert(http_request.responseText);
                //document.getElementById('Chatinhalt').innerHTML = http_request.responseText;
            } else {
                //alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }

    }

//#############################################################################################


function resend()
{
	macheRequest("incert.php");
	document.forms[0].message.value = "";
	document.forms[0].message.focus();

	try {document.forms[0].privat.checked=false; document.forms[0].privat.disabled=true;}
	catch(e){}

	window.setTimeout("parent.oben.macheRequest('reloader.php')", 400);
	return false;
}