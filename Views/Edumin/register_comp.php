<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
session_start();
$register = $_SESSION['register'];
$data = new EduminController();
$data -> signUp($register);
unset($_SESSION['register']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>会員登録完了</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <div class = "compleate">
    <h1>新規会員登録完了しました</h1>
  </div>
  <div class = "top">
    <a href = "login.php">ログイン画面へ</a>
  </div>
</body>
</html>
