<?php

namespace App\Infrastructure\Api\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Application;
use App\DataProviders;
use App\Infrastructure\Api\Controller;
use App\Handlers;

final class HomeController implements Controller
{
    public function __construct(Application\QuoteFromInternalData $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(ServerRequestInterface $request, 
    ResponseInterface $response): ResponseInterface
    {
        $personName = $request->getAttribute('personName');

        $numberOfQuote = $request->getAttribute('limit');

        //Constrain for requested quote limit
        if (!is_numeric($numberOfQuote) || (floor($numberOfQuote) != $numberOfQuote)) {
            throw new \Exception('Please enter valid number between 1 to 10 only in last argument!');
        }
        if ($numberOfQuote < 1 || $numberOfQuote > 10) {
            throw new \Exception('You can request minimum 1 and maximum 10 quotes only!');
        }

        //Read data from resources
        $readerObject = new DataProviders\QuotesFromJsonReader();

        $quoteObject = ($this->useCase)($readerObject);

        $quoteObject->filterQuotesByPersonName($personName, $numberOfQuote);

        $body = $quoteObject->quotes();

        // Create the cache provider.
        $cacheProvider = new \Slim\HttpCache\CacheProvider();

        $response = $cacheProvider->withEtag($response, 'quotesTag');

        $response->getBody()->write(json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(self::HTTP_OK);
    }
}