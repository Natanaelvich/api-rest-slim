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

    ##find all users
    public function findAll()
    {
        $query = 'SELECT * FROM users';
        $users = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    ##find user for id
    public function findById($id)
    {
        $query = "SELECT * FROM users where id = '$id'";
        $user = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $user;
    }

    ##find user for email
    public function findByEmail($email)
    {
        $query = "SELECT * FROM users where email = '$email'";
        $user = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $user;
    }

    ##create new user
    public function create(User $user)
    {

        $prepare = "INSERT INTO users (name_user, password_user, email) VALUES (:name_user, :password_user, :email);";

        $stmt = $this->pdo->prepare($prepare);

        ##hash password
        $user->setPassword_user(sha1($user->getPassword_user()));

        $stmt->execute([
            'name_user' => $user->getName_user(),
            'password_user' => $user->getPassword_user(),
            'email' => $user->getEmail()
        ]);

        return $user;
    }

    ##update new user
    public function update(User $user, $id)
    {

        $prepare = "UPDATE users set name_user = :name_user, password_user = :password_user , email = :email  WHERE id = :id";

        $stmt = $this->pdo->prepare($prepare);

        ##hash password
        $user->setPassword_user(sha1($user->getPassword_user()));

        $stmt->execute([
            "id" => $id,
            'name_user' => $user->getName_user(),
            'password_user' => $user->getPassword_user(),
            'email' => $user->getEmail()
        ]);

        return $user;
    }
}
