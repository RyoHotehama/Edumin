<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$id = $_SESSION['login']['id'];
$question = new EduminController();
$question -> delete();
$params = $question -> questionTitle($id);
?>


<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
  <title>あなたの質問</title>
  <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
  <link rel = "stylesheet" type = "text/css" href = "/css/my_page.css">
  <link rel = "stylesheet" type = "text/css" href = "/css/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/delete.js"></script>
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "main_wrap">
    <div class = "title">
      <h1>あなたの質問</h1>
    </div>
    <div class = "question_list">
      <table border = "1">
        <tr>
          <th>質問</th>
          <th>学校</th>
          <th>科目</th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($params as $value) : ?>
        <tr>
          <td>
            <a href = "submission_detail.php?id=.<?=$value['id']; ?>">
              <?= htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
          </td>
          <td><?= htmlspecialchars($value['school'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= htmlspecialchars($value['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= htmlspecialchars($value['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td>
            <form action = "" method = "get">
              <input type = 'submit' class = 'delete_tag' value = '削除'>
              <input type = 'hidden' name = 'id' value = "<?= $value['id'] ?>">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</body>
</html>
