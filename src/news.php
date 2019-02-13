<!DOCTYPE html>
<html>
<head>
<title>ZNN News</title>
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
<style>
    body {
        font-family: Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
</head>
<body>
<?php include 'config.php';?>

<?php
$sleep = getenv("SLEEP_TIME") ?: 0;
if ($sleep != 0) {
	sleep($sleep);
}
?>

<?php
$result = query("SELECT COUNT(1) FROM news;");
$row = $result->fetch();
$news_count = $row[0];
$result = query("SELECT news_id, news_title, news_text, news_img_cnt FROM news ORDER BY RAND() LIMIT 1;");
$row = $result->fetch();

$news_id = $row[0];
$news_title = $row[1];
$news_text = "<p>" . str_replace("\n\n", "</p><p>", $row[2]) . "</p>";
$news_img_cnt = $row[3];

echo "
	<h1>$news_id - $news_title</h1>
	<article>$news_text</article>
	<hr>";

$fidelity = resolve_fidelity();
if ($fidelity == "text") {
	echo "<p>No images served in text fidelity mode.</p>";
} else {
	if ($fidelity == "high") {
		$img_field = "img_high_res";
	} else {
		$img_field = "img_low_res";
	}
	$result = query("SELECT img_id, $img_field FROM img WHERE news_id = $news_id ORDER BY img_id;");
	for ($i = 0; $i < $news_img_cnt; $i++) {
		$row = $result->fetch();
		echo "<p><img src=\"images/" . $row[1] . "\"/>";
		echo "<br>";
		echo "<small>Image " . $row[0] . ", name = " . $row[1] . "</small></p>";
	}
}

echo "<hr>
	<p>
		<small>Fideliy level: <b>$fidelity</b>. Specified by env var 'FIDELITY' or 'FIDELITY_FILE'. If not set, default is high</small>
	</p>
	<p>
		<small>Total news in database: $news_count. Printing news with ID $news_id (news has $news_img_cnt images).</small>
	</p>
	<p>
		<small>Version 5af5119a</small>
	</p>
	";
?>

</body>
</html>
