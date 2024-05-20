<?php
include('DbConfiguration.php');

$queryNews = "Select * from news order by date DESC limit 5";
$news = $connection->prepare($queryNews);
$news->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Новости</title>
	<link rel = "stylesheet" media="screen and (min-width: 769px)" href = "/css/news.css">
	<link rel = "stylesheet" media="screen and (max-width: 768px)" href = "/css/mobileNews.css">
</head>
<body>
<h1 class = "news-title">Новости</h1>

<div class="news-list">
	<?php foreach ($news as $row): ?>
		<div class="news-item">
			<div class="news-item-date">
				<a><?php $date = new DateTime($row['date']); echo $date->Format('d.m.Y'); ?></a>
			</div>
			<div class="news-item-title">
				<a href="http://pashrosf.beget.tech/detailed.php?item=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a>
			</div>
			<div class="news-item-announce">
				<a href="http://pashrosf.beget.tech/detailed.php?item=<?php echo $row['id'] ?>"><?php echo $row['announce']; ?></a>
			</div>
			<div class="news-item-btn">
				<a href="http://pashrosf.beget.tech/detailed.php?item=<?php echo $row['id'] ?>">ПОДРОБНЕЕ</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>
</body>
</html>