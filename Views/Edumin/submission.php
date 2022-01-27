<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$submission = new EduminController();
if (isset($_SESSION['login'])) {
    $id = $_SESSION['login']['id'];
    $role = $_SESSION['login']['role'];
    $data = $submission -> profile($id);
}
$validation = $submission -> submissionValidation();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>質問投稿</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/submission.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/compleate.css">
</head>
<body>
  <?php include('header.php'); ?>
  <?php if (isset($role)) :?>
  <div class = "wrap">
    <form action = "submission.php" method = "post">
      <dl>
        <div class = "box">
          <dt>
            <label for = "name">ニックネーム</label>
          </dt>
          <dd>
            <?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');?>
            <input type = "hidden" name = "user_id" value = "<?= $id ?>">
          </dd>
        </div>
        <div class = "box">
          <dt>
            <label for = "title">質問タイトル<br>
              <span>
                <?php
                if (!empty($validation['title'])) {
                    echo $validation['title'];
                } ?>
              </span>
            </label>
          </dt>
          <dd>
            <input type = "text" name = "title" value =
            "<?php
            if (!empty($_POST['title'])) {
                echo htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            }?>" placeholder= "タイトルを入力">
          </dd>
        </div>
        <div class = "box">
          <dt>
            <label for = "school">学校</label>
          </dt>
          <dd>
            <select name = "school">
              <option value = "中学">中学</option>
              <option value = "高校">高校</option>
            </select>
          </dd>
        </div>
        <div class = "box">
          <dt>
            <label for = "subject">科目</label>
          </dt>
          <dd>
            <select name = "subject">
              <option value = "国語">国語</option>
              <option value = "社会">社会</option>
              <option value = "数学">数学</option>
              <option value = "理科">理科</option>
              <option value = "英語">英語</option>
              <option value = "その他">その他</option>
            </select>
          </dd>
        </div>
        <dt class = "box3">
          <label for = "body">質問内容</label>
        </dt>
        <dt>
          <span>
            <?php
            if (!empty($validation['body'])) {
                echo $validation['body'];
            } ?>
          </span>
        <dd class = "box2">
          <textarea name = "body"><?php if (!empty($_POST['body'])) echo nl2br(htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8'));?></textarea>
        </dd>
        <dd class = "select">
          <button type = "submit" name = "button" value = "投稿">投稿</button>
        </dd>
      </dl>
    </form>
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
