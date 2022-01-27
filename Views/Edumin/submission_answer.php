<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$submission = new EduminController();
$id = $_SESSION['login']['id'];
$submission_id = $_GET['id'];
$params = $submission -> findSubmission($submission_id);
$data = $submission -> profile($id);
$validate = $submission -> answerValidation();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>質問回答</title>
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
      <?= htmlspecialchars($params['name'], ENT_QUOTES, 'UTF-8'); ?>
    </dt>
    <dt>
      タイトル:
      <?= htmlspecialchars($params['title'], ENT_QUOTES, 'UTF-8'); ?>
    </dt>
  </dl>
</div>
</div>
<div class = "body_wrap">
<dl>
  <dd>
    <?= nl2br(htmlspecialchars($params['body'], ENT_QUOTES, 'UTF-8')); ?>
  </dd>
</dl>
</div>
<div class = "answer_title">
   <h1>回答</h1>
 </div>
  <div class = "main_wrap">
    <form action = "" method = "post">
      <div class = "submission_wrap">
        <dl>
          <dt class = "nickname">
            ニックネーム:
            <?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');?>
            <input type = "hidden" name = "user_id" value = "<?= $id ?>">
            <input type = "hidden" name = "submission_id" value = "<?= $submission_id ?>">
          </dt>
          <dt>
            回答欄
          </dt>
          <dt>
            <span>
            <?php
            if (!empty($validate)) {
                echo $validate;
            }?>
            </span>
          </dt>
          <dd>
            <textarea name = "body" placeholder="3文字以上で入力してください。"></textarea>
          </dd>
        </dl>
      </div>
      <div class = "answer">
        <button type = "submit" name = "button" value = "回答">回答</button>
      </div>
    </form>
  </div>
</body>
</html>
