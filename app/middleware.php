<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Middlewares\TrailingSlash;
use Slim\Middleware\ContentLengthMiddleware;

return function (App $app) {
    $app->add(SessionMiddleware::class);

    $app->add(new ContentLengthMiddleware()); // Automatically append Content-Length header to responses. Should be placed on the end of the stack.

    $app->add(new TrailingSlash(false)); // true: trailing slash will be appended to all routes. false: trailing slash will be trimmed from all routes. Remove the middleware for default behaviour. Should be placed on the end of the stack.
};
