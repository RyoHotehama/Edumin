<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
session_start();
unset($_SESSION['login']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>ログアウト完了</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "compleate">
    <h1>ログアウトしました</h1>
  </div>
  <div class = "top">
    <a href = "index.php">トップへ</a>
  </div>
</body>
</html>
