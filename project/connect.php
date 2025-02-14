<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include "config.php";
$dsn = dbms . ":host=" . host . ";dbname=" . dbname;
try {
  $link = new pdo($dsn, dbuser, dbpassword);
  $link->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
  echo "連線失敗: " . $e->getMessage();
}
