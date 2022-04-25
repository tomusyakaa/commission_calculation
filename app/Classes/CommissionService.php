<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\BIN\BINInterface;
use App\Classes\DataProvider\DataProviderInterface;
use App\Classes\ExchangeRate\CountryExchangeRateInterface;
use App\Classes\Helper\Country;
use App\Classes\Model\Transaction;
use App\Classes\Output\LineWriterInterface;

class CommissionService
{
    private const EURO_COMMISSION_RATE = 0.01;
    private const NON_EURO_COMMISSION_RATE = 0.02;

    /**
     * @param BINInterface $binClient
     * @param CountryExchangeRateInterface $countryExchangeRate
     */
    public function __construct(
        protected BINInterface $binClient,
        protected CountryExchangeRateInterface $countryExchangeRate,
    ) {}

    /**
     * @return void
     */
    public function calculate(Transaction $transaction): float
    {
        return $this->getCommission($transaction);
    }

    /**
     * @param Transaction $transaction
     *
     * @return float
     */
    private function getCommission(Transaction $transaction): float
    {
        $binMetadata = $this->binClient->getBinMetaData($transaction->getBinId());

        $rateAmount = $this->countryExchangeRate->getCountryExchangeRate($transaction->getCurrency());

        $amountToEuro = $transaction->getAmount();
        if ($rateAmount) {
            $amountToEuro = $transaction->getAmount() / $rateAmount;
        }

        $commissionRate = $this->getCommissionRate($binMetadata->getCountryAlpha());

        return $amountToEuro * $commissionRate;
    }

    /**
     * @param string $countryAlpha
     *
     * @return float
     */
    private function getCommissionRate(string $countryAlpha): float
    {
        $isEurope = Country::isEurope($countryAlpha);

        $commissionRate = self::NON_EURO_COMMISSION_RATE;
        if ($isEurope) {
            $commissionRate = self::EURO_COMMISSION_RATE;
        }

        return $commissionRate;
    }
}