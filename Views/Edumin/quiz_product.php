<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$quiz = new EduminController();
$id = $_SESSION['login']['id'];
$validation = $quiz -> quizValidation();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>クイズ作成</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/quiz.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "product_wrap">
    <form action = "" method = "post">
      <input type = "hidden" name = "user_id" value = "<?= $id ?>">
      <div class = "question_wrap">
        <dl>
          <dt>
            <label for = "question">問題</label>
          </dt>
          <dt>
            <span>
              <?php
                if (!empty($validation['question'])) {
                      echo $validation['question'];
                }?>
            </span>
          </dt>
          <dd>
            <textarea name = "question"><?php if (!empty($_POST['question'])) echo nl2br(htmlspecialchars($_POST['question'], ENT_QUOTES, 'UTF-8'));?></textarea>
          </dd>
        </dl>
      </div>
      <div class = "choice_wrap">
        <dl>
          <dt>
            <label for = "choice">選択肢</label>
          </dt>
          <dt>
            <span>
              <?php
                if (!empty($validation['choice'])) {
                      echo $validation['choice'];
                }?>
            </span>
          </dt>
          <dt>
            <span>
              <?php
                if (!empty($validation['answer'])) {
                      echo $validation['answer'];
                }?>
            </span>
          </dt>
          <div class = "choice_box">
            <dd>
              <p>①</p>
              <input type = "text" name = "choice1" value =
              "<?php
                if (!empty($_POST['choice1'])) {
                    echo htmlspecialchars($_POST['choice1'], ENT_QUOTES, 'UTF-8');
                }?>">
            </dd>
            <dd>
              <p>②</p>
              <input type = "text" name = "choice2" value =
              "<?php
                if (!empty($_POST['choice2'])) {
                    echo htmlspecialchars($_POST['choice2'], ENT_QUOTES, 'UTF-8');
                }?>">
            </dd>
            <dd>
              <p>③</p>
              <input type = "text" name = "choice3" value =
              "<?php
                if (!empty($_POST['choice3'])) {
                    echo htmlspecialchars($_POST['choice3'], ENT_QUOTES, 'UTF-8');
                }?>">
            </dd>
            <dd>
              <p>④</p>
              <input type = "text" name = "choice4" value =
              "<?php
                if (!empty($_POST['choice4'])) {
                    echo htmlspecialchars($_POST['choice4'], ENT_QUOTES, 'UTF-8');
                }?>">
            </dd>
            <dd>
              <p>解答</p>
              <input type = "text" name = "answer" value =
              "<?php
                if (!empty($_POST['answer'])) {
                    echo htmlspecialchars($_POST['answer'], ENT_QUOTES, 'UTF-8');
                }?>">
            </dd>
          </div>
        </dl>
      </div>
      <div class = "explanations_wrap">
        <dl>
          <dt>
            <label for = "explanation">解説</label>
          </dt>
          <dd>
            <textarea name = "explanation"><?php if (!empty($_POST['explanation'])) echo nl2br(htmlspecialchars($_POST['explanation'], ENT_QUOTES, 'UTF-8'));?></textarea>
          </dd>
        </dl>
      </div>
      <div class = "select">
        <button type = "submit" name = "button" value = "作成する">作成する</button>
      </div>
    </form>
  </div>
</body>
</html>
