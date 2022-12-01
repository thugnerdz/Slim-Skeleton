<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
// use Slim\Interfaces\RouteCollectorProxyInterface as Group; // Probably needed for most applications.

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    // 'Hello, world!' example from the original repository. Keep this for reference.
    // $app->get('/', function (Request $request, Response $response) {
    //     $response->getBody()->write('Hello world!');
    //     return $response;
    // });
};
