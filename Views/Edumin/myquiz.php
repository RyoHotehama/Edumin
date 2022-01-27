<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$id = $_SESSION['login']['id'];
$quiz = new EduminController();
$params = $quiz-> myquizFindId($id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
    <title>あなたのクイズ</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/my_page.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/quiz.css">
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "main_wrap">
    <div class = "title">
      <h1>あなたのQuiz</h1>
    </div>
    <?php foreach ($params as $row) : ?>
    <form action = "quiz_explanation.php?id=<?= $row['id']; ?>" method = "post">
      <div class = "name_wrap">
        <dl>
          <dd>
              <?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>
          </dd>
        </dl>
      </div>
      <div class = "question_wrap">
        <dl>
          <dd>
              <?= htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8'); ?>
          </dd>
        </dl>
      </div>
      <div class = "choice_wrap">
        <dl>
          <div class = "choice_box">
            <?php
              $question = array($row['choice1'], $row['choice2'], $row['choice3'], $row['choice4']);
              shuffle($question);
            foreach ($question as $value) :?>
            <dt>
              <input type = "radio" name = "choice" value = "<?= $value ?>">
                <?= $value; ?>
            </dt>
            <?php endforeach ;?>
          </div>
          <div class = "quiz_box">
            <dt>
              <button type = "submit" name = "button" value = "回答する">回答する</button>
            </dt>
          </div>
        </dl>
      </div>
    </form>
    <?php endforeach ; ?>
  </div>
</body>
</html>
