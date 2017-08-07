<?

/*
This examle shows why cacheing is important...
You shuld cache your data when doing complex math calculations,
executing many database querys or taking too many processor time
on server for any reason.
*/

require_once("cache.php");

$path = ".";
$cache = new Cache($path);

$time = microtime_float();

while($cache->save("cache.test_05.tmp",10))
{
	$pi = bcpi(40);
	echo("<b>pi = ".$pi."</b><br><br>");
	echo("<b>This part is executed every 10 seconds</b><br>");
	echo("<b>Time of execution: <u>".(microtime_float() - $time)." s</u></b><br><br>");
}

echo("<b>This part is executed every time</b><br>");
echo("<b>Script time of execution: <u>".(microtime_float() - $time)." s</u></b><br><br>");



// helper functions...............................

function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}


function bcpi($precision=30){
        $accuracy = ($precision+5)*45/32;
	//accuracy worked till the 180th $precision, almost used 30 second to calculate
	    bcscale($precision+5);
	    $n = 1;
	    $bcatan1 = 0;
	    $bcatan2 = 0;
	    while($n < $accuracy){
	//atan functions
	        $bcatan1 = bcadd($bcatan1, bcmul(bcdiv(pow(-1, $n+1), $n * 2 - 1), bcpow(0.2, $n * 2 -1)));
	        $bcatan2 = bcadd($bcatan2, bcmul(bcdiv(pow(-1, $n+1), $n * 2 - 1), bcpow(bcdiv(1,239), $n * 2 -1)));
	        ++$n;
	    }
    return  bcmul(4,bcsub(bcmul(4, $bcatan1),$bcatan2),5);
}


?>