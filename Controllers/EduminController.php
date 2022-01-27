<?php
require_once(ROOT_PATH .'/Models/Users.php');
require_once(ROOT_PATH .'/Models/Submissions.php');
require_once(ROOT_PATH .'/Models/Quiz.php');
require_once(ROOT_PATH .'/Models/Favorites.php');

class EduminController
{
    private $request; //リクエストパラメータ(GET,POST)
    private $Users; //Usersモデル
    private $Submissions; //Submissionsモデル
    private $Quiz; //Quizモデル
    private $Favorites; //Favoritesモデル

    public function __construct()
    {
        //リクエストパラメータの取得
        $this -> request['get'] = $_GET;
        $this -> request['post'] = $_POST;

        //モデルオブジェクトの生成
        $this -> Users = new Users();
        $this -> Submissions = new Submissions();
        $this -> Quiz = new Quiz();
        $this -> Favorites = new Favorites();
    }

    public function index()
    {
        $page = 0;
        if (isset($this -> request['get']['page'])) {
            $page = $this -> request['get']['page'];
        }

        if (!empty($this -> request['post'])) {
            if (strpos($this -> request['post']['school'], 'all') !== false && strpos($this -> request['post']['subject'], 'all') === false) {
                $submission = $this -> Submissions -> searchBySubject($this -> request['post']['subject']);
                $params = [
                  'submission' => $submission,
                  'pages' => $submissions_count / 10
                ];
                return $params;
                exit();
            } elseif (strpos($this -> request['post']['subject'], 'all') !== false && strpos($this -> request['post']['school'], 'all') === false) {
                $submission = $this -> Submissions -> searchBySchool($this -> request['post']['school']);
                $params = [
                  'submission' => $submission,
                ];
                return $params;
                exit();
            } elseif (strpos($this -> request['post']['school'], 'all') !== false && strpos($this -> request['post']['subject'], 'all') !== false) {
                $submission = $this -> Submissions -> findAll($page);
                $submissions_count = $this -> Submissions -> countAll();
                $params = [
                  'submission' => $submission,
                  'pages' => $submissions_count / 10
                ];
                return $params;
                exit();
            } else {
                $submission = $this -> Submissions -> search($this -> request['post']['school'], $this -> request['post']['subject']);
                $params = [
                  'submission' => $submission,
                ];
                return $params;
                exit();
            }
        } else {
            $submission = $this -> Submissions -> findAll($page);
            $submissions_count = $this -> Submissions -> countAll();
            $params = [
              'submission' => $submission,
              'pages' => $submissions_count / 10
            ];
            return $params;
        }
    }

    public function signUp($data)
    {
        $this -> Users -> register($data);
    }

// 会員登録チェック
    public function loginValidation()
    {
        session_start();
        if (!empty($this -> request['post'])) {
            $email = $this -> Users -> findByEmail($this -> request['post']['email']);
            $password = $this -> Users -> findByPassword($this -> request['post']['password']);
            $error_message = [];
            if (empty($this -> request['post']['name'])) {
                $error_message['name'] = "ニックネームを入力してください";
            }

            if (!preg_match("/\A([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9])+([a-zA-Z0-9._-])+([a-zA-Z0-9])+\z/", $this -> request['post']['email'])) {
                $error_message['email'] = "メールアドレスは正しくご入力ください";
            } elseif (!empty($email)) {
                $error_message['email'] = "そのメールアドレスは既に使われています";
            }


            if (empty($this -> request['post']['password'])) {
                $error_message['password'] = "パスワード欄が空欄です";
            } elseif (mb_strlen($this -> request['post']['password']) < 6 || empty($this -> request['post']["password"])) {
                $error_message['password'] = "パスワードは6文字以上で入力してください";
            } elseif (!empty($password)) {
                $error_message['password'] = "そのパスワードは既に使われています";
            } elseif ($this -> request['post']['password'] != $this -> request['post']['password_conf']) {
                $error_message['password_conf'] = "パスワードが一致しません";
            }

            if (empty($error_message)) {
                $_SESSION['register'] = $this -> request['post'];
                header('location: register_comp.php');
            }
            return $error_message;
        }
    }

// ログインチェック
    public function login()
    {
        session_start();
        $error_message = [];
        if (!empty($this -> request['post'])) {
            $result = $this -> Users -> login($this -> request['post']['email'], $this -> request['post']['password']);
            if (empty($result)) {
                $error_message = "メールアドレスかパスワードが間違っています";
                return $error_message;
            } else {
                $_SESSION['login'] = $result;
                header('location: index.php');
            }
        }
    }

// パスワード変更チェック
    public function userCheck()
    {
        session_start();
        $error_message = [];
        if (!empty($this -> request['post'])) {
            $result = $this -> Users -> userCheck($this -> request['post']['name'], $this -> request['post']['email']);
            $password = $this -> Users -> findByPassword($this -> request['post']["password"]);
            if (empty($result)) {
                $error_message[] = "ニックネームまたはメールアドレスが存在しません";
            }

            if (empty($this -> request['post']['password'])) {
                $error_message[] = "パスワード欄が空欄です";
            } elseif ($this -> request['post']['password'] != $this -> request['post']['password_conf']) {
                $error_message[] = "パスワードが一致しません";
            } elseif (!empty($password)) {
                $error_message[] = "既に使われているパスワードです";
            } elseif (mb_strlen($this -> request['post']['password']) < 6 || empty($this -> request['post']["password"])) {
                $error_message[] = "パスワードは6文字以上で入力してください";
            }

            if (empty($error_message)) {
                $_SESSION['password'] = $this -> request['post'];
                header('location: pass_change_comp.php');
            }
            return $error_message;
        }
    }

    public function passChange($data)
    {
        $this -> Users -> passChange($data);
    }

    public function profile($id)
    {
        $logout = $this -> Users -> profile($id);
        return $logout;
    }

    public function submissionValidation()
    {
        $error_message = [];
        if (!empty($this -> request['post'])) {
            if (empty($this -> request['post']['title'])) {
                $error_message['title'] = "タイトルがありません";
            }
            if (empty($this -> request['post']['body'])) {
                $error_message['body'] = "投稿内容がありません";
            }
            if (empty($error_message)) {
                $_SESSION['submission'] = $this -> request['post'];
                header('location: submission_comp.php');
            }
            return $error_message;
        }
    }

    public function submission($data)
    {
        $this -> Submissions -> insert($data);
    }

    public function answerValidation()
    {
        if (!empty($this -> request['post'])) {
            if (mb_strlen($this -> request['post']['body']) < 3 || empty($this -> request['post']["body"])) {
                $error_message = "3文字以上で入力してください";
            }
            if (empty($error_message)) {
                $_SESSION['answer'] = $this -> request['post'];
                header('location: submission_answer_comp.php');
            }
            return $error_message;
        }
    }

    public function answerInsert($data)
    {
        $this -> Submissions -> answerInsert($data);
    }

    public function findSubmission($id)
    {
        $result = $this -> Submissions -> findSubmission($id);
        return $result;
    }

    public function findAnswer($id)
    {
        $result = $this -> Submissions -> findAnswer($id);
        return $result;
    }

    public function quizValidation()
    {
        $error_message = [];
        if (!empty($this -> request['post'])) {
            if (empty($this -> request['post']['question'])) {
                $error_message['question'] = "問題を入力してください";
            }
            if (empty($this -> request['post']['choice1'])||
                empty($this -> request['post']['choice2'])||
                empty($this -> request['post']['choice3'])||
                empty($this -> request['post']['choice4'])) {
                $error_message['choice'] = "選択肢が不足しています";
            }

            if ($this -> request['post']['choice1'] != $this -> request['post']['answer']&&
                $this -> request['post']['choice2'] != $this -> request['post']['answer']&&
                $this -> request['post']['choice3'] != $this -> request['post']['answer']&&
                $this -> request['post']['choice4'] != $this -> request['post']['answer']) {
                $error_message['answer'] = "選択肢と解答が一致しません";
            }

            if (empty($error_message)) {
                $_SESSION['quiz'] = $this -> request['post'];
                header('location: quiz_comp.php');
            }
            return $error_message;
        }
    }
    public function quizInsert($data)
    {
        $this -> Quiz -> quizInsert($data);
    }

    public function quiz()
    {
        $page = 0;
        if (isset($this -> request['get']['page'])) {
            $page = $this -> request['get']['page'];
        }

        $quiz = $this -> Quiz -> findAll($page);
        $quiz_count = $this -> Quiz -> countAll();
        $params = [
          'quiz' => $quiz,
          'pages' => $quiz_count / 10
        ];
        return $params;
    }

    public function quizFind($id)
    {
        $result = $this -> Quiz -> quizFind($id);
        return $result;
    }

//プロフィールチェック
    public function profileUpdate($id)
    {
        if (!empty($this -> request['post'])) {
            $email = $this -> Users -> findByEmail($this -> request['post']['email']);
            if (empty($this -> request['post']['name'])) {
                $error_message['name'] = "ニックネームが空欄です";
            }

            if (!preg_match("/\A([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9])+([a-zA-Z0-9._-])+([a-zA-Z0-9])+\z/", $this -> request['post']['email'])) {
                $error_message['email'] = "メールアドレスが正しくありません";
            } elseif (!empty($email) && $this -> request['post']['name'] == $email['name']) {
                $error_message['email'] = "そのメールアドレスは既に使われています";
            }

            if (empty($error_message)) {
                $this -> Users -> update($id, $this -> request['post']);
                $message['compleate'] = "更新しました";
                return $message;
                exit;
            }
            return $error_message;
        }
    }

    public function myquizFindId($id)
    {
        $result = $this -> Quiz -> quizFindId($id);
        return $result;
    }

    public function questionTitle($id)
    {
        $result = $this -> Submissions -> findSubmissionMyId($id);
        return $result;
    }

    // 削除
    public function delete()
    {
        if (isset($this -> request['get']['id'])) {
            $this -> Submissions -> delete($this -> request['get']['id']);
        }
    }

    public function quizDelete()
    {
        if (isset($this -> request['get']['id'])) {
            $this -> Quiz -> quizDelete($this -> request['get']['id']);
        }
    }

    public function checkFavorite($user_id, $submission_id)
    {
        $result = $this -> Favorites -> checkFavorite($user_id, $submission_id);
        return $result;
    }

    public function favorite($user_id)
    {
        $page = 0;
        if (isset($this -> request['get']['page'])) {
            $page = $this -> request['get']['page'];
        }

        if (!empty($this -> request['post'])) {
            if (strpos($this -> request['post']['school'], 'all') !== false && strpos($this -> request['post']['subject'], 'all') === false) {
                $favorite = $this -> Favorites -> searchBySubject($user_id, $this -> request['post']['subject']);
                $params = [
                  'favorite' => $favorite,
                ];
                return $params;
                exit();
            } elseif (strpos($this -> request['post']['subject'], 'all') !== false && strpos($this -> request['post']['school'], 'all') === false) {
                $favorite = $this -> Favorites -> searchBySchool($user_id, $this -> request['post']['school']);
                $params = [
                  'favorite' => $favorite,
                ];
                return $params;
                exit();
            } elseif (strpos($this -> request['post']['school'], 'all') !== false && strpos($this -> request['post']['subject'], 'all') !== false) {
                $favorite = $this -> Favorites -> findAll($page, $user_id);
                $favorite_count = $this -> Favorites -> countAll($user_id);
                $params = [
                  'favorite' => $favorite,
                  'pages' => $favorite_count / 10
                ];
                return $params;
                exit();
            } else {
                $favorite = $this -> Favorites -> search($user_id, $this -> request['post']['school'], $this -> request['post']['subject']);
                $params = [
                  'favorite' => $favorite
                ];
                return $params;
                exit();
            }
        } else {
            $favorite = $this -> Favorites -> findAll($page, $user_id);
            $favorite_count = $this -> Favorites -> countAll($user_id);
            $params = [
              'favorite' => $favorite,
              'pages' => $favorite_count / 10
            ];
            return $params;
        }
    }
}
