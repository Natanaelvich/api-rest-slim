<?php

namespace Src\controllers;

use DateTime;
use Firebase\JWT\JWT;
use Src\DAO\SessionDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\UserDAO;
use Src\Models\User;
use Tuupola\Middleware\JwtAuthentication;

class SessionController
{


    public  function store(Request $req, Response $res, $params)
    {

        #get data
        $data = $req->getParsedBody();

        $email = $data['email'];
        $password_user = $data['password_user'];

        $userDao  = new UserDAO;
        $user = $userDao->findByEmail($email)[0];

        ##verify email and password user
        if (count($user) == 0) {
            $res->getBody()->write(json_encode(["mgs" => "fails in login"]));
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

        #response token user
        $res->getBody()->write(json_encode(["token" => $token, "user" => $user]));
        return $res->withHeader('Content-Type', 'application/json');
    }
}
