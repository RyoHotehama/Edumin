<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$profile = new EduminController();
if (isset($_SESSION['login'])) {
    $role = $_SESSION['login']['role'];
    $id = $_SESSION['login']['id'];
    $validate = $profile -> profileUpdate($id);
    $data = $profile -> profile($id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>プロフィール</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/profile.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <?php include('header.php'); ?>
  <?php if (isset($role)) :?>
  <div class = "home_wrapper">
    <div class = "profile_wrap">
      <div class = "title">
        <h2>プロフィール</h2>
          <?php if (!empty($validate['compleate'])) :?>
          <p><?= $validate['compleate']; ?></p>
          <?php endif;?>
      </div>
      <dl>
        <form action = "" method = "post">
          <div class = "profile_box">
            <dt>
              <label for = "name">ニックネーム</label>
              <?php if (!empty($validate['name'])) :?>
                <p><?= $validate['name']; ?></p>
              <?php endif;?>
            </dt>
            <dd>
              <input type = "text" name = "name" value ="
<?php if (!empty($_POST['name'])) :?>
<?= htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>
<?php else :?>
<?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');?>
<?php endif;?>">
            </dd>
          </div>
          <div class = "profile_box">
            <dt>
              <label for = "email">メールアドレス</label>
              <?php if (!empty($validate['email'])) :?>
                <p><?= $validate['email']; ?></p>
              <?php endif;?>
            </dt>
            <dd>
              <input type = "text" name = "email" value =
              "<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');?>">
            </dd>
          </div>
          <dd class = "save_wrap">
            <button type = "submit" name = "button" value = "保存する">保存する</button>
          </dd>
        </form>
      </dl>
    </div>
  </div>
  <div class = "choice_wrap">
    <div class = "choice">
      <button onclick = "location.href ='myquestion.php'">あなたの質問</button>
    </div>
    <div class = "choice">
      <button onclick = "location.href ='myquiz.php'">あなたのQuiz</button>
    </div>
    <div class = "choice">
      <button onclick = "location.href ='favorite.php'">お気に入り</button>
    </div>
  </div>
  <?php else : ?>
<div class = "compleate">
  <h1>ログインすれば見ることができます</h1>
</div>
<div class = "top">
  <a href = "login.php">ログイン画面へ</a>
</div>
  <?php endif;?>
</body>
</html>
