<?php
use Slim\App;
use App\Middleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\Middleware\ErrorMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    $app->add(BasePathMiddleware::class);

    // Define Custom Error Handler
    $appErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ) use ($app) {
        $payload = ['error' => $exception->getMessage()];

        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    };

    // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($appErrorHandler);

};