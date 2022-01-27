<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');

if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$login = new EduminController();
$validation = $login -> login();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>ログイン</title>
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
    <h2>ログイン</h2>
  </div>
  <div class = "home_wrapper">
    <form action = "login.php" method = "post">
      <dl>
        <dt>
          <span>
            <?php
            if (!empty($validation)) {
                  echo $validation;
            }?>
          <span>
        </dt>
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
          <label for = "password">パスワード</label>
        </dt>
        <dd>
          <input type = "password" name = "password" value = "">
        </dd>
        <dd class = "check">
          <button type = "submit" name = "button" value = "ログイン">ログイン</button>
        </dd>
      </dl>
    </form>
    <div class = "transition">
      <a href = "pass_change.php">パスワードを忘れた方はこちら</a>
    </div>
  </div>
  <div class = "login">
    <a href = "register.php">会員登録はこちら</a>
  </div>
</body>
</html>
