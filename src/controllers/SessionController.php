<?php

namespace Src\controllers;

use Src\DAO\SessionDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\UserDAO;
use Src\Models\User;

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
        if (count($user) == 0) {
            $res->getBody()->write(json_encode(["mgs" => "fails in login"]));
            return $res->withHeader('Content-Type', 'application/json');
        }

        if (sha1($password_user) != $user[0]['password_user']) {
            $res->getBody()->write(json_encode(["mgs" => "password incorrect"]));
            return $res->withHeader('Content-Type', 'application/json');
        }

        ##create token jwt for user
        $sessionDao = new SessionDAO;
        $token = $sessionDao->create($email, $password_user);

        $token = json_encode($token);

        $res->getBody()->write($token);
        return $res->withHeader('Content-Type', 'application/json');
    }
}
