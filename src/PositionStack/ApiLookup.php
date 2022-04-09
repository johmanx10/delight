<?php

declare(strict_types=1);

namespace Delight\Website\PositionStack;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiLookup implements LookupInterface
{
    private const STATUS_OK = 200;

    public function __construct(
        private HttpClientInterface $client,
        private string $accessKey
    ) {}

    private function request(
        string $path,
        array $query,
        string $method = 'GET'
    ): ResponseInterface {
        $response = $this->client->request(
            $method,
            $path,
            [
                'query' => array_replace(
                    ['access_key' => $this->accessKey],
                    $query
                )
            ]
        );

        if ($response->getStatusCode() !== self::STATUS_OK) {
            throw new LookupException($path, $query, $response);
        }

        return $response;
    }

    public function forward(string $query): array
    {
        $response = $this
            ->request('forward', ['query' => $query])
            ->toArray();

        return $response['data'] ?? [];
    }
}
