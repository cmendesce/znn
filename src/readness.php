<?php include 'config.php';?>

<?php
  $res = query("SELECT COUNT(*) FROM news;");
  if ($res->fetchColumn() > 0) {
    http_response_code(200);
  } else {
    $sql = file_get_contents('./db/init.sql');
    $qr = $pdo->exec($sql);
  }
?>