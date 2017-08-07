<?

/*

$cache is object used to cache output and objects.

Cache constructor arguments are:

  $path:
    - Location where cache files will be stored
    
  $disable=false
    - Disable caching (for debugning purpuoses etc.)
    
  $disable_output
    - Disable output of cached data
    - Data can still be accessed using $cache->output variable
    
*/

require_once("cache.php");

$path = ".";
$file = "cache.test_01.tmp";
$expire = 20;

$cache_this = new Cache($path);

// Part in side of while loop is cached to $file

while($cache_this->save("cache.test_01.tmp",$expire))
{
	echo("<b>Hello World!</b><br>");
	echo("In cached part it's ".date("H:i:s")."<br>");
	echo("<i>This part will expire in ".$expire." s</i><br>");
	echo("Output is stored in <b>".$path."/".$file."</b><br>");
	echo("<br>");
}

echo("<b>This part is executed every time</b><br>");
echo("Real time is ".date("H:i:s")."<br>");
	

?>
