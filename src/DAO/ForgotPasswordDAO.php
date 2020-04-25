<?php

namespace Src\DAO;

use Src\DAO\Connection;

class ForgotPasswordDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    ##update new user
    public function update(String $password, int $id)
    {

        $prepare = "UPDATE users set password_user = :password_user WHERE id = :id";

        $stmt = $this->pdo->prepare($prepare);

        ##hash password
        $password = sha1($password);

        $res = $stmt->execute([
            "id" => $id,
            'password_user' => $password,
        ]);

        return $res;
    }
}
