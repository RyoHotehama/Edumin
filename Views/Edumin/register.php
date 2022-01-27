<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$register = new EduminController();
$validation = $register -> loginValidation();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>会員登録</title>
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
    <h2>会員登録</h2>
  </div>
  <div class = "home_wrapper">
    <form action = "register.php" method = "post">
      <dl>
        <dt>
          <label for = "name">ニックネーム</label>
        </dt>
        <dt>
          <span>
            <?php
            if (!empty($validation['name'])) {
                echo $validation['name'];
            }?>
          </span>
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
        <dt>
          <span>
            <?php
            if (!empty($validation['email'])) {
                echo $validation['email'];
            }?>
          </span>
        </dt>
        <dd>
          <input type = "text" name = "email" value =
          "<?php
            if (!empty($_POST['email'])) {
                echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            }?>">
        </dd>
        <dt>
          <label for = "password">パスワード</label>
        </dt>
        <dt>
          <span>
            <?php
            if (!empty($validation['password'])) {
                echo $validation['password'];
            }?>
          </span>
        </dt>
        <dd>
          <input type = "password" name = "password" value = "" placeholder= "6文字以上で入力してください">
        </dd>
        <dt>
          <label for = "password_conf">パスワード確認用</label>
        </dt>
        <dt>
          <span>
            <?php
            if (!empty($validation['password_conf'])) {
                echo $validation['password_conf'];
            }?>
          </span>
        </dt>
        <dd>
          <input type = "password" name = "password_conf" value = "">
        </dd>
        <dd class = "check">
          <button type = "submit" name = "button" value = "会員登録">会員登録</button>
        </dd>
      </dl>
    </form>
  </div>
  <div class = "login">
    <a href = "login.php">ログインはこちら</a>
  </div>
</body>
</html>
