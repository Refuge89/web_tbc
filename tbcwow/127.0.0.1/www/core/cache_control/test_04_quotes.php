<?

/*
This is test for data serialization....
*/

require_once("cache.php");

$path = ".";
$cache = new Cache($path);

$test_variable = null;

while($cache->save("cache.test_03.tmp",10,array(&$test_variable)))
{

	$test_variable = array(true,false,0,1,2,"x"," \" ' \n \t ( \";s:105:\"<b ");

	echo("<b>This part is executed every 10 seconds</b><br>");
	echo("This is test for data serialization<br>");
	echo("\" quote ' apos \n new line \t tab ( ut__\";s:105:\"<b Thi )<br>");
	echo(date("H:i:s")."<br>");
	
}

echo("<b>This part is executed every time</b><br>");
echo(date("H:i:s")."<br>");

var_dump($test_variable);

?>