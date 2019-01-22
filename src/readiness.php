<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
<title>ZNN Readiness page</title>
<style>
    body {
        text-align: center;
        font-family: Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
</head>
<body>

<h1>ZNN Readiness page</h1>

<?php include 'config.php';?>
<?php
  try {
    $res = query("SELECT 1 FROM news;");
    $count = $res->rowCount();
    if ($count > 0) {
      echo "<p>ZNN ready to accept connections</p>";
    } else if ($count == 0) {
      echo "<p>No news in database.</p>";
      http_response_code(500);
    } else {
      $sql = file_get_contents('./db/init.sql');
      $qr = $pdo->exec($sql);
      http_response_code(200);
    }
  } catch (PDOException $e) {
    $sql = file_get_contents('./db/init.sql');
    $qr = $pdo->exec($sql);
    http_response_code(500);
    echo 'Caught exception: ',  $e->getMessage() . '. Try again.';
  }
?>

</body>
</html>