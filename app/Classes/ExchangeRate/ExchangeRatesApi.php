<?php

declare(strict_types=1);

namespace App\Classes\ExchangeRate;

use App\Classes\ResponseStatus;
use App\Classes\Trait\RequestTrait;
use GuzzleHttp\Client;

class ExchangeRatesApi implements CountryExchangeRateInterface
{
    use RequestTrait;

    /**
     * @var bool
     */
    private bool $formatResponse = true;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param string $url
     * @param string $accessKey
     */
    public function __construct(private string $url, private string $accessKey)
    {
    }

    /**
     * @param string $country
     *
     * @return float|null
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCountryExchangeRate(string $country): ?float
    {
        if ($this->data && isset($this->data[$country])) {
            return $this->data[$country];
        }

        $data = $this->getData($this->url, ['access_key' => $this->accessKey, 'format' => $this->formatResponse]);
        $data = json_decode($data, true);

        if (!$data || !$data['rates']) {
            throw new \Exception("No exchange rate for $country.");
        }

        $this->data = $data['rates'];

        if (isset($data[$country])) {
            return $data[$country];
        }

        return null;
    }
}