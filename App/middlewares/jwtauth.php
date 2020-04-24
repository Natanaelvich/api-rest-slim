<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class JwtAuth
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $token = $request->getAttribute('jwt');
        $expireDate = new \DateTime($token['expired_at']);
        $response = $handler->handle($request);


        if ($expireDate  <  new \DateTime()) {
            $response->getBody()->write(json_encode(["error" => "token expired"]));
            $response->withStatus(401)->withHeader('Content-Type', 'application/json');
            return $response;
        }


        $response->getBody()->write(json_encode(["token" => $token, "expired_at" => $expireDate]));
        return $response;
    }
}
