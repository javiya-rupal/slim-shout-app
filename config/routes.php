<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Infrastructure\Api\Controller;
use Slim\App;

return function (App $app) {

    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write('Welcome to my Application of "Famous people Quote"');
        
        return $response;
    });

    $app->get('/shout/{personName:[a-z-]+}[/{limit}]', Controller\HomeController::class);
};