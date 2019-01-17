<html>
<head>
<title>ZNN News</title>
<meta charset="UTF-8">
</head>
<body>

<?php include 'config.php';?>

<?php

$server_port = $_SERVER["SERVER_PORT"];
$server_ip = $_SERVER["SERVER_ADDR"];

if ($sleep != 0) {
	sleep($sleep);
}

$result = query("SELECT COUNT(1) FROM news;");
if (!$result) {
	die("Execute query error, because: ". print_r($pdo->errorInfo(), true));
}
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

#
# Print the footer with some diagnostic information.
#
echo "<hr>
	<p>
		<small>ZNN fake news service. Server by $server_ip:$server_port. </small>
		<small>Fideliy level <b>$fidelity</b>. Specified by env var 'FIDELITY'. If not set, default is high</small>
	</p>
	<p>
		<small>Total news in database: $news_count. Printing news $news_index
		with ID $news_id (news has $news_img_cnt images).</small>
	</p>
	";
?>

</body>
</html>
