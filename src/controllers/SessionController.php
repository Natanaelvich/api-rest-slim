<?php

namespace Src\controllers;

use Src\DAO\SessionDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\Models\User;

class SessionController
{


    public  function store(Request $req, Response $res, $params)
    {

        $data = $req->getParsedBody();

        $user = new User;

        $user->setName_user($data['name_user']);
        $user->setPassword_user($data['password_user']);

        $sessionDao = new SessionDAO;
        $token =   $sessionDao->create($user->getName_user(), $user->getPassword_user());


        $token = json_encode($token);


        $res->getBody()->write($token);
        return $res->withHeader('Content-Type', 'application/json');
    }
}
