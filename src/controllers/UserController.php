<?php

namespace Src\controllers;

use Src\DAO\UserDAO;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
}
