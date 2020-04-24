<?php

namespace Src\DAO;

use Src\DAO\Connection;
use Src\Models\User;

class SessionDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create($email, $password)
    {
        $password = sha1($password);

        $query = "SELECT * FROM users where email = '$email' and password_user = '$password'";

        $user = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        return $user;
    }
}
