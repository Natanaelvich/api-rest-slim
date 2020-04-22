<?php

namespace Src\DAO;

use Src\DAO\Connection;
use Src\Models\User;

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

    public function create(User $user)
    {
        $prepare = "INSERT INTO users (name_user, password_user) VALUES (:name_user, :password_user);";

        $stmt = $this->pdo->prepare($prepare);

        $stmt->execute([
            'name_user' => $user->getName_user(),
            'password_user' => $user->getPassword_user()
        ]);

        return $user;
    }
}
