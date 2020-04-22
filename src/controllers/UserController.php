<?php

namespace Src\controllers;

use Src\DAO\UserDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\Models\User;

class UserController
{
    public  function index(Request $req, Response $res, $params)
    {

        $userDao = new UserDAO;
        $users = $userDao->findAll();
        $users = json_encode($users);

        $res->getBody()->write($users);
        return $res->withHeader('Content-Type', 'application/json');
    }


    public  function show(Request $req, Response $res, $params)
    {
        $id = $params['id'];

        $userDao = new UserDAO;
        $user = $userDao->findById($id);
        $user = json_encode($user);

        $res->getBody()->write($user);
        return $res->withHeader('Content-Type', 'application/json');
    }

    public  function store(Request $req, Response $res, $params)
    {

        $data = $req->getParsedBody();

        $user = new User;

        $user->setName_user($data['name_user']);
        $user->setPassword_user($data['password_user']);

        $userDao = new UserDAO;
        $user =   $userDao->create($user);

        $user = [
            "name_user" => $user->getName_user(),
            "password_user" => $user->getPassword_user()
        ];

        $user = json_encode($user);


        $res->getBody()->write($user);
        return $res->withHeader('Content-Type', 'application/json');
    }
}
