<!DOCTYPE html>
<html lang="en">
<head>
	<title>ZNN News</title>
	<meta charset="UTF-8">
	<link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			padding-top: 3rem;
		}
		.starter-template {
			padding: 3rem 1.5rem;
			text-align: justify;
		}
		h1, li {
			text-transform: uppercase
		}
		img {
			width:350px; 
			height:350px;
		}
	</style>
	
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="#">ZNN</a>
	<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="/news.php">Latest News</a></li>
		</ul>
	</div>
</nav>

<?php include 'config.php';?>

<?php
$result = query("SELECT COUNT(1) FROM news;");
$row = $result->fetch();
$news_count = $row[0];
$result = query("SELECT news_id, news_title, news_text, news_img_cnt FROM news ORDER BY RAND() LIMIT 1;");
$row = $result->fetch();

$news_id = $row[0];
$news_title = $row[1];
$news_text = str_replace("\n\n", " ", $row[2]);
$news_img_cnt = $row[3];

echo "
	<div class=\"starter-template\">
		<h1>$news_id - $news_title</h1>
		<article>$news_text</article>";

$fidelity = resolve_fidelity();
if ($fidelity == "high") {
	echo "<div class=\"alert alert-info\">ZNN is running in <strong>HIGH</strong> mode</div>";
	$img_field = "img_high_res";
} else if ($fidelity == "low") {
	echo "<div class=\"alert alert-warning\">ZNN is running in <strong>LOW</strong> mode</div>";
	$img_field = "img_low_res";
} else {
	echo "<div class=\"alert alert-dark\">ZNN is running in <strong>TEXT</strong> mode</div>";
}

$result = query("SELECT img_id, $img_field FROM img WHERE news_id = $news_id ORDER BY img_id;");
for ($i = 0; $i < $news_img_cnt; $i++) {
	$row = $result->fetch();
	echo "<img class=\"img-thumbnail rounded mr-1\" src=\"" . $row[1] . "\"/>";
}
echo "</div>"
?>

</body>
</html>
