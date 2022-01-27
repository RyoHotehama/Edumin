<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Users extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function register($data)
    {
        $sql = 'INSERT INTO users (name, email, password)';
        $sql .= ' VALUES (:name, :email, :password)';
        $sth = $this -> dbh -> prepare($sql);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sth -> bindParam(':name', $data['name'], PDO::PARAM_STR);
        $sth -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $sth -> bindParam(':password', $password, PDO::PARAM_STR);
        $sth -> execute();
        return $sth;
    }

    public function login($email, $password)
    {
        $sql = 'SELECT * FROM users';
        $sql .= ' WHERE email = :email';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindparam(':email', $email, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        if (isset($result['password'])) {
            if (password_verify($password, $result['password'])) {
                return $result;
            }
        }
    }

    public function userCheck($name, $email)
    {
        $sql = 'SELECT * FROM users';
        $sql .= ' WHERE name = :name AND email = :email';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindparam(':name', $name, PDO::PARAM_STR);
        $sth -> bindparam(':email', $email, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function passChange($data)
    {
        $sql = 'UPDATE users SET password = :password';
        $sql .= ' WHERE name = :name AND email = :email';
        $sth = $this -> dbh -> prepare($sql);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sth -> bindparam(':password', $password, PDO::PARAM_STR);
        $sth -> bindparam(':name', $data['name'], PDO::PARAM_STR);
        $sth -> bindparam(':email', $data['email'], PDO::PARAM_STR);
        $sth -> execute();
        return $sth;
    }

    public function profile($id)
    {
        $sql = 'SELECT * FROM users';
        $sql .= ' WHERE id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindparam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $data)
    {
        $sql = 'UPDATE users';
        $sql .= ' SET name = :name, email = :email';
        $sql .= ' WHERE id = :id';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindparam(':name', $data['name'], PDO::PARAM_STR);
        $sth -> bindparam(':email', $data['email'], PDO::PARAM_STR);
        $sth -> bindparam(':id', $id, PDO::PARAM_INT);
        $sth -> execute();
        return $sth;
    }

    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM users';
        $sql .= ' WHERE email = :email';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> bindparam(':email', $email, PDO::PARAM_STR);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findByPassword($password)
    {
        $sql = 'SELECT * FROM users';
        $sth = $this -> dbh -> prepare($sql);
        $sth -> execute();
        $result = $sth -> fetchAll(PDO::FETCH_ASSOC);
        if (isset($password)) {
            foreach ($result as $value) {
                if (password_verify($password, $value['password'])) {
                    return $result;
                }
            }
        }
    }
}
