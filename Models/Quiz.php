<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Quiz extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function quizInsert($data)
    {
        $sql = 'INSERT INTO quiz (user_id, question, choice1, choice2, choice3, choice4, answer, explanation)';
        $sql .= ' VALUES (:user_id, :question, :choice1, :choice2, :choice3, :choice4, :answer, :explanation)';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $sth -> bindParam(':question', $data['question'], PDO::PARAM_STR);
        $sth -> bindParam(':choice1', $data['choice1'], PDO::PARAM_STR);
        $sth -> bindParam(':choice2', $data['choice2'], PDO::PARAM_STR);
        $sth -> bindParam(':choice3', $data['choice3'], PDO::PARAM_STR);
        $sth -> bindParam(':choice4', $data['choice4'], PDO::PARAM_STR);
        $sth -> bindParam(':answer', $data['answer'], PDO::PARAM_STR);
        $sth -> bindParam(':explanation', $data['explanation'], PDO::PARAM_STR);
        $sth -> execute();
        return $sth;
    }

    public function findAll($page)
    {
        $sql = ' SELECT q.id, u.name, q.question, q.choice1, q.choice2, q.choice3, q.choice4 FROM quiz q';
        $sql .= ' INNER JOIN users u ON u.id = q.user_id';
        $sql .= ' WHERE q.del_flg = 0';
        $sql .= ' ORDER BY q.created_at DESC';
        $sql .= ' LIMIT 10 OFFSET '.(10 * $page);
        $sth = $this -> dbh -> prepare($sql);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countAll()
    {
        $sql = 'SELECT count(*) as count FROM quiz';
        $sql .= 'WHERE del_flg = 0';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function quizFind($id)
    {
        $sql = 'SELECT * FROM quiz';
        $sql .= ' WHERE id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function quizFindId($id)
    {
        $sql = 'SELECT q.id, u.name, q.question, q.choice1, q.choice2, q.choice3, q.choice4 FROM quiz q';
        $sql .= ' INNER JOIN users u ON u.id = q.user_id';
        $sql .= ' WHERE q.del_flg = 0 AND q.user_id = :id';
        $sql .= ' ORDER BY q.created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function quizDelete($id)
    {
        $sql = 'UPDATE quiz SET del_flg = 1';
        $sql .= ' WHERE id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth;
    }
}
