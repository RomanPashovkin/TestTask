<?php
include('DbConfiguration.php');

$queryLastNews = "Select * from news order by date DESC limit 3";
$lastNews = $connection->prepare($queryLastNews);
$lastNews->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная</title>
	<link rel = "stylesheet" media="screen and (min-width: 769px)" href = "/css/home.css">
	<link rel = "stylesheet" media="screen and (max-width: 768px)" href = "/css/mobileHome.css">
</head>
<body>
<h1 id = "home-title">Главная страница тестового задания</h1>
<a id = 'lastNews-title'>Последние новости Галактики</a>
<div id ='lastNews-block'>
	<?php foreach ($lastNews as $row): ?>
		<div class = 'lastNews-item'>
			<div class="lastNews-item-title">
				<a href="#"><?php echo $row['title']; ?></a>
			</div>
			<div class="lastNews-item-announce">
				<a href="#"><?php echo $row['announce']; ?></a>
			</div>
			<div class="lastNews-item-date">
				<a><?php $date = new DateTime($row['date']); echo $date->Format('d.m.Y'); ?></a>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<table>
	<tr>
		<td>
		<div class="anotherPage-btn">
			<a href="http://pashrosf.beget.tech/news.php">ВСЕ НОВОСТИ</a>
		</div>
		</td>
		<td>
		<div class="anotherPage-btn">
			<a href="http://pashrosf.beget.tech/feedbackForm.html">ОБРАТНАЯ СВЯЗЬ</a>
		</div>
		</td>
	</tr>
</table>

</body>
</html>