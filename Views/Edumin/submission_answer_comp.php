<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
session_start();
$answer = $_SESSION['answer'];
$data = new EduminController();
$data -> answerInsert($answer);
unset($_SESSION['answer']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>回答完了</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "compleate">
    <h1>回答しました</h1>
  </div>
  <div class = "top">
    <a href = "index.php">トップへ</a>
  </div>
</body>
</html>
