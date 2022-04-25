<?php

namespace App\Classes\Model;

class Transaction
{
    public const EURO_CURRENCY = 'EUR';

    /**
     * @param int $binId
     * @param float $amount
     * @param string $currency
     */
    public function __construct(
        private int $binId,
        private float $amount,
        private string $currency
    )
    {
    }

    /**
     * @return int
     */
    public function getBinId(): int
    {
        return $this->binId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return bool
     */
    public function isEuroCurrency(): bool
    {
        return $this->getCurrency() === self::EURO_CURRENCY;
    }
}