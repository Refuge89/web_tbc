<?
/*

With Cache object you can cache objects!
Objects need to be defined before cache block and sent as array of
  object references (using '&' operator) in third parameter of save function.
*/

class cTest
{
	function cTest($a,$b,$c)
	{
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}
	
	function foo()
	{
		echo("FOO: a = ".$this->a."; b = ".$this->b."; c = ".$this->c."<br>");
	}
}

$foo01 = new cTest("A","B","C");
$foo02 = new cTest("1","2","3");
$foo03 = new cTest("x","y","z");

$foo01->foo();
$foo02->foo();
$foo03->foo();
echo "<br>";

require_once("cache.php");

$path = ".";
$cache = new Cache($path);


while($cache->save("cache.test_04.tmp",10,array(&$foo01,&$foo02,&$foo03)))
{
	echo("<b>This part is executed every 10 seconds</b><br>");
	
	$foo01->a = "bar ".rand(0, 100);
	$foo02->b = $foo02->a.$foo02->b.$foo02->c;
	$foo02->c = "This is changed at ".date("H:i:s");
	
	echo(date("H:i:s")."<br>");
	
}

echo("<b>This part is executed every time</b><br>");
echo(date("H:i:s")."<br>");

echo("<br><i>Values in objects should be different than on start of file...</i><br>");
$foo01->foo();
$foo02->foo();
$foo03->foo();
	

?>