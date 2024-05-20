<?php
//Конфигурация для подключения к БД

$dbname = 'pashrosf_baza';
$host = 'localhost';
$username = 'pashrosf_baza';
$password = '28051980MySQL+';
$connection = new PDO('mysql:dbname='.$dbname.'; host = '. $host, $username, $password);
try{
	$connection = new PDO('mysql:dbname='.$dbname.'; host = '. $host, $username, $password);
} catch(PDOException $e) {
	die('Ошибка соединения: ' . $e);
}

?>