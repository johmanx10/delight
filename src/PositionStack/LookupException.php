<?php

declare(strict_types=1);

namespace Delight\Website\PositionStack;

use RuntimeException;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class LookupException extends RuntimeException
{
    public function __construct(
        string $path,
        array $query,
        ResponseInterface $response
    ) {
        parent::__construct(
            sprintf(
                'Illegal lookup for path "%s" with query %s => %s',
                $path,
                json_encode($query),
                $response->getContent()
            )
        );
    }
}
