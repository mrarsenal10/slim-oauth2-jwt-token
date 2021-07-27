<?php

use Selective\BasePath\BasePathMiddleware;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->add(ValidationExceptionMiddleware::class);
    $app->addRoutingMiddleware();
    $app->add(BasePathMiddleware::class);
    $app->add(ErrorMiddleware::class);
    // $app->add(new Tuupola\Middleware\JwtAuthentication([
    //     'secret' => 'secretkey',
    //     'algorithm' => 'HS256',
    //     'secure' => false, // only for localhost for prod and test env set true
    //     'error' => function ($response, $arguments) {
    //         $data['status'] = 401;
    //         $data['error'] = 'Unauthorized/'. $arguments['message'];
    //         return $response
    //             ->withHeader('Content-Type', 'application/json;charset=utf-8')
    //             ->getBody()->write(json_encode(
    //                 $data,
    //                 JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    //             ));
    //     }
    // ]));
    // $app->add(new Tuupola\Middleware\JwtAuthentication([
    //     "secret" => "supersecretkeyyoushouldnotcommittogithub",
    //     "algorithm" => ["HS256"]
    // ]));
    $app->add(new Tuupola\Middleware\JwtAuthentication([
        "path" => "/api",
        "ignore" => ["/token"],
        "relaxed" => ["localhost"],
        "secret" => "supersecretkeyyoushouldnotcommittogithub"
    ]));
};
