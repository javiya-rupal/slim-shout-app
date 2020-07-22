<?php

declare(strict_types=1);

namespace App\Domain;

final class Quote
{
    private $quotes = [];

    private $quotesData;

    public function __construct(object $readerObject)
    {
        $this->quotesData = $readerObject->getData();
    }

    public function filterQuotesByPersonName(string $personName, int $limit): void
    {
        $personName = ucwords(str_replace('-', ' ', $personName));

        $resources = $this->quotesData;

        $quotes = [];
        $n = 0;
        foreach ($resources as $rkey => $resource) {
            if ($resource['author'] == $personName && $n < $limit){
                $quotes[] = substr_replace(strtoupper($resource['quote']), '!', -1, 1);
                $n++;
            }
        }

        $this->quotes = $quotes;
    }

    public function quotes(): array
    {
        return $this->quotes;
    }
}