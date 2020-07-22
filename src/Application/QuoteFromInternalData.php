<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain;

final class QuoteFromInternalData
{
    public function __invoke(object $readerObject): Domain\Quote
    {
        return new Domain\Quote($readerObject);
    }
}