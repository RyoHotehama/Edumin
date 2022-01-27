<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$quiz = new EduminController();
if (isset($_SESSION['login'])) {
    $role = $_SESSION['login']['role'];
}
$quiz -> quizDelete();
$params = $quiz-> quiz();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
  <title>クイズ一覧</title>
  <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
  <link rel = "stylesheet" type = "text/css" href = "/css/quiz.css">
  <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script language = "javascript" type = "text/javascript">
    function OnButtonClick() {
      if(confirm('削除しますか？')){
      } else {
        return false;
      }
   }
  </script>
</head>
<body>
  <?php include('header.php'); ?>
  <?php if (isset($role)) : ?>
        <?php if ($role == 0) : ?>
  <div class = "wrap">
    <div class = "quiz_wrap">
      <button onclick = "location.href ='quiz_product.php'">クイズを作成する</button>
    </div>
            <?php foreach ($params['quiz'] as $row) : ?>
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
                <?php endforeach;?>
          </div>
          <div class = "quiz_box">
            <dt>
              <button type = "submit" name = "button" value = "回答する">回答する</button>
            </dt>
          </div>
        </dl>
      </div>
    </form>
            <?php endforeach; ?>
    <div class = "paging">
            <?php
            for ($i = 0; $i <= $params['pages']; $i++) {
                if (isset($_GET['page']) && $_GET['page'] == $i) {
                    echo $i + 1;
                } else {
                    echo "<a href = '?page=" .$i."'>".($i + 1). "</a>";
                }
            }?>
    </div>
  </div>
        <?php elseif ($role == 1) : ?>
  <div class = "wrap">
            <?php foreach ($params['quiz'] as $row) : ?>
      <form action = "" method = "get">
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
                <?php endforeach; ?>
            </div>
            <div class = "quiz_box">
              <dt>
                <input type = "hidden" name = "id" value = "<?= $row['id']; ?>">
                <button type = "submit" onclick= "OnButtonClick();">削除する</button>
              </dt>
            </div>
          </dl>
        </div>
      </form>
            <?php endforeach; ?>
      <div class = "paging">
            <?php
            for ($i = 0; $i <= $params['pages']; $i++) {
                if (isset($_GET['page']) && $_GET['page'] == $i) {
                    echo $i + 1;
                } else {
                    echo "<a href = '?page=" .$i."'>".($i + 1). "</a>";
                }
            }?>
      </div>
    </div>
        <?php endif; ?>
  <?php else : ?>
  <div class = "compleate">
    <h1>ログインすれば見ることができます</h1>
  </div>
  <div class = "index">
    <a href = "login.php">ログイン画面へ</a>
  </div>
  <?php endif; ?>
</body>
</html>
