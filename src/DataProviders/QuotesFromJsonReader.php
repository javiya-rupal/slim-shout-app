<?php

declare(strict_types=1);

namespace App\DataProviders;

use Slim\App;
use App\Interfaces\DataProviderInterface;

class QuotesFromJsonReader implements DataProviderInterface
{
    public function getData(): array {
        $data = file_get_contents(dirname(dirname(__DIR__)) . '/public/quotes.json');

        $q = json_decode($data, true);
        
        return $q['quotes'];
    }
}