<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Submissions extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function insert($data)
    {
        $sql = 'INSERT INTO submissions (user_id, title, school, subject, body)';
        $sql .= ' VALUES (:user_id, :title, :school, :subject, :body)';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $sth -> bindParam(':title', $data['title'], PDO::PARAM_STR);
        $sth -> bindParam(':school', $data['school'], PDO::PARAM_STR);
        $sth -> bindParam(':subject', $data['subject'], PDO::PARAM_STR);
        $sth -> bindParam(':body', $data['body'], PDO::PARAM_STR);
        $sth -> execute();
        return $sth;
    }

    public function answerInsert($data)
    {
        $sql = 'INSERT INTO answers (user_id, submission_id, body)';
        $sql .= ' VALUES (:user_id, :submission_id, :body)';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $sth -> bindParam(':submission_id', $data['submission_id'], PDO::PARAM_INT);
        $sth -> bindParam(':body', $data['body'], PDO::PARAM_STR);
        $sth -> execute();
        return $sth;
    }

    public function findSubmission($id)
    {
        $sql = 'SELECT u.name, s.title, s.body FROM submissions s';
        $sql .= ' INNER JOIN users u ON u.id = s.user_id';
        $sql .= ' WHERE s.id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAnswer($id)
    {
        $sql = 'SELECT u.name, a.body FROM answers a';
        $sql .= ' INNER JOIN users u ON u.id = a.user_id';
        $sql .= ' WHERE a.submission_id = :id';
        $sql .= ' ORDER BY a.created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findSubmissionMyId($id)
    {
        $sql = 'SELECT * FROM submissions';
        $sql .= ' WHERE user_id = :id AND del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAll($page)
    {
        $sql = 'SELECT * FROM submissions';
        $sql .= ' WHERE del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sql .= ' LIMIT 10 OFFSET '.(10 * $page);
        $sth = $this -> dbh -> prepare($sql);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countAll()
    {
        $sql = 'SELECT count(*) as count FROM submissions';
        $sql .= 'WHERE del_flg = 0';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function search($school, $subject)
    {
        $sql = 'SELECT * FROM submissions';
        $sql .= ' WHERE school = :school AND subject = :subject AND del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':school', $school, PDO::PARAM_STR);
        $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countSearch($school, $subject)
    {
        $sql = 'SELECT count(*) as count FROM submissions';
        $sql .= ' WHERE school = :school AND subject = :subject AND del_flg = 0';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':school', $school, PDO::PARAM_STR);
        $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function searchBySchool($school)
    {
          $sql = 'SELECT * FROM submissions';
          $sql .= ' WHERE school = :school AND del_flg = 0';
          $sql .= ' ORDER BY created_at DESC';
          $sth = $this -> dbh -> prepare($sql);
          $sth -> bindParam(':school', $school, PDO::PARAM_STR);
          $sth -> execute();
          $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
          return $result;
    }

    public function searchBySubject($subject)
    {
          $sql = 'SELECT * FROM submissions';
          $sql .= ' WHERE subject = :subject AND del_flg = 0';
          $sql .= ' ORDER BY created_at DESC';
          $sth = $this -> dbh -> prepare($sql);
          $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
          $sth -> execute();
          $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
          return $result;
    }

    public function countSearchBySchool($school)
    {
        $sql = 'SELECT count(*) as count FROM submissions';
        $sql .= ' WHERE school = :school AND del_flg = 0';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':school', $school, PDO::PARAM_STR);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function countSearchBySubject($subject)
    {
        $sql = 'SELECT count(*) as count FROM submissions';
        $sql .= ' WHERE school = :subject AND del_flg = 0';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function delete($id)
    {
        $sql = 'UPDATE submissions SET del_flg = 1';
        $sql .= ' WHERE id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth;
    }
}
