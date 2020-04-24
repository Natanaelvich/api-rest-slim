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

    public function create($name, $password)
    {
        $query = "SELECT * FROM users where name_user = '$name' and password_user = '$password'";

        $user = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        if (count($user) == 0) {

            return null;
        }


        return $user;
    }
}
