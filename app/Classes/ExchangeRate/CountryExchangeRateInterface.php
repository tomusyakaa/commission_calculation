<?php

declare(strict_types=1);

namespace App\Classes\ExchangeRate;

interface CountryExchangeRateInterface
{
    /**
     * @param string $country
     *
     * @return float|null
     */
    public function getCountryExchangeRate(string $country): ?float;

}