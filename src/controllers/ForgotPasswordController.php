<?php

namespace Src\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\ForgotPasswordDAO;
use Src\DAO\TokenDAO;

class ForgotPasswordController
{


    public  function store(Request $req, Response $res, $params)
    {

        $token = $req->getAttribute('jwt');
        $refreshToken = $params['refreshtoken'];

        $tokenDAO = new TokenDAO;
        $token = $tokenDAO->findByRefreshToken($refreshToken);

        if ($token == null) {
            $res->getBody()->write(json_encode(["error" => "token invalid"]));
            return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        ##get attributes for update
        $password = $req->getParsedBody()['new_password'];
        $user_id = $token['user_id'];

        $forgotDAO = new ForgotPasswordDAO;
        $updatePassword = $forgotDAO->update($password, $user_id);
        if ($updatePassword == null) {
            $res->getBody()->write(json_encode(["error" => 'error to update password']));
            return $res->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        #response token user
        $res->getBody()->write(json_encode(["msg" => "password updated"]));
        return $res->withHeader('Content-Type', 'application/json');
    }
}
