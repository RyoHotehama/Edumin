<?php
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
session_start();
$id = $_GET['id'];
$quiz = new EduminController();
$data = $quiz -> quizFind($id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>クイズ解説</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/quiz.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "wrap">
    <div class = "right_wrapper">
      <?php if (isset($_POST['choice'])) :?>
            <?php if ($data['answer'] == $_POST['choice']) : ?>
      <p>正解</p>
            <?php else : ?>
      <p>不正解</p>
            <?php endif; ?>
      <?php else : ?>
      <p>不正解</p>
      <?php endif; ?>
    </div>
    <div class = "explanation_wrap">
      <dl>
        <dt>
          <label class = "explanation">解説</label>
        </dt>
        <dd>
          <?= nl2br(htmlspecialchars($data['explanation'], ENT_QUOTES, 'UTF-8')); ?>
        </dd>
      </dl>
    </div>
    <div class = "top">
    <a href = "quiz.php">Quiz画面へ</a>
  </div>
  </div>
</body>
</html>
