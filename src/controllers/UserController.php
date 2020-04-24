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

        ## get body params
        $data = $req->getParsedBody();

        $user = new User;

        $user->setName_user($data['name_user']);
        $user->setPassword_user($data['password_user']);
        $user->setEmail($data['email']);

        $userDao = new UserDAO;

        $userExist = $userDao->findByEmail($user->getEmail($user->getEmail()));

        ## verify if user already exists
        if (count($userExist) > 0) {
            $msg  = json_encode(["msg" => "user already exists"]);
            $res->getBody()->write($msg);
            return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        ##create new user
        $user =   $userDao->create($user);

        $user = [
            "name_user" => $user->getName_user(),
            "password_user" => $user->getPassword_user(),
            "email" => $user->getEmail()
        ];

        $user = json_encode($user);


        ## reponse in json
        $res->getBody()->write($user);
        return $res->withHeader('Content-Type', 'application/json');
    }

    public  function update(Request $req, Response $res, $params)
    {

        ## get body params
        $data = $req->getParsedBody();

        $id =  $params['id'];

        $userDao = new UserDAO;

        $userExists = $userDao->findById($id);


        ## verify if user  exists
        if (count($userExists) == 0) {
            $msg  = json_encode(["msg" => "user not found"]);
            $res->getBody()->write($msg);
            return $res->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        ##create user object
        $user = new User;
        $user->setName_user($data['name_user']);
        $user->setPassword_user($data['password_user']);
        $user->setEmail($data['email']);


        $userExists = $userDao->findByEmail($user->getEmail());


        ## verify if user already exists to email
        if (count($userExists) > 0) {
            $msg  = json_encode(["msg" => "this email is already registered"]);
            $res->getBody()->write($msg);
            return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
        }
        ##create new user
        $user =   $userDao->update($user, $id);

        $user = [
            "name_user" => $user->getName_user(),
            "password_user" => $user->getPassword_user(),
            "email" => $user->getEmail()
        ];

        $user = json_encode($user);


        ## reponse in json
        $res->getBody()->write($user);
        return $res->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}
