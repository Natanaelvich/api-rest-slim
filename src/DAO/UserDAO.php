<?php

namespace Src\DAO;

use Src\DAO\Connection;

class UserDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        $query = 'SELECT * FROM users';
        $users = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    public function findById($id)
    {
        $query = "SELECT * FROM users where id = '$id'";
        $user = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $user;
    }
}
