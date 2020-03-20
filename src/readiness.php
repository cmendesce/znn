<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZNN Readiness page</title>
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
		h1 {
			text-transform: uppercase
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="#">ZNN</a>
	<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="/news.php">Latest News</a></li>
			<li class="nav-item"><a class="nav-link" href="/liveness.php">Liveness</a></li>
			<li class="nav-item"><a class="nav-link" href="/readiness.php">Readiness</a></li>
			<li class="nav-item"><a class="nav-link" target="_blank" href="https://github.com/cmendesce/znn">Github</a></li>
		</ul>
	</div>
</nav>
<div class="starter-template">
    <h1>ZNN Readiness page</h1>

    <?php include 'config.php';?>
    <?php
      try {
		$result = query("SELECT COUNT(1) FROM news;");
		$row = $result->fetch();
		$count = $row[0];
        if ($count > 0) {
          echo "<p>ZNN ready to accept connections. " . $count . " news in database." . "</p>";
        } else if ($count == 0) {
          echo "<p>No news in database.</p>";
          http_response_code(500);
        }
      } catch (PDOException $e) {
        http_response_code(500);
        echo 'Caught exception: ',  $e->getMessage() . '. Try again.';
      }
    ?>
</div>
</body>
</html>