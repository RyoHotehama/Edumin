<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$logout = new EduminController();
$id = $_SESSION['login']['id'];
$data = $logout -> profile($id);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>ログアウト</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/profile.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "home_wrapper">
    <div class = "profile_wrap">
      <div class = "title">
        <h2>プロフィール</h2>
      </div>
      <dl>
        <div class = "box">
          <dt>
            <label for = "name">ニックネーム</label>
          </dt>
          <dd>
            <?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');?>
          </dd>
        </div>
        <div class = "box">
          <dt>
            <label for = "email">メールアドレス</label>
          </dt>
          <dd>
            <?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');?>
          </dd>
        </div>
      </dl>
    </div>
  </div>
  <div class = "logout">
    <button onclick = "location.href ='logout_comp.php'">ログアウト</button>
  </div>
</body>
</html>
