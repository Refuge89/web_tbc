<?php ## ����������� � ��.
show_source(__FILE__);
require_once "../../lib/DbSimple/Generic.php";

// ������������ � ��.
$DB = DbSimple_Generic::connect("mysql://test:test@localhost/test");

// ������������� ���������� ������.
$DB->setErrorHandler('databaseErrorHandler');

// ��������� ������, ���������� ������ (��� ������������).
$DB->select('This is a query with error!');

// ��� ����������� ������ SQL.
function databaseErrorHandler($message, $info)
{
	// ���� �������������� @, ������ �� ������.
	if (!error_reporting()) return;
	// ������� ��������� ���������� �� ������.
	echo "SQL Error: $message<br><pre>"; 
	print_r($info);
	echo "</pre>";
	exit();
}
?>
