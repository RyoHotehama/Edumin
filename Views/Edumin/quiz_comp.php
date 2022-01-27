<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
session_start();
$data = $_SESSION['quiz'];
$quiz = new EduminController();
$quiz -> quizInsert($data);
unset($_SESSION['quiz']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>クイズ作成完了</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "compleate">
    <h1>作成しました</h1>
  </div>
  <div class = "top">
    <a href = "quiz.php">Quiz画面へ</a>
  </div>
</body>
</html>
