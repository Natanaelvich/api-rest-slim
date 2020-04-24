<?php

namespace Src\DAO;

use Src\DAO\Connection;
use Src\Models\Token;
use Src\Models\User;

class TokenDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create(Token $token)
    {
        $stmt =  $this->pdo->prepare('INSERT INTO tokens 
    (token, refresh_token, user_id, expired_at)
    VALUES (:token, :refresh_token, :user_id, :expired_at)');
        $stmt->execute([
            'token' => $token->getToken(),
            'refresh_token' => $token->getRefresh_token(),
            'user_id' => $token->getUser_id(),
            'expired_at' => $token->getExpired_at()
        ]);

        return $token;
    }
}
