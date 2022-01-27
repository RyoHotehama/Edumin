<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$pass_change = new EduminController();
$validation = $pass_change -> userCheck();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>パスワード変更</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/user.css">
</head>
<body>
  <div class = "logo">
    <a href = "index.php">
      <img class = "logo_img" src = "/img/logo.png">
    </a>
  </div>
  <div class = "title">
    <h2>パスワード変更</h2>
  </div>
  <div class = "home_wrapper">
    <form action = "pass_change.php" method = "post">
      <dl>
        <dt>
          <span>
            <?php
            if (!empty($validation)) {
                foreach ($validation as $value) {
                    echo $value ."<br>";
                }
            }?>
          <span>
        </dt>
        <dt>
          <label for = "name">ニックネーム</label>
        </dt>
        <dd>
          <input type = "text" name = "name" value =
          "<?php
            if (!empty($_POST['name'])) {
                echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            }?>">
        </dd>
        <dt>
          <label for = "email">メールアドレス</label>
        </dt>
        <dd>
          <input type = "text" name = "email" value =
          "<?php
            if (!empty($_POST['email'])) {
                echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            }?>">
        </dd>
        <dt>
          <label for = "password">変更後パスワード</label>
        </dt>
        <dd>
          <input type = "password" name = "password" value = "">
        </dd>
        <dt>
          <label for = "password_conf">パスワード確認用</label>
        </dt>
        <dd>
          <input type = "password" name = "password_conf" value = "">
        </dd>
        <dd class = "check">
          <button type = "submit" name = "button" value = "パスワード変更">パスワード変更</button>
        </dd>
      </dl>
    </form>
  </div>
  <div class = "login">
    <a href = "login.php">ログインはこちら</a>
  </div>
</body>
</html>
