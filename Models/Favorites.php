<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Favorites extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function checkFavorite($user_id, $submission_id)
    {
        $sql = 'SELECT * FROM favorites';
        $sql .= ' WHERE user_id = :user_id AND submission_id = :submission_id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteFavorite($user_id, $submission_id)
    {
        $sql = 'DELETE FROM favorites';
        $sql .= ' WHERE user_id = :user_id AND submission_id = :submission_id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth;
    }

    public function insertFavorite($user_id, $submission_id)
    {
        $sql = 'INSERT INTO favorites';
        $sql .= ' (user_id, submission_id)';
        $sql .= ' VALUES (:user_id, :submission_id)';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $sth -> execute();
    }

    public function findAll($page, $user_id)
    {
        $sql = 'SELECT s.id, s.title, s.school, s.subject, s.created_at FROM submissions s';
        $sql .= ' INNER JOIN favorites f ON s.id = f.submission_id';
        $sql .= ' WHERE s.del_flg = 0 AND f.user_id = :user_id';
        $sql .= ' ORDER BY created_at DESC';
        $sql .= ' LIMIT 10 OFFSET '.(10 * $page);
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countAll($user_id)
    {
        $sql = 'SELECT count(*) as count FROM submissions s';
        $sql .= ' INNER JOIN favorites f ON s.id = f.submission_id';
        $sql .= ' WHERE s.del_flg = 0 AND f.user_id = :user_id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> execute();
        $count = $sth -> fetchColumn();
        return $count;
    }

    public function search($user_id, $school, $subject)
    {
        $sql = 'SELECT s.id, s.title, s.school, s.subject, s.created_at FROM submissions s';
        $sql .= ' INNER JOIN favorites f ON s.id = f.submission_id';
        $sql .= ' WHERE s.user_id = :user_id AND s.school = :school AND s.subject = :subject AND s.del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':school', $school, PDO::PARAM_STR);
        $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchBySchool($user_id, $school)
    {
        $sql = 'SELECT s.id, s.title, s.school, s.subject, s.created_at FROM submissions s';
        $sql .= ' INNER JOIN favorites f ON s.id = f.submission_id';
        $sql .= ' WHERE s.user_id = :user_id AND s.school = :school AND s.del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':school', $school, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchBySubject($user_id, $subject)
    {
        $sql = 'SELECT s.id, s.title, s.school, s.subject, s.created_at FROM submissions s';
        $sql .= ' INNER JOIN favorites f ON s.id = f.submission_id';
        $sql .= ' WHERE s.user_id = :user_id AND s.subject = :subject AND s.del_flg = 0';
        $sql .= ' ORDER BY created_at DESC';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth -> bindParam(':subject', $subject, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
