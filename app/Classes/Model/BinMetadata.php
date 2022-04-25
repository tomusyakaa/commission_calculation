<?php

declare(strict_types=1);

namespace App\Classes\Model;

class BinMetadata
{

    /**
     * @param int $binId
     * @param string $countryAlpha
     */
    public function __construct(
        private int $binId,
        private string $countryAlpha,
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
     * @return string
     */
    public function getCountryAlpha(): string
    {
        return $this->countryAlpha;
    }
}