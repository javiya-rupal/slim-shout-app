<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Controller
{
    public const HTTP_OK = 200;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}