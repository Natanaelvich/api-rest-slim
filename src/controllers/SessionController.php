<?php

namespace Src\controllers;

use DateTime;
use Firebase\JWT\JWT;
use Src\DAO\SessionDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\TokenDAO;
use Src\DAO\UserDAO;
use Src\Models\Token;

class SessionController
{


    public  function store(Request $req, Response $res, $params)
    {

        #get data
        $data = $req->getParsedBody();

        $email = $data['email'];
        $password_user = $data['password_user'];

        $userDao  = new UserDAO;
        $user = $userDao->findByEmail($email);

        ##verify email and password user
        if ($user == null) {
            $res->getBody()->write(json_encode(["mgs" => "you is not registred"]));
            return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        if (sha1($password_user) != $user['password_user']) {
            $res->getBody()->write(json_encode(["mgs" => "password incorrect"]));
            return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        ##create token jwt for user
        $sessionDao = new SessionDAO;
        $token = $sessionDao->create($email, $password_user);
        $expiredAt = (new DateTime())->modify('+2 days')->format('Y-m-d H:i:s');
        $tokenPayload = [
            'sub' => $user['id'],
            'name' => $user['name_user'],
            'email' => $user['email'],
            'expired_at' => $expiredAt
        ];
        $secret = sha1('natanaelima');
        $token = JWT::encode($tokenPayload, $secret);

        ##create refresh_token jwt for user
        $refreshTokenPayload = [
            'email' => $user['email'],
            "radom" => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, $secret);

        ##create object token
        $tokenModel = new Token();
        $tokenModel->setToken($token);
        $tokenModel->setRefresh_token($refreshToken);
        $tokenModel->setUser_id($user['id']);
        $tokenModel->setExpired_at($expiredAt);

        ##create token with id user
        $tokenDAO = new TokenDAO();
        $tokenDAO->create($tokenModel);

        #response token user
        $res->getBody()->write(json_encode(["token" => $token, "refresh_token" => $refreshToken]));
        return $res->withHeader('Content-Type', 'application/json');
    }
}
