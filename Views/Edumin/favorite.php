<?php
session_start();
require_once(ROOT_PATH .'/Controllers/EduminController.php');
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: index.php');
}
$id = $_SESSION['login']['id'];
$favorite = new EduminController();
$data = $favorite -> favorite($id);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content ="width=device-width,initial-scale=1.0,minimum-scale=1.0" charset = "UTF-8">
  <title>お気に入り</title>
  <link rel = "stylesheet" type = "text/css" href = "/css/base.css">
  <link rel = "stylesheet" type = "text/css" href = "/css/my_page.css">
  <link rel = "stylesheet" type = "text/css" href = "/css/index.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/ajax.js"></script>
</head>
<body>
  <?php include('header.php'); ?>
  <div class = "main_wrap">
    <div class = "title">
      <h1>お気に入り</h1>
    </div>
    <div class = "search">
      <form action = "" method = "post">
        <dl class = search_wrap>
          <dt class = "box">
            <label for = "school">学校</label>
          </dt>
          <dd>
            <select name = "school">
              <option value = "all"
              <?php
                if (empty($_POST['school'])) {
                    echo 'selected';
                }?>>全て
              </option>
              <option value = "中学"
              <?php
                if (!empty($_POST['school'])) {
                    if ($_POST['school'] == '中学') {
                        echo 'selected';
                    }
                }?>>中学
              </option>
              <option value = "高校"
              <?php
                if (!empty($_POST['school'])) {
                    if ($_POST['school'] == '高校') {
                        echo 'selected';
                    }
                }?>>高校
              </option>
            </select>
          </dd>
          <dt>
            <label for = "subject">科目</label>
          </dt>
          <dd>
            <select name = "subject">
              <option value = "all"
              <?php
                if (empty($_POST['subject'])) {
                    echo 'selected';
                }?>>全て
              </option>
              <option value = "国語"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == '国語') {
                        echo 'selected';
                    }
                }?>>国語
              </option>
              <option value = "社会"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == '社会') {
                        echo 'selected';
                    }
                }?>>社会
              </option>
              <option value = "数学"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == '数学') {
                        echo 'selected';
                    }
                }?>>数学
              </option>
              <option value = "理科"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == '理科') {
                        echo 'selected';
                    }
                }?>>理科
              </option>
              <option value = "英語"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == '英語') {
                        echo 'selected';
                    }
                }?>>英語
              </option>
              <option value = "その他"
              <?php
                if (!empty($_POST['subject'])) {
                    if ($_POST['subject'] == 'その他') {
                        echo 'selected';
                    }
                }?>>その他
              </option>
            </select>
          </dd>
          <dd class = "choice">
            <button type = "submit" name = "button" value = "検索">検索</button>
          </dd>
        </dl>
      </form>
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
        <?php foreach ($data['favorite'] as $value) : ?>
        <tr>
          <td>
            <a href = "submission_detail.php?id=<?=$value['id']; ?>">
              <?= htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
          </td>
          <td><?= htmlspecialchars($value['school'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= htmlspecialchars($value['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td class = "create"><?= htmlspecialchars($value['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td>
            <section class = "favorite" data-submission = "<?= $value['id']; ?>">
              <div class = "btn-good <?php if (!empty($favorite -> checkFavorite($id, $value['id']))) {
                    echo 'active';
                                     }?>">
                <i class= "fa-thumbs-up
                      <?php if ($favorite -> checkFavorite($id, $value['id'])) {
                            echo ' active fas';
                      } else {
                          echo ' far';
                      }?>">
                </i>
              </div>
            </section>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div class = "paging">
            <?php
            for ($i = 0; $i <= $data['pages']; $i++) {
                if (isset($_GET['page']) && $_GET['page'] == $i) {
                    echo $i + 1;
                } else {
                    echo "<a href = '?page=" .$i."'>".($i + 1). "</a>";
                }
            }?>
    </div>
  </div>
</body>
</html>
