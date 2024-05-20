<?php
include("DbConfiguration.php");

$item = $_GET['item'];
$query_item = sprintf("Select * from news where id = %s ", $connection->quote($item));
$result = $connection->prepare($query_item);
$result->execute();
?>

<?php foreach ($result as $row): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $row['title']?></title>
	<link rel="stylesheet" href="css/style.css">
	<link rel = "stylesheet" href = "css/news.css">
</head>

<body>

	<hr class = "detailed-hr">

	<div class ="address">
		<a> Новости &nbsp/&nbsp <?php echo $row['title']?></a>
	</div>

	<h1 class = "detailed-title"><?php echo $row['title']?></h1>

	<div class="detailed-item">
		<div class="news-item-date">
			<a><?php $date = new DateTime($row['date']);  echo $date->Format('d.m.Y'); ?></a>			
		</div>

		<div class="news-item-title">
			<a><?php echo $row['title']; ?></a>
		</div>

		<div class="news-item-content">
			<a><?php echo $row['content']; ?></a>
		</div>

		<div class="news-item-btn">
			<a href="http://pashrosf.beget.tech/news.php">НАЗАД К НОВОСТЯМ</a>
		</div>

		<div class = "detailed-image">
		<img class = "dimage" src = "images/<?php echo $row['image'];?>"/>
		</div>
	</div>
</body>
</html>
<?php endforeach; ?>