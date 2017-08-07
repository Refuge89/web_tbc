<?php ## Подключение к БД.
show_source(__FILE__);
require_once "../../lib/DbSimple/Generic.php";

// Подключаемся к БД.
$DB = DbSimple_Generic::connect("mysql://test:test@localhost/test");

// Устанавливаем обработчик ошибок.
$DB->setErrorHandler('databaseErrorHandler');

// Выполняем запрос, содержащий ошибку (для демонстрации).
$DB->select('This is a query with error!');

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
	// Если использовалась @, ничего не делать.
	if (!error_reporting()) return;
	// Выводим подробную информацию об ошибке.
	echo "SQL Error: $message<br><pre>"; 
	print_r($info);
	echo "</pre>";
	exit();
}
?>
