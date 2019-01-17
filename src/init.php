<?php include 'config.php';?>

<?php
  $sql = file_get_contents('./db/init.sql');
  $qr = $pdo->exec($sql);
  if ($qr) {
    echo("Failed to load database");
    die();
  }
  echo("Database initialized successfully!");
?>
