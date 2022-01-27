<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$submission = new EduminController();
if (isset($_SESSION['login'])) {
      $role = $_SESSION['login']['role'];
      $id = $_SESSION['login']['id'];
}
$submission_id = $_GET['id'];
$data = $submission -> findSubmission($submission_id);
$answer = $submission -> findAnswer($submission_id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>質問詳細</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/submission.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "question_wrap">
    <div class = "question">
      <dl>
        <dt>
          ニックネーム:
          <?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'); ?>
        </dt>
        <dt>
          タイトル:
          <?= htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8'); ?>
        </dt>
      </dl>
    </div>
  </div>
  <div class = "body_wrap">
    <dl>
      <dd>
        <?= nl2br(htmlspecialchars($data['body'], ENT_QUOTES, 'UTF-8')); ?>
      </dd>
    </dl>
  </div>
  <div class = "answer_title">
    <h1>回答一覧</h1>
  </div>
  <?php foreach ($answer as $row) : ?>
  <div class = "answer_wrap">
    <dl>
      <dt>
        ニックネーム:
        <?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>
      </dt>
      <dd>
        <?= nl2br(htmlspecialchars($row['body'], ENT_QUOTES, 'UTF-8')); ?>
      </dd>
    </dl>
  </div>
  <?php endforeach; ?>
  <?php if (isset($role)) : ?>
        <?php if ($role == 0) : ?>
  <div class = "answer">
    <button onclick = "location.href ='submission_answer.php?id=<?= $submission_id; ?>'">回答する</button>
  </div>
        <?php else :?>
  <div class = "answer">
    <button onclick = "location.href ='index.php'">トップへ</button>
  </div>
        <?php endif; ?>
  <?php else :?>
  <div class = "answer">
    <button onclick = "location.href ='index.php'">トップへ</button>
  </div>
  <?php endif; ?>
</body>
</html>
