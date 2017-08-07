<?

/*
You can simply nest multiple cache blocks with single Cache object.
Cached blocks are identified using cache file name - always use unique names!
*/

require_once("cache.php");

$path = ".";
$cache = new Cache($path);

while($cache->save("cache.test_02_part1.tmp",5))
{
	echo("<b>This part is executed every 5 seconds</b><br>");
	echo(date("H:i:s")."<br><br>");
	
	while($cache->save("cache.test_02_part2.tmp",10))
	{
		echo("<b>This part is executed every 10 seconds</b><br>");
		echo(date("H:i:s")."<br><br>");
	
	}

}

echo("<b>This part is executed every time</b><br>");
echo(date("H:i:s")."<br>");
	

?>