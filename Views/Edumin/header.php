<?php
if (isset($_SESSION['login']['role'])) {
    $role = $_SESSION['login']['role'];
}?>


<!DOCTYPE html>
<html>
<head>
    <meta  name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>ヘッダー</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/header.css">
</head>
<body>
  <header>
    <?php if (isset($role)) : ?>
        <?php if ($role == 0) : ?>
    <div class = "head">
      <div class = "logo">
        <a href = "index.php">
          <img src = "/img/logo.png">
        </a>
      </div>
      　<ul class = main_select>
          <li>
            <a href = "submission.php">質問投稿</a>
          </li>
          <li>
            <a href = "quiz.php">Quiz</a>
          </li>
          <li>
            <a href = "profile.php">プロフィール</a>
          </li>
          <li>
            <a href = "logout.php">ログアウト</a>
          </li>
          <li>
            <a href = "register.php">新規会員登録</a>
          </li>
        </ul>
    </div>
        <?php elseif ($role == 1) : ?>
        <div class = "head_controller">
          <div class = "logo">
            <a href = "index.php">
              <img src = "/img/logo.png">
            </a>
          </div>
          　<ul class = main_select>
              <li>
                <a href = "quiz.php">Quiz</a>
              </li>
              <li>
                <a href = "logout.php">ログアウト</a>
              </li>
            </ul>
        </div>
        <?php endif; ?>
    <?php else : ?>
    <div class = "head">
      <div class = "logo">
        <a href = "index.php">
          <img src = "/img/logo.png">
        </a>
      </div>
      　<ul class = main_select>
          <li>
            <a href = "submission.php">質問投稿</a>
          </li>
          <li>
            <a href = "quiz.php">Quiz</a>
          </li>
          <li>
            <a href = "profile.php">プロフィール</a>
          </li>
          <li>
            <a href = "login.php">ログイン</a>
          </li>
          <li>
            <a href = "register.php">新規会員登録</a>
          </li>
        </ul>
    </div>
    <?php endif; ?>
  </header>
</body>
</html>
