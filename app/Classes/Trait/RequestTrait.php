<?php

declare(strict_types=1);

namespace App\Classes\Trait;

use App\Classes\ResponseStatus;
use GuzzleHttp\Client;

trait RequestTrait
{

    /**
     * @param string $uri
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getData(string $uri, array $query = []): string
    {
        $client = new Client();
        $response = $client->get($uri, ['query' => $query]);

        if ($response->getStatusCode() !== ResponseStatus::STATUS_OK) {
            throw new \Exception("Request failed to $uri.");
        }

        return $response->getBody()->getContents();
    }

}