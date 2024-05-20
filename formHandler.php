<?php
include('DbConfiguration.php'); // Подключение конфигурационного файла

//Получаем данные из Ajax-запроса
if(isset($_POST['FIO'])){
	$fio = $_POST['FIO'];
}
if(isset($_POST['address'])){
	$address = $_POST['address'];
}
if(isset($_POST['telephone'])){
	$telephone = $_POST['telephone'];
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
}

$errors = array();
//проверка email на корректность
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[] = "Некорректный формат email";
}

if (!empty($errors)) {
	http_response_code(400); // Устанавливаем статус 400 для ошибки
	echo json_encode($errors);
	exit;
}

//Выполнение запроса для добавления в базу
$insertQuery = sprintf("Insert into clients (fio, address, telephone, email) values(%s, %s, %s, %s)",
$connection->quote($fio), $connection->quote($address), $connection->quote($telephone), $connection->quote($email));
$stmt = $connection->prepare($insertQuery);
$stmt->execute();

//Получаем айдишник последней добавленной записи
$insertedId = $connection->lastInsertId();

//Получаем данные по нашей записи и возвращаем в формате JSON
$result = $connection->query("Select fio as ФИО, address as Адрес, telephone as Телефон, email as Почта from clients where id = $insertedId")->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);

?>