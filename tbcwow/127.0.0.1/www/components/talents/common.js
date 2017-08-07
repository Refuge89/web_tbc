function ge(z){return document.getElementById(z)}
function gE(z,y){return z.getElementsByTagName(y)}
function ce(z){return document.createElement(z)}
function de(z){z.parentNode.removeChild(z)}
function ct(z){return document.createTextNode(z)}
function rf(){return false}
function ac(z){var a=0,b=0;while(z){a+=z.offsetLeft;b+=z.offsetTop;z=z.offsetParent}return [a,b]}
function aE(z,y,x){if(isIE)z.attachEvent('on'+y,x);else z.addEventListener(y,x,false)}
function sp(z){if(!z)z=event;if(isIE){z.cancelBubble=true;z.returnValue=false}else{z.stopPropagation();z.preventDefault()}}
function sc(z,y,x,w,v){var a=new Date();var b=z+'='+escape(x)+'; ';a.setDate(a.getDate()+y);b+='expires='+a.toUTCString()+'; ';if(w)b+='path='+w+'; ';if(v)b+='domain='+v+'; ';document.cookie=b}
function dc(z){sc(z,-1)}
function gc(z){var b,c;if(!z){var a=[];c=document.cookie.split('; ');for(var i=0;i< c.length;++i){b=c[i].split('=');a[b[0]]=unescape(b[1])}return a}else{b=document.cookie.indexOf(z+'=');if(b!=-1){if(b==0||document.cookie.substring(b-2,b)=='; '){b+=z.length+1;c=document.cookie.indexOf('; ',b);if(c==-1)c=document.cookie.length;return unescape(document.cookie.substring(b,c))}}}return null}
function strcmp(a,b){if(a == null)return -1; if(a==b)return 0;return a<b?-1:1}
function rtrim(z,y){var a=z.length;while(--a>0&&z.charAt(a)==y);z=z.substring(0,a+1);if(z==y)z='';return z}
function str_replace(z,a,b){while(z.indexOf(a)!=-1)z=z.replace(a,b);return z}

function g_FixMenu(a, d, u)
{
	for(var i = 0; i < a.length; ++i)
	{
		if(d)
		{
			a[i][2] = u + a[i][0];
			if(a[i][3])
				g_FixMenu(a[i][3], d + 1, u + a[i][0] + '.');
		}
		else
		{
			if(a[i][3])
				g_FixMenu(a[i][3], 1, a[i][2] + '=');
		}
	}
}

var lv_nRowsPerPage = 50, lv_iconSize = 1;